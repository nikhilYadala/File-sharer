<?php
session_start();
 
$customername=$_SESSION["customername"];       
$password=$_SESSION["password"];


?>

<!DOCTYPE html
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










<div class="container">
     <div class="well" style="background-color:green;color:white;padding:30px;">
          <h2> HI <?php echo $_SESSION["customername"] ?> <h2>       
         <p style="font:verdana"> Select the service you would like to use </p>
      </div>


      <div class="rows">
        <div class="col-md-4">
              
        <p>TO READ YOUR  NOTES </P>
        <button type="button" class="btn btn-primary btn-lg"><a href="read.php" style="color:white">Read</a></button> 
       </div>
 
        <div class="col-md-4">
             <p>TO UPDATE/ MAKE YOUR NOTES </P>
        <button type="button" class="btn btn-primary btn-lg"><a href="update.php" style="color:white">Update</a></button>
       </div>

          <div class="col-md-4">
              <p> TO DELETE YOUR NOTES </p>
          <button type="button" class="btn btn-primary btn-lg"><a href="delete.php" style="color:white">Delete</a></button>
          </div>       
</div>



