<?php 

class Alergen {

	private $conn;
	private $idAlergen;
	private $nom;
    private $idPlat;


	public function __construct($db) {
		$this->conn = $db;
    }
    

	public function read() {
		$query = "SELECT * FROM alergen";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt->get_result();
	}


	public function readById() {
		$query = "SELECT * FROM alergen WHERE id = ? LIMIT 1";
		$stmt = $this->conn->prepare($query);
		$stmt->bind_param('i', $this->idAlergen);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->fetch_assoc();
	}

	public function create() {
		$query = "INSERT INTO alergen (nom) VALUES (?)";
        $stmt = $this->conn->prepare($query);
		$stmt->bind_param('s', $this->nom);
		if ($stmt->execute()) {
			$idAlergen = $this->conn->insert_id;
			$query = "INSERT INTO plat_alergen (Aalergen_id, Plat_idPlat) VALUES (?,?)";
			$stmt = $this->conn->prepare($query);
			$stmt->bind_param('ii', $idAlergen,$this->idPlat);
			if ($stmt->execute()) {
				 return true;
			}
			return false;
		}
		return false;
	}

	public function update() {
		$query = "UPDATE alergen SET nom = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
		$stmt->bind_param('si', $this->nom, $this->idAlergen);
		if ($stmt->execute()) {
		 	return true;
		}
		return false;
	}
    
	public function delete() {
		$query = "DELETE FROM alergen WHERE id = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bind_param('i', $this->idAlergen);
		if ($stmt->execute()) {
		 	return true;
		}
		return false;
	}

	public function getIdAlergen() {
		return $this->idAlergen;
	}

	public function getNom() {
		return $this->nom;
    }
    
    public function getIdPlat() {
		return $this->idPlat;
	}
    
	public function setIdAlergen($idAlergen) {
		$this->idAlergen = $idAlergen;
	}

	public function setNom($nom) {
		$this->nom = $nom;
	}
	
	public function setIdPlat($idPlat) {
		$this->idPlat = $idPlat;
    }

}
