<?php 
namespace App\Controller ;

use App\Entity\Article1;
use App\Form\ArticleType;
use App\Form\CategorieType;
use App\Repository\EtudiantRepository;
use App\Entity\Categorie;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    #[Route(path : "/exo4" , name:"exo4")]
    public function exo4( EtudiantRepository $etudiantRepo ){
        $data["etudiants"] = $etudiantRepo->findAll();  //findAll equivalent de readAll (SELECT)
        return $this->render("exo/exo4.html.twig" , $data); 
    }
    #[Route(path : "/new_article" , name : "/new_article")]
    public function new_article(Request $request , EntityManagerInterface $em){ 
       $data = [];
       $article = new Article1();
       $form = $this->createForm(ArticleType::class, $article);
       $data["form"] = $form ;
       $form->handleRequest($request); //handleRequest :c'est comme les ->setNomAtt dans le php
       if($form->isSubmitted() && $form->isValid()){
          $em->persist($article); //persist ->si le id=0 ->il va faire un insert ,si le id=1 ->un update
          $em->flush() ;
         return  $this->redirectToRoute("exo4"); //rederiction vers la page exo4
       }

       return $this->render("front/new_etudiant.html.twig" , $data); //si le post n'est pas vide et tout les tests sont valides
    }

    #[Route(path : "/new_categorie" , name : "/new_categorie")]
    public function new_categorie(Request $request , EntityManagerInterface $em){ 
       $data = [];
       $categorie = new Categorie();
       $form = $this->createForm(CategorieType::class, $categorie);
       $data["form"] = $form ;
       $form->handleRequest($request); //handleRequest :c'est comme les ->setNomAtt dans le php
       if($form->isSubmitted() && $form->isValid()){
          $em->persist($categorie); //persist ->si le id=0 ->il va faire un insert ,si le id=1 ->un update
          $em->flush() ;
         return  $this->redirectToRoute("/new_categorie"); //rederiction vers la page exo4
       }

       return $this->render("front/new_categorie.html.twig" , $data); //si le post n'est pas vide et tout les tests sont valides
    }
}

//EntityManagerInterface->Iil gere le UPDATE,DELETE , INSERT
//repository->gere le SELECT
// Entity ->gere les proprietes ,les sitter et les gitter