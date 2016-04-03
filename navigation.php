  <div class="navbar" gumby-fixed="top" id="nav1">
    <div class="row">
      <a class="toggle" gumby-trigger="#nav1 > .row > div > ul" href="#"><i class="icon-menu"></i></a>
      <h2 class="two columns logo">
        <a href=".">
          <img src="images/logo.png" gumby-retina alt="FILES"/>
        </a>
      </h2>
                        <div class="seven columns">
                            <div class="six columns" style="margin-left: 0px;">
                                <ul>
                                    <li id="" class="dropdown"><a  class="dropdown-toggle" data-toggle="dropdown" href="#">SEARCH
                                          <span class="caret"></span></a>
                                    
        <div class="dropdown-menu">                               
        <ul>
          <li><a href="#">OPTION1</a></li>
          <li><a href="#"></a></li>
          <li><a href="#">OPTION3</a></li>
          <li><a href="#">OPTION4</a></li>
          
          </ul>
          </div>     



                                    </li>
<li id="postjob" class="field"><form action="indexi.php"><input class="input" name="s_query" type="text" placeholder="File name" /></form></li>                                    <!--<li id="hiall" class=""><a href="./gallery.php?page=1">OPTION6</a></li> -->  
                            </div> 
                           
                            <div class="four columns" style="padding-top: 5px;">
                           
                            </div>    
                        </div>        
                        <div class="three columns" style="margin-left: 0px;">
                            <ul style="float: right !important;">
        <?php if(isset($_SESSION['id'])) : ?>
                                    <li class="ryte"><a href="./dashboard.php?user=<?php echo $_SESSION['id']; ?>">Hello <?php echo $_SESSION['name']; ?></a></li>
                                    <li class="ryte"><a href="logout.php">Logout</a></li> 
                                <?php else : ?>
        <li id="signin" class="ryte"><a href="./signin.php"> Log In</a></li>
        <li id="signup" class="ryte"><a href="./signup.php">Sign Up</a></li>
        <?php endif;?>
        </ul>
      </div>
    </div>
  </div>