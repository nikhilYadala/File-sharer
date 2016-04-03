<html>
<head>

<script src="dropzone.js"></script>

<style>
.col-sm-2 {
    float: none;
    height: 100%
    }

.col-sm-8 {
    float: none;
    height: 100%;
    background-image: url("bcontent_gicon.jpeg");
    opacity: .4;
    background-repeat: no-repeat;
    background-position: center; 
   
    }





</style>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> >
  <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
  <script src="ajax.min.js"></script>
  <link rel="stylesheet" href="bootstrap.min.css"></script>
  <script src="maxcdn.js"></script>
  <!-- <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> -->










<?php
session_start();

$id=1002;
$files_dir="/var/www/cs241/folders/1002/";
$server='localhost';
$passwd="abhishek";
$username="abhishek";
$db='filesharer';
$user_details='user_details';


$conn = new mysqli($server, $username, $passwd,$db);
if ($conn->connect_error) {
    die("Connection failed to db" . $conn->connect_error);
}

$query = "SELECT * FROM ".$user_details." where uid=".$id.";";
if($result=$conn->query($query))
{
$data=$result->fetch_assoc();
}
else
echo "ERRORR retrieving data from sql (line 64 dashboard.php)...";

?>


<!-- to check whether it has returned from a upload file page with error -->
<?php
if(isset($_SESSION["file_up"])&&$_SESSION["file_up"]==2)
{

echo '<script>
$(document).ready(
    function(){
        $("#create_new_folder_error").modal();
});
</script>';

unset($_SESSION["file_up"]);                
}
?>






<!-- to check whether it has returned from a create new folder page with error -->
<?php
if(isset($_SESSION["create_new_folder"])&&$_SESSION["create_new_folder"]==2)
{

echo '<script>
$(document).ready(
    function(){
        $("#create_new_folder_error").modal();
});
</script>';

unset($_SESSION["create_new_folder"]);								
}
?>







<h1 align="right"><?php echo "Hello ,".$data["first_name"]." ".$data["last_name"]?>
</h1>
</head>
<title><?php
echo $data["first_name"]." ".$data["last_name"];
?>
</title>


<body style="background-color:PapayaWhip;">

<!-- Create new folder error --> 

 <div class="modal fade" id="create_new_folder_error" role="dialog">
    <div class="modal-dialog">
    
     
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Error creating folder</h4>
        </div>
        <div class="modal-body">
          <p>Unable to create folder.Folder of same name already exists.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>








<!-- Dialogue box opens here-->
  <div class="modal fade" id="new_folder_box" role="dialog">
    <div class="modal-dialog">
    
  <form role="form" method="get" action="create_new_folder.php">
  <div class="form-group">
    <label for="name">Folder Name:</label>
    <input type="text" class="form-control" id="name" name="name">
  </div>
 
  <button type="submit" class="btn btn-default">Submit</button>
</form>
  </div> 
</div>



<!-- Dialogue box opens here-->
  <div class="modal fade" id="file_upload_box" role="dialog">
  <div class="modal-dialog">
    
  <form role="form" method="post" action="upload_file.php" enctype="multipart/form-data">
  <div class="form-group">
    <label for="name">File Name:</label>
    <input type="text" class="form-control" id="name" name="name">
    Public<input type="radio" id="type" name="type" value="public">
    <t>Private<input type="radio" id="type" name="type" value="private"> 
    <br><label for="file">File:</label>
    <input type="file" id="filetoupload" name="filetoupload">
    
  </div>
 
  <button type="submit" class="btn btn-default">Upload</button>
</form>
  </div> 
</div>





<div class="container-fluid wrapper">
<div class="row">
	<div class="col-sm-2" style="background-color:#0074D9">
	<h3>GROUPS:</h3>
	<font size="3" face="Comic Sans MS">
	 <?php
	 $groups=explode(' ',$data["group"]);
	 foreach($groups as $gr)
	 	echo strtoupper($gr)."<br>";

	

	 ?>
	 </font>
	 </div>			<!-- CLOSING col-sm-2  div-->


  	

  	<div class="col-sm-8" style="background-color:PapayaWhip;">
      	

    <form action="upload_file.php"
      class="dropzone"
      id="
      "></form>

      <script type="text/javascript">
        var myDropzone = new Dropzone("div#myId", { url: "/file/post"});
      </script>
      






        <?php


  $query = "SELECT * FROM files;";
  if($result=$conn->query($query))
{
  echo "<h2>";
while($row=$result->fetch_assoc()){
echo "  ID:".$row["id"]."  UID:".$row["uid"]." Name-".$row["file_name"]." size-".$row["file_size"]."  date-".date("d-m-Y h:i:sa", $row["upload_time"])."<br>";
  echo "</h2>";
}
}
else
echo "ERRORR retrieving data from sql (line 226 dashboard.php)...";


        ?> 


  	</div>
  	

  	<div class="col-sm-2" style="background-color:#0074D9">

<font size="3" face="Comic Sans MS">
<br><h3>TASKS:</h3><br><br>
<div class="container">
  <button type="button" class="btn btn-lng" id="new_folder" ><span class="glyphicon glyphicon-folder-open"></span>CREATE FOLDER</button>
<br><br>  

<script>
$(document).ready(function(){
    $("#new_folder").click(function(){
        $("#new_folder_box").modal();
    });
});
</script>



<button type="button" class="btn btn-default" id="upload_file"><span class="glyphicon glyphicon-upload"></span> UPLOAD FILE</button>
  <br><br>

  <script>
$(document).ready(function(){
    $("#upload_file").click(function(){
        $("#file_upload_box").modal();
    });
});
</script>

  <button type="button" class="btn btn-default" ><span class="glyphicon glyphicon-share"></span> SHARE FOLDER</button>
</div>

</font>
  	</div>
	 

</div></div>   <!--Closing row container anf fluid-->



</body>
</html>

