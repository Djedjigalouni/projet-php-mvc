<?php 
namespace App\Controller;
use App\Model\Vehicule ;
use App\Model\User ; 

class AdminController  extends AbstractController{

    public function __construct()
    {
       if(!isset($_SESSION["user"]) && empty($_GET['access'])){
        $data["h1"] = " Page d'erreur 403 , vous devez vous connecter pour pouvoir accéder à cette page !";
        $this->render("403" , $data) ;
        die() ;
       } 
    }

    public function Vehicule_new(){
        $erreur = []; 
        $vehiculeModel = new Vehicule();
        if(!empty($_POST)){
            
            $nom = htmlspecialchars(trim($_POST["nom"]));
            $description = htmlspecialchars(trim($_POST["description"]));
            $modele = htmlspecialchars(trim($_POST["modele"]));
            $image = filter_input(INPUT_POST , "image", FILTER_SANITIZE_URL ); 
            $en_vente = $_POST["en_vente"] == "on"? 1: 0;

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
                         ->setImage($image === "" ? null : $image  )
                         ->setEnVente($en_vente);
            if(empty($erreur)){
                $vehiculeModel->create();
                global $router ;
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
                
                $id =(int) htmlspecialchars(trim($_POST["id"]));
                $nom = htmlspecialchars(trim($_POST["nom"]));
                $description = htmlspecialchars(trim($_POST["description"]));
                $modele = htmlspecialchars(trim($_POST["modele"]));
                $image = filter_input(INPUT_POST , "image", FILTER_SANITIZE_URL );
                $en_vente = $_POST["en_vente"] == "on" ? 1 : 0; 
                var_dump($en_vente);
                if(strlen($nom ) < 3 || strlen($nom) > 100){
                    $erreur[] = "le titre doit contenir entre 3 et 100 lettres";
                }
    
                if(strlen($description ) < 3 || strlen($description) > 65000){
                    $erreur[] = "la description doit contenir entre 3 et 65000 lettres";
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
                             ->setImage($image === "" ? null : $image  )
                             ->setEnVente($en_vente);
                if(empty($erreur)){
                    $vehiculeModel->update();
                    global $router ;
                    header("Location:". $router->generate("home"));
                }
            }
            $data = [];
            $data["h1"] ="modifier un vehicule";
            $data["erreur"] = $erreur;
            $data["vehicule"] = $vehiculeModel ; 
            $this->render("vehicule_new", $data); 
            //$this->render("home", $data);
        }

        else if (!empty($_POST["supprimer"])) {
            $vehiculeModel->delete($_POST["id"]);
            global $router ;
           
            header("Location:". $router->generate("home"));
        } else {
            
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
           
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $erreur[] = "email invalide"; 
            }
            if(strlen($pseudo ) < 3 || strlen($pseudo) > 100){
                $erreur[] = "le pseudo doit contenir entre 3 et 100 lettres";
            }

     
            
            if(!preg_match("/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/", $password)){
                $erreur[] = "le password doit contenir 8 lettres avec au moins une majuscule et une minuscule et un chiffre ";
            }
            
            $userModel = new User(); 
            if($userModel->isUnique($email) !== 0){
                $erreur[] = "le mail saisit est déjà utilisé, veuillez choisir une autre email"; 
            }
            
            $passwordHashed = password_hash($password ,  PASSWORD_BCRYPT );

            $userModel->setEmail($email)
                ->setPassword($passwordHashed)
                ->setPseudo($pseudo);
            
            if(empty($erreur)){
              
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

    public function user_edit() {
        $erreur = [];
        $data = [];
        if(!empty($_POST)){
            $id = htmlspecialchars(trim($_POST["id"]));
            $email = htmlspecialchars(trim($_POST["email"]));
            $pseudo = htmlspecialchars(trim($_POST["pseudo"]));
           
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $erreur[] = "email invalide"; 
            }
            if(strlen($pseudo ) < 3 || strlen($pseudo) > 100){
                $erreur[] = "le pseudo doit contenir entre 3 et 100 lettres";
            }

             
            $userModel = new User(); 
            if($userModel->isUnique($email) !== 0){
                $erreur[] = "le mail saisit est déjà utilisé, veuillez choisir une autre email"; 
            }
            

            $userModel->setEmail($email)
                ->setPseudo($pseudo);
           
            if(!empty($erreur)){
                
                $data["user"] = $userModel->readOne($id);
                $data["h1"] = "Editer le profil"; 
                $data["erreur"] = $erreur ; 
                $this->render("user_new" , $data);
            } else {
            $userModel->update($id);
            $data["users"] = $userModel->readAll();
            $data["h1"] = "Gérer les utilisateurs"; 
            $data["title"] = "gestion utilisateurs";
            $data["erreur"] = $erreur ; 
            $this->render("users" , $data);
            }
        } else {
            $uri = $_SERVER["REQUEST_URI"];
            $parts = explode("/",$uri);
            $id = (int) $parts[sizeof($parts) - 1];
            $userModel = new User();
            $user = $userModel->readOne($id);
            $data["user"] = $user;
            $data["h1"] = "Editer le profil"; 
            $data["erreur"] = $erreur ; 
            $this->render("user_new" , $data); 
        }
    }

    public function user_delete() {
        $erreur = [];
        $uri = $_SERVER["REQUEST_URI"];
        $parts = explode("/",$uri);
        $id = (int) $parts[sizeof($parts) - 1];
        $userModel = new User();
        $userModel->delete($id);
        $data = [];
        $data["title"] = "page gestion";
        $data["users"] = $userModel->readAll();
        $data["h1"] = "Gérer les utilisateurs"; 
        $data["erreur"] = $erreur ; 
        $this->render("users" , $data);
    }

    public function users() {
        $erreur = [];
        $userModel = new User();
        $data = [];
        $data["users"] = $userModel->readAll();
        $data["h1"] = "Gérer les utilisateurs"; 
        $data["erreur"] = $erreur ; 
        $this->render("users" , $data);
    }
} 