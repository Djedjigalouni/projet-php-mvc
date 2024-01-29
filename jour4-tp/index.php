<?php 

$page = "";

if(isset($_GET["page"]) && !empty($_GET["page"])){
    $page = $_GET["page"] ;
}else {
    $page = "/"; 
}

require_once __DIR__ . "/Controllers/AbstractController.php";
require_once __DIR__ . "/Controllers/PageController.php";
require_once __DIR__ . "/Controllers/ErreurController.php";

$routes = [
    "/" => "accueil" , 
    "/service" => "service",
    "/connexion" => "connexion"
];

if(isset($routes[$page])){
    // var_dump($routes[$page]); 
    $p = new PageController();
    $p->{$routes[$page]}(); 
}else{
    $p = new ErreurController();
    $p->erreur404(); 
}
