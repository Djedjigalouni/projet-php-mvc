<?php 
namespace App\Controller;
use App\Model\Article ;
use App\Model\User ; 

class AdminController  extends AbstractController{

    public function __construct()
    {
       if(!isset($_SESSION["user"])){
        $data["h1"] = " Page d'erreur 403 , vous devez vous connecter pour pouvoir accéder à cette page !";
        $this->render("403" , $data) ;
        die() ;
       } 
    }

    public function article_new(){
        $erreur = []; 
        $articleModel = new Article();
        if(!empty($_POST)){
            // fonction sanitize => enlever les caractères injections 
            $titre = htmlspecialchars(trim($_POST["titre"]));
            $contenu = htmlspecialchars(trim($_POST["contenu"]));
            $img = filter_input(INPUT_POST , "img", FILTER_SANITIZE_URL ); 

            if(strlen($titre ) < 3 || strlen($titre) > 255){
                $erreur[] = "le titre doit contenir entre 3 et 255 lettres";
            }

            if(strlen($contenu ) < 3 || strlen($contenu) > 65000){
                $erreur[] = "le contenu doit contenir entre 3 et 65000 lettres";
            }   


            if($img !== "" && !filter_var($img, FILTER_VALIDATE_URL)){
                    $erreur[] = "url de l'image n'est pas valide";
            }
            
            $articleModel->setTitre($titre)
                         ->setContenu($contenu)
                         ->setImg($img === "" ? null : $img  ); 
            if(empty($erreur)){
                $articleModel->create();
                global $router ;
                // permet d'être redirigé vers la page d'accueil 
                // redirection http 
                header("Location:". $router->generate("home"));
            }
        }
        $data = [];
        $data["h1"] = "créer un nouvel article";
        $data["title"] = "créer un nouvel article";
        $data["erreur"] = $erreur;
        $data["article"] = $articleModel ; 
        $this->render("article_new", $data); 
    }

    public function user_new(){
        $erreur = [];
        if(!empty($_POST)){
            $email = htmlspecialchars(trim($_POST["email"]));
            $password = htmlspecialchars(trim($_POST["password"]));

            // série de tests 
            // email valide
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $erreur[] = "email invalide"; 
            }

            // password contient 8 lettres avec majuscule et minuscule et un chiffre 
            // regex (?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}
            if(!preg_match("/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/", $password)){
                $erreur[] = "le password doit contenir 8 lettres avec au moins une majuscule et une minuscule et un chiffre ";
            }
             // est ce que il n'y a pas déjà un projet user avec le mail saisi 
            $userModel = new User(); 
            if($userModel->isUnique($email) !== 0){
                $erreur[] = "le mail saisit est déjà utilisé, veuillez choisir une autre email"; 
            }
            
            $passwordHashed = password_hash($password ,  PASSWORD_BCRYPT );

            $userModel->setEmail($email)
                ->setPassword($passwordHashed)
                ->setRole("redacteur");
            // si il n'y a pas d'erreur 
            if(empty($erreur)){
                // create 
                $userModel->create();
                global $router ;
                header("Location:" . $router->generate("home"));
            }
        }
        $data = [];
        $data["h1"] = "créer un nouveau profil gestionnaire"; 
        $data["erreur"] = $erreur ; 
        $this->render("user_new" , $data); 
    }
} 