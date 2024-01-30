<?php 

class Article {

    private $id ;
    private $titre ;
    private $contenu ;
    private $dt_creation ; 


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
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set the value of titre
     *
     * @return  self
     */ 
    public function setTitre($titre)
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

    public function  create(){
        $connexion = Bdd::getInstance();
        $sql = "
            INSERT INTO article 
            (titre , contenu)
            VALUES
            ('{$this->titre}', '{$this->contenu}');
        ";
        return $connexion->exec($sql);
    }
}