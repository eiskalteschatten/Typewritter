<?php
	require_once("typewritter.php");

	$id = "";
	$title = "";
	$markdown = "";
	$html = "";
	$published = 0;
	$dateVisible = "";
	$date = "";
	
	// If the parameter "id" exists, then edit that post rather than create a new post
	if ($_GET["id"]) {
		$id = $_GET["id"];
		$post = new Post($id);

		$dateVisible = " visible";
		$currPost = $post->getPost();
		
		$title = $currPost['title'];
		$markdown = $currPost['markdown'];
		$html = $currPost['html'];
		$published = $currPost['published'];
		$date = $currPost['date_updated'];
	}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	    <meta name="robots" content="noindex,nofollow">

		<title>Typewritter - Edit post</title>

		<link rel="stylesheet" href="_css/typewritter.css" type="text/css">
		<link rel="stylesheet" href="_css/post.css" type="text/css">

                <!--[if lte IE 8]>
                    <script type="text/javascript" src="_js/ie.js"></script>
                <![endif]-->
                
                <script type="text/javascript" src="_js/jquery-1.10.2.min.js"></script>
                <script type="text/javascript">
                    $(document).ready(function() {
                            marked.setOptions({
                                    sanitize: true
                            });
                               
                            <?php
                                if (!$published) {
                                    echo "setInterval(autoSavePost, ".autoSaveInterval.");";
                                } 
                            ?>
                    });
                </script>
		<script type="text/javascript" src="_js/typewritter.js"></script>
		<script type="text/javascript" src="_js/marked.js"></script>
		<script type="text/javascript" src="_js/post.js"></script>
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
				<?php 
					$publishbuttons = "";
					$draftbuttons = "";
				
					if ($published) {
						$publishbuttons = " visible";
					}
					else {
						$draftbuttons = " visible";
					}
				?>
				<div class="draft-buttons<?php echo $draftbuttons;?>">
					<a href="#!" onclick="savePost(this, false)" id="saveDraft">Save draft</a>
					<a href="#!" onclick="publish(this)">Publish</a>
				</div>
				<div class="published-buttons<?php echo $publishbuttons;?>">
					<a href="#!" onclick="savePost(this, true)">Update post</a>
					<a href="#!" onclick="unpublish(this)">Return to draft</a>
				</div>
			</div>
			<?php include("_includes/settings-menu.php") ?>
		</div>
		<div class="content with-toolbar">
			<div class="toolbar">
				<input type="text" id="postTitle" value="<?php echo $title; ?>" placeholder="Post title">
				<div class="date-updated<?php echo $dateVisible; ?>">
					Last updated:
					<div class="date"><?php echo $date; ?></div>
				</div>
			</div>
			<div class="editor">
				<input type="hidden" value="<?php echo $id; ?>" id="postId">
				<input type="hidden" value="<?php echo $published; ?>" id="published">
				<textarea class="markdown-editor visible" onkeyup="updateHtml()" placeholder="Post content"><?php echo $markdown; ?></textarea>
				<textarea class="html-editor" readonly placeholder="Automatically generated HTML"><?php echo $html; ?></textarea>
				<div class="editor-type">
					<a href="#!" onclick="showmarkdownEditor(this)" class="selected">Markdown</a>
					<a href="#!" onclick="showHtmlEditor(this)">HTML</a>
				</div>
			</div>
			<div class="preview">
				<div class="preview-content visible">
					<?php echo $html; ?>
				</div>
				<div class="markdown-guide">
					<p>For more information, see the guide at <a href="http://daringfireball.net/projects/markdown/syntax" target="_blank">Daring Fireball</a>.</p>	
				</div>
				<div class="markdown-help">
					<a href="#!" onclick="showMarkdownGuide(this)">Markdown Help</a>
					<a href="#!" onclick="showLivePreview(this)" class="selected">Preview</a>
				</div>
			</div>
		</div>
		<div class="popup" id="confirmpublish-popup">
			<div class="popup-background"></div>
			<div class="popup-content align-center">
				<p>Are you sure you want to publish your post?</p>
				<p class="close"><a href="#!" onclick="closePopup('confirmpublish-popup')">CANCEL</a><a href="#!" id="publishPost">PUBLISH</a></p>
			</div>
		</div>
		<div class="popup" id="confirmunpublish-popup">
			<div class="popup-background"></div>
			<div class="popup-content align-center">
				<p>Are you sure you want to return your post to a draft status?<br>It will no longer be visible on your blog.</p>
				<p class="close"><a href="#!" onclick="closePopup('confirmunpublish-popup')">CANCEL</a><a href="#!" id="unpublishPost">RETURN TO DRAFT</a></p>
			</div>
		</div>
	</body>
</html>