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
if(isset($_GET['val'])==1 && $_GET['val']!="")
{
	$result=$obj->common_fetchdata('create_purchaser',$_GET['val']);
	$result_director = $obj->common_fetch_attachement('purchaser_director','purchase_id',$_GET['val']);
	$result_attachment = $obj->common_fetch_attachement('purchase_attachments','purchase_id',$_GET['val']);
	

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
		move_uploaded_file($tmp_name,"attachements/purchaser_attach/".$finalName[$i]);
	}
	
	if(isset($_GET['val'])==1 && $_GET['val']!="")
	{
		$update_purchaser=$obj->purchase_update($_POST,$finalName,$name,$result['id'],$_SESSION['pin_id'],$_SESSION['pin_table']);
		if($update_purchaser==1)
		{
			$obj->ALertMessage("Purchaser Updated Successfully",$update_purchaser);
			$obj->redirect("purchaser_update.php");
		}
	}
	else
	{
		$purchaser = $obj->purchaser_registration($_POST,$finalName,$name,$_SESSION['pin_id'],$_SESSION['pin_table']);
		$obj->ALertMessage("Purchaser registered",$purchaser);
		
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
<title><?php if($_GET['val']!=""){ echo "Update "; } else { echo "Add "; } ?> Purchaser : Rainbow Tender Managment</title>


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
<span id="title_work_page"><?php if($_GET['val']!="") echo "Update "; ?>Purchaser Registration</span>
<div id="working-sub-main">
<div id="working-panel">
<form method="post" enctype="multipart/form-data" id="formID">
<table id="working-form">
<tr><td><label for="category_id">Name<font class="star">*</font></label></td>
<td><input class="validate[required] Xtext-input" type="text" name="purchaser_name" id="csign_firm_name" value="<?=$result['purchaser_name'];?>" style="text-transform:capitalize;" /></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>

<tr><td><label for="category_id">Short Name<font class="star">*</font></label></td>
<td><input type="text" name="purchaser_short_name" id="<?php if(isset($_GET['val']) && $_GET['val']!="") { echo $_GET['val'] ; } else
{ echo "purchaser_short_name"; } ?>" class="validate[required,ajax[ajaxPurchaserCallPhp]]" value="<?=$result['purchaser_short_name'];?>" style="text-transform:uppercase;" /></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>

<tr><td><label for="category_id">Address<font class="star">*</font></label></td>
<td><textarea name="purchaser_address" id="purchaser_address" class="validate[required]"><?=$result['purchaser_address'];?> </textarea></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>

<tr><td><label for="category_id">City<font class="star">*</font></label></td>
<td><input type="text" name="city" id="csign_email" value="<?=$result['city'];?>" /></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>

<tr><td><label for="category_id">Pin code <font class="star">*</font></label></td>
<td><input type="text" name="pin" id="<?php if(isset($_GET['val']) && $_GET['val']!="") { echo $_GET['val'] ; } else
{ echo "pin"; } ?>" class="validate[required,custom[Addresspin],XXajax[ajaxPurchaserCallPhpPin]]" value="<?=$result['pin'];?>" /></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>

<tr><td><label for="category_id">Fax No.</label></td>
<td><input type="text" name="Fax_No" id="Fax_No" value="<?=$result['Fax_No'];?>" /></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td><label for="category_id">Website</label></td>
<td><input type="text" name="website" id="csign_fax_number" class="Xvalidate[Xrequired]" value="<?=$result['website'];?>" /></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>

<tr><td><label for="category_id">Store Home Page</label></td>
<td><input type="text" name="store_page" id="csign_cst_number" value="<?=$result['store_page'];?>" /></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>

<tr><td><label for="category_id"> Tender Url<br/> </label></td>
<td><input type="text" name="bulletin_url" id="csign_digital_sign" value="<?=$result['bulletin_url'];?>" />

<tr><td><label for="category_id">PO Detail Url<br/> </label></td>
<td><input type="text" name="limited_url" id="csign_digital_sign" value="<?=$result['limited_url'];?>" />



</table>
<hr class="hrules" noshade="noshade" color="#dcdcdc"/>
<table id="pur_cnt_multipels" class="attachz">
<caption>Contacts<?php if(sizeof($result_director)<5 && isset($_GET['val']) && sizeof($result_director)>0) { 
?>
/<a class="link_edit_director" onClick="window.open('record_purchase_directors.php?val=<?php print_r($result['id']); ?>&table=purchaser_director&field=purchase_id','mywindow','width=960,height=333,left=100,top=100,screenX=0,screenY=100')">Edit Details</a>
<?php
}
?></caption>

<?php if($_GET['val']!="" && sizeof($result_director)>4)
{ ?>
<tr><th colspan="9">&nbsp;&nbsp;&nbsp;&nbsp;(Show Old Attachments)<input type="button" name="add_more" id="add_more" value="" class="old" onClick="window.open('record_purchase_directors.php?val=<?php print_r($result['id']); ?>&table=purchaser_director&field=purchase_id','mywindow','width=960,height=333,left=100,top=100,screenX=0,screenY=100')"/></th></tr>

<?php } ?>
<tr><th style="width:120px;">Post Name</th><th style="width:120px;">Officer Name</th><th style="width:120px;">Telephone</th><th style="width:120px;">Mobile</th><th style="width:120px;">Residence.No.</th><th style="width:120px;">Fax No.</th><th style="width:120px;">Email</th><th style="width:120px;">Deals</th></tr>
<?php if($_GET['val']!="" && isset($_GET['val'])) 
{
	
	for($i=0;$i<sizeof($result_director);$i++)
	{
		?>
        <tr id="update_row<?php print_r($result_director[$i]['id']) ?>"><td style="border:1px solid #696969;height:25px; width:120px; font-size:12px"><?php if($result_director[$i]['purchaser_post_name']=="") { echo "&nbsp;"; } print_r($result_director[$i]['purchaser_post_name']) ?></td><td style="border:1px solid #696969; height:25px;width:120px; font-size:12px"><?php if($result_director[$i]['purchaser_office_name']=="") { echo "&nbsp;"; } print_r($result_director[$i]['purchaser_office_name']) ?></td><td style="border:1px solid #696969; height:25px;width:120px; font-size:12px"><?php if($result_director[$i]['purchaser_tel']=="") { echo "&nbsp;"; } print_r($result_director[$i]['purchaser_tel']) ?></td>
 <td style="border:1px solid #696969; height:25px;width:120px; font-size:12px"><?php if($result_director[$i]['purchaser_mob']=="") { echo "&nbsp;"; } print_r($result_director[$i]['purchaser_mob']) ?></td>
 <td style="border:1px solid #696969; height:25px;width:120px; font-size:12px"><?php if($result_director[$i]['purchaser_residence']=="") { echo "&nbsp;"; } print_r($result_director[$i]['purchaser_residence']) ?></td>
 <td style="border:1px solid #696969; height:25px;width:120px; font-size:12px"><?php if($result_director[$i]['purchaser_fax']=="") { echo "&nbsp;"; } print_r($result_director[$i]['purchaser_fax']) ?></td>
 <td style="border:1px solid #696969; height:25px;width:120px; font-size:12px"><?php if($result_director[$i]['purchaser_email']=="") { echo "&nbsp;"; } print_r($result_director[$i]['purchaser_email']) ?></td>
 <td style="border:1px solid #696969; height:25px;width:120px; font-size:12px"><?php if($result_director[$i]['purchaser_deals']=="") { echo "&nbsp;"; } print_r($result_director[$i]['purchaser_deals']) ?></td>       
        </tr>
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
<td><input type="text" name="purchaser_post_name[]" style="width:120px;"/></td>
<td><input type="text" name="purchaser_office_name[]" style="width:120px;"/></td>
<td><input type="text" name="purchaser_tel[]" style="width:120px;"/></td>
<td><input type="text" name="purchaser_mob[]" style="width:120px;"/></td>
<td><input type="text" name="purchaser_residence[]" style="width:120px;"/></td>
<td><input type="text" name="purchaser_fax[]" style="width:120px;"/></td>
<td><input type="text" name="purchaser_email[]" style="width:120px;"/></td>
<td><input type="text" name="purchaser_deals[]" style="width:120px;"/></td>
<?php
}
?>
<?php if($_GET['val']!="" && isset($_GET['val']) && sizeof($result_director)==0) 
{
?>
<td><input type="text" name="purchaser_post_name[]" style="width:120px;"/></td>
<td><input type="text" name="purchaser_office_name[]" style="width:120px;"/></td>
<td><input type="text" name="purchaser_tel[]" style="width:120px;"/></td>
<td><input type="text" name="purchaser_mob[]" style="width:120px;"/></td>
<td><input type="text" name="purchaser_residence[]" style="width:120px;"/></td>
<td><input type="text" name="purchaser_fax[]" style="width:120px;"/></td>
<td><input type="text" name="purchaser_email[]" style="width:120px;"/></td>
<td><input type="text" name="purchaser_deals[]" style="width:120px;"/></td>
<?php
}
?>
</tr>
<input type="hidden" id="hide_for_counter" name="hide_for_counter" value="1" />
<tr style="background:#fff;"><td><input type="button" name="add_more" id="add_more" value="Add More" class="add_more" onclick="add_directors_purchaser();"/></td></tr>
</table>
<!----REMOVING ATTACHEMENTS-----------------------------
*******************************************************
<table  id="attachments" class="attachz">
<caption>XXXAttachments <?php //if(isset($_GET['val']) && $result_attachment[0]!='') { ?> <a class="link_edit_director" onClick="window.open('record_attachments.php?val=<?php //print_r($result['id']); ?>&table=purchase_attachments&field=purchase_id','mywindow','width=400,height=250,left=100,top=100,screenX=0,screenY=100')">/Delete old </a><?php //} ?></caption>
<tr><th>Title</th><th>File</th></tr>
<?php// if(isset($_GET['val']) && $_GET['val']!='') { ?>
<?php //foreach($result_attachment as $mla) { ?>
<tr>
<td style="border:1px solid #696969; height:25px; font-size:13px;"><?//=$mla['title'];?></td>
<td style="border:1px solid #696969; height:25px; font-size:13px;"><?//=$mla['file_real_name'];?></td>
</tr>
<?php// } } ?>
<tr id="first_c">
<td><input type="text" name="titles[]"/></td>
<td><input type="file" name="files[]"/></td>
</tr>
<tr style="background:#fff;"><td>&nbsp;</td><td><input type="button" name="add_more" id="add_more" value="Add More" class="add_more" onclick="add_mores_firm_regi('first_c');"/></td></tr>
</table>
<hr class="hrules" noshade="noshade" color="#dcdcdc"/>
<!!--------------------------------------------------------->
<table><tr><td><input type="submit" name="submit" id="main_submit" value="<?php if($_GET['val']!="") echo "Update"; else echo "Save"; ?>"/></td></tr></table>
<input type="hidden" name="key" id="key" value="<?php echo $_SESSION['key']; ?>" />
</form>
</div>
</div>
</div>
<div id="index-footer">
<?php  include_once("main_includes/footer.php"); ?>

</div>


</body>
</html>