# PHP / Symfony - Ynov B2 - TP1

Vous allez réaliser un site vitrine pour un service de création de cartes de visite en ligne.

>## Vous utiliserez la version 4 de Symfony

Critères d'évaluation :

- Utilisation des commandes vues en cours
- Compréhension de la structure de base de Symfony
- Utilisation des fixtures
- Réalisation de templates responsives avec Twig
- Séparation du code

## Mode de rendu

Lien vers votre dépôt Git, que je pourrai clôner.

## Dépôt Git

Votre dépôt Git contiendra un fichier `README.md` dans lequel vous indiquerez :

- La commande `composer` utilisée pour créer votre projet avec Symfony 4
- La commande à utiliser pour voir la version courante de Symfony pour votre projet
- La commande à utiliser pour voir les routes disponibles dans l'application
- La commande à utiliser pour créer une entité
- La commande à utiliser pour créer les données de tests (fixtures) dans la base de données
- Un texte justifiant l'organisation de vos classes de contrôleurs

## Exercice

>## **Vous utiliserez la version 4 de Symfony**

---
> *Indiquez dans votre fichier `README.md` la commande composer à utiliser pour créer un projet Symfony 4*
---
> *Indiquez dans votre fichier `README.md` la commande à utiliser pour voir la version courante de Symfony pour votre projet*

Vous souhaitez présenter pour les utilisateurs du site une liste de templates disponibles pour créer une carte de visite numérique.

Pour ce faire, vous allez vous appuyer sur une base de données contenant les templates.

### Structure de la table `card_template`

| Champ  | Type |
| --- |:---:|
| id | INT |
| name | VARCHAR(255) |
| description | TEXT |
| active | TINYINT |
| premium | TINYINT |
| preview | VARCHAR(255) |

---
> N'oubliez pas de créer un utilisateur MySQL spécifique à cette application
---
> Veillez à utiliser les bons types lors de la génération de votre entité avec la console
---
> *Indiquez dans votre fichier `README.md` la commande à utiliser pour créer une entité*

### Fixtures

Définissez une classe de fixtures chargée de créer des données de test dans la base de données, puis créez ces données.

> *Indiquez dans votre fichier `README.md` la commande à utiliser pour créer les fixtures*

### Structure du site

Vous créez un site contenant :

- une page d'accueil
- une page listant les templates disponibles

> Vous utiliserez une librairie (Bootstrap, UIKit, etc...) au choix pour réaliser vos templates. L'ensemble de l'application doit être responsive.

#### URLS

- Page d'accueil : /
- Page des templates : /templates

> *Indiquez dans votre fichier `README.md` la commande à utiliser pour voir les routes disponibles dans l'application*
>
> *Justifiez dans votre fichier `README.md` le choix de la création de votre/vos classes de contrôleur(s)*

### Structure du layout

Votre layout sera divisé en plusieurs parties distinctes.

Sur la page d'accueil :

- Header
- Contenu
- Footer

Sur la page des templates :

- Header
- Sidebar avec une liste de catégories (faites du statique, nous n'avons pas d'entité catégorie)
- Contenu
- Footer

> *Bonus : Si vous le souhaitez, créez une entité catégorie et affichez la liste des catégories dans la sidebar*

### Contenu de la page de templates

La page de templates présentera une liste des templates présents dans la base de données.

Selon la valeur des champs `active` et `premium`, vous devrez utiliser un indicateur visuel pour changer l'apparence de l'élément (une pastille verte contenant "PROMO" par exemple, ou bien une couleur d'arrière-plan différente si le template n'est disponible que pour les utilisateurs premium).

> N'hésitez pas à vous documenter pour trouver la meilleure façon d'afficher des éléments de manière conditionnelle avec Twig
---
> Séparez les différentes parties de votre template dans des fichiers distincts pour rendre votre code plus clair. Vous pouvez commencer par mettre l'ensemble de votre code dans le même fichier, puis optimiser en séparant dans des fichiers auxquels vous ferez appel

## Correction

>La commande `composer` utilisée pour créer votre projet avec Symfony 4 :
>
>`composer create-project symfony/website-skeleton visit_card ^4`
---
>La commande à utiliser pour voir la version courante de Symfony pour votre projet
>
>`php bin/console about`
---
>La commande à utiliser pour voir les routes disponibles dans l'application
>
>`php bin/console debug:router`
---
>La commande à utiliser pour créer une entité
>
>`php bin/console make:entity`
---
>La commande à utiliser pour créer les données de tests (fixtures) dans la base de données
>
>`php bin/console doctrine:fixtures:load`
---
>Un texte justifiant l'organisation de vos classes de contrôleurs
>
>Comme nous j'ai pu vous le montrer dans la première application de produits que nous avons commencée, je préfère séparer en 2 classes de contrôleurs (`IndexController` et `TemplateController`), car à mon sens les sujets concernés ne sont pas les mêmes. `IndexController` a une vocation beaucoup plus "généraliste" que `TemplateController`

### Création de l'entité

>`php bin/console make:entity CardTemplate`

Renseigner les différents champs : string par défaut avec une longueur de 255 pour les chaînes de caractères type "nom", "prénom", "preview"...text pour "description", boolean pour "active" et "premium".

Ensuite, pour mettre à jour la structure de votre base de données, 2 options :

#### Migrations

>`php bin/console make:migration`

Vérifiez le code généré dans la classe de migration (dossier 'Migrations'), puis

> `php bin/console doctrine:migrations:migrate`

#### Mise à jour directe avec doctrine

>`php bin/console doctrine:schema:update --dump-sql`

Pour avoir le code SQL qui sera exécuté dans votre base de données, afin de contrôler que tout est ok, puis :

>`php bin/console doctrine:schema:update --force`

pour exécuter les changements.

### Génération des fixtures

Sur [le site des recettes de Symfony Flex](https://flex.symfony.com/), on peut trouver la recette pour installer le package nous permettant d'utiliser des fixtures dans notre application :

>`composer require orm-fixtures`

La recette va créer un dossier `src/DataFixtures`.

#### Utilisation de Faker

[Lien vers le dépôt de Faker](https://github.com/fzaninotto/Faker)

Installez le package : `composer require fzaninotto/faker`

Ensuite, on va éditer le fichier `src/DataFixtures/AppFixtures.php` :

```php
<?php

namespace App\DataFixtures;

use App\Entity\CardTemplate;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
  public function load(ObjectManager $manager)
  {
    $faker = Factory::create();

    for ($i = 0; $i < 20; $i++) {
      $cardTemplate = new CardTemplate();

      $cardTemplate->setName($faker->sentence(3, true))
        ->setDescription($faker->paragraph(5))
        ->setActive($faker->boolean(20))
        ->setPremium($faker->boolean(40))
        ->setPreview('https://source.unsplash.com/random/200x200');

      $manager->persist($cardTemplate);
    }

    $manager->flush();
  }
}

```

On peut ensuite charger les fixtures dans la base de données :

`php bin/console doctrine:fixtures:load`

### Création des contrôleurs

Pour chaque page, on va créer une classe `IndexController` et `TemplateController` qui contiendront chacune un contrôleur :

Commande : `php bin/console make:controller`

>Fichier : src/Controller/IndexController.php

```php
<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {
        // return ...
    }
}

```

>Fichier : src/Controller/TemplateController.php

```php
<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TemplateController extends AbstractController
{
    /**
     * @Route("/templates", name="templates_list")
     */
    public function list()
    {
        // return ...
    }
}

```

### Templates

On va utiliser Bootstrap pour cet exercice.

Le dossier où se trouvent les templates est `/templates`.

On va définir un template de base `base.html.twig`, qui inclura une navigation se trouvant dans `nav.html.twig` et un footer défini dans `footer.html.twig`.

>Dans la barre de navigation, on utilise la fonctions Twig `path` avec en paramètre le nom de la route pour générer nos éléments de menu

#### Page d'accueil

Pour la page d'accueil, allons à l'essentiel : un [jumbotron](https://getbootstrap.com/docs/4.4/components/jumbotron/) fourni par Bootstrap fera l'affaire.

#### Page des templates
