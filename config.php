<?php
	//Enter the relative path to your database file. If a database doesn't exist, a new one will be created.
	define("DB_NAME","urlList");
	
	//Enter your URL path to be displayed on the page
	define("SITE_URL","example.com");
	
	
	
	//You can comment out the next 2 lines after initialising the database
	if(!file_exists(DB_NAME))
		include_once "install.php";
?>