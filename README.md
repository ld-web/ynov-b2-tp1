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
- La commande à utiliser pour voir les routes disponibles dans l'application
- La commande à utiliser pour créer une entité
- La commande à utiliser pour créer les données de tests (fixtures) dans la base de données
- Un texte justifiant l'organisation de vos classes de contrôleurs

## Exercice

>## **Vous utiliserez la version 4 de Symfony**

---
> *Indiquez dans votre fichier `README.md` la commande composer à utiliser pour créer un projet Symfony 4*

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
