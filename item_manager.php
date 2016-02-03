<?php
session_start();
require_once("main_includes/main_class.php");
$obj = new main_front_class();
if(!isset($_SESSION['rb_uname']) || !isset($_SESSION['rb_pass']) || !isset($_SESSION['rb_pin']) || !isset($_SESSION['rb_power']))
{
	$obj->redirect("index.php");
}
else
{
	$result_login = $obj->LoginData($_SESSION['rb_power'],$_SESSION['rb_uname']);
	
}
if(isset($_GET['val'])==1 && $_GET['val']!="")
{
	$result=$obj->common_fetchdata('item_manager',$_GET['val']);
}
if(isset($_POST['submit']) && $_POST['key']==$_SESSION['key'])
{
	/*$finalName = array();
	$name = array();
	for($i=0;$i<sizeof($_POST['titles']);$i++)
	{
		if($_POST['titles'][$i]!="")
		{
			if($_FILES['files']['name'][$i]!="")
			{
			$name[$i] = $_FILES['files']['name'][$i];
			$tmp_name = $_FILES['files']['tmp_name'][$i];
			$ext = $obj->getExtension($name[$i]);
			$newName = $obj->nameGen();
			$finalName[$i]  = $newName.".".$ext;
			move_uploaded_file($tmp_name,"attachements/items_attach/".	$finalName[$i]);
		}
			else
			{
				$name[$i]="No_Download";
				$finalName[$i]="No_Download";
			}
		}
		
		
	}*/
	
	//$result = $obj->store_items_attachments($_POST,$finalName,$name,$_SESSION['pin_id'],$_SESSION['pin_table']);
	if(isset($_GET['val'])==1 && $_GET['val']!="")
	{
		$update_item=$obj->Update_Item_New($_POST,$_SESSION['pin_id'],$_SESSION['pin_table'],$_GET['val']);
		$obj->ALertMessage("Item Updated Successfully",$update_item);
		$obj->redirect("item_update.php");
		
	}
	else
	{
	$result = $obj->store_items_attachments($_POST,$_SESSION['pin_id'],$_SESSION['pin_table']);
	$obj->ALertMessage("Item category registered",1);
	}
}
?>
<?php
$_SESSION['key']=mt_rand(1,1000);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" href="main_css/main_css.css"/>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
<title>Item Manager : Rainbow Tender Managment</title>


<?php include_once("main_includes/main_menu.php");?> 
<script type="text/javascript" src="main_includes/add_new_row.js"></script>
<?php include_once("main_includes/date_picker.php");?> 

</head>

<body>
<div id="index-header">
<?php include_once("main_includes/main_header.php");?> 
</div>
<div id="index-navigation">
<?php 
$meenubar = $_SESSION['rb_power']."_menu.php";
include_once("main_includes/".$meenubar); ?> 
</div>
<div id="index-main">
<span id="title_work_page">Item Manager</span>
<div id="working-sub-main">
<div id="working-panel">
<form method="post" enctype="multipart/form-data">
<table  id="attachments" class="attachz">

<tr><th>Item Category</th><th>Description</th></tr>

<tr id="first_0">
<td><textarea rows="3" cols="30" name="titles[]" style="border:1px solid #333;"><?php print_r($result['item_name']); ?></textarea></td>
<td><textarea rows="3" cols="30" style="border:1px solid #333;" name="discription[]"><?php print_r($result['item_discription']); ?></textarea></td>
<!--<td><input type="file" name="files[]"/></td>-->
</tr>
<?php if(!isset($_GET['val'])) 
{
?>
<tr style="background:#fff;"><td><input type="button" name="add_more" id="add_more" value="Add More" class="add_more" onclick="add_mores_items_AFTER_CHANGE();"/></td><td></td><td></td></tr>
<input type="hidden" id="hide_for_text_area" name="hide_for_text_area" value="1" />
<?php
}
?>
<tr><td><input type="submit" name="submit" value="Save"/></td><td>&nbsp;</td></tr>
<input type="hidden" name="key" id="key" value="<?php echo $_SESSION['key']; ?>" />
</table></form>


</div></div>
</div>
<div id="index-footer">
<?php  include_once("main_includes/footer.php"); ?>

</div>


</body>
</html>