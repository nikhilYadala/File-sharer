<?php include("./connect.php"); ?>
<?php include("./header.php");  ?>
<?php include("./navigation.php"); ?>


<html>
<head>
<style>
body  {
    /*background-image: url("./image/2.jpg"); 
    */background-color: GreenYellow ;
    
}
</style>
</head>
<body>


<?php 



if(isset($_GET["s_query"])) 
{
	$q="select * from files;";
	$res=$conn->query($q);
	while($row=$res->fetch_assoc()){
		if ($row["ispublic"]==1 and strpos($row["file_name"],$s_query) !== false) {
    		echo "<br><br><h3>".$_GET["file_name"]."</h3>";
}
	}
}
else
echo "<h1 align='center'>FILESHARER!</h1>";


$q="select * from trending_files;";
$res=$conn->query($q);
while($row=$res->fetch_assoc()){

	echo "<br><br><h4>".$row["file_name"]."           <a href ='redirect.php?sync=".$row['addr']."_56423487' >Download</a></h4>";

}
?>
</body>
</html>