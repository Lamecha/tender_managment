<?php
session_start();
//require_once("main_includes/main_class.php");
//$obj = new main_front_class();
if(!isset($_SESSION['rb_uname']) || !isset($_SESSION['rb_pass']) || !isset($_SESSION['rb_pin']) || !isset($_SESSION['rb_power']))
{
	$obj->redirect("index.php");
}
?>
<link rel="stylesheet" type="text/css" href="main_css/loged_in_user/styles.css" />
<script type="Xtext/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="main_js/loged_in_user/script.js"></script>

<!--Required Js & Css for head-->


<span id="head-title">Tender Managment Application</span>
<!--<img src="main_images/down-arrow.png" height="27" width="38" id="whois"/>-->
<?php 
	
	  		
	  $path = $_SESSION['rb_power']."_photo"; 
	  
	  $first_name = $_SESSION['rb_power']."_first_name";
	  $last_name = $_SESSION['rb_power']."_last_name";
	  $email = $_SESSION['rb_power']."_email";
	  $office = $_SESSION['rb_power']."_office";
	  $profile = "create_".$_SESSION['rb_power'];
	  if($_SESSION['rb_power']=='employee' || $_SESSION['rb_power']=='officer')
	  {
	  $office_name = $obj->Office_name($result_login[$office]);
	  }
	  
?>
<img src="photo/<?php echo $_SESSION['rb_power']; ?>/thumb/<?php  print_r($result_login[$path]); ?>" height="30" width="30" id="whois"/>
<p id="pera" title="">
        <span id="loged_in_user">
        <img src="photo/<?php echo $_SESSION['rb_power']; ?>/thumb/<?php  print_r($result_login[$path]); ?>" height="95" width="97" style="margin-left:5px; margin-top:5px; float:left;"/>
		<font class="users_name"><?php print_r($result_login[$first_name]); ?> <?php print_r($result_login[$last_name]); ?></font>
        <font class="users_name">Office: <?php print_r($office_name['office_name']) ?> </font>
        <font class="users_name"><?php print_r($result_login[$email]);?></font>
        <?php if($_SESSION['rb_power']!="admin") { ?>
        <a href="<?php echo $profile; ?>.php?val=<?php print_r($result_login['id']);?>" class="u_l_btn" style="color:#FFF; text-decoration:none">View Profile</a>
        <?php } ?>
        <a href="logout.php?ref=logout" class="u_l_btn" style="color:#FFF; text-decoration:none">logout</a>
     
        
        </div>
    </p>
    

