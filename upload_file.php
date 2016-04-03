<?php include("connect.php"); ?>

<?php
//print_r($_FILES);
$fileCount = count($_FILES["filetoupload"]["name"]);
$uid=$_SESSION["id"];
if($_POST["type"]=='public')
$is_public=1;
else $is_public=0;


for ($i = 0; $i < $fileCount; $i++)
{
	$f=0;
$crc_val=explode(' ',shell_exec("cksum ".$_FILES["filetoupload"]["tmp_name"][$i]))[0];
$sha_name=sha1($_FILES["filetoupload"]["name"][$i].time());
//start coding here all entries taken from table cmp crc with present crc_val and assign sha 
$query="select * from files;";
$result=$conn->query($query);
while($row=$result->fetch_assoc())
	if($row["crc"]==$crc_val){
		echo $row["crc"],$_FILES["filetoupload"]["name"][$i];
$query = "Insert into files values('".$sha_name."',".$uid.",'".$_FILES["filetoupload"]["name"][$i]."',".$_FILES["filetoupload"]["size"][$i].",".$crc_val.",".$is_public.",'".$row["addr"]."','".pathinfo($_FILES["filetoupload"]["name"][$i], PATHINFO_EXTENSION)."',".time().",'".$_POST["name"]."');";
echo $query,"mtched";
$conn->query($query);

 //header("Location: dashboard.php");
 	$f=1;
	}

if($f==0){
$upload_dir="files/";
$target_file=$upload_dir.substr(sha1($_FILES["filetoupload"]["name"][$i].time()),0,8).".".pathinfo($_FILES["filetoupload"]["name"][$i], PATHINFO_EXTENSION);

move_uploaded_file($_FILES["filetoupload"]["tmp_name"][$i], $target_file);


$query = "Insert into files values('".$sha_name."',".$uid.",'".$_FILES["filetoupload"]["name"][$i]."',".$_FILES["filetoupload"]["size"][$i].",".$crc_val.",".$is_public.",'".substr(sha1($_FILES["filetoupload"]["name"][$i].time()),0,8)."','".pathinfo($_FILES["filetoupload"]["name"][$i], PATHINFO_EXTENSION)."',".time().",'".$_POST["name"]."');";
$conn->query($query);
print $query;
  //header("Location: dashboard.php");
  }

  shell_exec("gzip ".$target_file);
 }
 header("Location: dashboard.php");
 die();
?>
