<?php
	require_once(__DIR__.'/../typewritter.php');

	// Call to setup the database
	
	if ($_POST["action"] == "install") {
		$database = new Database();
		$database->initDatabase();
	}
	
	
	// Call to save drafts of posts
	
	if ($_POST["action"] == "save") {
		$id = $_POST["id"];
		$title = $_POST["title"];
		$body = $_POST["body"];
		$published = $_POST["published"];
	
		$post = new Post($id);
		$post->save($title, $body, $published);	
		
		echo $post->getId();
		
		// TODO: Update id field in create.php after a save
		// TODO: Create and update saved date field
	}
?>