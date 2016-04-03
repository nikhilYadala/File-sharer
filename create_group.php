<?php include("connect.php"); ?>
<?php

$id=$_SESSION['id'];
$files_dir="/var/www/cs241/folders/1002/";

$query="insert into groups values('".$_POST["name"]."','".$_POST["users"]."',".$id.");";
$conn->query($query);
//echo $query;
header("Location: dashboard.php");
die();

$conn->query($query);
?>
