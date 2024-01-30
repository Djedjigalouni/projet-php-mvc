<?php 

// http://192.168.15.22/jour6/02-test-singleton.php

require_once __DIR__ . "/Bdd.php";

$connexion = Bdd::getInstance();

var_dump($connexion); 