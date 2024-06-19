<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Recette;
use App\Form\RecetteType;
use App\Repository\RecetteRepository;
use Knp\Component\Pager\PaginatorInterface;

class RecetteController extends AbstractController
{
    #[Route('/', name: 'recette_index')]
    public function index(RecetteRepository $recetteRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $queryBuilder = $recetteRepository->createQueryBuilder('r')
            ->where('r.published = :published')
            ->setParameter('published', true);

        $pagination = $paginator->paginate(
            $queryBuilder,
            $request->query->getInt('page', 1),
            9
        );

        return $this->render('recette/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    #[Route('/recette/new', name: 'recette_new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $recette = new Recette();
        $form = $this->createForm(RecetteType::class, $recette);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($recette);
            $em->flush();
            return $this->redirectToRoute('recette_index');
        }
        return $this->render('recette/new.html.twig', ['form' => $form->createView()]);
    }

    #[Route('/recette/{id}', name: 'recette_show')]
    public function show(Recette $recette): Response
    {
        return $this->render('recette/show.html.twig', ['recette' => $recette]);
    }

    #[Route('/recette/{id}/edit', name: 'recette_edit')]
    public function edit(Request $request, Recette $recette, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(RecetteType::class, $recette);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('recette_index');
        }
        return $this->render('recette/edit.html.twig', [
            'form' => $form->createView(),
            'recette' => $recette,
        ]);
    }

    #[Route('/recette/{id}', name: 'recette_delete', methods: ['POST'])]
    public function delete(Request $request, Recette $recette, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('delete'.$recette->getId(), $request->request->get('_token'))) {
            $em->remove($recette);
            $em->flush();
        }
        return $this->redirectToRoute('recette_index');
    }
}