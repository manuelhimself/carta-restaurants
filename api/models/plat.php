<?php 

class Plat {

	private $conn;
	private $idPlat;
	private $nom;
    private $descripcio;
    private $preu;
    private $idSeccio;
	private $idAlergen;

	public function __construct($db) {
		$this->conn = $db;
    }
    
	public function read() {
		$query = "SELECT * FROM plat";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt->get_result();
	}


	public function readById() {
		$query = "SELECT * FROM plat WHERE idPlat = ? LIMIT 1";
		$stmt = $this->conn->prepare($query);
		$stmt->bind_param('i', $this->idPlat);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->fetch_assoc();
	}

	public function readBySeccio() {
		$query = "SELECT * FROM plat WHERE Seccio_idSeccio = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bind_param('i', $this->idSeccio);
		$stmt->execute();
		return $stmt->get_result();
	}

	public function readByIdAlergen() {
		$query = "SELECT plat.nom, plat.descripcio, plat.preu, plat.idPlat, alergen.id FROM restaurants.plat, restaurants.alergen, restaurants.plat_alergen, restaurants.seccio 
		where plat.idPlat = plat_alergen.Plat_idPlat and plat_alergen.Alergen_id = alergen.id and alergen.id = ? and plat.Seccio_idSeccio = seccio.idSeccio 
		and seccio.idSeccio = ?;";
		$stmt = $this->conn->prepare($query);
		$stmt->bind_param('ii', $this->idAlergen, $this->idSeccio);
		$stmt->execute();
		return $stmt->get_result();
	}

	public function createPlat() {
		$query = "INSERT INTO plat (nom, descripcio, preu, Seccio_idSeccio) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $doublePreu = doubleval($this->preu);
		$stmt->bind_param('ssdi', $this->nom,$this->descripcio,$doublePreu,$this->idSeccio);
		if ($stmt->execute()) {
			return true;
		}
		return false;
    }

	public function createAlergenPlat() {
		$query = "INSERT INTO plat_alergen (Alergen_id, Plat_idPlat) VALUES (?,?)";
        $stmt = $this->conn->prepare($query);
		$stmt->bind_param('ii', $this->idAlergen,$this->idPlat);
		if ($stmt->execute()) {
			return true;
		}
		return false;
    }
    

	public function update() {
		$query = "UPDATE plat SET nom = ?, descripcio = ?, preu = ? WHERE idPlat = ?";
        $stmt = $this->conn->prepare($query);
        $doublePreu = doubleval($this->preu);
		$stmt->bind_param('ssdi', $this->nom,$this->descripcio,$doublePreu, $this->idPlat);
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

	public function getIdAlergen() {
		return $this->idAlergen;
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

	public function setIdAlergen($idAlergen) {
		$this->idAlergen = $idAlergen;
	}
}

?>