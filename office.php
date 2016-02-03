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
	$result = $obj->common_fetchdata('office',$_GET['val']);
	$result_attachment = $obj->common_fetch_attachement('office_attachments','office_id',$_GET['val']);
}

if(isset($_POST['submit']))
{
	//----ATTACHEMENTS-------
 /*	$finalName = array();
	$name = array();
	for($i=0;$i<sizeof($_POST['titles']);$i++)
	{
		$name[$i] = $_FILES['files']['name'][$i];
		$tmp_name = $_FILES['files']['tmp_name'][$i];
		$ext = $obj->getExtension($name[$i]);
		$newName = $obj->nameGen();
		$finalName[$i]  = $newName.".".$ext;
		move_uploaded_file($tmp_name,"attachements/office_attach/".$finalName[$i]);
	}*/
	
    //----ATTACHEMENTS_END-----
	if(isset($_GET['val'])==1 && $_GET['val']!="")
	{
		$update_result=$obj->office_update($_GET['val'],$_POST['office_code'],$_POST['office_name'],$_POST['office_address'],$_POST['office_city'],$_POST['office_pin'],$_POST['office_telephone'],$_POST['office_fax'],$_POST['office_contact_person'],$_POST['office_mobile'],$_POST['office_email'],$_SESSION['pin_id'],$_SESSION['pin_table']);
		
		if($update_result==1)
		
		{
			$obj->ALertMessage("Office Updated Successfully",$update_result);
			$obj->redirect("office_update.php");
		}
		
	}
	else
	{
		$opt=$obj->office_registration($_POST['office_code'],$_POST['office_name'],$_POST['office_address'],$_POST['office_city'],$_POST['office_pin'],$_POST['office_telephone'],$_POST['office_fax'],$_POST['office_contact_person'],$_POST['office_mobile'],$_POST['office_email'],$_SESSION['pin_id'],$_SESSION['pin_table']);
		$obj->ALertMessage("Office registered",$opt);
	
	}

	
}
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
<title> <?php if($_GET['val']!=""){ echo "Update "; } else { echo "Add "; } ?> Office : Rainbow Tender Managment</title>


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
<script type="text/javascript">
  /*function OldAttachments(id) {
	  alert(id);
	  
      Dialog.alert({url: "AjaxPage.php?faduid="+id, options: {method: 'get'}}, 
                     {top: 200, width:300, height:170,  className: "alphacube",  cancelLabel:"close"})    
  }*/
</script>
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
<span id="title_work_page"><?php if($_GET['val']!="") echo "Update "; ?>Office Details</span>
<div id="working-sub-main">
<div id="working-panel">

<form method="post" enctype="multipart/form-data" id="formID">
<table id="working-form">


<tr><td><label for="fname">Office Code<font color="#990000">*</font></label></td>
<td><input type="text" name="office_code" id="<?php if(isset($_GET['val']) && $_GET['val']!="") { echo $_GET['val'] ; } else
{ echo "office_code"; } ?>" class="validate[required,ajax[ajaxOfficeCodeCallPhp]] Xtext-input" value="<?=$result['office_code'];?>" style="text-transform:capitalize;"  /></td></tr>
<tr><td><label  for="lname"></label></td>
<tr><td><label  for="user">Office Name<font color="#990000">*</font></label></td>
<td><input type="text" name="office_name" id="office_name" class="validate[required] Xtext-input" value="<?=$result['office_name'];?>"/></td></tr>
<tr><td><label for="photo">Office Address<font color="#990000">*</font></label></td>
<td><textarea rows="3" cols="15" name="office_address" id="add" ><?=$result['office_address'];?></textarea></td></tr>
<tr><td><label  for="pass">City<font color="#990000">*</font></label></td>
<td><input type="text" name="office_city" id="city" class="validate[required] Xtext-input" value="<?=$result['office_city'];?>"/></td></tr>
<tr><td><label  for="pass">Pin Code<font color="#990000">*</font></label></td>
<td><input type="text" name="office_pin" id="pin" value="<?=$result['office_pin'];?>"/></td></tr>
<tr><td><label  for="pass">Telephone No.<font color="#990000">*</font></label></td>
<td><input type="text" name="office_telephone" id="telephone" class="validate[required] Xtext-input" value="<?=$result['office_telephone'];?>"/></td></tr>
<tr><td><label  for="pass">Fax No.</label></td>
<td><input type="text" name="office_fax" id="fax" value="<?=$result['office_fax'];?>"/></td></tr>
<tr><td><label  for="pass">Contact Person<font color="#990000">*</font></label></td>
<td><input type="text" name="office_contact_person" id="contact_person" value="<?=$result['office_contact_person'];?>" class="validate[required] Xtext-input"/></td></tr>
<tr><td><label  for="pass">Mobile No.<font color="#990000">*</font></label></td>
<td><input type="text" name="office_mobile" id="fax" value="<?=$result['office_mobile'];?>" class="validate[required,custom[phone]] Xtext-input"/></td></tr>
<tr><td><label  for="pass">Office Email</label></td>
<td><input type="text" name="office_email" id="pass" class="validate[Xrequired,Xcustom[email]] Xtext-input" value="<?=$result['office_email'];?>"/></td></tr>
</table>
<!---------------------------rEMOVING atTACHEMENTS--------------------------->
<!------------------------------
<hr class="hrules" noshade="noshade" color="#dcdcdc"/>
<table  id="attachments" class="attachz">
<caption>Attachments <?php //if(isset($_GET['val']) && $result_attachment[0]!='') { ?> <a class="link_edit_director" onClick="window.open('record_attachments.php?val=<?php // print_r($result['id']); ?>&table=office_attachments&field=office_id','mywindow','width=400,height=250,left=100,top=100,screenX=0,screenY=100')">/Delete old </a><?php //} ?></caption>
<tr><th>Title</th><th>File</th></tr>
<?php //if(isset($_GET['val']) && $_GET['val']!='') { ?>
<?php //foreach($result_attachment as $mla) { ?>
<tr>
<td style="border:1px solid #696969; height:25px; font-size:13px;"><?=$mla['title'];?></td>
<td style="border:1px solid #696969; height:25px; font-size:13px;"><?//=$mla['file_real_name'];?></td>
</tr>
<?php //} } ?>
<tr id="first_c">
<td><input type="text" name="titles[]"/></td>
<td><input type="file" name="files[]"/></td>
</tr>

<tr style="background:#fff;"><td>&nbsp;</td><td><input type="button" name="add_more" id="add_more" value="Add More" class="add_more" onclick="add_mores_firm_regi('first_c');"/></td></tr>
</table>
<hr class="hrules" noshade="noshade" color="#dcdcdc"/>
<!------------------------------------------------------------------------->
<table><tr><td style="width:103px;">&nbsp;</td><td><input type="submit" name="submit" id="main_submit" value="<?php if($_GET['val']!="") echo 'Update'; else echo 'Submit'; ?>"/></td></tr></table>
</form>





</div>
</div>

</div>
<div id="index-footer">
<?php  include_once("main_includes/footer.php"); ?>

</div>


</body>
</html>