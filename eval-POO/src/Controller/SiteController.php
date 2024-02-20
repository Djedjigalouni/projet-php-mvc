<?php 
namespace App\Controller ;
use App\Model\Vehicule;
use App\Model\User ;

class SiteController extends AbstractController{
    public function home() :void {
        $data = [];
        $vehiculeModel =  new Vehicule();
        $data["vehicules"] = $vehiculeModel->readAll();
        $data["h2"] = "Trouvez votre véhicule idéal dès aujourd'hui !";
       
        $data["title"] = "page d'accueil";
        $data["titre"] = "Les voitures les plus achetées";
        
        $data["h5"] = "Rejoignez-nous, c'est gratuit !" ;
        $data["ul"] = ["li1"=>"Parcourez notre large selection de voitures." ,"li2"=> "Trouvez celles qui correspondent à vos critéres et à votre budget ." ,"li3"=> "Profiter de nos fonctionnaliter pour faciliter votre processus d'achat !"];

        $data["diapositives"] =
        [
        [ 
            "image"=> "https://www.autoneuve.ca/media/zoo/images/BMW-serie3-Touring-2016-1_456e51693e3ad746c48f0e0ea2cac36b.jpg" ,
            "title" => "Voiture Familiale",
           
        ],
        [ 
            "image"=> "https://www.autoneuve.ca/media/zoo/images/Fiat-500-2016-1_435882ede674269527852b3cd4c0a62d.jpg" ,
            "title" => "Voiture Citadine"
           
        ],
        [ 
            "image"=> "https://www.autoneuve.ca/media/zoo/images/Cadillac-ELR-2016-1_10e8925cbf245b81467e700fb93976bc.jpg",
            "title" => "Voiture Electrique"
           
        ],
        [ 
            "image"=> "https://www.autoneuve.ca/media/zoo/images/Alfa-Romeo-4C-2016-1_7b0257a7a30e2066a2b35446a64612cc.jpg",
            "title" => "Voiture De Sport"
           
        ]
        ];
        $this->render("home" , $data);
    }

    public function login() :void{
        $erreurs = [];
        if(!empty($_POST)){
            $email = htmlspecialchars(trim($_POST["email"]));
            $password = htmlspecialchars(trim($_POST["password"]));
            //$pseudo = htmlspecialchars(trim($_POST["pseudo"]));

            if(!filter_var($email , FILTER_VALIDATE_EMAIL)){
                $erreurs[] = "email invalide"; 
            }

            if(!preg_match("/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/", $password)){
                $erreurs[] = "le password doit contenir 8 lettres avec au moins une majuscule et une minuscule et un chiffre ";
            }
            /*if(strlen($pseudo ) < 3 || strlen($pseudo) > 100){
                $erreur[] = "le pseudo doit contenir entre 3 et 100 lettres";
            }*/


            $userModel = new User(); 
            $userRecherche = $userModel->readOneByEmail($email);
            if($userRecherche === false ){
                $erreurs[] = "email saisit n'existe pas !!";
            }

            if($userRecherche && !password_verify( $password , $userRecherche->getPassword())){
                $erreurs[] = "password n'est pas valide !!$password ".$userRecherche->getPassword()." " .password_verify( $password , password_hash($userRecherche->getPassword(), PASSWORD_BCRYPT) );
               
            }

            if(empty($erreurs)){
                
                $_SESSION["user"] = $userRecherche ;
                $_SESSION["Pseudo"]  =$userRecherche->getPseudo(); 
                global $router ; 
                header("Location: " . $router->generate("home"));
            }
        }
        $data = [];
        $data["title"]="page de connexion" ;
        $data["erreur"] = $erreurs ; 
        $data["h1"] = "Accéder à mon compte";
        $this->render("login" , $data);
    }

    public function logout()  :void{
        $_SESSION = [];
        session_destroy();
        global $router ;
        header("Location:" . $router->generate("home"));
    }

    public function mention_legale() :void {
        $data = [];
        $data["title"]="page mention_legale" ;
       
        $this->render("mention_legale" , $data);
    }
}