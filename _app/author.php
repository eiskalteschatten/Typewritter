<?php
	require_once("database.php");

	// Class for authors

	class Author {
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