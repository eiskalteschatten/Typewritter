<?php require_once("typewritter.php") ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	    <meta name="robots" content="noindex,nofollow">

		<title>Typewritter - Create post</title>

		<link rel="stylesheet" href="_css/typewritter.css" type="text/css">
		<link rel="stylesheet" href="_css/create.css" type="text/css">

        <!--[if lte IE 8]>
            <script type="text/javascript" src="_js/ie.js"></script>
        <![endif]-->

		<script type="text/javascript" src="_js/jquery-1.10.2.min.js"></script>
		<script type="text/javascript" src="_js/typewritter.js"></script>
		<script type="text/javascript" src="_js/create.js"></script>
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
				<a href="#!" onclick="saveDraft()">Save draft</a>
				<a href="#!" onclick="publish()">Publish</a>
			</div>
			<?php include("_includes/settings-menu.php") ?>
		</div>
		<div class="content with-toolbar">
			<div class="toolbar">
				<input type="text" id="postTitle" placeholder="Post title">
			</div>
			<div class="editor">
				<textarea class="markup-editor visible" onkeyup="updateMarkup()">markup</textarea>
				<textarea class="html-editor" onkeyup="updateHtml()">html</textarea>
				<div class="editor-type">
					<a href="#!" onclick="showMarkupEditor(this)" class="selected">Markup</a>
					<a href="#!" onclick="showHtmlEditor(this)">HTML</a>
				</div>
				<div class="markup-help visible">
					<a href="#!" onclick="openPopup('markup-popup')">Markup Help</a>
				</div>
				<?php include("_includes/markup-help.php") ?>				
			</div>
			<div class="preview">

			</div>
		</div>
	</body>
</html>