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
	
	
	$list_firm = $obj->List_Drop_Down("consignee","csign_firm_name","id");
	//$list_cnsignee = $obj->List_Drop_down_onSelection_noAjax("main_consignee","main_csign_name","main_csign_purchaser",$purchaser_detail['id']);
	
	
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
 
<title>Tenders Quotation : Rainbow Tender Managment</title>


    <link rel="stylesheet" type="text/css" media="screen" href="main_css/jquery.ui.potato.menu.css" />
    
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="main_js/menu_bar/jquery.ui.potato.menu.js"></script>
<script type="text/javascript" src="main_js/AjaxJavaSCript.js"></script>
<script type="text/javascript">
//var shaan = jQuery.noConflict();
(function($) {
	
    $(document).ready(function(){
        $('#menu1').ptMenu();
    });
})(jQuery);
</script>
<script type="text/javascript">
  /*function OldAttachments(id) {
	  alert(id);
	  
      Dialog.alert({url: "AjaxPage.php?faduid="+id, options: {method: 'get'}}, 
                     {top: 200, width:300, height:170,  className: "alphacube",  cancelLabel:"close"})    
  }*/
</script>
<?php include_once("main_includes/date_picker.php");?> 
<script>
function EditUrl(id)
{
	window.location="tender_quation.php?hv="+id;
	
}
</script>
<link rel="stylesheet" type="text/css" href="main_css/paginate.css">



  <script type='text/javascript' src='http://code.jquery.com/jquery-1.7.1.js'></script>
    <!--<link rel="stylesheet" type="text/css" href="page_slider_css/normalize.css">
  <link rel="stylesheet" type="text/css" href="page_slider_css/tricks.css">-->
<script type='text/javascript'>//<![CDATA[ 
$(window).load(function(){
//bind to all links whose `href` attribute starts with a hash
$('a[href^="#"]').on('click', function () {

    //get the offset from the document's top for the element targeted in the links `href` attribute
    var offset = $($(this).attr('href')).offset().top - 20;

    //scroll the document, some browsers use `html`, some use `body`
    $('html, body').stop().animate({ scrollTop : offset }, 1000);
});
});//]]>  

</script>
<script type="text/javascript">
function FirmBox(id,name)
{
	
	var firm_select = document.createElement('select');
	firm_select.setAttribute("id",id);
	firm_select.setAttribute("name",name);
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
		$FirmData.= "<option value='".$list_firm[$ix]['id']."'>".$list_firm[$ix]['csign_firm_name']."</option>"; 
	}?>fData +=<? echo '"'.$FirmData.'";';?>
	return fData;
	
}
function TaxBox(id,name,value)
{
	var tax_select = document.createElement('select');
	tax_select.setAttribute("id",id);
	tax_select.setAttribute("name",name);
	var tax_option = TaxOptions(value)

	tax_select.innerHTML=tax_option;
	return tax_select;
}
function TaxOptions(value)
{
	if(value==1)
	{
		var option='VAT';
	}
	else
	{
		var option='CST';
	}
	
	var tData = "<option value="+value+">"+option+"</option>";
	if(value!=1)
	{
		tData +="<option value='1'>VAT</option>";
	}
	if(value!=2)
	{
		tData +="<option value='2'>CST</option>";
	}
	return tData;
}
function PaymentBox(id,name,value)
{
	var payment_select = document.createElement('select');
	
	payment_select.setAttribute("id",id);
	payment_select.setAttribute("name",name);
	//-------------------------------------------
	if(value==1)
	{
		var optionBase='Consignee';
	}
	else if(value==2)
	{
		var optionBase='RITES'
	}
	else if(value==3)
	{
		var optionBase='DOI'
	}
	else if(value==4)
	{
		var optionBase='RDSO'
	}
	else
	{
		var optionBase='Others'
	}
	
	var base_option=document.createElement('option');
	base_option.setAttribute("value",value);
	base_option.innerHTML=optionBase;
	payment_select.appendChild(base_option);
	if(value!=1)
	{
	var option1=document.createElement('option');
	option1.setAttribute("value",1);
	option1.innerHTML='Consignee';
	payment_select.appendChild(option1);
	}
	if(value!=2)
	{
	var option2=document.createElement('option');
	option2.setAttribute("value",2);
	option2.innerHTML='RITES';
	payment_select.appendChild(option2);
	}
	if(value!=3)
	{
	var option3=document.createElement('option');
	option3.setAttribute("value",3);
	option3.innerHTML='DOI';
	payment_select.appendChild(option3);
	}
	if(value!=4)
	{
	var option4=document.createElement('option');
	option4.setAttribute("value",4);
	option4.innerHTML='RDSO';
	payment_select.appendChild(option4);
	}
	if(value!=5)
	{
	var option5=document.createElement('option');
	option5.setAttribute("value",5);
	option5.innerHTML='Consignee';
	payment_select.appendChild(option5);
	}
	//---------------------------------------------
	
	//var payment_option = PaymentOptions(value);
	//payment_select.innerHTML=payment_option;
	
	return payment_select;
}
function PaymentOptions(valueP)
{
	if(valueP==1)
	{
		var optionP='Consignee';
	}
	else if(valueP==2)
	{
		var optionP='RITES'
	}
	else if(valueP==3)
	{
		var optionP='DOI'
	}
	else if(valueP==4)
	{
		var optionP='RDSO'
	}
	else
	{
		var optionP='Others'
	}
	
	var pData = "<option value="+valueP+">"+optionP+"</option>";
	if(valueP!=1)
	pData +="<option value='1'>Consignee</option>";
	if(valueP!=2)
	pData +="<option value='2'>RITES</option>";
	if(valueP!=3)
	pData +="<option value='3'>DOI</option>";
	if(valueP!=4)
	pData +="<option value='4'>RDSO</option>";	
	if(valueP!=5)
	pData +="<option value='5'>Others</option>";
	return pData;
}

</script>

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
<span id="title_work_page">Products of Tender No. <?php print_r($tender_details['tender_number']); ?></span>
<div id="working-sub-main">
<div id="working-panel" >
<!--slider-->
<div id="mahro">
<div id="nav">
<?php
for($i=0;$i<sizeof($product_details);$i++)
{
?>

    <a href="#<?php print_r($product_details[$i]['id']) ?>"><?php print_r($product_details[$i]['item_name']); ?></a>

    <?php
}
	?>
</div>
<div id="main-container">
<?php for($i=0;$i<sizeof($product_details);$i++) 
{
?>
<div id="<?php print_r($product_details[$i]['id']); ?>" class="Dynamic_product_div">
<p><span class="tq_titles">Item Name</span><?php print_r($product_details[$i]['item_name']); ?></p>
<p><span class="tq_titles">Item Description</span><?php print_r($product_details[$i]['discription']); ?></p>
<form id="thisform<?php print_r($product_details[$i]['id']); ?>" name="thisform<?php $product_details[$i]['id']; ?>">
<div class="working-container" id="addafterdiv_<?php print_r($product_details[$i]['id']) ?>_0">
<table width="820" border="1" cellspacing="10" id="addafter">
  <tr>
    <td width="98"><label>Select Firm</label></td>
    <td width="277"><select id="firm_<?php print_r($product_details[$i]['id']) ?>_0" name="firm_<?php print_r($product_details[$i]['id']) ?>[]">
    <option value="">Select Firm</option> 
    <?php for($k=0;$k<sizeof($list_firm);$k++) 
	{ 
		?>
    <option value="<?php print_r($list_firm[$k]['id']); ?>"><?php print_r($list_firm[$k]['csign_firm_name']); ?></option>
    <?php 
	} 
		?>
    </select>
    </td>
  </tr>
  <tr>
    <td><label>Consignee</label></td>
    <td><input type="text" id="consignee_<?php print_r($product_details[$i]['id']) ?>_0" name="consignee_<?php print_r($product_details[$i]['id']) ?>[]" value="<?php print_r($product_details[$i]['main_csign_name']) ?>" readonly="readonly" /></td>
    <td width="106"><label>Inspection</label></td>
    <?php if($product_details[$i]['inspection']==1){$ins='ITES';} else if($product_details[$i]['inspection']==2){$ins='DOI';}else if($product_details[$i]['inspection']==3){$ins='RDSO';}else if($product_details[$i]['inspection']==4){$ins='Others';}else { $ins='';} ?>
    <td width="271"><input type="text" id="inspection_<?php print_r($product_details[$i]['id']) ?>_0" name="inspection_<?php print_r($product_details[$i]['id']) ?>[]" readonly="readonly" value="<?php echo $ins; ?>"></td>
  </tr>
  <tr>
    <td><label>Quantity</label></td>
    <td><input type="text" id="quantity_<?php print_r($product_details[$i]['id']) ?>_0" name="quantity_<?php print_r($product_details[$i]['id']) ?>[]" value="<?php print_r($product_details[$i]['quantity']); ?>" /></td>
    <td width="106"><label>Unit</label></td>
    <td width="271"><input type="text" id="unit_<?php print_r($product_details[$i]['id']) ?>_0" name="unit_<?php print_r($product_details[$i]['id']) ?>[]" value="<?php print_r($product_details[$i]['unit']); ?> " /></td>
  </tr>
  <tr>
    <td><label>TDC</label></td>
     <?php if($tender_details['tender_tdc']==1){$tdc='Exempted';} else if($tender_details['tender_tdc']==2){$tdc='Paid';}else if($tender_details['tender_tdc']==3){$tdc='Not Required';}else { $tdc='';} ?>
    <td><input type="text" id="tdc_<?php print_r($product_details[$i]['id']) ?>_0" name="tdc_<?php print_r($product_details[$i]['id']) ?>[]" readonly="readonly" value="<?php echo $tdc ?>"/>
    </td>
    <td width="106"><label>EMD</label></td>
     <?php if($tender_details['tender_emd']==1){$emd='Exempted';} else if($tender_details['tender_emd']==2){$emd='Paid';}else if($tender_details['tender_emd']==3){$emd='Not Required';}else { $emd='';} ?>
    
    <td width="271"><input type="text" id="emd_<?php print_r($product_details[$i]['id']) ?>_0" name="emd_<?php print_r($product_details[$i]['id']) ?>[]" readonly="readonly" value="<?php echo $emd; ?>" />
    </td>
  </tr>
  <tr>
    <td><label>Rate</label></td>
    <td><input type="text" id="rate_<?php print_r($product_details[$i]['id']) ?>_0" name="rate_<?php print_r($product_details[$i]['id']) ?>[]" /></td>
    <td width="106"><label>Tax Type</label></td>
    <td width="271"><select id="taxtype_<?php print_r($product_details[$i]['id']) ?>_0" name="taxtype_<?php print_r($product_details[$i]['id']) ?>[]">
    <option value="1">VAT</option>
    <option value="2">CST</option>
    </select></td>
  </tr>
  <tr>
    <td><label>Tax %</label></td>
    <td><input type="text" id="taxper_<?php print_r($product_details[$i]['id']) ?>_0" name="taxper_<?php print_r($product_details[$i]['id']) ?>[]" /></td>
    <td width="106"><label>Tax Amount</label></td>
    <td width="271"><input type="text" id="taxamount_<?php print_r($product_details[$i]['id']) ?>_0" name="taxamount_<?php print_r($product_details[$i]['id']) ?>[]" /></td>
  </tr>
 	<td><label>Discount %</label></td>
    <td><input type="text" id="disper_<?php print_r($product_details[$i]['id']) ?>_0" name="disper_<?php print_r($product_details[$i]['id']) ?>[]" /></td>
    <td width="106"><label>Discount Amount</label></td>
    <td width="271"><input type="text" id="disamount_<?php print_r($product_details[$i]['id']) ?>_0" name="disamount_<?php print_r($product_details[$i]['id']) ?>[]" /></td>
  </tr>
  <tr>
    <td><label>Other Charges</label></td>
    <td><input type="text" id="othercharg_<?php print_r($product_details[$i]['id']) ?>_0" name="othercharg_<?php print_r($product_details[$i]['id']) ?>[]" /></td>
    <td width="106"><label>Validity Days</label></td>
    <td width="271"><input type="text" id="validday_<?php print_r($product_details[$i]['id']) ?>_0" name="validday_<?php print_r($product_details[$i]['id']) ?>[]" /></td>
  </tr>
  <tr>
    <td><label>Payment</label></td>
    <td><select id="payment_<?php print_r($product_details[$i]['id']) ?>_0" name="payment_<?php print_r($product_details[$i]['id']) ?>[]">
    <option value="1">Consignee</option>
    <option value="2">RITES</option>
    <option value="3">DOI</option>
    <option value="4">RDSO</option>
    <option value="5">Others</option>
    </select></td>
    <td><label>Delivery Periode</label></td>
    <td><input type="text" id="delperod_<?php print_r($product_details[$i]['id']) ?>_0" name="delperod_<?php print_r($product_details[$i]['id']) ?>[]" /></td>
  </tr>
  <tr>
    <td><label>Delivery schedule</label></td>
    <td><input type="text" id="delschedule_<?php print_r($product_details[$i]['id']) ?>_0" name="delschedule_<?php print_r($product_details[$i]['id']) ?>[]" /></td>
    <td><label>Remark</label></td>
    <td><textarea rows="4" id="remark_<?php print_r($product_details[$i]['id']) ?>_0" name="remark_<?php print_r($product_details[$i]['id']) ?>[]"></textarea></td>
  </tr>
  <tr>
    <td><label>SPI Nate</label></td>
    <td><textarea rows="4" id="spinate_<?php print_r($product_details[$i]['id']) ?>_0" name="spinate_<?php print_r($product_details[$i]['id']) ?>[]"></textarea></td>
  </tr>
  <tr>
  <td></td>
  <td>
  <span id="loader_<?php print_r($product_details[$i]['id']) ?>_0" style="display:none"><img src="main_images/indicator.gif" /></span>
  <span id="msgspanX_<?php print_r($product_details[$i]['id']) ?>_0"></span></td>
  </tr>
  </table>
 </div>
  <table class="submitTable">
  <tr>
  	<td width="120px;"></td>
    
    <td width="120px;"><input type="button" name="submit" value="save" class="ProductSubmit" onclick="SaveProduct('<?php print_r($product_details[$i]['id']) ?>','<?php print_r($product_details[$i]['consignee']); ?>','<?php print_r($product_details[$i]['inspection']) ?>','<?php print_r($tender_details['tender_tdc']) ?>',<?php print_r($tender_details['tender_emd']) ?>)"/>
  </td>
    <td width="120px;"> <input type="button" name="add_more" id="add_more" value="Add More Items" class="add_more" onclick="add_quoto(<?php print_r ($product_details[$i]['id']); ?>);"/></td>
    <td><input type="hidden" id="hide<?php print_r($product_details[$i]['id']);?>" value="0" /></td>
    
  </tr>
 
  </table>
 
  
</form>



</div>
<?php
}
?>
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