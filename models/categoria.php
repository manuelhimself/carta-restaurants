<?php

class categoria{

    private $conn;

    //Properties
    private $id;
    private $nom;
    private $idEstabliment;

    


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

