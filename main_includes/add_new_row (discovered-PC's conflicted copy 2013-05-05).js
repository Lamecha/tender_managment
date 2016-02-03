function add_contacts()
{
	var sm = parseInt(document.getElementById('hide_for_main_consignee').value);
	var add_after = sm-1;
	var counter = sm+1;

var new_row = document.createElement('tr');
new_row.setAttribute("id","first_dirct_"+sm);
var new_td_0  = document.createElement("td");
var new_td_1  = document.createElement("td");
var new_td_2 = document.createElement("td");
var new_td_3  = document.createElement("td");
var new_td_4  = document.createElement("td");
var new_td_5  = document.createElement("td");
var new_td_6  = document.createElement("td");
var new_td_7  = document.createElement("td");
new_td_0.innerHTML = "<input type='text' name='contact_postname[]' style='width:120px'/>";
new_td_1.innerHTML = "<input type='text' name='contact_officername[]' style='width:120px'/>";
new_td_2.innerHTML = "<input type='text' name='contact_telephone[]' style='width:120px'/>";
new_td_3.innerHTML = "<input type='text' name='contact_mobile[]' style='width:120px'/>";
new_td_4.innerHTML = "<input type='text' name='contact_fax[]' style='width:120px'/>";
new_td_5.innerHTML = "<input type='text' name='contact_residence[]' style='width:120px'/>";
new_td_6.innerHTML = "<input type='text' name='contact_email[]' style='width:120px'/>";
new_td_7.innerHTML = "<input type='text' name='contact_deal[]' style='width:120px'/>";
new_row.appendChild(new_td_0);
new_row.appendChild(new_td_1);
new_row.appendChild(new_td_2);
new_row.appendChild(new_td_3);
new_row.appendChild(new_td_4);
new_row.appendChild(new_td_5);
new_row.appendChild(new_td_6);
new_row.appendChild(new_td_7);

insertAfter(document.getElementById('first_dirct_'+add_after), new_row);
document.getElementById('hide_for_main_consignee').value=counter;
}
function add_directors(bef)
{

var new_row = document.createElement('tr');
var new_td_1  = document.createElement("td");
var new_td_2 = document.createElement("td");
var new_td_3  = document.createElement("td");

 
new_td_1.innerHTML = "<input type='text' name='dir_names[]'/>";
new_td_2.innerHTML = "<input type='text' name='pan[]'/>";
new_td_3.innerHTML = "<input type='text' name='dir_mobile[]'/>";


new_row.appendChild(new_td_1);
new_row.appendChild(new_td_2);
new_row.appendChild(new_td_3);

insertAfter(document.getElementById(bef), new_row);
}
function add_directors_after_row_order()
{
	var hide_for_partner = parseInt(document.getElementById('hide_for_partner').value);
	var counter = hide_for_partner+1;
	var add_after = hide_for_partner-1;
var new_row = document.createElement('tr');
new_row.setAttribute('id','first_dirct_'+hide_for_partner);
var new_td_1  = document.createElement("td");
var new_td_2 = document.createElement("td");
var new_td_3  = document.createElement("td");

new_td_1.innerHTML = "<input type='text' name='dir_names[]'/>";
new_td_2.innerHTML = "<input type='text' name='pan[]'/>";
new_td_3.innerHTML = "<input type='text' name='dir_mobile[]'/>";


new_row.appendChild(new_td_1);
new_row.appendChild(new_td_2);
new_row.appendChild(new_td_3);

insertAfter(document.getElementById('first_dirct_'+add_after), new_row);
document.getElementById('hide_for_partner').value=counter;
	
}

function add_directors_purchaser(bef)
{
var ss = parseInt(document.getElementById('hide_for_counter').value);
var counter = ss+1;
var add_after = ss-1;
var new_row = document.createElement('tr');
new_row.setAttribute("id","first_dirct_"+ss);
var new_td_1  = document.createElement("td");
var new_td_2 = document.createElement("td");
var new_td_3  = document.createElement("td");
var new_td_4  = document.createElement("td");
var new_td_5 = document.createElement("td");
var new_td_6  = document.createElement("td");
var new_td_7  = document.createElement("td");
var new_td_8  = document.createElement("td");

 
new_td_1.innerHTML = "<input type='text' name='purchaser_post_name[]' style='width:120px;'/>";
new_td_2.innerHTML = "<input type='text' name='purchaser_office_name[]' style='width:120px;'/>";
new_td_3.innerHTML = "<input type='text' name='purchaser_tel[]' style='width:120px;'/>";
new_td_4.innerHTML = "<input type='text' name='purchaser_mob[]' style='width:120px;'/>";
new_td_5.innerHTML = "<input type='text' name='purchaser_residence[]' style='width:120px;'/>";
new_td_6.innerHTML = "<input type='text' name='purchaser_fax[]' style='width:120px;'/>";
new_td_7.innerHTML = "<input type='text' name='purchaser_email[]' style='width:120px;'/>";
new_td_8.innerHTML = "<input type='text' name='purchaser_deals[]' style='width:120px;'/>";


new_row.appendChild(new_td_1);
new_row.appendChild(new_td_2);
new_row.appendChild(new_td_3);
new_row.appendChild(new_td_4);
new_row.appendChild(new_td_5);
new_row.appendChild(new_td_6);
new_row.appendChild(new_td_7);
new_row.appendChild(new_td_8);

insertAfter(document.getElementById('first_dirct_'+add_after), new_row);
document.getElementById('hide_for_counter').value=counter;
}
function add_mores_firm_regi(bef)
{

var new_row = document.createElement('tr');
var new_td_1  = document.createElement("td");
var new_td_2 = document.createElement("td");
 
new_td_1.innerHTML = "<input type='text' name='titles[]'/>";
new_td_2.innerHTML = "<input type='file' name='files[]'/>";

new_row.appendChild(new_td_1);
new_row.appendChild(new_td_2);

insertAfter(document.getElementById(bef), new_row);
}
function add_mores_firms_with_select()
{
	var np = document.getElementById('hide_for_add_firm').value;
	var dynamic_firm_row = parseInt(np);
	var counter=dynamic_firm_row+1;
	var after_it = dynamic_firm_row-1;

var new_row = document.createElement('tr');
new_row.setAttribute('id','SHAKEB_'+dynamic_firm_row);
var new_td_1  = document.createElement("td");
var select_box = document.createElement('select');
select_box.setAttribute('name','titles[]');
select_box.setAttribute('id','title_'+dynamic_firm_row);
select_box.setAttribute('onchange','IfSelectOtherThenTitle(this.id)');
select_box.setAttribute("style","width:120px;height:30px;border:1px solid #333;")
select_box.innerHTML="<option value=''>Please select</option><option value='1'>NSIC Reg</option><option value='2'>DGS & D Reg</option><option value='3'>DGQA Reg</option><option value='4'>CST/VAT Reg</option><option value='5'>Performance</option><option value='6'>Digital Signature</option><option value='7'>PAN Card</option><option value='8'>Certificate at Incorporation</option><option value='9'>Memorandum at Article</option><option value='10'>Others</option>";

var new_td_2 = document.createElement("td");
var new_td_3 = document.createElement("td");
new_td_3.setAttribute('id','SHAKEB_COLM_'+dynamic_firm_row);
 
//new_td_1.innerHTML = "<input type='text' name='titles[]'/>";
new_td_1.appendChild(select_box);
new_td_2.innerHTML = "<input type='file' name='files[]'/>";
new_td_3.innerHTML = "<input type='hidden' id='text_on_others' name='text_on_others[]'>";


new_row.appendChild(new_td_1);
new_row.appendChild(new_td_2);
new_row.appendChild(new_td_3);

insertAfter(document.getElementById('SHAKEB_'+after_it), new_row);
document.getElementById('hide_for_add_firm').value=counter;
}
function Add_More_Officer_Employee_Attachements()
{
	var np = document.getElementById('hide_for_add_firm').value;
	var dynamic_firm_row = parseInt(np);
	var counter=dynamic_firm_row+1;
	var after_it = dynamic_firm_row-1;

var new_row = document.createElement('tr');
new_row.setAttribute('id','SHAKEB_'+dynamic_firm_row);
var new_td_1  = document.createElement("td");
var select_box = document.createElement('select');
select_box.setAttribute('name','titles[]');
select_box.setAttribute('id','title_'+dynamic_firm_row);
select_box.setAttribute('onchange','IfSelectOtherThenTitle(this.id)');
select_box.setAttribute("style","width:120px;height:30px;border:1px solid #333;")
select_box.innerHTML="<option value=''>Please select</option><option value='1'>PAN Card</option><option value='2'>ID Proof</option><option value='3'>Address Proof</option><option value='4'>Resume</option><option value='10'>Others</option>";

var new_td_2 = document.createElement("td");
var new_td_3 = document.createElement("td");
new_td_3.setAttribute('id','SHAKEB_COLM_'+dynamic_firm_row);
 
//new_td_1.innerHTML = "<input type='text' name='titles[]'/>";
new_td_1.appendChild(select_box);
new_td_2.innerHTML = "<input type='file' name='files[]'/>";
new_td_3.innerHTML = "<input type='hidden' id='text_on_others' name='text_on_others[]'>";


new_row.appendChild(new_td_1);
new_row.appendChild(new_td_2);
new_row.appendChild(new_td_3);

insertAfter(document.getElementById('SHAKEB_'+after_it), new_row);
document.getElementById('hide_for_add_firm').value=counter;
	
}
function Add_More_Tender_Attachements()
{
	var np = document.getElementById('hide_for_add_firm').value;
	var dynamic_firm_row = parseInt(np);
	var counter=dynamic_firm_row+1;
	var after_it = dynamic_firm_row-1;

var new_row = document.createElement('tr');
new_row.setAttribute('id','SHAKEB_'+dynamic_firm_row);
var new_td_1  = document.createElement("td");
var select_box = document.createElement('select');
select_box.setAttribute('name','titles[]');
select_box.setAttribute('id','title_'+dynamic_firm_row);
select_box.setAttribute('onchange','IfSelectOtherThenTitle(this.id)');
select_box.setAttribute("style","width:120px;height:30px;border:1px solid #333;")
select_box.innerHTML="<option value=''>Please select</option><option value='1'>NIT</option><option value='2'>Specification</option><option value='3'>Drawing Copy</option><option value='4'>Annexures</option><option value='5'>Special Conditions</option><option value='10'>Others</option>";

var new_td_2 = document.createElement("td");
var new_td_3 = document.createElement("td");
new_td_3.setAttribute('id','SHAKEB_COLM_'+dynamic_firm_row);
 

new_td_1.appendChild(select_box);
new_td_2.innerHTML = "<input type='file' name='files[]'/>";
new_td_3.innerHTML = "<input type='hidden' id='text_on_others' name='text_on_others[]'>";


new_row.appendChild(new_td_1);
new_row.appendChild(new_td_2);
new_row.appendChild(new_td_3);

insertAfter(document.getElementById('SHAKEB_'+after_it), new_row);
document.getElementById('hide_for_add_firm').value=counter;
	
}


function IfSelectOtherThenTitle(row_id)
{
	var tm = row_id.split("title_");
	var mm = parseInt(tm[1]);
	var select_id = document.getElementById('title_'+mm).value;
	if(select_id==10)
	{
		
		
		document.getElementById('SHAKEB_COLM_'+mm).innerHTML="<input type='text' id='text_on_others' name='text_on_others[]' class='validate[required] Xtext-input' placeholder='Other Title'>";
	}
	else
	{
		document.getElementById('SHAKEB_COLM_'+mm).innerHTML="<input type='hidden' id='text_on_others' name='text_on_others[]' class='validate[required] Xtext-input' placeholder='Other Title'>";
	}
	
}

function add_mores_items(bef)
{

var new_row = document.createElement('tr');
var new_td_1  = document.createElement("td");
var new_td_2 = document.createElement("td");
var new_td_3 = document.createElement("td");
 
new_td_1.innerHTML = "<input type='text' name='titles[]'/>";
new_td_2.innerHTML = "<input type='text' name='discription[]'/>";
new_td_3.innerHTML = "<input type='file' name='files[]'/>";

new_row.appendChild(new_td_1);
new_row.appendChild(new_td_2);
new_row.appendChild(new_td_3);

insertAfter(document.getElementById(bef), new_row);
}
function add_mores_items_AFTER_CHANGE()
{
var ss = parseInt(document.getElementById('hide_for_text_area').value);
var add_after = ss-1;
var counter = ss+1;

var new_row = document.createElement('tr');
new_row.setAttribute('id','first_'+ss);
var new_td_1  = document.createElement("td");
var new_td_2 = document.createElement("td");
new_td_1.innerHTML = "<textarea rows='3' cols='30' style='border:1px solid #333;' name='titles[]'></textarea>";
new_td_2.innerHTML = "<textarea rows='3' cols='30' style='border:1px solid #333;' name='discription[]'/>";
new_row.appendChild(new_td_1);
new_row.appendChild(new_td_2);


insertAfter(document.getElementById('first_'+add_after), new_row);
document.getElementById('hide_for_text_area').value=counter;
}

function add_mores_main_consignee_on_purchaser(bef)
{
 var new_row = document.createElement('tr');
//var new_td_1  = document.createElement("td");
var new_td_2 = document.createElement("td");
 
//new_td_1.innerHTML = "<input type='text' name='titles[]'/>";
//new_td_1.appendChild(getFirms("titles[]"));
new_td_2.innerHTML = "<input type='file' name='files[]'/>";

//new_row.appendChild(new_td_1);
new_row.appendChild(new_td_2);

insertAfter(document.getElementById(bef), new_row);
}
function Add_More_Firm_RateGiven_Printed()
{
	var ss = parseInt(document.getElementById('hide_for_add_more_firm_rategiven_printed').value);
	var add_after = ss-1;
	var counter=ss+1;
	
	var new_row = document.createElement('tr');
	new_row.setAttribute("id","tr_addmorefirms_"+ss);
	var new_td_1  = document.createElement("td");
   	var new_td_2 = document.createElement("td");
  	new_td_1.appendChild(getFirms("select_firms[]"));
	new_td_2.innerHTML = "<input type='text' name='text_box_bid_number[]' style='width:135px; height:30px; border:1px solid #333;' placeholder='Bid Number'/>";
	new_row.appendChild(new_td_1);
	new_row.appendChild(new_td_2);
document.getElementById('hide_for_add_more_firm_rategiven_printed').value=counter;
insertAfter(document.getElementById('tr_addmorefirms_'+add_after), new_row);

	
}




function add_more_firms()
{
	/*var counter = document.getElementById('counter').value;
	counter = parseInt(counter);
	var incre_counter = counter+1;
	
	
	
	var new_table1 = document.createElement('table');
	new_table1.setAttribute('id','working-form');
	
	var new_row1 = document.createElement('tr');
	var new_td1_row1 = document.createElement('td');
	var new_td2_row1 = document.createElement('td');
	var new_td3_row1 = document.createElement('td');
	var new_td4_row1 = document.createElement('td');
	var new_td5_row1 = document.createElement('td');
	var new_td6_row1 = document.createElement('td');
	
	new_td1_row1.innerHTML = "<label for='select_firm'>Select Firm</label>";
	
	
		
	//new_td2_row1.appendChild(getSelectBox("'firm"+incre_counter+"[]'"));
	new_td2_row1.appendChild(getSelectBox('firm[]'));
	
	
	
	new_td3_row1.innerHTML = "&nbsp;";
	new_td4_row1.innerHTML = "&nbsp;";
	new_td5_row1.innerHTML = "&nbsp;";
	new_td6_row1.innerHTML = "&nbsp;";
	new_row1.appendChild(new_td1_row1);
	new_row1.appendChild(new_td2_row1);
	new_row1.appendChild(new_td3_row1);
	new_row1.appendChild(new_td4_row1);
	new_row1.appendChild(new_td5_row1);
	new_row1.appendChild(new_td6_row1);
	new_table1.appendChild(new_row1);

<!------------------------------------------------------>	
	var new_table2 = document.createElement('table');
	var caption = document.createElement('caption');
	caption.innerHTML = "Product";
	new_table2.setAttribute('id','multipels');
	new_table2.setAttribute('class','attachz');
	var table2_row1 = document.createElement("tr");
	var table2_row2 = document.createElement("tr");
	table2_row2.setAttribute('id',"first_dirct"+incre_counter);
	var table2_row3 = document.createElement("tr");
	var table2_row1_colm1 = document.createElement("th");
	var table2_row1_colm2 = document.createElement("th");
	var table2_row1_colm3 = document.createElement("th");
	var table2_row1_colm4 = document.createElement("th");
	var table2_row1_colm5 = document.createElement("th");
	table2_row1_colm1.innerHTML="Item Category";
	table2_row1_colm2.innerHTML="Item Discription";
	table2_row1_colm3.innerHTML="Consignee";
	table2_row1_colm4.innerHTML="Quantity";
	table2_row1_colm5.innerHTML="Unit";
	<!--------------------------------------------->
	var table2_row2_colm1 = document.createElement("td");
	var table2_row2_colm2 = document.createElement("td");
	var table2_row2_colm3 = document.createElement("td");
	var table2_row2_colm4 = document.createElement("td");
	var table2_row2_colm5 = document.createElement("td");
	//table2_row2_colm1.innerHTML="<input type='text' name='category"+incre_counter+"[]' style='width:120px;' id='meenu' class='kareena'/>";
	table2_row2_colm1.innerHTML='<input type="text" name="category'+incre_counter+'[]" style="width:120px;"  class="kareena" id="category'+incre_counter+'"/>';
	
	table2_row2_colm2.innerHTML="<input type='text' name='discription"+incre_counter+"[]' style='width:120px;'/>";
	//table2_row2_colm3.innerHTML="<input type='text' name='consignee"+incre_counter+"[]' style='width:120px;'/>";
	table2_row2_colm3.appendChild(getSelectBox2("consignee"+incre_counter+"[]"));
	//alert(table2_row2_colm3.innerHTML);
	table2_row2_colm4.innerHTML="<input type='text' name='quantity"+incre_counter+"[]' style='width:120px;'/>";
	table2_row2_colm5.innerHTML="<input type='text' name='unit"+incre_counter+"[]' style='width:120px;'/>";
	
	<!--------------------------------------------->
	var table2_row3_colm1 = document.createElement("td");
	var table2_row3_colm2 = document.createElement("td");
	table2_row3_colm2.setAttribute('colspan',2);
	table2_row3_colm1.innerHTML = "<input type='button' name='add_more' id='add_more' value='Add More Firm' class='add_more' onclick='add_more_firms();'/>";
	var to_send = "'first_dirct"+incre_counter+"'";
	table2_row3_colm2.innerHTML = '<input type="button" name="add_more" id="add_more" value="Add More Product" class="add_more" onclick="add_more_products('+to_send+')"/>';
	
	
	<!-------------------------------------------------->
	table2_row1.appendChild(table2_row1_colm1);
	table2_row1.appendChild(table2_row1_colm2);
	table2_row1.appendChild(table2_row1_colm3);
	table2_row1.appendChild(table2_row1_colm4);
	table2_row1.appendChild(table2_row1_colm5);
	<!---------------------------------------------------->
	table2_row2.appendChild(table2_row2_colm1);
	table2_row2.appendChild(table2_row2_colm2);
	table2_row2.appendChild(table2_row2_colm3);
	table2_row2.appendChild(table2_row2_colm4);
	table2_row2.appendChild(table2_row2_colm5);
	
	<!---------------------------------------------------->
	table2_row3.appendChild(table2_row3_colm1);
	table2_row3.appendChild(table2_row3_colm2);
	<!----------------------------------------------------->
	new_table2.appendChild(caption);
	new_table2.appendChild(table2_row1);
	new_table2.appendChild(table2_row2);
	new_table2.appendChild(table2_row3);
	var myHr = document.createElement("hr");
	myHr.setAttribute("noshade","noshade");
	myHr.setAttribute('color','#dcdcdc');
	myHr.setAttribute('class','hrules');
	document.getElementById('newtables').appendChild(new_table1);
	document.getElementById('newtables').appendChild(new_table2);
	document.getElementById('newtables').appendChild(myHr);
	document.getElementById('counter').value = incre_counter;
	
	*/	
	
	
}

function add_more_products()
{
	

//var counterX = bef.split("first_dirct");
//var counter = counterX[1];
if(document.getElementById('tender_purchaser').value=='')
{
	alert('Please select purchaser');
}
else
{
var counter=document.getElementById('counter').value;
counter=parseInt(counter);
var dynamic=counter-1;
var IC=document.getElementById('category'+dynamic).value;
var ID=document.getElementById('discription'+dynamic).value;
var IQ=document.getElementById('quantity'+dynamic).value;
var IU=document.getElementById('unit'+dynamic).value;
var INS=document.getElementById('inspection'+dynamic).value;
var ICNSINE=document.getElementById('consignee'+dynamic).value;
var new_row = document.createElement('tr');

var new_td_1  = document.createElement("td");
var new_td_2 = document.createElement("td");
var new_td_3  = document.createElement("td");
var new_td_4  = document.createElement("td");
var new_td_5  = document.createElement("td");
var new_td_6 = document.createElement("td");

//new_td_1.innerHTML = "<input type='text' name='category"+counter+"[]' style='width:120px' class='kareena'/>";
var textbox = document.createElement('input');
textbox.type = 'text';
textbox.setAttribute("name",'category[]');
textbox.setAttribute("id",'category'+counter);
textbox.setAttribute("class","kareena");
textbox.setAttribute("value",IC);

textbox.setAttribute("style","width:200px");
new_td_1.appendChild(textbox);
new_td_2.innerHTML = "<textarea rows='3' cols='28' name='discription[]' style='border:1px solid #666' id='discription"+counter+"'>"+ID+"</textarea>";
//new_td_3.innerHTML = "<input type='text' name='consignee"+counter+"[]' style='width:120px'/>";
//new_td_3.appendChild(getSelectBox2("consignee[]",counter,ICNSINE));
var select_cnsignee = document.createElement('select');
	select_cnsignee.setAttribute("name","consignee[]");
	select_cnsignee.setAttribute("class","selectD");
	select_cnsignee.setAttribute("id","consignee"+counter);
	select_cnsignee.innerHTML=CnsinList;
	new_td_3.appendChild(select_cnsignee);
new_td_6.appendChild(getSelectBox3("inspection[]",counter,INS));

new_td_4.innerHTML = "<input type='text' name='quantity[]' style='width:120px' id='quantity"+counter+"' value='"+IQ+"' class='class_for_only_numeric_values'/>";

//new_td_5.innerHTML = "<input type='text' name='unit[]' style='width:120px' id='unit"+counter+"' value='"+IU+"'/>";
new_td_5.appendChild(getSelectBoxUnit("unit[]",counter,IU));
new_row.appendChild(new_td_1);
new_row.appendChild(new_td_6);
new_row.appendChild(new_td_2);
new_row.appendChild(new_td_3);
new_row.appendChild(new_td_4);
new_row.appendChild(new_td_5);
new_row.setAttribute("id",'first_direct'+counter);
var bef='first_direct'+dynamic;
insertAfter(document.getElementById(bef), new_row);
//document.getElementById('first_direct'+dynamic).setAttribute('id','first_direct'+counter);


counter++;
document.getElementById('counter').value=counter;
}
}
function add_more_products_in_po_section()
{
	if(document.getElementById('tender_type').value=='')
	{
		alert('Please select tender type first to add more');
		return false;
	}
	else if (document.getElementById('tender_type').value==1 && document.getElementById('tender_purchaser_name').value=='')
	{
		alert('Please provide purchaser to proceed');
		return false;
		
	}
	else if ((document.getElementById('tender_type').value==2 || document.getElementById('tender_type').value==3  ) && document.getElementById('tender_purchaser').value=='')
	{
		alert('Please select purchaser to add more');
		return false;
	}
	
else
{
var counter=document.getElementById('counter').value;
counter=parseInt(counter);
var dynamic=counter-1;
/*var IC=document.getElementById('category'+dynamic).value;
var ID=document.getElementById('discription'+dynamic).value;
var IQ=document.getElementById('quantity'+dynamic).value;
var IU=document.getElementById('unit'+dynamic).value;
var INS=document.getElementById('inspection'+dynamic).value;
var ICNSINE=document.getElementById('consignee'+dynamic).value;*/
var new_row = document.createElement('tr');

var new_td_1  = document.createElement("td");
var new_td_2 = document.createElement("td");
var new_td_3  = document.createElement("td");
var new_td_4  = document.createElement("td");
var new_td_5  = document.createElement("td");
var new_td_6 = document.createElement("td");
var new_td_7 = document.createElement("td");
var new_td_8 = document.createElement("td");
var new_td_9 = document.createElement("td");
var new_td_10 = document.createElement("td");
var new_td_11 = document.createElement("td");
var new_td_12= document.createElement("td");
var new_td_13 = document.createElement("td");
var new_td_14 = document.createElement("td");
var new_td_15 = document.createElement("td");

var textbox = document.createElement('input');
textbox.type = 'text';
textbox.setAttribute("name",'category[]');
textbox.setAttribute("id",'category'+counter);
textbox.setAttribute("class","kareena");
textbox.setAttribute("style","width:200px");
new_td_1.appendChild(textbox);
//----------------------------------------------------------------------
new_td_2.innerHTML = "<textarea rows='3' cols='28' name='discription[]' style='border:1px solid #666' id='discription"+counter+"'></textarea>";
//------------------------------
var select_cnsignee = document.createElement('select');
	select_cnsignee.setAttribute("name","consignee[]");
	select_cnsignee.setAttribute("class","empty_consignee selectD");
	select_cnsignee.setAttribute("id","consignee"+counter);
	select_cnsignee.innerHTML=CnsinList;
	new_td_3.appendChild(select_cnsignee);
///////////////////////////////////////////////////	
  //new_td_6.appendChild(getSelectBox3("inspection[]",counter));
 new_td_6.innerHTML = "<select name='inspection[]' id='inspection"+counter+"'  class='selectD'><option value='1'>RITES</option><option value='2'>DQA</option><option value='3'>RITES/DQA</option><option value='4'>CONSIGNEE</option><option value='5'>RDSO</option><option value='6'>RITES/Visual</option><option value='7'>RITES/MTC & GC</option><option value='8'>DQA/Visual</option><option value='9'>DQA/MTC & GC</option><option value='10'>OTHERS</option></select>";
/////////////////////////////////////
new_td_4.innerHTML = "<input type='text' name='quantity[]' style='width:80px' id='quantity"+counter+"'  class='class_for_only_numeric_values' onkeyup='[Remove_bracket_to_work]CalculationBaseOnQuantity(this.id)'/>";
/////////////////////////////////////
//new_td_5.appendChild(getSelectBoxUnit("unit[]",counter));
new_td_5.innerHTML = "<select name='unit[]' id='unit"+counter+"' style='width:80px;' class='selectD'><option value='1'>NOS</option><option value='2'>Kg</option><option value='3'>Mtr</option><option value='4'>Pcs</option><option value='5'>Pair</option><option value='6'>Yard</option></select>"
/////////////////////////////
new_td_7.innerHTML = "<input type='text' name='rate[]' style='width:80px' id='rate"+counter+"'  class='class_for_only_numeric_values' onkeyup='[Remove_bracket_to_wordk]CalculationBaseOnRate(this.id);'/>";
////////////////////////////////////
new_td_8.innerHTML = "<select name='taxtype[]' id='taxtype"+counter+"' style='width:80px;' class='selectD'><option value=''>Please Select</option><option value='1'>VAT EXTRA</option><option value='2'>CST EXTRA</option><option value='3'>VAT INCL</option><option value='4'>CST INCL</option><option value='5'>Nill</option></select>"
////////////////////////////////////////////////
new_td_9.innerHTML = "<input type='text' name='includingall[]' style='width:100px' id='includingall"+counter+"'/>";
/////////////////////////////
new_td_10.innerHTML = "<input type='text' name='totalvalue[]' style='width:100px' id='totalvalue"+counter+"'/>";

//////////////////////////////////////////////////////
new_td_11.innerHTML = "<select name='payment[]' id='payment"+counter+"' style='width:80px;' class='selectD' onchange='ShowPaymentOther(this.id)'><option value=''>Please Select</option><option value='1'>100% against supply</option><option value='2'>98% + 2%</option><option value='3'>98% + 5%</option><option value='4'>90% + 10%</option><option value='10'>Other</option></select>&nbsp;<input type='text' id='paymentother"+counter+"' name='paymentother[]' style='width:80px;display:none;' />"
//////////////////////////////////////////////
new_td_12.innerHTML = "<input type='text' name='payingauthority[]' style='width:100px' id='payingauthority"+counter+"'/>";
//////////////////////////////////////
new_td_13.innerHTML = "<input type='text' name='inspectionplace[]' style='width:100px' id='inspectionplace"+counter+"'/>";
//////////////////////////////////////
new_td_14.innerHTML = "<input type='text' name='deliverydate[]' style='width:100px' id='deliverydate"+counter+"' class='meenu'/>";
//////////////////////////////////////
new_td_15.innerHTML = "<input type='text' name='quantitymannual[]' style='width:100px' id='quantitymannual"+counter+"'/>";
//////////////////////////////////////

new_row.appendChild(new_td_1);
new_row.appendChild(new_td_6);
new_row.appendChild(new_td_2);
new_row.appendChild(new_td_3);
new_row.appendChild(new_td_4);
new_row.appendChild(new_td_5);
new_row.appendChild(new_td_7);
new_row.appendChild(new_td_8);
new_row.appendChild(new_td_9);
new_row.appendChild(new_td_10);
new_row.appendChild(new_td_11);
new_row.appendChild(new_td_12);
new_row.appendChild(new_td_13);
new_row.appendChild(new_td_14);
new_row.appendChild(new_td_15);
new_row.setAttribute("id",'first_direct'+counter);
var bef='first_direct'+dynamic;
insertAfter(document.getElementById(bef), new_row);
//document.getElementById('first_direct'+dynamic).setAttribute('id','first_direct'+counter);


counter++;
document.getElementById('counter').value=counter;
}
	
}
function add_more_products_History_Po()
{
	

//var counterX = bef.split("first_dirct");
//var counter = counterX[1];
if(document.getElementById('tender_purchaser').value=='')
{
	alert('Please select purchaser');
}
else
{
var counter=document.getElementById('counter').value;
counter=parseInt(counter);
var dynamic=counter-1;
var IC=document.getElementById('category'+dynamic).value;
var ID=document.getElementById('discription'+dynamic).value;
var IQ=document.getElementById('quantity'+dynamic).value;
var IU=document.getElementById('unit'+dynamic).value;
var INS=document.getElementById('inspection'+dynamic).value;
var ICNSINE=document.getElementById('consignee'+dynamic).value;
var taxtype=document.getElementById('tax_type'+dynamic).value;
var tax=document.getElementById('tax'+dynamic).value;
var rate=document.getElementById('rate'+dynamic).value;
var new_row = document.createElement('tr');

var new_td_1  = document.createElement("td");
var new_td_2 = document.createElement("td");
var new_td_3  = document.createElement("td");
var new_td_4  = document.createElement("td");
var new_td_5  = document.createElement("td");
var new_td_6 = document.createElement("td");
var new_td_7 = document.createElement("td");
var new_td_8 = document.createElement("td");
var new_td_9 = document.createElement("td");

//new_td_1.innerHTML = "<input type='text' name='category"+counter+"[]' style='width:120px' class='kareena'/>";
var textbox = document.createElement('input');
textbox.type = 'text';
textbox.setAttribute("name",'category[]');
textbox.setAttribute("id",'category'+counter);
textbox.setAttribute("class","kareena");
textbox.setAttribute("value",IC);

textbox.setAttribute("style","width:200px");
new_td_1.appendChild(textbox);
new_td_2.innerHTML = "<textarea rows='3' cols='28' name='discription[]' style='border:1px solid #666' id='discription"+counter+"'>"+ID+"</textarea>";
//new_td_3.innerHTML = "<input type='text' name='consignee"+counter+"[]' style='width:120px'/>";
//new_td_3.appendChild(getSelectBox2("consignee[]",counter,ICNSINE));
var select_cnsignee = document.createElement('select');
	select_cnsignee.setAttribute("name","consignee[]");
	select_cnsignee.setAttribute("class","selectD");
	select_cnsignee.setAttribute("id","consignee"+counter);
	select_cnsignee.innerHTML=CnsinList;
	new_td_3.appendChild(select_cnsignee);
new_td_6.appendChild(getSelectBox3("inspection[]",counter,INS));

new_td_4.innerHTML = "<input type='text' name='quantity[]' style='width:120px' id='quantity"+counter+"' value='"+IQ+"' class='class_for_only_numeric_values'/>";
//new_td_5.innerHTML = "<input type='text' name='unit[]' style='width:120px' id='unit"+counter+"' value='"+IU+"'/>";
new_td_5.appendChild(getSelectBoxUnit("unit[]",counter,IU));
new_td_7.appendChild(getSelectBoxTaxType("tax_type[]",counter,taxtype));
new_td_8.innerHTML = "<input type='text' name='tax[]' style='width:150px' id='tax"+counter+"' value='"+tax+"'/>";
new_td_9.innerHTML = "<input type='text' name='rate[]' style='width:150px' id='rate"+counter+"' value='"+rate+"'/>";
new_row.appendChild(new_td_1);
new_row.appendChild(new_td_6);
new_row.appendChild(new_td_2);
new_row.appendChild(new_td_3);
new_row.appendChild(new_td_4);
new_row.appendChild(new_td_5);
new_row.appendChild(new_td_7);
new_row.appendChild(new_td_8);
new_row.appendChild(new_td_9);
new_row.setAttribute("id",'first_direct'+counter);
var bef='first_direct'+dynamic;
insertAfter(document.getElementById(bef), new_row);
//document.getElementById('first_direct'+dynamic).setAttribute('id','first_direct'+counter);


counter++;
document.getElementById('counter').value=counter;
}
}


function add_quoto(idh)
{
	var hidebox = document.getElementById('hide'+idh).value; 	
	var counter=parseInt(hidebox)+1;
	//---------------------LAST VALUES-----------------------------
	var consignee = document.getElementById('consignee_'+idh+'_'+hidebox).value;
	var inspection = document.getElementById('inspection_'+idh+'_'+hidebox).value;
	var quantity = document.getElementById('quantity_'+idh+'_'+hidebox).value;
	var unitX = document.getElementById('unit_'+idh+'_'+hidebox).value;
	var tdc = document.getElementById('tdc_'+idh+'_'+hidebox).value;
	var emd = document.getElementById('emd_'+idh+'_'+hidebox).value;
	var rate = document.getElementById('rate_'+idh+'_'+hidebox).value;
	var taxtype = document.getElementById('taxtype_'+idh+'_'+hidebox).value;
	
	var taxper = document.getElementById('taxper_'+idh+'_'+hidebox).value;
	var taxamount = document.getElementById('taxamount_'+idh+'_'+hidebox).value;
	var disper = document.getElementById('disper_'+idh+'_'+hidebox).value;
	var disamount = document.getElementById('disamount_'+idh+'_'+hidebox).value;
	var othercharg = document.getElementById('othercharg_'+idh+'_'+hidebox).value;
	var validday = document.getElementById('validday_'+idh+'_'+hidebox).value;
	var payment = document.getElementById('payment_'+idh+'_'+hidebox).value;
	var delperod = document.getElementById('delperod_'+idh+'_'+hidebox).value;
	var delschedule = document.getElementById('delschedule_'+idh+'_'+hidebox).value;
	var remark = document.getElementById('remark_'+idh+'_'+hidebox).value;
	var spinate = document.getElementById('spinate_'+idh+'_'+hidebox).value;
	
	
	//var CnsigneeText = $('#'+cnsigneeID+' option:selected').text();
	
	
	//----------------------------------------------------------------
	
	var NewDiv = document.createElement('div');
	var divX = document.createElement('div');
	divX.setAttribute("id","addafterdiv_"+idh+"_"+counter);
	divX.setAttribute('class','working-container');
	var table=document.createElement('table');
	var tbo=document.createElement('tbody');
	
	table.setAttribute("width","820");
	table.setAttribute("border","1");
	table.setAttribute("cellspacing","10");
	table.setAttribute("id","addafter_"+idh+"_"+counter);
	//table.appendChild(tbo);
	var row1=document.createElement("tr");
	var row2=document.createElement("tr");
	var row3=document.createElement("tr");
	var row4=document.createElement("tr");
	var row5=document.createElement("tr");
	var row6=document.createElement("tr");
	var row7=document.createElement("tr");
	var row8=document.createElement("tr");
	var row9=document.createElement("tr");
	var row10=document.createElement("tr");
	var row11=document.createElement("tr");
	var row12=document.createElement("tr");
	//-----------------------------------
	var td1_row1 = document.createElement("td");
	var td2_row1 = document.createElement("td");
	//--------------------------------------
	var td1_row2 = document.createElement("td");
	var td2_row2 = document.createElement("td");
	var td3_row2 = document.createElement("td");
	var td4_row2 = document.createElement("td");
	//-----------------------------------------
	var td1_row3 = document.createElement("td");
	var td2_row3 = document.createElement("td");
	var td3_row3 = document.createElement("td");
	var td4_row3 = document.createElement("td");
	//-----------------------------------------
	var td1_row4 = document.createElement("td");
	var td2_row4 = document.createElement("td");
	var td3_row4 = document.createElement("td");
	var td4_row4 = document.createElement("td");
	//-----------------------------------------
	var td1_row5 = document.createElement("td");
	var td2_row5 = document.createElement("td");
	var td3_row5 = document.createElement("td");
	var td4_row5 = document.createElement("td");
	//-----------------------------------------
	var td1_row6 = document.createElement("td");
	var td2_row6 = document.createElement("td");
	var td3_row6 = document.createElement("td");
	var td4_row6 = document.createElement("td");
	//-----------------------------------------
	var td1_row7 = document.createElement("td");
	var td2_row7 = document.createElement("td");
	var td3_row7 = document.createElement("td");
	var td4_row7 = document.createElement("td");
	//-----------------------------------------
	var td1_row8 = document.createElement("td");
	var td2_row8 = document.createElement("td");
	var td3_row8 = document.createElement("td");
	var td4_row8 = document.createElement("td");
	//-----------------------------------------
	var td1_row9 = document.createElement("td");
	var td2_row9 = document.createElement("td");
	var td3_row9 = document.createElement("td");
	var td4_row9 = document.createElement("td");
	//-----------------------------------------
	var td1_row10 = document.createElement("td");
	var td2_row10 = document.createElement("td");
	var td3_row10 = document.createElement("td");
	var td4_row10 = document.createElement("td");
	//-----------------------------------------
	var td1_row11 = document.createElement("td");
	var td2_row11 = document.createElement("td");
	//-----------------------------------------
	var td1_row12 = document.createElement("td");
	var td2_row12 = document.createElement("td");
	//------------------------------------------
	//---------------------------------------------
	
	td1_row1.setAttribute("width","98");
	td2_row1.setAttribute("width","277");
	td1_row1.innerHTML="<label>Select Firm</label>"
	td2_row1.appendChild(FirmBox('firm_'+idh+'_'+counter+'',name='firm_'+idh+'[]'));
	//-------------------------------------------
	td1_row2.innerHTML="<label>Consignee</label>"
	td2_row2.innerHTML = "<input type='text' id='consignee_"+idh+"_"+counter+"' name='consignee_"+idh+"[]' readonly='readonly' value='"+consignee+"'> ";
	td3_row2.innerHTML="<label>Inspection</label>"
	td4_row2.innerHTML = "<input type='text' id='inspection_"+idh+"_"+counter+"' name='inspection_"+idh+"[]' value='"+inspection+"' readonly='readonly'/>";
	//---------------------------------------------
	td1_row3.innerHTML="<label>Quantity</label>"
	td2_row3.innerHTML = "<input type='text' id='quantity_"+idh+"_"+counter+"' name='quantity_"+idh+"[]' value='"+quantity+"'> ";
	td3_row3.innerHTML="<label>Unit</label>"
	td4_row3.innerHTML = "<input type='text' id='unit_"+idh+"_"+counter+"' name='unit_"+idh+"[]' value='"+unitX+"'> ";
	//---------------------------------------------
	td1_row4.innerHTML="<label>TDC</label>"
	td2_row4.innerHTML = "<input type='text' id='tdc_"+idh+"_"+counter+"' name='tdc_"+idh+"[]' readonly='readonly'/> ";
	td3_row4.innerHTML="<label>EMD</label>"
	td4_row4.innerHTML = "<input type='text' id='emd_"+idh+"_"+counter+"' name='emd_"+idh+"[]' readonly='readonly'> ";
	//---------------------------------------------
	td1_row5.innerHTML="<label>Rate</label>"
	td2_row5.innerHTML = "<input type='text' id='rate_"+idh+"_"+counter+"' name='rate_"+idh+"[]' value='"+rate+"'> ";
	td3_row5.innerHTML="<label>TAX TYPE</label>"
	td4_row5.appendChild(TaxBox('taxtype_'+idh+'_'+counter+'',name='taxtype_'+idh+'[]',taxtype));
	
	//---------------------------------------------
td1_row6.innerHTML="<label>TAX %</label>"
	td2_row6.innerHTML = "<input type='text' id='taxper_"+idh+"_"+counter+"' name='taxper_"+idh+"[]' value='"+taxper+"'> ";
	td3_row6.innerHTML="<label>TAX AMOUNT</label>"
	td4_row6.innerHTML = "<input type='text' id='taxamount_"+idh+"_"+counter+"' name='taxamount_"+idh+"[]' value='"+taxamount+"'> ";
	//---------------------------------------------
	td1_row7.innerHTML="<label>Discount %</label>"
	td2_row7.innerHTML = "<input type='text' id='disper_"+idh+"_"+counter+"' name='disper_"+idh+"[]' value='"+disper+"'> ";
	td3_row7.innerHTML="<label>Discount Amount</label>"
	td4_row7.innerHTML = "<input type='text' id='disamount_"+idh+"_"+counter+"' name='disamount_"+idh+"[]' value='"+disamount+"'> ";
	//---------------------------------------------
	td1_row8.innerHTML="<label>Other Charges</label>"
	td2_row8.innerHTML = "<input type='text' id='othercharg_"+idh+"_"+counter+"' name='othercharg_"+idh+"[]' value='"+othercharg+"'> ";
	td3_row8.innerHTML="<label>Validity Days</label>"
	td4_row8.innerHTML = "<input type='text' id='validday_"+idh+"_"+counter+"' name='validday_"+idh+"[]' value='"+validday+"'> ";
	//---------------------------------------------
	td1_row9.innerHTML="<label>Payment</label>"
	//td2_row9.innerHTML = "<select id='payment_"+idh+"_"+counter+"' name='payment_"+idh+"[]'></select> ";
	td2_row9.appendChild(PaymentBox('payment_'+idh+'_'+counter+'',name='payment_'+idh+'[]',payment));
	/*var tryit=document.createElement("Select");
	var tryit2=document.createElement("option");
	tryit2.innerHTML="meeeenu";
	tryit.appendChild(tryit2);
	td2_row9.appendChild(tryit);*/
	
	td3_row9.innerHTML="<label>Delivery Periode</label>"
	td4_row9.innerHTML = "<input type='text' id='delperod_"+idh+"_"+counter+"' name='delperod_"+idh+"[]' value='"+delperod+"'> ";
	
	//---------------------------------------------
	td1_row10.innerHTML="<label>Delivery schedule</label>"
	td2_row10.innerHTML = "<input type='text' id='delschedule_"+idh+"_"+counter+"' name='delschedule_"+idh+"[]' value='"+delschedule+"'> ";
	td3_row10.innerHTML="<label>Remark</label>"
	td4_row10.innerHTML = "<textarea rows='4' id='remark_"+idh+"_"+counter+"' name='remark_"+idh+"[]'>"+remark+"</textarea> ";
	//---------------------------------------------
	td1_row11.innerHTML="<label>SPI Nate</label>"
	td2_row11.innerHTML = "<textarea rows='4' id='spinate_"+idh+"_"+counter+"' name='spinate_"+idh+"[]'>"+spinate+"</textarea> ";
	//--------------------------------------------
	td1_row12.innerHTML="&nbsp;";
	td2_row12.innerHTML="<span style='display:none' id='loader_"+idh+"_"+counter+"' ><img src='main_images/indicator.gif' /></span><span id='msgspanX_"+idh+"_"+counter+"' ></span>";
	//td2_row12.innerHTML="<span id='msgspanX_"+idh+"_"+counter+"' ></span>";
	//---------------------------------------------
	//-------------------------------------------------
	row1.appendChild(td1_row1);
	row1.appendChild(td2_row1);
	//*************
	row2.appendChild(td1_row2);
	row2.appendChild(td2_row2);
	row2.appendChild(td3_row2);
	row2.appendChild(td4_row2);
	//************
	row3.appendChild(td1_row3);
	row3.appendChild(td2_row3);
	row3.appendChild(td3_row3);
	row3.appendChild(td4_row3);
	//************
	row4.appendChild(td1_row4);
	row4.appendChild(td2_row4);
	row4.appendChild(td3_row4);
	row4.appendChild(td4_row4);
	//************
	row5.appendChild(td1_row5);
	row5.appendChild(td2_row5);
	row5.appendChild(td3_row5);
	row5.appendChild(td4_row5);
	//************
	row6.appendChild(td1_row6);
	row6.appendChild(td2_row6);
	row6.appendChild(td3_row6);
	row6.appendChild(td4_row6);
	//************
	row7.appendChild(td1_row7);
	row7.appendChild(td2_row7);
	row7.appendChild(td3_row7);
	row7.appendChild(td4_row7);
	//************
	row8.appendChild(td1_row8);
	row8.appendChild(td2_row8);
	row8.appendChild(td3_row8);
	row8.appendChild(td4_row8);
	//************
	row9.appendChild(td1_row9);
	row9.appendChild(td2_row9);
	row9.appendChild(td3_row9);
	row9.appendChild(td4_row9);
	//************
	row10.appendChild(td1_row10);
	row10.appendChild(td2_row10);
	row10.appendChild(td3_row10);
	row10.appendChild(td4_row10);
	//************
	row11.appendChild(td1_row11);
	row11.appendChild(td2_row11);
	
	//************
	row12.appendChild(td1_row12);
	row12.appendChild(td2_row12);
	//*******************
	
	tbo.appendChild(row1);
	tbo.appendChild(row2);
	tbo.appendChild(row3);
	tbo.appendChild(row4);
	tbo.appendChild(row5);
	tbo.appendChild(row6);
	tbo.appendChild(row7);
	tbo.appendChild(row8);
	tbo.appendChild(row9);
	tbo.appendChild(row10);
	tbo.appendChild(row11);
	tbo.appendChild(row12);
	table.appendChild(tbo);
	divX.appendChild(table);
	var bef="addafterdiv_"+idh+"_"+hidebox;
	insertAfter(document.getElementById(bef),divX);
	document.getElementById('hide'+idh).value=counter;
}
function Add_Quoto2_New()
{
	var hidebox = document.getElementById('hide').value;
	
	var counter=parseInt(hidebox)+1;
	
	var row_new=document.createElement('tr');
	row_new.setAttribute('id','addafter_'+counter);
	var td1=document.createElement('td');
	var td2=document.createElement('td');
	var td3=document.createElement('td');
	var td4=document.createElement('td');
	var td5=document.createElement('td');
	var td6=document.createElement('td');
	var td7=document.createElement('td');
	var td8=document.createElement('td');
	var td9=document.createElement('td');
	var td10=document.createElement('td');
	var td11=document.createElement('td');
	var td12=document.createElement('td');
	var td13=document.createElement('td');
	var td14=document.createElement('td');
	var td15=document.createElement('td');
	var td16=document.createElement('td');
	var td17=document.createElement('td');
	var td18=document.createElement('td');
	var td19=document.createElement('td');
	var td20=document.createElement('td');
	td1.appendChild(FirmBox('firm_'+counter,'firm[]'));
	td2.appendChild(InspectionBox('inspection_'+counter,'inspection[]'));
	td3.appendChild(TdcBox('tdc_'+counter,'tdc[]'));
	td4.appendChild(EmdBox('emd_'+counter,'emd[]'));
	td5.innerHTML = "<input type='text' id='rate_"+counter+"' name='rate[]' placeholder='0.00' onkeyup='AmountCalculation(this.id);' class='validate'/>";
	td6.appendChild(TaxtypeBox('taxtype_'+counter,'taxtype[]'));
	td7.innerHTML = "<input type='text' id='taxper_"+counter+"' name='taxper[]' onkeyup='AmountCalculation(this.id)' placeholder='0.00' class='validate' />";
	
	td8.innerHTML = "<input type='text' id='disper_"+counter+"' name='disper[]' placeholder='0.00' onkeyup='AmountCalculation(this.id)' class='validate'/>";
	td9.innerHTML = "<input type='text' id='disamount_"+counter+"' name='disamount[]' placeholder='0.00' readonly='readonly'/>";
	td10.innerHTML = "<input type='text' id='othercharg_"+counter+"' name='othercharg[]' placeholder='0.00' onkeyup='AmountCalculation(this.id);' class='validate'/>";
	td11.innerHTML = "<input type='text' id='validday_"+counter+"' name='validday[]'/>";
	td12.appendChild(PaymentBox('payment_'+counter,'payment[]'));
	td13.innerHTML = "<input type='text' id='delperod_"+counter+"' name='delperod[]'/>";
	td14.innerHTML = "<input type='text' id='delschedule_"+counter+"' name='delschedule[]'/>";
	td15.innerHTML = "<input type='text' id='remark_"+counter+"' name='remark[]' />";
	td16.innerHTML = "<input type='text' id='spinate_"+counter+"' name='spinate[]'/>";
	td17.appendChild(OCTBox('oct_'+counter,'oct[]'));;
	td18.innerHTML = "<input type='text' id='oca_"+counter+"' name='oca[]' readonly='readonly' placeholder='0.00'/>";
	td19.innerHTML = "<input type='text' id='taxamount_"+counter+"' name='taxamount[]' readonly='readonly' value='0.00'/>";
	td20.innerHTML = "<input type='text' id='finalrate_"+counter+"' name='finalrate[]' readonly='readonly' placeholder='0.00'/>";
	
	
	row_new.appendChild(td1);
	row_new.appendChild(td2);
	row_new.appendChild(td5);
	row_new.appendChild(td6);
	row_new.appendChild(td7);
	//row_new.appendChild(td19);
	row_new.appendChild(td17);
	row_new.appendChild(td10);
	//row_new.appendChild(td18);
	
	row_new.appendChild(td8);
	//row_new.appendChild(td9);
	row_new.appendChild(td20);
	
	row_new.appendChild(td12);
	row_new.appendChild(td13);
	row_new.appendChild(td14);
	row_new.appendChild(td11);
	row_new.appendChild(td15);
	row_new.appendChild(td3);
	row_new.appendChild(td4);
	row_new.appendChild(td16);
	
	var bef="addafter_"+hidebox;
	
	insertAfter(document.getElementById(bef),row_new);
	document.getElementById('hide').value=counter;
	
	
}
function Re_tender(retender)
{
	if(retender==2)
	{
	 document.getElementById('old_tender').style.display='';
	}
	else
	{
		$('#old_tender').val('');
		document.getElementById('old_tender').style.display='none';
		$('#tender_sample').val(0);
		$('#tender_tdc').val('');
		$('#tender_emd').val('');
		$('#tender_criteria').val('');
		//----------------------------
		if ($('#multipelsRe').length > 0) {
		document.getElementById('re_tender_div').innerHTML='';
     	}
	 	if ($('#attachmentsRe').length > 0) {
		document.getElementById('Re_tender_attach').innerHTML='';
     }
	 if ($('.ReAttachFirm').length > 0) {
		document.getElementById('limited_firm_div').innerHTML='';
     }
	 ///////////////////////////////////////////
		
	}
}
function DeleteAllOldss()
{
	
	/*if ($('#multipelsRe').length > 0) {
		document.getElementById('re_tender_div').innerHTML='';
     }
	 if ($('#attachmentsRe').length > 0) {
		document.getElementById('Re_tender_attach').innerHTML='';
     }
	 if ($('.ReAttachFirm').length > 0) {
		document.getElementById('limited_firm_div').innerHTML='';
     }*/
	 document.getElementById('tender_tdc').value='';
	 document.getElementById('tender_emd').value='';
	 document.getElementById('tender_criteria').value='';
	 document.getElementById('tender_sample').value=0;
	 
	$('.dynamic_products_row_class').remove();
	 $('.dynamic_attachements_row_class').remove();
	
}
function DeleteAllOldssInHistory()
{
	 
	$('.dynamic_products_row_class').remove();
	 $('.dynamic_attachements_row_class').remove();
}
function AddReTenderInfo(oldtenderno,parent_table,product_table,attachement_table)
{
	
	 $('.dynamic_products_row_class').remove();
	 $('.dynamic_attachements_row_class').remove();
	/*if ($('#multipelsRe').length > 0) {
		document.getElementById('re_tender_div').innerHTML='';
     }
	 if ($('#attachmentsRe').length > 0) {
		document.getElementById('Re_tender_attach').innerHTML='';
     }
	 if ($('.ReAttachFirm').length > 0) {
		document.getElementById('limited_firm_div').innerHTML='';
     }*/
	 
	 
	 var purchaser = document.getElementById('tender_purchaser').value;
	$.ajax({
    url:'MainAjax.php',
	//dataType:'json',
    type:'post',
	//async:false,
	data:'purchaser='+purchaser+'&oldtenderno='+oldtenderno+'&parent_table='+parent_table+'&product_table='+product_table+'&attachement_table='+attachement_table,
	success : function(response){
		//var json = jQuery.parseJSON(response);
		var values = response.split("|||")
		var base_tender=values[0].split(":~");
		var product_tender=values[1].split("%$");
		var attach_tender=values[2].split("%$");
		
		
		
		var limited_firm_tender=values[3].split("%$");
		
		
		
		//To Place values in Base[static] Fill Tender Boxes--
		$('#tender_sample').val(base_tender[1]);
		$('#tender_tdc').val(base_tender[2]);
		$('#tender_emd').val(base_tender[3]);
		$('#tender_criteria').val(base_tender[4]);
		//---------------------------------------
		//-------To Place Values in Tender Products------
		/*var row_re = 're_row';
		var our_div = document.getElementById('re_tender_div');
		var Mytable=document.createElement('table');
		var caption = document.createElement('caption');
		caption.innerHTML='Re-tender Products';
		Mytable.setAttribute("id","multipelsRe");
		Mytable.setAttribute("padding","3px");*/
		
		
	/*	var BaseRow = document.createElement('tr');
		var BaseTh_1 = document.createElement('th');
		BaseTh_1.setAttribute("style","width:200px");
		BaseTh_1.innerHTML='Item Category';
		var BaseTh_2 = document.createElement('th');
		BaseTh_2.setAttribute("style","width:120px");
		BaseTh_2.innerHTML='Item Inspection';
		var BaseTh_3 = document.createElement('th');
		BaseTh_3.setAttribute("style","width:210px");
		BaseTh_3.innerHTML='Item Discription';
		var BaseTh_4 = document.createElement('th');
		BaseTh_4.setAttribute("style","width:120px");
		BaseTh_4.innerHTML='Consignee';
		var BaseTh_5 = document.createElement('th');
		BaseTh_5.setAttribute("style","width:120px");
		BaseTh_5.innerHTML='Quantity';
		var BaseTh_6 = document.createElement('th');
		BaseTh_6.setAttribute("style","width:120px");
		BaseTh_6.innerHTML='Unit';
		BaseRow.appendChild(BaseTh_1);
		BaseRow.appendChild(BaseTh_2);
		BaseRow.appendChild(BaseTh_3);
		BaseRow.appendChild(BaseTh_4);
		BaseRow.appendChild(BaseTh_5);
		BaseRow.appendChild(BaseTh_6);
		Mytable.appendChild(caption);
		Mytable.appendChild(BaseRow); */
	if(product_tender!='')
	{	
		for(var i=0;i<(product_tender.length)-1;i++)
		{
			
			var PvaluesP = product_tender[i].split(":~");
			var new_row = document.createElement('tr');
			new_row.setAttribute("class","dynamic_products_row_class");
			var new_td_1  = document.createElement("td");
			var new_td_2 = document.createElement("td");
			var new_td_3  = document.createElement("td");
			var new_td_4  = document.createElement("td");
			var new_td_5  = document.createElement("td");
			var new_td_6 = document.createElement("td");
			var new_td_7 = document.createElement("td");
			var textbox = document.createElement('input');
			textbox.type = 'text';
			textbox.setAttribute("name",'category[]');
			textbox.setAttribute("id",'category_re_'+i);
			textbox.setAttribute("class","kareena");
			textbox.setAttribute("value",PvaluesP[2]);
			textbox.setAttribute("style","width:200px");
			new_td_1.appendChild(textbox);
			new_td_2.appendChild(Re_getSelectBox3("inspection[]",i,PvaluesP[3]));
			new_td_3.innerHTML = "<textarea rows='3' cols='20' name='discription[]' style='border:1px solid #666' id='discription_re_'+i>"+PvaluesP[4]+"</textarea>";
			//////////////////////////////////////
			var select_cnsignee = document.createElement('select');
			select_cnsignee.setAttribute("name","consignee[]");
			select_cnsignee.setAttribute("class","selectD");
			select_cnsignee.setAttribute("id","consignee_re_"+i);
			select_cnsignee.innerHTML=setBackConsigneeInRetender(PvaluesP[5]);
			
			
			new_td_4.appendChild(select_cnsignee);
			//new_td_4.appendChild(Re_Consignee("consignee[]",i,PvaluesP[5]));;
			new_td_5.innerHTML = "<input type='text' name='quantity[]' style='width:120px' id='quantity_re_"+i+"' value='"+PvaluesP[6]+"'/>";

new_td_6.appendChild(Re_getSelectBoxUnit("unit[]",i,PvaluesP[7]));


var mahri_img  = document.createElement("img");
mahri_img.setAttribute("src","main_images/delete.png");
mahri_img.setAttribute("onclick","DeleteRow('"+"re_row"+"',"+i+")");

new_td_7.appendChild(mahri_img);
			
			new_row.appendChild(new_td_1);
			new_row.appendChild(new_td_2);
			new_row.appendChild(new_td_3);
			new_row.appendChild(new_td_4);
			new_row.appendChild(new_td_5);
			new_row.appendChild(new_td_6);
			new_row.appendChild(new_td_7);
			new_row.setAttribute("id",'re_row'+i);
			//document.getElementById('multipels').appendChild(new_row);
			//'base_id'
			insertAfter(document.getElementById('base_id'),new_row);
			
			
			//Mytable.appendChild(new_row);
			
		//table.insertBefore(Mytable,table.childNodes[0].nextSibling);
			//table.insertBefore(new_row,table.childNodes[0].nextSibling);
			//table.insertBefore(BaseRow,table.childNodes[0].nextSibling);
			//var bef='first_direct'+dynamic;
			//insertAfter(document.getElementById(bef), new_row);
				//our_div.appendChild(Mytable);
		}
	}
	else
	{
		var new_row = document.createElement('tr');
		var new_td_1  = document.createElement("td");
		new_td_1.setAttribute("class","notavailable");
		new_td_1.setAttribute("colspan","6");
		//new_td_1.innerHTML='Products are not available !';
		//new_row.appendChild(new_td_1);
		//Mytable.appendChild(new_row);
		//our_div.appendChild(Mytable);
	}
	
		
		//------------------Segment For Attachements------------------------------
	/*	var our_div_attach = document.getElementById('Re_tender_attach');
		var Mytable_attach=document.createElement('table');
		var caption_attach = document.createElement('caption');
		caption_attach.innerHTML='Re-tender Attachements';
		Mytable_attach.setAttribute("id","attachmentsRe");
		Mytable_attach.setAttribute("padding","3px");
		var BaseRow_attach = document.createElement('tr');
		var BaseTh_attach_1 = document.createElement('th');
		BaseTh_attach_1.setAttribute("width","130px");
		BaseTh_attach_1.innerHTML='Title';
		var BaseTh_attach_2 = document.createElement('th');
		BaseTh_attach_2.setAttribute("width","160px");
		BaseTh_attach_2.innerHTML='File';
		BaseRow_attach.appendChild(BaseTh_attach_1);
		BaseRow_attach.appendChild(BaseTh_attach_2);
		Mytable_attach.appendChild(caption_attach);
		Mytable_attach.appendChild(BaseRow_attach); */
		if(attach_tender!="")
		{
			for(var m=0;m<(attach_tender.length)-1;m++)
			{
		 var AvaluesA = attach_tender[m].split(":~");
		 var new_row_attach = document.createElement('tr');
		 new_row_attach.setAttribute("class","dynamic_attachements_row_class");
		 var new_td_attach_1  = document.createElement("td");
		 var new_td_attach_2 = document.createElement("td");
		 var new_td_attach_4 = document.createElement("td");
		 new_td_attach_4.setAttribute("id","Re_Tender_Colm_Handle"+m);
		 var txtBoxForOtherTitle = document.createElement("input");
		 txtBoxForOtherTitle.type = 'hidden';
		 txtBoxForOtherTitle.setAttribute("name","Other_Title_Re[]");
		 //new_td_attach_4.appendChild(txtBoxForOtherTitle);
		 
		  var txtBoxForOtherTitleShow = document.createElement("input");
		 txtBoxForOtherTitleShow.type = 'text';
		 txtBoxForOtherTitleShow.setAttribute("name","Other_Title_Re[]");
		  txtBoxForOtherTitleShow.setAttribute("value",AvaluesA[5]);
		 if(AvaluesA[2]==10)
		 {
		 	new_td_attach_4.appendChild(txtBoxForOtherTitleShow);
		 }
		 else
		 {
		 	new_td_attach_4.appendChild(txtBoxForOtherTitle);
		 }
		 var new_td_attach_3 = document.createElement("td");
		 //IN Place of text box i am placing select box---
		// var textbox_attach_1 = document.createElement('input');
		 //textbox_attach_1.type = 'text';
		 //textbox_attach_1.setAttribute("name",'Title_Re[]');
		 //textbox_attach_1.setAttribute("width","130px");
		 //textbox_attach_1.setAttribute("id",'Title_re_id'+i);
		 //textbox_attach_1.setAttribute("value",AvaluesA[2]);
		 new_td_attach_1.appendChild(Title_Select_Box("Title_Re[]",m,AvaluesA[2]));
		 //new_td_attach_1.appendChild(textbox_attach_1);
		 
		 var textbox_attach_2 = document.createElement('input');
		 textbox_attach_2.type = 'text';
		 textbox_attach_2.setAttribute("name",'File_Real_Re[]');
		 textbox_attach_2.setAttribute("id",'File_real_id'+i);
		 textbox_attach_2.setAttribute("style","width:220px");
		 textbox_attach_2.setAttribute("readonly",'readonly');
		 textbox_attach_2.setAttribute("value",AvaluesA[4]);
		 new_td_attach_2.appendChild(textbox_attach_2);
		 //new_td_attach_1.appendChild(textbox_attach_1);
		 //new_td_attach_2.appendChild(textbox_attach_2);
		  var hidebox_attach = document.createElement('input');
		 hidebox_attach.type = 'hidden';
		 hidebox_attach.setAttribute("name",'File_Big_Re[]');
		 hidebox_attach.setAttribute("id",'File_big_id'+i);
		 hidebox_attach.setAttribute("value",AvaluesA[3]);
		 new_td_attach_2.appendChild(hidebox_attach);
		 
		 
		 var img_attach  = document.createElement("img");
		 img_attach.setAttribute("src","main_images/delete.png");
		 img_attach.setAttribute("onclick","DeleteRow('"+"re_row_attach"+"',"+i+")");
         new_td_attach_3.appendChild(img_attach);
		 
		 new_row_attach.appendChild(new_td_attach_1);
		 new_row_attach.appendChild(new_td_attach_2);
		 new_row_attach.appendChild(new_td_attach_4);
		 new_row_attach.appendChild(new_td_attach_3);
		 new_row_attach.setAttribute("id",'re_row_attach'+i);
		 //Mytable_attach.appendChild(new_row_attach);
		 //our_div_attach.appendChild(Mytable_attach);
		 insertAfter(document.getElementById('base_id_attachements'),new_row_attach);
		 
		 
		}
	}
	else
	{
		var new_row_attach = document.createElement('tr');
		//var new_td_attach_1  = document.createElement("td");
		//new_td_attach_1.setAttribute("colspan","2");
		//new_td_attach_1.setAttribute("class","notavailable");
		//new_td_attach_1.innerHTML='Attachments are not available !';
		//new_row_attach.appendChild(new_td_attach_1);
		//Mytable_attach.appendChild(new_row_attach);
		//our_div_attach.appendChild(Mytable_attach);
	}
		
		
		//---------------------------------------------------
		//---------------------SEGMENT FOR LIMITED FIRMS-----
		
		
////////////////////////REMOVING LIMITED FIRMS SECTION BASED ON OLD TENDER SELECTION/////////////////////////////////////////////////////////////////
/*		
		var our_div_limited_firm = document.getElementById('limited_firm_div');
		var Mytable_limited_firm=document.createElement('table');
		Mytable_limited_firm.setAttribute("class","ReAttachFirm");
		var caption_limited_firm = document.createElement('caption');
		caption_limited_firm.innerHTML='Re-tender Limited Firms';
		caption_limited_firm.setAttribute("id","attachmentsRe");
		Mytable_limited_firm.setAttribute("padding","3px");
		var BaseRow_limited_firm = document.createElement('tr');
		var BaseTh_limited_firm_1 = document.createElement('th');
		BaseTh_limited_firm_1.innerHTML='Add Firm';
		BaseRow_limited_firm.appendChild(BaseTh_limited_firm_1);
		Mytable_limited_firm.appendChild(caption_limited_firm);
		Mytable_limited_firm.appendChild(BaseRow_limited_firm);
		
		if(limited_firm_tender!="")
		{
			for(var Xx=0;Xx<(limited_firm_tender.length)-1;Xx++)
			{
			
		//LimitedFirm[]	
		 var FvaluesF = limited_firm_tender[Xx].split(":~");
		 
		 var new_row_limited_firm = document.createElement('tr');
		 var new_td_limited_firm_1  = document.createElement("td");
		 var new_td_limited_firm_2 = document.createElement("td");
		// var select_limited_firm = document.createElement('input');
		 //select_limited_firm.type = 'text';
		 new_td_limited_firm_1.appendChild(Re_Limited_Firm("LimitedFirm[]",i,FvaluesF[2]));
		
		 
		  var img_limited_firm  = document.createElement("img");
		 img_limited_firm.setAttribute("src","main_images/delete.png");
		 img_limited_firm.setAttribute("onclick","DeleteRow('"+"re_row_limited_firm"+"',"+Xx+")");
         new_td_limited_firm_2.appendChild(img_limited_firm);
		 
		 new_row_limited_firm.appendChild(new_td_limited_firm_1);
		 new_row_limited_firm.appendChild(new_td_limited_firm_2);
		 new_row_limited_firm.setAttribute("id",'re_row_limited_firm'+Xx);
		 Mytable_limited_firm.appendChild(new_row_limited_firm);		         }
	}
	 else
	 {
		 
		var new_row_limited_firm = document.createElement('tr');
		var new_td_limited_firm_1  = document.createElement("td");
		new_td_limited_firm_1.setAttribute("class","notavailable");
		new_td_limited_firm_1.innerHTML='Firms are not available !';
		new_row_limited_firm.appendChild(new_td_limited_firm_1);
		Mytable_limited_firm.appendChild(new_row_limited_firm);
	 }
		 our_div_limited_firm.appendChild(Mytable_limited_firm);
		 
		 
	*/
/////////////////////////////SECTION ENDS HERE FOR LIMITED FIRMS ADDING------------------		 
		
		
		//*****************************************---*******
		
		
	},
	error: function() {  
        
         document.getElementById('temp').innerHTML='There is some server error';
    }
	});
}
 
 function setBackConsigneeInRetender(orig_value)
 {
	 var allCnsgnList = CnsinList;
	var n=allCnsgnList.indexOf(orig_value); 
	var getSplitPoint = n-7;
	var FirstPart = allCnsgnList.substring(0,getSplitPoint);
	var SecPart = allCnsgnList.substring(getSplitPoint);
	var FinalString = FirstPart+" "+"selected='selected'"+" "+SecPart;
	return FinalString;
 }
 function add_more_limited_firms()
 {
	 var counter=document.getElementById('limited_firm_counter').value;	
	 counter=parseInt(counter);
	 var dynamic=counter-1;
	 var new_row = document.createElement('tr');
	 var new_td_1  = document.createElement("td");
	 new_td_1.appendChild(AllFirms("LimitedFirm[]",counter));
	 new_row.appendChild(new_td_1);
	 new_row.setAttribute('id','row_for_limited_firm_'+counter);
	 var bef='row_for_limited_firm_'+dynamic;
	 insertAfter(document.getElementById(bef), new_row);
     counter++;
     document.getElementById('limited_firm_counter').value=counter;
	 
}

function insertAfter(target, el) {
	
    if( !target.nextSibling )
        target.parentNode.appendChild( el );
    else
        target.parentNode.insertBefore( el, target.nextSibling );
}// JavaScript Document
function Title_Select_Box(name,counter,value)
{
	
	var new_select = document.createElement('select');
	//new_select.setAttribute("id",value);
	new_select.setAttribute("name",name);
	new_select.setAttribute("id","Re_Select_Box_"+counter);
	new_select.setAttribute("style","width:120px;height:30px;border:1px solid #333;");
	new_select.setAttribute("onChange","Re_Tender_On_Change_select_box(this.id)");
	
	var new_opt = GetTitleOption(value);
  
	new_select.innerHTML=new_opt;
	return new_select;
}
function GetTitleOption(IU)
{
	if(IU==1)
	var option='NIT';
	if(IU==2)
	var option='Specification';
	if(IU==3)
	var option='Drawing Copy';
	if(IU==4)
	var option='Annulav';
	if(IU==5)
	var option='Special Caution';
	if(IU==10)
	var option='Others';
	var uData = "<option value="+IU+">"+option+"</option>"
	
	if(IU!=1)
	uData += "<option value='1'>NIT</option>"
	if(IU!=2)
	uData += "<option value='2'>Specification</option>"
	if(IU!=3)
	uData += "<option value='3'>Drawing Copy</option>"
	if(IU!=4)
	uData += "<option value='4'>Annulav</option>"
	if(IU!=5)
	uData += "<option value='5'>Special Caution</option>"
	if(IU!=10)
	uData += "<option value='10'>Others</option>"
	return uData;
}
function Re_Tender_On_Change_select_box(ss)
{
	
	var tm = ss.split("Re_Select_Box_");
	var mm = parseInt(tm[1]);
	
	var select_id = document.getElementById('Re_Select_Box_'+mm).value;
	if(select_id==10)
	{
		
		
		document.getElementById('Re_Tender_Colm_Handle'+mm).innerHTML="<input type='text' id='Other_Title_Re' name='Other_Title_Re[]' placeholder='Other Title'>";
	}
	else
	{
			document.getElementById('Re_Tender_Colm_Handle'+mm).innerHTML="<input type='hidden' id='Other_Title_Re' name='Other_Title_Re[]'>";
	}
}
function DeleteThisPrintedFirmRow(id,tender_id,color)
{
	
	var ty = confirm("Are you sure to delete this record");
	if(ty==1)
	{
	//$('#Remove_firm_printed_row_'+id).remove();
	$.ajax({
		url:'MainAjax.php',
		data:'printed_firm_id_for_bid_to_del='+id+'&tender_id_at_printed_firm_time='+tender_id,
		type:'get',
		success:function(response){
			//$('#Remove_firm_printed_row_'+id).remove();
			window.location="tender_quot_new.php?id="+tender_id+"&val="+color;
			
		},
		error:function(response){
			alert('there is some error');
		}
		
		
	});
	}
	else
	{
		return false;
	}
}
function Add_More_Tender_Bid_Attachements()
{
	var np = document.getElementById('hide_for_add_firm').value;
	var dynamic_firm_row = parseInt(np);
	var counter=dynamic_firm_row+1;
	var after_it = dynamic_firm_row-1;

var new_row = document.createElement('tr');
new_row.setAttribute('id','SHAKEB_'+dynamic_firm_row);
var new_td_1  = document.createElement("td");
var select_box = document.createElement('select');
select_box.setAttribute('name','titles[]');
select_box.setAttribute('id','title_'+dynamic_firm_row);
select_box.setAttribute('onchange','IfSelectOtherThenTitle(this.id)');
select_box.setAttribute("style","width:120px;height:30px;border:1px solid #333;")
select_box.innerHTML="<option value=''>Please select</option><option value='1'>Financial Tabulation</option><option value='2'>Technical Tabulation</option><option value='3'>Mannual Tabulation</option><option value='4'>Correspondance</option>";

var new_td_2 = document.createElement("td");
var new_td_3 = document.createElement("td");
new_td_3.setAttribute('id','SHAKEB_COLM_'+dynamic_firm_row);
 
//new_td_1.innerHTML = "<input type='text' name='titles[]'/>";
new_td_1.appendChild(select_box);
new_td_2.innerHTML = "<input type='file' name='files[]'/>";
new_td_3.innerHTML = "<input type='hidden' id='text_on_others' name='text_on_others[]'>";


new_row.appendChild(new_td_1);
new_row.appendChild(new_td_2);
new_row.appendChild(new_td_3);

insertAfter(document.getElementById('SHAKEB_'+after_it), new_row);
document.getElementById('hide_for_add_firm').value=counter;
}
function Add_More_Po_Attachements()
{
		var np = document.getElementById('hide_for_add_firm').value;
	var dynamic_firm_row = parseInt(np);
	var counter=dynamic_firm_row+1;
	var after_it = dynamic_firm_row-1;

var new_row = document.createElement('tr');
new_row.setAttribute('id','SHAKEB_'+dynamic_firm_row);
var new_td_1  = document.createElement("td");
var select_box = document.createElement('select');
select_box.setAttribute('name','titles[]');
select_box.setAttribute('id','title_'+dynamic_firm_row);
select_box.setAttribute('onchange','IfSelectOtherThenTitle(this.id)');
select_box.setAttribute("style","width:120px;height:30px;border:1px solid #333;")
select_box.innerHTML="<option value=''>Please select</option><option value='1'>IC Copy</option><option value='2'>PO Copy</option><option value='3'>Challan</option><option value='4'>Bill Copy</option><option value='5'>Full Case</option><option value='6'>R. Note</option><option value='10'>Others</option>";

var new_td_2 = document.createElement("td");
var new_td_3 = document.createElement("td");
new_td_3.setAttribute('id','SHAKEB_COLM_'+dynamic_firm_row);
 
//new_td_1.innerHTML = "<input type='text' name='titles[]'/>";
new_td_1.appendChild(select_box);
new_td_2.innerHTML = "<input type='file' name='files[]'/>";
new_td_3.innerHTML = "<input type='hidden' id='text_on_others' name='text_on_others[]'>";


new_row.appendChild(new_td_1);
new_row.appendChild(new_td_2);
new_row.appendChild(new_td_3);

insertAfter(document.getElementById('SHAKEB_'+after_it), new_row);
document.getElementById('hide_for_add_firm').value=counter;
	
}

function Add_More_Specification_Attachements()
{
	var np = document.getElementById('hide_for_add_firm').value;
	var dynamic_firm_row = parseInt(np);
	var counter=dynamic_firm_row+1;
	var after_it = dynamic_firm_row-1;

var new_row = document.createElement('tr');
new_row.setAttribute('id','SHAKEB_'+dynamic_firm_row);
/*var new_td_1  = document.createElement("td");
var select_box = document.createElement('select');
select_box.setAttribute('name','titles[]');
select_box.setAttribute('id','title_'+dynamic_firm_row);
select_box.setAttribute('onchange','IfSelectOtherThenTitle(this.id)');
select_box.setAttribute("style","width:120px;height:30px;border:1px solid #333;")
select_box.innerHTML="<option value=''>Please select</option><option value='1'>BIS</option><option value='2'>DGQA</option><option value='3'>Railway</option><option value='4'>DGS & D</option><option value='10'>Others</option>";*/

var new_td_2 = document.createElement("td");
var new_td_3 = document.createElement("td");
new_td_3.setAttribute('id','SHAKEB_COLM_'+dynamic_firm_row);
 
//new_td_1.innerHTML = "<input type='text' name='titles[]'/>";
//new_td_1.appendChild(select_box);
new_td_2.innerHTML = "<input type='file' name='files[]'/>";
new_td_3.innerHTML = "<input type='hidden' id='text_on_others' name='text_on_others[]'>";


//new_row.appendChild(new_td_1);
new_row.appendChild(new_td_2);
new_row.appendChild(new_td_3);

insertAfter(document.getElementById('SHAKEB_'+after_it), new_row);
document.getElementById('hide_for_add_firm').value=counter;
	
}
 
 
 
<!---------------------validation to allow only numeric keyword--------> 
 $('.class_for_only_numeric_values').live('keydown',function(e){
	  var tj = $(this).val();
	  var ingnore_key_codes = [];
   var valid_key_codes = [];
   var lowEnd=65;
   var highEnd=90;
   while(lowEnd<=highEnd)
   {
	   ingnore_key_codes.push(lowEnd);
	   lowEnd++;
   }
   //ingnore_key_codes.push(32,186,187,188,189,191,219,220,221,222,106,107,109,110,111);
   ingnore_key_codes.push(32,186,187,188,189,191,219,220,221,222,106,107,109,111,59);
   var numeric_low_end=48;
   var numeric_high_end=57;
   var numeric_key=96;
   while(numeric_low_end<=numeric_high_end)
   {
	   valid_key_codes.push(numeric_low_end);
	  valid_key_codes.push(numeric_key);
	   numeric_low_end++;
	   numeric_key++;
	}
	valid_key_codes.push(110,190);
	
   if ($.inArray(e.keyCode, ingnore_key_codes) >= 0){
      e.preventDefault();
   }
   else
   {
	  var mp=$(this).val();
	  if(mp.indexOf(".") > -1)
        {
           var si=mp.length-(mp.indexOf(".")+1);
		   si=parseInt(si);
		 	if(si>1)
			{
				
			 if ($.inArray(e.keyCode, valid_key_codes) >= 0){
      e.preventDefault();
   			}
			  
			 }
        }
	   
   }
   
});
function Add_More_Firms_In_Bid_Number_Manuual_New(p,s)
{
	
	var product_id=parseInt(p);
	var counter = parseInt(document.getElementById('hidden_for_manuual_bid_firms_hh_'+product_id).value);
	
	
	
	
	//var counter=parseInt(s);
	var bi=counter+1;
	var new_row = document.createElement('tr');
    new_row.setAttribute('id','row_under_products_'+p+'_'+bi);
    var new_td_1  = document.createElement("td");
    new_td_1.appendChild(getFirms("Firms_For_Adding_In_Mannual_Bid[]"));
    var new_td_2 = document.createElement("td");
    var new_td_3 = document.createElement("td");
  new_td_2.innerHTML = "<input type='text' name='Bid_Number_For_Flag1_Firms[]' placeholder='Bid Number'/>";
  new_td_3.innerHTML = "<input type='hidden' name='Product_Id_For_Flag1_Firms[]' value='"+product_id+"'>";


new_row.appendChild(new_td_1);
new_row.appendChild(new_td_2);
new_row.appendChild(new_td_3);
//CONDITION IF THERE IS NOT A SINGLE ROW BY DEFAULT..
if(counter==0)
{
	insertAfter(document.getElementById('row_without_firms_'+p), new_row);
}
else
{
insertAfter(document.getElementById('row_under_products_'+p+'_'+counter), new_row);
}
//counter++;
document.getElementById('hidden_for_manuual_bid_firms_hh_'+product_id).value=bi;
//document.getElementById('hide_for_add_firm').value=counter;*/
	
}
function Add_More_After_Pending_Status()
{
	var np = document.getElementById('hide_for_add_firm').value;
	var dynamic_firm_row = parseInt(np);
	var counter=dynamic_firm_row+1;
	var after_it = dynamic_firm_row-1;

var new_row = document.createElement('tr');
new_row.setAttribute('id','SHAKEB_'+dynamic_firm_row);
//var new_td_1  = document.createElement("td");
/*var select_box = document.createElement('select');
select_box.setAttribute('name','titles[]');
select_box.setAttribute('id','title_'+dynamic_firm_row);
select_box.setAttribute('onchange','IfSelectOtherThenTitle(this.id)');
select_box.setAttribute("style","width:120px;height:30px;border:1px solid #333;")
select_box.innerHTML="<option value=''>Please select</option><option value='1'>NIT</option><option value='2'>Specification</option><option value='3'>Drawing Copy</option><option value='4'>Annexures</option><option value='5'>Special Conditions</option><option value='10'>Others</option>";*/

var new_td_2 = document.createElement("td");
//var new_td_3 = document.createElement("td");
//new_td_3.setAttribute('id','SHAKEB_COLM_'+dynamic_firm_row);
 

//new_td_1.appendChild(select_box);
new_td_2.innerHTML = "<input type='file' name='files[]'/>";
//new_td_3.innerHTML = "<input type='hidden' id='text_on_others' name='text_on_others[]'>";


//new_row.appendChild(new_td_1);
new_row.appendChild(new_td_2);
//new_row.appendChild(new_td_3);

insertAfter(document.getElementById('SHAKEB_'+after_it), new_row);
document.getElementById('hide_for_add_firm').value=counter;
	
}

<!-------->
function AddPoSectionInfo(val,main_table,product_table,attach_table)
{
	
	var id_x = val.split(':(');
	var id = id_x[1].split(')');
	$.ajax({
    url:'MainAjax.php',
    type:'get',
	//async:false,
    data:'Tender_id_for_po_statement='+id[0],
    success : function(response){
		
		//var Pjson = jQuery.parseJSON(response);
		var values = response.split("|||")
		var base_tender=values[0].split(":~");
		
		//var product_tender=values[1].split("%$");
		
		
		document.getElementById('tender_purchaser_name').value=base_tender[2];
		document.getElementById('tender_office_name').value=base_tender[3];
		document.getElementById('hide_for_tender_office').value=base_tender[0];
		document.getElementById('hide_for_tender_purchaser').value=base_tender[1];
		document.getElementById('name_of_firm').innerHTML=values[1];
		document.getElementById('file_number').value=values[2];
		/////////////////////////////////////////////////////////////
		/////////////////////////ADDING RE PRODUCTS///////////////
		
	
		
		/////////////////////////////////////////////////////////////
		CnsignListonPurchaser(base_tender[1],'meenu');
		document.getElementById('presidentsServerInput').value=id_x[0];
		document.getElementById('hidden_box_for_tender_id_of_first_optn').value=id[0];
	
	},
	error: function() {  
        //$('#'+loader).hide();
       //  document.getElementById(span).innerHTML='There is some server error';
    }
	});
	
}
function AddProductsInPoSectionReProduct(firm_id)
{
	 $('.dynamic_products_row_class').remove();
	 $('.dynamic_attachements_row_class').remove();
	
	
	var tender_type = document.getElementById('tender_type').value
	if(tender_type==2 || tender_type==3 || tender_type=='')
	{
		return false;
	}
	else
	{
		if(firm_id=='')
		{
			
			return false;
		}
		else
		{
			
	var tender_id = document.getElementById('hidden_box_for_tender_id_of_first_optn').value;
	
	$.ajax({
    url:'MainAjax.php',
    type:'get',
	data:'Add_Old_Products_In_Po_Section_Firm_Id='+firm_id+'&Add_Old_Products_In_Po_Section_Tender_Id='+tender_id,
    success : function(response){
		
		var values_two_part = response.split('|||');
		var product_tender = values_two_part[0].split('%$');
		var attach_tender = values_two_part[1].split('%$');
	   /////////////////Adding re products/////////////
	   for(var i=0;i<(product_tender.length)-1;i++)
		{
			var PvaluesP = product_tender[i].split(":~");
			var new_row = document.createElement('tr');
			new_row.setAttribute("class","dynamic_products_row_class");
			var new_td_1  = document.createElement("td");
			var new_td_2 = document.createElement("td");
			var new_td_3  = document.createElement("td");
			var new_td_4  = document.createElement("td");
			var new_td_5  = document.createElement("td");
			var new_td_6 = document.createElement("td");
			var new_td_7 = document.createElement("td");
			var new_td_8 = document.createElement("td");
			var new_td_9 = document.createElement("td");
			var new_td_10 = document.createElement("td");
			var new_td_11 = document.createElement("td");
			var new_td_12 = document.createElement("td");
			var new_td_13 = document.createElement("td");
			var new_td_14 = document.createElement("td");
			var new_td_15 = document.createElement("td");
			var new_td_16 = document.createElement("td");
			var textbox = document.createElement('input');
			textbox.type = 'text';
			textbox.setAttribute("name",'category[]');
			textbox.setAttribute("id",'category_re_'+i);
			textbox.setAttribute("class","kareena");
			textbox.setAttribute("value",PvaluesP[0]);
			textbox.setAttribute("style","width:200px");
			new_td_1.appendChild(textbox);
			new_td_2.appendChild(Re_getSelectBox3("inspection[]",i,PvaluesP[1]));
			new_td_3.innerHTML = "<textarea rows='3' cols='28' name='discription[]' style='border:1px solid #666' id='discription_re_'+i>"+PvaluesP[2]+"</textarea>";
			//////////////////////////////////////
			var select_cnsignee = document.createElement('select');
			select_cnsignee.setAttribute("name","consignee[]");
			select_cnsignee.setAttribute("class","selectD");
			select_cnsignee.setAttribute("id","consignee_re_"+i);
			select_cnsignee.innerHTML=setBackConsigneeInRetender(PvaluesP[3]);
			
			
			new_td_4.appendChild(select_cnsignee);
			//new_td_4.appendChild(Re_Consignee("consignee[]",i,PvaluesP[5]));;
			new_td_5.innerHTML = "<input type='text' name='quantity[]' style='width:80px' id='quantity_re_"+i+"' value='"+PvaluesP[4]+"'/>";

new_td_6.appendChild(Re_getSelectBoxUnit("unit[]",i,PvaluesP[5]));


var mahri_img  = document.createElement("img");
mahri_img.setAttribute("src","main_images/delete.png");
mahri_img.setAttribute("onclick","DeleteRow('"+"re_row"+"',"+i+")");

new_td_7.appendChild(mahri_img);
		new_td_8.innerHTML = "<input type='text' name='rate[]' style='width:80px' id='rate_re_"+i+"' value='"+PvaluesP[6]+"'/>";	
		new_td_9.appendChild(Re_getTaxType("taxtype[]",i,PvaluesP[7]));
		new_td_10.innerHTML = "<input type='text' name='includingall[]' style='width:100px' id='includingall_re_"+i+"' value='' />";
		new_td_11.innerHTML = "<input type='text' name='totalvalue[]' style='width:100px' id='totalvalue_re_"+i+"' value=''/>";
		new_td_12.innerHTML = "<select name='payment[]' id='payment_re_"+i+"' style='width:80px;' class='selectD' onChange='XShowPaymentOther(this.id)'><option value=''>Please Select</option><option value='1'>100% against supply</option><option value='2'>98% + 2%</option><option value='3'>98% + 5%</option><option value='4'>90% + 10%</option><option value='10'>Other</option></select>&nbsp;<input type='text' name='paymentother[]' style='display:none;width:80px;' id='paymentother_re_"+i+"' value=''/>";
		new_td_13.innerHTML = "<input type='text' name='payingauthority[]' style='width:100px' id='payingauthority_re_"+i+"' value=''/>";
		new_td_14.innerHTML = "<input type='text' name='inspectionplace[]' style='width:100px' id='inspectionplace_re_"+i+"' value=''/>";
		new_td_15.innerHTML = "<input type='text' name='deliverydate[]' style='width:100px' id='deliverydate_re_"+i+"' value='' class='meenu'/>";
		new_td_16.innerHTML = "<input type='text' name='quantitymannual[]' style='width:100px' id='quantitymannual_re_"+i+"' value=''/>";
			new_row.appendChild(new_td_1);
			new_row.appendChild(new_td_2);
			new_row.appendChild(new_td_3);
			new_row.appendChild(new_td_4);
			new_row.appendChild(new_td_5);
			new_row.appendChild(new_td_6);
			new_row.appendChild(new_td_8);
			new_row.appendChild(new_td_9);
			new_row.appendChild(new_td_10);
			new_row.appendChild(new_td_11);
			new_row.appendChild(new_td_12);
			new_row.appendChild(new_td_13);
			new_row.appendChild(new_td_14);
			new_row.appendChild(new_td_15);
			new_row.appendChild(new_td_16);
			new_row.appendChild(new_td_7);
			new_row.setAttribute("id",'re_row'+i);
			insertAfter(document.getElementById('base_id'),new_row);
		}
	
		
	   ////////////////////////////////////////////////
	   if(attach_tender!="")
		{
			for(var m=0;m<(attach_tender.length)-1;m++)
			{
		 var AvaluesA = attach_tender[m].split(":~");
		 var new_row_attach = document.createElement('tr');
		 new_row_attach.setAttribute("class","dynamic_attachements_row_class");
		 var new_td_attach_1  = document.createElement("td");
		 var new_td_attach_2 = document.createElement("td");
		 var new_td_attach_4 = document.createElement("td");
		 new_td_attach_4.setAttribute("id","Re_Tender_Colm_Handle"+m);
		 var txtBoxForOtherTitle = document.createElement("input");
		 txtBoxForOtherTitle.type = 'hidden';
		 txtBoxForOtherTitle.setAttribute("name","Other_Title_Re[]");
		 //new_td_attach_4.appendChild(txtBoxForOtherTitle);
		 
		  var txtBoxForOtherTitleShow = document.createElement("input");
		 txtBoxForOtherTitleShow.type = 'text';
		 txtBoxForOtherTitleShow.setAttribute("name","Other_Title_Re[]");
		  txtBoxForOtherTitleShow.setAttribute("value",AvaluesA[5]);
		 if(AvaluesA[2]==10)
		 {
		 	new_td_attach_4.appendChild(txtBoxForOtherTitleShow);
		 }
		 else
		 {
		 	new_td_attach_4.appendChild(txtBoxForOtherTitle);
		 }
		 var new_td_attach_3 = document.createElement("td");
		  new_td_attach_1.appendChild(Title_Select_Box("Title_Re[]",m,AvaluesA[2]));
		var textbox_attach_2 = document.createElement('input');
		 textbox_attach_2.type = 'text';
		 textbox_attach_2.setAttribute("name",'File_Real_Re[]');
		 textbox_attach_2.setAttribute("id",'File_real_id'+i);
		 textbox_attach_2.setAttribute("style","width:220px");
		 textbox_attach_2.setAttribute("readonly",'readonly');
		 textbox_attach_2.setAttribute("value",AvaluesA[4]);
		 new_td_attach_2.appendChild(textbox_attach_2);
		 
		  var hidebox_attach = document.createElement('input');
		 hidebox_attach.type = 'hidden';
		 hidebox_attach.setAttribute("name",'File_Big_Re[]');
		 hidebox_attach.setAttribute("id",'File_big_id'+i);
		 hidebox_attach.setAttribute("value",AvaluesA[3]);
		 new_td_attach_2.appendChild(hidebox_attach);
		 
		 
		 var img_attach  = document.createElement("img");
		 img_attach.setAttribute("src","main_images/delete.png");
		 img_attach.setAttribute("onclick","DeleteRow('"+"re_row_attach"+"',"+i+")");
         new_td_attach_3.appendChild(img_attach);
		 
		 new_row_attach.appendChild(new_td_attach_1);
		 new_row_attach.appendChild(new_td_attach_2);
		 new_row_attach.appendChild(new_td_attach_4);
		 new_row_attach.appendChild(new_td_attach_3);
		 new_row_attach.setAttribute("id",'re_row_attach'+i);
		 //Mytable_attach.appendChild(new_row_attach);
		 //our_div_attach.appendChild(Mytable_attach);
		 insertAfter(document.getElementById('base_id_attachements'),new_row_attach);
		 
		 
		}
	}
	else
	{
		var new_row_attach = document.createElement('tr');
		
	}
	   //////////////////////////////////////////////////
	
		
		document.getElementById('hidden_box_for_tender_id_of_first_optn').value=id[0];
	
	},
	error: function() {  
        //$('#'+loader).hide();
       //  document.getElementById(span).innerHTML='There is some server error';
    }
	});
	
	}
		
	}
	
	
}

function GenerateFileNumberInSecondOpt(hi_j)
{
	var sm = $("#tender_office option:selected").html();
	$.ajax({
    url:'MainAjax.php',
    type:'get',
	//async:false,
    data:'GetFirmNameInPoSecondOptionHere='+sm,
    success : function(response){
		
		document.getElementById('file_number').value=response;
		
	},
	error: function() {  
        //$('#'+loader).hide();
       //  document.getElementById(span).innerHTML='There is some server error';
    }
	});
}