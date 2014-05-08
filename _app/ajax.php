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
        
        
        // Call to delete a post
        
	if ($_POST["action"] == "delete-post") {
		$id = $_POST["id"];
		$post = new Post($id);
		echo $post->delete();
	}
        

	// Call to create a new category
	
	if ($_POST["action"] == "create-category") {
		$name = $_POST["name"];
		$parent = $_POST["parent"];
            
		$category = new Category();
		echo $category->createCategory($name, $parent);
	}
        

	// Call to update categories
	
	if ($_POST["action"] == "update-categories") {
		$results = "";
		$category = new Category();
		$allCategories = $category->getAllCategories();
		
		foreach ($allCategories as $cat) {
			$results .= "<div class='category-checkbox'>";
			$results .= "<input type='checkbox' name='category' value='".$cat[id]."'>".$cat[name];
			$results .= "</div>";
		}
		
		echo $results;
	}
?>