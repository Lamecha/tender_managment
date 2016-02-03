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
if(isset($_GET['val']) && $_GET['val']!="")
{
	$result = $obj->common_fetchdata('tender',$_GET['val']);
	$corect_date_format = explode("-",$result['tender_due_date']);
	$final_date =$corect_date_format[2].'-'.$corect_date_format[1].'-'.$corect_date_format[0];
	$result_product = $obj->common_fetch_attachement_withItem('tender_firm_product','tender_id',$_GET['val']);
	$result_attachment = $obj->common_fetch_attachement('tender_attachments','tender_id',$_GET['val']);
	
	$result_limited_firms = $obj->common_fetch_attachement_limited_firm('tender_limited_firm','tender_id',$_GET['val']);
	$tender_office= $obj->Common_name_id('office','office_code',$result['tender_office']);
	$tender_purchaser = $obj->Common_name_id('create_purchaser','purchaser_short_name',$result['tender_purchaser']);
	
	 
	$list_consignee_edit=$obj->List_Drop_down_onSelection_noAjax('main_consignee','main_csign_short_name','main_csign_purchaser',$result['tender_purchaser']);
	
	
}
$list_office = $obj->List_Drop_Down("office","office_code","id");
$list_firm = $obj->List_Drop_Down("consignee","csign_short_name","id");
//print_r($list_firm);	
//tere liye
?>
<script type="text/javascript">
//tere liye check

<?php

$tlf_str = "var tere_liye_firms_list = [";
foreach($list_firm as $tl)
{
	$tlf_str .="['".$tl['csign_short_name']."',".$tl['id']."],";

}
$tlf_str = substr($tlf_str,0,strlen($tlf_str)-1);
$tlf_str .= "]";
echo $tlf_str;
?>
</script>
<?php

//tere liye

$list_purchaser = $obj->List_Drop_Down("create_purchaser","purchaser_short_name","id");
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
			move_uploaded_file($tmp_name,"attachements/tender_attach/".$finalName[$i]);
		}
	
	
	if(isset($_GET['val']) & $_GET['val']!="")
		{
			
		$update_result = $obj->tender_registration_update($_POST,$finalName,$name,$_SESSION['pin_id'],$_SESSION['pin_table'],$_GET['val']);
			if($update_result == 1)
			{
			$obj->ALertMessage("Tender Updated ",$update_result);
			$obj->redirect("edit_tender.php");
			}
		}
		else
		{
			
	//$tender = $obj->tender_registration($_POST,$_SESSION['pin_id'],$_SESSION['pin_table']);
	$tender = $obj->tender_registration($_POST,$finalName,$name,$_SESSION['pin_id'],$_SESSION['pin_table']);
	$obj->ALertMessage("Tender registered",$tender);
	
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
<link rel="stylesheet" href="main_css/main_css.css"/>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
<link href="styles.css" rel="stylesheet" />
<title><?php if(isset($_GET['val'])){echo "Update";}else{"Fill";} ?> Tender</title>

  
<link type="text/css" rel="stylesheet" media="all" href="jquery-ui-1.8.9.custom.css"/> 
  <script type="text/javascript" src="jquery-1.4.4.min.js"></script> 
  <script type="text/javascript" src="jquery-ui-1.8.9.custom.min.js"></script> 
  <script type="text/javascript" src="presidents.js"></script> 






<link rel="stylesheet" type="text/css" media="screen" href="main_css/jquery.ui.potato.menu.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="main_js/AjaxJavaSCript.js"></script>
<script type="text/javascript" src="main_js/menu_bar/jquery.ui.potato.menu.js"></script>
<script type="text/javascript">
var $=jQuery.noConflict();
(function($) {
    $(document).ready(function(){
        $('#menu1').ptMenu();
    });
})(jQuery);
</script>
<script type="text/javascript" language="javascript">
function getAllFirms()
{
	var fData = "<option value=''>Select Firm</option>";
	<?php
	for($i=0;$i<sizeof($list_firms);$i++)
	{
		$Firmsdata.= "<option value='".$list_firms[$i]['id']."'>".$list_firms[$i]['csign_firm_name']."</option>"; 
	}?>fData +=<? echo '"'.$Firmsdata.'";';?>
	return fData;
}
function getAllConsignee(ICNSINE)
{
	
	var mData = "<option value=''>Select Consignee</option>";
	<?php
	//$Cnsigneedata.= "<option value='".$cnN['id']."'>".$cnN['main_csign_name']."</option>";
	for($i=0;$i<sizeof($list_cnsig);$i++)
	{
		$Cnsigneedata.= "<option value='".$list_cnsig[$i]['id']."'>".$list_cnsig[$i]['main_csign_short_name']."</option>"; 
	}?>mData +=<? echo '"'.$Cnsigneedata.'";';?>
	return mData;
	
}
function getAllFirms()
{
	var FData = "<option value=''>Please select</option>";
	<?php
	for($ij=0;$ij<sizeof($list_firm);$ij++)
	{
		$Firmdata.= "<option value='".$list_firm[$ij]['id']."'>".$list_firm[$ij]['csign_short_name']."</option>"; 
	}?>FData +=<? echo '"'.$Firmdata.'";';?>
	return FData;
}
function getAllInspection(INS)
{
	if(INS==1)
	var option='RITES';
	if(INS==2)
	var option='DQA';
	if(INS==3)
	var option='RITES/DQA';
	if(INS==4)
	var option='CONSIGNEE';
	if(INS==5)
	var option='RDSO';
	if(INS==6)
	var option='RITES/Visual';
	if(INS==7)
	var option='RITES/MTC & GC';
	if(INS==8)
	var option='DQA/Visual';
	if(INS==9)
	var option='DQA/MTC & GC';
	if(INS==10)
	var option='OTHERS';
	var qData = "<option value="+INS+">"+option+"</option>"
	
	if(INS!=1)
	qData += "<option value='1'>RITES</option>"
	if(INS!=2)
	qData += "<option value='2'>DQA</option>"
	if(INS!=3)
	qData += "<option value='3'>RITES/DQA</option>"
	if(INS!=4)
	qData += "<option value='4'>CONSIGNEE</option>"
	if(INS!=5)
	qData += "<option value='5'>RDSO</option>"
	if(INS!=6)
	qData += "<option value='6'>RITES/Visual</option>"
	if(INS!=7)
	qData += "<option value='7'>RITES/MTC & GC</option>"
	if(INS!=8)
	qData += "<option value='8'>DQA/Visual</option>"
	if(INS!=9)
	qData += "<option value='9'>DQA/MTC & GC</option>"
	if(INS!=10)
	qData += "<option value='10'>OTHERS</option>"
	return qData;
}
function getAllUnit(IU)
{
	if(IU==1)
	var option='NOS';
	if(IU==2)
	var option='Kg';
	if(IU==3)
	var option='Mtr';
	if(IU==4)
	var option='Pcs';
	if(IU==5)
	var option='Pair';
	if(IU==6)
	var option='Yard'
	var uData = "<option value="+IU+">"+option+"</option>"
	
	if(IU!=1)
	uData += "<option value='1'>NOS</option>"
	if(IU!=2)
	uData += "<option value='2'>Kg</option>"
	if(IU!=3)
	uData += "<option value='3'>Mtr</option>"
	if(IU!=4)
	uData += "<option value='4'>Pcs</option>"
	if(IU!=5)
	uData += "<option value='5'>Pair</option>"
	if(IU!=6)
	uData += "<option value='6'>Yard</option>"
	return uData;
	
}
function getAllConsignee(CNS)
{
	 <?php
   $cons_opt='_'.CNS.'_C';
   $$cons_opt="selected='selected'";
   ?>
	<?php
	//$Cnsigneedata.= "<option value='".$cnN['id']."'>".$cnN['main_csign_name']."</option>";
	for($i=0;$i<sizeof($list_cnsig);$i++)
	{
		$Cnsigneedata.= "<option value='".$list_cnsig[$i]['id']."'>".$list_cnsig[$i]['main_csign_short_name']."</option>"; 
	}?>mData +=<? echo '"'.$Cnsigneedata.'";';?>
	return mData;
   <?php
   $cons_opt='_'.$v['consignee'].'_C';
   $$cons_opt="selected='selected'";
   ?>
	
}


function getSelectBox(value)
{
	var new_select = document.createElement('select');
	//new_select.setAttribute("id",value);
	new_select.setAttribute("name",value);
	
	var new_opt = getAllFirms();
//	new_opt.innerHTML="helllo";
	new_select.innerHTML=new_opt;
	return new_select;
}
function Re_Limited_Firm(name,id,value)
{
	var new_opt_limited = new Array();
	var limited_firm = document.createElement('select');
	//limited_firm.setAttribute("id",value);
	limited_firm.setAttribute("name",name);
	 new_opt_limited= getSelectedReLimitedFirm(value);
	 


for(var n_o_f=0;n_o_f<new_opt_limited.length;n_o_f++)
	{
	limited_firm.appendChild(new_opt_limited[n_o_f]);	
	}

	return limited_firm;
	
}
function getSelectedReLimitedFirm(fvalue)
{
	
	var new_final_array_of_options = new Array(parseInt(tere_liye_firms_list.length));
	for(var tri = 0;tri<tere_liye_firms_list.length;tri++)
	{
		var new_opt = document.createElement("option");
		new_opt.setAttribute("value",parseInt(tere_liye_firms_list[tri][1]));
		
		if(parseInt(tere_liye_firms_list[tri][1])==parseInt(fvalue))
		{
		new_opt.setAttribute("selected","selected");
		}
		new_opt.innerHTML = tere_liye_firms_list[tri][0];
		new_final_array_of_options[tri] = new_opt;
//alert(tere_liye_firms_list[tri][0]);
	}
	return new_final_array_of_options;
	
}


function getSelectBox2(value,idC,ICNSINE)
{
	var new_select2 = document.createElement('select');
	//new_select2.setAttribute("id",value);
	new_select2.setAttribute("name",value);
	new_select2.setAttribute("class","selectD");
	new_select2.setAttribute("id",'consignee'+idC);
	
	var new_opt2 = getAllConsignee(ICNSINE);
//	new_opt.innerHTML="helllo";
	new_select2.innerHTML=new_opt2;
	return new_select2;
}
function AllFirms(name,id)
{
	var new_select2 = document.createElement('select');
	new_select2.setAttribute("name",name);
	new_select2.setAttribute("id",'firm_limited_'+id);
	var new_opt2 = getAllFirms();
    new_select2.innerHTML=new_opt2;
	return new_select2;
	
}
function getSelectBox3(value,id,INS)
{
	
	//getSelectBox3("inspection[]",counter,INS)
	var new_select3 = document.createElement('select');
	//new_select2.setAttribute("id",value);
	new_select3.setAttribute("name",value);
	new_select3.setAttribute("class","selectD");
	new_select3.setAttribute("id",'inspection'+id);

	
	var new_opt3 = getAllInspection(INS);
//	new_opt.innerHTML="helllo";
	new_select3.innerHTML=new_opt3;
	return new_select3;
}
function Re_getSelectBox3(value,id,INS)
{
	
	//getSelectBox3("inspection[]",counter,INS)
	var new_select3 = document.createElement('select');
	//new_select2.setAttribute("id",value);
	new_select3.setAttribute("name",value);
	new_select3.setAttribute("class","selectD");
	new_select3.setAttribute("id",'category_re_'+id);
    var new_opt3 = getAllInspection(INS);
//	new_opt.innerHTML="helllo";
	new_select3.innerHTML=new_opt3;
	return new_select3;
}
function Re_Consignee(value,id,CNS)
{
	var new_select31 = document.createElement('select');
	//new_select2.setAttribute("id",value);
	new_select31.setAttribute("name",value);
	new_select31.setAttribute("class","selectD");
	new_select31.setAttribute("id",'consignee_re_'+id);
    var new_opt31 = getAllConsignee(CNS);
//	new_opt.innerHTML="helllo";
	new_select31.innerHTML=new_opt31;
	return new_select31;
	
}

function getSelectBoxUnit(value,id,IU)
{
	//getSelectBox3("inspection[]",counter,INS)
	var new_select_unit = document.createElement('select');
	//new_select2.setAttribute("id",value);
	new_select_unit.setAttribute("name",value);
	new_select_unit.setAttribute("class","selectD");
	new_select_unit.setAttribute("id",'unit'+id);

	
	var new_opt_unit = getAllUnit(IU);
//	new_opt.innerHTML="helllo";
	new_select_unit.innerHTML=new_opt_unit;
	return new_select_unit;
	
	
}
function Re_getSelectBoxUnit(value,id,IU)
{
	//getSelectBox3("inspection[]",counter,INS)
	var new_select_unit = document.createElement('select');
	//new_select2.setAttribute("id",value);
	new_select_unit.setAttribute("name",value);
	new_select_unit.setAttribute("class","selectD");
	new_select_unit.setAttribute("id",'unit_re_'+id);

	
	var new_opt_unit = getAllUnit(IU);
//	new_opt.innerHTML="helllo";
	new_select_unit.innerHTML=new_opt_unit;
	return new_select_unit;
}
 	
</script>

<script type="text/javascript" src="main_includes/add_new_row.js"></script>


<?php
if(!isset($_GET['val']))
{
?>
<script>
window.onload = function() {
  document.getElementById("csign_firm_name").focus();
};
</script>
<?php
}
else
{
?>
<script type="text/javascript">
window.onload = function() {
  document.getElementById("<?php echo $_GET['val'] ?>").focus();
  document.getElementById("csign_firm_name").focus();
};


</script>	
<?php
}
?>
<?php include_once("main_includes/date_picker.php");?> 

<?php include_once("main_includes/autocompleteMain.html");?> 

<script type="text/javascript">
function addID(nb)
{
//	alert("a"+nb);

	document.getElementById(nb).setAttribute("id","singleBirdRemote");
}

function removeID(nb)
{
	//alert("r"+nb);
	document.getElementById(nb).setAttribute("id","any");
	
}
////////////////////////
/*var $mX=jQuery.noConflict();
$mX(document).ready(function (){
   $mX("input#old_tender").autocomplete({
        source: 'presidents.php',
        select: AutoCompleteSelectHandler
    });
});
function AutoCompleteSelectHandler(event, ui) {
	alert('sasas');
   // alert( $mX(event.target).val() );
    //alert( $mX(this).val() );

    // alert( this.value );
}*/

</script>
<!-- FOR TIME PICKER-->
<style type="text/css"> 
#tabs{ margin: 20px -20px; border: none; }
#tabs, #ui-datepicker-div, .ui-datepicker{ font-size: 65%; }
.clear{ clear: both; }
</style> 
	<link rel="stylesheet" media="all" type="text/css" href="time/time-style.css" />
		<link rel="stylesheet" media="all" type="text/css" href="time/jquery-ui-timepicker-addon.css" />
		
		<script type="text/javascript" src="time/jquery-1.8.2.min.js"></script>
		<script type="text/javascript" src="time/1.9.1-jquery-ui.min.js"></script>
		<script type="text/javascript" src="time/jquery-ui-timepicker-addon.js"></script>
		<script type="text/javascript" src="time/jquery-ui-sliderAccess.js"></script>
		<script type="text/javascript">
		var $s=jQuery.noConflict();			
			$s(function(){
				$s('#tabs').tabs();
		
				$s('.example-container > pre').each(function(i){
					eval($s(this).text());
				});
			});
			
		</script>
<!------------------REMOVING CONCEPT--------------------->

<script>
function DeleteRow(namez,rowid)
{
	Myrow=namez+rowid;
	//Myrow=row+rowid;
    var row = document.getElementById(Myrow);
    row.parentNode.removeChild(row);
}
</script>


<!-------------------------------------------------------->
</head>
<body>
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
<span id="title_work_page"><?php if(isset($_GET['val'])){echo "Update";}else{"Fill";} ?> Tender</span>
<div id="working-sub-main">
<div id="working-panel">
<input type="button" id="remove_old" value="Remove Old" onClick="javascript:DeleteAllOldss();" style="position:absolute; left:900px; top:10px; z-index:100;"/>

<form method="post" enctype="multipart/form-data" id="formID" action="#" onSubmit="return CheckUnFilledConsignee();">

<table id="working-form">
<tr>
<td><label for="tender_office">Tender Office<font color="#990000">*</font></label></td>
<td><select id="tender_office" name="tender_office" class="validate[required] Xtext-input">
<?php if(isset($_GET['val'])){ ?>
<option value="<?php print_r($tender_office['id']); ?>"><?php print_r($tender_office['office_code']); ?></option>
<?php }
else
{ ?>
<option value="">Select</option>
<?php } for($i=0;$i<sizeof($list_office);$i++)
{
	if($tender_office['id']==$list_office[$i]['id'])
	goto OfficeGo;
	?>
    <option value="<?php print_r($list_office[$i]['id']); ?>"><?php print_r($list_office[$i]['office_code']); ?></option>
    <?php
	OfficeGo:
}
 ?>
</select>
</td>

</tr>

<?php if(isset($_GET['val'])) { ?>
<script type="text/javascript">
CnsignListonPurchaser(<?php print_r($tender_purchaser['id']); ?>,'meenu')
</script>
<?php } ?>
<?php if(!isset($_GET['val'])) 
{
?>
<tr>
<td><label for="tender_office">Purchaser<font color="#990000">*</font></label></td>
<td><select id="tender_purchaser" name="tender_purchaser" class="validate[required] Xtext-input" onChange="CnsignListonPurchaser(this.value);">
<?php if(isset($_GET['val'])) { ?>
<option value="<?php print_r($tender_purchaser['id']); ?>"><?php print_r($tender_purchaser['purchaser_short_name']); ?></option>
<?php } else { ?>
<option value="">Select</option>
<?php } for($i=0;$i<sizeof($list_purchaser);$i++)
{
	if($tender_purchaser['id']==$list_purchaser[$i]['id'])
	goto PurTen;
	?>
    <option value="<?php print_r($list_purchaser[$i]['id']); ?>"><?php print_r($list_purchaser[$i]['purchaser_short_name']); ?></option>
    <?php
	PurTen:
}
 ?>
</select>
</td>
</tr>
<?php
}
else
{
	?>
    <tr>
<td><label for="tender_office">Purchaser<font color="#990000">*</font></label></td>
<td><select id="tender_purchaser" name="tender_purchaser" class="validate[required] Xtext-input" onChange="CnsignListonPurchaser(this.value);">
<option value="<?=$tender_purchaser['id'];?>"><?=$tender_purchaser['purchaser_short_name'];?></option>
</select>
</td>
<td style="font-size:12px; color:#333;">&nbsp;Purchaser is not editable</td>
</tr>
    <?php
}
?>
<tr>
<td><label for="tender_type">Tender Type<font color="#990000">*</font></label></td>
<td><select id="tender_type" name="tender_type" class="validate[required] Xtext-input">
<?php
$sel_opt = "_".$result['tender_type'];
$$sel_opt  = "selected='selected'";
?>
<option value="0" <?=$_0;?>>Advertise</option>

<option value="1" <?=$_1;?>>Limited</option>

<option value="2" <?=$_2;?>>Bulletin</option>

<option value="3" <?=$_3;?>>SPL Limited</option>

<option value="4" <?=$_4;?>>Local Purchaser</option>

</select></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>

<!--- HERE WE ARE REMOVING CHOICE OPTION FOR NEW OR RE TENDER-->
<!--
<tr>
<td><label>New/Re Tender</label></td>
<td><select id="tender_status" name="tender_status" onChange="Re_tender(this.value);">
    <option value="1">New Tender</option>
    <option value="2">Re Tender</option>
</td>
<td><input type="text" name="tender_number" id="old_tender" class="AutoFillTender" placeholder="Please select old tender" style="display:none;" onblur="AddReTenderInfo(this.value);" /></td>
</tr>
-->

<tr><td><label for="tender_number">Tender No.<font color="#990000">*</font></label></td>
<td><input type="text" name="tender_number" id="presidentsServerInput" class=<?php if(!isset($_GET['val'])){ echo 'AutoFillTender';} else
{ echo "NoAutoFillTender" ;}?> value="<?php print_r($result['tender_number']); ?>" onKeyUp="CheckTenderNumber(this.value)"/></td><td><span id="tender_number_span"><img id="loader_no" style="display:none;" src="main_images/indicator.gif" /></span></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td><label for="tender_due_date">Due Date<font color="#990000">*</font></label></td>
<td><input type="text" name="tender_due_date" id="datepicker-example1_nsci" value="<?php echo $final_date; ?>" style="width:120px;" class="validate[required] Xtext-input"/></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td id="time"><label for="tender_time">Due Time</label></td>
<td>
<input type="text" name="tender_time" id="Xbasic_example_2" placeholder="00:00" value="<?php print_r($result['tender_time']); ?>" onKeyUp="numericFilter(this);"/>
<script>
var $s=jQuery.noConflict();
$s('#basic_example_2').timepicker();
</script>

 
</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr>
<td><label for="tender_sample">Sample Required<font color="#990000">*</font></label></td>
<td><select id="tender_sample" name="tender_sample" class="validate[required] Xtext-input">
<?php 
$tender_sample = "_".$result['tender_sample']."_s";
$$tender_sample = "selected='selected'";
?>
<option value="0" <?=$_0_s;?>>Yes</option>
<option value="1" <?=$_1_s;?>>No</option>
</select>
</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td><label for="tender_tdc">TDC Rs.</label></td>
<td><input type="text" name="tender_tdc" id="tender_tdc" class=" Xtext-input validateTE" value="<?php print_r($result['tender_tdc']); ?>" placeholder="0.00">
</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td><label for="tender_emd">EMD Rs.</label></td>
<td><input type="text" name="tender_emd" id="tender_emd" class=" Xtext-input validateTE" value="<?php print_r($result['tender_emd']) ?>" placeholder="0.00"/>
</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td><label for="tender_criteria">Criteria</label></td>
<td><input type="text" name="tender_criteria" id="tender_criteria"  value="<?php print_r($result['tender_criteria']); ?>"/></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>

<input type="hidden" id="HidenBoxForHavingVal" value="<?php echo $_GET['val']; ?>" />
</table>

<div id="re_tender_div"></div>

<table  id="multipels" class="attachz" cellspacing="3px;">
<caption>Products<?php
	if(isset($_GET['val']) && $result_product[0]!='' )
   //if(sizeof($result_director)<5 && isset($_GET['val']) && sizeof($result_director)>0) 
   { 
?>
/<a class="link_edit_director" onClick="window.open('record_products_tender.php?val=<?php print_r($result['id']); ?>&table=tender_firm_product&field=tender_id&purchaser='+document.getElementById('tender_purchaser').value,'mywindow','width=1020,height=333,left=100,top=100,screenX=0,screenY=100')">Edit old products</a>
<?php
}
?></caption>
<tr id='base_id'><th style="width:200px;">Item Category</th><th>Item Inspection</th><th style="width:200px;">Item Discription</th><th>Consignee</th><th>Quantity</th><th>Unit</th></tr>
<?php 
if(is_array($result_product))
{
	foreach($result_product as $mj) 
	{
		$my_unit=$obj->unit($mj['unit']);
		$my_inspection=$obj->inspection($mj['inspection']);
		?>
    	<tr id="update_row<?=$mj['id'];?>"><td><input type="text" name="category_update[]" style="width:200px;" class="kareena" value="<?=$mj['item_name'].":-".$mj['item_discription'];?>" id="category_update_0" readonly />
    </td>
    <td><input type="text" id="inspection_update_0" name="inspection_update[]" class="selectD" style="width:120px;" value="<?php echo $my_inspection;?>" readonly />
    </td>
    <td>
    <input type="text" name="discription_update[]" class="kareena" id="discription_update_0" readonly value="<?=$mj['discription'];?>" style="width:200px;"  />
    </td>
    <td>
    <input type="text" id="consignee_update_0" name="consignee_update[]" class="selectD" readonly value="<?=$mj['main_csign_short_name'];?>" style="width:120px;" >
    </td> 
    <td><input type="text" name="quantity_update[]" id="quantity_update_0" style="width:120px;" readonly value="<?=$mj['quantity'];?>"/></td>
    <td><input type="text" name="unit_update[]" id="unit_update_0" style="width:120px;" class="selectD" value="<?php echo $my_unit;  ?>" readonly/></td>
    </tr>
	<?php
	}
}
?>
<!--<tr id="first_dirct0">-->
<tr id="first_direct0">
<td><input type="text" name="category[]" style="width:200px;" class="kareena" id="category0" /></td>
<td><select id="inspection0" name="inspection[]" class="selectD" >
<option value='1'>RITES</option>
<option value='2'>DQA</option>
<option value='3'>RITES/DQA</option>
<option value='4'>CONSIGNEE</option>
<option value='5'>RDSO</option>
<option value='6'>RITES/Visual</option>
<option value='7'>RITES/MTC & GC</option>
<option value='8'>DQA/Visual</option>
<option value='9'>DQA/MTC & GC</option>
<option value='10'>OTHERS</option>

</select></td>
<td>
<textarea rows="3" cols="28" name="discription[]" style="border:1px solid #666" id="discription0"></textarea>
<!--<input type="text" name="discription[]" style="width:120px;"/>--></td>
<td><select id="consignee0" name="consignee[]" class="selectD" >
<?php if(isset($_GET['val'])) { ?>
<option value=''>Please Select</option>
<?php for($m=0;$m<sizeof($list_consignee_edit);$m++) { ?>
<option value="<?php print_r($list_consignee_edit[$m]['id']) ?>"><?php  print_r($list_consignee_edit[$m]['main_csign_short_name']); ?></option>
<?php } } ?>
</select>
</td>
<td><input type="text" name="quantity[]" id="quantity0" style="width:120px;" class="class_for_only_numeric_values"/></td>
<td><select name="unit[]" id="unit0" style="width:120px;" class="selectD"/>
<option value='1'>NOS</option>
<option value='2'>Kg</option>
<option value='3'>Mtr</option>
<option value='4'>Pcs</option>
<option value='5'>Pair</option>
<option value='6'>Yard</option>
</select>
</td>
</tr>

<tr style="background:#fff;">
<td colspan="2"><!--<input type="button" name="add_more" id="add_more" value="Add More Product" class="add_more" onclick="add_more_products('first_dirct0');"/>-->
<input type="button" name="add_more" id="add_more" value="Add More Product" class="add_more" onClick="add_more_products();"/>
</td>
</tr>
</table>
<div id="limited_firm_div"></div>
<table  id="Xattachments" class="AttachFirm">
<caption>Limited Firms<?php
	if(isset($_GET['val']) && $result_limited_firms[0]!='' )
    { 
?>
/<a class="link_edit_director" onClick="window.open('record_limited_firm.php?val=<?php print_r($result['id']); ?>&table=tender_limited_firm&field=tender_id','mywindow','width=400,height=233,left=100,top=100,screenX=0,screenY=100')">Edit Re-Assignments </a>
<?php
}
?>
</caption>
<tr><th style="width:200px;">Add Firms</th></tr>
<?php 
if(is_array($result_limited_firms))
{
	foreach($result_limited_firms as $Fj) 
	{
		?>
      <tr id="updated_limited_firm_<?=$Fj['id'];?>"><td><input type="text" readonly value="<?=$Fj['csign_short_name'];?>" /></td></tr>
        <?php
		
	}
}
		?>

<tr id="row_for_limited_firm_0"><td><select id="firm_limited_0" name="LimitedFirm[]">
        <option value="">Please select</option>
		<?php foreach($list_firm as $lf) 
		{
			?>
            <option value=<?=$lf['id'];?>><?=$lf['csign_short_name'];?></option>
            <?php
		}
		?>
        </select>
</td></tr>
<tr style="background:#fff;"><td><input type="button" name="add_more" id="add_more" value="Add More Firms" class="add_more" onClick="add_more_limited_firms();"/></td></tr>
<input type="hidden" id="limited_firm_counter" value="1" />
</table>

<div id="Re_tender_attach"></div>
<table  id="attachments" class="attachz">
<caption>Attachments <?php if(isset($_GET['val']) && $result_attachment[0]!='') { ?> <a class="link_edit_director" onClick="window.open('tender_old_attachemsnts_record.php?val=<?php print_r($result['id']); ?>&table=tender_attachments&field=tender_id','mywindow','width=500,height=300,left=100,top=100,screenX=0,screenY=100')">/Delete old </a><?php } ?></caption>
<tr id="base_id_attachements"><th>Title</th><th>File</th></tr>
<?php if(isset($_GET['val']) && $_GET['val']!='') { ?>
<?php foreach($result_attachment as $mla) { ?>
<?php
$title_value = $obj->Title_In_Tender_Attachements($mla['title']);
?>
<tr>
<td style="border:1px solid #696969; height:25px; font-size:13px;">
<?php if($mla['title']==10) 
{
	print_r($mla['other_title']);
}
else
{
	echo $title_value;
}
?>
</td>
<td style="border:1px solid #696969; height:25px; font-size:13px;"><?=$mla['file_real_name'];?></td>
</tr>
<?php } } ?>
<tr id="SHAKEB_0">
<td>
<select name="titles[]" id="title_0" style="width:120px; height:30px; border:1px solid #333;" onChange="IfSelectOtherThenTitle(this.id);">
<option value="">Please Select</option>
<option value="1">NIT</option>
<option value="2">Specification</option>
<option value="3">Drawing Copy</option>
<option value="4">Annexures</option>
<option value="5">Special Conditions</option>
<option value="10">Others</option>
</select>
</td>
<td><input type="file" name="files[]"/></td>
<td id="SHAKEB_COLM_0"><input type="hidden" id="text_on_others" name="text_on_others[]" /></td>
</tr>

<tr style="background:#fff;"><td>&nbsp;</td><td><input type="button" name="add_more" id="add_more" value="Add More" class="add_more" onClick="Add_More_Tender_Attachements();"/></td></tr>
<input type="hidden" name="hide_for_add_firms" id="hide_for_add_firm" value="1" />
</table>
<hr class="hrules" noshade="noshade" color="#dcdcdc"/>
<div id="newtables">
</div>
<table><tr><td><input type="submit" name="submit" id="main_submit" value="<?php if($_GET['val']!="") echo "Update"; else echo "Save"; ?>"/></td></tr></table>
<input type="hidden" name="key" id="key" value="<?php echo $_SESSION['key']; ?>" />
<input type="hidden" id="counter" name="counter" value=1 />
</form>

</div>

</div>
</div>
<div id="index-footer">
<?php include_once("main_includes/footer.php"); ?>
</div>
<script type="text/javascript">
   $('.validateTE').live('keydown',function(e){
	  var tj = $(this).val();
	  
	 
	  
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
</script>
<script type="text/javascript">
//$("a.offsite").live("click", function(){ alert("Goodbye!"); }); 
//$('INPUT[type="file"]').change(function () {
	$('INPUT[type="file"]').live("change",function(){
    var ext = this.value.match(/\.(.+)$/)[1];
    switch (ext) {
        case 'jpg':
        case 'jpeg':
        case 'pdf':
            $('#uploadButton').attr('disabled', false);
            break;
        default:
            alert('This is not an allowed file type.');
            this.value = '';
    }
});
</script>
<script>
function numericFilter(txb) {
   txb.value = txb.value.replace(/[^\0-9]/ig, "");
}
</script>
  
</body>
</html>