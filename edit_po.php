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
//$result = $obj->common_update_allcolm('office','created_by','updated_by');
$result = $obj->common_update_allcolm2_order_by_short('po','created_by','created_table','updated_by','updated_table','po_number');
?>
<?php
$_SESSION['key']=mt_rand(1,1000);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="main_includes/add_new_row.js"></script>
<link rel="stylesheet" href="main_css/main_css.css"/>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
<title>Update PO : Rainbow Tender Managment</title>
<link rel="stylesheet" type="text/css" media="screen" href="main_css/jquery.ui.potato.menu.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="main_js/menu_bar/jquery.ui.potato.menu.js"></script>
<script type="text/javascript">

	$(document).ready(function()
	{
		$('table#multipels td a.delete').click(function()
		{
			var delid=$(this).attr('id');
			
			var tablename="po";
			/*var subtable1="officer";
			var subcolmn1="officer_office";
			var subtable2="employee";
			var subcolmn2="employee_office";*/
			
			
			if (confirm("Are you sure you want to delete this row?"))
			{
				var id = $(this).parent().parent().attr('id');
				
				var data = 'id=' + id ;
				var parent = $(this).parent().parent();

				$.ajax(
				{
					   type: "GET",
					   
					   url: "MainAjax.php?delid="+delid+"&tablename="+tablename,
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
								   alert("Record can't be deleted \n Please check officers or employees.");
							   }
						}
						
				 });				
			}
		});
		// style the table with alternate colors
		// sets specified color for every odd row
		//$('table#multipels tr:odd').css('background',' #FFFFFF');
	});
	
</script>
<script type="text/javascript">
(function($) {
    $(document).ready(function(){
        $('#menu1').ptMenu();
    });
})(jQuery);
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
<span id="title_work_page">Update/Delete Officer</span>
<div id="working-sub-main">
<div id="working-panel">
<table id="multipels" class="attachz">

<tr><th width="200">Name</th><th width="200">Created by</th><th width="200">Updated by</th><th width="70">Edit</th><th width="70">Delete</th><th width="70">View</th></tr>
<?php 
foreach($result as $v)
{
?>
<tr id="first_dirct" class="basic_table_style">
<td style="text-align:center" class="basic_text_style"><label><font style="font-size:12px"><?=$v['po_number']; ?></font></label></td>
<td style="text-align:center" class="basic_text_style"><label><font style="font-size:12px"><?php if($v['created_by_name']=="") { echo "-";} else { ?><a class="opener" onclick="AjaxMsg('<?=$v['created_by'];?>','<?=$v['created_table'];?>')" style="cursor:pointer;"><?=$v['created_by_name']; } ?></a></font></label></td>
<td style="text-align:center" class="basic_text_style"><label><font style="font-size:12px"><?php if($v['updated_by_name']=="") { echo "-";} else { ?><a class="opener" onclick="AjaxMsg('<?=$v['updated_by'];?>','<?=$v['updated_table'];?>')" style="cursor:pointer;"><?=$v['updated_by_name']; } ?></a></font></label></td>
<td width="100" style="text-align:center"><a href="add_po.php?val=<?=$v['id'];?>"><img src="main_images/edit.png" /></td></a>
<td width="100" style="text-align:center"><a href="#" id="<?=$v['id'];?>" class="delete"><img src="main_images/delete.png" /></a></td>
<td width="100" style="text-align:center"><a href="All_profile_view_files/po_profile.php?val=<?=$v['id'];?>&pid=<?=$_GET['pid'];?>" target="_blank"><img src="main_images/view.png" /></a></td>
</tr>
<tr><td height="2px"></td></tr>
<?php
}
?>
</table>
</div>
</div>
</div>
<div id="index-footer">
<?php  include_once("main_includes/footer.php"); ?>

</div>


</body>
</html>