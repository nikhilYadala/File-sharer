<?php include("connect.php"); ?>
<!-- Header ================================================== -->
<?php include("header.php"); ?>
<!-- ================================================== Header -->
<!-- Top Navigation ================================================== -->
<?php include("navigation.php"); ?>
<!-- ================================================== Top Navigation -->
<!--<?php echo "great"; ?>-->

<div class="paging">
    
	<div class="row">
            <div class="twelve columns">
                <div class="three columns">
                </div>
                
		<div class="six columns ">
	<?php
		if(isset($_GET['confirmed'])){
			$_SESSION['f_msg'] = 'Your account has been confirmed. Please login.';;
		}
		if(isset($_POST['signin_email']) && isset($_POST['signin_pass'])) {
			$auth=mysql_query("SELECT `id`, `e_mail`, `password`, `f_name`, `l_name`, `confirmed`, `folder`, `table`, `first_access`, `created`, `banned` FROM `user` WHERE `e_mail`='$_POST[signin_email]' and `deleted`=0");
			if(mysql_num_rows($auth)>=1){
				while($ath=mysql_fetch_array($auth)){
					$pass = md5($_POST['signin_email'].$_POST['signin_pass'].$ath['created']);
                                        if($ath['banned']==1)
                                            $_SESSION['f_msg'] = 'Your account has been suspended.';
					elseif($ath['confirmed']==1){
						if($pass==$ath['password']){
							//echo "Success!";
							$_SESSION['id'] = $ath['id'];
							$_SESSION['name'] = $ath['f_name'];
							//$_SESSION['folder'] = $ath['folder'];
							//$_SESSION['table'] = $ath['table'];
							if($ath['first_access']==0){
								//mysql_query("UPDATE `user` SET `first_access`=1 WHERE `e_mail`='$_POST[signin_email]'");
								redirect("./settings.php?tab=1");
								exit();
							}
							else{
								redirect("./user.php?page=1");
								exit();
							}
						}
						else{
							$_SESSION['f_msg'] = 'Invalid Email ID or Password. Please try again!';
						}
					}
					else{
						$_SESSION['email'] = $ath['e_mail'];
						redirect("./confirm.php?log=1");
						exit();
					} 
				}
			}
			else{
				$_SESSION['f_msg'] = 'Invalid Email ID or Password. Please try again!';
			}
		}
	?>
            <?php
            if (isset($_SESSION['f_msg'])) {
                echo '<div class="warning alert">' . $_SESSION['f_msg'] . '</div>';
                unset($_SESSION['f_msg']);
            }
            ?>
			<h4>Login</h4>
			<hr class="dotted"/>
                        <div class="row text-center">
                          

               <!-- my own changes               <div class="medium btn icon-left entypo icon-facebook btn-facebook">
                                <a href="<?php echo $loginUrl?>">Log in with Facebook</a>
                            </div>
                            <div class="medium rounded btn icon-left entypo icon-gplus btn-google" style="margin-left: 10px;">
                                <a href="<?php echo $authUrl?>">Log in with Google</a>
                            </div>
                        </div>                                 --end my own changes -->


                        <hr class="dotted"/>
			<form id="signin_" method="post" action="hello.php">
				 <table>
					<tr>
						<td>Handle</td>
						<td><span class="field"><input name="signin_email" type="text" class="text input" placeholder="Email"></span></td>
					</tr>
					<tr>
						<td>Password</td>
						<td><span class="field"><input name="signin_pass" type="password" class="password input" placeholder="Password"></span></td>
					</tr>
					<tr>
						<td></td>
						<td><button class="bttn medium rounded  primary btn" type="submit">Log In</button></td>
					</tr>
					<tr>
                                            <td><a href="./forgot.php">Forgot your password?</a></td>
						<td><a href="./signup.php">Create an Account</a></td>
					</tr>
				 </table>
			</form>			
		</div>
            <!-- Banner space for ads -->
            <div class="three columns">
<!--                <img src="http://placehold.it/300x600" />-->
            </div>
            </div>
	</div>
	<script>
		$(document).ready(function () {
			$('#signin_').validation({
				// pass an array of required field objects
				required : [{name : 'signin_pass',},{name : 'signin_email',validate : function ($el) {return $el.val().match('@') !== null;}}]
			});
		});
	</script>
</div>
