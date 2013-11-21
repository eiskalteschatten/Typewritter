<?php
	require_once("database.php");
	require_once("author.php");

	// Class for all posts

	class Allposts {
		private $database = null;
		private $id;
		private $author;

		function __construct() {
			try { 
				$this->database = new Database();			
			}
			catch(Exception $e) {
				die($e);
			}
		}
	
		function getAllPosts($limit=null) {
			// Get all posts with or without a limit
			$table = $this->database->postsTable;
			return $this->database->selectAllFromTable($table, $limit);
		}
		
		function needsInstall() {
			return $this->database->needsInstall();
		}
	}
?>