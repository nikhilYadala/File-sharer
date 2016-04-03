<?php include("./connect.php"); ?>
<?php include("./header.php");  ?>
<?php include("./navigation.php"); ?>

<!--
currently we are not using the encryption of the passwords
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
-->

<?php
           
$customeremail=$_POST["signup_email"];
$handle=$_POST["handle"];
$password=$_POST["signup_pass"];
$first=$_POST["signup_fname"];
$last=$_POST["signup_lname"];
$count=0;
$flag=0;

             if($count==0)
          {
                 $sql="SELECT * FROM user_details";
                $result=$conn->query($sql);
                
                 
            if($result->num_rows>0)
               {
                  while(($row=$result->fetch_assoc()) && $flag==0)
                       { 
                          if($customeremail==$row["email_id"])
                           $flag=1;
                           if($handle==$row["handle"])
                           $flag=2;
                          
                         
                        }if($flag==1){echo "The email_id has already been registered";}
                          else if($flag==2){echo "Handle name not avaiable";}
                  
                }   
          }      
         


          if($flag==0 && $count==0)
         {
            $sq="INSERT INTO user_details (email_id,password,handle,first_name,last_name) VALUES ('$customeremail','$password','$handle','$first','$last')";
            if($conn->query($sq)===TRUE)
                     {
                          echo "REGISTERED SUCCESFFULLY";
                      }
             else   {

                         echo "ERROR:". $conn->error;
                     }
         }
       
?>





 
 









 





