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
if((!isset($_GET['spl'])))
{
	$limited_tender_firms=$obj->Limited_Tender_Firms($_GET['id']);
}

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
$product_details=$obj->attach_records_products($_GET['id'],'tender_firm_product','tender_id');

//$product_details=$obj->attach_records_products_single($_GET['p'],'tender_firm_product');
//$list_firm = $obj->List_Drop_Down("consignee","csign_short_name","id");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Print firms</title>
<style>
*
{
	margin:0px; 
	padding:0px;
	font-family:Verdana, Geneva, sans-serif;
	
	font-size:14px;
}
#main_wrapper
{
	width:810px;
	height:auto;
	margin:0 auto;

	
	
}
#header
{
	width:740px;
	margin-top:10px;
	color:#000;
	font-size:28px;
	font-weight:bold;
	padding-left:200px;
}
#table_container
{
	width:100%;
	margin-top:30px;
	color:#000;
	
	
}
#table_container #tender_detail
{
	margin-left:0px;
	width:460px;
	font-size:18px;
	
	table-layout:fixed;
	letter-spacing:1px;
}
#table_container #tender_detail tr
{
	height:20px;
}
#table_container #item_detail
{
	margin-left:0px;
	width:460px;
	font-size:18px;
	float:left;
	table-layout:fixed;
	letter-spacing:1px;
}
#table_container #item_detail tr
{
	height:20px;
}
#dynamic_table
{
	border:1px solid #000;
	clear:both;
	margin-top:190px;
	
	
}
</style>
</head>
<body onload="window.print();">
<div id="main_wrapper">
<?php
$sno=1;

?>
<?php foreach($product_details as $g) 
{
	?>
<div id="header">
Rates to Quote <span style="font-size:12px;">(Product <?=$sno;?> of <?=count($product_details);?> )</span>
<? $sno++; ?>
</div>
<div id="table_container">
<table id="tender_detail">
<tr>
<td style="width:140px;">Tender Number:</td>
<td style="width:220px; word-wrap:break-word;">&nbsp;<?php print_r($tender_details['tender_number']); ?></td>
<td style="width:140px;">Tender Type:</td>
<td style="width:220px; word-wrap:break-word;">&nbsp;<?php echo $status;?></td>
</tr>
<tr>
<td style="width:140px;">Purchaer:</td>
<td style="width:220px; word-wrap:break-word;">&nbsp;<?php print_r($purchaser_detail['purchaser_short_name']); ?></td>
<td style="width:140px;">Due Date:</td>
<td style="width:220px; word-wrap:break-word;">&nbsp;<?php $new_date=$obj->Date_Format($tender_details['tender_due_date']); ?>
<?php echo $new_date; ?>
</td>
</tr>
<tr>
<td style="width:140px;">Due Time:</td>
<td style="width:220px; word-wrap:break-word;">&nbsp;<?php print_r($tender_details['tender_time']); ?></td>
<td style="width:140px;">EMD:</td>
<td style="width:220px; word-wrap:break-word;">&nbsp;<?php print_r($tender_details['tender_emd']); ?></td>
</tr>
<tr>
<td style="width:140px;">TDC:</td>
<td style="width:220px; word-wrap:break-word;">&nbsp;<?php print_r($tender_details['tender_tdc']); ?></td>
<td style="width:140px;">Sample Required:</td>
<td style="width:220px; word-wrap:break-word;">&nbsp;<?php if($tender_details['tender_sample']==0) { echo "Yes";} else { echo "No" ;} ?></td>
</tr>
</table>
<hr style="width:83%" />
</div>

    <br/>
    <div class="prodcut_info" style="height:auto; clear:both;">
    <div class="item_discription" style="clear:both; width:100%; word-wrap:break-word;">Item : <?=$g['item_discription'];?></div>
    <div class="consignee">Consignee : <?=$g['main_csign_short_name'];?></div>
    <div class="quantity"> Quantity : <?=$g['quantity'];?></div>
    <div class="unit">Unit : <?=$unit=$obj->unit($g['unit']);?></div>
    
    </div>
	<table id="dynamic_table" style="margin-top:10px;">
	<tr style="height:20px;"><td style="width:200px;border-right:1px solid #000; border-bottom:1px solid #000;"><b>Special Note</b></td>
	<td style="width:590px; padding-left:10px;border-bottom:1px solid #000;"><b>Detail of tender Product Rate</b></td>
	</tr>
		<?php for($i=0;$i<6;$i++) 
		{
		?>
			<tr>
			<td style="border-right:1px solid #000;border-bottom:1px solid #000;">&nbsp;</td>
			<td style="border-bottom:1px solid #000;">
			<table>
    		<tr style="height:30px;">
    		<td style="width:300px;">Firm:_______________________</td><td>Tax Type:______________________</td>
    		</tr>
    		<tr style="height:30px;">
      		<td style="width:300px;">Inspection:__________________</td><td>Tax :_________________________</td>
    		</tr>
    		<tr style="height:30px;">
     		<td style="width:300px;">Payment:____________________</td><td>Discount:______________________</td>
    		</tr>
    		<tr>
      		<td style="width:300px;">Rate:_______________________</td><td>Misc:__________________________</td>
    		</tr>
    		<tr style="height:30px;">
      		<td style="width:300px;">Validity:_____________________</td>
    		</tr>
    		</table>
    
			</td>
			</tr>
			<?php } ?>
</table>
<br/>
<hr style="clear:both;width:83%;" />
 <?php } ?>
</div>
</body>
</html>

