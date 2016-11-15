<?php

// Load the confiuration file and required functions
require_once 'config.php';
require_once 'functions.php';







$database = new SQLite3(DB_NAME);
if(isset($_GET['u']))
{
	$url = $_GET['u'];
	$query = "SELECT * FROM URL WHERE url='$url' LIMIT 1";
	$exec = $database->query($query);
	while ($row = $exec->fetchArray(SQLITE3_ASSOC))
	{
		if($row['url']==$url)
			header("Location:".$row['path']);
		
	}

//echo $r_url;

}

?>

<html>
<head>
	<title>Shorten URL</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script>
	
		function updateStat(stat)
		{
			
			if(stat=="true")
			{
				$("#negative").html("Already exists");
				$("#positive").html("");
				document.getElementById("submitButton").disabled = true;
			}
			else
			{
				$("#positive").html("URL Okay!");
				$("#negative").html("");
				document.getElementById("submitButton").disabled = false;
			}
		}
		function checkURL(x)
		{			
			$.get("check.php", {url:x}, function(output){updateStat(output)});
			return false;
		}
	</script>

</head>
<body>


	

		<div class="container">
			<div class="cover">
				<article class="homeMain">
					<p>
						<h3>URL Shortener</h3>
					</p>
				</article>
			</div>
			<div class="left">
				

			<h1>Get a random URL</h1>
			<h2>
			Please enter a URL
			</h2>

			<form name="rand" method="post" action="" autocomplete="off">
			<input type="text" name="url" size="50" value="http://" style=""><br />
			<h2>
			Required URL
			</h2>
			<h2 id="req">
			<?=SITE_URL;?>/
			</h2>
			<input type="text" name="yourl" size="50" value="" style="" onkeyup="checkURL(this.value)"><br />
			<div id="positive" style="color:green;"></div>
			<div id="negative" style="color:red;"></div>
			<b>Note : Leaving this blank produces a random link. Example - <?=SITE_URL;?>/3vuThuYW</b><br>
			<button id="submitButton" type="submit" name="submit" value="Shorten URL" style="" />Shorten URL</button>
			</form>
			<?php

			if(isset($_POST['submit']))
			{
			$url = $_POST['url'];

			if((substr($url,0,7) != "http://") && (substr($url,0,8) != "https://"))
			{
			$url = "http://".$url;
			}

				
					if($_POST['yourl']=="")
					{
					$up = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
					$down = "abcdefghijklmnopqrstuvwxyz";
					$num = "1234567890";
					$up_shuffle = str_shuffle($up);
					$down_shuffle = str_shuffle($down);
					$num_shuffle = str_shuffle($num);
					$up_new = substr($up_shuffle,0,2);
					$down_new = substr($down_shuffle,0,2);
					$num_new = substr($num_shuffle,0,2);
					$rand = str_shuffle("$up_new"."$down_new"."$num_new");
					}
					if($_POST['yourl'] != "")
					{
					$rand = $_POST['yourl'];
					}
				
					addURL($url,$rand);
				

					
				
			}
			?>
			<div id="text"></div>
							
			</div>
		</div>
</body>
</html>