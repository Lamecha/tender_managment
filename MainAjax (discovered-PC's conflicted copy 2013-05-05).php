<?php
session_start();
include("main_includes/main_class.php");
$obj = new main_front_class();
if(isset($_GET['PinNumber'])&& $_GET['PinNumber']!="")
{
	$result_pop_up=$obj->MsgPopUp($_GET['PinNumber'],$_GET['Table']);
	
		
		echo "<span class='response_span'>Name: ".$result_pop_up[0][$result_pop_up[1]."_first_name"]."</span><br/>";
		if($result_pop_up[1]!="admin")
		{
			$office_name = $obj->Common_name_id('office','office_name',$result_pop_up[0][$result_pop_up[1]."_office"]);
		echo "Office: ".$office_name['office_name']."<br/>";
		}
		if($result_pop_up[1]!='admin')
		{
			echo "<a href='profilepage.php?p=".$result_pop_up[1]."&val=".$result_pop_up[0]['id']."&a=".$_GET['url']."' class='response' title='".$result_pop_up[1][1]."'>View Profile</a>";
		//	http://localhost/tender/create_officer.php?val=16
		}
		
	
	
}

if(isset($_GET['delid'])==1 && $_GET['delid']!=" " && isset($_GET['tablename'])==1 && $_GET['tablename']!=" ")
{
	$ss=$obj->DelRecord($_GET['delid'],$_GET['tablename'],$_GET['subtable1'],$_GET['subcolmn1'],$_GET['subtable2'],$_GET['subcolmn2']);
	if($ss==0)
	{
		//echo json_encode("yes");
		echo "no";
	}
	else
	{
		echo "yes";
		//echo json_encode("no");
	}
}
if(isset($_GET['sn']) && $_GET['pi']!="")
{
	$pp  = $obj->CheckShortNameOnPurchase($_GET['sn'],$_GET['pi'],$_GET['for_hide_id']);
	echo $pp;
}


if(isset($_GET['dir_name']) && $_GET['dir_name']!="" && isset($_GET['dir_id']) && $_GET['dir_id']!="")
{
	$obj->Update_Directors($_GET['dir_name'],$_GET['pan'],$_GET['dir_mobile'],$_GET['dir_id']);
	$record_front = $obj->RecordInFront($_GET['dir_id']);
	?>
	<td style="border:1px solid #696969;height:25px; width:180px; font-size:12px"><?php print_r($record_front['csign_director']); ?></td><td style="border:1px solid #696969; height:25px;width:180px; font-size:12px"><?php print_r($record_front['csign_pan_number']); ?></td><td style="border:1px solid #696969; height:25px;width:180px; font-size:12px"><?php print_r($record_front['csign_tel_number']); ?></td>
	<?php
}
if(isset($_GET['purchaser_post_name']) && $_GET['purchaser_post_name']!="" && isset($_GET['id']) && $_GET['id']!="")
{
	$obj->purchase_Update_Directors($_GET['id'],$_GET['purchaser_post_name'],$_GET['purchaser_office_name'],$_GET['purchaser_tel'],$_GET['purchaser_mob'],$_GET['purchaser_residence'],$_GET['purchaser_fax'],$_GET['purchaser_email'],$_GET['purchaser_deals']);
	$record_front_purchaser = $obj->common_fetchdata('purchaser_director',$_GET['id']);
	?>
    <td style="border:1px solid #696969;height:25px; width:120px; font-size:12px"><?php if($record_front_purchaser['purchaser_post_name']=="") { echo "&nbsp;"; } print_r($record_front_purchaser['purchaser_post_name']) ?></td><td style="border:1px solid #696969; height:25px;width:120px; font-size:12px"><?php if($record_front_purchaser['purchaser_office_name']=="") { echo "&nbsp;"; } print_r($record_front_purchaser['purchaser_office_name']) ?></td><td style="border:1px solid #696969; height:25px;width:120px; font-size:12px"><?php if($record_front_purchaser['purchaser_tel']=="") { echo "&nbsp;"; } print_r($record_front_purchaser['purchaser_tel']) ?></td>
 <td style="border:1px solid #696969; height:25px;width:120px; font-size:12px"><?php if($record_front_purchaser['purchaser_mob']=="") { echo "&nbsp;"; } print_r($record_front_purchaser['purchaser_mob']) ?></td>
 <td style="border:1px solid #696969; height:25px;width:120px; font-size:12px"><?php if($record_front_purchaser['purchaser_residence']=="") { echo "&nbsp;"; } print_r($record_front_purchaser['purchaser_residence']) ?></td>
 <td style="border:1px solid #696969; height:25px;width:120px; font-size:12px"><?php if($record_front_purchaser['purchaser_fax']=="") { echo "&nbsp;"; } print_r($record_front_purchaser['purchaser_fax']) ?></td>
 <td style="border:1px solid #696969; height:25px;width:120px; font-size:12px"><?php if($record_front_purchaser['purchaser_email']=="") { echo "&nbsp;"; } print_r($record_front_purchaser['purchaser_email']) ?></td>
 <td style="border:1px solid #696969; height:25px;width:120px; font-size:12px"><?php if($record_front_purchaser['purchaser_deals']=="") { echo "&nbsp;"; } print_r($record_front_purchaser['purchaser_deals']) ?></td> 
    <?php
}
if(isset($_GET['main_cnsige_id']) && $_GET['main_cnsige_id']!="")
{
	$obj->Update_Main_Cnsigee_Directors($_GET['contact_postname'],$_GET['contact_officername'],$_GET['contact_telephone'],$_GET['contact_mobile'],$_GET['contact_residence'],$_GET['contact_fax'],$_GET['contact_email'],$_GET['contact_deal'],$_GET['main_cnsige_id']);
	$record_front = $obj->common_fetchdata('main_consignee_contacts',$_GET['main_cnsige_id']);
	?>
    <td style="border:1px solid #696969;height:25px; width:120px; font-size:12px"><?php if($result_director[$i]['contact_postname']=="") { echo "&nbsp;"; } print_r($record_front['contact_postname']); ?></td>
	<td style="border:1px solid #696969;height:25px; width:120px; font-size:12px"><?php if($result_director[$i]['contact_officername']=="") { echo "&nbsp;"; } print_r($record_front['contact_officername']); ?></td>
    <td style="border:1px solid #696969;height:25px; width:120px; font-size:12px"><?php if($result_director[$i]['contact_telephone']=="") { echo "&nbsp;"; } print_r($record_front['contact_telephone']); ?></td>
    <td style="border:1px solid #696969;height:25px; width:120px; font-size:12px"><?php if($result_director[$i]['contact_mobile']=="") { echo "&nbsp;"; } print_r($record_front['contact_mobile']); ?></td>
    <td style="border:1px solid #696969;height:25px; width:120px; font-size:12px"><?php if($result_director[$i]['contact_residence']=="") { echo "&nbsp;"; } print_r($record_front['contact_residence']); ?></td>
    <td style="border:1px solid #696969;height:25px; width:120px; font-size:12px"><?php if($result_director[$i]['contact_fax']=="") { echo "&nbsp;"; } print_r($record_front['contact_fax']); ?></td>
    <td style="border:1px solid #696969;height:25px; width:120px; font-size:12px"><?php if($result_director[$i]['contact_email']=="") { echo "&nbsp;"; } print_r($record_front['contact_email']); ?></td>
    <td style="border:1px solid #696969;height:25px; width:120px; font-size:12px"><?php if($result_director[$i]['contact_deal']=="") { echo "&nbsp;"; } print_r($record_front['contact_deal']); ?></td>
	<?php
}
if(isset($_GET['purchaserID']) && $_GET['purchaserID']!="")
{
	echo $obj->List_Drop_down_onSelection('main_consignee','main_csign_short_name','main_csign_purchaser',$_GET['purchaserID']);
}
if(isset($_GET['PRODUCTID']))
{
	if($_GET['firm']=="")
	{
	echo "<font class='error'>There's some error..</font>";	
	}
	else
	{
	 $obj->StoreFirmsWithProducts($_GET['firm'],$_GET['consignee'],$_GET['inspection'],$_GET['quantity'],$_GET['unit'],$_GET['tdc'],$_GET['emd'],$_GET['rate'],$_GET['taxtype'],$_GET['taxper'],$_GET['taxamount'],$_GET['disper'],$_GET['disamount'],$_GET['othercharg'],$_GET['validday'],$_GET['payment'],$_GET['delperod'],$_GET['delschedule'],$_GET['remark'],$_GET['spinate'],$_GET['PRODUCTID']);
	 echo  "<font class='success'>Firm added successfully</font>"; 
	}
}
 if(isset($_POST['firm_id_tender']) && $_POST['firm_id_tender']!='')
 {
	 $result_firm_tender=$obj->Schedule_Peride($_POST['firm_id_tender']);
	echo json_encode($result_firm_tender);
	 
 }
 if(isset($_GET['pidProductFirm']) && $_GET['pidProductFirm']!='')
 {
	 $update_product_firm=$obj->UpdateProductFirm($_GET['category'],$_GET['inspection'],$_GET['discription'],$_GET['consignee'],$_GET['quantity'],$_GET['unitX'],$_GET['pidProductFirm']);
	 $mj=$obj->ProductFirmAfterUpdate($_GET['pidProductFirm']);
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
//purchaser='+purchaser+'&oldtenderno
if(isset($_POST['purchaser']) && $_POST['purchaser']!='' && $_POST['oldtenderno'] && $_POST['oldtenderno']!='')
{
	$result_record_tender=$obj->OldTenderSearch($_POST['purchaser'],$_POST['oldtenderno'],$_POST['parent_table']);
	//$result_record_tender[1]=$obj->OldTenderProducts($result_record_tender[0][1]);
	//echo json_encode($result_record_tender);
	if($_POST['parent_table']=='tender')
	{
	$bigString=$result_record_tender['id'].":~".$result_record_tender['tender_sample'].":~".$result_record_tender['tender_tdc'].":~".$result_record_tender['tender_emd'].":~".$result_record_tender['tender_criteria']."|||";
	}
	if($_POST['parent_table']=='history_tender')
	{
$bigString=$result_record_tender['id'].":~".$result_record_tender['tender_sample']."|||";
	}
	
	$result_tender_product=$obj->OldTenderProducts($result_record_tender['id'],$_POST['product_table']);
	foreach($result_tender_product as $ds)
	{
		$item_catch=$ds['item_name'].':-'.$ds['item_discription'].':'.'('.$ds['item_id'].')';
		$bigString .= $ds['id'].":~";
		$bigString .= $ds['tender_id'].":~";
		$bigString .= $item_catch.":~";
		$bigString .= $ds['inspection'].":~";
		$bigString .= $ds['discription'].":~";
		$bigString .= $ds['consignee'].":~";
		$bigString .= $ds['quantity'].":~";
		$bigString .= $ds['unit'].":~";
		$bigString .= "%$";
	}
	$bigString .='|||';
	$result_tender_attachements=$obj->OldTenderAttachements($result_record_tender['id'],$_POST['attachement_table']);
	foreach($result_tender_attachements as $vs)
	{
		$bigString .= $vs['id'].":~";
		$bigString .= $vs['tender_id'].":~";
		$bigString .= $vs['title'].":~";
		$bigString .= $vs['file'].":~";
		$bigString .= $vs['file_real_name'].":~";
		$bigString .= $vs['other_title'].":~";
		$bigString .= "%$";
	}
	$bigString .='|||';
	/*$result_limited_firm_tender=$obj->OldTenderLimitedFirm($result_record_tender['id']);
	foreach($result_limited_firm_tender as $LF)
	{
		$bigString .= $LF['id'].":~";
		$bigString .= $LF['tender_id'].":~";
		$bigString .= $LF['firm_id'].":~";
		$bigString .= $LF['csign_short_name'].":~";
		$bigString .= "%$";
	}*/
	
	
	echo $bigString;
	//echo json_encode(($result_record_tender[1]));
	
}
if(isset($_GET['firm_update_select']) && $_GET['firm_update_select']!='' && isset($_GET['LimitedFI']) && $_GET['LimitedFI']!='')
{
	$update_limited_firm=$obj->UpdateLimitedFirm($_GET['firm_update_select'],$_GET['LimitedFI']);
	 $Xj=$obj->LimitedFirmAfterUpdate($_GET['LimitedFI']);
	 ?>
     <td><input type="text" readonly="readonly" value="<?=$Xj['csign_short_name'];?>" /></td>
     <?php
}
if(isset($_GET['tender_number']) && $_GET['tender_number']!='' && isset($_GET['purchaser_id_tn']) && $_GET['purchaser_id_tn']!='')
{
	$AvailableTNo = $obj->CheckAvailabeTenderNumber($_GET['tender_number'],$_GET['purchaser_id_tn'],$_GET['edit_id_tender_p']);
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
if(isset($_GET['printed_firm_id_for_bid_to_del']))
{
	$tfj=$obj->DeletedRecordJustIdTable('bid_number_printed_firm',$_GET['printed_firm_id_for_bid_to_del'],$_GET['tender_id_at_printed_firm_time']);
	if($tfj==1)
	{
		echo '1';
	}
	else
	{
		echo 0;
	}
}
if(isset($_GET['Tender_id_for_po_statement']) && $_GET['Tender_id_for_po_statement']!='')
{
	$result_firm_tender=$obj->Purchaser_office_name_id_in_po_statement($_GET['Tender_id_for_po_statement']);
	$dynamic_name = $obj->DynamicFileNumber($result_firm_tender['office_code']);
	
	//$bigString=$result_firm_tender['tender_office'].":~".$result_firm_tender['tender_purchaser'].":~".$result_firm_tender['purchaser_short_name'].":~".$result_firm_tender['office_code']."|||";
	$bigString=$result_firm_tender['tender_office'].":~".$result_firm_tender['tender_purchaser'].":~".$result_firm_tender['purchaser_short_name'].":~".$result_firm_tender['office_code']."|||";
	$myFirmsInTenderInPoCase = $obj->List_All_Firms_In_Po_Section_In_we_have_tender_id($_GET['Tender_id_for_po_statement']);
	$bigString .=$myFirmsInTenderInPoCase."|||";
	$bigString .=$dynamic_name;
	echo $bigString;
	
	
	
}
if(isset($_GET['firm_list_if_Po_option_2_Or_3_Select']) && $_GET['firm_list_if_Po_option_2_Or_3_Select']!='')
{
	echo $obj->List_All_Firms_In_Po_Section();
}
if(isset($_GET['Add_Old_Products_In_Po_Section_Firm_Id']))
{
	$result_tender_productX=$obj->AddOldProductsInPoSectionWithTenderAndFirmId($_GET['Add_Old_Products_In_Po_Section_Firm_Id'],$_GET['Add_Old_Products_In_Po_Section_Tender_Id']);
	foreach($result_tender_productX as $dsX)
		{
		$item_catchX=$dsX['item_name'].':-'.$dsX['item_discription'].':'.'('.$dsX['item_id'].')';
		//$bigStringX .= $dsX['id'].":~";
		//$bigStringX .= $dsX['tender_id'].":~";
		$bigStringX .= $item_catchX.":~";
		$bigStringX .= $dsX['inspection_in_firm'].":~";
		$bigStringX .= $dsX['discription'].":~";
		$bigStringX .= $dsX['consignee'].":~";
		$bigStringX .= $dsX['quantity'].":~";
		$bigStringX .= $dsX['unit'].":~";
		$bigStringX .= $dsX['rate'].":~";
		$bigStringX .= $dsX['taxtype'].":~";
		$bigStringX .= "%$";
	}
	$bigStringX .='|||';
	$result_tender_attachementsX=$obj->OldTenderAttachements($_GET['Add_Old_Products_In_Po_Section_Tender_Id'],'tender_attachments');
	foreach($result_tender_attachementsX as $vsX)
	{
		$bigStringX .= $vsX['id'].":~";
		$bigStringX .= $vsX['tender_id'].":~";
		$bigStringX .= $vsX['title'].":~";
		$bigStringX .= $vsX['file'].":~";
		$bigStringX .= $vsX['file_real_name'].":~";
		$bigStringX .= $vsX['other_title'].":~";
		$bigStringX .= "%$";
	}
	echo $bigStringX;
	
	
	
}
if(isset($_GET['GetFirmNameInPoSecondOptionHere']) && $_GET['GetFirmNameInPoSecondOptionHere']!='')
{
$dynamicX_nameX = $obj->DynamicFileNumber($_GET['GetFirmNameInPoSecondOptionHere']);
echo $dynamicX_nameX;	
}