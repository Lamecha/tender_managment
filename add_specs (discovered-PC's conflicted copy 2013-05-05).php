<?php
session_start();
include("main_includes/main_class.php");
$obj = new main_front_class();
if(!isset($_SESSION['rb_uname']) || !isset($_SESSION['rb_pass']) || !isset($_SESSION['rb_pin']) || !isset($_SESSION['rb_power']))
{
	$obj->redirect("index.php");
}
else
{
	$result_login = $obj->LoginData($_SESSION['rb_power'],$_SESSION['rb_uname']);
	
}
//$list_Office = $obj->List_Drop_Down("office","office_code","id");
if(isset($_GET['val']) && $_GET['val']!="")
{
	$result = $obj->common_fetchdata('specification',$_GET['val']);
	
	//$office_name_id = $obj->Common_name_id('office','office_code',$result['officer_office']);
	$result_attachment = $obj->common_fetch_attachement('specification_attachements','specs_id',$_GET['val']);
	
}
include("main_includes/simpleimage.php");
$thumb=new SimpleImage();
if(isset($_POST['submit']) && $_POST['key']==$_SESSION['key'])
{
	//----ATTACHEMENTS-------
 	$finalName = array();
	$name = array();
	$counterXD=0;
	
	for($i=0;$i<sizeof($_FILES['files']['name']);$i++)
	{
		if($_FILES['files']['name'][$i]=='')
		{
			$counterXD++;
		}
		$name[$i] = $_FILES['files']['name'][$i];
		$tmp_name = $_FILES['files']['tmp_name'][$i];
		$ext = $obj->getExtension($name[$i]);
		$newName = $obj->nameGen();
		$finalName[$i]  = $newName.".".$ext;
		move_uploaded_file($tmp_name,"attachements/specification/".$finalName[$i]);
		
	}
 //----ATTACHEMENTS_END-----
	if(isset($_GET['val']) & $_GET['val']!="")
	{
		
		$update_result=$obj->Specification_update($_POST['specification_no'],$_POST['part'],$_POST['revision'],$_POST['reaffirmed'],$_POST['year'],$_POST['title'],$finalName,$name,$result['id'],$_SESSION['pin_id'],$_SESSION['pin_table'],$_POST['issued'],$_POST['other_issued']);
		if($update_result == 1)
		{
			if($_SESSION['rb_power']=="officer")
			{
				$obj->redirect("demo.php");
			}
			else
			{
			$obj->ALertMessage("Specification updated successfully",$update_result);	
			$obj->redirect("edit_specs.php");
			}
		}
		
	}
	else
	{
		if(sizeof($_FILES['files']['name'])==$counterXD)
		{
			 $obj->ALertMessage("Atleast upload one file to save",1);
		}
		else
		{
		$opt=$obj->specification_registration($_POST['specification_no'],$_POST['part'],$_POST['revision'],$_POST['reaffirmed'],$_POST['year'],$_POST['title'],$finalName,$name,$_SESSION['pin_id'],$_SESSION['pin_table'],$_POST['issued'],$_POST['other_issued']);
   $obj->ALertMessage("Specification registered",$opt);
		}
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
<style type="text/css">


</style>
<title><?php if($_GET['val']!=""){ echo "Update ";} else { echo "Add "; } ?> Specification : Rainbow Tender Managment</title>


    <link rel="stylesheet" type="text/css" media="screen" href="main_css/jquery.ui.potato.menu.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="main_js/menu_bar/jquery.ui.potato.menu.js"></script>
<script type="text/javascript">
//var $j = jQuery.noConflict();
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
  document.getElementById("fname").focus();
};
</script>
<?php
}
else
{
?>
<script>
window.onload = function() {
  document.getElementById("<?php echo $_GET['val'] ?>_user").focus();
  document.getElementById("<?php echo $_GET['val'] ?>").focus();
  document.getElementById("fname").focus();
};
</script>	
<?php
}
?>
<script>

		jQuery(document).ready(function(){
			jQuery("#formID").validationEngine();

			$("#formID").bind("jqv.field.result", function(event, field, errorFound, prompText){ console.log(errorFound) })
		});
	</script>
   <script>
   function SingleOther(mp)
   {
	   if(mp==10)
	   {
		   document.getElementById('other_issued').style.display='';
	   }
	   else
	   {
		   document.getElementById('other_issued').style.display='none';
	   }
	   
   }
   </script> 

</head>
<?php include_once("main_includes/date_picker.php");?> 
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
<span id="title_work_page"><?php if($_GET['val']!=""){echo "Update ";}?>Specification Details</span>
<div id="working-sub-main">
<div id="working-panel">

<form method="post" enctype="multipart/form-data" id="formID">
<table id="working-form">

<tr><td><label for="specsno">Specification No<font class="star">*</font></label></td>
<td><input type="text" name="specification_no" id="<?php if(isset($_GET['val']) && $_GET['val']!="") { echo $_GET['val'] ; } else
{ echo "specification_no"; } ?>" class="validate[required,ajax[ajaxSpecificationNumberCall]]"  value="<?php print_r($result['specification_no']); ?>" /></td></tr>
<tr><td><label  for="part">Part</label></td>
<td><input type="text" name="part" id="part" class="Xvalidate[Xrequired]" value="<?php print_r($result['part']); ?>" /></td></tr>
<tr><td><label  for="revision">Revision</label></td>
<td><input type="text" name="revision" id="revision" class="Xvalidate[Xrequired] text-input" value="<?php print_r($result['revision']); ?>" /></td></tr>
<tr><td><label  for="reaffirmed">Reaffirmed</label></td>
<td><input type="text" name="reaffirmed" id="reaffirmed" class="Xvalidate[Xrequired]" value="<?php print_r($result['reaffirmed']); ?>" /></td></tr>
<tr><td><label  for="year">Year</label></td>
<td><input type="text" name="year" id="year" class="Xvalidate[Xrequired]" value="<?php print_r($result['year']); ?>" /></td></tr>
<tr><td><label for="title">Title<font style="color:#990000">*</font></label></td>
<td><input type="text" id="title" name="title" value="<?php print_r($result['title']); ?>" class="validate[required]" /></td>
</tr>

<tr><td><label  for="issued">Issued By</label></td>
<?php $select_opt = '_'.$result['issued'].'_I'; 
$$select_opt = "selected='selected'";
?>
<td><select name="issued" id="issued" class="Xvalidate[Xrequired]" onChange="SingleOther(this.value);">
<?php if(!isset($_GET['val'])) { ?>
<option value="">Please Select</option>
<?php } ?>
<option value="1" <?=$_1_I;?>>BIS</option>
<option value="2" <?=$_2_I;?>>DGQA</option>
<option value="3" <?=$_3_I;?>>Railway</option>
<option value="4" <?=$_4_I;?>>DGS & D</option>
<option value="10" <?=$_10_I;?>>Others</option></select></td>
<td><input style="display:<?php if(isset($_GET['val']) && $result['issued']==10) { echo '';} else
{ echo 'none';} ?>;" type="text" id="other_issued" name="other_issued" value="<?php print_r($result['other_issued']); ?>" /></td>
</tr>
</table>
<hr class="hrules" noshade="noshade" color="#dcdcdc"/>

<table  id="attachments" class="attachz">
<caption>Attachments <?php if(isset($_GET['val']) && $result_attachment[0]!='') { ?> <a class="link_edit_director" onClick="window.open('specification_old_attachements.php?val=<?php print_r($result['id']); ?>&table=specification_attachements&field=specs_id','mywindow','width=637,height=250,left=100,top=100,screenX=0,screenY=100')">/Edit/Delete old </a><?php } ?></caption>
<tr><th>File</th></tr>
<?php if(isset($_GET['val']) && $_GET['val']!='') { ?>
<?php foreach($result_attachment as $mla) { ?>
<tr>
<td style="border:1px solid #696969; height:25px; font-size:13px;"><?=$mla['file'];?></td>
</tr>
<?php } } ?>
<tr id="SHAKEB_0">
<td><input type="file" name="files[]" accept="application/pdf"/></td>
<td id="SHAKEB_COLM_0"><input type="hidden" id="text_on_others" name="text_on_others[]" /></td>
</tr>
<tr style="background:#fff;"><td>&nbsp;</td><td><input type="button" name="add_more" id="add_more" value="Add More" class="add_more" onclick="Add_More_Specification_Attachements();"/></td></tr>
</table>
<hr class="hrules" noshade="noshade" color="#dcdcdc"/>
<table><tr><td><input type="submit" name="submit" id="main_submit" value="<?php if($_GET['val']!="") echo "Update"; else echo "Submit"; ?>"/></td></tr>


</table>
<input type="hidden" name="hide_for_add_firms" id="hide_for_add_firm" value="1" />
<input type="hidden" name="key" id="key" value="<?php echo $_SESSION['key']; ?>" />
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
        case 'pdf':
		case 'jpg':
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