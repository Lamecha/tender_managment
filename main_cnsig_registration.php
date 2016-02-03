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
$list_purchaser = $obj->List_Drop_Down("create_purchaser","purchaser_short_name","id");
if(isset($_GET['val']) && $_GET['val']!="")
{
	$result = $obj->common_fetchdata('main_consignee',$_GET['val']);
	$purchaser_name = $obj->Common_name_id('create_purchaser','purchaser_short_name',$result['main_csign_purchaser']);
	$result_director = $obj->common_fetch_attachement('main_consignee_contacts','main_csign_id',$_GET['val']);
	$result_attachment = $obj->common_fetch_attachement('main_csign_attachments','main_csign_id',$_GET['val']);
}
if(isset($_POST['submit']) && $_POST['key']==$_SESSION['key'])
{
	/*$finalName = array();
	$name = array();
	for($i=0;$i<sizeof($_POST['titles']);$i++)
	{
		$name[$i] = $_FILES['files']['name'][$i];
		$tmp_name = $_FILES['files']['tmp_name'][$i];
		$ext = $obj->getExtension($name[$i]);
		$newName = $obj->nameGen();
		$finalName[$i]  = $newName.".".$ext;
		move_uploaded_file($tmp_name,"attachements/main_csign_attach/".$finalName[$i]);
	}*/
	
		if(isset($_GET['val']) & $_GET['val']!="")
		{
			$update_result = $obj->main_consignee_update($_POST,$finalName,$name,$result['id'],$_SESSION['pin_id'],$_SESSION['pin_table']);
			if($update_result == 1)
			{
			$obj->ALertMessage("Consignee Updated Successfully",$update_result);
			$obj->redirect("main_cnsig_update.php?pid=".$_GET['pid']);
			}
		}
		else
		{
		$consignee = $obj->main_consignee_registration($_POST,$finalName,$name,$_SESSION['pin_id'],$_SESSION['pin_table']);
		$obj->ALertMessage("Consignee registered",$consignee);
		
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
<title><?php if($_GET['val']!=""){ echo "Update "; } else { echo "Add "; } ?> Consignee : Rainbow Tender Managment</title>
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
<script type="text/javascript">
var flagsss=false;
function ShortNameCheck()
{
	
   var flag = 1;
  
	
	var sn = document.getElementById('main_csign_short_name').value;
	var pi = document.getElementById('main_csign_purchaser').value;
	var for_hide_id = document.getElementById('for_hide_id').value;
	
	if(pi=="")
	{
		alert('Please select purchaser');
		document.getElementById("main_csign_purchaser").focus();
		return false;
	}
	else
	{
	var ShortNameCheckAdd;  
			try
			{
				ShortNameCheckAdd = new XMLHttpRequest();
			}
			catch (e)
			{
				try
				{
					ShortNameCheckAdd = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch (e) 
				{
					try
					{
						ShortNameCheckAdd = new ActiveXObject("Microsoft.XMLHTTP");
					}
					catch (e)
					{
						alert("Your browser broke!");
						return false;
					}
				}
			}	

			ShortNameCheckAdd.onreadystatechange = function()
			{
				if(ShortNameCheckAdd.readyState == 4)
				{
					var error = ShortNameCheckAdd.responseText
					if(error==1)
					{
				document.getElementById("error_msg").innerHTML='<font style="font-size:9px;color:#009900">Available</font>';
						//flagsss=true;
						//return flagsss;
						
					    flag = 1;
			document.getElementById("main_submit").disabled=false;
      			
						
					}
					else
					{
				document.getElementById("error_msg").innerHTML='<font style="font-size:9px; color:#990000">Not available</font>';
				document.getElementById("main_submit").disabled=true;
				
						flag = 0;
      			

				
					}
					
					
					
				}
			}
	
	ShortNameCheckAdd.open("GET","MainAjax.php?sn="+sn+"&pi="+pi+"&for_hide_id="+for_hide_id,true);
	ShortNameCheckAdd.send(null);
	}

/*if(flag==1)
{
		$(".FM").submit(function() {
					  return true;  
      			});
	
}
else
{
	$(".FM").submit(function() {
					  return false;  
      			});
	
}
	*/
	
}
function FormSubmit(error)
{
	alert(error);
	if(error!='<font style="font-size:9px;color:#009900">Available</font>')
	{
		return false;
	}
}
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
<span id="title_work_page"><?php if($_GET['val']!="") echo "Update "; ?>Consignee Registration</span>
<div id="working-sub-main">
<div id="working-panel">

<form method="post" enctype="multipart/form-data" id="formID" name="formID" class="FM">
<table id="working-form">
<tr><td><label for="category_id">Purchaser<font color="#990000">*</font></label></td>
<td><select id="main_csign_purchaser" name="main_csign_purchaser" class="validate[required]" onchange="ShortNameCheck();">
<?php if($_GET['val']!=""){ ?>
<option value="<?php print_r($purchaser_name['id']); ?>"><?php print_r($purchaser_name['purchaser_short_name']); ?></option><?php } else {  ?>
<option value="">Please select</option>
<?php } ?>
<?php for($i=0;$i<sizeof($list_purchaser);$i++) 
{
	if($purchaser_name['id']==$list_purchaser[$i]['id'])
	{
		goto GoLoop;
	}
	?>
    <option value="<?php print_r($list_purchaser[$i]['id']) ?>"><?php print_r($list_purchaser[$i]['purchaser_short_name']) ?></option>
	<?php
	GoLoop:
}
?>
</select></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td><label for="category_id">Name<font color="#990000">*</font></label></td>
<td><input type="text" name="main_csign_name" id="main_csign_name" class="validate[required] Xtext-input" value="<?php print_r($result['main_csign_name']); ?>" style="text-transform:capitalize;" /></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td><label for="category_id">Short Name<font color="#990000">*</font></label></td>
<td><input type="text" name="main_csign_short_name" id="main_csign_short_name"  class="validate[required] Xtext-input" value="<?php print_r($result['main_csign_short_name']); ?>" onkeyup="ShortNameCheck();" style="text-transform:uppercase;"/></td><td><label id="error_msg"></label></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>

<tr><td><label for="category_id">Address</label></td>
<td><textarea name="main_csign_address" id="main_csign_address" class="" ><?php print_r($result['main_csign_address']); ?></textarea></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td><label for="category_id">City<font color="#990000">*</font></label></td>
<td><input type="text" name="main_csign_city" id="main_csign_city"  class="validate[required] Xtext-input" value="<?php print_r($result['main_csign_city']); ?>"/></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td><label for="category_id">Pin Code</label></td>
<td><input type="text" name="main_csign_addpin" id="main_csign_addpin" class="" value="<?php print_r($result['main_csign_addpin']); ?>" /></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td><label for="category_id">Fax No</label></td>
<td><input type="text" name="main_csign_fax" id="main_csign_fax"  class="Xvalidate[Xrequired] Xtext-input" value="<?php print_r($result['main_csign_fax']); ?>" /></td><td><label id="error_msg"></label></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
</table>
<hr class="hrules" noshade="noshade" color="#dcdcdc"/>


<table  id="multipels" class="attachz">
<caption>Contacts<?php if(sizeof($result_director)<5 && isset($_GET['val']) && sizeof($result_director)>0) { 
?>
/<a class="link_edit_director" onClick="window.open('record_directors_main_cnsig.php?val=<?php print_r($result['id']); ?>&table=main_consignee_contacts&field=main_csign_id','mywindow','width=1300,height=333,left=100,top=100,screenX=0,screenY=100')">Edit Details</a>
<?php
}
?></caption>
<?php if($_GET['val']!="" && sizeof($result_director)>4)
{ ?>
<tr><th colspan="7">&nbsp;&nbsp;&nbsp;&nbsp;(Show Old Attachments)<input type="button" name="add_more" id="add_more" value="" class="old" onClick="window.open('record_directors_main_cnsig.php?val=<?php print_r($result['id']); ?>&table=main_consignee_contacts&field=main_csign_id','mywindow','width=1040,height=333,left=100,top=100,screenX=0,screenY=100')"/></th></tr>

<?php } ?>
<tr><th>Post Name</th><th>Officer Name</th><th>Office No.</th><th>Mobile No.</th><th>Fax No.</th><th>Residence No.</th><th>Email</th><th>Deals</th></tr>
<?php if($_GET['val']!="" && isset($_GET['val'])) 
{
	
	for($i=0;$i<sizeof($result_director);$i++)
	{
		?>
        <tr id="update_row<?php print_r($result_director[$i]['id']) ?>">
        <td style="border:1px solid #696969;height:25px; width:120px; font-size:12px"><?php if($result_director[$i]['contact_postname']=="") { echo "&nbsp;"; } print_r($result_director[$i]['contact_postname']) ?></td>
        <td style="border:1px solid #696969;height:25px; width:120px; font-size:12px"><?php if($result_director[$i]['contact_officername']=="") { echo "&nbsp;"; } print_r($result_director[$i]['contact_officername']) ?></td><td style="border:1px solid #696969; height:25px;width:120px; font-size:12px"><?php if($result_director[$i]['contact_telephone']=="") { echo "&nbsp;"; } print_r($result_director[$i]['contact_telephone']) ?></td><td style="border:1px solid #696969; height:25px;width:120px; font-size:12px"><?php if($result_director[$i]['contact_mobile']=="") { echo "&nbsp;"; } print_r($result_director[$i]['contact_mobile']) ?></td>
  <td style="border:1px solid #696969; height:25px;width:120px; font-size:12px"><?php if($result_director[$i]['contact_fax']=="") { echo "&nbsp;"; } print_r($result_director[$i]['contact_fax']) ?></td>      
 <td style="border:1px solid #696969; height:25px;width:120px; font-size:12px"><?php if($result_director[$i]['contact_residence']=="") { echo "&nbsp;"; } print_r($result_director[$i]['contact_residence']) ?></td>
 <td style="border:1px solid #696969; height:25px;width:120px; font-size:12px"><?php if($result_director[$i]['contact_email']=="") { echo "&nbsp;"; } print_r($result_director[$i]['contact_email']) ?></td>
 <td style="border:1px solid #696969; height:25px;width:120px; font-size:12px"><?php if($result_director[$i]['contact_deal']=="") { echo "&nbsp;"; } print_r($result_director[$i]['contact_deal']) ?></td>       
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
<td><input type="text" name="contact_postname[]" style="width:120px;"/></td>
<td><input type="text" name="contact_officername[]" style="width:120px;"/></td>
<td><input type="text" name="contact_telephone[]" style="width:120px;"/></td>
<td><input type="text" name="contact_mobile[]" style="width:120px;"/></td>
<td><input type="text" name="contact_fax[]" style="width:120px;"/></td>
<td><input type="text" name="contact_residence[]" style="width:120px;"/></td>
<td><input type="text" name="contact_email[]" style="width:120px;"/></td>
<td><input type="text" name="contact_deal[]" style="width:120px;"/></td>
<?php
}
?>
<?php if($_GET['val']!="" && isset($_GET['val']) && sizeof($result_director)==0) 
{
?>
<td><input type="text" name="contact_postname[]" style="width:120px;"/></td>
<td><input type="text" name="contact_officername[]" style="width:120px;"/></td>
<td><input type="text" name="contact_telephone[]" style="width:120px;"/></td>
<td><input type="text" name="contact_mobile[]" style="width:120px;"/></td>
<td><input type="text" name="contact_fax[]" style="width:120px;"/></td>
<td><input type="text" name="contact_residence[]" style="width:120px;"/></td>
<td><input type="text" name="contact_email[]" style="width:120px;"/></td>
<td><input type="text" name="contact_deal[]" style="width:120px;"/></td>
<?php
}
?>
</tr>

<tr style="background:#fff;"><td><input type="button" name="add_more" id="add_more" value="Add More" class="add_more" onclick="add_contacts();"/></td></tr>

<input type="hidden" id='hide_for_main_consignee' name='hide_for_main_consignee' value="1" />
</table>
<!-------------------------------REMOVING ATTACHEMENTS-------------------------->
<!----------------------------------------*******
<table  id="attachments" class="attachz">
<caption>Attachments <?php //if(isset($_GET['val']) && $result_attachment[0]!='') { ?> <a class="link_edit_director" onClick="window.open('record_attachments.php?val=<?php// print_r($result['id']); ?>&table=main_csign_attachments&field=main_csign_id','mywindow','width=400,height=250,left=100,top=100,screenX=0,screenY=100')">/Delete old </a><?php// } ?></caption>
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
<input type="hidden" id="for_hide_id" value="<?php //echo $_GET['val']; ?>" />

<tr style="background:#fff;"><td>&nbsp;</td><td><input type="button" name="add_more" id="add_more" value="Add More" class="add_more" onclick="add_mores_firm_regi('first_c');"/></td></tr>
</table>
<hr class="hrules" noshade="noshade" color="#dcdcdc"/>

<!------------------------------------------>
<input type="hidden" id="for_hide_id" value="<?php echo $_GET['val']; ?>" />
<table><tr><td><input type="submit" name="submit" id="main_submit" value="<?php if($_GET['val']!="") echo "Update"; else echo "Save"; ?>" onsubmit="ShortNameCheck();"/></td></tr></table>
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