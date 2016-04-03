<?php include("connect.php"); ?>
<!-- Header ================================================== -->
<?php include("header.php"); ?>
<!-- ================================================== Header -->
<!-- Top Navigation ================================================== -->
<?php include("navigation.php"); ?>
<!-- ================================================== Top Navigation -->

<div class="paging">
<?php
        $error = false;
        $error_no = 0;
	if(isset($_POST['signup_email']) && isset($_POST['signup_pass'])){
            if(isset($_POST['signup_tc'])) {
		$d = time();
		$pass = md5($_POST['signup_email'].$_POST['signup_pass'].$d);
		$cc = str_split($pass, 10);
		$c_code = $cc[1];
		$ip = getIP();
		$rs = mysql_query("INSERT INTO `user`(`id`, `e_mail`, `password`, `f_name`, `l_name`, `phone1`, `created`, `modified`, `deleted`, `confirmed`, `c_code`, `last_ip`) VALUES (NULL,'$_POST[signup_email]','$pass','$_POST[signup_fname]','$_POST[signup_lname]','+91$_POST[signup_contact]','$d','$d',0,0,'$c_code','$ip')");
		if($rs) {
                    require_once './mailer/class.phpmailer.php';
                    $em = $_POST['signup_email'];
                    $nm = $_POST['signup_fname']." ".$_POST['signup_lname'];
                    $ad = $_SERVER['SERVER_NAME'];
                    $msg = '<p>Thanks for using file svn_auth_set_parameter(key, value). Please verify your account.<br />Your Verification Code is: <h3>'.$c_code.'</h3></p><br /><a href="'.$ad.'/confirm.php?cc='.$c_code.'&em='.$em.'">Click Here to Verify</a>';
                    $mail = new PHPMailer(true);
                    try {
                      $mail->AddAddress($em, $nm);
                      $mail->SetFrom($frm_email, $frm_name);
                      $mail->Subject = 'filesharer.com: Verify Your Account';
                      $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
                      $mail->MsgHTML($msg);
                      $mail->Send();
                     // echo "Message Sent OK</p>\n";
                    } catch (phpmailerException $e) {
                     // echo $e->errorMessage(); //Pretty error messages from PHPMailer
                    } catch (Exception $e) {
                     // echo $e->getMessage(); //Boring error messages from anything else!
                    }
                    $_SESSION['email'] = $_POST['signup_email'];
                    redirect("./confirm.php");
                    exit();
                } else {
                    $error = true;
                    $error_no = mysql_errno();
                }
            } else {
                $error = true;
            }    
	}
?>

	<div class="row">
            <div class="twelve columns">
                <div class="three columns">
<!--                    <img src="http://placehold.it/300x600" />-->
                </div>
		<div class="six columns">
                    	<?php
		if(isset($_GET['apply']))
			echo '<div class="warning alert">Join us to apply to jobs. Already an account <a href="./signin.php">Click Here</a> to Login. </div>';
	
		if($error) {
                    if($error_no == 1062)
			$msg = 'Looks like you are already registered with us. Click to <a href="./signin.php">log in</a> or <a href="./forgot.php">forgot password</a>';
                    elseif(!isset($_POST['signup_tc']))
                        $msg = 'You must accept our terms and condition.';
                    else
                        $msg = 'Something went wrong. Please try again.';
                    
                        echo '<div class="warning alert">' . $msg . '</div>';
                }        
	?>
			<h4>Signup</h4>
			<hr class="dotted"/>
                       <!--  <div class="row text-center">
                            <div class="medium btn icon-left entypo icon-facebook btn-facebook">
                                <a href="<?php echo $loginUrl?>">Sign up with Facebook</a>
                            </div>
                            <div class="medium rounded btn icon-left entypo icon-gplus btn-google" style="margin-left: 10px;">
                                <a href="<?php echo $authUrl?>">Sign up with Google</a>
                            </div>
                        </div>   -->
                        <hr class="dotted"/>
			<form id="signup_" method="post" action="hello_signup.php">
			<table>
				<tr>
					<td>First Name</td>
					<td><span class="field"><input type="text" name="signup_fname" class="text input" placeholder="First Name"/></span></td>
				</tr>
				<tr>
					<td>Last Name</td>
					<td><span class="field"><input type="text" name="signup_lname" class="text input" placeholder="Last Name"/></span></td>
				</tr>
				

                <tr>
                    <td>Handle</td>
                    <td><span class="field"><input type="text" name="handle" class="text input" placeholder="handle"/></span></td>
                </tr>

                <tr>
                <td>Contact No</td>
					<td><span class="prepend field"><span class="adjoined">+91</span><input type="tel" name="signup_contact" class="xwide phone input" placeholder="Contact No" maxlength="10"/></span></td>
				</tr>
				<tr>
					<td>Email Id</td>
					<td><span class="field"><input type="text" name="signup_email" class="email input" placeholder="Email"/></span></td>
				</tr>
				<tr>
					<td>Password</td>
					<td><span class="field"><input type="password" name="signup_pass" class="password input" placeholder="Password"/></span></td>
				</tr>
				<tr>
                                    <td>&nbsp;</td>
                                    <td>
                                        <div class="field">
                                        <label for="signup_tc" class="checkbox checked" style="display:inline;">
                                            <input type="checkbox" checked="checked" name="signup_tc" />
                                            <span></span> 
                                            I agree with the 
                                        </label>
                                            <a href="terms.php">terms and conditions</a>
                                        </div>
                                    </td>
				</tr>
				<tr>
                                    <td><input class="bttn medium rounded  warning btn" type="reset" value="Reset"></td>
                                    <td><input class="bttn medium rounded  primary btn" type="submit" value="Sign up"></td>
				</tr> 
			</table>
			</form>
		</div>

                <!-- Banner space for ads -->
                <div class="three columns">
<!--                    <img src="http://placehold.it/300x600" />-->
                </div>
            </div>
	</div>
	<script>
		$(document).ready(function () {
			$('#signup_').validation({
				// pass an array of required field objects
				required : [{name : 'signup_fname',}, {name : 'signup_lname',}, {name : 'signup_tc',}, 
                                {name : 'signup_contact',validate : function ($el) {
                                    if( !isNaN($el.val()) && $el.val().length==10)
                                        return true;
                                    return false;
                                }}, 
                                {name : 'signup_pass',},{name : 'signup_email',validate : function ($el) {
                                    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                                    return regex.test($el.val());
                            }}]
			});
		});
	</script>
</div>
