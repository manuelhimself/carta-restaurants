<?php

class categoria{

    private $conn;

    //Properties
    private $id;
    private $nom;
    private $idEstabliment;

    //Constructor
     public function __construct($db){
        $this->conn = $db;
    }

    public function getCategories(){
        $query = "SELECT categoria.nom FROM categoria, categoria_establiment, establiment 
        WHERE categoria_establiment.Categoria_id = categoria.id AND categoria_establiment.Establiment_id = ?"

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $this->idEstabliment);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
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

