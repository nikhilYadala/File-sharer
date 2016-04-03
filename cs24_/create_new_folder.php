<?php
session_start();
$id=1002;
$dir="/var/www/cs241/folders/".$id."/";
$files=scandir($dir);
//print_r($files);
foreach ($files as $key => $value) 
	if($value==$_GET["name"])
	{
		$_SESSION["create_new_folder"]=2;
		header("Location: dashboard.php");
		die();
	}
	

	$_SESSION["create_new_folder"]=0;
	//echo "running script";
	$cmd="./create_new_folder_script.sh $dir".$_GET["name"];
	exec($cmd);
	echo "./create_new_folder_script.sh $dir".$_GET["name"];
	header("Location: dashboard.php");
	die();

	

	


?>