<?php
session_start();
include("main_includes/main_class.php");
$obj = new main_front_class();
if(isset($_POST['submit']))
{
	if($_POST['rb_power']=="")
	{
		$msg = "Please select role to login";
	}
	else if ($_POST['rb_uname']=='' || $_POST['rb_pass']=='' || $_POST['rb_pin']=='' )
	{
		$msg = "Incomplete login info";
		
	}
	else
	{
		$result = $obj->login($_POST['rb_uname'],$_POST['rb_pass'],$_POST['rb_power'],$_POST['rb_pin']);
		
		
	if($result)
	{
	
	//session_register("rb_uname","rb_pass","rb_pin");
	$_SESSION['rb_uname']=$_POST['rb_uname'];
	$_SESSION['rb_pass']=$_POST['rb_pass'];
	$_SESSION['rb_pin']=$_POST['rb_pin'];
	$_SESSION['rb_power']=$_POST['rb_power'];
	$_SESSION['pin_table']=$result[0];
	$_SESSION['pin_id']=$result[1];
	$obj->redirect("demo.php");
	}
	else
	{
	$msg = "Incorrect login info";
	}
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" href="main_css/main_css.css"/>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
<style type="text/css">
.error
{
	font-size:13px;
	color:#C00;
	font-family:Arial, Helvetica, sans-serif;
}
.text_box_login
{
	height:5px;
	
}

</style>
<title>Login : Rainbow Tender Managment</title>


<link rel="stylesheet" type="text/css" media="screen" href="main_css/jquery.ui.potato.menu.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="main_js/menu_bar/jquery.ui.potato.menu.js"></script>

<script type="text/javascript">
/*(function($) {
    $(document).ready(function(){
        $('#menu1').ptMenu();
    });
})(jQuery);*/
</script>

</head>

<body>
<div id="index-header">
<img src="main_images/logo.png" style="float:left;"/>
<span id="head-title">Tender Managment Application</span>
</div>

<div id="index-main">
<div id="index-sub-main">
<div id="login">
<span id="footer-b-line" style="color:#FFFFFF; letter-spacing:2px;">login Pannel</span>
<form method="post" action="#" enctype="multipart/form-data" id="formID">
<table cellspacing="0" cellpadding="0">
  <tr>
    <td><label>User Name</label></td>
    <td><input type="text" name="rb_uname" style="height:35px;" /></td>
  </tr>
  <tr>
  <td colspan="2" height="4px"></td>
  </tr>
  <tr>
    <td><label>Password</label></td>
    <td><input type="password" name="rb_pass" style="height:35px;" /></td>
  </tr>
  <tr>
  <td colspan="2" height="4px"></td>
  </tr>
  <tr>
    <td><label>Pin</label></td>
    <td><input type="password" name="rb_pin" style="height:35px;" /></td>
  </tr>
  <tr>
  <td colspan="2" height="4px"></td>
  </tr>
  <tr>
  <td><label>Select</label></td>
  <td><select name="rb_power" id="rb_power" style="width:250px; height:35px; line-height:4px">
		<option value="">- Please Select -</option>
		<option value="admin">Admin</option>
		<option value="officer">Officer</option>
 		<option value="employee">Employee</option>  
        </select>     
 </td>
  </tr>
  <?php if($msg!=""){ ?>
  <tr>
  <td colspan="2" height="4px"></td>
  </tr>
  <tr>
  <td></td><td class="error"><?php echo $msg; ?></td>
  </tr>
  <tr>
  <td colspan="2" height="2px"></td>
  </tr>
  <?php } ?>
  
  <tr>
  <td colspan="2" height="4px"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="submit" value="login" id="example2"/></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><a href="#" id="footer-b-line" style="color:#fff; letter-spacing:1px;">Forgot Password !..??</a></td>
  </tr>
</table>
</form>
</div>
</div>

</div>
<div id="index-footer">
<?php include_once("main_includes/footer.php"); ?>

</div>


</body>
</html>