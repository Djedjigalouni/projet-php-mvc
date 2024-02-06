<?php
namespace App\Controller ;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController{
   #[Route("/" , name:'home')]  // router via une annotation
   public function home(){
      $data =[] ;
      dd("bonjour"); //dd =>equivalent de var_dump() et de die()
      $this->render("front/home.html.twig" , $data) ;

   }

   #[Route("/description" , name:'premiere-page')]  
   public function description(){
      $data["h1"] = "Voici mon premier titre" ;
     return $this->render("front/description.html.twig" , $data ) ;

   }

   #[Route(path : "/boucle-condition" , name:'boucle-condition')]  
   public function boucleCondition(){
      $data = [
         "fleurs" => [
            ["nom" =>"rose" , "prix" => 20 , "isEnStock" => true],
            ["nom" =>"jasmin" , "prix" =>10 , "isEnStock" =>true],
            ["nom" =>"lilas" , "prix" => 15 , "isEnStock" => false],
            ["nom" =>"tulipe" , "prix" => 30, "isEnStock" => false]
         ]
         
      ];
     return $this->render("front/boucle-condition.html.twig" , $data ) ;

   }
}




?>