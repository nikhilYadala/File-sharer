<?php
session_start();
 
$customername=$_SESSION["customername"];       
$password=$_SESSION["password"];


?>

<!DOCTYPE html>
<html>
<head>
<title>To do app></title>
<meta chatset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">          <!--for bootstrap-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>

<body>
                                        <!--creation of header menu--!>
 <nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">To do app</a>
    </div>
    <div>
      <ul class="nav navbar-nav">
        <li class="active"><a href="mypro.php">Home</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="register.php"> Register</a></li> 
         <li><a href="login.php"> Logout</a></li>
 
          <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">
               Options <span class="caret"></span>
               </a>
            <ul class="dropdown-menu">
               <li><a href="read.php">READ</a></li>
                <li><a href="update.php">UPDATE</a></li>
                <li><a href="delete.php">DELETE</a></li>
            </ul>
         </li>

         
      </ul>
    </div>
  </div>
</nav>

<?php
$servername="localhost";
$username="root";
$passsword="";
$databasename="login_data";

$conn=new mysqli($servername,$username,$passsword,$databasename);
if($conn->connect_error)
     {
     die("connection failed.".$conn->connect_error);}
$sql="SELECT * FROM login_info WHERE username='$customername'";


$result=$conn->query($sql);
         $row=$result->fetch_assoc();
if($conn->query($sql)!=NULL && $row['data']!="")
     {
         $sq="UPDATE login_info SET data=\"\" WHERE username ='$customername'";
        if($conn->query($sq) === TRUE){echo "<div class='container'>
                   <div class='jumbotron'>
                <h3> Your notes has been deleted succesfully </h3>
                 
                     </div>
               </div> ";}else  {echo "some error occured.try again";}
     }
 else if($row['data']=="")
 { 
    echo "<div class='container'>
                   <div class='jumbotron'>
                <h1> You have no notes to be deleted </h1>
                 <p1> To create notes .click <a href='update.php'>here</a>  </p1>
                     </div>
               </div> ";
}
?>


