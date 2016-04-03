<?php include("connect.php"); ?>





<html>
<head>

 <title>Try v1.2 Bootstrap Online</title>
   <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
   <script src="/scripts/jquery.min.js"></script>
   <script src="/bootstrap/js/bootstrap.min.js"></script>


<script src="dropzone.js"></script>

<style>
.col-sm-2 {
    float: none;
    height: 100%
    }

.col-sm-8 {
    float: none;
    height: 100%;
    /*background-image: url("bcontent_gicon.jpeg");*/  
    opacity: .9;
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
 if(isset($_GET['var']))
 {
  echo '<script>


$(document).ready(function(){
        $("#myModal").modal();
    });
</script>
';
}
?>





<!-- create a menu at the top-->
   
<!-- creation of a header menu fromo bootstarp-->
    <!--<nav class="navbar navbar-default"> -->
  <div class="container-fluid" style="background-color:#484848;">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">File Sharer</a>
    </div>
    <div>
      <ul class="nav navbar-nav">
        <li><a href="index.php">Home</a></li>
        <li class="active"><a href="signin.php">Login</a></li>


      <!-- code for count variable in the notification b ar-->
      <?php
        $_SESSION['count']=0;
        $q="select * from links where handle='".$_SESSION["handle"]."'";
        $res=$conn->query($q);

        while($row=$res->fetch_assoc())
          if($row["seen"]=='1')
            $_SESSION['count']=$_SESSION['count']+1;
          ?>







        <li> <button type="button" class="btn btn-info btn-lg" id="notificatio" data-toggle="modal" data-target="#notification">Notifications <span class="badge"><?php echo $_SESSION['count'];?></span></button></li> 
         <li><a href="logout.php"> Logout</a></li>
         </ul>
    </div>
  </div>


<!-- this script is for notifications 

  <script>
$(document).ready(function(){
    $("#notification").click(function(){
        $("#notification_box").modal();
    });

});
</script>
-->


<!--</nav>-->



   <!-- <div class="container">
        <div class="jumbotron">
            <h1>Welcome to the login portal </h1>
         </div>
      </div>
 
 -->




<?php
$id=$_SESSION["id"];
$data;
$query = "SELECT * FROM user_details where uid=".$id.";";
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








</head>
<title><?php
echo $data["first_name"]." ".$data["last_name"];
?>
</title>


<body style="background-color:white;">

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


<!-- Create_group_modal opens here-->
  <div class="modal fade" id="create_group_modal" role="dialog">
  <div class="modal-dialog">
              <div class="modal-content">

  <form role="form" method="post" action="create_group.php" >
  <div class="form-group">
    <label for="name">Group Name:</label>
    <input type="text"  id="name" name="name"> 
    <br><label for="users">Users:</label>
    <input type="text" class="form-control" id="users" name="users">
    
  </div>
 
  <button type="submit" class="btn btn-default">Create</button>
</form>
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





<!-- Modal -->
  <div class="modal fade" id="notificationss_box" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">File requests from friends</h4>
        </div>
        <div class="modal-body">

        <?php

        $q="select * from links where handle='".$_SESSION["handle"]."'";
        $res=$conn->query($q);

        while($row=$res->fetch_assoc())
          if($row["seen"]=='1')
            echo "<a href=".$row['link'].">".$row['link']."</a><br><br>";

$res=$conn->query($q);
        while($row=$res->fetch_assoc())
          if($row["seen"]=='0')
            echo "<a href=".$row['link'].">".$row['link']."</a><br><br>";

         $qq="update links set seen=0 where handle='".$_SESSION['handle']."'";
         $ress=$conn->query($qq); 




        ?>


  
        </div>
        <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal"><a href="dashboard.php" >Close</a></button>
        </div>   
      </div>
      
    </div>
  </div>
  <!--ene modal-->










<!-- Dialogue box opens here-->
  <div class="modal fade" id="file_upload_box" role="dialog">
  <div class="modal-dialog">
    
          <div class="modal-content">

    <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Upload a File!</h4>
        </div>

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
</div>


  





<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Link Share</h4>
        </div>
        <div class="modal-body">
          <p>Link: redirect.php?sync=<?php echo $_GET['var'];?>_864000  </p>
           
           <form method="post" action="share.php">
           <input type="hidden" name="link" value=<?php echo "redirect.php?sync=".$_GET['var']."_864000";?> >
           Groups(space separated):<input type="text" name="groups">
           <br>Individuals(space separated):<input type="text" name="inds">
           <input type="submit" value="share">
           </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><a href="#"> Close</a></button>
        </div>
      </div>
      
    </div>
  </div>





<div class="container-fluid wrapper">
<div class="row">
	<div class="col-sm-2" style="background-color:#daa520">
	<h3>GROUPS:</h3>
	<font size="3" face="Comic Sans MS">
	 <?php
	$query="select * from groups where creator='".$id."';";
  $res=$conn->query($query);
  while($row=$res->fetch_assoc()){
    echo "<h3> ".$row["name"]."</h3>";
    echo "<h4> ".$row["users"]."</h3><br><br>";
  }
  ?>
	 </font>
	 </div>			<!-- CLOSING col-sm-2  div-->


  	

  	<div class="col-xm-8" style="background-color:#D2691E">
      	

    <!--<form action="upload_file.php"
      class="dropzone"
      id="
      "></form>

      <script type="text/javascript">
        var myDropzone = new Dropzone("div#myId", { url: "/file/post"});
      </script>
      
   -->




<!-- FILE TABLE STARTS HERE -->

        <?php


  $query = "SELECT * FROM files;";
  if($result=$conn->query($query))
{
    echo '<div class="col-sm-8">';

     echo '<table class = "table">
   <caption>List of all the files uploaded</caption>
   
   <thead>
      <tr>
         <th>File Name</th>
         <th>File Tag</th>
         <th>size(in MB)</th>
        
                  

      </tr>
   </thead>';




echo '<tbody>';




while($row=$result->fetch_assoc()){

 
      echo '<tr>';


//echo "<td>".$row['id']."</td>"."<td>".$row['uid']."</td>"."<td>".$row['file_name']."</td>"."<td>".$row['file_size']."</td>"."<td>".date('d-m-Y h:i:sa', $row['upload_time'])."</td>"."<br>";
echo "<td>".$row['file_name']."</td>"."<td>".$row['file_tag']."</td>"."<td>".round($row['file_size']/1000000+1)."<br>";

$_SESSION["link"]="redirect.php?sync=".$row['addr']."_864000";


echo '<td>'.'<a href = "dashboard.php?var='.$row["addr"].'"> <button type="button" class="btn btn-info btn-lg" id="mybutton" data-toggle="modal" data-target="#myModal">SHARE</button></a>'.'</td>';

echo '<script>
$(document).ready(function(){
    $("#mybutton").click(function(){
        $("#mymodal").modal();
    });
});
</script>';

  //echo "</h2>";


   echo '</tr>';
   echo '</div>';
   
}

echo '</tbody>';
echo '</table>';

}
else
echo "ERRORR retrieving data from sql (line 226 dashboard.php)...";


        ?> 
  	</div>
  	

  	<div class="col-sm-2" style="background-color:#daa520">

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

 <button type="button" class="btn btn-default" id="create_group" ><span class="glyphicon glyphicon-share"></span> CREATE GROUP </button>
</div>

  <script>
$(document).ready(function(){
    $("#create_group").click(function(){
        $("#create_group_modal").modal();
    });
});
</script>

 <script>
$(document).ready(function(){
    $("#notificatio").click(function(){
        $("#notificationss_box").modal();
    });

});
</script>



</font>
  	</div>
	 

</div></div>   <!--Closing row container anf fluid-->



</body>
</html>

