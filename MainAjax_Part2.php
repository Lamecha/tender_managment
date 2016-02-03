<?php
session_start();
include("main_includes/main_class.php");
$obj = new main_front_class();
if(isset($_GET['Update_Products_in_Po_History']) && $_GET['Update_Products_in_Po_History']!='')
 {
	 $update_product_firm=$obj->UpdateProductPoInHistory($_GET['category'],$_GET['inspection'],$_GET['discription'],$_GET['consignee'],$_GET['quantity'],$_GET['unitX'],$_GET['tax_type'],$_GET['tax'],$_GET['rate'],$_GET['pidProductFirm']);
	 $mj=$obj->ProductPoHistoryAfterUpdateInAjaxPage($_GET['pidProductFirm']);
	 $my_unit=$obj->unit($mj['unit']);
	 $my_inspection=$obj->inspection($mj['inspection']);
	 $my_taxtype=$obj->taxType_in_Po($mj['tax_type']);
	?>
    <td><input type="text" name="category_update[]" style="width:200px;" class="kareena" value="<?=$mj['item_name'].":-".$mj['item_discription'];?>" id="category_update_0" readonly="readonly" />
    </td>
    <td><input type="text" id="inspection_update_0" name="inspection_update[]" class="selectD" style="width:120px;" value="<?php echo $my_inspection;?>" readonly="readonly" />
    </td>
    <td>
    <input type="text" name="discription_update[]" class="kareena" id="discription_update_0" readonly="readonly" value="<?=$mj['discription'];?>" style="width:200px;"  />
    </td>
    <td>
    <input type="text" id="consignee_update_0" name="consignee_update[]" class="selectD" readonly="readonly" value="<?=$mj['main_csign_short_name'];?>" style="width:120px;" >
    </td> 
    <td><input type="text" name="quantity_update[]" id="quantity_update_0" style="width:120px;" readonly="readonly" value="<?=$mj['quantity'];?>"/></td>
    <td><input type="text" name="unit_update[]" id="unit_update_0" style="width:120px;" class="selectD" value="<?php echo $my_unit;  ?>" readonly="readonly"/></td>
     <td><input type="text" name="tax_type_update[]" id="tax_type_update_0" style="width:150px;" class="selectD" value="<?php echo $my_taxtype;  ?>" readonly="readonly"/></td>
      <td><input type="text" name="tax_update[]" id="tax_update_0" style="width:150px;" class="selectD" value="<?=$mj['tax'];?>" readonly="readonly"/></td>
       <td><input type="text" name="rate_update[]" id="rate_update_0" style="width:150px;" class="selectD" value="<?=$mj['rate'];?>" readonly="readonly"/></td>
    <?php
}

if(isset($_GET['check_available_tender_number_in_history_section']) && $_GET['check_available_tender_number_in_history_section']!='')
{
	$AvailableTNo = $obj->CheckAvailabeTenderNumberInHistory($_GET['tender_number'],$_GET['purchaser_id_tn'],$_GET['edit_id_tender_p']);
	if($AvailableTNo==1)
	{
		echo '&nbsp;<font class="success">Available</font>';
		?>
        <input type="hidden" id="HidenAvailableTender" value="1" />
        <?php
	}
	else
	{
		echo '&nbsp;<font class="error">Not available</font>';
		?>
        <input type="hidden" id="HidenAvailableTender" value="0" />
        <?php
	}
	
}
if(isset($_GET['Update_products_In_tender_History']) && $_GET['Update_products_In_tender_History']!='')
 {
	 $update_product_firm=$obj->UpdateProductFirmInHis($_GET['category'],$_GET['inspection'],$_GET['discription'],$_GET['consignee'],$_GET['quantity'],$_GET['unitX'],$_GET['pidProductFirm']);
	 $mj=$obj->ProductFirmAfterUpdateInHis($_GET['pidProductFirm']);
	 $my_unit=$obj->unit($mj['unit']);
	 $my_inspection=$obj->inspection($mj['inspection']);
	?>
    <td><input type="text" name="category_update[]" style="width:200px;" class="kareena" value="<?=$mj['item_name'].":-".$mj['item_discription'];?>" id="category_update_0" readonly="readonly" />
    </td>
    <td><input type="text" id="inspection_update_0" name="inspection_update[]" class="selectD" style="width:120px;" value="<?php echo $my_inspection;?>" readonly="readonly" />
    </td>
    <td>
    <input type="text" name="discription_update[]" class="kareena" id="discription_update_0" readonly="readonly" value="<?=$mj['discription'];?>" style="width:200px;"  />
    </td>
    <td>
    <input type="text" id="consignee_update_0" name="consignee_update[]" class="selectD" readonly="readonly" value="<?=$mj['main_csign_short_name'];?>" style="width:120px;" >
    </td> 
    <td><input type="text" name="quantity_update[]" id="quantity_update_0" style="width:120px;" readonly="readonly" value="<?=$mj['quantity'];?>"/></td>
    <td><input type="text" name="unit_update[]" id="unit_update_0" style="width:120px;" class="selectD" value="<?php echo $my_unit;  ?>" readonly="readonly"/></td>
    <?php
}
?>