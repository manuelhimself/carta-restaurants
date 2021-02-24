<?php

class establiment
{

  private $conn;

  //Properties
  private $id;
  private $nom;
  private $correu_electronic;
  private $num_comensals;
  private $telefon;
  private $poblacio_id;
  private $password;
  private $descripcio;
  private $lat;
  private $lng;

  //Constructor
  public function __construct($db)
  {
    $this->conn = $db;
  }

  //Get establiments
  public function read()
  {
    $query = "SELECT * FROM
                establiment";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->get_result();
  }

  //Get establiment by id
  public function readById()
  {
    $query = "SELECT categoria.id AS id_categoria, establiment.id, establiment.nom, establiment.correu_electronic, establiment.num_comensals, 
    establiment.telefon, establiment.Poblacio_id, establiment.descripcio, establiment.lat, establiment.lng FROM categoria, categoria_establiment, establiment 
    WHERE categoria_establiment.Categoria_id = categoria.id AND categoria_establiment.Establiment_id = establiment.id AND establiment.id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param('i', $this->id);
    $stmt->execute();
    return $stmt->get_result();
  }

  //Get establiment by name
  public function readByNom()
  {
    $query = "SELECT categoria.id AS id_categoria, 
    establiment.id, establiment.nom, establiment.correu_electronic, establiment.num_comensals, 
    establiment.telefon, establiment.Poblacio_id, establiment.descripcio 
    FROM categoria, categoria_establiment, establiment 
    WHERE categoria_establiment.Categoria_id = categoria.id 
    AND categoria_establiment.Establiment_id = establiment.id 
    AND establiment.nom LIKE ? LIMIT 50";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param('s', $this->nom);
    $stmt->execute();

    return $stmt->get_result();
  }

  //Create user
  public function create()
  {
    $query = "INSERT INTO establiment (nom, correu_electronic, 
      num_comensals, telefon, Poblacio_id, password, descripcio)
      VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $this->conn->prepare($query);
    $stmt->bind_param(
      'ssiiiss',
      $this->nom,
      $this->correu_electronic,
      $this->num_comensals,
      $this->telefon,
      $this->poblacio_id,
      $this->password,
      $this->descripcio
    );
  }

  public function setCoordenades()
  {
    //die(var_dump($this->id));
    $query = "UPDATE establiment SET lat = ?, lng = ? WHERE id = ?";

    $stmt = $this->conn->prepare($query);
    $stmt->bind_param('ddi', $this->lat, $this->lng, $this->id);

    if ($stmt->execute()) {
      return true;
    }
    return false;
  }

  // Update user

  public function updateNom()
  {
    $query = "UPDATE
			establiment
			SET 
				nom = ?
			WHERE id = ?";

    $stmt = $this->conn->prepare($query);
    $stmt->bind_param('si', $this->nom, $this->id);

    if ($stmt->execute()) {
      return true;
    }
    return false;
  }

  public function updateDescripcio()
  {
    $query = "UPDATE
			establiment
			SET 
        descripcio = ?
			WHERE id = ?";

    $stmt = $this->conn->prepare($query);
    $stmt->bind_param('si', $this->descripcio, $this->id);

    if ($stmt->execute()) {
      return true;
    }
    return false;
  }

  public function updateOthers()
  {
    $query = "UPDATE
			establiment
			SET 
				correu_electronic = ?,
        num_comensals = ?,
        telefon = ?,
        Poblacio_id = ?
			WHERE id = ?";

    $stmt = $this->conn->prepare($query);
    $stmt->bind_param('siiii', $this->correu_electronic, $this->num_comensals, $this->telefon, $this->poblacio_id, $this->id);

    if ($stmt->execute()) {
      return true;
    }
    return false;
  }

  //Check user
  public function checkEstabliment()
  {
    $query = "SELECT id FROM establiment WHERE correu_electronic = ? AND password = ?;";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param('ss', $this->correu_electronic, $this->password);
    $stmt->execute();

    return $stmt->get_result();
  }

  // Delete user
  public function delete()
  {
    $query = "DELETE FROM establiment WHERE id = ?";

    $stmt = $this->conn->prepare($query);
    $stmt->bind_param('i', $this->id);

    if ($stmt->execute()) {
      return true;
    }
    return false;
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

  //correu_electronic
  public function getCorreu_electronic()
  {
    return $this->correu_electronic;
  }

  //comensals
  public function getNum_coemnsals()
  {
    return $this->num_comensals;
  }

  //telefon
  public function getTelefon()
  {
    return $this->telefon;
  }

  //poblacio_id
  public function getPoblacio_id()
  {
    return $this->poblacio_id;
  }

  //password
  public function getPassword()
  {
    return $this->password;
  }

  //password
  public function getDescripcio()
  {
    return $this->descripcio;
  }

  //id
  public function getLat()
  {
    return $this->lat;
  }

  //id
  public function getLng()
  {
    return $this->lng;
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

  //correu_electronic
  public function setCorreu_electronic($correu_electronic)
  {
    $this->correu_electronic = $correu_electronic;
  }

  //num_comensals
  public function setNum_comensals($num_comensals)
  {
    $this->num_comensals = $num_comensals;
  }

  //telefon
  public function setTelefon($telefon)
  {
    $this->telefon = $telefon;
  }

  //poblacio_id
  public function setPoblacio_id($poblacio_id)
  {
    $this->poblacio_id = $poblacio_id;
  }

  //password
  public function setPassword($password)
  {
    $this->password = $password;
  }

  //descripcio
  public function setDescripcio($descripcio)
  {
    $this->descripcio = $descripcio;
  }

  public function setLat($lat)
  {
    $this->lat = $lat;
  }

  public function setLng($lng)
  {
    $this->lng = $lng;
  }
}
