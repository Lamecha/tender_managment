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
//$result = $obj->common_update_allcolm('item_manager','created_by','updated_by');
$result = $obj->common_update_allcolm2_order_by_short('item_manager','created_by','created_table','updated_by','updated_table','item_name');
if(isset($_GET['val']) && $_GET['val']!="")
$result2 = $obj->common_fetchdata('item_manager',$_GET['val']);

if($_POST['submit'])
{
	
		if($_FILES['files']['name']=="")
		{
			$name = $result2['file_real_name'];
			$finalName = $result2['file'];
		}
		else
		{
		$name = $_FILES['files']['name'];
		$tmp_name = $_FILES['files']['tmp_name'];
		$ext = $obj->getExtension($name);
		$newName = $obj->nameGen();
		$finalName  = $newName.".".$ext;
		move_uploaded_file($tmp_name,"attachements/items_attach/".$finalName);
		}
		$result_update = $obj->Update_Item($_POST['titles'],$_POST['discription'],$finalName,$name,$_GET['val'],$_SESSION['pin_id'],$_SESSION['pin_table']);
		if($result_update==1)
		$obj->redirect("item_update.php");
	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="main_includes/add_new_row.js"></script>
<link rel="stylesheet" href="main_css/main_css.css"/>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
<title>Update Item : Rainbow Tender Managment</title>
<link rel="stylesheet" type="text/css" media="screen" href="main_css/jquery.ui.potato.menu.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="main_js/menu_bar/jquery.ui.potato.menu.js"></script>


<script type="text/javascript">

	$(document).ready(function()
	{
		$('table#attachments td a.delete').click(function()
		{
			var delid=$(this).attr('id');
			
			
			var tablename="item_manager";
			var subtable1="tender_firm_product";
			var subcolmn1="category";
			
			
			if (confirm("Are you sure you want to delete this row?"))
			{
				var id = $(this).parent().parent().attr('id');
				
				var data = 'id=' + id ;
				var parent = $(this).parent().parent();

				$.ajax(
				{
					   type: "GET",
					   
					   url: "MainAjax.php?delid="+delid+"&tablename="+tablename+"&subtable1="+subtable1+"&subcolmn1="+subcolmn1,
					   data: data,
					   cache: false,
					
					    success: function(data)
					   {
						 if(data=="yes")
							   {
								
						  parent.fadeOut('slow', function() {$(this).remove();});
							   }
							   else
							   {
								   alert("Record can't be deleted \n Please check tender's products.");
							   }
						}
						
				 });				
			}
		});
		
		
		
		// style the table with alternate colors
		// sets specified color for every odd row
		$('table#multipels tr:odd').css('background',' #FFFFFF');
	});
	
</script>
<script type="text/javascript">
(function($) {
    $(document).ready(function(){
        $('#menu1').ptMenu();
    });
})(jQuery);
</script>
<script>
function Edit_Directors(ss)
{
	window.location="http://www.kareenak.net";
}
</script>
<?php include_once("main_includes/date_picker.php");?> 

</head>

<body>
<?php include_once("main_includes/msg_box.php"); ?>
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
<span id="title_work_page">Item Update/Delete</span>
<div id="working-sub-main">
<div id="working-panel">
<form method="post" enctype="multipart/form-data" id="formID">
<table  id="attachments" class="attachz" style="width:1000px;">

<tr><th width="250px">Name</th><th width="250px">Description</th><th width="250px">File</th>
<th width="100">Created by</th><th width="100">Updated by</th>
<th width="80px">Edit</th><th width="80px">Delete</th>
</tr>
<?php
foreach($result as $v)
{
	if($v['id']==$_GET['val'])
	{
		?>
		<tr>
<td style="text-align:center; font-size:12px;"><input type="text" id="titles" name="titles" class="validate[required] Xtext-input" value="<?=$v['item_name'];?>" style="width:250px;height:30px;" /></td>
<td style="text-align:center; font-size:12px;"><input type="text" id="discription" name="discription" value="<?=$v['item_discription'];?>" style="width:250px;height:30px;" /></td>
<td style="text-align:center; font-size:12px;"><input type="file" name="files" id="files" style="width:250px;height:30px;" /></td>
<td style="text-align:center; font-size:12px;"><input type="text" id="created_by" name="created_by" value="" style="width:50px; height:30px;" readonly="readonly" /></td>
<td style="text-align:center; font-size:12px;"><input type="text" id="updated_by" name="updated_by" value="" style="width:50px;height:30px;" readonly="readonly" /></td>
<td style="text-align:center;"><input type="submit" id="submit" class="submit" name="submit" value="Save" style="height:30px; width:80px;" /></td>
<td style="text-align:center; border:1px solid #666"><a href="#" id="<?=$v['id'];?>" class="delete"><img src="main_images/delete.png" /></a></td>
</tr>

<?php
	}
	else
	{
?>
<tr>
<td style="text-align:center; font-size:12px; border:1px solid #666; height:27px;"><?=$v['item_name'];?></td>
<td style="text-align:center; font-size:12px; border:1px solid #666; height:27px;"><?=$v['item_discription'];?></td>
<td style="text-align:center; font-size:12px; border:1px solid #666"><?php if($v['file']!="No_Download") { ?><a href="attachements/items_attach/<?=$v['file'];?>"><?=$v['file_real_name'];?></a><?php } else { ?><?=$v['file_real_name'];?><?php } ?></td>
<td style="text-align:center; font-size:12px; border:1px solid #666; height:27px;"><label><font style="font-size:12px"><?php if($v['created_by_name']=="") { echo "-";} else { ?><a class="opener" onclick="AjaxMsg('<?=$v['created_by'];?>','<?=$v['created_table'];?>')" style="cursor:pointer;"><?=$v['created_by_name']; } ?></a></font></label></td>
<td style="text-align:center; font-size:12px; border:1px solid #666"><label><font style="font-size:12px"><?php if($v['updated_by_name']=="") { echo "-";} else { ?><a class="opener" onclick="AjaxMsg('<?=$v['updated_by'];?>','<?=$v['updated_table'];?>')" style="cursor:pointer;"><?=$v['updated_by_name']; } ?></a></font></label></td>
<td style="text-align:center; border:1px solid #666; height:27px;"><a href="item_update.php?val=<?=$v['id'];?>"><img src="main_images/edit.png" /></td>
<td style="text-align:center; border:1px solid #666; height:27px;"><a href="#" id="<?=$v['id'];?>" class="delete"><img src="main_images/delete.png" /></a></td>
</tr>
<?php	
}
}
?>
</table>
</table></form>


</div></div>
</div>
<div id="index-footer">
<?php  include_once("main_includes/footer.php"); ?>

</div>


</body>
</html>