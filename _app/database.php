<?php
	require_once(__DIR__.'/../config.php');

	// Database controller
	
	class Database {
		private $connection = null;
		private $database = null;
	
		function __construct() {
			try {
				if (!$this->connection) {
				echo 
					// Establish a connection to MySQL if it doesn't already exist. Die if no connection could be established.
					$this->connection = mysql_connect(dbHost.":".dbPort, dbUser, dbPassword) or die("Could not connect to MySQL!\n" + mysql_error());

					// Select the database defined in config.php. Die if no connection could be established.
					$this->database = mysql_select_db(dbName, $this->connection) or die("Could not connect to the database \"".dbName."\"!\n" + mysql_error());;
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
					mysql_close($this->connection);
				}
			}
			catch(Exception $e) {
				die($e);
			}		
		}
	
		function initDatabase() {
			try {
				if (mysql_query("SHOW TABLES LIKE tw_general", $this->connection) === false) {
					// If the table 'tw_general' doens't exist, then assume no installation has occurred and install.

					// Create tables					
					mysql_query("CREATE TABLE tw_general(
						id INT NOT NULL AUTO_INCREMENT, 
						PRIMARY KEY(id))", $this->connection) or die("An error has occured! ".mysql_error());
					mysql_query("CREATE TABLE tw_posts(
						id INT NOT NULL AUTO_INCREMENT, 
						PRIMARY KEY(id), 
						title TEXT, 
						body TEXT, 
						author TEXT, 
						date_created DATETIME)", $this->connection) or die("An error has occured! ".mysql_error());
					mysql_query("CREATE TABLE tw_comments(
						id INT NOT NULL AUTO_INCREMENT, 
						PRIMARY KEY(id), 
						post INT, 
						body TEXT, 
						author TEXT, 
						author_email TEXT, 
						date_created DATETIME)", $this->connection) or die("An error has occured! ".mysql_error());
					
					// Fill in default options
					
				}
				else {
					die("TypeWritter is already installed!");
				}
			}
			catch(Exception $e) {
				die($e);
			}
		}
		
		function readFromTable($table) {
			try {
				
			}
			catch(Exception $e) {
				die($e);
			}
		}
		
		function writeToTable($table, $towrite) {
			try {
			  	
			}
			catch(Exception $e) {
				die($e);
			}
		}
	}
?>