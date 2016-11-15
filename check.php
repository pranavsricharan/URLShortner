<?php
require_once 'config.php';
require_once 'functions.php';
$url=$_GET['url'];
if(checkExists($url)==true)
	echo "true";
else
	echo "false";
?>