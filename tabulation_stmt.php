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
$tender_details=$obj->common_fetchdata('tender',$_GET['id']);
$purchaser_detail=$obj->common_fetchdata('create_purchaser',$tender_details['tender_purchaser']);
$office_detail=$obj->common_fetchdata('office',$tender_details['tender_office']);
$product_details=$obj->attach_records_products($_GET['id'],'tender_firm_product','tender_id');
$firms_for_remark = $obj->FetchFirmsForRemarkInTabulation($_GET['id']);


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" href="main_css/main_css.css"/>
<style type="text/css">
*
{
	margin:0;
	padding:0;
	
}
#wrapper
{
	width:1200px;
	height:auto;
	min-height:600px;

	margin:5px auto 0px auto;
}
#office
{
	width:100%;
	height:25px;
    font-family: 'BebasNeueRegular';
	letter-spacing:1px;
	color:#363636;
	border-bottom:1px solid #000;
		border-top:1px solid #000;
		line-height:25px;
		padding-left:5px;

	
	
}
#sec_strip
{
	width:100%;
	height:25px;
    font-family: 'BebasNeueRegular';
		letter-spacing:1px;
	color:#363636;
	border-bottom:1px solid #000;
		border-top:1px solid #000;
		line-height:25px;
		padding-left:5px;
		margin-top:10px;
		

	
	
}
#sec_strip span
{
	font-family: 'BebasNeueRegular';
	letter-spacing:1px;
	color:#363636;
	margin-left:130px;		

}
p
{
	text-align:center;
	font-family: 'BebasNeueRegular';
	letter-spacing:1px;
	color:#363636;
	margin-top:5px;
}
table
{
	border-collapse:collapse;
	text-align:center;
	margin-top:20px;
}
table th
{
	text-align:center;
	font-family: 'BebasNeueRegular';
	letter-spacing:1px;
	color:#363636;
	font-weight:normal;
	height:30px;
}
table tr td
{
	min-height:35px;
	height:auto;
	word-wrap:break-word;
	font-size:12px;
	height:20px;
}
</style>
<title>abulation Statement of Financial Bids for Tender No: 79131842 ::  Due Date/Time : 08/02/13 14:25 </title>
</head>

<body>
<div id="wrapper">
<div id="office">Office Code : <?=$office_detail['office_code'];?></div>
<div id="sec_strip">Puchaser : <?=$purchaser_detail['purchaser_short_name'];?><span>Tabulation Statement of Financial Bids for Tender No: <?=$tender_details['tender_number'];?> </span><span style="margin-left:180px;">Due Date/Time : <?=$tender_details['tender_due_date'];?> <?=$tender_details['tender_time'];?></span></div>
<p>(All Rates are per Unit in Indian Rupees)</p>
<p style="font-size:19px;">Total Value of Tender (INR): 3,904,182</p>
<?php foreach($product_details as $pd) 
{
	
?>
<p>Unit : <?=$my_unit=$obj->unit($pd['unit']);?></p>
<p style="text-align:left;">Product Category : <?=$pd['item_name'];?></p>
<p style="text-align:left;">Product Description : <?=$pd['item_discription'];?></p>
 <?php $firms_in_products = $obj->Firms_In_Tabulation_stmt($pd['id']); ?>
 <table width="1200" border="1" style="page-break-inside:auto;">
  <tr>
    <th width="116" scope="col">Consignee</th>
    <th width="80" scope="col">Firms</th>
    <th width="91" scope="col">Quantity</th>
    <th width="47" scope="col">Rate</th>
    <th width="52" scope="col">Tax</th>
    <th width="151" scope="col">Other Charges</th>
    <th width="102" scope="col">Discount [%]</th>
    <th width="138" scope="col">Inspection</th>
    <th width="135" scope="col">Payment</th>
    <th width="84" scope="col">Validity</th>
    <th width="48" scope="col">TDC</th>
    <th width="80" scope="col">EMD</th>
  </tr>
  <?php foreach($firms_in_products as $fp) 
  {
  ?>
  <tr>
    <td><?=$pd['main_csign_short_name'];?></td>
    <td><?=$fp['csign_short_name'];?></td>
    <td><?=$pd['quantity'];?></td>
    <td><?=$fp['rate'];?></td>
    <td><?=$taxtype=$obj->taxType($fp['taxtype']);?>/<?php if($fp['taxper']=='')echo '0.00'; else echo $fp['taxper']; ?></td>
    <td><?=$otherchargtype=$obj->oct($fp['oct']);?>/<?php if($fp['othercharg']=='')echo '0.00'; else echo $fp['othercharg']; ?></td>
    <td><?=$fp['disper'];?></td>
    <td><?=$Inspection=$obj->inspection($fp['inspection']);?></td>
    <td><?=$payment=$obj->paymentOptn($fp['payment']);?></td>
    <td><?=$fp['validday'];?></td>
    <td><?=$tdc=$obj->tdc_emd($fp['tdc']);?></td>
    <td><?=$emd=$obj->tdc_emd($fp['emd']);?></td>
  </tr>
<?php } ?>
  
</table>
<?php
}
?>
<p style="text-align:left; margin-top:20px;">Remarks (As offered)</p>
<table width="1200" border="1">
  <tr>
    <th width="157" scope="col">Name of Firm</th>
    <th width="98" scope="col">Bid Ref.</th>
    <th width="128" scope="col">PLNO/Item Code</th>
    <th width="789" scope="col">Remarks / Reasons of submitting Alternate Offer</th>
  </tr>
  
  <?php foreach($firms_for_remark as $meenukew) 
  {
  ?>
  <tr>
    <td><?=$meenukew['csign_short_name'];?></td>
    <td><?=$meenukew['bid_number'];?></td>
    <td>&nbsp;</td>
    <td><?=$meenukew['remark'];?></td>
  </tr>
  <?php
  }
  ?>
 
</table>



</div>

</body>
</html>
