<?php
<<<<<<< Updated upstream

=======
>>>>>>> Stashed changes
class categoria{

    private $conn;

    //Properties
    private $id;
    private $nom;
<<<<<<< Updated upstream
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


=======

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

>>>>>>> Stashed changes
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
<<<<<<< Updated upstream

}
?>
=======
}
>>>>>>> Stashed changes
