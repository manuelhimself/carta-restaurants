<?php
class categoria{

    private $conn;

    //Properties
    private $id;
    private $nom;

    //Constructor
    public function __construct($db){
        $this->conn = $db;
    }

    //Get establiments
    public function read() {
        $query = "SELECT * FROM
                categoria";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->get_result();
    }

    //GETTERS

    //id
    public function getId(){
        return $this->id;
    }

    //nom
    public function getNom(){
        return $this->nom;
    }


    //SETTERS

    //id
    public function setId($id) {
        $this->id = $id;
    }

    //nom
    public function setNom($nom) {
        $this->nom = $nom;
    }

}
?>
