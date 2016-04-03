<?php
session_start();

$uid=1002;

$_SESSION["gdfg"]="dsf";
#Connecting to sql
$server='localhost';
$passwd="abhishek";
$username="abhishek";
$db='filesharer';
$conn = new mysqli($server, $username, $passwd,$db);
$sha_name=sha1($_POST["name"].time());

if($_POST["type"]=='public')
$is_public=1;
else $is_public=0;

$crc_val=explode(' ',shell_exec("cksum ".$_FILES["filetoupload"]["tmp_name"]))[0];

//start coding here all entries taken from table cmp crc with present crc_val and assign sha 
$query="select * from files;";
$result=$conn->query($query);
while($row=$result->fetch_assoc())
	if($row["crc"]==$crc_val){
$query = "Insert into files values('".$sha_name."',".$uid.",'".$_POST["name"]."',".$_FILES["filetoupload"]["size"].",".$crc_val.",".$is_public.",".$row["addr"].",'".pathinfo($_FILES["filetoupload"]["name"], PATHINFO_EXTENSION)."',".time().");";
$conn->query($query);
print $query."<br><br>matched";
 header("Location: dashboard.php");
  	die();
	}


$upload_dir="files/";
$target_file=$upload_dir.$sha_name;

move_uploaded_file($_FILES["filetoupload"]["tmp_name"], $target_file);


$query = "Insert into files values('".$sha_name."',".$uid.",'".$_POST["name"]."',".$_FILES["filetoupload"]["size"].",".$crc_val.",".$is_public.",".time().",'".pathinfo($_FILES["filetoupload"]["name"], PATHINFO_EXTENSION)."',".time().");";
$conn->query($query);
print $query."<br><br>unmtched";
  header("Location: dashboard.php");
  	die();
?>
