<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	    <meta name="robots" content="noindex,nofollow">

		<title>Log into Typewritter</title>

		<link rel="stylesheet" href="_css/typewritter.css" type="text/css">
		<style>
			.login-box {
				width: 440px;
				height: 200px;
				position: absolute;
				left: 50%;				
				top: 50%;
				margin-left: -275px;
				margin-top: -125px;
				text-align: center;
				box-shadow: 0 0 30px #d0d0d0;
				padding: 30px;
			}
			
			.login-box input {
				border: 1px solid #B7B7B7;
				font-size: 13px;
				padding: 5px;
				width: 200px;
				margin-bottom: 20px;
			}
			
			.message {
				display: none;
			}
		</style>

        <!--[if lte IE 8]>
            <script type="text/javascript" src="_js/ie.js"></script>
        <![endif]-->

		<script type="text/javascript" src="_js/jquery-1.10.2.min.js"></script>
		<script type="text/javascript" src="_js/typewritter.js"></script>
	</head>
	<body>
		<div class="menubar">
			<div class="logo"><a href="index.php"><img src="_images/logo-writter.png"></a></div>
		</div>
		<div class="login-box">
			<div class="message"></div>
			Username:<br>
			<input type="text" name="username"><br>
			Password:<br>
			<input type="password" name="password"><br>
			<button>Login</button>
		</div>
	</body>
</html>