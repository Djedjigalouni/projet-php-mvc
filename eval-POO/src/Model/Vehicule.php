<?php 

namespace App\Model ;

use PDO ;
use App\Utils\Bdd ;
use phpDocumentor\Reflection\Types\Integer;

class Vehicule{
    private int|null $id = null  ;
    private string $nom = "";
    private string|null $description = null;
    private string|null $image = null;
    private string|null  $date_creation = null; 
    private bool|null $en_vente = true;
    private string $modele = "";
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

    /**
     * Get the value of dt_creation
     */ 
    public function getDateCreation()
    {
        return $this->date_creation;
    }

    /**
     * Set the value of dt_creation
     *
     * @return  self
     */ 
    public function setDateCreation($date_creation)
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    /**
     * Get the value of img
     */ 
    public function getUrlImg(){
        if($this->image === null){
            return "https://via.placeholder.com/400x200?text= no image";
        }
        return $this->image;
    }
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id){
        $this->id = $id;

        return $this;
    }

    /**
     * Set the value of img
     *
     * @return  self
     */ 
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of en_vente
     */ 
    public function getEnVente()
    {
        return $this->en_vente;
    }

    /**
     * Set the value of en_vente
     *
     * @return  self
     */ 
    public function setEnVente($en_vente)
    {
        $this->en_vente = $en_vente;

        return $this;
    }
    
    /**
     * Get the value of modele
     */ 
    public function getModele()
    {
        return $this->modele;
    }

    /**
     * Set the value of modele
     *
     * @return  self
     */ 
    public function setModele($modele)
    {
        $this->modele = $modele;

        return $this;
    }

    public function readAll(){
        $connexion = Bdd::getInstance();
        $sql = "SELECT * FROM vehicule";
        $stmt = $connexion->query($sql);
        return $stmt->fetchAll(PDO::FETCH_CLASS, Vehicule::class);
    }

    public function create(){
        $connexion = Bdd::getInstance();
        $sql = "INSERT INTO vehicule
                (nom, description , image , modele ,en_vente)
                VALUES
                (:nom , :description , :image , :modele , :en_vente)
            ";
            echo $sql;
        $stmt = $connexion->prepare($sql );
        $stmt->execute([
            ":nom" => $this->nom ,
            ":description" => $this->description ,
            ":image" => $this->image,
            ":modele" => $this->modele,
            //":date_creation" => $this->date_creation,
            ":en_vente" => (Integer) $this->en_vente
        ]);
        return $stmt->rowCount(); 
    }

    public function lireLaSuite(int $nbMot = 10) :string{
       $descriptions = explode(" ", $this->description ) ;
       if(count($descriptions) < $nbMot ){
            return $this->description; 
       }
       $resultat = "";
       for($i = 0 ; $i < $nbMot ; $i++){
        $resultat .= " " . $descriptions[$i];
       }
       return $resultat . " ..."; 
    }

    public function readById($id) {
        $connexion = Bdd::getInstance();
        $sql = "SELECT * FROM vehicule WHERE id= '$id'";
        $stmt = $connexion->query($sql);
        return $stmt->fetchAll(PDO::FETCH_CLASS, Vehicule::class)[0]; 
    }

    public function update(){
        $connexion = Bdd::getInstance();
        $sql = "UPDATE vehicule 
                SET nom = :nom , description = :description , modele = :modele , image=:image, en_vente=:en_vente 
                WHERE id = :id";
        $stmt = $connexion->prepare($sql);
        $stmt->execute([
            ":id" => $this->id ,
            ":nom" => $this->nom ,
            ":description" => $this->description ,
            ":modele"    => $this->modele,
            ":image" => $this->image,
            ":en_vente" => (Integer) $this->en_vente
        ]);
        return $stmt->rowCount(); 
    }

    public function delete($id){
        $connexion = Bdd::getInstance();
        $sql = "DELETE FROM vehicule WHERE id = :id";
        $stmt = $connexion->prepare($sql);
        $stmt->execute([
            ":id" => $id 
        ]);
        return $stmt->rowCount(); 
    }

    

}