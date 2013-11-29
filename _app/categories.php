<?php
	require_once("database.php");

	// Class for categories

	class Categories {
		private $database = null;
		private $id;

		function __construct() {
			try { 
				$this->database = new Database();			
			}
			catch(Exception $e) {
				die($e);
			}
		}
	}
?>