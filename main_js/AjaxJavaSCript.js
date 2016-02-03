function CnsignListonPurchaser(purchaserID,t)
{
	 $('.dynamic_products_row_class').remove();
	 $('.dynamic_attachements_row_class').remove();
	 if(t!='meenu')
	 {
	 document.getElementById('presidentsServerInput').value='';
	 document.getElementById('tender_number_span').innerHTML='';
	 }
	 
	
	var TDNO = $('#presidentsServerInput').val();
	if(TDNO!='')
	{
		 CheckTenderNumber(TDNO)
	}
	
	getVals(purchaserID);
	var TotalCnsign = document.getElementsByName('consignee[]').length;
	if(TotalCnsign==0)
	{
	TotalCnsign=1;	
	}
	var CnsignListCall;
			try
			{
				CnsignListCall = new XMLHttpRequest();
			}
			catch (e)
			{
				try
				{
					CnsignListCall = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch (e) 
				{
					try
					{
						CnsignListCall = new ActiveXObject("Microsoft.XMLHTTP");
					}
					catch (e)
					{
						alert("Your browser broke!");
						return false;
					}
				}
			}	

			CnsignListCall.onreadystatechange = function()
			{
				if(CnsignListCall.readyState == 4)
				{
					
					// window.CnsinList = document.getElementById('consignee0').innerHTML = CnsignListCall.responseText;
					for(var i=0;i<TotalCnsign;i++)
					{
						//var m=i+1;
					 window.CnsinList = document.getElementsByName("consignee[]")[i].innerHTML = CnsignListCall.responseText;	
					}
					
					return false;
					
				}
			}
	
	CnsignListCall.open("GET","MainAjax.php?purchaserID="+purchaserID,true);
	CnsignListCall.send(null);
	
}
function CnsignListonPurchaserHistory(purchaserID,t)
{
	// $('.dynamic_products_row_class').remove();
	// $('.dynamic_attachements_row_class').remove();
	 /*if(t!='meenu')
	 {
	 document.getElementById('presidentsServerInput').value='';
	 document.getElementById('tender_number_span').innerHTML='';
	 }
	 
	
	var TDNO = $('#presidentsServerInput').val();
	if(TDNO!='')
	{
		 CheckTenderNumber(TDNO)
	}*/
	
	getVals(purchaserID);
	var TotalCnsign = document.getElementsByName('consignee[]').length;
	if(TotalCnsign==0)
	{
	TotalCnsign=1;	
	}
	var CnsignListCall;
			try
			{
				CnsignListCall = new XMLHttpRequest();
			}
			catch (e)
			{
				try
				{
					CnsignListCall = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch (e) 
				{
					try
					{
						CnsignListCall = new ActiveXObject("Microsoft.XMLHTTP");
					}
					catch (e)
					{
						alert("Your browser broke!");
						return false;
					}
				}
			}	

			CnsignListCall.onreadystatechange = function()
			{
				if(CnsignListCall.readyState == 4)
				{
					
					// window.CnsinList = document.getElementById('consignee0').innerHTML = CnsignListCall.responseText;
					for(var i=0;i<TotalCnsign;i++)
					{
						//var m=i+1;
					 window.CnsinList = document.getElementsByName("consignee[]")[i].innerHTML = CnsignListCall.responseText;	
					}
					
					return false;
					
				}
			}
	
	CnsignListCall.open("GET","MainAjax.php?purchaserID="+purchaserID,true);
	CnsignListCall.send(null);
	
}
function CnsignListonPurchaserChild(purchaserID)
{
	
	
	//var TotalCnsign = document.getElementsByName('consignee[]').length;
	//if(TotalCnsign==0)
	//{
	//TotalCnsign=1;	
	//}
	var CnsignListCallChild;
			try
			{
				CnsignListCallChild = new XMLHttpRequest();
			}
			catch (e)
			{
				try
				{
					CnsignListCallChild = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch (e) 
				{
					try
					{
						CnsignListCallChild = new ActiveXObject("Microsoft.XMLHTTP");
					}
					catch (e)
					{
						alert("Your browser broke!");
						return false;
					}
				}
			}	

			CnsignListCallChild.onreadystatechange = function()
			{
				if(CnsignListCallChild.readyState == 4)
				{
					
					document.getElementById('consignee_update_0_X').innerHTML = CnsignListCallChild.responseText;
					 return false;
					
				}
			}
	
	CnsignListCallChild.open("GET","MainAjax.php?purchaserID="+purchaserID,true);
	CnsignListCallChild.send(null);
	
}

function SaveProduct(hidetotal,consignee,inspection,tdc,emd)
{
	
	
	//valuesAll = $('#'+formid).serialize();
	//alert(valuesAll);
	
	var totalfirms = document.getElementById('hide'+hidetotal).value;
	//var response = new Array(); 
	for(var i=0;i<=totalfirms;i++)
	{
		var span = 'msgspanX_'+hidetotal+'_'+i;
		var loader = 'loader_'+hidetotal+'_'+i;
		var firm = document.getElementById('firm_'+hidetotal+'_'+i).value;
		if(firm=="")
		{
			alert('Please select firm');
			return false;
		}
		//var consignee = document.getElementById('consignee_'+hidetotal+'_'+i).value;
		//var inspection = document.getElementById('inspection_'+hidetotal+'_'+i).value;
	var quantity = document.getElementById('quantity_'+hidetotal+'_'+i).value;
	var unitX = document.getElementById('unit_'+hidetotal+'_'+i).value;
	
	//var tdc = document.getElementById('tdc_'+hidetotal+'_'+i).value;
	//var emd = document.getElementById('emd_'+hidetotal+'_'+i).value;
	var rate = document.getElementById('rate_'+hidetotal+'_'+i).value;
	var taxtype = document.getElementById('taxtype_'+hidetotal+'_'+i).value;
	
	var taxper = document.getElementById('taxper_'+hidetotal+'_'+i).value;
	var taxamount = document.getElementById('taxamount_'+hidetotal+'_'+i).value;
	var disper = document.getElementById('disper_'+hidetotal+'_'+i).value;
	var disamount = document.getElementById('disamount_'+hidetotal+'_'+i).value;
	var othercharg = document.getElementById('othercharg_'+hidetotal+'_'+i).value;
	var validday = document.getElementById('validday_'+hidetotal+'_'+i).value;
	var payment = document.getElementById('payment_'+hidetotal+'_'+i).value;
	var delperod = document.getElementById('delperod_'+hidetotal+'_'+i).value;
	var delschedule = document.getElementById('delschedule_'+hidetotal+'_'+i).value;
	var remark = document.getElementById('remark_'+hidetotal+'_'+i).value;
	var spinate = document.getElementById('spinate_'+hidetotal+'_'+i).value;
	//------------VALIDATION WITH JAVASCRIPT--------------------
	quantity = quantity.replace(/^\s+|\s+$/g,'');
	if(quantity=="")
	{
		alert('Please fill Quantity');
		return false;
	}
	if(isNaN(quantity))
	{
 		alert("Quantity must be numeric");
		return false;
	}
	unitX = unitX.replace(/^\s+|\s+$/g,'');
	if(unitX=='')
	{
		alert('Please fill Unit');
		return false;
	}
	rate = rate.replace(/^\s+|\s+$/g,'');
	if(rate=="")
	{
		alert('Please fill Rate');
		return false;
	}
	if(isNaN(rate))
	{
		alert('Rate must be numeric');
		return false;
	}
	taxper = taxper.replace(/^\s+|\s+$/g,'');
	if(taxper=="")
	{
		alert('Please fill Tax %');
		return false;
	}
	if(isNaN(taxper))
	{
		alert('Tax % must be numeric');
		return false;
	}
	disper = disper.replace(/^\s+|\s+$/g,'');
	if(isNaN(disper))
	{
		alert('Discount % must be numeric');
		return false;
	}
	othercharg = othercharg.replace(/^\s+|\s+$/g,'');
	if(isNaN(othercharg))
	{
		alert('Other Charges must be numeric');
		return false;
	}
	validday = validday.replace(/^\s+|\s+$/g,'');
	if(validday=="")
	{
		alert('Please fill Validity days');
		return false;
	}
//--************************************************----------
	AjaxRequest(firm,consignee,inspection,quantity,unitX,tdc,emd,rate,taxtype,taxper,taxamount,disper,disamount,othercharg,validday,payment,delperod,delschedule,remark,spinate,span,hidetotal,loader);
	
	/*var valuesAllCall;
			try
			{
				valuesAllCall = new XMLHttpRequest();
				
			}
			catch (e)
			{
				try
				{
					valuesAllCall = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch (e) 
				{
					try
					{
						valuesAllCall = new ActiveXObject("Microsoft.XMLHTTP");
						
					}
					catch (e)
					{
						alert("Your browser broke!");
						return false;
					}
				}
			}	

			valuesAllCall.onreadystatechange = function()
			{
				if(valuesAllCall.readyState == 4)
				{
					if(valuesAllCall.status==200)
					{
					
				//alert('shakeb');
				response[i]=valuesAllCall.responseText;
				alert(response[i]);
					}
				//document.getElementById(span).innerHTML = valuesAllCall.responseText;
				//var jj = valuesAllCall.responseText;	
				//shaan(span,valuesAllCall.responseText);
					
				}
			}
	
	valuesAllCall.open("GET","MainAjax.php?firm="+firm+"&consignee="+consignee+"&inspection="+inspection+"&quantity="+quantity+"&unit="+unitX+"&tdc="+tdc+"&emd="+emd+"&rate="+rate+"&taxtype="+taxtype+"&taxper="+taxper+"&taxamount="+taxamount+"&disper="+disper+"&disamount="+disamount+"&othercharg="+othercharg+"&validday="+validday+"&payment="+payment+"&delperod="+delperod+"&delschedule="+delschedule+"&remark="+remark+"&spinate="+spinate+"&PRODUCTID="+hidetotal,true);
	valuesAllCall.send(null);*/
	}
}
function AjaxRequest(firm,consignee,inspection,quantity,unitX,tdc,emd,rate,taxtype,taxper,taxamount,disper,disamount,othercharg,validday,payment,delperod,delschedule,remark,spinate,span,hidetotal,loader)
{
	$('#'+loader).show();
	$.ajax({
    url:'MainAjax.php',
    type:'get',
	//async:false,
    data:'firm='+firm+'&consignee='+consignee+'&inspection='+inspection+'&quantity='+quantity+'&unit='+unitX+'&tdc='+tdc+'&emd='+emd+'&rate='+rate+'&taxtype='+taxtype+'&taxper='+taxper+'&taxamount='+taxamount+'&disper='+disper+'&disamount='+disamount+'&othercharg='+othercharg+'&validday='+validday+'&payment='+payment+'&delperod='+delperod+'&delschedule='+delschedule+'&remark='+remark+'&spinate='+spinate+'&PRODUCTID='+hidetotal,
    success : function(response){
		$('#'+loader).hide();
	document.getElementById(span).innerHTML=response;
	},
	error: function() {  
        $('#'+loader).hide();
         document.getElementById(span).innerHTML='There is some server error';
    }
	});
}
function FirmAcordingChange(firm_id_tender,id_box)
{
	var take=id_box.split("_"); 
	
	
	if(firm_id_tender=='')
	{
		$('#delperod_'+take[1]).val('');
		$('#delschedule_'+take[1]).val('');
		return false;
	}
	else
	{
		
		$.ajax({
    	url:'MainAjax.php',
		type:'post',
		data:'firm_id_tender='+firm_id_tender,
		success : function(response){
		var json = jQuery.parseJSON(response);
		$('#delperod_'+take[1]).val(json[0]);
		$('#delschedule_'+take[1]).val(json[1]);
		$('#remark_'+take[1]).val(json[2]);
			//$('#'+i).val(json[i]);
	},
		error: function() {  
        alert('Some tecnical error');
    	}
	});
	
	}
	
}
function OtherChargesAmount(id)
{
	var take2=id.split("_");
	var oc=document.getElementById('othercharg_'+take2[1]).value; 
	var rate=document.getElementById('rate_'+take2[1]).value; 
	rate=rate.trim();
	oc=oc.trim();
	var oct = document.getElementById('oct_'+take2[1]).value;
	if(oct==1)
		{
			window.oca=(rate*oc)/100;
			document.getElementById('oca_'+take2[1]).value=oca;
		}
	else
	{
		window.oca=oc;
		document.getElementById('oca_'+take2[1]).value=oca;
	}
	
	
	
}
function TaxCalculation(id_tax)
	{
	var take3=id_tax.split("_");
	var tt=document.getElementById('taxtype_'+take3[1]).value; 
	var rate=document.getElementById('rate_'+take3[1]).value; 
	var tp=document.getElementById('taxper_'+take3[1]).value;
	rate=rate.trim();
	tp=tp.trim();
	
	if(tt==1 || tt==2)
		{
			window.ta=(rate*tp)/100;
			document.getElementById('taxamount_'+take3[1]).value=ta;
		}
	else
	{
		window.ta=0;
		document.getElementById('taxamount_'+take3[1]).value=ta;
	}
		
}
function AmountCalculationX(id)
{
	var take=id.split("_");
	var oc=document.getElementById('othercharg_'+take[1]).value; 
	var rate=document.getElementById('rate_'+take[1]).value; 
	var tt=document.getElementById('taxtype_'+take[1]).value; 
	var tp=document.getElementById('taxper_'+take[1]).value;
	var oca=0.00;
	var ta=0.00;
	var discount=0.00;
	rate=rate.trim();
	oc=oc.trim();
	tp=tp.trim();
	rate=parseFloat(rate);
	oc=parseFloat(oc);
	tt=parseInt(tt);
	tp=parseFloat(tp);
	var oct = document.getElementById('oct_'+take[1]).value;
	oct=parseInt(oct);
	//----------------OTHER CHARGES---------------------
	if(oct==1)
	{
			oca=(rate*oc)/100;
			oca=Number((oca).toFixed(2));
			//document.getElementById('oca_'+take[1]).value=oca;
	}
	else
	{
		 oca=oc;
		//document.getElementById('oca_'+take[1]).value=oca;
	}
	//--------------------TAX-----------------
	if(tt==1 || tt==2)
		{
			 ta=(rate*tp)/100;
			//document.getElementById('taxamount_'+take[1]).value=ta;
		}
	else
	{
		ta=0.00;
		//document.getElementById('taxamount_'+take[1]).value=ta;
	}
	var dp=document.getElementById('disper_'+take[1]).value;
	dp=dp.trim();
	dp=parseFloat(dp);
	discount=(rate+oca)-ta;
	var da=(discount*dp)/100;
	//document.getElementById('disamount_'+take[1]).value=da;
	var FinalAmount=discount-da;
	FinalAmount=Number((FinalAmount).toFixed(2));
	document.getElementById('finalrate_'+take[1]).value=FinalAmount;
}
function AmountCalculation(id)
{
	
	
	var take=id.split("_");
	
	 var rate=document.getElementById('rate_'+take[1]).value; 
	var tt=document.getElementById('taxtype_'+take[1]).value; 
	 var tp=document.getElementById('taxper_'+take[1]).value;
	var oct = document.getElementById('oct_'+take[1]).value;
	 var ocr=document.getElementById('othercharg_'+take[1]).value;
	 var dp=document.getElementById('disper_'+take[1]).value;
	//rate=parseFloat(rate);
	if(rate=='')
	{
		rate=0.0;
	}
	else
	{
		rate=parseFloat(rate);
		
	}
	tt=parseInt(tt);
	
	if(tp=='')
	{
		tp=0.0;
	}
	else
	{
		tp=parseFloat(tp);
	}
	oct=parseInt(oct);
	if(ocr=='')
	{
		ocr=0.0;
	}
	else
	{
		ocr=parseFloat(ocr);
	}
	if(dp=='')
	{
		dp=0.0;
	}
	else
	{
		dp=parseFloat(dp);
	}
	if(tt==1 || tt==2)
	{
		var tax_amount_pre=(rate*tp)/100;
		var tax_amount_final=Number((tax_amount_pre).toFixed(2));
	}
	else
	{
		tax_amount_final=tp;
		
	}
	var y = rate+tax_amount_final;
	if(oct==1)
	{
		var other_charg_amount_pre=(y*ocr)/100;
		var other_charg_amount_pre_final=Number((other_charg_amount_pre).toFixed(2));
	}
	else
	{
		other_charg_amount_pre_final=ocr;
	}
	var a = y+other_charg_amount_pre_final;
	var dis_amount_pre=(a*dp)/100;
	var dis_amount_pre_final=Number((dis_amount_pre).toFixed(2));
	var final_rate_pre=a-dis_amount_pre_final;
	var final_rate_final=Number((final_rate_pre).toFixed(2));
	document.getElementById('finalrate_'+take[1]).value=final_rate_final;
}
function ReTenderChange()
{
	alert('asasa');
}
function CheckUnFilledConsignee()
{
	var available_tender = document.getElementById('HidenAvailableTender').value;
	available_tender=parseInt(available_tender);
	if(available_tender==0)
	{
	  alert('Tender Number is not available');	
      return false;
	}
	var ss=document.getElementById('counter').value-1;
	var m=0;
	for(var i=0;i<=ss;i++)
	{
		if(document.getElementById('consignee'+i).value=='')
		{
			m++;
			
		}
	}
	if(m>0)
	{
		var answer = confirm(m+' Product will not be saved in absense of consignee \n Do you still want to save tender ');
		if (answer){
		return true;
		}
		else{
		return false;
		}
	
	}
}
function CheckTenderNumber(tender_number)
{
	//alert(tender_number);
	var edit_id_tender_p = $('#HidenBoxForHavingVal').val();
	
	var purchase_id_tn = $('#tender_purchaser').val();
	    $('#loader_no').show();
		$.ajax({
    	url:'MainAjax.php',
		type:'get',
		data:'tender_number='+tender_number+'&purchaser_id_tn='+purchase_id_tn+'&edit_id_tender_p='+edit_id_tender_p,
		success : function(response){
		$('#loader_no').hide();
	document.getElementById('tender_number_span').innerHTML=response;
		},
		error: function() {  
        alert('Some tecnical error');
    	}
	});
	
	
}
function CheckTenderNumber_inHistory_Tender(tender_number)
{
	//alert(tender_number);
	var edit_id_tender_p = $('#HidenBoxForHavingVal').val();
	
	var check_available_tender_number_in_history_section=12;
	
	var purchase_id_tn = $('#tender_purchaser').val();
	    $('#loader_no').show();
		$.ajax({
    	url:'MainAjax_Part2.php',
		type:'get',
		data:'tender_number='+tender_number+'&purchaser_id_tn='+purchase_id_tn+'&edit_id_tender_p='+edit_id_tender_p+'&check_available_tender_number_in_history_section='+check_available_tender_number_in_history_section,
		success : function(response){
		$('#loader_no').hide();
	document.getElementById('tender_number_span').innerHTML=response;
		},
		error: function() {  
        alert('Some tecnical error');
    	}
	});
	
	
}
		


 