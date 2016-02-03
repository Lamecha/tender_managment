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
//$main_consignee = $obj->List_Consignee_on_Purchaser($tender_details['tender_purchaser']);
$main_consignee = $obj->List_Drop_Down("consignee","csign_short_name","id");
$tender_status=$obj->Tender_status($tender_details['status']);
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
$attachments=$obj->attach_records($_GET['id'],'tender_attachments','tender_id');
$result_attachment = $obj->AttachementsInTenderRate($_GET['id']);
//$result_tender_bid_attachemnsts = $obj->common_fetch_attachement('tender_bid_attachements','tender_id',$_GET['id']);
$result_tender_bid_attachemnsts = $obj->attach_recordsXYZ($_GET['id'],'tender_bid_attachements','tender_id');
if($tender_details['firm_status']==1 && $tender_details['status']!=0)
{
	$result_attachment_all = $obj->AttachementsInTenderRateWithoutLimit($_GET['id']);
	
	
}


if(isset($_POST['submit_uploaded']) && $_POST['key']==$_SESSION['key'])
{
	
	 	$finalName = array();
		$name = array();
		for($i=0;$i<sizeof($_FILES['files']);$i++)
		{
			$name[$i] = $_FILES['files']['name'][$i];
			$tmp_name = $_FILES['files']['tmp_name'][$i];
			$ext = $obj->getExtension($name[$i]);
			$newName = $obj->nameGen();
			$finalName[$i]  = $newName.".".$ext;
			move_uploaded_file($tmp_name,"attachements/Rate_On_Print/".$finalName[$i]);
		}
$result2 = $obj->store_printed_firms_X($_GET['id'],'tender_rate_attachements',$finalName,$name,$_SESSION['pin_id'],$_SESSION['pin_table']);
  ?>
  <script type="text/javascript">
	window.location="tender_quot_new.php?id=<?php echo $_GET['id']; ?>&val=<?php echo $_GET['val']; ?>";
		</script>
  <?php
  
 }
 
 if(isset($_POST['Status_Submit']))
 {
	 $changed_status_result = $obj->ChangeCommonStatus($_GET['id'],$_POST['status_button'],'tender');
	 if($changed_status_result==1)
	 {
		 if($_POST['status_button']==0)
		 {
			 $message = "Status changed to Uploaded";
		 }
		 else
		 {
			 $message = "Status changed to Rate Given";
		 }
		 $obj->ALertMessage($message,$changed_status_result);
		 $obj->redirect('tender_list.php');
	 }
	 
 }
?>
<?php
if(isset($_POST['save_firm_printed_rate_submit']) && $_POST['key45']==$_SESSION['key45'])
{
	$result_bid_in_printed = $obj->BidNumberPrintedForm($_GET['id'],$_POST['select_firms'],$_POST['text_box_bid_number'],$_SESSION['pin_id'],$_SESSION['pin_table']);
	
	$obj->redirect("tender_quot_new.php?id=".$_GET['id']."&val=".$_GET['val']);
	
}

if(isset($_POST['submit_mannual_firms']) && $_POST['key12']==$_SESSION['key12'])
{
	//$result_bid_in_mannual = $obj->GiveBidNumberInMannualFirms($_POST['bid_number_printed_firm'],$_POST['Id_firm_in_mannual_bid'],$_SESSION['pin_id'],$_SESSION['pin_table'],$_GET['id']);
	$result_bid_in_mannual = $obj->GiveBidNumberInMannualFirms($_POST['bid_number_printed_firm'],$_POST['Id_firm_in_mannual_bid'],$_SESSION['pin_id'],$_SESSION['pin_table'],$_GET['id'],$_POST['Firms_For_Adding_In_Mannual_Bid'],$_POST['Bid_Number_For_Flag1_Firms'],$_POST['Product_Id_For_Flag1_Firms']);
	$obj->redirect("tender_quot_new.php?id=".$_GET['id']."&val=".$_GET['val']);
}
?>
<?php
if(isset($_POST['Submit_Tender_Bid_Attachemnets']) && $_POST['key178']==$_SESSION['key178'])
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
			move_uploaded_file($tmp_name,"attachements/tender_bid_attach/".$finalName[$i]);
		}
		$tender_bid_attachemnsts = $obj->tender_bid_attachements_save($_POST,$finalName,$name,$_GET['id']);
		if($tender_bid_attachemnsts)
		{
			$obj->redirect("tender_quot_new.php?id=".$_GET['id']."&val=".$_GET['val']);
		}
}
	
?>

<?php
$_SESSION['key']=mt_rand(1,1000);
$_SESSION['key45']=mt_rand(1,1000);
$_SESSION['key12']=mt_rand(1,1000);
$_SESSION['key178']=mt_rand(1,1000);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="main_includes/add_new_row.js"></script>
<link rel="stylesheet" href="main_css/main_css.css"/>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
<title>Products in Tender No. <?php print_r($tender_details['tender_number']); ?> : Rainbow Tender Managment</title>

<link rel="stylesheet" type="text/css" media="screen" href="main_css/jquery.ui.potato.menu.css" />
<link href="css/styles.css" rel="stylesheet" media="screen"  />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>


<script type="text/javascript" src="main_js/menu_bar/jquery.ui.potato.menu.js"></script>
<script type="text/javascript" src="NOTUSED/js/jquery.session.js"></script>

<script type="text/javascript">

	$(document).ready(function()
	{
		$('table#multipels td a.delete').click(function()
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
					
					   success: function(data)
					   {
						  
							 if(data=="yes")
							   {
								
						  
							parent.fadeOut('slow', function() {$(this).remove();});
							   }
							   else
							   {
								   alert('Can not delete this record');
							   }
						}
						
				 });				
			}
		});
		
		
		// style the table with alternate colors
		// sets specified color for every odd row
		//$('table#multipels tr:odd').css('background',' #FFFFFF');
	});
	
</script>
<script type="text/javascript">
//var $Df=jQuery.noConflict();
(function($) {
    $(document).ready(function(){
        $('#menu1').ptMenu();
    });
})(jQuery);
</script>
<style>
.inlineCss tr td
{
	/*font-family: 'ColaborateLightRegular';*/
	font-family:Verdana, Geneva, sans-serif;
	text-shadow:none;
	letter-spacing:0px;
	font-size:15px;
	font-weight:normal;
	
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
<script  type="text/javascript" language="javascript">
//REMOVING POP UP ELEMENT FOR FIRM PRINTING/////////
/*
$(document).ready(function(){
	//$(".QTPopup").css('display','none')
	$(".lnchPopop").click(function(){
		var tj = $(this).attr('id');
		$.session.set("myVar", tj);

		$(".QTPopup").animate({width: 'show'}, 'slow');})
		$(".closeBtn").click(function(){			
			$(".QTPopup").css('display', 'none');
		})
})
*/
</script>
<script type="text/javascript">
/////////////REMOVIN FIRMS SELECTION POP UP FOR PRRINTING/////
/*
function Shakeb()
{
	no_firms = document.getElementById('no_of_firm').value; 
	no_firms = no_firms.trim();
	if(no_firms=='' || isNaN(no_firms))
	{
		alert('Please provide of no. of firms');
		return false;
		
	}
	else if(no_firms>30)
	{
		alert('You can not print more than 30 firms at a time');
		return false;
	}
	else
	{
	var p=($.session.get("myVar"));
	window.open('print_firm.php?id=<?php //echo $_GET['id']; ?>&val=<?php //echo $_GET['val'] ?>&p='+p+'&firm='+no_firms,'_blank');
	$(".QTPopup").css('display', 'none');
	}
	
}
*/
</script>
<script>
function getFirms(name)
{
	var firm_select = document.createElement('select');
	firm_select.setAttribute("id","title");
	firm_select.setAttribute("name",name);
	firm_select.setAttribute("style","width:132px; height:30px; border:1px solid #333;");
	var firm_option = FirmOptions()
    firm_select.innerHTML=firm_option;
	return firm_select;
	
}
function FirmOptions()
{
	var fData = "<option value=''>Please select</option>";
	<?php
	for($ix=0;$ix<sizeof($main_consignee);$ix++)
	{
		$FirmData.= "<option value='".$main_consignee[$ix]['id']."'>".$main_consignee[$ix]['csign_short_name']."</option>"; 
	}?>fData +=<? echo '"'.$FirmData.'";';?>
	return fData;
}
</script>

</head>


<body>

<input type="hidden" id="hide_for_status" value="<?php print_r($tender_details['status']);?>" />
<input type="hidden" id="hide_for_status_firm" value="<?php print_r($tender_details['firm_status']);?>" />
<?php include_once("main_includes/msg_box.php"); ?>
<div id="index-header">
<?php include_once("main_includes/main_header.php");?> 
<?php //include_once("main_includes/main_validation.php");?> 

</div>
<div id="index-navigation">
<?php 
$meenubar = $_SESSION['rb_power']."_menu.php";
include_once("main_includes/".$meenubar); ?> 
</div>
<div id="index-main">
<span id="title_work_page">Products in Tender No. <?php print_r($tender_details['tender_number']); ?>
</span>
<div id="working-sub-main">
<div id="working-panel" style="width:1276px;">
<!-------OLD INFO TENDER---------->

<div id="left_div" style="float:left; width:400px;height:auto; background:#f6f6f6; border:2px solid #efefef; margin:5px 5px 10px 5px;">
<div id="old_info_span" style="min-height:40px; height:auto; padding-top:5px;">
<span style="margin-left:0px;font-size:23px; margin-top:5px;width:380px;word-wrap:break-word;">
Tender No: <?php print_r($tender_details['tender_number']); ?>
</span>
</div>
<table id="Xinfos" cellspacing="6" class="inlineCss" style="margin-left:10px;margin-top:4px; width:350px; table-layout:fixed;">

<tr>
<td style="width:110px;">Tender Type : </td>
<td style="width:240px;word-wrap:break-word;"> <?php echo $status;  ?></td>
</tr>
<tr>
<td style="width:110px;">Purchaser : </td>
<td style="width:240px;word-wrap:break-word;"> <a href="#?id=<?php print_r($purchaser_detail['id']); ?>"><?php print_r($purchaser_detail['purchaser_short_name']); ?></a></td>
</tr>
<tr>
<td style="width:110px;">Due Date : </td>
<?php 
$new_date=$obj->Date_Format($tender_details['tender_due_date']);
?>
<td style="width:240px;word-wrap:break-word;"> <?php echo $new_date;?>/<?php print_r($tender_details['tender_time']); ?></td>
</tr>
<tr>
<td style="width:110px;">TDC : </td>
<td style="width:240px;word-wrap:break-word;"> <?php print_r($tender_details['tender_tdc']); ?></td>
</tr>
<tr>
<td style="width:110px;">EMD : </td>
<td style="width:240px;word-wrap:break-word;"> <?php print_r($tender_details['tender_emd']); ?></td>
</tr>
<tr>
<td style="width:110px;">Sample Required : </td>
<td style="width:240px;word-wrap:break-word;"><?php if($tender_details['tender_sample']==0) echo 'Yes'; else echo 'No'; ?></td>
</tr>
<tr>
<td style="width:110px;">Criteria : </td>
<td style="width:240px;word-wrap:break-word;"> <?php print_r($tender_details['tender_criteria']); ?></td>
</tr>
<?php if($tender_details['status']!=0) { ?>
<tr><td colspan="2"><a target="_blank" href="tabulation_stmt.php?id=<?=$_GET['id'];?>">Print tabulation</a></td></tr>
<?php } ?>
</table>
</div>

<!--------------------------------->
<!---------------Availabel Products------------------->
<div id="center_div" style="float:left; width:500px;height:auto;">
<div style="float:left; width:500px;height:auto; background:#f6f6f6; border:2px solid #efefef; margin:5px 5px 10px 3px;">
<div id="old_info_span" style=" min-height:40px; height:auto; padding-top:5px;">
<span style="margin-left:0px;font-size:23px; margin-top:5px;width:380px;word-wrap:break-word;">
Availabel Products
<?php if($tender_details['status']==0 || $tender_details['status']==1) { ?>
<input type="radio" id="radio_for_mannual" name="firm_status_radio" class="firm_status_radio_class hide_on_quoted_partiallyquoted" value="0" style="margin-left:10px;" <?php if($tender_details['firm_status']==0) { echo "checked='checked'" ;} ?>  />
<?php } ?>
</span>
</div>
<form id="form_for_mannual_firms" name="form_for_mannual_firms" method="post" action="#">
<table id="multipels" class="inlineCss mannual_table" cellspacing="3" style="margin-left:5px;margin-top:4px; width:400px; table-layout:fixed;">
<?php $total_firm_counter_under_product=0; ?>
<?php foreach($product_details as $mk)
{
?>
 <tr style="height:30px;" id="row_without_firms_<?=$mk['id'];?>">
 <td style="width:280px; word-wrap:break-word;">
 <?=$mk['item_discription']; ?><font style="font-size:10px; color:#000099;">
 [Consignee : <?=$mk['main_csign_short_name']?>]</font>
 <br/>
 <font style="font-size:10px; color:#000099;">[Quantity : <?=$mk['quantity']; ?> <font style="color:#000000;"><?=$u=$obj->unit($mk['unit'])?>]</font>
</td>
  <td colspan="2" style="width:70px;">
 <?php if($tender_details['firm_status']==0 && $tender_details['status']==0)  {
  ?>
 <a style="font-size:12px; margin-left:10px;" href="rate_tender.php?id=<?php echo $_GET['id']; ?>&p=<?=$mk['id'];?>&val=<?php echo $_GET['val']; ?>">Give Rate</a>
 <?php
  }
  else
  {
	  echo '&nbsp;';
  }
?>
</td>
<td style="width:70px;">&nbsp;

</td>
 </tr>
 <?php if($tender_details['firm_status']==0) 
	{
		?> 
 		<?php
		$firms=$obj->firms_in_products($mk['id']);
		
		$lamp=0;
		foreach($firms as $tnb)
		{
			$lamp++;
			$total_firm_counter_under_product++;
			if($tnb['flag']==0)
			{
			$background_color=$_GET['val'];	
			}
			else
			{
				$background_color='FF99FF';
			}
			?>
            
      	<tr id="row_under_products_<?=$mk['id'];?>_<?=$lamp;?>">
      	<td style="background:#<?php echo $background_color; ?>;height:30px; width:280px; word-wrap:break-word;">&nbsp;&nbsp;&nbsp;&nbsp;<?=$tnb['csign_short_name'];?></td>
        <?php if($tender_details['status']==0) 
		{
		?>
       <td style="background:#<?php echo $_GET['val']; ?>;height:30px; text-align:center; width:45px;">
        <a href="#" id="<?=$tnb['id'];?>" class="delete"><img src="main_images/delete.png" /></a>
        </td>
      <td style="background:#<?php echo $_GET['val']; ?>;height:30px; text-align:center; width:45px;">
       <a href="rate_tender.php?id=<?php echo $_GET['id']; ?>&p=<?=$mk['id'];?>&val=<?php echo $_GET['val']; ?>&spl=<?=$tnb['id'];?>"><img src="main_images/edit.png" /></a>
        <?php
		$firms_in_last_product++;
		}
		?>
        </td>
        <?php if($tender_details['status']!=0 && $tender_details['firm_status']!=1) 
		{
		?>
       <td colspan="2" style="background:#<?php //echo $_GET['val']; ?>;height:30px; text-align:center; width:90px;">
       <input type="text" id="bid_number_printed_firm" name="bid_number_printed_firm[]" placeholder="Bid Number" <?php if($tnb['bid_number']!='0'){ ?> value="<?=$tnb['bid_number'];?>" <?php  } ?> />
       <input type="hidden" name="Id_firm_in_mannual_bid[]" value="<?=$tnb['id'];?>" />
      
     <?php
		}
		?>
     </td>
        
        </tr>
        
		<?php
		
	}
	?>
    <?php if($tender_details['status']!=0){ ?>
    <tr style="background:none;"><td>&nbsp;</td><td><input type="button" name="add_more" id="add_more" value="Add More Firms" class="add_more" onClick="Add_More_Firms_In_Bid_Number_Manuual_New(<?=$mk['id'];?>,<?=$lamp;?>)"/>
   <input type="hidden" id="hidden_for_manuual_bid_firms_hh_<?=$mk['id'];?>" value="<?=$lamp;?>" /> 
   <?php } ?>
    </td></tr>
    
    <?php
}
   else
   {
	   ?>
       <tr>
       <td colspan="4" style="background:#<?php echo $_GET['val']; ?>;height:30px; width:280px;word-wrap:break-word; font-size:14px; padding-left:10px;">Rate is available in Printed Form only</td>
       
       <?php
	   
   }
   ?>
<?php	
}
?>
<?php //if($tender_details['status']!=0 && $tender_details['firm_status']!=1 && $total_firm_counter_under_product>0)
if($tender_details['status']!=0 && $tender_details['firm_status']!=1) 
{
	
 ?>
<tr>
<td>&nbsp;</td>
<td>
<input type="hidden" name="key12" value="<?php echo $_SESSION['key12']; ?>" />
<input type="submit" id="submit_mannual_firms" name="submit_mannual_firms" value="Save" style="height:30px; width:80px; background:#1A2622; border:1px solid #333; color:#fff;" />
</td></tr>
<?php } ?>
</table>
</form>

</div>


<div id="below_main_container" style="float:left; background:#f6f6f6; border:2px solid #efefef; margin:5px 5px 10px 3px;">

<?php if($tender_details['status']!=0) 
{
?>
<div id="center_div" style="float:left; width:500px;height:auto">
<div id="old_info_span" style=" min-height:40px; height:auto; padding-top:5px;">
<span style="margin-left:0px;font-size:23px; margin-top:5px;width:380px;word-wrap:break-word;">
Heading to Ask Bhaiya
</span></div>
<form id="tender_bid_attachemnst_form" method="post" action="#" enctype="multipart/form-data">
<table id="Xinfos" class="inlineCss" style="margin-left:10px;margin-top:2px;  table-layout:fixed;">
<tr>
<td>Compsition rate</td>
<td>&nbsp;<textarea rows="4" style="width:340px; border:1px solid #333;" name="tender_composition_rate"><?php print_r($tender_details['tender_composition_rate']); ?></textarea></td>
</tr>
</table>
<table  id="attachments" class="attachz">
<caption>Attachments <?php if($result_tender_bid_attachemnsts[0]!='') { ?> <a class="link_edit_director" onClick="window.open('Tender_bid_old_attachemnents.php?val=<?php echo $_GET['id']; ?>&table=tender_bid_attachements&field=tender_id','mywindow','width=500,height=300,left=100,top=100,screenX=0,screenY=100')">/Delete old </a><?php } ?></caption>
<tr id="base_id_attachements"><th>Title</th><th>File</th></tr>
<?php //if(isset($_GET['val']) && $_GET['val']!='') { ?>
<?php //foreach($result_tender_bid_attachemnsts as $FFF) { ?>
<?php
//$title_value = $obj->Title_In_Tender_Bid_Attachements($FFF['title']);
?>
<!--
<tr>
<td style="border:1px solid #696969; height:25px; font-size:13px;">
<?php //if($FFF['title']==10) 
//{
	//print_r($FFF['other_title']);
//}
//else
//{
	//echo $title_value;
//}
?>
</td>
<td style="border:1px solid #696969; height:25px; font-size:13px;"><?//=$FFF['file_real_name'];?></td>
</tr>
<?php //} } ?>
-->
<tr id="SHAKEB_0">
<td>
<select name="titles[]" id="title_0" style="width:120px; height:30px; border:1px solid #333;" onChange="IfSelectOtherThenTitle(this.id);">
<option value="">Please Select</option>
<option value="1">Finantial Tabulation</option>
<option value="2">Technical Tabulation</option>
<option value="3">Mannual Tabulation</option>
<option value="10">Others</option>
</select>
</td>
<td><input type="file" name="files[]" accept="application/pdf"/></td>
<td id="SHAKEB_COLM_0"><input type="hidden" id="text_on_others" name="text_on_others[]" /></td>
</tr>

<tr style="background:#fff;"><td>&nbsp;</td><td><input type="button" name="add_more" id="add_more" value="Add More" class="add_more" onClick="Add_More_Tender_Bid_Attachements();"/></td></tr>
<input type="hidden" name="hide_for_add_firms" id="hide_for_add_firm" value="1" />
</table>
<table><tr>
<td>&nbsp;</td>
<td><input type="submit" name="Submit_Tender_Bid_Attachemnets" id="Submit_Tender_Bid_Attachemnets" value="Save" style="background:#1A2622; border:1px solid #333; height:30px; width:80px; color:#fff;"/></td></tr></table>
<input type="hidden" name="key178" id="key" value="<?php echo $_SESSION['key178']; ?>" />
</form>
</div>
<?php 
}
?>
</div>


</div>
<!------------------------------->

<div id="right_div" style="float:left; margin-left:10px; width:350px;height:auto">
<?php //if($tender_details['firm_status']==1 && $tender_details['status']==0)
//{
?>
<div id="old_info_span" style=" min-height:40px; height:auto; padding:8px; background:#f6f6f6; border:2px solid #efefef; margin:5px 5px 10px 5px;">
<span style="margin-left:0px;font-size:23px; margin-top:5px;width:380px;word-wrap:break-word;">
Switches
</span>
<form id="status_form" name="status_form" method="post" action="#">
<table class="status_table">
<tr>
<td colspan="2" style="width:190px; height:30px;border:1px solid #030; padding-left:10px;" >Current status is <?php echo $tender_status; ?></td>
</tr>
<tr>
<th style="width:100px; height:30px; background:#99CEF3; color:#FFFFFF; border:1px solid #030; ">Uploaded</th>
<th style="width:100px; height:30px; background:#99CEF3; color:#FFF; border:1px solid #030; ">Rate Given</th>
</tr>
<tr>
<td style="width:50px; height:30px;border:1px solid #030; padding-left:50px; "><input type="radio" id="uploade_button" name="status_button" <?php if($tender_details['status']==0) { echo "checked='checked'" ;} ?> value="0" class="hide_on_quoted_partiallyquoted" /></td>
<td style="width:50px; height:30px;border:1px solid #030; padding-left:50px; "><input type="radio" id="rate_button" name="status_button" <?php if($tender_details['status']==1) { echo "checked='checked'" ;} ?> value="1" class="hide_on_quoted_partiallyquoted"  /></td>
</tr>
<tr>
<td colspan="2" style="width:200px; height:30px;border:1px solid #030; padding-left:50px; " >
<?php if($tender_details['status']==0 || $tender_details['status']==1){ ?>
<input type="submit" value="Save" name="Status_Submit" style="height:26px; width:50px; border:1px solid #333; background:#1A2622; margin-left:50px; color:#fff;" class="hide_on_quoted_partiallyquoted" />
<?php } ?>
</td>
</tr>
</table>
</form>
</div>
<div style="background:#f6f6f6; border:2px solid #efefef; margin:5px 5px 10px 5px;">
<div id="old_info_span" style=" min-height:40px; height:auto; padding-top:5px;">
<span style="margin-left:0px;font-size:23px; margin-top:5px;width:320px;word-wrap:break-word;">
Upload Printed
<?php if($tender_details['status']==0 || $tender_details['status']==1) { ?>
<input type="radio" id="radio_for_printed" name="firm_status_radio" class="firm_status_radio_class hide_on_quoted_partiallyquoted" value="1" style="margin-left:10px;" <?php if($tender_details['firm_status']==1) { echo "checked='checked'" ;} ?>   />
<?php } ?>
</span>
</div>
<!-----HERE COMES SWITCH--->

<div id="div_for_printed_rate">


<!----------------------------------------------------->
<form id="uploaded_form" enctype="multipart/form-data" method="post" action="#">
<table  id="attachments" class="attachz printed_table">
<caption style="font-size:18px;"><?php if(isset($_GET['val']) && $result_attachment[0]!='') { ?><a class="link_edit_director" onClick="window.open('record_printed_tender_rate.php?val=<?php print_r($_GET['id']); ?>&table=tender_rate_attachements&field=tender_id 	','mywindow','width=400,height=300,left=100,top=100,screenX=0,screenY=100')"><?php if($tender_details['firm_status']==1 && $tender_details['status']==0) 
{
?>Delete old </a><?php } } ?></caption>
<?php if(count($result_attachment))if(isset($_GET['val']) && $_GET['val']!='') { ?>
<tr>
<!--
<th style="width:110px;">Firm</th>
-->
<th style="width:250px;">File</th>
</tr>

<?php foreach($result_attachment as $mla) { ?>
<tr>
<!--
<td style="border:1px solid #696969; height:25px; font-size:13px; width:110px;"><?//=$mla['csign_short_name'];?></td>-->
<td style="border:1px solid #696969; height:25px; font-size:13px; width:110px;"><a href="attachements/Rate_On_Print/<?=$mla['file'];?>" class="anchor_of_printed" target="_blank" title="<?=$mla['file_real_name'];?>"><?=substr($mla['file_real_name'],0,40);?></a></td>
</tr>
<?php } } ?>
<tr id="first_c">
<!--
<td style="width:110px;"><select name="titles[]" style="width:110px;">
<option value="">Please select</option>
<?php //foreach($main_consignee as $mcp) 
//{
	?>
    <option value="<?//=$mcp['id'];?>"><?//=$mcp['csign_short_name'];?></option>
    <?php
//}
?>
</select>
</td>
-->
<?php if($tender_details['firm_status']==1 && $tender_details['status']==0) 
{
?>
<td style="width:110px;"><input type="file" name="files[]"/></td>
</tr>
<tr style="background:#fff;"><td><input type="button" name="add_more" id="add_more" value="Add More" class="add_more" onClick="add_mores_main_consignee_on_purchaser('first_c');"/></td></tr>
<?php
}
?>
</table>
<div id="newtables">
</div>
<input type="hidden" name="key" id="key" value="<?php echo $_SESSION['key']; ?>" />
<?php if($tender_details['firm_status']==1 && $tender_details['status']==0) 
{
?>
<table><tr><td><input type="submit" name="submit_uploaded" id="submit_uploaded" value="Upload Files" style="background:#1A2622; color:#fff;"/></td></tr></table>
<?php
}
?>
</form>
</div>
<?php
//}
//else
//{
if($tender_details['firm_status']==1 && $tender_details['status']!=0)
	{
?>
<div id="old_info_span" style=" min-height:40px; height:auto; padding-top:5px;">
<span style="margin-left:0px;font-size:23px; margin-top:5px;width:380px;word-wrap:break-word;">Give Bid refrence Number</span>
</div>
<!-----HERE COMES SWITCH--->
<div id="current_status"></div>
<div id="div_for_printed_rate">
<form id="printed_bid_number" name="printed_bid_number" method="post" action="#">
<table  id="attachments" class="attachz">
<tr>
<th style="width:120px;">Firm Name</th>
<th style="width:140px;">Give Bid Number</th>
</tr>
<?php
$sd=0;
foreach($result_attachment_all as $KMC)
{
	
	?>
    
    <tr id="Remove_firm_printed_row_<?=$KMC['id'];?>">
    <td><select style="width:132px; height:30px; border:1px solid #333;" id="select_add_moe_firm_0" name="select_firms[]">
    <?php $select_firm_p = $KMC['firm_id']."_FPID"; 
	
	$$select_firm_p="Selected='selected'";
	?>
    <?php foreach($main_consignee as $zS)  
{
	?>
    <option value=<?=$zS['id'];?> <?=${$zS['id']."_FPID"}?>><?=$zS['csign_short_name'];?></option>
    <?php
	
	
}
?>

    </select>
    </td>
    <td><input type="text" id="bid_number_printed_0" style="width:135px; height:30px; border:1px solid #333;" name="text_box_bid_number[]" placeholder="Bid Number" value="<?=$KMC['bid_number'];?>" /></td>
    <td><img id='<?=$KMC['id'];?>' src="main_images/delete.png" onClick="DeleteThisPrintedFirmRow(this.id,<?=$_GET['id'];?>,'<?=$_GET['val'];?>');" /></td>
    </tr>
    <?php
	$sd++;
	
}
?>
<tr id="tr_addmorefirms_0">
<td>
<select style="width:132px; height:30px; border:1px solid #333;" id="select_add_moe_firm_0" name="select_firms[]">
<option value="">Please Select</option>
<?php foreach($main_consignee as $XCZ)  
{
	?><option value=<?=$XCZ['id'];?>><?=$XCZ['csign_short_name'];?></option>
    <?php
}
?>
</select>
</td>
<td>
<input type="text" id="bid_number_printed_0" style="width:135px; height:30px; border:1px solid #333;" name="text_box_bid_number[]" placeholder="Bid Number" />
</td>
</tr>
<tr>
<td><input type="submit" id="save_firm_printed_rate_submit" name="save_firm_printed_rate_submit" value="Save" style="height:30px; width:60px; background:#1A2622; border:1px solid #333; color:#fff;" /></td><td>&nbsp;</td>
</tr>
<tr style="background:#fff;"><td><input type="button" name="add_more" id="add_more" value="Add More" class="add_more" onClick="Add_More_Firm_RateGiven_Printed();"/></td></tr>
<input type="hidden" id="hide_for_add_more_firm_rategiven_printed" value="1" />
<input type="hidden" value="<?php echo $_SESSION['key45'] ?>" name="key45" />
</table>
</form>
</div>

<?php
	}
//}
?>
</div>
</div>

<!----------------------------------------------------->
<!---------------------Below div with clear both to takeing float------>
<div id="below_div" style="float:left; width:400px;height:auto;  position:absolute; top:270px; background:#f6f6f6; border:2px solid #efefef; margin:25px 5px 10px 5px; min-height:200px;">
<div id="old_info_span" style=" min-height:40px; height:auto; padding-top:5px; ">
<span style="margin-left:0px;font-size:23px; margin-top:5px;width:380px;word-wrap:break-word;">
Download files/Attachements
</span>
</div>
<table width="270" id="Xinfos" class="inlineCss" cellspacing="3" style="margin-left:10px;margin-top:4px; width:350px; table-layout:fixed;">
<?php
$sm=0;
foreach($attachments as $nj)
{
	$title_value = $obj->Title_In_Tender_Attachements($nj['title']);
	$sm++;
	?>
   <tr><td style="width:30px;">[<?php echo $sm; ?>]</td><td style="width:320px; word-wrap:break-word; font-size:10px;"><a href="attachements/tender_attach/<?=$nj['file'];?>" target="_new"><?=$title_value;?>/<?=$nj['other_title'];?> [<?=$nj['file_real_name'];?>]</a></td></tr>
    <?php
	$kiyu=$sm;
	
}
?>
<?php if(isset($_GET['val']) && $_GET['val']!='') { ?>
<?php foreach($result_tender_bid_attachemnsts as $FFF) { 
$kiyu++;
$title_value_BIDI = $obj->Title_In_Tender_Bid_Attachements($FFF['title']);
?>
<tr><td style="width:30px;">[<?php echo $kiyu; ?>]</td><td style="width:320px; word-wrap:break-word; font-size:10px;"><a style="color:#000066;" href="attachements/tender_bid_attach/<?=$FFF['file'];?>" target="_new"><?=$title_value_BIDI;?>/<?=$FFF['other_title'];?> [<?=$FFF['file_real_name'];?>]</a></td></tr>
<?php
}
}
?>
</table>
</div>

</div>
</div>
</div>
<div id="index-footer">
<?php  include_once("main_includes/footer.php"); ?>
</div>
<script>
  var hide_status = $('#hide_for_status').val();
  var hide_status2 = parseInt(hide_status);
  if(hide_status2==0)
  {
	  $(".status_div").text('Status:Uploaded');
  }
  if(hide_status2==1)
  {
	  $(".status_div").text('Status:Rate Given');
  }
   if(hide_status2==2)
  {
	  $(".status_div").text('Status:Partially Quoted');
  }
   if(hide_status2==3)
  {
	  $(".status_div").text('Status:Quoted');
  }
  
	 
</script>
<script>
$(".firm_status_radio_class").change(function(){
	var mp = $(this).val();
		$.ajax({
    	url:'common_on.php',
		type:'get',
		data:'id='+<?=$_GET['id'];?>+'&status='+mp,
		success : function(response){
			if(response==1)
			{
				if(mp==0)
				{
					alert('Firms status is going to change in Mannual');
				}
				else
				{
					alert('Firms status is going to change in Printed');
				}
				
		window.location="tender_quot_new.php?id=<?php echo $_GET['id']; ?>&val=<?php echo $_GET['val']; ?>";
			
		}
			else
			{
				alert('There is some error');
			}
		},
		error: function() {  
        alert('Some tecnical error');
    	}
	});
	
	
});
</script>
<script>
$(document).ready(function(e) {
    var tm = $('#hide_for_status_firm').val();
	var status_tender = $('#hide_for_status').val();
	
	if(tm==0)
	{
		$(".printed_table").css({ opacity: 0.5 });
		$(".anchor_of_printed").attr("href","#");
	
	}
	else
	{
		
		$(".mannual_table").css({ opacity: 0.5 });
	}
	/*if(status_tender!=0 && status_tender!=1)
	{
		$(".status_table").css({ opacity: 0.5 });
		//$(".hide_on_quoted_partiallyquoted").css("display","none");
		
	}*/
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

</body>
</html>