<?php
session_start();
include("main_includes/main_class.php");
$obj = new main_front_class();
if(!isset($_SESSION['rb_uname']) || !isset($_SESSION['rb_pass']) || !isset($_SESSION['rb_pin']) || !isset($_SESSION['rb_power']))
{
	$obj->redirect("index.php");
}
else
{
	$result_login = $obj->LoginData($_SESSION['rb_power'],$_SESSION['rb_uname']);
	
}
$list_Office = $obj->List_Drop_Down("office","office_name","id");
if(isset($_GET['val']) && $_GET['val']!="")
{
	$result = $obj->common_fetchdata_FETCH_ARRAY($_GET['p'],$_GET['val']);
	//print_r($result);
	$colm=$_GET['p']."_office";
	$office_name_id = $obj->Common_name_id('office','office_name',$result[$colm]);
}
if(isset($_POST['submit']))
{
	$obj->redirect($_GET['a']);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="main_includes/add_new_row.js"></script>
<link rel="stylesheet" href="main_css/main_css.css"/>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
<style type="text/css">


</style>
<title><?php print_r($result[1]); echo " [".$_GET['p']."]"; ?> : Rainbow Tender Managment</title>


    <link rel="stylesheet" type="text/css" media="screen" href="main_css/jquery.ui.potato.menu.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="main_js/menu_bar/jquery.ui.potato.menu.js"></script>
<script type="text/javascript">
//var $j = jQuery.noConflict();
(function($) {
	
    $(document).ready(function(){
        $('#menu1').ptMenu();
    });
})(jQuery);
</script>
<?php include_once("main_includes/date_picker.php");?> 

</head>

<body>
<div id="index-header">
<?php include_once("main_includes/main_header.php");?> 
<?php include_once("main_includes/main_validation.php");?> 
</div>
<div id="index-navigation">
<?php 
$meenubar = $_SESSION['rb_power']."_menu.php";
include_once("main_includes/".$meenubar); ?> 
</div>
<div id="index-main">
<span id="title_work_page"><?php print_r($result[1]); echo " [".$_GET['p']."]"; ?></span>
<div id="working-sub-main">
<div id="working-panel">

<form method="post" enctype="multipart/form-data" id="formID">
<table id="working-form" style="float:left">


<tr><td><label for="fname">First Name</label></td>
<td style="border:1px solid #000; width:50px; height:30px; t"><label>&nbsp;&nbsp;<?php print_r($result[1]); ?></label></td></tr>
<tr><td><label  for="lname">Last Name</label></td>
<td style="border:1px solid #000; width:200px; height:30px; t"><label>&nbsp;&nbsp;<?php print_r($result[2]); ?></label></td></tr>
<tr><td><label  for="office">Select Office</label></td>
<td style="border:1px solid #000; width:50px; height:30px; t"><label>&nbsp;&nbsp;<?php print_r($office_name_id['office_name']); ?></label></td></tr>
<tr><td><label  for="user">Username</label></td>
<td style="border:1px solid #000; width:50px; height:30px; t"><label>&nbsp;&nbsp;<?php print_r($result[4]); ?></label></td></tr>

<tr><td><label for="email">Email</label></td>
<td style="border:1px solid #000; width:50px; height:30px; t"><label>&nbsp;&nbsp;<?php print_r($result[8]); ?></label></td></tr>
<tr><td><label for="mobile">Mobile</label></td>
<td style="border:1px solid #000; width:50px; height:30px; t"><label>&nbsp;&nbsp;<?php print_r($result[9]); ?></label></td></tr>
<tr><td><label for="address">Address</label></td>
<td style="border:1px solid #000; width:50px; height:30px; t"><label>&nbsp;&nbsp;<?php print_r($result[10]); ?></label></td></tr>
</table>

<div style="float:left; margin-top:20px; margin-left:20px;">
 <img src="photo/<?php echo $_GET['p']; ?>/main/<?php  print_r($result[7]); ?>" height="195" width="150" style="margin-left:5px; margin-top:5px; float:left;"/>
</div>

<table style="clear:both"><tr><td style="width:68px;"></td><td><input type="submit" name="submit" id="main_submit" value="Back"/></td></tr>
</table>
<input type="hidden" name="key" id="key" value="<?php echo $_SESSION['key']; ?>" />
</form>





</div>
</div>

</div>
<div id="index-footer">
<?php  include_once("main_includes/footer.php"); ?>

</div>


</body>
</html>