<?php
namespace App\Controller ;

use App\Form\EtudiantType;

use Doctrine\ORM\EntityManagerInterface;

use Etudiant;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

  #[Route(path : "/new_etudiant" , name : "/new_etudiant")]
      public function new_etudiant(Request $request , EntityManagerInterface $em){
         $data = [];
         $etudiant = new Etudiant();
         $form = $this->createForm(EtudiantType::class, $etudiant);
         $data["form"] = $form ;
         $form->handleRequest($request); //handleRequest :c'est comme les ->setNomAtt dans le php
         if($form->isSubmitted() && $form->isValid()){
            $em->persist($etudiant); //persist ->si le id=0 ->il va faire un insert ,si le id=1 ->un update
            $em->flush() ;
           return  $this->redirectToRoute("exo4"); //rederiction vers la page exo4
         }

         return $this->render("front/new_etudiant.html.twig" , $data); //si le post n'est pas vide et tout les tests sont valides
      }

}




?>