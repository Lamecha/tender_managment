<?php
session_start();
require_once("main_includes/main_class.php");
$obj = new main_front_class();
if(!isset($_SESSION['rb_uname']) || !isset($_SESSION['rb_pass']) || !isset($_SESSION['rb_pin']) || !isset($_SESSION['rb_power']))
{
	//$obj->redirect("index.php");
}
else
{
	$result_login = $obj->LoginData($_SESSION['rb_power'],$_SESSION['rb_uname']);
	
}
$tender_details=$obj->common_fetchdata('tender',$_GET['id']);
$purchaser_detail=$obj->common_fetchdata('create_purchaser',$tender_details['tender_purchaser']);
$attachments=$obj->attach_records($_GET['id'],'tender_attachments','tender_id');
//if($tender_details['tender_type']==1 && (!isset($_GET['spl'])))
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
$product_details=$obj->attach_records_products_single($_GET['p'],'tender_firm_product');
if(isset($_GET['spl']) && $_GET['spl']!='')
{
	$record_update = $obj->Firm_Data_Printing_Time($_GET['spl']);
	
	$result_attachment = $obj->common_fetch_attachement('tender_quoted_attachments','tender_firm_id',$_GET['spl']);
	$quoted_by_name = $obj->NameOfLogedInPin($_SESSION['pin_table'],$_SESSION['pin_id']);
	 	
}
if(isset($_POST['submit']) && $_POST['key']==$_SESSION['key'])
{
	$finalName = array();
	$name = array();
	for($i=0;$i<sizeof($_POST['titles']);$i++)
	{
		$name[$i] = $_FILES['files']['name'][$i];
		$tmp_name = $_FILES['files']['tmp_name'][$i];
		$ext = $obj->getExtension($name[$i]);
		$newName = $obj->nameGen();
		$finalName[$i]  = $newName.".".$ext;
		move_uploaded_file($tmp_name,"attachements/Tender_Quoted/".$finalName[$i]);
	}
	$save_bid = $obj->SaveBidNumberInFirm_PRINTING_FIRM($_POST['bid_number'],$finalName,$name,$_POST['titles'],$_SESSION['pin_id'],$_SESSION['pin_table'],$_POST['c_rates'],$_GET['spl'],$_GET['id']);
	
	
	
	
	if($save_bid)
	{
		?>
        <script type="text/javascript">
		window.location="tender_quot_new.php?id=<?php echo $_GET['id']; ?>&val=<?php echo $_GET['val']; ?>";
		</script>
        <?php
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
<script type="text/javascript" src="main_includes/add_new_row.js"></script>
<link rel="stylesheet" href="main_css/main_css.css"/>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
<title>Give Quote to Firm of tender <?php print_r($tender_details['tender_number']); ?> : Rainbow Tender Managment</title>
<link rel="stylesheet" type="text/css" media="screen" href="main_css/jquery.ui.potato.menu.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="main_js/menu_bar/jquery.ui.potato.menu.js"></script>
<script type="text/javascript" src="main_js/AjaxJavaSCript.js"></script>

<script type="text/javascript">
(function($) {
    $(document).ready(function(){
        $('#menu1').ptMenu();
    });
})(jQuery);
</script>
<!----------SELECT BOXES AT THE TIME OF ADD MORE--------------->

<script>
function CheckBidNumber()
{
	var bid_number = document.getElementById('bid_number').value;
	var b_final = $.trim(bid_number);

	if(b_final=='')
	{
		alert('Bid Number can not be empty');
		return false;
	}
	
}
</script>
<!-------------------------------------------------------------->
<style>
#working-sub-main #working-panel table tr td input[type=text]
{
	width:100px;
	height:25px;
	
}
#working-sub-main #working-panel table tr td select
{

	height:25px;
	width:100px;
	border:1px solid #696969;
}
#working-sub-main #working-panel table.attachz tr th
{
	word-wrap:break-word;
	width:100px;
	
}
.info_p_tr
{

	height:20px;
}
.info_p_td
{
	width:250px;
	word-wrap:break-word;
	
}
.showing th
{
	width:300px;
	background:#e95958;
	height:28px;
	color:#fff;
	font-size:13px;
	font-weight:normal;
	
}
.showing td
{
	width:297px;
	height:35px;
	color:#000;
	font-size:13px;
	font-weight:normal;
	border:1px solid #333;
	word-wrap:break-word;
	padding-left:3px;
	
}
</style>
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
<span id="title_work_page">Products in Tender No. <?php print_r($tender_details['tender_number']); ?></span>
<div id="working-sub-main">
<div id="working-panel" style="background:#FFF;width:auto;">
<!-------OLD INFO TENDER---------->
<div id="left_div" style="float:left; width:400px;height:auto;">
<div id="old_info_span" style="min-height:40px; height:auto; padding-top:10px; border:none;">
<span style="margin-left:0px;font-size:18px; margin-top:10px;width:380px;word-wrap:break-word; border-bottom:1px solid #333;">
Information of Tender No. <?php print_r($tender_details['tender_number']); ?>
</span>
</div>
<table id="infos" style="margin-left:10px;margin-top:4px; width:350px; table-layout:fixed;" >
<tr class="info_p_tr">
<td style="width:110px;">Tender No : </td>
<td style="width:240px;word-wrap:break-word;"> <?php print_r($tender_details['tender_number']); ?></td>
</tr>
<tr class="info_p_tr">
<td style="width:110px;">Tender Type : </td>
<td style="width:240px;word-wrap:break-word;"><?php echo $status;  ?></td>
</tr>
<tr class="info_p_tr">
<td style="width:110px;">Purchaser : </td>
<td style="width:240px;word-wrap:break-word;"> 
<a href="#?id=<?php print_r($purchaser_detail['id']); ?>"><?php print_r($purchaser_detail['purchaser_short_name']); ?></a></td>
</tr>
<tr class="info_p_tr">
<td style="width:110px;">Due Date : </td>
<?php $new_date=$obj->Date_Format($tender_details['tender_due_date']); ?>
<td style="width:240px;word-wrap:break-word;"><?php echo $new_date; ?></td>
</tr>
<tr class="info_p_tr">
<td style="width:110px;">TDC : </td>
<td style="width:240px;word-wrap:break-word;"><?php print_r($tender_details['tender_tdc']); ?></td>
</tr>
<tr class="info_p_tr">
<td style="width:110px;">EMD : </td>
<td style="width:240px;word-wrap:break-word;"><?php print_r($tender_details['tender_emd']); ?></td>
</tr>
</table>
</div>

<!--------------------------------->


<!--------------------DownLoad Files-------------------->
<div id="sub_right_info" style="float:left; width:400px;height:auto;">
<div id="old_info_span" style="min-height:40px; height:auto; padding-top:10px; border:none;">
<span style="margin-left:0px;font-size:18px; margin-top:10px;width:380px;word-wrap:break-word; border-bottom:1px solid #333;">
Attachements of Tender No. <?php print_r($tender_details['tender_number']); ?> 
</span>
</div>
<table id="infos" style="margin-left:10px;margin-top:4px; width:350px; table-layout:fixed;">
<?php
$sm=0;
foreach($attachments as $njX)
{
	$sm++;
	?>
   <tr class="info_p_tr"><td style="width:20px;">[<?php echo $sm; ?>]</td><td style="width:330px; word-wrap:break-word;">&nbsp; <a href="attachements/tender_attach/<?=$njX['file'];?>" target="_new"><?=$njX['title'];?></a></td></tr>
    <?php
	
}
?>
</table>
</div>

<!------------------------------------------------------->


<div id="old_info_span" style="clear:both;padding-top:20px; border:none">
<span style="margin-left:0px;border-bottom:1px solid #000;">Generate Bid Refrence number/<a style="font-size:14px; text-decoration:none; color:#036; cursor:pointer;" title="<?php print_r($record_update['file_real_name']) ?>" href="attachements/Rate_On_Print/<?php print_r($record_update['file']); ?>" target="_blank">View Uploaded Statement</a> 
</span>
</div>


<!------------------------------->
<form action="#" method="post" enctype="multipart/form-data" onSubmit=" return CheckBidNumber();">
<table style="margin-left:10px;">
<caption><?php print_r($record_update['main_csign_short_name']); ?></caption>
<tr>
<th style="height:35px; width:300px; background:#33CCFF; font-size:12px;">Bid Reference Number</th>
<th style="height:35px; width:300px; background:#33CCFF; font-size:12px;">Quoted By</th>
<th style="height:35px; width:300px; background:#33CCFF; font-size:12px;">Compititor Rates</th>
</tr>
<tr>
<td>
<input style="width:300px; height:45px; border:1px solid #333" type="text" id="bid_number" name="bid_number" value="<?php print_r($record_update['bid_number']); ?>" />
</td>
<td>
<input style="width:300px; height:45px; border:1px solid #333" type="text" id="quoted_by" name="quoted_by" value="<?php print_r($quoted_by_name['quoted_name']); ?>" readonly />
</td>
<td>
<textarea id="c_rates" name="c_rates" style="border:1px solid #333; width:300px; height:65px;"><?php print_r($record_update['bid_rate']); ?></textarea>
</td>
</tr>
<input type="hidden" name="key" id="key" value="<?php echo $_SESSION['key']; ?>" />
</table>
<table id="attachments" class="attachz" style="width:500px;">
<caption>Attachments <?php if(isset($_GET['val']) && $result_attachment[0]!='') { ?> <a class="link_edit_director" onClick="window.open('record_attachments.php?val=<?php echo($_GET['spl']); ?>&table=tender_quoted_attachments&field=tender_firm_id','mywindow','width=400,height=300,left=100,top=100,screenX=0,screenY=100')">/Delete old </a><?php } ?></caption>
<tr><th>Title</th><th>File</th></tr>
<?php if(isset($_GET['val']) && $result_attachment[0]!='') { ?>
<?php foreach($result_attachment as $mla) { ?>
<tr>
<td style="border:1px solid #696969; height:25px; font-size:13px;"><?=$mla['title'];?></td>
<td style="border:1px solid #696969; height:25px; font-size:13px;"><?=$mla['file_real_name'];?></td>
</tr>
<?php } } ?>
<tr id="first_c">
<td><input type="text" name="titles[]"/></td>
<td><input type="file" name="files[]"/></td>
</tr>
<tr style="background:#fff;"><td>&nbsp;</td><td><input type="button" name="add_more" id="add_more" value="Add More" class="add_more" onClick="add_mores_firm_regi('first_c');"/></td></tr>
</table> 

<table><tr><td><input type="submit" name="submit" id="main_submit" value="Save Bid"/></td></tr></table>
</form>
<!----------------------------------------------------->

</div>
</div>
</div>
<div id="index-footer">
<?php  include_once("main_includes/footer.php"); ?>
</div>


</body>
</html>