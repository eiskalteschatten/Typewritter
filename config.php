<?php
	// Configuration file for Typewritter
	
	// Setup how Typewritter will connect to the MySQL database

	define("dbUser", "root");
	define("dbPassword", "");
	define("dbName", "typewritter");
	define("dbHost", "localhost");			// Use localhost and not 127.0.0.1
	define("dbPort", "3306");				// 3306 is the default port for MySQL. If you are unsure, just leave it.
	define("dbCharset", "utf8");
	
	
	// Set date options
	
	define("timeZone", "Europe/Berlin");	// See http://www.php.net/manual/en/timezones.php for a list of PHP timezones
	define("timeFormat", "Y-m-d H:i:s");	// See http://us1.php.net/manual/en/function.date.php for more information about PHP date formats
?>