<?php 

require_once __DIR__ . "/Bdd.php";
require_once __DIR__ . "/Categorie.php";

$categorieModel = new Categorie(); // Active Record

$nbLigne = $categorieModel
                ->setNom("première catégorie")
                ->setDescription("un lorem ipsum")
                ->create(); 

echo $nbLigne ; 

$categorieModel
                ->setNom("PHP")
                ->setDescription("découverte du langage PHP")
                ->create(); 

// http://192.168.15.22/jour5/03-nouveau.php
