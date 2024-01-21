Projet 5 - DA PHP SF
Création d'un blog PHP - OpenclassRooms
SymfonyInsight Badge lien : https://insight.symfony.com/projects/6248f345-e826-4493-a8f5-324e99ac3ebd/analyses/33?status=stats

#Directory Structure:

monblog/
│
├── app/
│   ├── Controllers/
│   │   ├── UserController.php
│   │   └── ...
│   ├── Models/
│   │   ├── User.php
│   │   └── ...
│   ├── View/
│   │   ├── admin/
│   │   ├── blog/
│   │   ├── templates/
│   │   └── ...
│   ├── Manager/
│   │   ├── AdminManager.php
│   │   ├── UserManager.php
│   │   ├── BaseManager.php
│   │   └── ...
│   ├── Core
│   │   ├── Functions/
│   │   ├── HttpRequest.php
│   │   ├── Router.php
│   │   ├── Route.php
│   │   └── ...
│   ├── Exceptions
│   │   ├── NoRouteFoundException.php
│   │   ├── ActionNotFoundException.php
│   │   ├── ...
│   │   └── ...
│   └── ...
│
├── public/
│   ├── assets/
│   ├── css/
│   ├── js/
│   └── ...
│
├── config/
│   ├── config.json
│   ├── routes.json
│   └── ...
├── vendor/
│   ├── composer/
│   ├── twig/
│   ├── autoload.php
│   └── ...
│
├── .gitignore
├── .htaccess
├── composer.json
├── monblog.sql
├── composer.lock
├── index.php
└── ...

Installation :

Lancer la commande  git https://github.com/Mike031289/openClassrooms_projet-5_blog
Lancer la commande cd openClassrooms_projet-5_blog
Lancer dans le terminal composer install
Récupérez la base de donnée à la racine (fichier nomé monblog.sql)

Remarques :

Mettre à jour le fichier de configuration de la base de données (app/config.json)
Pour que vous puissiez vous connecter à votre base de données, veuillez modifier le fichier avec vos identifiants, hôte et nom de base de données Ces informations sont trouvables chez votre hébergeur.

Fichier json : app/config.json

Le site est consultable ici : https://dmdprod.com/developpeur-fullstack-adjoukou.agbelou

Les identifiants par défaut pour tester l'application (le blog et l'administration du blog)sont :

Interface Administrateur: email : agbe@gmail.com, passWord: Agbe@gmail.com0312

Utilisateur (créer votre compte avec vos propres identifiants)
ou utilisez celui-ci
marc@gmail.com Marc@gmail.com0312

Contexte:
Ça y est, vous avez sauté le pas ! Le monde du développement web avec PHP est à portée de main et vous avez besoin de visibilité pour pouvoir convaincre vos futurs employeurs/clients en un seul regard. Vous êtes développeur PHP, il est donc temps de montrer vos talents au travers d’un blog à vos couleurs. Description du besoin

Le projet est donc de développer votre blog professionnel. Ce site web se décompose en deux grands groupes de pages :

les pages utiles à tous les visiteurs;
les pages permettant d’administrer votre blog.
Voici la liste des pages qui devront être accessibles depuis votre site web :

la page d'accueil;
la page listant l’ensemble des blog posts;
la page affichant un blog post;
la page permettant d’ajouter un blog post;
la page permettant de modifier un blog post;
les pages permettant de modifier/supprimer un blog post;
les pages de connexion/enregistrement des utilisateurs.
Vous développerez une partie administration qui devra être accessible uniquement aux utilisateurs inscrits et validés. Les pages d’administration seront donc accessibles sur conditions et vous veillerez à la sécurité de la partie administration. Commençons par les pages utiles à tous les internautes. Sur la page d’accueil, il faudra présenter les informations suivantes :

votre nom et votre prénom;

une photo et/ou un logo;

une phrase d’accroche qui vous ressemble (exemple : “Martin Durand, le développeur qu’il vous faut !”);

un menu permettant de naviguer parmi l’ensemble des pages de votre site web;

un formulaire de contact (à la soumission de ce formulaire, un e-mail avec toutes ces informations vous sera envoyé) avec les champs suivants :

nom/prénom,
e-mail de contact,
message,
un lien vers votre CV au format PDF;

et l’ensemble des liens vers les réseaux sociaux où l’on peut vous suivre (GitHub, LinkedIn, Twitter…).

Sur la page listant tous les blogs posts (du plus récent au plus ancien), il faut afficher les informations suivantes pour chaque blog post :

le titre;
la date de dernière modification;
le châpo;
et un lien vers le blog post.
Sur la page présentant le détail d’un blog post, il faut afficher les informations suivantes :

le titre;
le chapô;
le contenu;
l’auteur;
la date de dernière mise à jour;
le formulaire permettant d’ajouter un commentaire (soumis pour validation);
les listes des commentaires validés et publiés.
Sur la page permettant de modifier un blog post, l’utilisateur a la possibilité de modifier les champs titre, chapô, auteur et contenu. Dans le footer menu, il doit figurer un lien pour accéder à l’administration du blog.