<?php
	require_once("typewritter.php"); 
        
        $category = new Category();
        $allCategories = $category->getAllCategories();
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	    <meta name="robots" content="noindex,nofollow">

		<title>Typewritter - Edit categories</title>

		<link rel="stylesheet" href="_css/typewritter.css" type="text/css">
		<link rel="stylesheet" href="_css/categories.css" type="text/css">

                <!--[if lte IE 8]>
                    <script type="text/javascript" src="_js/ie.js"></script>
                <![endif]-->
                
                <script type="text/javascript" src="_js/jquery-1.10.2.min.js"></script>
		<script type="text/javascript" src="_js/typewritter.js"></script>
		<script type="text/javascript" src="_js/categories.js"></script>
	</head>
	<body>
		<div class="menubar">
			<div class="logo"><a href="index.php"><img src="_images/logo-writter.png"></a></div>
			<div class="menu">
				<div class="dropdown" onmouseover="openDropdown(this)" onmouseout="closeDropdown(this)">
					<a href="index.php" class="mainlink">Writter &rarr;</a>
					<?php include("_includes/writter-menu.php") ?>
				</div>
				<a href="#!" onclick="">Insert image</a>

			</div>
			<?php include("_includes/settings-menu.php") ?>
		</div>
		<div class="content with-toolbar">
			<div class="toolbar">
				<div class="new-parent-category">
                                    <select id="newCategoryParent">
                                        <option selected value="0">Select a parent category</option>
                                        <?php
                                            foreach ($allCategories as $cat) {
                                                echo "<option value='".$cat[id]."'>";
                                                echo $cat[name];
                                                echo "</option>";
                                            }
                                        ?>
                                    </select>
                                    <button onclick="createCategory()">Create new category</button>
				</div>
                                <input type="text" id="newCategory" placeholder="New category">
			</div>
			<table class="allposts">
				<?php
					if (sizeof($allCategories) <= 0) {
						echo "<tr><td>There are currently no categories! Please create a new one above.</td></tr>";
					}
					else {
						foreach ($allCategories as $cat) {
							echo "<tr>";
						
							echo "<td class='hidden' id='catId'>".$cat['id'] . "</td>";
							echo "<td class='allposts-title'>".$cat['name'] . "</td>";
							echo "<td class='allposts-date'>";
                                                        echo $cat['date_updated']."<br>";
                                                        echo "</td>";
							echo "<td class='allposts-edit'><a href=\"post.php?id=".$post['id'] . "\">Edit</a></td>";

							echo "</tr>";
						}
					}
				?>
			</table>
                </div>
	</body>
</html>