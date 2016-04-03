<?php
include("connect.php");
?>

<?php
$addt=time();
$add=explode("_",$_GET["sync"])[0];
$time_limit=explode("_",$_GET["sync"])[1];
if($time_limit+$addt<time())
{
	?><script>window.alert("ooops!! Link gone invalid....")</script>
	<?php	
	die();
}
else{
			$ext;
			$query="select extension from files where addr='".$add."';";
			$res=$conn->query($query);
			while($row=$res->fetch_assoc())
				$ext=$row["extension"];

			$download="Location: files/".$add.".".$ext.".gz";
			//echo $download;
			header($download);

			die();
}
?>
