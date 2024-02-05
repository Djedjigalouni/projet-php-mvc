<?php 

namespace App\Model ;

use PDO ;
use App\Utils\Bdd ; 

class Article{
    private int|null $id = null  ;
    private string $titre = "";
    private string|null $contenu = null;
    private string|null $img = null;
    private string|null  $dt_creation = null; 

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of titre
     */ 
    public function getTitre(): string
    {
        return $this->titre;
    }

    /**
     * Set the value of titre
     *
     * @return  self
     */ 
    public function setTitre(string $titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get the value of contenu
     */ 
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set the value of contenu
     *
     * @return  self
     */ 
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getUrlImg(){
        if($this->img === null){
            return "https://via.placeholder.com/400x200?text=no image";
        }
        return $this->img;
    }

    /**
     * Get the value of img
     */ 
    public function getImg()
    {
        return $this->img;
    }

    /**
     * Set the value of img
     *
     * @return  self
     */ 
    public function setImg($img)
    {
        $this->img = $img;

        return $this;
    }

    /**
     * Get the value of dt_creation
     */ 
    public function getDtCreation()
    {
        return $this->dt_creation;
    }

    /**
     * Set the value of dt_creation
     *
     * @return  self
     */ 
    public function setDtCreation($dt_creation)
    {
        $this->dt_creation = $dt_creation;

        return $this;
    }

    public function readAll(){
        $connexion = Bdd::getInstance();
        $sql = "SELECT * FROM article";
        $stmt = $connexion->query($sql);
        return $stmt->fetchAll(PDO::FETCH_CLASS, Article::class);
    }

    public function create(){
        $connexion = Bdd::getInstance();
        $sql = "INSERT INTO article
                (titre, contenu , img)
                VALUES
                (:titre , :contenu , :img)
            ";
        $stmt = $connexion->prepare($sql );
        $stmt->execute([
            ":titre" => $this->titre ,
            ":contenu" => $this->contenu ,
            ":img" => $this->img
        ]);
        return $stmt->rowCount(); 
    }

    public function lireLaSuite(int $nbMot = 10) :string{
       $contenus = explode(" ", $this->contenu ) ;
       if(count($contenus) < $nbMot ){
            return $this->contenu ; 
       }
       $resultat = "";
       for($i = 0 ; $i < $nbMot ; $i++){
        $resultat .= " " . $contenus[$i];
       }
       return $resultat . " ..."; 
    }
}