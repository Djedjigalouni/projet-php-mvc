<?php 
namespace App\Controller ;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
class Exo1Controller extends AbstractController{
    #[Route("/exo1",name:"exo1" )]
    public function test(){
        // http://192.168.15.22/jour9-tp/exo1
        dd("j'ai réussi l'exo 1");
    }

    #[Route(path : "/exo2" , name:"exo2")]
    public function exo2(){
        $data = [
            "h1" => "exo2" , 
            "prenom" => "Alain",
            "nom" => "Doe",
            "age" => 22
        ];
        return $this->render("exo/vue.html.twig" , $data); 
    }
    #[Route(path : "/exo3" , name:"exo3")]
    public function exo3(){
        $data = [
            "etudiants" =>["Alain" , "Pierre" ,"Céline"],
            "formations" => ["js" , "symfony" , "angular" ,"PHP"]
        ];
        return $this->render("exo/exo3.html.twig" , $data); 
    }


}