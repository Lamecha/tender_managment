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
$list_office = $obj->List_Drop_Down("office","office_name","id");
$list_purchaser = $obj->List_Drop_Down("create_purchaser","purchaser_short_name","id");

//if(isset($_GET['hv']) && $_GET['hv']!="")
if(isset($_POST['submit_status']))
{
 $obj->ChangeTenderStatus($_POST['hide_tender_id_status'],$_POST['radio_select']);
}
if(isset($_POST['submit_status_firm']))
{
	$obj->ChangeTenderFirmStatus($_POST['hide_tender_id_status_firm'],$_POST['radio_select_firm']);
}

if(isset($_POST['submit']))
{
	$OT=$_POST['tender_office'];
	$PT=$_POST['tender_purchaser'];
	$ST=$_POST['tender_status'];
	$obj->redirect('tender_list.php?ot='.$OT.'&pt='.$PT.'&st='.$ST);
	$tp =  $obj->TotalPage($_GET['ot'],$_GET['pt'],$_GET['st']);
	
}
else if(isset($_GET['page']) || isset($_GET['ot']))
{
	$OT=$_GET['ot'];
	$PT=$_GET['pt'];
	$ST=$_GET['st'];
	$tp =  $obj->TotalPage($OT,$PT,$ST);
	
}
else
{
	$OT='%%';
	$PT='%%';
	$ST=0;
	$tp =  $obj->TotalPage($OT,$PT,$ST);
}
if(isset($_GET['ot']))
{
	/*if($_GET['st']==0)
	$status='Uploaded';
	if($_GET['st']==1)
	$status='Rate given';
	if($_GET['st']==2)
	$status='Partially Quoted';
	if($_GET['st']==3)
	$status='Quoted';
	if($_GET['st']==4)
	$status='Tender Lapsed';*/
	if($_GET['ot']=="%%")
	{
		$office_name="All";
	}
	else
	{
		$OName=$obj->Common_name_id('office','office_name',$_GET['ot']);
		$office_name=$OName['office_name'];
	}
	if($_GET['pt']=="%%")
	{
		$purchaser_name="All";
	}
	else
	{
		$PName=$obj->Common_name_id('create_purchaser','purchaser_short_name',$_GET['pt']);
		$purchaser_name=$PName['purchaser_short_name'];
	}
}

// get data by page

//if(isset($_GET['page']) || isset($_POST['submit']))
if(isset($_GET['page']) || isset($_GET['ot']))
{
	
	/*$OT=$_POST['tender_office'];
	$PT=$_POST['tender_purchaser'];
	$ST=$_POST['tender_status'];*/
	$OT=$_GET['ot'];
	$PT=$_GET['pt'];
	$ST=$_GET['st'];
$list_tender = $obj->List_Drop_Down_tender($OT,$PT,$ST,$_GET['page']);

}
else
{
	$OT='%%';
	$PT='%%';
	$ST=0;
	$list_tender = $obj->List_Drop_Down_tender($OT,$PT,$ST,0);
	
}

/*************************************************************************
php easy :: pagination scripts set - DEMO
==========================================================================
Author:      php easy code, www.phpeasycode.com
Web Site:    http://www.phpeasycode.com
Contact:     webmaster@phpeasycode.com
*************************************************************************/
$page   = intval($_GET['page']);
$ot=$_GET['ot'];
$pt=$_GET['pt'];
$st=$_GET['st'];
//$tpages = ($_GET['tpages']) ? intval($_GET['tpages']) : 20; // 20 by default
$tpages = $tp;
 $adjacents  = intval($_GET['adjacents']);

if($page<=0)  $page  = 1;
if($adjacents<=0) $adjacents = 4;

$reload = $_SERVER['PHP_SELF'] . "?tpages=" . $tpages . "&amp;adjacents=" . $adjacents;

/*************************************************************************/
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="main_includes/add_new_row.js"></script>

<link rel="stylesheet" href="main_css/main_css.css"/>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="main_css/jquery.pageslide.css" />
<link rel="stylesheet" href="css/styles_po.css">
<link rel="stylesheet" href="css/style_po_firm.css" />


<style type="text/css">
.attachz tr td
{
	font-size:12px;
	padding-left:5px;
	
}

</style>
 
<title>Tenders List : Rainbow Tender Managment</title>


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

<?php include_once("main_includes/date_picker.php");?> 
<script>
function EditUrl(id)
{
	window.location="tender_list.php?hv="+id;
	
}
</script>
<link rel="stylesheet" type="text/css" href="main_css/paginate.css">
</head>
<body>
<?php include_once("main_includes/msg_box.php"); ?>
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
<span id="title_work_page"><?php if($_GET['val']!="") echo "Update "; ?>Tenders List</span>
<div id="working-sub-main">
<div id="working-panel" style="width:1250px;">

<form method="post" enctype="multipart/form-data" id="formID">
<table id="working-form" cellspacing="10">
<tr>
<td><label for="select_office">Select Office</label></td>
<td><select id="tender_office" name="tender_office" class="Xtext-input">
  <?php if(isset($_GET['ot'])) 
{
	?>
   <option value="<?php echo $_GET['ot'];?>"><?php echo $office_name; ?></option>
   <?php if($_GET['ot']!="%%") { ?>
    <option value="%%">All</option>
    <?php } ?>
   
  <?php
}
else
{
	?>
<option value="%%">All</option>
<?php 
 }

for($o=0;$o<sizeof($list_office);$o++)
{
	if($list_office[$o]['id']==$_GET['ot'])
	goto InO;
	?>
  <option value="<?php print_r($list_office[$o]['id']); ?>"><?php print_r($list_office[$o]['office_name']); ?></option>
  <?php
  InO:
}
?>
</select></td>
</tr>
<tr>
<td><label for="select_purchaser">Select Purchaser</label></td>
<td><select id="tender_purchaser" name="tender_purchaser" class="Xtext-input">
  <?php if(isset($_GET['pt'])) 
{
	?>
  <option value="<?php echo $_GET['pt']; ?>"><?php echo $purchaser_name; ?></option>
   <?php if($_GET['pt']!="%%") { ?>
    <option value="%%">All</option>
    <?php } ?>
  <?php
}
else
{
	?>
  <option value="%%">All</option>
  <?php
}
for($p=0;$p<sizeof($list_purchaser);$p++)
{
	if($list_purchaser[$p]['id']==$_GET['pt'])
	goto InP;
	
	?>
  <option value="<?php print_r($list_purchaser[$p]['id']); ?>"><?php print_r($list_purchaser[$p]['purchaser_short_name']); ?></option>
  <?php
  InP:
}
?>
</select></td>
</tr>
<tr>
<td><label for="select_status">Select Status</label></td>

<?php $nxt = "_".$_GET['st']."_TT"; 
      $$nxt = "selected='selected'";
?>
<td><select id="tender_status" name="tender_status" class="Xtext-input" onchange="XEditUrl(this.value);">
<option value="0" <?=$_0_TT; ?>>Uploaded</option>
<option value="150" <?=$_150_TT; ?>>Tender Lapsed [Before Rate Given]</option>
<option value="1" <?=$_1_TT; ?>>Rate Given</option>
<option value="151" <?=$_151_TT; ?>>Tender Lapsed [After Rate Given]</option>
<option value="2" <?=$_2_TT; ?>>Partially Quoted</option>
<option value="3" <?=$_3_TT; ?>>Quoted</option>
<option value="152" <?=$_152_TT; ?>>Pending</option>


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
<table id="multipels" class="attachz" cellspacing="3px;">
<tr><th style="width:85px;">Purchaser</th><th style="width:160px;">Tender No.</th><th style="width:130px;">Tender Type</th><th style="width:250px;">Product Discription</th><th style="width:150px;">Due Date/Time</th><th style="width:100px">Due Days</th><th style="width:100px">Get Print</th><!--<th style="width:130px">Change Status</th><th style="width:130px;">Rate Given Type</th>--><th style="width:100px;">Action</th><th style="width:50px">Info</th></tr>
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
    <td style="border:0px solid #666; height:35px;"><?php $display_dis=$obj->display_discription($v['id']); ?>
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
	//$dday=$obj->TotalDays($v['tender_due_date']);
	echo $dday; ?>
	</td>
    <td>
    <?php 
	//if($v['status']==1 || $v['status']==0) 
	//{
		if($v['status']==0)
		{
			$href="print_tender.php?id=".$v['id']."&p=".$mk['id']."&val=".$_GET['val'];
		}
		else
		{
			$href="tabulation_stmt.php?id=".$v['id'];
			
		}
	?>
    <a href="<?=$href;?>" target="_blank"><img src="main_images/inprint.png"/></a>
    <!--<a href="print_tender.php?id=<?//=$v['id'];?>&p=<?//=$mk['id'];?>&val=<?php //echo $_GET['val']; ?>" target="_blank"><img src="main_images/inprint.png"/></a>-->
    
    </td>
    <?php
	//}
	//else
	//{
		?>
      <!--  <font style="font-size:14px; color:#900">NA</font>-->
        <?php
	//}
	?>
    <?php if($_GET['st']==152) 
	{
		$href='tender_quot_pending.php';
	}
	else
	{
		$href='tender_quot_new.php';
	}
	?>
    <td style="border:0px solid #666; height:35px;"><?php $pro=$obj->CommonCheck('tender_firm_product','tender_id',$v['id']); ?><?php if($pro[0]==""){ ?><a href="#" style="text-decoration:none; cursor:none;color:#900;"><img src="main_images/no-proceed.png"/></a> <?php } else
	{ if($dday=='Tender Lapsed' && ($_GET['st']==150 || $_GET['st']==151)) { ?> <a href="#" style="text-decoration:none;"><img src="main_images/no-proceed.png"/></a> <?php } else { ?><a href="<?=$href;?>?id=<?=$v['id'];?>&val=<?php echo $madeStyle; ?>" style="text-decoration:none; cursor:pointer; color:#000;"><img src="main_images/proceed.png"/></a><?php } }?></td>
    <td style="border:0px solid #666; height:35px;">
    <a href="javascript:$X.pageslide({ direction: 'left', href: '_tender_info.php?id=<?=$v['id'];?>&val=<?php echo $madeStyle; ?>' })" style="text-decoration:none; color:#000; text-align:right;">
    Show
    </a>
    </td>
    </tr>
    
    <?php
}
	$i++;

//}

?>
</table>
</div>
<div style="margin-left:10px;margin-top:0px; margin-bottom:2px; clear:both">
<?php
if(isset($_GET['ot']))
//if(isset($_GET['ot']))
{
 //echo $obj->paginate_three($reload, $page, $tpages, $adjacents,$_GET['hv']);
 	$OT=$_GET['ot'];
	$PT=$_GET['pt'];
	$ST=$_GET['st'];
	echo $obj->paginate_three($reload, $page, $tpages, $adjacents,$OT,$PT,$ST);
}
else
 {
	
	$OT='%%';
	$PT='%%';
	$ST=0;
	 
  echo $obj->paginate_three($reload, $page, $tpages, $adjacents,$OT,$PT,$ST);
 }

 
?>
</div>

</div>

</div>
<!------------POP UP FOR PRINTING---------------->
<!----------------------------------------------------->
<div id="modal">
	<div id="heading" class="p_data">
	</div>
    <div id="content">
		
		<form action="#" method="post">
        <table style="margin-top:0px; margin-left:70px;">
        <tr>
        <td colspan="2" id="number_s" style="font-size:12px; word-wrap:break-word; height:30px; border:1px solid #666; padding-left:3px;"></td>
        </tr>
        <tr>
        <td id="uploaded_colm" style="height:40px; width:80px; border:1px solid #666; padding-left:4px; font-size:12px;"></td>
        <td id="rate_colm" style="height:40px; width:90px; border:1px solid #666; padding-left:4px; font-size:12px;"></td>
        </tr>
        <tr>
        <td><input type="submit" id="submit_status" name="submit_status" value="Save" style="width:100px; height:40px; border:1px solid #333; background:#0F0;color:#FFFFFF;"></td>
        <td>
        <input type="button" class="close" value="Cancle" style="width:100px; height:40px; border:1px solid #333; background:#900; color:#FFFFFF;" /></td>
        </tr>
        </table>
       <input type="hidden" id="hide_tender_id_status" name="hide_tender_id_status" />
		
       
        </form>
	</div>
</div>
<!----------------------------------------------------->  
 
<!------------------POP UP----------------------------->
<!--jQuery-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script src="js/jquery.reveal.js"></script>

	<script type="text/javascript">
		$(document).ready(function() {
			$('.buttonX').click(function(e) {
			var tender_id=$(this).attr('id');
			var id_status = tender_id.split('/');
			var number_s = $(this).attr('name');
			$('#number_s').text(number_s);
			
			var id_only = parseInt(id_status[0]);
			var status_only = parseInt(id_status[1]);
			//var uploaded_check = "checked=false";
			//var rate_check = "checked=false";
			if(status_only==0)
			{
			$('.p_data').text('Current Status is Uploaded');	 
			var uploaded_check = "checked=true"; 
			}
			else
			{
				
			$('.p_data').text('Current Status is Rate Given ');
			var rate_check = "checked=true";
			}
			
			 
			document.getElementById('uploaded_colm').innerHTML="&nbsp;&nbsp;Uploaded<br/><input type='radio' style='margin-left:30px' name='radio_select' value='0' "+uploaded_check+" />";
			document.getElementById('rate_colm').innerHTML="&nbsp;&nbsp;Rate Given<br/><input type='radio' style='margin-left:30px' name='radio_select' value='1' "+rate_check+"/>";
			document.getElementById('hide_tender_id_status').value=id_only;
			   	$('#modal').reveal({ // The item which will be opened with reveal
				  	animation: 'fade',                   // fade, fadeAndPop, none
					animationspeed: 300,                       // how fast animtions are
					closeonbackgroundclick: true,              // if you click background will modal close?
					dismissmodalclass: 'close'    // the class of a button or element that will close an open modal
				});
			return false;
			});
		});
	</script>
  <!-------------------------STATUS FOR FIRMSSSS--------------------------------------->  
  <div id="modal_firm">
	<div id="heading_firm" class="p_data_firm">
	</div>
    <div id="content_firm">
		
		<form action="#" method="post">
        <table style="margin-top:0px; margin-left:70px;">
        <tr>
        <td colspan="2" id="number_f" style="font-size:12px; word-wrap:break-word; height:30px; border:1px solid #666; padding-left:3px;"></td>
        </tr>
        <tr>
        <td id="mannual_colm" style="height:40px; width:80px; border:1px solid #666; padding-left:4px; font-size:12px;"></td>
        <td id="printed_colm" style="height:40px; width:90px; border:1px solid #666; padding-left:4px; font-size:12px;"></td>
        </tr>
        <tr>
        <td><input type="submit" id="submit_status_firm" name="submit_status_firm" value="Save" style="width:100px; height:40px; border:1px solid #333; background:#CCCC33;color:#FFFFFF;"></td>
        <td>
        <input type="button" class="close" value="Cancle" style="width:100px; height:40px; border:1px solid #333; background:#C06;color:#FFFFFF;" /></td>
        </tr>
        </table>
       <input type="hidden" id="hide_tender_id_status_firm" name="hide_tender_id_status_firm" />
		
       
        </form>
	</div>
</div>
  
  <script type="text/javascript">
		$(document).ready(function() {
			$('.buttonFirm').click(function(e) {
			var tender_id_firm=$(this).attr('id');
			var id_status_firm = tender_id_firm.split('/');
			var number_f = $(this).attr('name');
			$('#number_f').text(number_f);
			var id_only_firm = parseInt(id_status_firm[0]);
			var status_only_firm = parseInt(id_status_firm[1]);
			//var uploaded_check = "checked=false";
			//var rate_check = "checked=false";
			if(status_only_firm==0)
			{
			$('.p_data_firm').text('Current Status is Manuual');	 
			var mannual_check = "checked=true"; 
			}
			else
			{
			$('.p_data_firm').text('Current Status is Printed ');
			var printed_check = "checked=true";
			}
			
		document.getElementById('mannual_colm').innerHTML="&nbsp;&nbsp;Mannual<br/><input type='radio' style='margin-left:30px' name='radio_select_firm' value='0' "+mannual_check+" />";
			document.getElementById('printed_colm').innerHTML="&nbsp;&nbsp;Printed<br/><input type='radio' style='margin-left:30px' name='radio_select_firm' value='1' "+printed_check+"/>";
			document.getElementById('hide_tender_id_status_firm').value=id_only_firm;
			   	$('#modal_firm').reveal({ // The item which will be opened with reveal
				  	animation: 'fade',                   // fade, fadeAndPop, none
					animationspeed: 300,                       // how fast animtions are
					closeonbackgroundclick: true,              // if you click background will modal close?
					dismissmodalclass: 'close'    // the class of a button or element that will close an open modal
				});
			return false;
			});
		});
	</script>
 <!------------------------------------------------------------>   
  


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