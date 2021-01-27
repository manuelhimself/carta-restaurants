<?php 

class Carta {

	private $conn;
	private $idCarta;
	private $nom;
    private $actiu;


	public function __construct($db) {
		$this->conn = $db;
    }
    

	public function read() {
		$query = "SELECT * FROM carta";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt->get_result();
	}


	public function readById() {
		$query = "SELECT * FROM carta WHERE idCarta = ? LIMIT 1";
		$stmt = $this->conn->prepare($query);
		$stmt->bind_param('i', $this->idCarta);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->fetch_assoc();
	}

	public function create() {
		$query = "INSERT INTO carta (idCarta, nom, actiu) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
		$stmt->bind_param('isi', $this->idCarta, $this->nom,$this->actiu);
		if ($stmt->execute()) {
		 	return true;
		}
		return false;
    }
    

	public function update() {
		$query = "UPDATE plat SET  idPlat = ?, nom = ?, descripcio = ?, preu = ?, Seccio_idSeccio WHERE idPlat = ?";
        $stmt = $this->conn->prepare($query);
        $doublePreu = doubleval($this->preu);
		$stmt->bind_param('issdii', $this->idPlat, $this->nom,$this->descripcio,$doublePreu,$this->idSeccio, $this->idPlat);
		if ($stmt->execute()) {
		 	return true;
		}
		return false;
	}
	
	public function updateEstatActiu() {
		$query = "UPDATE plat SET  idPlat = ?, nom = ?, descripcio = ?, preu = ?, Seccio_idSeccio WHERE idPlat = ?";
        $stmt = $this->conn->prepare($query);
        $doublePreu = doubleval($this->preu);
		$stmt->bind_param('issdii', $this->idPlat, $this->nom,$this->descripcio,$doublePreu,$this->idSeccio, $this->idPlat);
		if ($stmt->execute()) {
		 	return true;
		}
		return false;
    }
    

	public function delete() {
		$query = "DELETE FROM plat WHERE idPlat = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bind_param('i', $this->idPlat);
		if ($stmt->execute()) {
		 	return true;
		}
		return false;
    }
    

	public function getIdCarta() {
		return $this->idCarta;
	}

	public function getNom() {
		return $this->nom;
    }
    
    public function getActiu() {
		return $this->actiu;
    }
    
	public function setIdCarta($idCarta) {
		$this->idCarta = $idCarta;
	}

	public function setNom($nom) {
		$this->nom = $nom;
	}

	public function setActiu($actiu) {
		$this->actiu = $actiu;
    }

}

?>