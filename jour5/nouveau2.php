<?php 

// créer une nouvelle table dans la base 
// article 
// id  clé primaire
// titre  texte max de 255 caractères not null
// contenu texte maximum de 45 000 caractères 
// dt_creation DATEet heure par défaut la valeur de maintenant

// créer une class Article 
// autant de propriété que de colonne dans la table article
// créer les setter et getter
// créer une méthode create qui permet de faire un INSERT dans la table article 

require_once __DIR__ . "/Bdd.php";
require_once __DIR__ . "/Article.php";

$articleModel = new Article();

$articleModel->setTitre("premier article")
             ->setContenu("lorem ipsum"); 

             $articleModel->setTitre("deuxieme article")
             ->setContenu("initiation php"); 
$nbLigne = $articleModel->create(); 

echo $nbLigne ; 

// http://192.168.15.22/jour5/04-exo.php