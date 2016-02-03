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
	$result = $obj->common_fetchdata('po',$_GET['val']);
	if($result['tender_type']==1)
	{
	$firm_list_edit_time = $obj->List_All_Firms_In_Po_Section_In_we_have_tender_id_No_Ajax($result['tender_id']);
	
	}
	else
	{
		$firm_list_edit_time = $obj->List_Drop_Down('consignee','csign_short_name','id');
			
		
	}
	
	if($result['due_date']!='0000-00-00')
	{
	$corect_date_format = explode("-",$result['due_date']);
	$due_date =$corect_date_format[2].'/'.$corect_date_format[1].'/'.$corect_date_format[0];
	}
	else
	{
	$due_date='';	
	}
	if($result['refi_date']!='0000-00-00')
	{
	$corect_date_format2 = explode("-",$result['refi_date']);
	$refi_date =$corect_date_format2[2].'/'.$corect_date_format2[1].'/'.$corect_date_format2[0];
	}
	else
	{
		$refi_date='';
	}
	if($result['extended_date']!='0000-00-00')
	{
	$corect_date_format3 = explode("-",$result['extended_date']);
	$extended_date =$corect_date_format3[2].'/'.$corect_date_format3[1].'/'.$corect_date_format3[0];
	}
	else
	{
		$extended_date='';
	}
	$result_product = $obj->common_fetch_attachement_withItem_In_PO('po_products','po_id',$_GET['val']);
	$result_attachment = $obj->common_fetch_attachement('po_attachments','tender_id',$_GET['val']);
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
	if($_POST['tender_type']==1)
	{
		$tender_number = $_POST['tender_number_opt_first'];
		$tender_office = $_POST['tender_office_hidden_box'];
		$tender_purchaser = $_POST['tender_purchaser_hidden_box'];
		
	}
	else
	{
		$tender_number = $_POST['tender_number_opt_2'];
		$tender_office = $_POST['tender_office_select_box'];
		$tender_purchaser = $_POST['tender_purchaser_select_box'];
		
		
	}
	
	    
	    $finalName = array();
		$name = array();
		for($i=0;$i<sizeof($_POST['titles']);$i++)
		{
			$name[$i] = $_FILES['files']['name'][$i];
			$tmp_name = $_FILES['files']['tmp_name'][$i];
			$ext = $obj->getExtension($name[$i]);
			$newName = $obj->nameGen();
			$finalName[$i]  = $newName.".".$ext;
			move_uploaded_file($tmp_name,"attachements/po_final_attachements/".$finalName[$i]);
		}
	
	
	if(isset($_GET['val']) & $_GET['val']!="")
		{
			
		$update_result = $obj->PO_update_final($_POST,$finalName,$name,$_SESSION['pin_id'],$_SESSION['pin_table'],$_GET['val']);
			if($update_result == 1)
			{
			$obj->ALertMessage("PO Updated ",$update_result);
			$obj->redirect("edit_po.php");
			}
		}
		else
		{
			
	//$tender = $obj->tender_registration($_POST,$_SESSION['pin_id'],$_SESSION['pin_table']);
	$tender = $obj->Po_Registration_Final($tender_number,$tender_office,$tender_purchaser,$_POST,$finalName,$name,$_SESSION['pin_id'],$_SESSION['pin_table']);
	$obj->ALertMessage("Po registered",$tender);
	
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
<title><?php if(isset($_GET['val'])){echo "Update";}else{"Fill";} ?> PO</title>

  <!------------------------New Date Picker---------------->
<link type="text/css" href="new_date/jquery.datepick.css" rel="stylesheet">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="new_date/jquery.datepick.js"></script>
<script type="text/javascript">
//var sDa = jQuery.noConflict();
$(function() {
	$('.meenu').datepick();
	$('#inlineDatepicker').datepick({onSelect: showDate});
});

function showDate(date) {
	alert('The date chosen is ' + date);
}
</script>

<!------------------------------------------------------->
<link type="text/css" rel="stylesheet" media="all" href="jquery-ui-1.8.9.custom.css"/> 
  <script type="text/javascript" src="jquery-1.4.4.min.js"></script> 
  <script type="text/javascript" src="jquery-ui-1.8.9.custom.min.js"></script> 
  <script type="text/javascript" src="presidents.js"></script> 






<link rel="stylesheet" type="text/css" media="screen" href="main_css/jquery.ui.potato.menu.css" />
<script type="text/javascript" src="Xhttp://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="main_js/AjaxJavaSCript.js"></script>
<script type="text/javascript" src="main_js/menu_bar/jquery.ui.potato.menu.js"></script>
<script type="text/javascript">
var $ml=jQuery.noConflict();
(function($ml) {
    $ml(document).ready(function(){
        $ml('#menu1').ptMenu();
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

function getAllTaxType(INS)
{
	if(INS==1)
	var option='VAT EXTRA';
	if(INS==2)
	var option='CST EXTRA';
	if(INS==3)
	var option='VAT INCL';
	if(INS==4)
	var option='CST INCL';
	if(INS==5)
	var option='Nil';
	var qData = "<option value="+INS+">"+option+"</option>"
	if(INS!=1)
	qData += "<option value='1'>VAT EXTRA</option>"
	if(INS!=2)
	qData += "<option value='2'>CST EXTRA</option>"
	if(INS!=3)
	qData += "<option value='3'>VAT INCL</option>"
	if(INS!=4)
	qData += "<option value='4'>CST INCL</option>"
	if(INS!=5)
	qData += "<option value='5'>Nil</option>"
	
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
function Re_getTaxType(value,id,INS)
{
	var new_selectT = document.createElement('select');
	//new_select2.setAttribute("id",value);
	new_selectT.setAttribute("name",value);
	new_selectT.setAttribute("class","selectD");
	new_selectT.setAttribute("id",'taxtype'+id);
	new_selectT.setAttribute("style",'width:80px;');
    var new_optT = getAllTaxType(INS);
//	new_opt.innerHTML="helllo";
	new_selectT.innerHTML=new_optT;
	return new_selectT;
	
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
	new_select_unit.setAttribute("style",'width:80px;');

	
	var new_opt_unit = getAllUnit();
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
	new_select_unit.setAttribute("style",'width:80px;');

	
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
<?php //include_once("main_includes/date_picker.php");?> 

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
<script>
function Options_In_Po(val)
{
	 $('.dynamic_products_row_class').remove();
	 $('.dynamic_attachements_row_class').remove();
	if(val=='')
	{
		$('.empty_consignee').empty();
		$('#name_of_firm').empty();
	document.getElementById('row_for_office_tender_opt_2_3').style.display='none';
	document.getElementById('row_for_purchaser_tender_opt_2_3').style.display='none';
	document.getElementById('row_for_number_tender_opt_2_3').style.display='none';
	document.getElementById('row_for_office_tender_opt_1').style.display='none';
	document.getElementById('row_for_purchaser_tender_opt_1').style.display='none';
	document.getElementById('row_for_number_tender_opt_1').style.display='none';
	//------------------------
	document.getElementById('tender_purchaser').value='';
	document.getElementById('tender_office').value='';
	document.getElementById('tender_number').value='';
	document.getElementById('file_number').value='';
	///////////////////////////////////
	document.getElementById('tender_office_name').value='';
	document.getElementById('hide_for_tender_office').value='';
	document.getElementById('tender_purchaser_name').value='';
	document.getElementById('hide_for_tender_purchaser').value='';
	document.getElementById('presidentsServerInput').value='';
	document.getElementById('hidden_box_for_tender_id_of_first_optn').value='';
	
	}
	else if(val==2 || val==3)
	{
		
		var mjs=12;
		
		document.getElementById('row_for_office_tender_opt_1').style.display='none';
	document.getElementById('row_for_purchaser_tender_opt_1').style.display='none';
	document.getElementById('row_for_number_tender_opt_1').style.display='none';
	document.getElementById('tender_office_name').value='';	
	document.getElementById('tender_office_name').value='';		
	document.getElementById('hide_for_tender_office').value='';
	document.getElementById('tender_purchaser_name').value='';
	document.getElementById('hide_for_tender_purchaser').value='';
	document.getElementById('presidentsServerInput').value='';
	document.getElementById('hidden_box_for_tender_id_of_first_optn').value='';
	document.getElementById('file_number').value='';
	
	
		//////////////////////////////////////////////////////////////////
		document.getElementById('row_for_office_tender_opt_2_3').style.display='';
		document.getElementById('row_for_purchaser_tender_opt_2_3').style.display='';
		document.getElementById('row_for_number_tender_opt_2_3').style.display='';
	$.ajax({
    	url:'MainAjax.php',
		type:'get',
		data:'firm_list_if_Po_option_2_Or_3_Select='+mjs,
		success : function(response){
		   
			document.getElementById('name_of_firm').innerHTML=response;
	
	},
		error: function() {  
        alert('Some tecnical error');
    	}
	});
		
		
	}
	else
	{
		$('#name_of_firm').empty();
	document.getElementById('row_for_office_tender_opt_2_3').style.display='none';
	document.getElementById('row_for_purchaser_tender_opt_2_3').style.display='none';
	document.getElementById('row_for_number_tender_opt_2_3').style.display='none';
	document.getElementById('tender_purchaser').value='';
	document.getElementById('tender_office').value='';
	document.getElementById('tender_number').value='';
	document.getElementById('file_number').value='';
	//----------------------------------------------------------------------
	document.getElementById('row_for_office_tender_opt_1').style.display='';
	document.getElementById('row_for_purchaser_tender_opt_1').style.display='';
	document.getElementById('row_for_number_tender_opt_1').style.display='';
	}
}
function ShowPaymentOther(payment_other)
{
	var select_value = document.getElementById(payment_other).value;
	var kl = payment_other.split('payment');
	if(select_value==10)
	{
	document.getElementById('paymentother'+kl[1]).style.display='';
	}
	else
	{
		document.getElementById('paymentother'+kl[1]).style.display='none';
	}
}
function XShowPaymentOther(payment_other)
{
	
	var select_value = document.getElementById(payment_other).value;
	var kl = payment_other.split('payment_re_');
	if(select_value==10)
	{
	document.getElementById('paymentother_re_'+kl[1]).style.display='';
	}
	else
	{
		document.getElementById('paymentother_re_'+kl[1]).style.display='none';
	}
}
function CalculationBaseOnQuantity(qid)
{
	
	var quanvalue = parseFloat(document.getElementById(qid).value);
	if(isNaN(quanvalue))
	{
		quanvalue=1;
	}
	var fd = qid.split('quantity')
	var ratevalue = parseFloat(document.getElementById('rate'+fd[1]).value);
	if(isNaN(ratevalue))
	{
		ratevalue=1;
	}
	var reslt=quanvalue*ratevalue;
	document.getElementById('includingall'+fd[1]).value=reslt;
}
function CalculationBaseOnRate(rid)
{
	
	var ratevalue = parseFloat(document.getElementById(rid).value);
	if(isNaN(ratevalue))
	{
		ratevalue=1;
	}
	var fdX = rid.split('rate')
	var quantityvalue = parseFloat(document.getElementById('quantity'+fdX[1]).value);
	if(isNaN(quantityvalue))
	{
		quantityvalue=1;
	}
	var resltX=quantityvalue*ratevalue;
	document.getElementById('includingall'+fdX[1]).value=resltX;
}
</script>
<script type="text/javascript">
function security_deposit_function(q)
{
	if(q==1)
	{
		document.getElementById('security_deposit_text_area').style.display='';
	}
	else
	{
		document.getElementById('security_deposit_text_area').style.display='none';
	}
}
function DeleteAllOldssInPage()
{
	$('.dynamic_products_row_class').remove();
	 $('.dynamic_attachements_row_class').remove();
}
</script>


<!-------------------------------------------------------->
</head>
<body>
<?php if(isset($_GET['val'])) { ?>
<script type="text/javascript">
CnsignListonPurchaser(<?php print_r($result['tender_purchaser']); ?>,'meenu')
</script>
<?php } ?>
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
<span id="title_work_page"><?php if(isset($_GET['val'])){echo "Update";}else{"Fill";} ?>PO</span>
<div id="working-sub-main" style="width:1920px;">
<div id="working-panel" style="width:1900px;">
<input type="button" id="remove_old" value="Remove Old" onClick="javascript:DeleteAllOldssInPage();" style="position:absolute; left:620px; top:140px; z-index:100;"/>

<form method="post" enctype="multipart/form-data" id="formID" action="#" onSubmit="return CheckUnFilledConsignee();">

<table id="working-form">
<tr>
<td><label for="tender_type">Po Type<font color="#990000">*</font></label></td>
<td>
<?php $po_type=$obj->PO_TYPE($result['tender_type']); ?>
<?php if(isset($_GET['val']) && $_GET['val']!='') 
{
	?>
    <input type="text" id="Edit_time_po_type" name="Edit_time_po_type" value="<?=$po_type;?>" readonly />
    <?php
}
else
{
?>
<select id="tender_type" name="tender_type" class="validate[required] Xtext-input" onChange="<?php if(!isset($_GET['val'])){ ?>Options_In_Po(this.value)"<?php } ?>>
<?php
$sel_opt = "_".$result['tender_type'];
$$sel_opt  = "selected='selected'";
?>
<option value="">Please Select</option>
<option value="1" <?=$_1;?>>Tender</option>
<option value="2" <?=$_2;?>>Direct</option>
<option value="3" <?=$_3;?>>Commision</option>
</select>
<?php } ?>
</td><td><?php if(isset($_GET['val']) && $_GET['val']!='') { ?><label>* Po Type is not editable</label> <?php } ?></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
<?php if(isset($_GET['val']) && $_GET['val']!='') 
{
	?>
    <tr><td><label>Tender No</label></td><td><input type="text" name="edit_time_tender_no" value="<?php print_r($result['tender_number']); ?>" readonly /></td><td><label>* Tender No is not editable</label></td></tr>
    <tr><td><label>Tender Office</label></td><td><input type="text" name="edit_time_tender_office" value='<?php print_r($tender_office['office_code']); ?>' readonly /></td><td><label>* Office is not editable</label></td></tr>
    <tr><td><label>Purchaser</label></td><td><input type="text" name="edit_time_tender_purchaser" value='<?php print_r($tender_purchaser['purchaser_short_name']); ?>' readonly /></td><td><label>* Purchaser is not editable</label></td></tr>
    <?php
}
?>


<!------------------------IF OPTION 1st is Selected Then Choose To Show Below--->
<tr style="display:none" id="row_for_number_tender_opt_1"><td><label for="tender_number">Tender No.<font color="#990000">*</font></label></td>
<td><input type="text" name="tender_number_opt_first" id="presidentsServerInput" class=<?php if(!isset($_GET['val'])){ echo 'AutoFillPo_Section';} else
{ echo "No_AutoFillPo_Section" ;}?>  /></td><td><span id="tender_number_span"><img id="loader_no" style="display:none;" src="main_images/indicator.gif" /></span></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr style="display:none;" id="row_for_office_tender_opt_1">
<td><label for="tender_office">Tender Office<font color="#990000">*</font></label></td>
<td><input type="text" name="tender_office_name" id="tender_office_name" readonly /></td><td>&nbsp;</td><td><input type="hidden" id="hide_for_tender_office" name="tender_office_hidden_box" /></td><td>&nbsp;</td><td>&nbsp;</td>
</tr>
<tr style="display:none;" id="row_for_purchaser_tender_opt_1">
<td><label for="tender_purchaser">Purchaser<font color="#990000">*</font></label></td>
<td><input type="text" name="tender_purchaser_name" id="tender_purchaser_name" readonly value="<?=$tender_purchaser['purchaser_short_name']?>" /></td><td>&nbsp;</td><td><input type="hidden" id="hide_for_tender_purchaser" name="tender_purchaser_hidden_box" /></td><td>&nbsp;</td><td>&nbsp;</td>
</tr>
<!-------------------------------------------------------------------------->
<!------------------------------If Option 2nd Or 3 rd is Selected then choose to show below-------------------------->
<tr style="display:none;" id="row_for_number_tender_opt_2_3" >
<td><label for="tender_number">Tender No.<font color="#990000">*</font></label></td>
<td><input type="text" name="tender_number_opt_2" id="tender_number"  value="<?php print_r($result['tender_criteria']); ?>"/></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
</tr>
<tr style="display:none;" id="row_for_office_tender_opt_2_3">
<td><label for="tender_office">Tender Office<font color="#990000">*</font></label></td>
<td><select id="tender_office" name="tender_office_select_box" class="validate[required] Xtext-input" onChange="GenerateFileNumberInSecondOpt(this.innerHTML);">
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
<?php //if(isset($_GET['val'])) { ?>
<script type="text/javascript">
//CnsignListonPurchaser(<?php// print_r($tender_purchaser['id']); ?>,'meenu')
</script>
<?php //} ?>
<tr style="display:none;" id="row_for_purchaser_tender_opt_2_3" >
<td><label for="tender_office">Purchaser<font color="#990000">*</font></label></td>
<td><select id="tender_purchaser" name="tender_purchaser_select_box" class="validate[required] Xtext-input" onChange="CnsignListonPurchaser(this.value);">
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


<!-------------------------------------------------------------------------->

<tr><td><label for="file_number">File Number <font style="color:#990000;">*</font></label></td>
<td><input type="text" name="file_number" id="file_number"  value="<?php print_r($result['file_number']); ?>" readonly class="validate[required]"/></td><td><?php if(isset($_GET['val']) && $_GET['val']!='') { ?> <label>* File No. is not editable</label> <?php } ?></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td><label for="name_of_firm">Name of Firm</label></td>
<td><select name="name_of_firm" id="name_of_firm" class="validate[required] selectD" onChange="AddProductsInPoSectionReProduct(this.value)">
<?php if(isset($_GET['val'])) 
{
	$list_opt_s_KO = '_'.$result['name_of_firm'].'_NXD';
	$$list_opt_s_KO = "SELECTED = 'selected'";
	foreach($firm_list_edit_time as $lfR)
	{
	?>
    <option value="<?=$lfR['id'];?>" <?=${'_'.$lfR['firm'].'_NXD'};?>><?=$lfR['csign_short_name'];?></option>
    <?php
	}
	
}
?>
</select></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td><label for="po_number">PO Number</label></td>
<td><input type="text" name="po_number" id="po_number"  value="<?php print_r($result['po_number']); ?>" class="validate[required] Xtext-input"/></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>

<tr><td><label for="tender_due_date">Due Date<font color="#990000">*</font></label></td>
<td><input type="text" name="due_date" value="<?php echo $due_date; ?>" style="width:120px;" class="meenu" readonly/></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td><label for="refi_due_date">Refix Due Date</label></td>
<td><input type="text" name="refi_date" id="refix_due_date" value="<?php echo $refi_date; ?>" style="width:120px;" class="meenu" readonly/></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td><label for="extended_due_date">Extended Due Date</label></td>
<td><input type="text" name="extended_date" id="extended_date" value="<?php echo $extended_date; ?>" style="width:120px;" class="meenu" readonly/></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td><label for="security_deposit">Security Deposit</label></td>
<td>
<?php $security_opt = '_'.$result['security_deposit'].'_SD'; 

$$security_opt = "Selected='selected'";
?>
<select id='security_deposit' name="security_deposit" onChange="security_deposit_function(this.value)" style="width:120px;">
<option value="1" <?=$_1_SD;?>>Yes</option>
<option value="2" <?=$_2_SD;?>>No</option>
</select></td>
</tr>
<tr></tr>
<tr><td>&nbsp;</td>
<td><textarea style="border:1px solid #333;display:<?php if($result['security_deposit']==2){ echo 'none;'; }?>"  rows="5" cols="20" id="security_deposit_text_area" name="security_deposit_text_area"><?php print_r($result['security_deposit_text_area']);?></textarea></td>
</tr>




<input type="hidden" id="HidenBoxForHavingVal" value="<?php echo $_GET['val']; ?>" />
</table>

<div id="re_tender_div"></div>

<table  id="multipels" class="attachz" cellspacing="3px;">
<caption>Products<?php
	if(isset($_GET['val']) && $result_product[0]!='' )
   //if(sizeof($result_director)<5 && isset($_GET['val']) && sizeof($result_director)>0) 
   { 
?>
/<a class="link_edit_director" onClick="window.open('record_product_in_po_long_table.php?val=<?php print_r($result['id']); ?>&table=po_products&field=po_id&purchaser='+document.getElementById('tender_purchaser').value,'mywindow','width=2300,height=333,left=0,top=100,screenX=0,screenY=100')">Delete old products</a>
<?php
}
?></caption>
<tr id='base_id'><th style="width:200px;">Item Category</th><th>Item Inspection</th><th style="width:200px;">Item Discription</th><th>Consignee</th><th style="width:80px;">Quantity</th><th style="width:80px;">Unit</th><th style="width:80px">Rate</th><th style="width:80px">Tax Type</th><th style="width:80px">Including All</th><th style="width:100px">Total Value</th><th style="width:180px;">Payment</th><th style="width:100px;">Paying Autority</th><th style="width:100px;">Inspection Place</th><th style="width:80px;">Delivery Date</th><th style="width:80px;">Quantity</th>
</tr>
<?php 
if(is_array($result_product))
{
	foreach($result_product as $mj) 
	{
		$my_unit=$obj->unit($mj['unit']);
		$my_taxtype=$obj->taxType($mj['taxtype']);
		$my_inspection=$obj->inspection($mj['inspection']);
		$my_payment=$obj->paymentInPoOpt($mj['payment'])
		?>
    	<tr id="update_row<?=$mj['id'];?>"><td><input type="text" name="category_update[]" style="width:200px;" class="kareena" value="<?=$mj['item_name'].":-".$mj['item_discription'];?>" id="category_update_0" readonly />
    </td>
    <td><input type="text" id="inspection_update_0" name="inspection_update[]" class="selectD" style="width:120px;" value="<?php echo $my_inspection;?>" readonly />
    </td>
    <td>
    <input type="text" name="discription_update[]" class="kareena" id="discription_update_0" readonly value="<?=$mj['discription'];?>" style="width:270px;"  />
    </td>
    <td>
    <input type="text" id="consignee_update_0" name="consignee_update[]" class="selectD" readonly value="<?=$mj['main_csign_short_name'];?>" style="width:120px;" >
    </td> 
    <td><input type="text" name="quantity_update[]" id="quantity_update_0" style="width:80px;" readonly value="<?=$mj['quantity'];?>"/></td>
    <td><input type="text" name="unit_update[]" id="unit_update_0" style="width:80px;" class="selectD" value="<?php echo $my_unit;  ?>" readonly/></td>
     <td><input type="text" name="quantity_update[]" id="quantity_update_0" style="width:80px;" readonly value="<?=$mj['rate'];?>"/></td>
        <td><input type="text" name="taxtype_update[]" id="taxtype_update_0" style="width:80px;" class="selectD" value="<?php echo $my_taxtype;  ?>" readonly/></td>
        <td><input type="text" name="includingall_update[]" id="includingall_update_0" style="width:100px;" class="selectD" value="<?=$mj['includingall'];?>" readonly/></td>
        <td><input type="text" name="totalvalue_update[]" id="totalvalue_update_0" style="width:100px;" class="selectD" value="<?=$mj['totalvalue'];?>" readonly/></td>
        <td><input type="text" name="payment_update[]" id="payment_update_0" style="width:80px;" class="selectD" value="<?=$my_payment;?>" readonly/><?php if($mj['payment']==10){ ?><input type="text" name="paymentother_update[]" id="paymentother_update_0" style="width:80px;" class="selectD" value="<?=$mj['paymentother'];?>" readonly/><?php } ?></td>
       <td><input type="text" name="payingauthority_update[]" id="payingauthority_update_0" style="width:100px;" class="selectD" value="<?=$mj['payingauthority'];?>" readonly/></td>
        <td><input type="text" name="inspectionplace_update[]" id="inspectionplace_update_0" style="width:100px;" class="selectD" value="<?=$mj['inspectionplace'];?>" readonly/></td>
        <td><input type="text" name="deliverydate_update[]" id="deliverydate_update_0" style="width:100px;" class="selectD" value="<?=$mj['deliverydate'];?>" readonly/></td>
        <td><input type="text" name="quantitymannual_update[]" id="quantitymannual_update_0" style="width:100px;" class="selectD" value="<?=$mj['quantitymannual'];?>" readonly/></td>
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
<td><select id="consignee0" name="consignee[]" class="empty_consignee selectD" >
<?php if(isset($_GET['val'])) { ?>
<option value=''>Please Select</option>

<?php for($m=0;$m<sizeof($list_consignee_edit);$m++) { ?>
<option value="<?php print_r($list_consignee_edit[$m]['id']) ?>"><?php  print_r($list_consignee_edit[$m]['main_csign_short_name']); ?></option>
<?php } } ?>
</select>
</td>
<td><input type="text" name="quantity[]" id="quantity0" style="width:80px;" class="class_for_only_numeric_values" onKeyUp="[Remove_Braket_To_Work]CalculationBaseOnQuantity(this.id)"/></td>
<td><select name="unit[]" id="unit0" style="width:80px;" class="selectD"/>
<option value='1'>NOS</option>
<option value='2'>Kg</option>
<option value='3'>Mtr</option>
<option value='4'>Pcs</option>
<option value='5'>Pair</option>
<option value='6'>Yard</option>
</select>
</td>
<td><input type="text" name="rate[]" id="rate0" style="width:80px;" class="class_for_only_numeric_values" onKeyUp="[Remove_Braket_To_Work]CalculationBaseOnRate(this.id);"/></td>
<td><select name="taxtype[]" id="taxtype0" style="width:80px;" class="selectD">
<option value="">Please Select</option>
<option value="1">VAT EXTRA</option>
<option value="2">CST EXTRA</option>
<option value="3">VAT INCL</option>
<option value="4">CST INCL</option>
<option value="5">Nil</option>
</select>
</td>
<td><input type="text" name="includingall[]" id="includingall0" style="width:100px;"/></td>
<td><input type="text" name="totalvalue[]" id="totalvalue0" style="width:100px;"/></td>
<td><select name="payment[]" id="payment0" style="width:80px;" class="selectD" onChange="ShowPaymentOther(this.id)"/>
<option value=''>Please Select</option>
<option value='1'>100% against supply</option>
<option value='2'>98% + 2%</option>
<option value='3'>98% + 5%</option>
<option value='4'>90% + 10%</option>
<option value='10'>Other</option>
</select>
<input type="text" id='paymentother0' name="paymentother[]" style="width:80px; display:none" />
</td>
<td><input type="text" name="payingauthority[]" id="payingauthority0" style="width:100px;"/></td>
<td><input type="text" name="inspectionplace[]" id="inspectionplace0" style="width:100px;"/></td>
<td><input type="text" name="deliverydate[]" id="deliverydate0" style="width:100px;" class="Xmeenu"/></td>
<td><input type="text" name="quantitymannual[]" id="quantitymannual0" style="width:100px;"/></td>
</tr>

<tr style="background:#fff;">
<td colspan="2"><!--<input type="button" name="add_more" id="add_more" value="Add More Product" class="add_more" onclick="add_more_products('first_dirct0');"/>-->
<input type="button" name="add_more" id="add_more" value="Add More Product" class="add_more" onClick="add_more_products_in_po_section();"/>
</td>
</tr>
</table>

<div id="Re_tender_attach"></div>
<table  id="attachments" class="attachz">
<caption>Attachments <?php if(isset($_GET['val']) && $result_attachment[0]!='') { ?> <a class="link_edit_director" onClick="window.open('po_current_old_attachements.php?val=<?php print_r($result['id']); ?>&table=po_attachments&field=tender_id','mywindow','width=700,height=300,left=100,top=100,screenX=0,screenY=100')">/Delete old </a><?php } ?></caption>
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
<input type="hidden" id='hidden_box_for_tender_id_of_first_optn' name="hidden_box_for_tender_id_of_first_optn" />
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
  
<div id='sa'></div>
</body>
</html>