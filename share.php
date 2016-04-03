<?php
include("connect.php");?>

<?php

$ind=explode(" ",$_POST["inds"]);


foreach($ind as $i){
$query="insert into links values('".$_POST['link']."','".$i."',1,'".$_SESSION["handle"]."');";
//echo $query;
$conn->query($query);
}
$query="select * from groups where name='".$_POST['groups']."';";
//echo $query;
$res=$conn->query($query);

if(!$res) { echo "The group does not exist";}

else if($res){

  while($row=$res->fetch_assoc())
  {

$grps=explode(" ",$row["users"]);
foreach($grps as $i){
$query="insert into links values('".$_POST['link']."','".$i."',1,'".$_SESSION["id"]."');";
//echo $query;
$conn->query($query);
}
}
}
?>

<?php
header("Location: dashboard.php");
die();
?>