<?php
session_start();
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
<!-- create a menu at the top-->
   
<!-- creation of a header menu fromo bootstarp-->
    <nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">To do app</a>
    </div>
    <div>
      <ul class="nav navbar-nav">
        <li><a href="mypro.php">Home</a></li>
        <li class="active"><a href="login.php">Login</a></li>
        <li><a href="login.php"> Register</a></li> 
         <li><a href="login.php"> Logout</a></li>
         
      </ul>
    </div>
  </div>
</nav>



   <div class="container">
        <div class="jumbotron">
            <h1>Welcome to the login portal </h1>
         </div>
      </div>
 


<?php

$customername=$password="";

if($_SERVER["REQUEST_METHOD"]=="POST")
    {if(!empty($_POST["customername"])&& (!empty($_POST["password"]))) {              //CHECK WHETHER THE USERNAME AND PASSWORD ARE NOT EMPTY
         $customername=encrypter($_POST["customername"]);
         $password=encrypter($_POST["password"]);
    }}
  function encrypter($input)
   {
       $data=trim($input);
       $data=stripslashes($input);                                                      // FOR A SAFER INPUT,use php-lib funccs for encryption
       $data=htmlspecialchars($input);     
       return $input;
    }

                           //checking of username and password. 

?>




<div class="container">
<form method="post" action="<?php 
                                echo htmlspecialchars($_SERVER['PHP_SELF']);  
                              ?>">

        Username: <input type="text" name="customername" value="<?php
                                                                echo $customername;                   
                                                             ?>">
             <br/><br/><br/>
         password: <input type="password" name="password">  
             <br/><br/>
            <!-- <input type="checkbox" name="remember" value="remember"> Remember me 
             <br/> -->
            <input type="submit" value="submit" name="submit">
</form>
</div>


<?php
$servername="localhost";
$username="root";
$passsword="";
$databasename="login_data";

$conn=new mysqli($servername,$username,$passsword,$databasename);
if($conn->connect_error)
         {  
             die("connection error: ".$conn->connect_error);
          }
$sql="SELECT * FROM login_info WHERE username='$customername'";                                //MY SQL CODE FOR CHECKING USERNAME AND PASSWORD



if(!empty($_POST["customername"])&& (!empty($_POST["password"]))) {                            //CHECK WHETHER THE USERNAME AND PASSWORD ARE EMPTY



if($conn->query($sql)==FALSE)
    {echo "Either the username or password or both is/are wrongly entered.";                   //CHECK WHETHER THE QUERY WAS PROPERLY EXECUTED
     echo "<a href='login.php'> Try Again </a><br/>";
    }
else if($conn->query($sql)==TRUE)
    {
       $store=$conn->query($sql);
       $row=$store->fetch_assoc();                                                            //FETCHING OF THE DATA
       
         if(strcmp($row["password"],$password)==0)
     {

     echo "<div class='container'><div class='jumbotron'><P>click <a href='option.php'><span style='border:1px solid blue,color:white'> here</span> </a> for further options </p></div></div>";
             
                     
               
      //echo "click <a href='#'> here</a> for further options";
     }
else {echo "Please make sure that the password and the username are entered correctly<br/>"; echo"<a href='login.php'> Try Again </a> <br/>";}
   }
}
$_SESSION["customername"]="$customername";
$_SESSION["password"]="$password";

?>


</body>
</html>
                                                                                    