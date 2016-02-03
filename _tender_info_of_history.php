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
$tender_details=$obj->common_fetchdata('history_tender',$_GET['id']);
//print_r($tender_details);
//$purchaser_detail=$obj->common_fetchdata('create_purchaser',$tender_details['tender_purchaser']);
$office_detail=$obj->common_fetchdata('office',$tender_details['tender_office']);
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
	$product_details=$obj->attach_records_products_of_tender_in_history($_GET['id'],'history_tender_firm_product','tender_id');
	
	$attachments=$obj->attach_records($_GET['id'],'history_tender_attachments','tender_id');
	//$list_firm = $obj->List_Drop_Down("consignee","csign_firm_name","id");
	//$list_cnsignee = $obj->List_Drop_down_onSelection_noAjax("main_consignee","main_csign_name","main_csign_purchaser",$purchaser_detail['id']);
?>
<!doctype html>
<html lang="en">
<head>
    <style>
	@import 'fonts/fonts.css';
        body {
            font: 14px/18px "HelveticaNeue", "Helvetica Neue", Helvetica, Arial, sans-serif;
            color: #EFEFEF;
        }
        
        #main
		{
			width:200px;
			height:400px;
            margin-top:57px;
		}
		a
		{
			font-size:10px;
			color:#000000;
			
		}
		
</style>
<link rel="stylesheet" href="main_css/main_css.css"/>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
</head>
<body style="background:#<?php echo $_GET['val']; ?>;">
<div id="Xright_old_info" style="width:100%;border-bottom:1px solid #000;">
<div id="Xold_info_span" style="width:100%; margin-top:10px;">
<table style="margin-left:40px;font-size:12px; color:#000000;">
<tr>
<td>Tender No:</td>
<td>&nbsp;<?php print_r($tender_details['tender_number']); ?></td>
</tr>
<tr>
<td>Tender Office</td>
<td>&nbsp;<?php print_r($office_detail['office_name']); ?></td>
</tr>
<tr>
<td>Sample Required:</td>
<td>&nbsp;<?php if($tender_details['tender_sample']==0) { echo 'Yes'; } else { echo 'No'; } ?></td>
</tr>
<tr>
<td>TDC</td>
<td>&nbsp;<?php print_r($tender_details['tender_tdc']); ?></td>
</tr>
<tr>
<td>EMD</td>
<td>&nbsp;<?php print_r($tender_details['tender_emd']); ?></td>
</tr>
</table>
</div>
</div>
<div id="Attachments" style="width:100%;border-bottom:1px solid #000;">
<table style="margin-left:40px;font-size:12px; color:#000000;">
<tr style="border:1px solid #000">
<td style="color:#009;">Download Files</td>
</tr>
<?php
$sm=0;
foreach($attachments as $nj)
{
	$title_value = $obj->Title_In_Tender_Attachements($nj['title']);
	$sm++;
	?>
   <tr><td style="color:#009;"><?php echo $sm; ?> <a style="color:#009;" href="attachements/tender_attach_history/<?=$nj['file'];?>" target="_new"><?=$title_value;?>/<?=$nj['other_title'];?> [<?=$nj['file_real_name'];?>]</a></td></tr>
    <?php
	
}
?>
</table>

</div>
<?php for($i=0;$i<sizeof($product_details);$i++) 
{
?>
<table width="270" id="infos" cellspacing="6" style="color:#000;">
<tr>
<td width="91">Category : </td>
<td width="124"><?php print_r($product_details[$i]['item_name']); ?></td>
</tr>
<tr>
<td width="91">Discription</td>
<?php $product_length = strlen($product_details[$i]['discription']);
      if($product_length>20)
      $product_display = substr($product_details[$i]['discription'],0,20)."..";	
	  else
      $product_display = $product_details[$i]['discription']; ?>
<td width="124"><a href="#" style="text-decoration:none;" title="<?php print_r($product_details[$i]['discription']); ?>"><?php echo $product_display; ?></a></td>
</tr>
<tr>
<td>Inspection : </td>
<?php if($product_details[$i]['inspection']==1){$ins='RITES';} else if($product_details[$i]['inspection']==2){$ins='DQA';}else if($product_details[$i]['inspection']==3){$ins='RITES/DQA';}else if($product_details[$i]['inspection']==4){$ins='CONSIGNEE';}
else if($product_details[$i]['inspection']==5){$ins='RDSO';}
else if($product_details[$i]['inspection']==6){$ins='OTHERS';}else { $ins='';} ?>
<td> <?php echo $ins;  ?></td>

</tr>
<tr>
<td>Consignee : </td>
<td><?php print_r($product_details[$i]['main_csign_short_name']) ?></a></td>

</tr>
<tr>
<td>Quantity : </td>
<td><?php print_r($product_details[$i]['quantity']); ?></td>
<td width="19"></td>
</tr>
<tr>
<td>Unit : </td>
<td>
<?php $show_unit=$obj->unit($product_details[$i]['unit']); ?>
<?php echo $show_unit; ?></td>
</tr>
<tr>
<td colspan="2" style="border:1px solid #000;"></td>
</tr>
</table>

<?php
}
?>
</body>