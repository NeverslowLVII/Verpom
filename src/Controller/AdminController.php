<?php

namespace App\Controller;

use App\Entity\Recette;
use App\Repository\RecetteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin', name: 'admin_')]
class AdminController extends AbstractController
{
    #[Route('/recettes', name: 'recettes')]
    public function index(RecetteRepository $recetteRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $queryBuilder = $recetteRepository->createQueryBuilder('r');

        if ($search = $request->query->get('search')) {
            $queryBuilder->andWhere('r.titre LIKE :search')
                         ->setParameter('search', '%' . $search . '%');
        }

        $pagination = $paginator->paginate(
            $queryBuilder->getQuery(),
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('admin/recettes.html.twig', [
            'pagination' => $pagination,
            'search' => $search,
        ]);
    }

    #[Route('/recette/{id}/toggle', name: 'recette_toggle')]
    public function toggleRecette(Recette $recette, EntityManagerInterface $entityManager): Response
    {
        $recette->setPublished(!$recette->isPublished());
        $entityManager->flush();

        return $this->redirectToRoute('admin_recettes');
    }
}