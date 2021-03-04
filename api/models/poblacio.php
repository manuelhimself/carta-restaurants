<?php

class poblacio
{

    private $conn;

    //Properties
    private $id;
    private $nom;
    private $cp;

    //Constructor
    public function __construct($db)
    {
        $this->conn = $db;
    }

    //Get poblacions
    public function read()
    {
        $query = "SELECT * FROM
                poblacio";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->get_result();
    }

    //Get poblacio
    public function readById()
    {
        $query = "SELECT * FROM
                poblacio WHERE id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $this->id);
        $stmt->execute();
        return $stmt->get_result();
    }

    //GETTERS

    //id
    public function getId()
    {
        return $this->id;
    }

    //nom
    public function getNom()
    {
        return $this->nom;
    }

    //cp
    public function getCp()
    {
        return $this->nom;
    }


    //SETTERS

    //id
    public function setId($id)
    {
        $this->id = $id;
    }

    //nom
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    //cp
    public function setCp($cp)
    {
        $this->cp = $cp;
    }
}
