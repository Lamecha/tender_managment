<?php 
session_start();
require_once("main_includes/main_class.php");
$obj = new main_front_class();
if(isset($_GET['val']) && $_GET['val']!="")
{
	$result = $obj->common_fetch_limited_firm_withItem_nolimit($_GET['table'],$_GET['field'],$_GET['val']);
	$list_firm = $obj->List_Drop_Down("consignee","csign_short_name","id");
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
			
			var tablename="tender_limited_firm";
			
			
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
	
	var firm_id=document.getElementById('firm_id_'+ss).value;
	window.location="record_limited_firm.php?val=<?=$_GET['val'];?>&table=<?=$_GET['table'];?>&field=<?=$_GET['field'];?>&tb_row="+ss+"&firm_id="+firm_id;
	
}
</script>
<script>
function Edit_Directors_2()
{
	
	var firm_update_select = document.getElementById('firm_update_select').value;
	var LimitedFI = document.getElementById('Fid').value;
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
				window.location="record_limited_firm.php?val=<?=$_GET['val'];?>&table=<?=$_GET['table'];?>&field=<?=$_GET['field'];?>";
				window.opener.document.getElementById("updated_limited_firm_"+LimitedFI).innerHTML=main_consignee_contactsCall.responseText;
				}
			}
	
	main_consignee_contactsCall.open("GET","MainAjax.php?firm_update_select="+firm_update_select+"&LimitedFI="+LimitedFI,true);
	main_consignee_contactsCall.send(null);
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
<caption>Edit/Delete Limited Firms</caption>
<tr><th style="width:200px;">Firms</th><th style="width:50px;">Edit</th><th>Delete</th>
</tr>
<?php
foreach($result as $v)
{
	
	if($v['id']==$_GET['tb_row'])
	{
		
?>
<tr>
    <td>
    <?php
	$purc_opt="_".$_GET['firm_id']."_PU";
    $$purc_opt="selected='selected'";
	?>
    
    <select id="firm_update_select" name="firm_update" class="selectD" style="width:230px;" >
     <?php for($i=0;$i<sizeof($list_firm);$i++) 
		 {
		 ?>
          <option value="<?php print_r($list_firm[$i]['id']); ?>" <?=${'_'.$list_firm[$i]['id'].'_PU'};?>><?php print_r($list_firm[$i]['csign_short_name']);?></option>
          <?php 
		 }
		  ?>
     </select>
   </td>
<input type="hidden" value="<?=$v['id'];?>" id="Fid" name="Fid"/>
<td width="100" style="text-align:center; border:1px solid #666"><input type="image" class="Save_Button" value="" onClick="Edit_Directors_2()"></td>
<td width="100" style="text-align:center; border:1px solid #666"><a href="#" id="<?=$v['id'];?>" class="delete"><img src="main_images/delete.png" /></a></td>
</tr>

<?php	
}

else
{
?>
<tr>
<td><input type="text" name="category_update[]" style="width:200px; background:#0066ff;" class="kareena" value="<?=$v['csign_short_name'];?>" id="firm_limited_0" readonly='readonly' />
<input type="hidden" value="<?=$v['firm_id'];?>" id="firm_id_<?=$v['id'];?>">
    </td>
    <td style="text-align:center;"><input type="image" class="edit_button" value="<?=$v['id']; ?>" onClick="Edit_Directors(this.value);"/></td>    
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
</body>
</html>
