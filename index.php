<?php require_once("typewritter.php") ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	    <meta name="robots" content="noindex,nofollow">

		<title>Typewritter</title>

		<link rel="stylesheet" href="_css/typewritter.css" type="text/css">

        <!--[if lte IE 8]>
            <script type="text/javascript" src="_js/ie.js"></script>
        <![endif]-->

		<script type="text/javascript" src="_js/jquery-1.10.2.min.js"></script>
		<script type="text/javascript" src="_js/typewritter.js"></script>
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
			<?php
				$allPosts = new Posts();
				$posts = $allPosts->getAllPosts(15);
				
				foreach ($posts as $post) {
					echo $post['title'] . "<br>";
				}
			?>
		</div>
	</body>
</html>