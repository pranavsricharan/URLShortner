<?php
/*Function to add the add the URL to the database after checking for naming collisions*/

function checkExists($url)
{
	$db = new SQLite3(DB_NAME);
	$query = "SELECT * FROM URL WHERE url='$url' LIMIT 1";
	$exec = $db->query($query);
	$count = count($exec->fetchArray());
	if($count==1)
	{
		return false;
	}
	else
		return true;
}

function addURL($path,$url=false)
{
	$urlParam= $url;
	if($url==false)
		$url = createRand();
	$db = new SQLite3(DB_NAME);
	
	if(!checkExists($url))
	{
		$query2 = $db->exec("INSERT INTO URL (path,url) VALUES ('$path', '$url')") or die("Could not collect user infomation");
		echo "<h3 id=yourl>Your shortened URL is</h3> <div id=url>".SITE_URL."/".$url ."</div>";
	}
	else
		echo "Try a differnt name";
		//addURL($path,$urlParam);
	
}

/*Function to generate random URL*/

function createRand()
{
	$up = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$down = "abcdefghijklmnopqrstuvwxyz";
	$num = "1234567890";
	$upRand = str_shuffle($up) . str_shuffle($up);
	$downRand = str_shuffle($down) . str_shuffle($down);
	$numRand = str_shuffle($num) . str_shuffle($num);
	$randStr1 = str_shuffle($upRand.$downRand.$numRand);
	$randStr2 = str_shuffle($upRand.$downRand.$numRand);
	$randStrFull = str_shuffle($randStr1.$randStr2);
	$randStrFinal = str_shuffle(substr($randStrFull,0,8));
	return $randStrFinal;
}

?>