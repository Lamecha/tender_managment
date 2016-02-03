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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="main_css/main_css.css"/>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="main_js/AjaxJavaSCript.js"></script>

</head>
<body>

<?php
if(isset($_GET['Pid']))
{
	$tender_firms=$obj->common_fetchdata('tender_firms',$_GET['Pid']);
	$firm_name = $obj->Common_name_id('consignee','csign_firm_name',$tender_firms['firm']);
	$main_consignee = $obj->Common_name_id('main_consignee','main_csign_name',$tender_firms['consignee']);
	$list_firm = $obj->List_Drop_Down("consignee","csign_firm_name","id");
	?>
    <form method="post" action="#" enctype="multipart/form-data">
    <table width="820" border="1" cellspacing="10" id="firm_table">
  <tr>
    <td width="90px;"><label>Select Firm</label></td>
    <td width="200px;"><select id="firm" name="firm">
    <option value="<?php print_r($firm_name['id']); ?>"><?php print_r($firm_name['csign_firm_name']); ?></option>
     
    <?php for($k=0;$k<sizeof($list_firm);$k++) 
	{ 
	 if($list_firm[$k]['id']==$firm_name['id'])
	 goto AfterFirm;
		?>
    <option value="<?php print_r($list_firm[$k]['id']); ?>"><?php print_r($list_firm[$k]['csign_firm_name']); ?></option>
    <?php 
	AfterFirm:
	} 
		?>
    </select>
    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><label>Consignee</label></td>
    <td><input type="text" id="consignee" name="consignee" value="<?php print_r($main_consignee['main_csign_name']) ?>" readonly="readonly" /></td>
    <td width="80px;"><label>Inspection</label></td>
    <?php if($tender_firms['inspection']==1){$ins='ITES';} else if($tender_firms['inspection']==2){$ins='DOI';}else if($tender_firms['inspection']==3){$ins='RDSO';}else if($tender_firms['inspection']==4){$ins='Others';}else { $ins='';} ?>
    <td><input type="text" id="inspection" name="inspection" readonly="readonly" value="<?php echo $ins; ?>"></td>
  </tr>
  <tr>
    <td><label>Quantity</label></td>
    <td><input type="text" id="quantity" name="quantity" value="<?php print_r($tender_firms['quantity']); ?>" class="validate[required] Xtext-input" /></td>
    <td><label>Unit</label></td>
    <td><input type="text" id="unit" name="unit" value="<?php print_r($tender_firms['unit']); ?> " /></td>
  </tr>
  <tr>
    <td><label>TDC</label></td>
     <?php if($tender_firms['tdc']==1){$tdc='Exempted';} else if($tender_firms['tdc']==2){$tdc='Paid';}else if($tender_firms['tdc']==3){$tdc='Not Required';}else { $tdc='';} ?>
    <td><input type="text" id="tdc" name="tdc" readonly="readonly" value="<?php echo $tdc ?>"/>
    </td>
    <td><label>EMD</label></td>
     <?php if($tender_firms['emd']==1){$emd='Exempted';} else if($tender_firms['emd']==2){$emd='Paid';}else if($tender_firms['emd']==3){$emd='Not Required';}else { $emd='';} ?>
    
    <td><input type="text" id="emd" name="emd" readonly="readonly" value="<?php echo $emd; ?>" />
    </td>
  </tr>
  <tr>
    <td><label>Rate</label></td>
    <td><input type="text" id="rate" name="rate" value="<?php print_r($tender_firms['rate']); ?>" /></td>
    <td><label>Tax Type</label></td>
    <td><select id="taxtype" name="taxtype">
    <?php if($tender_firm['taxtype']==1){ 
		   $optiontax='VAT';
		   $taxvalue=1;
		   }
		   else
		   {
		   $optiontax='CST';
		   $taxvalue=2;
		   }
		   ?>
     <option value="<?php echo $taxvalue; ?>"><?php echo $optiontax; ?></option>
    <?php if($taxvalue!=1) { ?>       
    <option value="1">VAT</option>
    <?php } else { ?>
    <option value="2">CST</option>
    <?php } ?>
    </select></td>
  </tr>
  <tr>
    <td><label>Tax %</label></td>
    <td><input type="text" id="taxper" name="taxper" value="<?php print_r($tender_firms['taper']); ?>" /></td>
    <td><label>Tax Amount</label></td>
    <td><input type="text" id="taxamount" name="taxamount" value="<?php print_r($tender_firms['taxamount']); ?>" /></td>
  </tr>
 	<td><label>Discount %</label></td>
    <td><input type="text" id="disper" name="disper" value="<?php print_r($tender_firms['disper']); ?>" /></td>
    <td><label>Discount Amount</label></td>
    <td><input type="text" id="disamount" name="disamount" value="<?php print_r($tender_firms['disamount']); ?>" /></td>
  </tr>
  <tr>
    <td><label>Other Charges</label></td>
    <td><input type="text" id="othercharg" name="othercharg" value="<?php print_r($tender_firms['othercharg']); ?>" /></td>
    <td><label>Validity Days</label></td>
    <td><input type="text" id="validday" name="validday" value="<?php print_r($tender_firms['validday']); ?>" /></td>
  </tr>
  <tr>
    <td><label>Payment</label></td>
    <td><select id="payment" name="payment">
    <?php if($tender_firms['payment']==1) 
	{
		$payment_option='Consignee';
		$payment_value=1;
	}
	else if ($tender_firms['payment']==2) 
	{
		$payment_option='RITES';
		$payment_value=2;
	}
	else if($tender_firms['payment']==3) 
	{
		$payment_option='DOI';
		$payment_value=3;
	}
	if($tender_firms['payment']==4) 
	{
		$payment_option='RDSO';
		$payment_value=4;
	}
	else
	{
		$payment_option='Others';
		$payment_value=5;
		
	}
	?>
    <option value="<?php echo $payment_value; ?>"><?php echo $payment_option; ?></option>
    <?php if($tender_firms['payment']!=1){ ?>
    <option value="1">Consignee</option>
    <?php } if($tender_firms['payment']!=2) { ?>
    <option value="2">RITES</option>
    <?php } if($tender_firms['payment']!=3) { ?>
    <option value="3">DOI</option>
    <?php } if($tender_firms['payment']!=4) { ?>
    <option value="4">RDSO</option>
    <?php } if($tender_firms['payment']!=5) { ?>
    <option value="5">Others</option>
    <?php } ?>
    </select></td>
    <td><label>Delivery Periode</label></td>
    <td><input type="text" id="delperod" name="delperod" value="<?php print_r($tender_firms['delperod']); ?>" /></td>
  </tr>
  <tr>
    <td><label>Delivery schedule</label></td>
    <td><input type="text" id="delschedule" name="delschedule" value="<?php print_r($tender_firms['delschedule']); ?>" /></td>
    <td><label>Remark</label></td>
    <td><textarea rows="4" id="remark" name="remark"><?php print_r($tender_firms['remark']); ?></textarea></td>
  </tr>
  <tr>
    <td><label>SPI Nate</label></td>
    <td><textarea rows="4" id="spinate" name="spinate"><?php print_r($tender_firms['spinate']); ?></textarea></td>
    <input type="hidden" id="idhide" name="idhide" value="<?php echo $_GET['Pid']; ?>" />
  </tr>
  <tr>
  <td>&nbsp;</td>
  <td>
  <input type="button" name="submit" id="submit" value="save" class="ProductSubmit"/>
  </td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  </tr>
  </table>
  </form>
    <?php
	
}
?>


</body>

</html>
