<?php 

class Plat {

	private $conn;
	private $idPlat;
	private $nom;
    private $descripcio;
    private $preu;
    private $idSeccio;


	public function __construct($db) {
		$this->conn = $db;
    }
    

	public function read() {
		$query = "SELECT * FROM Plat";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt->get_result();
	}


	public function readById() {
		$query = "SELECT * FROM Plat WHERE idPlat = ? LIMIT 1";
		$stmt = $this->conn->prepare($query);
		$stmt->bind_param('i', $this->idPlat);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->fetch_assoc();
	}

	public function readBySeccio() {
		$query = "SELECT * FROM Plat WHERE Seccio_idSeccio = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bind_param('i', $this->idSeccio);
		$stmt->execute();
		return $stmt->get_result();
	}

	public function create() {
		$query = "INSERT INTO Plat (idPlat, nom, descripcio, preu, Seccio_idSeccio) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $doublePreu = doubleval($this->preu);
		$stmt->bind_param('issdi', $this->idPlat, $this->nom,$this->descripcio,$doublePreu,$this->idSeccio);
		if ($stmt->execute()) {
		 	return true;
		}
		return false;
    }
    

	public function update() {
		$query = "UPDATE Plat SET  idPlat = ?, nom = ?, descripcio = ?, preu = ?, Seccio_idSeccio WHERE idPlat = ?";
        $stmt = $this->conn->prepare($query);
        $doublePreu = doubleval($this->preu);
		$stmt->bind_param('issdii', $this->idPlat, $this->nom,$this->descripcio,$doublePreu,$this->idSeccio, $this->idPlat);
		if ($stmt->execute()) {
		 	return true;
		}
		return false;
    }
    

	public function delete() {
		$query = "DELETE FROM Plat WHERE idPlat = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bind_param('i', $this->idPlat);
		if ($stmt->execute()) {
		 	return true;
		}
		return false;
    }
    

	public function getIdPlat() {
		return $this->idPlat;
	}

	public function getNom() {
		return $this->nom;
	}

	public function getDescripcio() {
		return $this->descripcio;
    }
    
    public function getPreu() {
		return $this->preu;
    }
    
    public function getIdSeccio() {
		return $this->idSeccio;
    }
    

	public function setIdPlat($idPlat) {
		$this->idPlat = $idPlat;
	}

	public function setNom($nom) {
		$this->nom = $nom;
	}

	public function setDescripcio($descripcio) {
		$this->descripcio = $descripcio;
    }
    
    public function setPreu($preu){
        $this->preu = $preu;
    }

    public function setIdSeccio($idSeccio){
        $this->idSeccio = $idSeccio;
    }

}

 ?>