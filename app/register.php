
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
        <li><a href="login.php">Login</a></li>
        <li class="active"><a href="login.php"> Register</a></li> 
         <li><a href="login.php"> Logout</a></li>
         
      </ul>
    </div>
  </div>
</nav>



   <div class="container">
        <div class="jumbotron">
            <h1>Welcome to the registration portal </h1>
             <p> Give your required username and set a password.</p>
         </div>
      </div>
 
<?php

$customername=$password1=$password2="";

if($_SERVER["REQUEST_METHOD"]=="POST")
    {if(!empty($_POST["customername"])&& (!empty($_POST["password1"]))) {              //CHECK WHETHER THE USERNAME AND PASSWORD ARE NOT EMPTY
         $customername=encrypter($_POST["customername"]);
         $password1=encrypter($_POST["password1"]);
         $password2=encrypter($_POST["password2"]); 
    }}
  function encrypter($input)
   {
       $data=trim($input);
       $data=stripslashes($input);                                                      // FOR A SAFER INPUT,use php-lib funccs for encryption
       $data=htmlspecialchars($input);     
       return $input;
    }

                           

?>


<div class="container">
<form method="post" action="<?php 
                                echo htmlspecialchars($_SERVER["PHP_SELF"]);  
                              ?>">

        Username: <input type="text" name="customername" value="<?php
                                                                echo $customername;                   
                                                             ?>">
             <br/><br/><br/>
         password: <input type="password" name="password1">  
             <br/><br/>
            Retype password:<input type="password" name="password2"> 
             <br/>
            <input type="submit" value="SIGN UP" name="submit">
</form>
</div>


<?php
$servername="localhost";
$username="root";
$passsword="";
$databasename="login_data";
$count=0;
$flag=0;
$conn=new mysqli($servername,$username,$passsword,$databasename);
if($conn->connect_error)
         {  
             die("connection error: ".$conn->connect_error);
          }
if(($customername!="")&&($password1!="")&&($password2!=""))

      {  
          if(strcmp($password1,$password2)!=0) 
                 { echo "The passwords didnt match each other"; $count=1;}

         
         else if($count==0)
          {
                 $sql="SELECT * FROM login_info";
                $result=$conn->query($sql);
                
                 
            if($result->num_rows>0)
               {
                  while(($row=$result->fetch_assoc()) && $flag==0)
                       { 
                          if($customername==$row["username"])
                           $flag=1;
                          
                         
                        }if($flag==1){echo "The username already exists.Use another name";}
                  
                }   
          }      
         


          if($flag==0 && $count==0)
         {
            $sq="INSERT INTO login_info (username,password) VALUES ('$customername','$password1')";
            if($conn->query($sq)===TRUE)
                     {
                          echo "REGISTERED SUCCESFFULLY";
                      }
             else   {

                         echo "ERROR:". $conn->error;
                     }
         }
       
}
?>





 
 









 





