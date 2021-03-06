<?php
	require_once("database.php");
	require_once("allposts.php");
	require_once("author.php");

	// Class for a single post

	class Post {
		private $database = null;
		private $id;
		private $author;
		private $categories;
		private $tags;

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
	
		function save($title, $markdown, $html, $published, $categories, $tags) {
			//$author = $this->getAuthor();
			//$author->getId();
		
			if (!$published || $published == "") {
				// Automatically set published to false when saving if it hasn't been published already
				$published = 0;
			}
			
			if ($this->getId() != "") {
				// Update the post if an ID already exists
				$this->database->updatePost($title, $markdown, $html, 1, $published, $this->getId(), $categories, $tags);
			}
			else {
				// If an ID does not exist, insert the post into the database. The function returns the new ID.
				$id = $this->database->insertIntoPost($title, $markdown, $html, 1, $published, $categories, $tags);
				
				// Set the new post ID.
				$this->setId($id);
			}
		}
		
		function getPost() {
			// Get all information about this post
			$table = $this->database->postsTable;
			return $this->database->selectAllFromRow($table, $this->getId());
		}
                
		function delete() {
			// Delete post
			$table = $this->database->postsTable;
			return $this->database->deleteRowFromTable($table, $this->getId());
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
		
		function getDateUpdated() {
			// Get last updated date from database
			$table = $this->database->postsTable;
			$date = $this->database->selectFromRow($table, 'date_updated', $this->getId());
		
			return $date[0];
		}
	}
?>