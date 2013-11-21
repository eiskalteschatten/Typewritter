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
	
		function getAllPosts($limit = null, $offset = null) {
			// Get all posts with or without a limit and with or without an offset
			$table = $this->database->postsTable;
			return $this->database->selectAllFromTable($table, $limit, $offset);
		}
		
		function needsInstall() {
			return $this->database->needsInstall();
		}
		
		function getNumPosts() {
			// Get the number of posts
			$table = $this->database->postsTable;
			return $this->database->countFromTable($table);
		}
	}
?>