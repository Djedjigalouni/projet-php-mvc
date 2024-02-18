<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route(path : "/categorie" )]
#[IsGranted('ROLE_USER')] //tu doit te connecter pour acceder à la page
class CategorieController extends AbstractController
{
    #[Route('/', name: 'index_categorie')]

    public function index(CategorieRepository $categorieRepository): Response
    {
        $categories = $categorieRepository->findAll() ;
        return $this->render('categorie/index.html.twig', [
            'categories' => $categories ,
        ]);
    }

    
    #[Route(path : "/new" , name : "new_categorie")]
    public function new_categorie(Request $request , EntityManagerInterface $em){ 
     
       $categorie = new Categorie();
       $form = $this->createForm(CategorieType::class, $categorie);
      
       $form->handleRequest($request); //handleRequest :c'est comme les ->setNomAtt dans le php
       if($form->isSubmitted() && $form->isValid()){
          $em->persist($categorie); //persist ->si le id=0 ->il va faire un insert ,si le id=1 ->un update
          $em->flush() ;
         return  $this->redirectToRoute("index_categorie"); //rederiction vers la page exo4
       }

       return $this->render("categorie/new.html.twig" , ["form"=>$form]); //si le post n'est pas vide et tout les tests sont valides
    }

    #[Route(path : "/update/{id}" , name : "update_categorie")]
    public function update(int $id , CategorieRepository $categorieRepository , Request $request , EntityManagerInterface $em){
        $categorie = $categorieRepository->findOneBy(["id" =>$id]);
        $form  = $this->createForm(CategorieType::class , $categorie , ["label" =>"modifier"]);
        return $this->render("categorie/update.html.twig" , ["form" =>$form]) ;
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em->persist($categorie) ;
            $em ->flush() ;
            return $this->redirectToRoute("index_categorie");
        }

    }

    #[Route(path : "/delete/{id}" , name : "delete_categorie")]
    public function delete(int $id , EntityManagerInterface $em , CategorieRepository $categorieRepository){
        $categorie = $categorieRepository->findOneBy(["id" =>$id]);
        $em->remove($categorie);
        $em->flush() ;
        return $this->redirectToRoute("index_categorie");
    }
}
