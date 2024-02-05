<?php 
require_once __DIR__ . "/vendor/autoload.php"; 
require_once __DIR__ . "/src/Utils/Bdd.php";
require_once __DIR__ . "/src/Model/User.php";
require_once __DIR__ . "/src/Model/Article.php";
require_once __DIR__ . "/src/Controller/AbstractController.php";
require_once __DIR__ . "/src/Controller/AdminController.php";
require_once __DIR__ . "/src/Controller/SiteController.php";
require_once __DIR__ . "/src/Controller/ErreurController.php";

$router = new AltoRouter(); 
// permet de définir le dossier qui contient notre projet
// $_SERVER['BASE_URI'] => "/jour7-tp"
$router->setBasePath($_SERVER['BASE_URI']); // gérer proprement
                                            // les urls dans les vues
$router->map("GET", "/", [
    "class" => "\App\Controller\SiteController",
    "method" => "home"
] , "home");

$router->map("GET", "/login", [
    "class" => "\App\Controller\SiteController",
    "method" => "login"
] , "login");

$router->map("GET", "/article/[i:id]", [
    "class" => "\App\Controller\SiteController",
    "method" => "article"
] , "article");

$router->map("GET|POST", "/admin/article/new", [
    "class" => "\App\Controller\AdminController",
    "method" => "article_new"
] , "admin_article_new");

$router->map("GET|POST", "/admin/user/new", [
    "class" => "\App\Controller\AdminController",
    "method" => "user_new"
] , "admin_user_new");

$match = $router->match(); 

//var_dump($match);

if($match){
    $class = $match["target"]["class"];
    $method = $match["target"]["method"];
    $p = new $class();
    $p->$method(); 
    // créer le controller et la méthode qui va bien 
}else {
    $p = new App\Controller\ErreurController();
    $p->erreur404(); 
}
 
// http://192.168.15.22/jour7-tp


// $router objet 
// qui contient une méthode map()
// qui prend 4 paramètres
// 1 méthode GET / POST
// 2 uri
// uri de la route / => home
// uri de la route /connexion => connexion
// uri de la route /article/:id => article 
// 3 tableau associatif => 3 clés => class à exécuter / méthode
// 4 string => nommer la route => dans les templates dans les balises a