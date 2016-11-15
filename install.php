<?php
	/*
	##Do not try calling this file directly
	##This file will be called automatically on first use
	##Modify this file in order to add more tables according to your need
	*/
	
	$installDB = new SQLite3(DB_NAME);
	$installQuery = "CREATE TABLE URL(
   url TEXT NOT NULL,
   path TEXT NOT NULL
);";
	if(!$installDB->query($installQuery))
		exit("Failed to initialise DB");

?>