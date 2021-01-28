<?php

class establiment {

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

  //Constructor
  public function __construct($db){
    $this->conn = $db;
  }

  //Get establiments
  public function read() {
    $query = "SELECT * FROM
                establiment";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->get_result();
  }

  //Get establiment by id
  public function readById() {
    $query = "SELECT categoria.nom AS nom_categoria, establiment.* FROM categoria, categoria_establiment, establiment 
    WHERE categoria_establiment.Categoria_id = categoria.id AND categoria_establiment.Establiment_id = establiment.id AND establiment.id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param('i', $this->id);
    $stmt->execute();
    
    return $stmt->get_result();
  }

  //Get establiment by name
  public function readByNom() {
      $query = "SELECT * FROM
                  establiment
                  WHERE nom LIKE ? LIMIT 50";
      $stmt = $this->conn->prepare($query);
      $stmt->bind_param('s', $this->nom);
      $stmt->execute();

      return $stmt->get_result();
  }

  //Create user
  public function create(){
      $query = "INSERT INTO establiment (nom, correu_electronic, 
      num_comensals, telefon, Poblacio_id, password, descripcio)
      VALUES (?, ?, ?, ?, ?, ?, ?)";

      $stmt = $this->conn->prepare($query);
      $stmt->bind_param('ssiiiss', $this->nom, $this->correu_electronic, 
      $this->num_comensals, $this->telefon, $this->poblacio_id, $this->password, $this->descripcio);
  }

  // Update user
  
  public function update() {
		$query = "UPDATE
			establiment
			SET 
				nom = ?, 
				correu_electronic = ?,
        num_comensals = ?,
        telefon = ?,
        Poblacio_id = ?,
        password = ?,
        descripcio = ?

			WHERE id = ?";

		$stmt = $this->conn->prepare($query);
    $stmt->bind_param('ssiiissi', $this->nom, $this->correu_electronic, $this->num_comensals, $this->telefon, $this->poblacio_id, $this->password, $this->descripcio, $this->id);

		if ($stmt->execute()) {
		 	return true;
		}
		return false;
  }
  
  // Delete user

  public function delete(){
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
  public function getId(){
    return $this->id;
  }

  //nom
  public function getNom(){
    return $this->nom;
  }

  //correu_electronic
  public function getCorreu_electronic(){
    return $this->correu_electronic;
  }

  //comensals
  public function getNum_coemnsals(){
    return $this->num_comensals;
  }

  //telefon
  public function getTelefon(){
    return $this->telefon;
  }

  //poblacio_id
  public function getPoblacio_id(){
    return $this->poblacio_id;
  }

  //password
  public function getPassword(){
     return $this->password;
  }

  //password
  public function getDescripcio(){
    return $this->descripcio;
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
    
  //correu_electronic
  public function setCorreu_electronic($correu_electronic) {
		$this->correu_electronic = $correu_electronic;
  }
    
  //num_comensals
  public function setNum_comensals($num_comensals) {
		$this->num_comensals = $num_comensals;
  }
    
  //telefon
  public function setTelefon($telefon) {
		$this->telefon = $telefon;
  }
    
  //poblacio_id
  public function setPoblacio_id($poblacio_id) {
		$this->poblacio_id = $poblacio_id;
  }
    
  //password
  public function setPassword($password) {
		$this->password = $password;
  }
  
  //descripcio
  public function setDescripcio($descripcio) {
		$this->descripcio = $descripcio;
	}
}

