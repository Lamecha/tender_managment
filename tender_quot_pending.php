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
//$main_consignee = $obj->List_Drop_Down("consignee","csign_short_name","id");
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
$result_common_pending = $obj->common_fetch_attachement('table_after_pending_status','tender_id',$_GET['id']);
$attachments=$obj->attach_records($_GET['id'],'tender_attachments','tender_id');
$result_attachment = $obj->AttachementsInTenderRate($_GET['id']);
$attachements_after_pending = $obj->common_fetch_attachement('attachements_after_pending_status','tender_id',$_GET['id']);
$result_tender_bid_attachemnsts = $obj->attach_recordsXYZ($_GET['id'],'tender_bid_attachements','tender_id');
/*if($tender_details['firm_status']==1 && $tender_details['status']!=0)
{
	$result_attachment_all = $obj->AttachementsInTenderRateWithoutLimit($_GET['id']);
	
	
}*/


if(isset($_POST['submit']) && $_POST['key']==$_SESSION['key'])
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
			move_uploaded_file($tmp_name,"attachements/attachements_after_pending_status/".$finalName[$i]);
		}
$result_after_padding = $obj->Store_After_Pending_Status($_GET['id'],$_POST['status_after_pending'],$_POST['remark_after_pending'],$finalName,$name,$_SESSION['pin_id'],$_SESSION['pin_table']);
if($result_after_padding==1)
{
	$obj->ALertMessage("Remark Registered",$result_after_padding);
?>
  <script type="text/javascript">
	window.location="tender_quot_pending.php?id=<?php echo $_GET['id']; ?>&val=<?php echo $_GET['val']; ?>";
		</script>
  <?php
}
else
{
	$obj->ALertMessage("Remark Registered",$result_after_padding);
}
  
}
$_SESSION['key']=mt_rand(1,1000);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="main_includes/add_new_row.js"></script>
<link rel="stylesheet" href="main_css/main_css.css"/>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
<title>Pending Tender No. <?php print_r($tender_details['tender_number']); ?> : Rainbow Tender Managment</title>

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
.first_table
{
	width:800px;
	table-layout:fixed;

}
.first_table tr th
{
	height:40px;
	width:250px;
	background:#39F;
	font-size:12px;
	font-family:Arial, Helvetica, sans-serif;
	color:#FFF;
}
.first_table tr td
{
	height:30px;
	padding-left:4px;
	width:247px;
	border:1px solid #333;
	word-wrap:break-word;
	line-height:5px;
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
<span id="title_work_page">Tender No. <?php print_r($tender_details['tender_number']); ?>
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

<!-- TENDER ACTION DIV-->
<div id="left_div" style="float:left; width:500px;height:auto; background:#f6f6f6; border:2px solid #efefef; margin:5px 5px 10px 5px;">
<div id="old_info_span" style="min-height:40px; height:auto; padding-top:5px;">
<span style="margin-left:0px;font-size:23px; margin-top:5px;width:380px;word-wrap:break-word;">
Tender Action Tags
</span>
</div>
<form id="first_form_in_pending" name="first_form_in_pending" method="post" action="#" enctype="multipart/form-data">
<table id="Xinfos" cellspacing="6" class="inlineCss" style="margin-left:10px;margin-top:4px; width:350px; table-layout:fixed;">

<tr>
<?php $opt = '_'.$result_common_pending[0]['after_pending_status'].'_M'; 
$$opt = "Selected='selected'";
?>
<td style="width:110px;">Select Status </td>
<td style="width:240px;word-wrap:break-word;"><select style="width:180px; height:30px; border:1px solid #333;" id="status_after_pending" name="status_after_pending">
<?php if($result_common_pending[0]['after_pending_status']=='') 
{
?>
<option value="">Please Select</option>
<?php } ?>
<option value="1" <?=$_1_M;?>>PO Placed</option>
<option value="2" <?=$_2_M;?>>PO Received</option>
<option value="3" <?=$_3_M;?>>Re Tender</option>
<option value="4" <?=$_4_M;?>>File Claused</option>
</select></td>
</tr>
<tr>
<td>Remark</td>
<td><textarea style="border:1px solid #333;" cols="28" rows="5" name="remark_after_pending"><?php print_r($result_common_pending[0]['after_pending_remark']) ?></textarea></td>
</tr>
</table>
<table  id="attachments" class="attachz">
<caption>Attachments <?php if($attachements_after_pending[0]!='') { ?> <a class="link_edit_director" onClick="window.open('Old_attachements_after_pending.php?val=<?php print_r($_GET['id']); ?>&table=attachements_after_pending_status&field=tender_id','mywindow','width=500,height=300,left=100,top=100,screenX=0,screenY=100')">/Delete old </a><?php } ?></caption>
<tr id="base_id_attachements"><th>File</th></tr>
<?php if(is_array($attachements_after_pending)) { ?>
<?php foreach($attachements_after_pending as $mla) { ?>

<tr>
<td style="border:1px solid #696969; height:25px; font-size:13px;"><a href="attachements/attachements_after_pending_status/<?=$mla['file_real_name'];?>" target="_blank"><?=$mla['file'];?></a></td>
</tr>
<?php } } ?>
<tr id="SHAKEB_0">
<td><input type="file" name="files[]"/></td>
<td id="SHAKEB_COLM_0"><input type="hidden" id="text_on_others" name="text_on_others[]" /></td>
</tr>
<tr style="background:none;"><td><input type="button" name="add_more" id="add_more" value="Add More" class="add_more" onClick="Add_More_After_Pending_Status();"/></td></tr>
<input type="hidden" name="hide_for_add_firms" id="hide_for_add_firm" value="1" />
</table>
<hr class="hrules" noshade="noshade" color="#dcdcdc"/>
<div id="newtables">
</div>
<table><tr><td><input type="submit" name="submit" id="main_submit" value="Save"/></td></tr></table>
<input type="hidden" name="key" id="key" value="<?php echo $_SESSION['key']; ?>" />
<input type="hidden" id="counter" name="counter" value=1 />
</form>

</div>
<!---------------------->





<!---------------------Below div with clear both to takeing float------>
<div id="below_div" style="clear:both;width:400px;height:auto;  position:absolute; top:270px; background:#f6f6f6; border:2px solid #efefef; margin:25px 5px 10px 5px; min-height:200px;">
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