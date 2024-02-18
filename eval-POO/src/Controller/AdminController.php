<?php 
namespace App\Controller;
use App\Model\Vehicule ;
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

    public function Vehicule_new(){
        $erreur = []; 
        $vehiculeModel = new Vehicule();
        if(!empty($_POST)){
            // fonction sanitize => enlever les caractères injections 
            $nom = htmlspecialchars(trim($_POST["nom"]));
            $description = htmlspecialchars(trim($_POST["description"]));
            $modele = htmlspecialchars(trim($_POST["modele"]));
            $image = filter_input(INPUT_POST , "image", FILTER_SANITIZE_URL ); 

            if(strlen($nom ) < 3 || strlen($nom) > 100){
                $erreur[] = "le titre doit contenir entre 3 et 100 lettres";
            }

            if(strlen($description ) < 3 || strlen($description) > 65000){
                $erreur[] = "le contenu doit contenir entre 3 et 65000 lettres";
            }   

            if(strlen($modele ) < 3 || strlen($modele) > 100){
                $erreur[] = "le modele doit contenir entre 3 et 100 lettres";
            } 

            if($image !== "" && !filter_var($image, FILTER_VALIDATE_URL)){
                    $erreur[] = "url de l'image n'est pas valide";
            }
            
            $vehiculeModel->setNom($nom)
                         ->setDescription($description)
                         ->setModele($modele)
                         ->setImage($image === "" ? null : $image  ); 
            if(empty($erreur)){
                $vehiculeModel->create();
                global $router ;
                // permet d'être redirigé vers la page d'accueil 
                // redirection http 
                header("Location:". $router->generate("home"));
            }
        }
        $data = [];
        $data["h1"] = "ajouter un nouveau vehicule";
        $data["title"] = "ajouter un nouveau vehicule";
        $data["erreur"] = $erreur;
        $data["vehicule"] = $vehiculeModel ; 
        $this->render("vehicule_new", $data); 
    }

    public function Vehicule_edit () {
        $erreur = []; 
        $vehiculeModel = new Vehicule();
        if (!empty($_POST["modifier"])) {
            if(!empty($_POST)){
                // fonction sanitize => enlever les caractères injections 
                $id =(int) htmlspecialchars(trim($_POST["id"]));
                $nom = htmlspecialchars(trim($_POST["nom"]));
                $description = htmlspecialchars(trim($_POST["description"]));
                $modele = htmlspecialchars(trim($_POST["modele"]));
                $image = filter_input(INPUT_POST , "image", FILTER_SANITIZE_URL ); 
    
                if(strlen($nom ) < 3 || strlen($nom) > 100){
                    $erreur[] = "le titre doit contenir entre 3 et 100 lettres";
                }
    
                if(strlen($description ) < 3 || strlen($description) > 65000){
                    $erreur[] = "le contenu doit contenir entre 3 et 65000 lettres";
                }   
    
                if(strlen($modele ) < 3 || strlen($modele) > 100){
                    $erreur[] = "le modele doit contenir entre 3 et 100 lettres";
                } 
    
                if($image !== "" && !filter_var($image, FILTER_VALIDATE_URL)){
                        $erreur[] = "url de l'image n'est pas valide";
                }
                
                $vehiculeModel->setId($id)
                             ->setNom($nom)
                             ->setDescription($description)
                             ->setModele($modele)
                             ->setImage($image === "" ? null : $image  ); 
                if(empty($erreur)){
                    $vehiculeModel->update();
                    global $router ;
                    // permet d'être redirigé vers la page d'accueil 
                    // redirection http 
                    header("Location:". $router->generate("home"));
                }
            }
            $data = [];
            $data["erreur"] = $erreur;
            $data["vehicule"] = $vehiculeModel ; 
            $this->render("vehicule_new", $data); 
            //$this->render("home", $data);
        }

        else if (!empty($_POST["supprimer"])) {
            $vehiculeModel->delete($_POST["id"]);
            global $router ;
            // permet d'être redirigé vers la page d'accueil 
            // redirection http 
            header("Location:". $router->generate("home"));
        } else {
            // Editer l'objet
            $uri = $_SERVER["REQUEST_URI"];
            $parts = explode("/",$uri);
            $id = (int) $parts[sizeof($parts) - 1];
            $vehicule = $vehiculeModel->readById($id);
            $data = [];
            $data["h1"] = "Editer le vehicule";
            $data["title"] = "Editer vehicule";
            $data["erreur"] = $erreur;
            $data["vehicule"] = $vehicule ; 
            $this->render("vehicule_new", $data); 
        }
    }

    public function user_new(){
        $erreur = [];
        if(!empty($_POST)){
            $email = htmlspecialchars(trim($_POST["email"]));
            $password = htmlspecialchars(trim($_POST["password"]));
            $pseudo = htmlspecialchars(trim($_POST["pseudo"]));
            // série de tests 
            // email valide
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $erreur[] = "email invalide"; 
            }
            if(strlen($pseudo ) < 3 || strlen($pseudo) > 100){
                $erreur[] = "le pseudo doit contenir entre 3 et 100 lettres";
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
                ->setPseudo($pseudo);
            // si il n'y a pas d'erreur 
            if(empty($erreur)){
                // create 
                $userModel->create();
                global $router ;
                header("Location:" . $router->generate("home"));
            }
        }
        $data = [];
        $data["h1"] = "créer un nouveau profil"; 
        $data["erreur"] = $erreur ; 
        $this->render("user_new" , $data); 
    }
} 