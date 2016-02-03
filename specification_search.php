<?php
session_start();
error_reporting(0);
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
//$list_office = $obj->List_Drop_Down("office","office_code","id");
//$list_purchaser = $obj->List_Drop_Down("create_purchaser","purchaser_short_name","id");
//$list_item_category = $obj->List_Drop_Down("item_manager","item_name","id");
if(isset($_GET['submit']))
{
	$list_tender = $obj->Specification_Search($_GET['specification_number'],$_GET['title'],$_GET['issued_by']);
	
	
	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="main_includes/add_new_row.js"></script>
<!--
<link rel="stylesheet" type="text/css" href="date_range_picker/basic_date_picker_style.css" />
 <link rel="stylesheet" type="text/css" media="all" href="date_range_picker/daterangepicker.css" />
 -->
<link rel="stylesheet" href="main_css/main_css.css"/>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="main_css/jquery.pageslide.css" />
<link rel="stylesheet" href="Xcss/styles_po.css">
<link rel="stylesheet" href="Xcss/style_po_firm.css" />


<style type="text/css">
.attachz tr td
{
	font-size:12px;
	padding-left:5px;
	
}

</style>

 
<title>Specification Search : Rainbow Tender Managment</title>


    <link rel="stylesheet" type="text/css" media="screen" href="main_css/jquery.ui.potato.menu.css" />
    
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="main_js/menu_bar/jquery.ui.potato.menu.js"></script>
<script type="text/javascript">
//var $sp=jQuery.noConflict();
(function($) {
    $(document).ready(function(){
        $('#menu1').ptMenu();
    });
})(jQuery);
</script>
<?php include_once("main_includes/date_picker.php");?> 
<script>
function EditUrl(id)
{
	window.location="tender_list.php?hv="+id;
	
}
</script>

<!-----------------DATE RANGE PICKER----------------->

    
<!--      
<script type="text/javascript" src="date_range_picker/date.js"></script>
<script type="text/javascript" src="date_range_picker/daterangepicker.js"></script>
-->
<!--------------------------------------------------->
<style>
.dpies a
{
	font-size:18px;
}
</style>
</head>
<body>


<div id="index-header">
<?php include_once("main_includes/main_header.php");?>
</div>
<div id="index-navigation">
<?php 
$meenubar = $_SESSION['rb_power']."_menu.php";
include_once("main_includes/".$meenubar); ?> 
</div>
<div id="index-main">
<span id="title_work_page"><?php if($_GET['val']!="") echo "Update "; ?>Search Specification</span>
<div id="working-sub-main">
<div id="working-panel" style="width:1250px;">

<form method="GET" enctype="multipart/form-data" id="formID">
<table id="working-form" cellspacing="10">
<tr>
<td><label for="spec_number">Specification Number</label></td>
<td><input type="text" id="specification_number" name="specification_number" placeholder="Specification Number" /></td>
</tr>
<tr>
<td><label for="title">Title</label></td>
<td><input type="text" id="title" name="title" placeholder="Title" /></td>
</tr>
<tr>
<td><label for="Issued By">Issued By</label></td>
<?php $select_opt = '_'.$_GET['issued_by'].'_I'; 
$$select_opt = "selected='selected'";
?>
<td><select id="issued_by" name="issued_by" class="Xtext-input">
<option value="%%">All</option>
<option value="1" <?=$_1_I;?>>BIS</option>
<option value="2" <?=$_2_I;?>>DGQA</option>
<option value="3" <?=$_3_I;?>>Railway</option>
<option value="4" <?=$_4_I;?>>DGS & D</option>
<option value="10" <?=$_10_I;?>>Others</option>
</select>
</td>
</tr>
<tr>
<td></td>
<td>
<input type="submit" name="submit" value="Search" style="background:#3aacce;"/>
</td>
</tr>
</table>
</form>
<?php if(isset($_GET['submit']))
{ 
if(is_array($list_tender))
{
?>
<table id="multipels" class="attachz" cellspacing="3px;">
<tr><th style="width:150px;">Specs No.</th><th style="width:160px;">Part</th><th style="width:130px;">Revision</th><th style="width:150px;">Reaffirmed</th><th style="width:100px;">Year</th><th style="width:100px">Title</th>
<th style="width:100px">Issued By</th><th style="width:200px;">Files</th></tr>
<?php
foreach($list_tender as $v)
{
	?>
    <tr style="background:#9F6;">
    <td style="border:0px solid #666; height:35px;"><?=$v['specification_no'];?></td>
    <td style="border:0px solid #666; height:35px;"><?=$v['part'];?></td>
    <td style="border:0px solid #666; height:35px;"><?=$v['revision'];?></td>
    <td style="border:0px solid #666; height:35px;"><?=$v['reaffirmed'];?></td>
    <td style="border:0px solid #666; height:35px;"><?=$v['year'];?></td>
    <td style="border:0px solid #666; height:35px;"><?=$v['title'];?></td>
    <td style="border:0px solid #666; height:35px;"><?=$issued_by=$obj->Title_specs_issued_by($v['issued']);?><?php if($v['issued']==10) echo '/'.$v['other_issued']; ?></td>
    <?php $result_attachment = $obj->common_fetch_attachement('specification_attachements','specs_id',$v['id']); 
	$s_nj=1;
	?>
   <td style="border:0px solid #666; min-height::35px; height:auto; padding:2px;">
   <?php 
   if(is_array($result_attachment) && $result_attachment[0]!='')
   {
   foreach($result_attachment as $mla) 
   {
	   ?>
       <font style="color:#C00;">[<?=$s_nj;?>]&nbsp;<a target="_blank" style="color:#990000;" href="attachements/specification/<?=$mla['file_real_name'];?>"><?=$mla['file'];?></a></font>
       <br/>
       <?php
	$s_nj++;  
	}
	  
   }
   else
   {
	   echo 'No File to download';
   }
   ?>
   </td>
    
    
   
   
    
    <?php
}
	$i++;
?>
</table>
<?php
}
else
{
	?>
    <div class="warning"><img src="images/Button-Warning-icon.png" /> No Record Found !</div>
    <?php
	
}
}
?>
</div>
<div style="margin-left:10px;margin-top:0px; margin-bottom:2px; clear:both">

</div>

</div>

</div>
       	
</div>
  
    
  


<div id="index-footer">
<?php  include_once("main_includes/footer.php"); ?>
</div>
<script src="main_js/pageslide/jquery-1.7.1.min.js"></script>
<script src="main_js/pageslide/jquery.pageslide.min.js"></script>
<script>
/* Default pageslide, moves to the right */
var $X = jQuery.noConflict();
$X(".first").pageslide();
$X(".second").pageslide({ direction: "left", modal: true });
</script>

</body>
</html>