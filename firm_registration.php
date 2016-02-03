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
	$result = $obj->common_fetchdata('consignee',$_GET['val']);
	$result_director = $obj->common_fetch_attachement('consignee_director','csign_id',$_GET['val']);
	$result_attachment = $obj->common_fetch_attachement('csign_attachments','csign_id',$_GET['val']);
	
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
		move_uploaded_file($tmp_name,"attachements/csign_attach/".$finalName[$i]);
	}
	
		if(isset($_GET['val']) & $_GET['val']!="")
		{
			$update_result = $obj->consignee_update($_POST,$finalName,$name,$result['id'],$_SESSION['pin_id'],$_SESSION['pin_table']);
			$obj->ALertMessage("Firm updated successfully",$update_result);
			$obj->redirect("firm_update.php");
			
		}
		else
		{
		$consignee = $obj->consignee_registration($_POST,$finalName,$name,$_SESSION['pin_id'],$_SESSION['pin_table']);
		$obj->ALertMessage("Firm registered",$consignee);
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
<title><?php if($_GET['val']!=""){ echo "Update "; } else { echo "Add "; } ?> Firm : Rainbow Tender Managment</title>


    <link rel="stylesheet" type="text/css" media="screen" href="main_css/jquery.ui.potato.menu.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="main_js/menu_bar/jquery.ui.potato.menu.js"></script>
<script type="text/javascript">
(function($) {
    $(document).ready(function(){
        $('#menu1').ptMenu();
    });
})(jQuery);
</script>
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
<script>
window.onload = function() {
  document.getElementById("<?php echo $_GET['val'] ?>").focus();
  document.getElementById("csign_firm_name").focus();
};
</script>	
<?php
}
?>
<?php include_once("main_includes/date_picker.php");?> 

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
<span id="title_work_page"><?php if($_GET['val']!="") echo "Update "; ?>Firm Registration</span>
<div id="working-sub-main">
<div id="working-panel">

<form method="post" enctype="multipart/form-data" id="formID">
<table id="working-form">

<tr><td><label for="category_id">Firm Name<font class="star">*</font></label></td>
<td><input type="text" name="csign_firm_name" id="csign_firm_name" class="validate[required] Xtext-input" value="<?php print_r($result['csign_firm_name']); ?>" style="text-transform:capitalize;" /></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td><label for="category_id">Short Name<font class="star">*</font></label></td>
<td><input type="text" name="csign_short_name" id="<?php if(isset($_GET['val']) && $_GET['val']!="") { echo $_GET['val'] ; } else
{ echo "csign_short_name"; } ?>"  class="validate[required,ajax[ajaxCsignCallPhp]] Xtext-input" value="<?php print_r($result['csign_short_name']); ?>" style="text-transform:uppercase;"/></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td><label for="category_id">Address Firm<font class="star">*</font></label></td>
<td><textarea name="csign_address" id="csign_address" class="validate[required] Xtext-input" ><?php print_r($result['csign_address']); ?></textarea></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td><label for="category_id">Pin Code<font class="star">*</font></label></td>
<td><input type="text" name="csign_pin_code" id="csign_pin_code" class="validate[required] custom[pin_number] Xtext-input" value="<?php print_r($result['csign_pin_code']); ?>" /></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td><label for="category_id">Email<font class="star">*</font></label></td>
<td><input type="text" name="csign_email" id="csign_email" class="validate[required,custom[email]] Xtext-input" value="<?php print_r($result['csign_email']); ?>"/></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td><label for="category_id">Contact No.</label></td>
<td><input type="text" name="csign_tel_number" id="csign_tel_number"  class="Xvalidate[Xrequired,Xcustom[phone]] text-input" value="<?php print_r($result['csign_tel_number']); ?>"/></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td><label for="category_id">Fax No.</label></td>
<td><input type="text" name="csign_fax_number" id="csign_fax_number" value="<?php print_r($result['csign_fax_number']); ?>"/></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td><label for="category_id">CST No.</label></td>
<td><input type="text" name="csign_cst_number" id="csign_cst_number" value="<?php print_r($result['csign_cst_number']); ?>"/></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td><label for="category_id">Tin No.</label></td>
<td><input type="text" name="csign_tin_number" class="Xvalidate[Xcustom[tin]] Xtext-input" value="<?php print_r($result['csign_tin_number']); ?>" /></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td><label for="category_id">Digital Signature<br/> Issued By</label></td>
<td><input type="text" name="csign_digital_sign" id="csign_digital_sign" value="<?php print_r($result['csign_digital_sign']); ?>"/></td><td><label>Exp. Date</label></td><td><input type="text" name="csign_digital_sign_expd" id="datepicker-example1_dsib" style="width:120px;"  value="<?php print_r($result['csign_digital_sign_expd']); ?>"/></td><td><label>Remarks</label></td><td><input type="text" name="csign_digital_sign_remark" value="<?php print_r($result['csign_digital_sign_remark']); ?>"/></td></tr>

<tr><td><label for="category_id">NSIC Regi. No.</label></td>
<td><input type="text" name="csign_nsci" value="<?php print_r($result['csign_nsci']); ?>"/></td><td><label>Exp. Date</label></td><td><input type="text" name="csign_nsci_expd" id="datepicker-example1_nsci" style="width:120px;" value="<?php print_r($result['csign_nsci_expd']); ?>"/></td><td><label>Remarks</label></td><td><input type="text" name="csign_nsci_remark" value="<?php print_r($result['csign_nsci_remark']); ?>"/></td></tr>

<tr><td><label for="category_id">DGS&D Regi No.</label></td>
<td><input type="text" name="csign_dgdd" value="<?php print_r($result['csign_dgdd']); ?>"/></td><td><label>Exp. Date</label></td><td><input type="text" name="csign_dgdd_expd" id="datepicker-example1_dgd" style="width:120px;" value="<?php print_r($result['csign_dgdd_expd']); ?>"/></td><td><label>Remarks</label></td><td><input type="text" name="csign_dgdd_remark" value="<?php print_r($result['csign_dgdd_remark']); ?>"/></td></tr>

<tr><td><label for="category_id">DGQA Regi No.</label></td>
<td><input type="text" name="csign_dgq" value="<?php print_r($result['csign_dgq']); ?>"/></td><td><label>Exp. Date</label></td><td><input type="text" name="csign_dgq_expd" id="datepicker-example1_dgq" style="width:120px;" value="<?php print_r($result['csign_dgq_expd']); ?>"/></td><td><label>Remarks</label></td><td><input type="text" name="csign_dgq_remark" value="<?php print_r($result['csign_dgq_remark']); ?>"/></td></tr>
<tr><td><label for="category_id">Firm PAN No.</label></td>
<td><input type="text" name="csign_pan_number" class="validate[Xrequired,Xcustom[pan]]" value="<?php print_r($result['csign_pan_number']); ?>"/></td><td><label>Remark</label></td><td><input type="text" name="csign_pan_remark" id="" style="width:120px;" value="<?php print_r($result['csign_pan_remark']); ?>"/></td></tr>
<tr><td><label for="category_id">Remark (in Price bid)<font class="star">*</font></label></td>
<td><input type="text" name="csign_remark" class="validate[required] Xtext-input" value="<?php print_r($result['csign_remark']); ?>"/></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td><label for="category_id">Delivery schedule<font class="star">*</font></label></td>
<td><input type="text" name="csign_delv_schedule" class="validate[required] Xtext-input" value="<?php print_r($result['csign_delv_schedule']); ?>"/></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td><label for="category_id">Delivery Peride<font class="star">*</font></label></td>
<td><input type="text" name="csign_delv_peride" class="validate[required] Xtext-input" value="<?php print_r($result['csign_delv_peride']); ?>"/></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>




</table>
<hr class="hrules" noshade="noshade" color="#dcdcdc"/>


<table  id="multipels" class="attachz">
<caption>Directors/Proprietor/Partner<?php if(sizeof($result_director)<5 && isset($_GET['val']) && sizeof($result_director)>0) { 
?>
/<a class="link_edit_director" onClick="window.open('record_directors.php?val=<?php print_r($result['id']); ?>&table=consignee_director&field=csign_id','mywindow','width=920,height=333,left=100,top=100,screenX=0,screenY=100')">Edit Details</a>
<?php
}
?></caption>
<?php if($_GET['val']!="" && sizeof($result_director)>4)
{ ?>
<tr><th colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;(Show Old Directors)<input type="button" name="add_more" id="add_more" value="" class="old" onClick="window.open('record_directors.php?val=<?php print_r($result['id']); ?>&table=consignee_director&field=csign_id','mywindow','width=920,height=333,left=100,top=100,screenX=0,screenY=100')"/></th></tr>

<?php } ?>
<tr><th width="180px">Person Name</th><th width="180px">PAN No.</th><th width="180px">Mobile No.</th></tr>
<?php if($_GET['val']!="" && isset($_GET['val'])) 
{
	
	for($i=0;$i<sizeof($result_director);$i++)
	{
		?>
        <tr id="update_row<?php print_r($result_director[$i]['id']) ?>"><td style="border:1px solid #696969;height:25px; width:180px; font-size:12px"><?php print_r($result_director[$i]['csign_director']) ?></td><td style="border:1px solid #696969; height:25px;width:180px; font-size:12px"><?php print_r($result_director[$i]['csign_pan_number']) ?></td><td style="border:1px solid #696969; height:25px;width:180px; font-size:12px"><?php print_r($result_director[$i]['csign_tel_number']) ?></td></tr>
        <?php
	}
?>

<?php
}
?>
<tr id="first_dirct_0">
<?php if($_GET['val']=="" && !isset($_GET['val'])) 
{
?>
<td><input type="text" name="dir_names[]"/></td>
<td><input type="text" name="pan[]"/></td>
<td><input type="text" name="dir_mobile[]"/></td>
<?php
}
?>
<?php if($_GET['val']!="" && isset($_GET['val']) && sizeof($result_director)==0) 
{
?>
<td><input type="text" name="dir_names[]"/></td>
<td><input type="text" name="pan[]"/></td>
<td><input type="text" name="dir_mobile[]"/></td>
<?php
}
?>
</tr>

<tr style="background:#fff;"><td><input type="button" name="add_more" id="add_more" value="Add More" class="add_more" onClick="add_directors_after_row_order();"/></td></tr>
<input type="hidden" id="hide_for_partner" name="hide_for_partner" value="1" />
</table>

<table  id="attachments" class="attachz">
<caption>Attachments <?php if(isset($_GET['val']) && $result_attachment[0]!='') { ?> <a class="link_edit_director" onClick="window.open('Firm_Old_Attachements.php?val=<?php print_r($result['id']); ?>&table=csign_attachments&field=csign_id','mywindow','width=600,height=300,left=100,top=100,screenX=0,screenY=100')">/Delete old </a><?php } ?></caption>
<tr><th>Title</th><th>File</th></tr>
<?php if(isset($_GET['val']) && $_GET['val']!='') { ?>
<?php foreach($result_attachment as $mla) { ?>
<tr>
<?php
$title_value = $obj->Title_In_Firm_Registration($mla['title']);
?>
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
<td><!--<input type="text" name="titles[]"/>-->
<select name="titles[]" id="title_0" style="width:120px; height:30px; border:1px solid #333;" onChange="IfSelectOtherThenTitle(this.id);">
<option value="">Please Select</option>
<option value="1">NSIC Reg</option>
<option value="2">DGS & D Reg</option>
<option value="3">DGQA Reg</option>
<option value="4">CST/VAT Reg</option>
<option value="5">Performance</option>
<option value="6">Digital Signature</option>
<option value="7">PAN Card</option>
<option value="8">Certificate at Incorporation</option>
<option value="9">Memorandum at Article</option>
<option value="10">Others</option>
</select>
</td>
<td><input type="file" name="files[]"/></td>
<td id="SHAKEB_COLM_0"><input type="hidden" id="text_on_others" name="text_on_others[]" /></td>
</tr>
<tr style="background:#fff;"><td>&nbsp;</td><td><input type="button" name="add_more" id="add_more" value="Add More" class="add_more" onClick="add_mores_firms_with_select();"/></td></tr>
</table>
<hr class="hrules" noshade="noshade" color="#dcdcdc"/>
<table><tr><td><input type="submit" name="submit" id="main_submit" value="<?php if($_GET['val']!="") echo "Update"; else echo "Save"; ?>"/></td></tr></table>
<input type="hidden" name="key" id="key" value="<?php echo $_SESSION['key']; ?>" />
<input type="hidden" name="hide_for_add_firms" id="hide_for_add_firm" value="1" />

</form>

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