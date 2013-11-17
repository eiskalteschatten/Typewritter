<?php
	require_once("database.php");

	// Class for posts

	class Post {
		private $database = null;
	
		function __construct() {
			try { 
				$this->database = new Database();
			}
			catch(Exception $e) {
				die($e);
			}
		}
	
		function saveDraft() {
			
		}
	}
?>