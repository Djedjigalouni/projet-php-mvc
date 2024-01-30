
<?php 

class User{

    private $id ;
    private $email;
    private $password ;
    private $role ;
    private $dt_creation ; 


    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of role
     */ 
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */ 
    public function setRole($role)
    {
        $this->role = $role;

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

    public function create(){
        $connexion = Bdd::getInstance() ; 
        $login = '';
        $password = "', '') ;DELETE FROM user ; -- '"; // injection SQL
        // utilisateur en utilisant les formulaires réussi à exécuter du code SQL que tu n'as pas prévu 
        $sql = "INSERT INTO user 
        (email , password, role )
        VALUES 
        (:email, :password, :role)";
        $stmt= $connexion->prepare($sql); // requete préparée
        $stmt->execute([
            ":email" => $this->email ,
            ":password" => $this->password ,
            ":role" => $this->role 
        ]);
        return $stmt->rowCount(); 
    }

    public function readOne($id){
        $connexion = Bdd::getInstance();
        $sql = "SELECT * FROM user WHERE id = :id";
        $stmt = $connexion->prepare($sql);
        $stmt->execute([":id" => $id]);
        return $stmt->fetchObject(User::class);
    }

    public function readAll(){
        $connexion = Bdd::getInstance();
        $sql = "SELECT * FROM user";
        $stmt = $connexion->query($sql);
        return $stmt->fetchAll(PDO::FETCH_CLASS, User::class);
    }

    public function update($id){
        $connexion = Bdd::getInstance();
        $sql = "UPDATE user 
                SET email = :email , password = :password , role = :role 
                WHERE id = :id";
        $stmt = $connexion->prepare($sql);
        $stmt->execute([
            ":id" => $id ,
            ":email" => $this->email ,
            ":password" => $this->password ,
            ":role"    => $this->role
        ]);
        return $stmt->rowCount(); 
    }

    public function delete($id){
        $connexion = Bdd::getInstance();
        $sql = "DELETE FROM user WHERE id = :id";
        $stmt = $connexion->prepare($sql);
        $stmt->execute([
            ":id" => $id 
        ]);
        return $stmt->rowCount(); 
    }

}