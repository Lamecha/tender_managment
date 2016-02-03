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
$list_Office = $obj->List_Drop_Down("office","office_code","id");
if(isset($_GET['val']) && $_GET['val']!="")
{
	$result = $obj->common_fetchdata('officer',$_GET['val']);
	
	$office_name_id = $obj->Common_name_id('office','office_code',$result['officer_office']);
	$result_attachment = $obj->common_fetch_attachement('officer_attachments','officer_id',$_GET['val']);
	
}
include("main_includes/simpleimage.php");
$thumb=new SimpleImage();
if(isset($_POST['submit']) && $_POST['key']==$_SESSION['key'])
{
	
	
	
	//----PIC UPLAOD------------------------
if($_FILES['officer_photo']['name']!="")
{
	//explode()---break a string in to array
	$alloweExts=array("jpg","jpeg","gif","png");
	$extension=end(explode(".",$_FILES['officer_photo']['name']));
	if((($_FILES['officer_photo']['type']=="image/jpg") ||($_FILES['officer_photo']['type']=="image/jpeg") || ($_FILES['officer_photo']['type']=="image/gif") || ($_FILES['officer_photo']['type']=="image/png")) || ($_FILES['officer_photo']['size']!=0) && in_array($extension,$alloweExts))
	{
	$img_orig_name = $_FILES['officer_photo']['name'];
	
	$img_new_name = $obj->nameGen();
	
	$img_extn=$obj->getExtension($img_orig_name);
	
	$img_final_name = $img_new_name.".".$img_extn;
	
	move_uploaded_file($_FILES['officer_photo']['tmp_name'],"photo/officer/main/".$img_final_name);
	
	$thumb->load("photo/officer/main/".$img_final_name);
	
	$thumb->resize(190,180);
	
	$thumb->save("photo/officer/thumb/".$img_final_name);
	}
}
else
{
	$img_final_name = "no_pic.jpg";
}
	//-------PIC UPLAOD END-----------------
	//----ATTACHEMENTS-------
 	$finalName = array();
	$name = array();
	for($i=0;$i<sizeof($_POST['titles']);$i++)
	{
		$name[$i] = $_FILES['files']['name'][$i];
		$tmp_name = $_FILES['files']['tmp_name'][$i];
		$ext = $obj->getExtension($name[$i]);
		$newName = $obj->nameGen();
		$finalName[$i]  = $newName.".".$ext;
		move_uploaded_file($tmp_name,"attachements/officer_attach/".$finalName[$i]);
		
	}
 //----ATTACHEMENTS_END-----
	if(isset($_GET['val']) & $_GET['val']!="")
	{
		if($img_final_name == "no_pic.jpg")
		$img_final_name = $result['officer_photo'];
		$update_result=$obj->officer_update($_POST['officer_office'],$_POST['officer_first_name'],$_POST['officer_last_name'],$_POST['officer_user_name'],$_POST['officer_password'],$_POST['officer_pin'],$img_final_name,$_POST['officer_mail'],$_POST['officer_mobile'],$_POST['officer_address'],$_POST['titles'],$finalName,$name,$result['id'],$_SESSION['pin_id'],$_SESSION['pin_table'],$_POST['text_on_others']);
		if($update_result == 1)
		{
			if($_SESSION['rb_power']=="officer")
			{
				$obj->redirect("demo.php");
			}
			else
			{
			$obj->ALertMessage("Officer updated successfully",$update_result);	
			$obj->redirect("officer_update.php?pid=".$_GET['pid']);
			}
		}
		
	}
	else
	{
    $opt=$obj->officer_registration($_POST['officer_office'],$_POST['officer_first_name'],$_POST['officer_last_name'],$_POST['officer_user_name'],$_POST['officer_password'],$_POST['officer_pin'],$img_final_name,$_POST['officer_mail'],$_POST['officer_mobile'],$_POST['officer_address'],$_POST['titles'],$finalName,$name,$_SESSION['pin_id'],$_SESSION['pin_table'],$_POST['text_on_others']);
	$obj->ALertMessage("Officer registered",$opt);
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
<title><?php if($_GET['val']!=""){ echo "Update ";} else { echo "Add "; } ?> Officer : Rainbow Tender Managment</title>


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
<span id="title_work_page"><?php if($_GET['val']!=""){echo "Update ";}?>Officer Details</span>
<div id="working-sub-main">
<div id="working-panel">

<form method="post" enctype="multipart/form-data" id="formID">
<table id="working-form">

<tr><td><label  for="office">Select Office<font color="#990000">*</font></label></td>
<td><select id="officer_office" name="officer_office" class="validate[required]">
<?php if($_GET['val']!="") { ?>
<option value="<?php print_r($office_name_id ['id']); ?>"><?php print_r($office_name_id ['office_code']); ?></option>

<?php } 
else
{
	?>
    <option value="">Please select</option>
    <?php
}
?>

<?php for($i=0;$i<sizeof($list_Office);$i++) 
{
	if($office_name_id['id']==$list_Office[$i]['id'])
	{
		goto LoopForward;
	}
	?>
	
    <option value="<?php print_r($list_Office[$i]['id']) ?>"><?php print_r($list_Office[$i]['office_code']) ?></option>
	<?php
	LoopForward:
}
?>
</select></td></tr>
<tr><td><label for="fname">First Name<font color="#990000">*</font></label></td>
<td><input type="text" name="officer_first_name" id="fname" class="validate[required,custom[name]] Xtext-input"  value="<?php print_r($result['officer_first_name']); ?>" /></td></tr>
<tr><td><label  for="lname">Last Name<font color="#990000">*</font></label></td>
<td><input type="text" name="officer_last_name" id="sname" class="validate[required,custom[name]] Xtext-input" value="<?php print_r($result['officer_last_name']); ?>" /></td></tr>
<tr><td><label  for="user">Username<font color="#990000">*</font></label></td>
<td><input type="text" name="officer_user_name" id="<?php if(isset($_GET['val']) && $_GET['val']!="") { echo $_GET['val']."_user"; } else
{ echo "user"; } ?>" class="validate[required,ajax[ajaxUserCallPhp]] text-input" value="<?php print_r($result['officer_user_name']); ?>" /></td></tr>
<tr><td><label  for="pass">Password<font color="#990000">*</font></label></td>
<td><input type="text" name="officer_password" id="pass" class="validate[required]" value="<?php print_r($result['officer_password']); ?>" /></td></tr>
<tr><td><label  for="pass">Pin No<font color="#990000">*</font></label></td>
<td><input type="text" name="officer_pin" id="<?php if(isset($_GET['val']) && $_GET['val']!="") { echo $_GET['val'] ; } else
{ echo "pin"; } ?>" class="validate[required,custom[pin],ajax[ajaxUserCallPhpPin]]" value="<?php print_r($result['officer_pin']); ?>" /></td></tr>
<tr><td><label for="photo">Photo</label></td>
<td><input type="file" name="officer_photo" id="photo" /></td>

</tr>

<tr><td><label for="email">Email</label></td>
<td><input type="text" name="officer_mail" id="email" class="validate[Xrequired,Xcustom[email]]" value="<?php print_r($result['officer_mail']); ?>" /></td></tr>
<tr><td><label for="mobile">Mobile</label></td>
<td><input type="text" name="officer_mobile" id="mobile" class="Xvalidate[Xrequired,Xcustom[phone]]" value="<?php print_r($result['officer_mobile']); ?>" /></td></tr>
<tr><td><label for="address">Parmanent Address</label></td>
<td><textarea rows="3" cols="15" name="officer_address" id="add" ><?php print_r($result['officer_address']); ?></textarea></td></tr>
</table>
<hr class="hrules" noshade="noshade" color="#dcdcdc"/>

<table  id="attachments" class="attachz">
<caption>Attachments <?php if(isset($_GET['val']) && $result_attachment[0]!='') { ?> <a class="link_edit_director" onClick="window.open('Officer_Old_Attachements.php?val=<?php print_r($result['id']); ?>&table=officer_attachments&field=officer_id','mywindow','width=637,height=250,left=100,top=100,screenX=0,screenY=100')">/Edit/Delete old </a><?php } ?></caption>
<tr><th>Title</th><th>File</th></tr>
<?php if(isset($_GET['val']) && $_GET['val']!='') { ?>
<?php foreach($result_attachment as $mla) { ?>
<?php
$title_value = $obj->Title_In_officer_Employee($mla['title']);
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
<option value="1">PAN Card</option>
<option value="2">ID Proof</option>
<option value="3">Address Proof</option>
<option value="4">Resume</option>
<option value="10">Others</option>
</select>
</td>
<td><input type="file" name="files[]" accept="application/pdf"/></td>
<td id="SHAKEB_COLM_0"><input type="hidden" id="text_on_others" name="text_on_others[]" /></td>
</tr>

<tr style="background:#fff;"><td>&nbsp;</td><td><input type="button" name="add_more" id="add_more" value="Add More" class="add_more" onclick="Add_More_Officer_Employee_Attachements();"/></td></tr>
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