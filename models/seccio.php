<?php 

class Seccio {

	private $conn;
	private $idSeccio;
	private $nom;
    private $idCarta;

	public function __construct($db) {
		$this->conn = $db;
    }
    

	public function read() {
		$query = "SELECT * FROM seccio";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt->get_result();
	}


	public function readByIdSeccio() {
		$query = "SELECT * FROM seccio WHERE idSeccio = ? LIMIT 1";
		$stmt = $this->conn->prepare($query);
		$stmt->bind_param('i', $this->idSeccio);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->fetch_assoc();
	}

	public function readByIdCarta() {
		$query = "SELECT * FROM seccio WHERE carta_idCarta = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bind_param('i', $this->idCarta);
		$stmt->execute();
		return $stmt->get_result();
	}

	public function create() {
		$query = "INSERT INTO seccio (nom, carta_idCarta) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
		$stmt->bind_param('si', $this->nom,$this->idCarta);
		if ($stmt->execute()) {
		 	return true;
		}
		return false;
    }
    

	public function update() {
		$query = "UPDATE seccio SET  idSeccio = ?, nom = ?, carta_idCarta = ? WHERE idSeccio = ?";
        $stmt = $this->conn->prepare($query);
		$stmt->bind_param('isii', $this->idSeccio, $this->nom,$this->idCarta,$this->idSeccio);
		if ($stmt->execute()) {
		 	return true;
		}
		return false;
    }
    

	public function delete() {
		$query = "DELETE FROM seccio WHERE idSeccio = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bind_param('i', $this->idSeccio);
		if ($stmt->execute()) {
		 	return true;
		}
		return false;
	}
	
	public function delete1() {
		$query = "DELETE FROM seccio WHERE idSeccio = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bind_param('i', $this->idSeccio);
		if ($stmt->execute()) {
		 	return true;
		}
		return false;
    }
    

	public function getIdSeccio() {
		return $this->idSeccio;
	}

	public function getNom() {
		return $this->nom;
	}

	public function getIdCarta() {
		return $this->idCarta;
    }
    

	public function setIdSeccio($idSeccio) {
		$this->idSeccio = $idSeccio;
	}

	public function setNom($nom) {
		$this->nom = $nom;
	}

	public function setIdCarta($idCarta) {
		$this->idCarta = $idCarta;
    }

}

?>