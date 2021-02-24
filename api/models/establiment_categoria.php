<?php
class establiment_categoria
{

    private $conn;

    //Properties
    private $Establiment_id;
    private $Categoria_id;

    //Constructor
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Delete establiment categories
    public function delete()
    {
        $query = "DELETE FROM categoria_establiment WHERE Establiment_id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $this->Establiment_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    //Insert establiment_categoria
    public function insert()
    {
        $query = "INSERT IGNORE INTO categoria_establiment (Establiment_id, Categoria_id)
      VALUES (?, ?)";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('ii', $this->Establiment_id, $this->Categoria_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    //GETTERS

    //Establiment_id
    public function getEstabliment_id()
    {
        return $this->Establiment_id;
    }

    //Categoria_id
    public function getCategoria_id()
    {
        return $this->Categoria_id;
    }


    //SETTERS

    //Establiment_id
    public function setEstabliment_id($Establiment_id)
    {
        $this->Establiment_id = $Establiment_id;
    }

    //Categoria_id
    public function setCategoria_id($Categoria_id)
    {
        $this->Categoria_id = $Categoria_id;
    }
}
