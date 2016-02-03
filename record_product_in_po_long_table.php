<?php 
session_start();
require_once("main_includes/main_class.php");
$obj = new main_front_class();
if(isset($_GET['val']) && $_GET['val']!="")
{
	//$result = $obj->attach_records_tender($_GET['val'],$_GET['table'],$_GET['field']);
	$result = $obj->common_fetch_attachement_withItem_In_PO_NO_Limit_Final($_GET['table'],$_GET['field'],$_GET['val']);
	$list_consignee_edit=$obj->List_Drop_down_onSelection_noAjax('main_consignee','main_csign_short_name','main_csign_purchaser',$_GET['purchaser']);
	//$list_purchaser = $obj->List_Drop_Down("create_purchaser","purchaser_short_name","id");
	
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="main_includes/add_new_row.js"></script>
<script type="text/javascript" src="main_js/AjaxJavaSCript.js"></script>
<link rel="stylesheet" href="main_css/main_css.css"/>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
<style type="text/css">
</style>
<title>Officers : Rainbow Tender Managment</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript">

	$(document).ready(function()
	{
		$('table#multipels td a.delete').click(function()
		{
			var delid=$(this).attr('id');
			
			var tablename="po_products";
			if (confirm("Are you sure you want to delete this row?"))
			{
				var id = $(this).parent().parent().attr('id');
				
				var data = 'id=' + id ;
				var parent = $(this).parent().parent();

				$.ajax(
				{
					   type: "GET",
					   
					   url: "MainAjax.php?delid="+delid+"&tablename="+tablename,
					   data: data,
					   cache: false,
					
					   success: function()
					   {
							window.opener.$('#multipels #update_row'+delid).remove();
							parent.fadeOut('slow', function() {$(this).remove();});
					   }
				 });				
			}
		});
		
		// style the table with alternate colors
		// sets specified color for every odd row
		//$('table#multipels tr:odd').css('background',' #FFFFFF');
	});
	
</script>
<script>
function Edit_Directors(ss)
{
	window.location="record_product_in_po_long_table.php?val=<?=$_GET['val'];?>&table=<?=$_GET['table'];?>&field=<?=$_GET['field'];?>&purchaser=<?=$_GET['purchaser'];?>&km=km&tb_row="+ss;
	
}
</script>
<script>
function Edit_Directors_2()
{
	
	var category = document.getElementById('category_update_0_X').value;
	var inspection = document.getElementById('inspection_update_0_X').value;
	var discription = document.getElementById('discription_update_0_X').value;
	var consignee = document.getElementById('consignee_update_0_X').value;
	var quantity = document.getElementById('quantity_update_0_X').value;
	var unitX = document.getElementById('unit_update_0_X').value;
	
	
	var pidProductFirm = document.getElementById('pid').value;
	if(category=='' || consignee=='')
	{
		alert('Please select consignee');
		return false;
	}
	else
	{
	
	
	var main_consignee_contactsCall;  
			try
			{
				main_consignee_contactsCall = new XMLHttpRequest();
			}
			catch (e)
			{
				try
				{
					main_consignee_contactsCall = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch (e) 
				{
					try
					{
						main_consignee_contactsCall = new ActiveXObject("Microsoft.XMLHTTP");
					}
					catch (e)
					{
						alert("Your browser broke!");
						return false;
					}
				}
			}	

			main_consignee_contactsCall.onreadystatechange = function()
			{
				if(main_consignee_contactsCall.readyState == 4)
				{
				window.location="record_products_tender.php?val=<?=$_GET['val'];?>&table=<?=$_GET['table'];?>&field=<?=$_GET['field'];?>&purchaser=<?=$_GET['purchaser'];?>";
				window.opener.document.getElementById("update_row"+pidProductFirm).innerHTML=main_consignee_contactsCall.responseText;
				}
			}
	
	main_consignee_contactsCall.open("GET","MainAjax.php?category="+category+"&inspection="+inspection+"&discription="+discription+"&consignee="+consignee+"&quantity="+quantity+"&unitX="+unitX+"&pidProductFirm="+pidProductFirm,true);
	main_consignee_contactsCall.send(null);
}
	
	
}
</script>
<style>
#multipels tr td
{
	background:#06f;
}
</style>
<?php include_once("main_includes/autocompleteMain.html");?> 
</head>
<body style="background:#2ba6cb;">
<table id="multipels" class="attachz">
<caption>Edit/Delete Products</caption>
<?php //if(isset($_GET['km']))
	//{
		?>
     <!--   
        <tr><td style="font-size:16; font-weight:normal; height:20px;background:none;font-family:BebasNeueRegular;">Select Purchaser</td>
         </tr>
         <?php
		// $purc_opt="_".$_GET['purchaser']."_PU";
		 //$$purc_opt="selected='selected'";
		 ?>
         <tr><td><select id="tender_purchaser" name="tender_purchaser" class="validate[required] Xtext-input" onChange="CnsignListonPurchaserChild(this.value);" style="height:25px;width:200px;border:1px solid #696969;">
         <?php //for($i=0;$i<sizeof($list_purchaser);$i++) 
		 //{
		 ?>
          <option value="<?php //print_r($list_purchaser[$i]['id']); ?>" <?PHP // ${'_'.$list_purchaser[$i]['id'].'_PU'}; ?>><?php //print_r($list_purchaser[$i]['purchaser_short_name']); ?></option>
          <?php 
		 //}
		  ?>
         </select></td>
        </tr>
        <?php 
//	}
	?>
    -->
<tr><th style="width:200px;">Item Category</th><th>Item Inspection</th><th style="width:200px;">Item Discription</th><th>Consignee</th><th>Quantity</th><th>Unit</th><th style="width:80px">Rate</th><th style="width:80px">Tax Type</th><th style="width:80px">Including All</th><th style="width:100px">Total Value</th><th style="width:180px;">Payment</th><th style="width:100px;">Paying Autority</th><th style="width:100px;">Inspection Place</th><th style="width:80px;">Delivery Date</th><th style="width:80px;">Quantity</th><!--<th>Edit</th>--><th>Delete</th>
</tr>
<?php
foreach($result as $v)
{
	$my_unit=$obj->unit($v['unit']);
	$my_inspection=$obj->inspection($v['inspection']);
	$my_tax_type=$obj->taxType($v['taxtype']);
	$my_payment=$obj->paymentInPoOpt($v['taxtype']);
	if($v['id']==$_GET['tb_row'])
	{
		
?>
<tr>
<td><input type="text" name="category_update_X[]" style="width:200px; background:#FFF;" class="kareena" value="<?=$v['item_name'].":-".$v['item_discription'].':('.$v['item_id'].')';?>" id="category_update_0_X" />
    </td>
    <td>
    <?php
	$ins_opt='_'.$v['inspection'];
	$$ins_opt="selected='selected'";
	?>
    
    <select id="inspection_update_0_X" name="inspection_update_X[]" class="selectD" >
<option value='1' <?=$_1;?>>RITES</option>
<option value='2' <?=$_2;?>>DQA</option>
<option value='3' <?=$_3;?>>RITES/DQA</option>
<option value='4' <?=$_4;?>>CONSIGNEE</option>
<option value='5' <?=$_5;?>>RDSO</option>
<option value='6' <?=$_6;?>>RITES/Visual</option>
<option value='7' <?=$_7;?>>RITES/MTC & GC</option>
<option value='8' <?=$_8;?>>DQA/Visual</option>
<option value='9' <?=$_9;?>>DQA/MTC & GC</option>
<option value='10' <?=$_10;?>>OTHERS</option>
</select>
   </td>
    <td>
    <textarea rows="3" cols="20" name="discription_update_X[]" style="border:1px solid #666" id="discription_update_0_X"><?=$v['discription'];?></textarea>
    </td>
    <td>
   <?php
   $cons_opt='_'.$v['consignee'].'_C';
   $$cons_opt="selected='selected'";
   ?>
   <select id="consignee_update_0_X" name="consignee_update_X[]" class="selectD">
   <?php for($mz=0;$mz<sizeof($list_consignee_edit);$mz++) { 
 ?>
<option value="<?php print_r($list_consignee_edit[$mz]['id']); ?>" <?=${'_'.$list_consignee_edit[$mz]['id'].'_C'};?>><?php  print_r($list_consignee_edit[$mz]['main_csign_short_name']); ?></option>
<?php }  ?>

</select>
    </td> 
    <td><input type="text" name="quantity_update_X[]" id="quantity_update_0_X" style="width:60px;background:#FFF;" value="<?=$v['quantity'];?>"/></td>
    <td>
    <?php
	$unt_opt='_'.$v['unit'].'_U';
	$$unt_opt="selected='selected'"; 
	?>
    <select  name="unit_update_X[]" id="unit_update_0_X" style="width:60px;" class="selectD"/>
	<option value='1' <?=$_1_U;?>>NOS</option>
	<option value='2' <?=$_2_U;?>>Kg</option>
	<option value='3' <?=$_3_U;?>>Mtr</option>
	<option value='4' <?=$_4_U;?>>Pcs</option>
	<option value='5' <?=$_5_U;?>>Pair</option>
	<option value='6' <?=$_6_U;?>>Yard</option>
	</select>
    </td>
    <td><input type="text" name="rate_update_X[]" id="rate_update_0_X" style="width:60px;background:#FFF;" value="<?=$v['rate'];?>"/></td> 
     <td>
    <?php
	$Rate_opt='_'.$v['rate'].'_RRR';
	$$Rate_opt="selected='selected'"; 
	?>
    <select  name="taxtype_update_X[]" id="taxtype_update_0_X" style="width:80px;" class="selectD"/>
	<option value='1' <?=$_1_RRR;?>>VAT EXTRA</option>
	<option value='2' <?=$_2_RRR;?>>CST EXTRA</option>
	<option value='3' <?=$_3_RRR;?>>VAT INCL</option>
	<option value='4' <?=$_4_RRR;?>>CST INCL</option>
	<option value='5' <?=$_5_RRR;?>>Nil</option>
	
	</select>
    </td>
    <td><input type="text" name="includingall_update_X[]" id="includingall_update_0_X" style="width:80px;background:#FFF;" value="<?=$v['includingall'];?>"/></td> 
        <td><input type="text" name="totalvalue_update_X[]" id="totalvalue_update_0_X" style="width:80px;background:#FFF;" value="<?=$v['totalvalue'];?>"/></td> 
        <td>
         <?php
	$Payment_opt='_'.$v['payment'].'_PPP';
	$$Payment_opt="selected='selected'"; 
	?>
    <select  name="payment_update_X[]" id="payment_update_0_X" style="width:80px;" class="selectD" onChange="ReadOnlyManage(this.value);"/>
	<option value='1' <?=$_1_PPP;?>>100% against supply</option>
	<option value='2' <?=$_2_PPP;?>>98% + 2%</option>
	<option value='3' <?=$_3_PPP;?>>98% + 5%</option>
	<option value='4' <?=$_4_PPP;?>>90% + 10%</option>
    <option value='5' <?=$_5_PPP;?>>Other</option>
	
	
	</select>
        <input type="text" name="paymentother_update_X[]" id="paymentother_update_0_X" style="width:80px;background:#FFF;" value="<?=$v['paymentother'];?>" <?php if($v['payment']!=5){ echo 'readonly="readonly"' ;} ?>/></td>
          <td><input type="text" name="payingauthority_update_X[]" id="payingauthority_update_0_X" style="width:80px;background:#FFF;" value="<?=$v['payingauthority'];?>"/></td> 
            <td><input type="text" name="inspectionplace_update_X[]" id="inspectionplace_update_0_X" style="width:80px;background:#FFF;" value="<?=$v['inspectionplace'];?>"/></td> 
              <td><input type="text" name="deliverydate_update_X[]" id="deliverydate_update_0_X" style="width:80px;background:#FFF;" value="<?=$v['deliverydate'];?>"/></td> 
                <td><input type="text" name="quantitymannual_update_X[]" id="quantitymannual_update_0_X" style="width:80px;background:#FFF;" value="<?=$v['quantitymannual'];?>"/></td> 
<input type="hidden" value="<?=$v['id'];?>" id="pid" name="pid"/>
<td style="text-align:center; border:1px solid #666"><input type="button" class="Save_Button" value="" onClick="Edit_Directors_2()"></td>
<td width="100" style="text-align:center; border:1px solid #666"><a href="#" id="<?=$v['id'];?>" class="delete"><img src="main_images/delete.png" /></a></td>
</tr>

<?php	
}

else
{
?>
<tr>
<td><input type="text" name="category_update[]" style="width:200px; background:#0066ff; border:none;" class="kareena" value="<?=$v['item_name'].":-".$v['item_discription'].':('.$v['item_id'].')';?>" id="category_update_0" readonly />
    </td>
    <td><input type="text" id="inspection_update_0" name="inspection_update[]" class="selectD" style="width:120px;background:#0066ff;border:none;" value="<?php echo $my_inspection;?>" readonly />
    </td>
    <td>
    <input type="text" name="discription_update[]" class="kareena" id="discription_update_0" readonly value="<?=$v['discription'];?>" style="width:200px;background:#0066ff;border:none;"  />
    </td>
    <td>
    <input type="text" id="consignee_update_0" name="consignee_update[]" class="selectD" readonly value="<?=$v['main_csign_short_name'];?>" style="width:120px;background:#0066ff;border:none;">
    </td> 
    <td><input type="text" name="quantity_update[]" id="quantity_update_0" style="width:50px;background:#0066ff;border:none;" readonly value="<?=$v['quantity'];?>"/></td>
    <td><input type="text" name="unit_update[]" id="unit_update_0" style="width:50px;background:#0066ff;border:none;" class="selectD" value="<?php echo $my_unit;?>" readonly/></td>
    <td><input type="text" name="rate_update[]" id="rate_update_0" style="width:50px;background:#0066ff;border:none;" class="selectD" value="<?=$v['rate'];?>" readonly/></td>
    <td><input type="text" name="taxtype_update[]" id="taxtype_update_0" style="width:60px;background:#0066ff;border:none;" class="selectD" value="<?=$my_tax_type;?>" readonly/></td>
    <td><input type="text" name="includingall_update[]" id="includingall_update_0" style="width:60px;background:#0066ff;border:none;" class="selectD" value="<?=$v['includingall'];?>" readonly/></td>
    <td><input type="text" name="totalvalue_update[]" id="totalvalue_update_0" style="width:60px;background:#0066ff;border:none;" class="selectD" value="<?=$v['rate'];?>" readonly/></td>
   <td><input type="text" name="payment_update[]" id="payment_update_0" style="width:100px;background:#0066ff;border:none;" class="selectD" value="<?=$v['payment'];?>" readonly/><input type="text" name="paymentother_update[]" id="paymentother_update_0" style="width:100px;background:#0066ff;border:none;" class="selectD" value="<?=$v['	paymentother'];?>" readonly/></td>
   	  <td><input type="text" name="payingauthority_update[]" id="payingauthority_update_0" style="width:60px;background:#0066ff;border:none;" class="selectD" value="<?=$v['payingauthority'];?>" readonly/></td>
      <td><input type="text" name="inspectionplace_update[]" id="inspectionplace_update_0" style="width:60px;background:#0066ff;border:none;" class="selectD" value="<?=$v['inspectionplace'];?>" readonly/></td>
 <td><input type="text" name="deliverydate_update[]" id="deliverydate_update_0" style="width:60px;background:#0066ff;border:none;" class="selectD" value="<?=$v['deliverydate'];?>" readonly/></td>
  <td><input type="text" name="quantitymannual_update[]" id="quantitymannual_update_0" style="width:60px;background:#0066ff;border:none;" class="selectD" value="<?=$v['quantitymannual'];?>" readonly/></td>
<!--<td style="text-align:center;">
<input type="button" class="edit_button" value="<?//=$v['id']; ?>" onClick="Edit_Directors(this.value);" style="border:none;"/></td>-->    
<td width="100" style="text-align:center;"><a href="#" id="<?=$v['id'];?>" class="delete"><img src="main_images/delete.png" /></a></td>
</tr>

<? } 
}?>

</table>

<br/>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script type="text/javascript" src="main_js/jquery.tablescroll.js"></script>

<script>
/*<![CDATA[*/

jQuery(document).ready(function($)
{
	$('#multipels').tableScroll({height:350});

});

/*]]>*/
</script>
<script>
function ReadOnlyManage(il)
{
	if(il==5)
	{
		document.getElementById('paymentother_update_0_X').readOnly=false;
		// $(this).removeAttr("readonly").blur().focus();
	}
	else
	{
		document.getElementById('paymentother_update_0_X').value='';
		document.getElementById('paymentother_update_0_X').readOnly=true;
	}
}
</script>
</body>
</html>
