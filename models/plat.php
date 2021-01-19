<?php 

class Plat {

	private $conn;

	// Properties
	private $id;
	private $username;
	private $privileges;

	// Constructor
	public function __construct($db) {
		$this->conn = $db;
	}

	// Get users
	public function read() {
		$query = "SELECT * FROM users";

		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		
		return $stmt->get_result();
	}

	// Get user
	public function readById() {
		$query = "SELECT * FROM
			users
			WHERE id = ? LIMIT 1";

		$stmt = $this->conn->prepare($query);
		$stmt->bind_param('i', $this->id);
		$stmt->execute();
		$result = $stmt->get_result();

		return $result->fetch_assoc();
	}

	// Create user
	public function create() {
		$query = "INSERT INTO
			users (username, privileges)
			VALUES (?, ?)";

		$stmt = $this->conn->prepare($query);
		$stmt->bind_param('ss', $this->username, $this->privileges);

		if ($stmt->execute()) {
		 	return true;
		}
		return false;
	}

	// Update user
	public function update() {
		$query = "UPDATE
			users
			SET 
				username = ?, 
				privileges = ?
			WHERE id = ?";

		$stmt = $this->conn->prepare($query);
		$stmt->bind_param('ssi', $this->username, $this->privileges, $this->id);

		if ($stmt->execute()) {
		 	return true;
		}
		return false;
	}

	// Delete user
	public function delete() {
		$query = "DELETE FROM
			users
			WHERE
				id = ?";

		$stmt = $this->conn->prepare($query);
		$stmt->bind_param('i', $this->id);

		if ($stmt->execute()) {
		 	return true;
		}
		return false;
	}

	// Get
	public function getId() {
		return $this->id;
	}

	public function getUsername() {
		return $this->username;
	}

	public function getPrivileges() {
		return $this->privileges;
	}

	// Set
	public function setId($id) {
		$this->id = $id;
	}

	public function setUsername($username) {
		$this->username = $username;
	}

	public function setPrivileges($privileges) {
		$this->privileges = $privileges;
	}

}

 ?>