<?php include("./connect.php"); ?>
<?php include("./header.php");  ?>
<?php include("./navigation.php"); ?>


<?php
/* $servername="localhost";
$username="root";
$passsword="";
$databasename="login_data";

$conn=new mysqli($servername,$username,$passsword,$databasename);
if($conn->connect_error)
         {  
             die("connection error: ".$conn->connect_error);
          }
*/
$sql="SELECT * FROM user_details WHERE handle='".$_POST["signin_email"]."' and password='".$_POST["signin_pass"]."';";                                //MY SQL CODE FOR CHECKING USERNAME AND PASSWORD

//echo $sql;

if(!empty($_POST["signin_email"])&& (!empty($_POST["signin_pass"]))) {                            //CHECK WHETHER THE USERNAME AND PASSWORD ARE EMPTY



if($conn->query($sql)==FALSE)
    {echo "Either the username or password or both is/are wrongly entered.";                   //CHECK WHETHER THE QUERY WAS PROPERLY EXECUTED
     echo "<a href='signin.php'> Try Again </a><br/>";
    }
   else if($conn->query($sql)==TRUE)
    {
       $store=$conn->query($sql);
       while($row=$store->fetch_assoc()){
$_SESSION["id"]=$row["uid"];
$_SESSION['name']=$row["first_name"];
$_SESSION['handle']=$row["handle"];

header("Location: dashboard.php");
die();


//echo $_SESSION["id"];


       }                                                            //FETCHING OF THE DATA
   }    
    /*     if(strcmp($row["password"],$password)==0)
     {

     echo "<div class='container'><div class='jumbotron'><P>click <a href='option.php'><span style='border:1px solid blue,color:white'> here</span> </a> for further options </p></div></div>";
             
                     
               
      //echo "click <a href='#'> here</a> for further options";
     }
else {echo "Please make sure that the password and the username are entered correctly<br/>"; echo"<a href='login.php'> Try Again </a> <br/>";}
   }
}  */
}
//$_SESSION["id"]=$row["uid"];
//echo $_SESSION["id"];
session_destroy();
?>