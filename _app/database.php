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
				$result = $this->connection->query("SHOW TABLES IN ".dbName);
				
				if ($result !== false) {
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
							published BOOL, 
							date_created DATETIME, 
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

		function selectAllFromTable($table, $limit=null) {
			try {
				// Generic select statement to get all information from a table in the database
				
				if ($limit) {  			// With limit
					$query = "SELECT * FROM ".$table." limit ".$limit;
				}
				else {			// Without limit
					$query = "SELECT * FROM ".$table;
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

		function insertIntoPost($title, $markdown, $html, $author, $published, $date) {
			try {
				// Insert into the posts table using prepared statements to avoid MySQL injections.
				$stmt = $this->connection->prepare("INSERT INTO ".$this->postsTable." (title, markdown, html, author, published, date_created, date_updated) VALUES (?, ?, ?, ?, ?, ?, ?)");
 				$stmt->bind_param('sssiiss', $title, $markdown, $html, $author, $published, $date, $date);
 				$stmt->execute();
			    $stmt->close();

				return $this->connection->insert_id;
			}
			catch(Exception $e) {
				die($e);
			}
		}

		function updatePost($title, $markdown, $html, $author, $published, $date, $id) {
			try {
				// Update the posts table using prepared statements to avoid MySQL injections.
				$stmt = $this->connection->prepare("UPDATE ".$this->postsTable." SET title = ?, markdown = ?, html = ?, author = ?, published = ?, date_updated = ? where id = ?");
 				$stmt->bind_param('sssiisi', $title, $markdown, $html, $author, $published, $date, $id);
 				$stmt->execute();
			    $stmt->close();
			}
			catch(Exception $e) {
				die($e);
			}
		}
	}
?>