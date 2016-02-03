

window.idz = 00;
function getVals(id)
{
	document.cookie;
	document.cookie='tp_id='+id;
}
/////////////////UNCOMMET TO RUN AUTOCOMPLETE
/*var $sa = jQuery.noConflict();
$sa(function() {
	//AutoFillTender
//$sa("#presidentsServerInput").autocomplete( { source: "presidents.php"});

$sa(".AutoFillTender").autocomplete( { source: "presidents.php"});

  
		
});*/

//////////////////////////////////////////
var $sa = jQuery.noConflict();
$sa(function() {
	//AutoFillTender
//$sa("#presidentsServerInput").autocomplete( { source: "presidents.php"});
//CheckTenderNumber(this.value),XAddReTenderInfo(this.value)
$sa(".AutoFillTender").autocomplete( { source: "presidents.php" , select: function (event, ui) { AddReTenderInfo(this.value,'tender','tender_firm_product','tender_attachments'); }})

//Concept for Atutofill in History section [May be required to remove]
$sa(".AutoFillTender_In_History").autocomplete( { source: "presidents_history.php" , select: function (event, ui) { AddReTenderInfo(this.value,'history_tender','history_tender_firm_product','history_tender_attachments'); }})

$sa(".AutoFillPo_Section").autocomplete( { source: "presidents_po_section.php" , select: function (event, ui) {
	 AddPoSectionInfo(this.value,'tender','tender_firm_product','tender_attachments'); }})
 

  
		
});
//}

function SaveData(ss)
{
	alert(ss);
}