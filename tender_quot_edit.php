<?php
session_start();
require_once("main_includes/main_class.php");

$obj = new main_front_class();

if(isset($_POST['submit']))
{
	$result = $obj->UpdateTenderFirm($_POST);
}

if(!isset($_SESSION['rb_uname']) || !isset($_SESSION['rb_pass']) || !isset($_SESSION['rb_pin']) || !isset($_SESSION['rb_power']))
{
	$obj->redirect("index.php");
}
else
{
	$result_login = $obj->LoginData($_SESSION['rb_power'],$_SESSION['rb_uname']);
}
$tender_details=$obj->common_fetchdata('tender',$_GET['id']);
$purchaser_detail=$obj->common_fetchdata('create_purchaser',$tender_details['tender_purchaser']);
if($tender_details['tender_type']==0)
	$status='Advertise';
	if($tender_details['tender_type']==1)
	$status='Limited';
	if($tender_details['tender_type']==2)
	$status='Bulletin';
	if($tender_details['tender_type']==3)
	$status='SPL Limited';
	if($tender_details['tender_type']==4)
	$status='Local Purchaser';
	$product_details=$obj->attach_records_products_with_firms($_GET['id']);
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="main_includes/add_new_row.js"></script>
<link rel="stylesheet" href="main_css/main_css.css"/>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>

<style type="text/css">
.attachz tr td
{
	font-size:12px;
	padding-left:5px;
	
}

</style>
 
<title>Tenders Quotation Edit : Rainbow Tender Managment</title>


    <link rel="stylesheet" type="text/css" media="screen" href="main_css/jquery.ui.potato.menu.css" />
    
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="main_js/menu_bar/jquery.ui.potato.menu.js"></script>
<script type="text/javascript" src="main_js/AjaxJavaSCript.js"></script>
<script type="text/javascript">

	$(document).ready(function()
	{
		$('table#firm_table td a.delete').click(function()
		{
			var delid=$(this).attr('id');
			
			var tablename="tender_firms";
			
			
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
					
					   success: function()
					   {
							parent.fadeOut('slow', function() {$(this).remove();});
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
//var shaan = jQuery.noConflict();
(function($) {
	
    $(document).ready(function(){
        $('#menu1').ptMenu();
    });
})(jQuery);
</script>
<script>

 $('.ProductSubmit').live(click,function() {
	 alert('kareena');
 });
/*$(".ProductSubmit").click(function(){
		alert('shakeb');
	});*/
</script>

<?php include_once("main_includes/date_picker.php");?> 
<link rel="stylesheet" type="text/css" href="main_css/paginate.css">
<script type='text/javascript' src='http://code.jquery.com/jquery-1.7.1.js'></script>
<?php include_once("main_includes/alert_product.php") ?>
</head>
<body>
<?php include_once("main_includes/msg_box.php"); ?>
<div id="index-header">
<?php include_once("main_includes/main_header.php");?> 

</div>
<div id="index-navigation">
<?php 
$meenubar = $_SESSION['rb_power']."_menu.php";
include_once("main_includes/".$meenubar); ?> 
</div>
<div id="index-main">
<span id="title_work_page">Update Firms of Tender No. <?php print_r($tender_details['tender_number']); ?></span>
<div id="working-sub-main">
<div id="working-panel" >
<!--slider-->
<div id="Xmahro">
<div id="Xmain-container" style="margin-left:0px;">
<table id="firm_table">
<?php for($i=0;$i<sizeof($product_details);$i++) 
{
?>
	<tr class="heighlight"><th colspan="3"><?php print_r($product_details[$i]['item_name']) ?></th></tr>
    <?php $firm_details=$obj->FirmsDetails($product_details[$i]['id']);     if($firm_details[0]=="") {?>
    <tr style="background-color:#f7a3af;"><td colspan="3" style="height:25px;">No Firms available</td></tr>
    <tr><td colspan="3" style="height:10px;"></td></tr>
    
    <?php } else { 
	for($k=0;$k<sizeof($firm_details);$k++)
	{
		?>
        <tr style="background-color:#d7f6cc;"><td style="width:400px; height:20px;"><?php print_r($firm_details[$k]['csign_firm_name']); ?></td><td style="width:50px;"><a href="#" class="ajax" id="<?php print_r($firm_details[$k]['id']); ?>"><img src="main_images/edit.png" /></a></td><td style="width:50px;"><a href="#" id=<?php print_r($firm_details[$k]['id']);?>  class="delete"><img src="main_images/delete.png" /></a></td></tr>
		<?php
	}
	
	?>
     <tr><td colspan="3" style="height:10px;"></td></tr>
    <?php } ?>
    

<?php
}
?>
</table>
</div>
</div>
<!--slider-->
</div>
<div id="right_old_info">
<div id="old_info_span">
<span style="margin-left:150px">
Old Information
</span>
<table width="270" id="infos" cellspacing="6">
<tr>
<td width="91">Tender No : </td>
<td width="124"> <?php print_r($tender_details['tender_number']); ?></td>

</tr>
<tr>
<td>Tender Type : </td>
<td> <?php echo $status;  ?></td>

</tr>
<tr>
<td>Purchaser : </td>
<td> <a href="#?id=<?php print_r($purchaser_detail['id']); ?>"><?php print_r($purchaser_detail['purchaser_name']); ?></a></td>

</tr>
<tr>
<td>Due Date : </td>
<td> <?php print_r($tender_details['tender_due_date']); ?></td>
<td width="19"></td>
</tr>
<tr>
<td>TDC : </td>
<td> <?php print_r($tender_details['tender_tdc']); ?></td>

</tr>
<tr>
<td>EMD : </td>
<td> <?php print_r($tender_details['tender_emd']); ?></td>

</tr>
</table>

</div>

</div>

</div>

</div>
<div id="index-footer">
<?php  include_once("main_includes/footer.php"); ?>

</div>

</body>
</html>