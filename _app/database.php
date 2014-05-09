<?php
	require_once(__DIR__.'/../config.php');

	// Database controller
	
	class Database {
		private $connection = null;
		private $database = null;

		public $generalTable = "tw_general";
		public $postsTable = "tw_posts";
		public $commentsTable = "tw_comments";
		public $usersTable = "tw_users";
		public $categoriesTable = "tw_categories";
	
		function __construct() {
			try {
				if (!$this->connection) {
					// Establish a connection to MySQL if it doesn't already exist and select the database defined in config.php. Die if no connection could be established.
					$this->connection = new mysqli(dbHost.":".dbPort, dbUser, dbPassword, dbName) or die("Could not connect to the database \"".dbName."\"!\n" + mysqli_error());
				}
			}
			catch(Exception $e) {
				die($e);
			}
		}
		
		function __destruct() {
			try {
				if ($this->connection) {
					// Close the connection to MySQL if it exists
					mysqli_close($this->connection);
				}
			}
			catch(Exception $e) {
				die($e);
			}		
		}
	
		function initDatabase() {
			try {
				$result = $this->needsInstall();
				
				if ($result) {
					if ($result->num_rows == 0) {		// Check to see if there are any rows in the database defined in config.php. If not, then no installation has occurred.
						// Create tables using a standard query since there is no risk of MySQL injections at this point
						$this->connection->query("CREATE TABLE ".$this->generalTable."(
							id INT NOT NULL AUTO_INCREMENT, 
							PRIMARY KEY(id))") or die("An error has occured! ".mysqli_error());
						
						$this->connection->query("CREATE TABLE ".$this->postsTable."(
							id INT NOT NULL AUTO_INCREMENT, 
							PRIMARY KEY(id), 
							title TEXT, 
							markdown TEXT, 
							html TEXT, 
							author INT, 
							categories TEXT, 
							tags TEXT, 
							published BOOL, 
							publication_date DATETIME, 
							date_created DATETIME, 
							date_published DATETIME, 
							date_updated DATETIME)") or die("An error has occured! ".mysqli_error());
						
						$this->connection->query("CREATE TABLE ".$this->commentsTable."(
							id INT NOT NULL AUTO_INCREMENT, 
							PRIMARY KEY(id), 
							post INT, 
							body TEXT, 
							author_name TEXT, 
							author_email TEXT, 
							date_created DATETIME, 
							date_updated DATETIME)") or die("An error has occured! ".mysqli_error());
						
						$this->connection->query("CREATE TABLE ".$this->usersTable."(
							id INT NOT NULL AUTO_INCREMENT, 
							PRIMARY KEY(id), 
							name TEXT, 
							author_email TEXT, 
							username VARCHAR(25), 
							password VARCHAR(25), 
							date_created DATETIME, 
							date_updated DATETIME)") or die("An error has occured! ".mysqli_error());
                                                
						$this->connection->query("CREATE TABLE ".$this->categoriesTable."(
							id INT NOT NULL AUTO_INCREMENT, 
							PRIMARY KEY(id), 
							name TEXT, 
							parent INT, 
							date_created DATETIME, 
							date_updated DATETIME)") or die("An error has occured! ".mysqli_error());
                                                
							// Get the current date and time
							$date = $this->getTimeDate();
							
							$this->connection->query("INSERT INTO ".$this->categoriesTable." (name, date_created, date_updated) VALUES ('".defaultCategory."', '".$date."', '".$date."')");

					
						// Fill in default options
					
					}
					else {
						die("TypeWritter is already installed!");
					}
				}
			}
			catch(Exception $e) {
				die($e);
			}
		}
		
		function needsInstall() {
			// Return true if it doesn't need to be installed. Assume installation is needed if the table "tw_general" doesn't exist.
			return ($this->connection->query("DESCRIBE tw_general") === false ? TRUE : FALSE);
		}
		
		function selectAllFromRow($table, $id) {
			try {
				// Generic select statement to get all information from a row in a table in the database
				$results = array();
				$result = $this->connection->query("SELECT * FROM ".$table." WHERE ID=".$id) or die("An error has occured! ".mysqli_error());
			    
			    $results = $result->fetch_assoc();
			    $result->close();
			    
			   	return $results;
			}
			catch(Exception $e) {
				die($e);
			}
		}
		
		function selectFromRow($table, $column, $id) {
			try {
				// Generic select statement to get small bits of information from the database
				$results = array();
				$result = $this->connection->query("SELECT ".$column." FROM ".$table." WHERE ID=".$id) or die("An error has occured! ".mysqli_error());
			    
			    while ($row = $result->fetch_assoc()) {
					$results[] = $row[$column];
				}
			    
			    $result->close();
			    
			   	return $results;
			}
			catch(Exception $e) {
				die($e);
			}
		}

		function selectAllFromTable($table, $limit = null, $offset = null) {
			try {
				// Generic select statement to get all information from a table in the database
				
				$query = "SELECT * FROM ".$table;
				
				if ($limit) {  			// Add limit if there is one
					$query .= " LIMIT ".$limit;
				}
				
				if ($offset) {			// Add offset if there is one
					$query .= " OFFSET ".$offset;
				}
				
				$results = array();
				$result = $this->connection->query($query) or die("An error has occured! ".mysqli_error());
			    
			    while ($row = $result->fetch_assoc()) {
					$results[] = $row;
				}
				
			    $result->close();
			    
			   	return $results;
			}
			catch(Exception $e) {
				die($e);
			}
		}

		function insertIntoPost($title, $markdown, $html, $author, $published, $categories, $tags) {
			try {
				// Get the current date and time
				$date = $this->getTimeDate();
                            
				// Insert into the posts table using prepared statements to avoid MySQL injections.
				$stmt = $this->connection->prepare("INSERT INTO ".$this->postsTable." (title, markdown, html, author, published, date_created, date_updated, categories, tags) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
 				$stmt->bind_param('sssiissss', $title, $markdown, $html, $author, $published, $date, $date, $categories, $tags);
 				$stmt->execute();
			    $stmt->close();

				return $this->connection->insert_id;
			}
			catch(Exception $e) {
				die($e);
			}
		}

		function updatePost($title, $markdown, $html, $author, $published, $id, $categories, $tags) {
			try {
				// Get the current date and time
				$date = $this->getTimeDate();
                
				// Update the posts table using prepared statements to avoid MySQL injections.
				$stmt = $this->connection->prepare("UPDATE ".$this->postsTable." SET title = ?, markdown = ?, html = ?, author = ?, published = ?, date_updated = ?, categories = ?, tags = ? where id = ?");
 				$stmt->bind_param('sssiisssi', $title, $markdown, $html, $author, $published, $date, $categories, $tags, $id);
 				$stmt->execute();
			    $stmt->close();
			}
			catch(Exception $e) {
				die($e);
			}
		}
                
		function deleteRowFromTable($table, $key) {
				// Delete a row from a table
				return $this->connection->query("DELETE FROM ".$table." where id = ".$key) or die("An error has occured! ".mysqli_error());
		}
		
		function createCategory($name, $parent) {
			try {
				// Get the current date and time
				$date = $this->getTimeDate();
                            
				// Insert into the category table using prepared statements to avoid MySQL injections.
				$stmt = $this->connection->prepare("INSERT INTO ".$this->categoriesTable." (name, parent, date_created, date_updated) VALUES (?, ?, ?, ?)");
 				$stmt->bind_param('siss', $name, $parent, $date, $date);
 				$result = $stmt->execute();
				$stmt->close();

				return $result;
			}
			catch(Exception $e) {
				die($e);
			}
		}
		
		function countFromTable($table) {
			try {
				// Get the number of rows in a table
				$result = $this->connection->query("SELECT * FROM ".$table) or die("An error has occured! ".mysqli_error());
				return $result->num_rows;
			}
			catch(Exception $e) {
				die($e);
			}
		}
                
		function getTimeDate() {
			// Set timezone and return today's date
			date_default_timezone_set(timeZone);
			return date(timeFormat);
		}
	}
?>