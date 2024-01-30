<?php 

// http://192.168.15.22/jour6/04-test-insert.php

require_once __DIR__ . "/Bdd.php";
require_once __DIR__ . "/User.php"; 

$userModel = new User();
// $userModel->setEmail("toto'@yahoo.fr")
//           ->setPassword("', '') ;DELETE FROM user ; -- '")
//           ->setRole("admin");

// $userModel->setEmail("titi'@gmail.com")
//           ->setPassword("', '') ;DELETE FROM user ; -- '")
//           ->setRole("redacture");


//           $userModel->setEmail("moimeme'@gmail.com")
//           ->setPassword("1234567")
//           ->setRole("redacture");
// $nbLigne = $userModel->create(); 

// $user = $userModel->readOne(1);
// var_dump($user); 
// var_dump($user->getEmail()); 

// $users = $userModel->readAll();
// var_dump($users);  

//  $userModel->setEmail("toto@yahoo.fr")
//           ->setPassword("azerty1234")
//           ->setRole("redacteur");

// $nbLigne = $userModel->update(1);

// var_dump($nbLigne); 

$nbLigne = $userModel->delete(2);

var_dump($nbLigne); 