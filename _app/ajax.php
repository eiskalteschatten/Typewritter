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
		$categories = $_POST["categories"];
		$tags = $_POST["tags"];
	
		$post = new Post($id);
		$test = $post->save($title, $markdown, $html, $published, $categories, $tags);	
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
	
	
	// Call to save changes to a category
	
	if ($_POST["action"] == "save-category") {
		$id = $_POST["id"];
		$name = $_POST["name"];
		$parent = $_POST["parent"];
            
		$category = new Category();
		$category->setId($id);
		echo $category->saveCategory($name, $parent);
	}
        

	// Call to update all categories
	
	if ($_POST["action"] == "update-categories") {
		$categories = $_POST["categories"];
		$results = "";
		$category = new Category();
		$allCategories = $category->getAllCategories();
		
		foreach ($allCategories as $cat) {
			$checked = "";
			if (in_array($cat[id], $categories)) {
				$checked = ' checked="checked"';
			}
		
			$results .= "<div class='category-checkbox'>";
			$results .= "<input type='checkbox' name='category' value='".$cat[id]."'".$checked.">".$cat[name];
			$results .= "</div>";
		}
		
		echo $results;
	}
?>