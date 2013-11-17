<?php
	require_once('typewritter.php');

	// Call to setup the database
	
	if ($_POST["action"] == "install") {
		$database = new Database();
		
		$database->initDatabase();
	}
	
	
	// Call to save drafts of posts
	
	if ($_POST["action"] == "save") {
		$post = new Post();
	}
?>