# Blog de Recettes

## Description

Ce projet est un blog de recettes développé avec Symfony. Il permet de lister, voir, ajouter, modifier et supprimer des recettes de cuisine.

## Fonctionnalités

- Lister toutes les recettes de la base de données
- Voir le détail d'une recette (étapes de réalisation, ingrédients, photo)
- Ajouter une nouvelle recette
- Modifier une recette
- Supprimer une recette

## Structure d'un article

Un article est composé des éléments suivants :

- Titre
- Étapes de réalisation
- 1 ou plusieurs Tags (Entrées, Plats, Végétarien, Rapide, etc.)
- Image d'illustration

## Fonctionnalités bonus

- Pagination
- Authentification
- État de publication

## Prérequis

- PHP 8.0 ou supérieur
- Composer
- Symfony CLI
- PostgreSQL (avec render.com par exemple)

## Installation

1. Clonez le dépôt :

   ```bash
   git clone https://github.com/NeverslowLVII/Verpom.git
   cd Verpom
   ```

2. Installez les dépendances PHP :

   ```bash
   composer install
   ```

3. Configurez la base de données dans le fichier `.env` :

   ```dotenv
   APP_ENV=<dev ou prod>
   APP_SECRET=<secret>
   DATABASE_URL="postgres://<user>:<password>@<dburl>/verpom"
   ```

4. Assurez-vous que les lignes suivantes sont décommentées dans votre fichier php.ini :

```bash
   extension=pdo_pgsql
   ; ou pour MySQL
   ; extension=pdo_mysql
```

5. Exécutez les migrations :

   ```bash
   php bin/console doctrine:migrations:migrate
   ```

6. Lancez le serveur de développement :
   ```bash
   symfony server:start
   ```

## Utilisation

- Accédez à l'application via `http://localhost:8000`.
- Utilisez l'interface pour ajouter, modifier, supprimer et lister les recettes.

## Déploiement

Pour déployer l'application en production, assurez-vous de configurer correctement les variables d'environnement.

## Tests

Pour exécuter les tests, utilisez PHPUnit :

```bash
php bin/phpunit
```
