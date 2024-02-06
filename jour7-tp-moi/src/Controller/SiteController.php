<?php 
namespace App\Controller ;
use App\Model\Article;
use App\Model\User ;

class SiteController extends AbstractController{
    public function home() :void {
        $data = [];
        $articleModel =  new Article();
        $data["articles"] = $articleModel->readAll();
        $data["h1"] = "Nos derniers articles à lire";
        $data["title"] = "page d'accueil";
        $this->render("home" , $data);
    }

    public function login() :void{
        $erreurs = [];
        if(!empty($_POST)){
            $email = htmlspecialchars(trim($_POST["email"]));
            $password = htmlspecialchars(trim($_POST["password"]));

            if(!filter_var($email , FILTER_VALIDATE_EMAIL)){
                $erreurs[] = "email invalide"; 
            }

            if(!preg_match("/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/", $password)){
                $erreurs[] = "le password doit contenir 8 lettres avec au moins une majuscule et une minuscule et un chiffre ";
            }

             // est ce que les identifiants saisis existent en base de données 
            //solliciter la base de données => la table user 

            $userModel = new User(); 
            $userRecherche = $userModel->readOneByEmail($email);
            if($userRecherche === false ){
                $erreurs[] = "email saisit n'existe pas !!";
            }

            if($userRecherche && !password_verify( $password , $userRecherche->getPassword() )){
                $erreurs[] = "password n'est pas valide !!";
                // en général on met le même message pour le login et password 
                // identifiants invalides 
            }

            if(empty($erreurs)){
                // connexion !!! 
                // utiliser la SESSION
                $_SESSION["user"] = $userRecherche ; 
                // super globale comme $_GET et $_POST 
                // variable créer par le langage PHP 
                // variable qui est persistante pendant le moment où vous naviger dans le site internet 
                // par défaut PHP ne crée pas cette super globale 
                // session_start(); => ajouter dans la page index.php en 1ère ligne
                // 
                global $router ; // redirection vers la page d'ajout d'article
                header("Location: " . $router->generate("admin_article_new"));
            }
        }
        $data = [];
        $data["erreur"] = $erreurs ; 
        $data["h1"] = "Accéder au back office du site";
        $this->render("login" , $data);
    }

    public function logout()  :void{
        $_SESSION = [];
        session_destroy();
        global $router ;
        header("Location:" . $router->generate("login"));
    }
}