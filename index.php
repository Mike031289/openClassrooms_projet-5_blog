<?php

require_once __DIR__ . '/vendor/autoload.php';

$loader = new Twig\Loader\FilesystemLoader(__DIR__ . '/app/views/templates');
$twig = new Twig\Environment($loader);

$router = new Router([], '/mon-blog');

// Chargement des fichiers de Classes 
spl_autoload_register(function($class){
    if(file_exists('exceptions/' . $class . '.php'))
    {
        require_once('exceptions/' . $class . '.php');
    }
    if(file_exists('controller/' . $class . '.php'))
    {
        require_once('controller/' . $class . '.php');
    }
    if(file_exists('model/' . $class . '.php'))
    {
        require_once('model/' . $class . '.php');
    }
});

// $router->map('GET', '/', function() use ($twig) {
//     echo $twig->render('index.html.twig', [
//         'title' => 'Page d\'accueil',
//         'content' => 'Bienvenue sur mon blog !'
//     ]);
// });

// $router->map('GET', '/blog/[a:slug]', function($slug) use ($twig) {
//     echo $twig->render('blog.html.twig', [
//         'title' => 'Article',
//         'content' => 'Contenu de l\'article avec slug : ' . $slug
//     ]);
// });

// $match = $router->match();
// if($match && is_callable($match['target'])) {
//     call_user_func_array($match['target'], $match['params']);
// } else {
//     header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
//     echo $twig->render('404.html.twig');
// }