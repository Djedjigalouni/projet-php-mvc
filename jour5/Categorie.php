<?php 

class Categorie{
    private int $id ;
    private string $nom ;
    private string $description ; 

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of nom
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */ 
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function create(){
        // $connexion = new PDO(...)
        // $sql = "INSERT ..."
        // $connexion->exec($sql); 
        $connexion = Bdd::getInstance(); 
        $sql = "INSERT INTO categorie 
                (nom, description) 
                VALUES 
                ( '{$this->nom}' , '{$this->description}' )";
        $nbLigne = $connexion->exec($sql);
        return $nbLigne ;
    }

    public function readAll(){

    }

}