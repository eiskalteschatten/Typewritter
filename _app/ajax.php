<?php
	require_once(__DIR__.'/../typewritter.php');

	// Call to setup the database
	
	if ($_POST["action"] == "install") {
		$database = new Database();
		$database->initDatabase();
	}
	
	
	// Call to save drafts of posts and publish posts
	// The only difference between saving a draft and publishing it, is the value of $published. 1 = publish; 0 = save as draft
	
	if ($_POST["action"] == "save") {
		$id = $_POST["id"];
		$title = $_POST["title"];
		$markdown = $_POST["markdown"];
		$html = $_POST["html"];
		$published = $_POST["published"];
	
		$post = new Post($id);
		$post->save($title, $markdown, $html, $published);	
		$newId = $post->getId();
		
		$return = array('id' => $newId, 'date' => $post->getDateUpdated());
		
		echo json_encode($return);
	}
?>