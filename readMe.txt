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
│   │   ├── HttpRequest.php
│   │   ├── Router.php
│   │   ├── Route.php
│   │   └── ...
│   ├── Exceptions
│   │   ├── NoRouteFoundException.php
│   │   ├── ...
│   │   ├── ...
│   │   └── ...
│   └── ...
│
├── public/
│   ├── assets/
│   ├── lcss/
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
├── composer.lock
├── index.php
└── ...
