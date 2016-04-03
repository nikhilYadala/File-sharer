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
        <li><a href="mypro.php">Home</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="register.php"> Register</a></li> 
         <li><a href="login.php"> Logout</a></li>

          <!--<li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">
               Options <span class="caret"></span>
               </a>
            <ul class="dropdown-menu">    -->
               <li><a href="read.php">READ</a></li>
                <li class="active"><a href="update.php">UPDATE</a></li>
                <li><a href="delete.php">DELETE</a></li>
           <!-- </ul>
         </li>-->
         
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


$notes=$row["data"];


if($_SERVER["REQUEST_METHOD"]=="POST")
    
           {              
                $notes=encrypter($_POST["notes"]);
                 $sq="UPDATE login_info SET data=\"$notes\" WHERE username='$customername'";
                       if($conn->query($sq)===TRUE) 
                              { 
                                  echo "Your data has been succesfully updated";
                               }
                         else { 
                                   echo "Some error occured: TRY AGAIN"; 
                               }
           }
     
  function encrypter($input)
   {
       $data=trim($input);
       $data=stripslashes($input);                                                      // FOR A SAFER INPUT,use php-lib funccs for encryption
       $data=htmlspecialchars($input);     
       return $input;
    }

                           //checking of username and password. 

?>
<div class="container"><div class="jumbotron"><h2> Click on the "SUBMIT" button below after updating the notes</h2></div></div>
<div class="container">
<div class="rows"><div class="col-md-10">
 <form method="post" action="<?php
                                 echo htmlspecialchars($_SERVER["PHP_SELF"]);
                               ?>">
       EDIT: <textarea name="notes" rows="50" cols="100"><?php echo $notes; ?> </textarea>
              <input type="submit" value="Submit" name="submit">
 </form>
 </div>
 </div></div>



</body>
</html>
                                                         



