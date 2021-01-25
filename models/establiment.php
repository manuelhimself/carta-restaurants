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
    $query = "SELECT * FROM
                establiment
                    WHERE id = ? LIMIT 1";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param('i', $this->id);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_assoc();
  }

  //Get establiment by name
  public function readByNom() {
      $query = "SELECT * FROM
                  establiment
                  WHERE nom LIKE ? LIMIT 50";
      $stmt = $this->conn->prepare($query);
      $stmt->bind_param('s', $this->nom);
      $stmt->execute();
      $result = $stmt->get_result();

      return $result->fetch_assoc();
  }

  //Create user
  public function create(){
      $query = "INSERT INTO establiment (nom, correu_electronic, 
      num_comensals, telefon, Poblacio_id, password)
      VALUES (?, ?, ?, ?, ?, ?)";

      $stmt = $this->conn->prepare($query);
      $stmt->bind_param('ssiiis', $this->nom, $this->correu_electronic, 
      $this->num_comensals, $this->telefon, $this->poblacio_id, $this->password);
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
        password = ?

			WHERE id = ?";

		$stmt = $this->conn->prepare($query);
    $stmt->bind_param('ssiiisi', $this->nom, $this->correu_electronic, $this->num_comensals, $this->telefon, $this->poblacio_id, $this->password, $this->id);

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
  public function getpoblacio_id(){
    return $this->poblacio_id;
  }

  //password
  public function getpassword(){
     return $this->password;
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
    
  //
  public function setPoblacio_id($poblacio_id) {
		$this->poblacio_id = $poblacio_id;
  }
    
  //id
  public function setPassword($password) {
		$this->password = $password;
	}
}

