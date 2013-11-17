<?php
	require_once("database.php");
	require_once("author.php");

	// Class for posts

	class Post {
		private $database = null;
		private $id;
		private $author;
	
		function __construct($id) {
			try { 
				$this->setId($id);
				$this->setAuthor("");
				$this->database = new Database();			
			}
			catch(Exception $e) {
				die($e);
			}
		}
	
		function save($title, $body, $published) {
			//$author = $this->getAuthor();
			//$author->getId();
		
			// Get today's date
			$date = date('Y-m-d H:i:s');
			
			if ($this->getId() != "") {
				// Update the post if an ID already exists
				$this->database->updatePost($title, $body, $date, $this->getId());
			}
			else {
				if (!$published || $published == "") {
					// Automatically set published to false when saving if it hasn't been published already
					$published = 0;
				}
				
				// If an ID does not exist, insert the post into the database. The function returns the new ID.
				$id = $this->database->insertIntoPost($title, $body, 1, $published, $date);
				
				// Set the new post ID.
				$this->setId($id);
			}
		}
		
		function getId() {
			return $this->id;
		}
		
		function setId($id) {
			$this->id = $id;
		}
		
		function getAuthor() {
			return $this->author;
		}
		
		function setAuthor($author) {
			$this->author = $author;
		}
	}
?>