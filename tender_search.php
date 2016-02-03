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
$list_office = $obj->List_Drop_Down("office","office_code","id");
$list_purchaser = $obj->List_Drop_Down("create_purchaser","purchaser_short_name","id");
$list_item_category = $obj->List_Drop_Down("item_manager","item_name","id");
if(isset($_GET['submit']))
{
	
	$OT=$_GET['tender_office'];
	$PT=$_GET['tender_purchaser'];
	$list_tender = $obj->Tender_Search_In_Current_And_History_Both($OT,$PT,$_GET['tender_number'],$_GET['reservation'],$_GET['item_category'],$_GET['item_discription'],$_GET['min_range'],$_GET['max_range']);
	
	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="main_includes/add_new_row.js"></script>
<link rel="stylesheet" type="text/css" href="date_range_picker/basic_date_picker_style.css" />
 <link rel="stylesheet" type="text/css" media="all" href="date_range_picker/daterangepicker.css" />
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

 
<title>Tenders Search : Rainbow Tender Managment</title>


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

    
      
      <script type="text/javascript" src="date_range_picker/date.js"></script>
      <script type="text/javascript" src="date_range_picker/daterangepicker.js"></script>
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
<span id="title_work_page"><?php if($_GET['val']!="") echo "Update "; ?>Tenders List</span>
<div id="working-sub-main">
<div id="working-panel" style="width:1250px;">

<form method="GET" enctype="multipart/form-data" id="formID">
<table id="working-form" cellspacing="10">
<tr>
<td><label for="select_office">Tender Office</label></td>
<?php $select_office_opt = "_".$_GET['tender_office']."_O"; 
$$select_office_opt = "Selected='selected'";
?>
<td><select id="tender_office" name="tender_office" class="Xtext-input">
    <option value="%%">All</option>
<?php 
foreach($list_office as $liOfce)
{
	?>
  <option value="<?=$liOfce['id'];?>" <?=${"_".$liOfce['id']."_O"};?>><?=$liOfce['office_code'];?></option>
  <?php
  
}
?>
</select></td>
</tr>
<tr>
<?php $select_p_opt = "_".$_GET['tender_purchaser']."_P"; 
$$select_p_opt = "Selected='selected'";

?>
<td><label for="select_purchaser">Select Purchaser</label></td>
<td><select id="tender_purchaser" name="tender_purchaser" class="Xtext-input">
  <option value="%%">All</option>
  <?php

foreach($list_purchaser as $listP)
{
	?>
  <option value="<?=$listP['id'];?>" <?=${'_'.$listP['id'].'_P'};?>><?=$listP['purchaser_short_name'];?></option>
  <?php
  
}
?>
</select></td>
</tr>
<tr>
<td><label for="tender_number">Tender Number</label></td>
<td><input type="text" id="tender_number" name="tender_number" placeholder="Tender Number" /></td>
</tr>

<tr>
<td>

<label for="tender_due_date">Due Date Range</label></td>
<td><input type="text" name="reservation" id="reservation"  value=""/>
 <script type="text/javascript">
  var $mk = jQuery.noConflict();
       $mk(document).ready(function() {
       $mk('#reservation').daterangepicker();
               });
               </script>
</td>
</tr>
<tr>
<td><label for="value_range">Value Range</label></td>
<td><input type="text" style="width:90px;" class="class_for_only_numeric_values" placeholder="Min Range" name="min_range" id="min_range"/>&nbsp;<font style="font-size:12px;">To</font><input type="text" style="width:90px;" name="max_range" id="max_range" placeholder="Max Range" class="class_for_only_numeric_values" /></td>
</tr>
<tr>
<td><label for="select_status">Item Category</label></td>
<?php $Item_Opt = "_".$_GET['item_category']."_IT"; 
      $$Item_Opt = "selected='selected'";
?>
<td><select id="item_category" name="item_category" class="Xtext-input">
<option value="%%">All</option>
<?php foreach($list_item_category as $PITM) 
{
	?>
    <option value="<?=$PITM['id'];?>" <?=${'_'.$PITM['id'].'_IT'};?>><?=$PITM['item_name'];?></option>
    <?php
}
?>
</select>
</td>
</tr>
<tr>
<td><label for="tender_item_discription">Product Discription</label></td>
<td><input type="text" id="item_discription" name="item_discription" placeholder="Product Discription" /></td>
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
<tr><th style="width:85px;">Purchaser</th><th style="width:160px;">Tender No.</th><th style="width:130px;">Tender Type</th><th style="width:250px;">Product Discription</th><th style="width:150px;">Due Date/Time</th><th style="width:100px">Due Days</th>
<!--
<th style="width:100px">Get Print</th><th style="width:100px;">Action</th>--><th style="width:50px">Info</th></tr>
<?php
foreach($list_tender as $v)
{
	$dday=$obj->TotalDays($v['tender_due_date'],$_GET['st']);
	
	
	if($dday=="Tender Lapsed")
	{
		$madeStyle="c6c4c4";
	}
	else
	{
		if($v['tender_type']==0)
		$madeStyle="90b5ec";
		if($v['tender_type']==1)
		$madeStyle="69f68c";
		if($v['tender_type']==2)
		$madeStyle="f85353";
		if($v['tender_type']==3)
		$madeStyle="9378e6";
		if($v['tender_type']==4)
		$madeStyle="f6f67b";
		
	}
//MAKING CONDITION FOR NOT SHOWING LAPSED TENDER MORE THAN 5 DAYS	

//if($dday!=false)
//{	
 
	?>
    
    <tr style="background:#<?php echo $madeStyle; ?>">
    <td style="border:0px solid #666; height:35px;"><?=$v['purchaser_short_name'];?></td>
    <td style="border:0px solid #666; height:35px;"><?=$v['tender_number'];?></td>
    <td style="border:0px solid #666; height:35px;">
	<?php 
	if($v['tender_type']==0)
	echo "Advertise";
	if($v['tender_type']==1)
	echo "Limited";
	if($v['tender_type']==2)
	echo "Bulletin";
	if($v['tender_type']==3)
	echo "SPL Limited";
	if($v['tender_type']==4)
	echo "Local Purchaser";
	?>
	</td>
    <td style="border:0px solid #666; height:35px;">
	<?php 
	if(isset($v['tender_time']))
	{
		$table_dis = 'tender_firm_product';
	}
	else
	{
		$table_dis = 'history_tender_firm_product';
	}
	$display_dis=$obj->display_discription_history_curent($v['id'],$table_dis); ?>
<?php 
$display_length = strlen($display_dis);
if($display_length>50)
$display_display = substr($display_dis,0,50)."..";	
else
$display_display = $display_dis;
?>
<a style="text-decoration:none;color:#000000;" href="#" title="<?php echo $display_dis; ?>"><?php echo $display_display; ?></a>
    </td>
    <td style="border:0px solid #666; height:35px;">
	<?php $dd_date=explode('-',$v['tender_due_date']); ?>
	<?php echo $dd_date[2].'-'.$dd_date[1].'-'.$dd_date[0]; ?>/<?=$v['tender_time'];?></td>
    
    <td style="border:0px solid #666; height:35px;">
	<?php 
	if(isset($v['tender_time']))
	{
	echo $dday; 
	}
	else
	{
	echo 'History Tender';	
	}
	?>
	</td>
    <!------------------------
    <td>
    <?php 
	
		//if($v['status']==0)
		//{
			//$href="print_tender.php?id=".$v['id']."&p=".$mk['id']."&val=".$_GET['val'];
		//}
		//else
		//{
			//$href="tabulation_stmt.php?id=".$v['id'];
			
		//}
	?>
    <a href="<?//=$href;?>" target="_blank"><img src="main_images/inprint.png"/></a>
    
    
    </td>
    <!--------------------------->
    <!-----------------------
    <?php /*if($_GET['st']==152) 
	{
		$href='tender_quot_pending.php';
	}
	else
	{
		//$href='tender_quot_new.php';
	}*/
	?>
    <td style="border:0px solid #666; height:35px;"><?php //$pro=$obj->CommonCheck('tender_firm_product','tender_id',$v['id']); ?><?php //if($pro[0]==""){ ?><a href="#" style="text-decoration:none; cursor:none;color:#900;"><img src="main_images/no-proceed.png"/></a> <?php //} else
	//{ if($dday=='Tender Lapsed' && ($_GET['st']==150 || $_GET['st']==151)) { ?> <a href="#" style="text-decoration:none;"><img src="main_images/no-proceed.png"/></a> <?//php //} else { ?><a href="<?//=$href;?>?id=<?//=$v['id'];?>&val=<?php// echo $madeStyle; ?>" style="text-decoration:none; cursor:pointer; color:#000;"><img src="main_images/proceed.png"/></a><?php //} }?></td>
    <!------------------------>
    <td style="border:0px solid #666; height:35px;">
    <?php if(isset($v['tender_time'])) 
	{
		$slide_to_open = '_tender_info.php';
	}
	else
	{
		$slide_to_open='_tender_info_of_history.php';
	}
	?>
    <a href="javascript:$X.pageslide({ direction: 'left', href: '<?=$slide_to_open;?>?id=<?=$v['id'];?>&val=<?php echo $madeStyle; ?>' })" style="text-decoration:none; color:#000; text-align:right;">
    Show
    </a>
    </td>
    </tr>
    
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
</html>>>>>