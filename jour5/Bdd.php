<?php 

// Singleton 
// cette class permet de créer une connexion à la base de données
class Bdd{ // Bdd::getInstance() // une seule fois
    private $connexion ;
    private static $instance = null;
    private function __construct(){
        $dsn = "mysql://host=localhost;dbname=blog;charset=utf8";
        $login = "root";
        $password = "demo";
        $this->connexion = new PDO($dsn, $login , $password);
    }
    public static function getInstance(){
        if(self::$instance === null){
            self::$instance = new Bdd();
        }
        return self::$instance->connexion ; 
    }
}
// on remplace l'ecriture 1 et 2 par la l'ecriture3
//1- $bdd = new Bdd()
//2-$connexion = $bdd->getInstance()

// 3-$connexion = Bdd::getInstance()