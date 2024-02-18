<?php 
session_start(); //creer la session dés le début de mon code car lors de la connexion en a besoin de la super global $_SESSION
require_once __DIR__ . "/vendor/autoload.php"; 
require_once __DIR__ . "/src/Utils/Bdd.php";
require_once __DIR__ . "/src/Model/User.php";
require_once __DIR__ . "/src/Model/Vehicule.php";
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

$router->map("GET|POST", "/login", [
    "class" => "\App\Controller\SiteController",
    "method" => "login"
] , "login");

$router->map("GET", "/vehicule/[i:id]", [
    "class" => "\App\Controller\SiteController",
    "method" => "vehicule"
] , "vehicule");

$router->map("GET|POST", "/users", [
    "class" => "\App\Controller\AdminController",
    "method" => "users"
] , "users");

$router->map("GET|POST", "/admin/users/[i:id]", [
    "class" => "\App\Controller\AdminController",
    "method" => "user_edit"
] , "admin_user_edit");

$router->map("GET|POST", "/admin/users/delete/[i:id]", [
    "class" => "\App\Controller\AdminController",
    "method" => "user_delete"
] , "admin_user_delete");

$router->map("GET|POST", "/admin/vehicule/new", [
    "class" => "\App\Controller\AdminController",
    "method" => "vehicule_new"
] , "admin_vehicule_new");

$router->map("GET|POST", "/admin/vehicule/[i:id]", [
    "class" => "\App\Controller\AdminController",
    "method" => "vehicule_edit"
] , "admin_vehicule_edit");

$router->map("GET|POST", "/admin/user/new", [
    "class" => "\App\Controller\AdminController",
    "method" => "user_new"
] , "admin_user_new");
$router->map("GET|POST", "/logout", [
    "class" => "\App\Controller\SiteController",
    "method" => "logout"
] , "logout");
$router->map("GET", "/mention_legale", [
    "class" => "\App\Controller\SiteController",
    "method" => "mention_legale"
] , "mention_legale");

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