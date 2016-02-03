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
$product_details=$obj->attach_records_products_single($_GET['p'],'tender_firm_product');
$list_firm = $obj->List_Drop_Down("consignee","csign_short_name","id");
if(isset($_GET['spl']) && $_GET['spl']!='')
{
	$record_update = $obj->All_Firm_Product_Data($_GET['spl']);
	 	
				
}
if(isset($_POST['submit']) && $_POST['key']==$_SESSION['key'])
{
	if(isset($_GET['spl']) && $_GET['spl']!='')
	{
		$result = $obj->update_firms_under_tender($_POST,$product_details['id'],$_SESSION['pin_id'],$_SESSION['pin_table'],$_GET['spl']);
		
	}
	else
	{
	
	$result = $obj->store_firms_under_tender($_POST,$product_details['id'],$_SESSION['pin_id'],$_SESSION['pin_table']);
	}
	if($result==1)
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
<?php
$_SESSION['key2']=mt_rand(1,1000);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="main_includes/add_new_row.js"></script>
<link rel="stylesheet" href="main_css/main_css.css"/>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
<title>Give rate to product of tender <?php print_r($tender_details['tender_number']); ?> : Rainbow Tender Managment</title>
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
function FirmBox(id,name)
{
	
	var firm_select = document.createElement('select');
	firm_select.setAttribute("id",id);
	firm_select.setAttribute("name",name);
	firm_select.setAttribute("onchange","FirmAcordingChange(this.value,this.id)");
	var firm_option = FirmOptions()
    firm_select.innerHTML=firm_option;
	return firm_select;
	
}
function FirmOptions()
{
	var fData = "<option value=''>Select Firm</option>";
	<?php
	for($ix=0;$ix<sizeof($list_firm);$ix++)
	{
		$FirmData.= "<option value='".$list_firm[$ix]['id']."'>".$list_firm[$ix]['csign_short_name']."</option>"; 
	}?>fData +=<? echo '"'.$FirmData.'";';?>
	return fData;
	
}
function InspectionBox(id,name)
{
	var inspection_select = document.createElement('select');
	inspection_select.setAttribute("id",id);
	inspection_select.setAttribute("name",name);
	var inspection_option = inspectionOptions()
    inspection_select.innerHTML=inspection_option;
	return inspection_select;
}
function inspectionOptions()
{
	          <?php $ins_opt_d = "_".$product_details['inspection']."_m";
                    $$ins_opt_d  = "selected='selected'"; 
               ?>
	          var Idata = "<option value='1' <?=$_1_m;?>>RITES</option>";
                Idata +="<option value='2' <?=$_2_m;?>>DQA</option>";
                Idata +="<option value='3' <?=$_3_m;?>>RITES/DQA</option>";
                Idata +="<option value='4' <?=$_4_m;?>>CONSIGNEE</option>";
				Idata +="<option value='5' <?=$_5_m;?>>RDSO</option>";
				Idata +="<option value='6' <?=$_6_m;?>>RITES/Visual</option>";
				Idata +="<option value='7' <?=$_7_m;?>>RITES/MTC & GC</option>";
				Idata +="<option value='8' <?=$_8_m;?>>DQA/Visual</option>";
				Idata +="<option value='9' <?=$_9_m;?>>DQA/MTC & GC</option>";
				Idata +="<option value='10' <?=$_10_m;?>>OTHERS</option>";
				return Idata;
	
}
function TdcBox(id,name)
{
	var tdc_select = document.createElement('select');
	tdc_select.setAttribute("id",id);
	tdc_select.setAttribute("name",name);
	var tdc_option = tdcOptions()
    tdc_select.innerHTML=tdc_option;
	return tdc_select;
}
function tdcOptions()
{
	          var Tdata = "<option value=''>Please Select</option>";
			   Tdata += "<option value='1'>Exempted</option>";
                Tdata +="<option value='2'>Paid</option>";
                Tdata +="<option value='3'>Not Required</option>";
               return Tdata;
	
}
function EmdBox(id,name)
{
	var emd_select = document.createElement('select');
	emd_select.setAttribute("id",id);
	emd_select.setAttribute("name",name);
	var emd_option = emdOptions()
    emd_select.innerHTML=emd_option;
	return emd_select;
}
function emdOptions()
{
	          var Edata = "<option value=''>Please Select</option>";
			   Edata += "<option value='1'>Exempted</option>";
                Edata +="<option value='2'>Paid</option>";
                Edata +="<option value='3'>Not Required</option>";
               return Edata;
	
}
function TaxtypeBox(id,name)
{
	var taxtype_select = document.createElement('select');
	taxtype_select.setAttribute("id",id);
	
	taxtype_select.setAttribute("name",name);
	taxtype_select.setAttribute("onchange","AmountCalculation(this.id)");
	var taxtype_option = taxtypeOptions()
    taxtype_select.innerHTML=taxtype_option;
	return taxtype_select;
}
function taxtypeOptions()
{
	          var TTdata = "<option value='1'>VAT EXTRA</option>";
                TTdata +="<option value='2'>CST EXTRA</option>";
                TTdata +="<option value='3'>VAT INCL</option>";
				TTdata +="<option value='4'>CST INCL</option>";
				TTdata +="<option value='5'>Nil</option>";
               return TTdata;
	
}
function PaymentBox(id,name)
{
	var payment_select = document.createElement('select');
	payment_select.setAttribute("id",id);
	payment_select.setAttribute("name",name);
	var payment_option = paymentOptions()
    payment_select.innerHTML=payment_option;
	return payment_select;
}
function paymentOptions()
{
	          var Pdata = "<option value='1'>100% after supl</option>";
                Pdata +="<option value='2'>98%+2%</option>";
                Pdata +="<option value='3'>95%+2%</option>";
				Pdata +="<option value='3'>90%+10%</option>";
               return Pdata;
	
}
function OCTBox(id,name)
{
	var oct_select = document.createElement('select');
	oct_select.setAttribute("id",id);
	oct_select.setAttribute("name",name);
	oct_select.setAttribute("onchange","AmountCalculation(this.id)")
	var oct_option = octOptions()
    oct_select.innerHTML=oct_option;
	return oct_select;
	
}
function octOptions()
{
	          var Odata = "<option value='1'>Percentez</option>";
                Odata +="<option value='2'>Amount</option>";
                
               return Odata;
	
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
</style>
<?php include_once("main_includes/date_picker.php");?> 
<style>
#msg_to_do
{
	font-size:12px;
	color:#333;
	font-family: 'ColaborateLightRegular';
	margin-left:10px;
	margin-top:5px;
}
#msg_after_uploaded
{
	font-size:12px;
	color:#06F;
	font-family: 'ColaborateLightRegular';
	margin-left:10px;
	margin-top:5px;
}
#msg_after_rate_given
{
	font-size:12px;
	color:#D50000;
	font-family: 'ColaborateLightRegular';
	margin-left:10px;
	margin-top:5px;
}
#msg_after_status_error
{
	font-size:12px;
	color:#333;
	font-family: 'ColaborateLightRegular';
	margin-left:10px;
	margin-top:5px;
}
#current_status
{
	font-size:16px;
	color:#333;
	font-family: 'ColaborateLightRegular';
	margin-left:10px;
	margin-top:5px;
	font-weight:bold;
	
}
</style>
</head>
<body>
<input type="hidden" id="hide_for_status" value="<?php print_r($product_details['status']);    ?>" />
<?php include_once("main_includes/msg_box.php"); ?>
<div id="index-header" style="width:2137px;">
<?php include_once("main_includes/main_header.php");?>
<?php include_once("main_includes/main_validation.php");?> 

</div>
<div id="index-navigation" style="width:2137px;">
<?php 
$meenubar = $_SESSION['rb_power']."_menu.php";
include_once("main_includes/".$meenubar); ?> 
</div>
<div id="index-main" style="width:2137px;">
<span id="title_work_page">Products in Tender No. <?php print_r($tender_details['tender_number']); ?></span>
<div id="working-sub-main" style="width:2136px;">
<div id="working-panel" style="background:#FFF;width:auto;">
<!-------OLD INFO TENDER---------->
<div id="left_div" style="float:left; width:400px;height:auto;">
<div id="old_info_span" style="min-height:40px; height:auto; padding-top:10px; border:none;">
<span style="margin-left:0px;font-size:18px; margin-top:10px;width:380px;word-wrap:break-word; border-bottom:1px solid #333;">
Information of Tender</span>
</div>
<table id="infos" style="margin-left:10px;margin-top:4px; width:350px; table-layout:fixed;" >

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
<tr class="info_p_tr">
<td style="width:110px;">Sample Required : </td>
<td style="width:240px;word-wrap:break-word;"><?php if($tender_details['tender_sample']==0) { echo "Yes"; } else { "No" ;}  ?></td>
</tr>
<tr class="info_p_tr">
<td style="width:110px;">Criteria : </td>
<td style="width:240px;word-wrap:break-word;"><?php print_r($tender_details['tender_criteria']); ?></td>
</tr>
</table>
</div>

<!--------------------------------->
<!---------------Availabel Products------------------->
<div id="right_info" style="float:left; width:400px;height:auto;">
<div id="old_info_span" style="min-height:40px; height:auto; padding-top:10px; border:none;">
<span style="margin-left:0px;font-size:18px; margin-top:10px;width:380px;word-wrap:break-word; border-bottom:1px solid #333;">
Information of Product <?php print_r($product_details['item_name']); ?>
</span>
</div>
<table id="infos" style="margin-left:10px;margin-top:4px; width:350px; table-layout:fixed;">
<tr class="info_p_tr">
<td style="width:100px;">Item Discription :</td>
<td class="info_p_td">&nbsp;<?php print_r($product_details['item_discription']); ?></td>
</tr>
<tr class="info_p_tr">
<td style="width:100px;">Consignee :</td>
<td class="info_p_td">&nbsp;<?php print_r($product_details['main_csign_short_name']); ?></td>
</tr>
<tr class="info_p_tr">
<td style="width:100px;">Quantity :</td>
<td class="info_p_td">&nbsp;<?php print_r($product_details['quantity']); ?></td>
</tr>
<tr class="info_p_tr">
<td style="width:100px;">Unit :</td>
<td class="info_p_td">&nbsp;<?php echo $unit_new =$obj->unit($product_details['unit']); ?></td>
</tr>
</table>
</div>
<!--------------------DownLoad Files-------------------->
<div id="sub_right_info" style="float:left; width:400px;height:auto;">
<div id="old_info_span" style="min-height:40px; height:auto; padding-top:10px; border:none;">
<span style="margin-left:0px;font-size:18px; margin-top:10px;width:380px;word-wrap:break-word; border-bottom:1px solid #333;">
Attachements In Tender</span>
</div>
<table id="infos" style="margin-left:10px;margin-top:4px; width:350px; table-layout:fixed;">
<?php
$sm=0;
foreach($attachments as $njX)
{
	$title_value = $obj->Title_In_Tender_Attachements($njX['title']);
	$sm++;
	?>
   <tr><td style="width:30px;">[<?php echo $sm; ?>]</td><td style="width:320px; word-wrap:break-word; font-size:10px;"><a href="attachements/tender_attach/<?=$njX['file'];?>" target="_new"><?=$title_value;?>/<?=$njX['other_title'];?> [<?=$njX['file_real_name'];?>]</a></td></tr>
    <?php
	
}
?>
</table>
</div>
<!---------------------------SWITCHE DIV---------------------------->
<!------------------------------->

<!------------------------------------------------------->


<div id="old_info_span" style="clear:both;padding-top:20px; border:none">
<span style="margin-left:0px;border-bottom:1px solid #000;"><?php if(isset($_GET['spl']) && $_GET['spl']!='') { echo 'Update Firm '; } else { echo 'Add Firms ';} ?>
 to Product <?php print_r($product_details['item_name']); ?>
</span>
</div>


<!------------------------------->
<div id="div_for_manual_rate">
<form action="#" method="post" enctype="multipart/form-data">
<table  id="multipels" class="attachz">
<tr><th>Firm</th><th>Inspection</th><th>Rate</th><th>Tax Type</th><th>Tax %</th><th>Other Charge Type</th><th>Other Charge Rate</th><th>Discount %</th><th>Final Rate</th><th >Payment</th>
<th>Delivery Per</th><th>Delivery Sche</th><th>Validity Days</th><th>Remark</th><th>TDC</th><th>EMD</th><th>SPI Nate</th>
</tr>
<!----------------SECTION FOR LIMITED TENDER FIRMS START HERE-------->
<?php //if(isset($limited_tender_firms) && $tender_details['tender_type']==1 && !isset($_GET['spl']))
if(is_array($limited_tender_firms) && !isset($_GET['spl'])) 
{
	$rr=0;
	foreach($limited_tender_firms as $tyi)
	{
		
		?>
         <tr id="addafter_<?=$rr;?>">
         <td><select id="firm_<?=$rr;?>" name="firm[]">
         <option value="<?=$tyi['firm_id'];?>"><?=$tyi['csign_short_name'];?></option>
         </select>
         </td>
         <td>
         <?php $ins_optX = "_".$product_details['inspection']."_YY";
			   $$ins_optX  = "selected='selected'";
		?>
         <select id="inspection_<?=$rr;?>" name="inspection[]" >
		 <option value='1' <?=$_1_YY;?>>RITES</option>
		 <option value='2' <?=$_2_YY;?>>DQA</option>
		<option value='3' <?=$_3_YY;?>>RITES/DQA</option>
		<option value='4' <?=$_4_YY;?>>CONSIGNEE</option>
		<option value='5' <?=$_5_YY;?>>RDSO</option>
        <option value='6' <?=$_6_YY;?>>RITES/Visual</option>
        <option value='7' <?=$_7_YY;?>>RITES/MTC & GC</option>
        <option value='8' <?=$_8_YY;?>>DQA/Visual</option>
        <option value='9' <?=$_9_YY;?>>DQA/MTC & GC</option>
		<option value='10' <?=$_10_YY;?>>OTHERS</option>
		</select>
         </td>
         <td>
		<input type="text" id="rate_<?=$rr;?>" name="rate[]" placeholder="0.00" onKeyUp="AmountCalculation(this.id);" class="validate" />
		</td>
        <td>
		<select id="taxtype_<?=$rr;?>" name="taxtype[]" onChange="AmountCalculation(this.id)">
		<option value="1">VAT EXTRA</option>
		<option value="2">CST EXTRA</option>
		<option value="3">VAT INCL</option>
		<option value="4">CST INCL</option>
        <option value="5">Nil</option>
		</select>
		</td>
        <td>
<input type="text" id="taxper_<?=$rr;?>" name="taxper[]" onKeyUp="AmountCalculation(this.id)" placeholder="0.00" class="validate"/>
</td>
<td>
<select id="oct_<?=$rr;?>" name="oct[]" onChange="AmountCalculation(this.id);">
<option value="1">Percentez</option>
<option value="2">Amount</option>
</select>
</td>
<td>
<input type="text" id="othercharg_<?=$rr;?>" name="othercharg[]"  onkeyup="AmountCalculation(this.id);" placeholder="0.00" class="validate"/>
</td>
<td>
<input type="text" id="disper_<?=$rr;?>" name="disper[]" onKeyUp="AmountCalculation(this.id)" placeholder="0.00" class="validate" />
</td>
<td>
<input type="text" id="finalrate_<?=$rr;?>" name="finalrate[]" readonly placeholder="0.00"/>
</td>
<td>
<select id="payment_<?=$rr;?>" name="payment[]">
<option value="1">100% after supl</option>
<option value="2">98%+2%</option>
<option value="3">95%+2%</option>
<option value="4">90%+10%</option>
</select>
</td>
<td>
<input type="text" id="delperod_<?=$rr;?>" name="delperod[]" value="<?=$tyi['csign_delv_peride'];?>"/>
</td>
<td>
<input type="text" id="delschedule_<?=$rr;?>" name="delschedule[]" value="<?=$tyi['csign_delv_schedule'];?>"/>
</td>
<td>
<input type="text" id="validday_<?=$rr;?>" name="validday[]"/>
</td>
<td>
<input type="text" id="remark_<?=$rr;?>" name="remark[]" value="<?=$tyi['csign_remark'];?>" readonly />
</td>
<td>
<select id="tdc_<?=$rr;?>" name="tdc[]" >
<option value="" >Please select</option>
<option value="1">Exempted</option>
<option value="2">Paid</option>
<option value="3">Not Required</option>
</select>
</td>
<td>
<select id="emd_<?=$rr;?>" name="emd[]" >
<option value="">Please select</option>
<option value="1">Exempted</option>
<option value="2">Paid</option>
<option value="3">Not Required</option>
</select>
</td>
<td>
<input type="text" id="spinate_<?=$rr;?>" name="spinate[]" />
</td>
  <input type="hidden" value=<?=$rr;?> id="hide" />       
         </tr>        
        <?php
		$rr++;
	}
//--------------------------SECTION FOR LIMITED FIRM TENDER END HERE-------	
	
}
//if Tender is not limited then this section will run
else
{
	?>
<tr id="addafter_0">
<td><select id="firm_0" name="firm[]" onChange="FirmAcordingChange(this.value,this.id);">
<?php if(isset($_GET['spl'])) {
	?>
    <option value="<?php print_r($record_update['firm']) ?>"><?php print_r($record_update['csign_short_name']); ?></option>
    <?php
	} else {?>
    <option value="">Select Firm</option> 
    <?php 
	}
	for($k=0;$k<sizeof($list_firm);$k++) 
	{ 
	if($list_firm[$k]['id']==$record_update['firm'])
	goto Tr;
	?>
    <option value="<?php print_r($list_firm[$k]['id']); ?>"><?php print_r($list_firm[$k]['csign_short_name']); ?></option>
    <?php 
	Tr:
	} 
	?>
</select>
</td>
<td>
<?php
if(isset($_GET['spl']) && $_GET['spl']!='')
{
$ins_opt = "_".$record_update['inspection'];
$$ins_opt  = "selected='selected'";
	
}
else
{
$ins_opt = "_".$product_details['inspection'];
$$ins_opt  = "selected='selected'";
	
}
?>
<select id="inspection_0" name="inspection[]" >
<option value='1' <?=$_1;?>>RITES</option>
<option value='2' <?=$_2;?>>DQA</option>
<option value='3' <?=$_3;?>>RITES/DQA</option>
<option value='4' <?=$_4;?>>CONSIGNEE</option>
<option value='5' <?=$_5;?>>RDSO</option>
<option value='6' <?=$_6;?>>RITES/Visual</option>
<option value='7' <?=$_7;?>>RITES/MTC & GC</option>
<option value='8' <?=$_8;?>>DQA/Visual</option>
<option value='9' <?=$_9;?>>DQA/MTC & GC</option>
<option value='10' <?=$_10;?>>OTHERS</option>
</select>
</td>
<td>
<input type="text" id="rate_0" name="rate[]" placeholder="0.00" onKeyUp="AmountCalculation(this.id);" class="validate" value="<?php print_r($record_update['rate']); ?>" />
</td>
<td>
<?php
$tt_opt="_".$record_update['taxtype']."_M";
$$tt_opt="selected='selected'";
?>
<select id="taxtype_0" name="taxtype[]" onChange="AmountCalculation(this.id)">
<option value="1" <?=$_1_M;?>>VAT EXTRA</option>
<option value="2" <?=$_2_M;?>>CST EXTRA</option>
<option value="3" <?=$_3_M;?>>VAT INCL</option>
<option value="4" <?=$_4_M;?>>CST INCL</option>
<option value="5" <?=$_5_M;?>>Nil</option>

</select>
</td>
<td>
<input type="text" id="taxper_0" name="taxper[]" onKeyUp="AmountCalculation(this.id)" placeholder="0.00" class="validate" value="<?php print_r($record_update['taxper']); ?>" />
</td>
<td>
<?php
$oc_opt="_".$record_update['oct']."_OC";
$$oc_opt="selected='selected'";
?>
<select id="oct_0" name="oct[]" onChange="AmountCalculation(this.id);">
<option value="1" <?=$_1_OC;?>>Percentez</option>
<option value="2" <?=$_2_OC;?>>Amount</option>
</select>
</td>
<td>
<input type="text" id="othercharg_0" name="othercharg[]"  onkeyup="AmountCalculation(this.id);" placeholder="0.00" class="validate" value="<?php print_r($record_update['othercharg']); ?>" />
</td>
<td>
<input type="text" id="disper_0" name="disper[]" onKeyUp="AmountCalculation(this.id)" placeholder="0.00" class="validate" value="<?php print_r($record_update['disper']); ?>" />
</td>
<td>
<input type="text" id="finalrate_0" name="finalrate[]" readonly placeholder="0.00" value="<?php print_r($record_update['finalrate']); ?>" />
</td>
<td>
<?php
$payment_opt="_".$record_update['payment']."_PY"; 
$$payment_opt="selected='selected'";

?>
<select id="payment_0" name="payment[]">
<option value="1" <?=$_1_PY;?>>100% after supl</option>
<option value="2" <?=$_2_PY;?>>98%+2%</option>
<option value="3" <?=$_3_PY;?>>95%+2%</option>
<option value="4" <?=$_4_PY;?>>90%+10%</option>
</select>
</td>
<td>
<input type="text" id="delperod_0" name="delperod[]" value="<?php print_r($record_update['delperod']); ?>" />
</td>
<td>
<input type="text" id="delschedule_0" name="delschedule[]" value="<?php print_r($record_update['delschedule']); ?>" />
</td>
<td>
<input type="text" id="validday_0" name="validday[]" value="<?php print_r($record_update['validday']); ?>" />
</td>
<td>
<input type="text" id="remark_0" name="remark[]" value="<?php print_r($record_update['remark']); ?>" readonly />
</td>
<td>
<?php
$tdc_opn="_".$record_update['tdc']."_TDC";
$$tdc_opn="selected='selected'";
?>
<select id="tdc_0" name="tdc[]" >
<option value="" >Please select</option>
<option value="1" <?=$_1_TDC;?>>Exempted</option>
<option value="2" <?=$_2_TDC;?>>Paid</option>
<option value="3" <?=$_3_TDC;?>>Not Required</option>
</select>
</td>
<td>
<?php
$emd_opn="_".$record_update['emd']."_EMD";
$$emd_opn="selected='selected'";
?>
<select id="emd_0" name="emd[]" >
<option value="">Please select</option>
<option value="1" <?=$_1_EMD;?>>Exempted</option>
<option value="2" <?=$_2_EMD;?>>Paid</option>
<option value="3" <?=$_3_EMD;?>>Not Required</option>
</select>
</td>
<td>
<input type="text" id="spinate_0" name="spinate[]" value="<?php print_r($record_update['spinate']); ?>" />
</td>
</tr>
<?php } ?>
<?php //if(isset($_GET['spl']) || $tender_details['tender_type']==1 )
if(isset($_GET['spl']) || is_array($limited_tender_firms))
{
	?>
    <tr></tr>
    <?php
	
}
else
{
?>
<tr style="background:#fff;"><td><input type="button" name="add_more" id="add_more" value="Add More" class="add_more" onClick="Add_Quoto2_New();"/></td></tr>
<input type="hidden" value='0' id="hide" />
<?php } ?>
<!--REMOVING HIDDEN BOX FRORM HERE TO MAKE COUNTER WORK IN LIMITED TENDER TOO
<input type="hidden" value='0' id="hide" />-->

</table>
<hr class="hrules" noshade="noshade" color="#dcdcdc"/>
<table><tr><td><input type="submit" name="submit" id="main_submit" value="<?php if($_GET['spl']!="") echo "Update"; else echo "Save"; ?>"/></td></tr></table>
<input type="hidden" name="key" id="key" value="<?php echo $_SESSION['key']; ?>" />
</form>
</div>

<!------------------------------------------------------>

</div>
</div>
</div>
<div id="index-footer">
<?php  include_once("main_includes/footer.php"); ?>
</div>
<script type="text/javascript">
//$('input[type="text"]').live('keydown',function(e){
	$('.validate').live('keydown',function(e){
   var ingnore_key_codes = [];
   var valid_key_codes = [];
   var lowEnd=65;
   var highEnd=90;
   while(lowEnd<=highEnd)
   {
	   ingnore_key_codes.push(lowEnd);
	   lowEnd++;
   }
   //ingnore_key_codes.push(32,186,187,188,189,191,219,220,221,222,106,107,109,110,111);
   ingnore_key_codes.push(32,186,187,188,189,191,219,220,221,222,106,107,109,111,59);
   var numeric_low_end=48;
   var numeric_high_end=57;
   var numeric_key=96;
   while(numeric_low_end<=numeric_high_end)
   {
	   valid_key_codes.push(numeric_low_end);
	  valid_key_codes.push(numeric_key);
	   numeric_low_end++;
	   numeric_key++;
	}
	valid_key_codes.push(110,190);
	
   if ($.inArray(e.keyCode, ingnore_key_codes) >= 0){
      e.preventDefault();
   }
   else
   {
	  var mp=$(this).val();
	  if(mp.indexOf(".") > -1)
        {
           var si=mp.length-(mp.indexOf(".")+1);
		   si=parseInt(si);
		 	if(si>1)
			{
				
			 if ($.inArray(e.keyCode, valid_key_codes) >= 0){
      e.preventDefault();
   				}
			  
			 }
        }
	   
   }
   
});

/*$('input[type="text"]').live('keyup',function(e){
	var AfterDecimal=2;
	var mp=$(this).val();
	  if(mp.indexOf(".") > -1)
        {
            var si=mp.length-(mp.indexOf(".")+1);
			si=parseInt(si);
			
			if(si>1)
			{
				
				$(this).s
				
				
			}
        }
	
	
});*/

</script>

<script type="text/javascript">
/*
  var $Rz = jQuery.noConflict();
  var hide_for_status = $Rz('#hide_for_status').val();
  if((parseInt(hide_for_status))==0)
  {
	 
	 document.getElementById("submit_uploaded").setAttribute('value','Not Apply');
	document.getElementById("submit_uploaded").setAttribute('type','button');
	document.getElementById("submit_uploaded").setAttribute('name','X_main_Submit');
	document.getElementById("submit_uploaded").style.background='#999';
	
	  var flag="on";
	  
  }
  else
  {
	 //$('.triger_quote').show();
	document.getElementById("main_submit").setAttribute('value','Not Apply');
	document.getElementById("main_submit").setAttribute('type','button');
	document.getElementById("main_submit").setAttribute('name','X_main_Submit');
	document.getElementById("main_submit").style.background='#999';
	
	  var flag="off";
  }
   $Rz('#1').iphoneSwitch(flag, 
     function() {
      // $Rz('#ajax').load('common_on.php?id=<//?=$_GET['p'];?>&status=0&show=Mannual&table=tender_firm_product');
	   document.getElementById('current_status').innerHTML='Current status is Mannual Rate';
	   ////////////DISABLEING UPLOADED BUTTON///////////////
	   document.getElementById("submit_uploaded").setAttribute('value','Not Apply');
	document.getElementById("submit_uploaded").setAttribute('type','button');
	document.getElementById("submit_uploaded").setAttribute('name','X_main_Submit');
	document.getElementById("submit_uploaded").style.background='#999';
	
	////////////////////////ENABELING MAIN_SUBMIT BUTTON///////////////////////////
	document.getElementById("main_submit").setAttribute('value','SAVE');
	document.getElementById("main_submit").setAttribute('type','submit');
	document.getElementById("main_submit").setAttribute('name','main_Submit');
	document.getElementById("main_submit").style.background='#6b1717';
	
      },
      function() {
		 $Rz('#ajax').load('common_off.php?id=<//?=$_GET['p'];?>&status=1&show=Printed&table=tender_firm_product');
	  document.getElementById('current_status').innerHTML='Current status is Printed Rate';
	//////////////////DISABELIN MAIN SUBMIT BUTTON----------
	   document.getElementById("main_submit").setAttribute('value','Not Apply');
	document.getElementById("main_submit").setAttribute('type','button');
	document.getElementById("main_submit").setAttribute('name','X_main_Submit');
	document.getElementById("main_submit").style.background='#999';
	/////////////////////////////////////////////////
	///////////////ENABELING UPLOADED BUTTON//////////////////
	 document.getElementById("submit_uploaded").setAttribute('value','Upload Files');
	document.getElementById("submit_uploaded").setAttribute('type','submit');
	document.getElementById("submit_uploaded").setAttribute('name','submit_uploaded');
	document.getElementById("submit_uploaded").style.background='#6b1717';
	
      },
      {
        switch_on_container_path: 'iphone_switch_container_off.png'
      });
	  */
  </script>
<!------------------------->

</body>
</html>