<?php 

class Carta {

	private $conn;
	private $idCarta;
	private $nom;
	private $actiu;
	private $idEstabliment;


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

	public function readByIdEstabliment() {
		$query = "SELECT carta.nom, carta.idCarta, carta.actiu from carta, carta_establiment where carta.idCarta = carta_establiment.Carta_idCarta and carta_establiment.Establiment_id = ?;";
		$stmt = $this->conn->prepare($query);
		$stmt->bind_param('i', $this->idEstabliment);
		$stmt->execute();
		return $stmt->get_result();
	}

	public function create() {
		$query = "INSERT INTO carta (nom) VALUES (?)";
        $stmt = $this->conn->prepare($query);
		$stmt->bind_param('s', $this->nom);
		if ($stmt->execute()) {
			$idCarta = $this->conn->insert_id;
			$query = "INSERT INTO carta_establiment (Carta_idCarta, Establiment_id) VALUES (?,?)";
			$stmt = $this->conn->prepare($query);
			$stmt->bind_param('ii', $idCarta,$this->idEstabliment);
			if ($stmt->execute()) {
				 return true;
			}
			return false;
		}
		return false;
	}

	public function update() {
		$query = "UPDATE carta SET nom = ? WHERE idCarta = ?";
        $stmt = $this->conn->prepare($query);
		$stmt->bind_param('si', $this->nom, $this->idCarta);
		if ($stmt->execute()) {
		 	return true;
		}
		return false;
	}
	
	public function updateEstatActivar() {
		$query = "UPDATE carta SET  actiu = 1 WHERE idCarta = ?";
        $stmt = $this->conn->prepare($query);
		$stmt->bind_param('i', $this->idCarta);
		if ($stmt->execute()) {
		 	return true;
		}
		return false;
	}
	
	public function updateEstatDesactivar() {
		$query = "UPDATE carta SET  actiu = 0 WHERE idCarta = ?";
        $stmt = $this->conn->prepare($query);
		$stmt->bind_param('i', $this->idCarta);
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
	
	public function delete1() {
		$query = "DELETE FROM carta WHERE idCarta = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bind_param('i', $this->idCarta);
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
	
	public function getIdEstabliment() {
		return $this->idEstabliment;
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
	
	public function setIdEstabliment($idEstabliment) {
		$this->idEstabliment = $idEstabliment;
    }

}
