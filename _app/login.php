<?php
	require_once("database.php");

	// Checks if the user is loggedin
	
	session_start();
	
	if (!isset($_SESSION['loggedin'])) {
		header("Location: login.php");
	}

	// Class for login sessions

	class Login {
		private $database = null;
		private $id;
		private $author;
	
		function __construct($id) {
			try { 
				$this->setId($id);
				$this->database = new Database();
			}
			catch(Exception $e) {
				die($e);
			}
		}
	
		function getId() {
			return $this->id;
		}
		
		function setid($id) {
			$this->id = $id;
		}
	}
?>