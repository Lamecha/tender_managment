<?php 
$url = $obj->curPageURL();
//echo $URL;
?>
<style>
.response{
	
	
	text-decoration:none;
	color:#3300FF;
	position:absolute;
	top:80px;
	left:160px;
}
span_span
{
	margin-top:10px;
	
}
</style>  
  
<script type="text/javascript">
function AjaxMsg(PinNumber,Table)
{
	
	var url = document.getElementById('urlhide').value;
	
	
	var MsgCall;  
	
			try
			{
				MsgCall = new XMLHttpRequest();
			}
			catch (e)
			{
				try
				{
					MsgCall = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch (e) 
				{
					try
					{
						MsgCall = new ActiveXObject("Microsoft.XMLHTTP");
					}
					catch (e)
					{
						alert("Your browser broke!");
						return false;
					}
				}
			}	

			MsgCall.onreadystatechange = function()
			{
				if(MsgCall.readyState == 4)
				{
					 var take = document.getElementById('pid').innerHTML = MsgCall.responseText;	
					
					
				}
			}
	
	MsgCall.open("GET","MainAjax.php?PinNumber="+PinNumber+"&url="+url+"&Table="+Table,true);
	MsgCall.send(null);
	
	
}
</script>
  
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
  <link rel="stylesheet" href="main_css/msgjquery-ui.css" />
    <script src="main_js/msg_box/jquery-1.8.3.js"></script>
    <script src="main_js/msg_box/jquery.bgiframe-2.1.2.js"></script>
    <script src="main_js/msg_box/jquery-ui.js"></script>
    <script type="text/javascript">
	 var $n = jQuery.noConflict();
    // increase the default animation speed to exaggerate the effect
    $n.fx.speeds._default = 1000;
    $n(function() {
        $n( "#dialog" ).dialog({
            autoOpen: false,
            show: "blind",
            hide: "explode"
        });
 
        $n( ".opener" ).click(function() {
            $n( "#dialog" ).dialog( "open" );
            return false;
        });
    });
    </script>

<div id="dialog" title="Details" style="font-size:10px;">
    <p style="font-size:10px;" id="pid"></p>
</div>
<input type="hidden" id="urlhide" name="urlhide" value="<?php echo $url; ?>" /> 
<!--<button class="opener" onclick="AjaxMsg()">Open Dialog</button>-->
    <!--
     <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
    
    <script src="main_js/msg_box/jquery.bgiframe-2.1.2.js"></script>
    <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
    -->
    
    
    
    