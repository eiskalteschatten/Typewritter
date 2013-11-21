<?php
	require_once("typewritter.php");
	
	$allPosts = new Posts();

	if ($allPosts->needsInstall()) {
		header('Location: install.php');
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	    <meta name="robots" content="noindex,nofollow">

		<title>Typewritter</title>

		<link rel="stylesheet" href="_css/typewritter.css" type="text/css">
		<link rel="stylesheet" href="_css/allposts.css" type="text/css">

        <!--[if lte IE 8]>
            <script type="text/javascript" src="_js/ie.js"></script>
        <![endif]-->

		<script type="text/javascript" src="_js/jquery-1.10.2.min.js"></script>
		<script type="text/javascript" src="_js/typewritter.js"></script>
		<script type="text/javascript" src="_js/allposts.js"></script>
	</head>
	<body>
		<div class="menubar">
			<div class="logo"><a href="index.php"><img src="_images/logo-writter.png"></a></div>
			<div class="menu">
				<a href="post.php">Create post</a>
				<a href="files.php">Manage files</a>
				<a href="comments.php">Comments</a>
			</div>
			<?php include("_includes/settings-menu.php") ?>
		</div>
		<div class="content">
			<table class="allposts">
				<?php
					$posts = $allPosts->getAllPosts(15);
					
					if (sizeof($posts) <= 0) {
						echo "<tr><td>There are currently no posts! Click <a href='post.php'>here</a> to create one.</td></tr>";
					}
					else {
						foreach ($posts as $post) {
							echo "<tr onclick=\"openPost('".$post['id'] . "')\">";
						
							echo "<td class='hidden'>".$post['id'] . "</td>";
							echo "<td class='allposts-title'>".$post['title'] . "</td>";
							echo "<td class='allposts-markdown'>".$post['markdown'] . "</td>";
							echo "<td class='allposts-date'>".$post['date_updated'] . "</td>";
							echo "<td class='allposts-edit'><a href=\"post.php?id=".$post['id'] . "\">Edit</a></td>";

							echo "</tr>";
						}
					}
				?>
			</table>
		</div>
	</body>
</html>