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
	$record_update = $obj->All_Firm_Product_Data($_GET['spl']);
	
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
	$save_bid = $obj->SaveBidNumberInFirm($_POST['bid_number'],$finalName,$name,$_POST['titles'],$_SESSION['pin_id'],$_SESSION['pin_table'],$_POST['c_rates'],$_GET['spl'],$_GET['id']);
	
	
	
	
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
				Idata +="<option value='6' <?=$_6_m;?>>OTHERS</option>";
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
	          var TTdata = "<option value='1'>VAT</option>";
                TTdata +="<option value='2'>CST</option>";
                TTdata +="<option value='3'>VAT INCL</option>";
				TTdata +="<option value='3'>CST INCL</option>";
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
<!---------------Availabel Products------------------->
<div id="right_info" style="float:left; width:400px;height:auto;">
<div id="old_info_span" style="min-height:40px; height:auto; padding-top:10px; border:none;">
<span style="margin-left:0px;font-size:18px; margin-top:10px;width:380px;word-wrap:break-word; border-bottom:1px solid #333;">
Information of Product <?php print_r($product_details['item_name']); ?>
</span>
</div>
<table id="infos" style="margin-left:10px;margin-top:4px; width:350px; table-layout:fixed;">
<tr class="info_p_tr">
<td style="width:100px;">Item Name : </td>
<td class="info_p_td">&nbsp;<?php print_r($product_details['item_name']); ?></td>
</tr>
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
<tr class="info_p_tr">
<td style="width:100px;">TDC Rate :</td>
<td class="info_p_td">&nbsp;<?php print_r($tender_details['tender_tdc']); ?></td>
</tr>
<tr class="info_p_tr">
<td style="width:100px;">EMD Rate : </td>
<td class="info_p_td">&nbsp;<?php print_r($tender_details['tender_emd']); ?></td>
</tr>
</table>
</div>
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
<span style="margin-left:0px;border-bottom:1px solid #000;">Generate Bid Refrence number 
</span>
</div>


<!------------------------------->

<table  id="multipels" class="showing" cellspacing="3px;">
<tr><th>Firm</th><th>Inspection</th><th>Rate</th></tr>
<tr><td><?php print_r($record_update['csign_short_name']); ?>
</td>
<td>
<?php echo $qq=$obj->inspection($record_update['inspection']); ?>
</td>
<td>
<?php print_r($record_update['rate']); ?>
</td></tr>
<tr><th>Tax Type</th><th>Tax %</th><th>Other Charge Type</th></tr>
<tr><td>
<?php echo $tt=$obj->taxType($record_update['taxtype']); ?>
</td>
<td>
<?php print_r($record_update['taxper']); ?> 
</td>
<td>
<?php echo $tp=$obj->oct($record_update['oct']); ?>
</td></tr>
<tr><th>Other Charge Rate</th><th>Discount %</th><th>Final Rate</th></tr>
<tr><td>
<?php print_r($record_update['othercharg']); ?>
</td>
<td>
<?php print_r($record_update['disper']); ?>
</td>
<td>
<?php print_r($record_update['finalrate']); ?>
</td></tr>
<tr><th >Payment</th><th>Delivery Per</th><th>Delivery Sche</th></tr>
<tr><td>
<?php echo $payment=$obj->paymentOptn($record_update['payment']); ?>
</td>
<td>
<?php print_r($record_update['delperod']); ?>
</td>
<td>
<?php print_r($record_update['delschedule']); ?>
</td></tr>
<tr><th>Validity Days</th><th>Remark</th><th>TDC</th></tr>
<tr><td>
<?php print_r($record_update['validday']); ?>
</td>
<td>
<?php print_r($record_update['remark']); ?>
</td>
<td>
<?php echo $tdc=$obj->tdc_emd($record_update['tdc']); ?>
</td></tr>
<tr><th>EMD</th><th>SPI Nate</th>
</tr>
<td>
<?php echo $emd=$obj->tdc_emd($record_update['emd']) ?>
</td>
<td>
<?php print_r($record_update['spinate']); ?>
</td>
</tr>
</table>
<hr class="hrules" noshade="noshade" color="#dcdcdc"/>
<form action="#" method="post" enctype="multipart/form-data" onSubmit=" return CheckBidNumber();">
<table style="margin-left:10px;">
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

</body>
</html>