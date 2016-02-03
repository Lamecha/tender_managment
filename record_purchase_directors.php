<?php 
session_start();
require_once("main_includes/main_class.php");
$obj = new main_front_class();
if(isset($_GET['val']) && $_GET['val']!="")
{
	$result = $obj->attach_records($_GET['val'],$_GET['table'],$_GET['field']);
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="main_includes/add_new_row.js"></script>
<link rel="stylesheet" href="main_css/main_css.css"/>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
<style type="text/css">


</style>
<title>Directors : Rainbow Tender Managment</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript">

	$(document).ready(function()
	{
		$('table#pur_cnt_multipels td a.delete').click(function()
		{
			var delid=$(this).attr('id');
			
			var tablename="purchaser_director";
			
			
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
							window.opener.$('#pur_cnt_multipels #update_row'+delid).remove();
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
	

	window.location="record_purchase_directors.php?val=<?=$_GET['val'];?>&table=<?=$_GET['table'];?>&field=<?=$_GET['field'];?>&tb_row="+ss;
	
}
</script>
<script>
function Edit_purchase_director()
{
	var purchaser_post_name = document.getElementById('purchaser_post_name').value;
    var purchaser_office_name = document.getElementById('purchaser_office_name').value;
	var purchaser_tel = document.getElementById('purchaser_tel').value;
	var purchaser_mob = document.getElementById('purchaser_mob').value;
	var purchaser_residence = document.getElementById('purchaser_residence').value;
	var purchaser_fax = document.getElementById('purchaser_fax').value;
	var purchaser_email = document.getElementById('purchaser_email').value;
	var purchaser_deals = document.getElementById('purchaser_deals').value;
	var id = document.getElementById('id').value;
	var DirectorTableCall;  
			try
			{
				DirectorTableCall = new XMLHttpRequest();
			}
			catch (e)
			{
				try
				{
					DirectorTableCall = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch (e) 
				{
					try
					{
						DirectorTableCall = new ActiveXObject("Microsoft.XMLHTTP");
					}
					catch (e)
					{
						alert("Your browser broke!");
						return false;
					}
				}
			}	

			DirectorTableCall.onreadystatechange = function()
			{
				if(DirectorTableCall.readyState == 4)
				{
					
					window.location="record_purchase_directors.php?val=<?=$_GET['val'];?>&table=<?=$_GET['table'];?>&field=<?=$_GET['field'];?>";
					window.opener.document.getElementById("update_row"+id).innerHTML=DirectorTableCall.responseText;
					
					
				}
			}
	
	DirectorTableCall.open("GET","MainAjax.php?purchaser_post_name="+purchaser_post_name+"&purchaser_office_name="+purchaser_office_name+"&purchaser_tel="+purchaser_tel+"&purchaser_mob="+purchaser_mob+"&purchaser_residence="+purchaser_residence+"&purchaser_fax="+purchaser_fax+"&purchaser_email="+purchaser_email+"&purchaser_deals="+purchaser_deals+"&id="+id,true);
	DirectorTableCall.send(null);
}
</script>
<style>
#pur_cnt_multipels tr td
{
	background:#06f;
	height:27px;
	color:#FFFFFF;
}
</style>
</head>
<body style="background:#2ba6cb;">
<table  id="pur_cnt_multipels" class="attachz">
<caption>Contacts</caption>

<tr><th width="100px">Name</th><th width="100px">Office Name</th><th width="100px">Tele</th><th width="100px">Mobile</th><th width="100px">Resi. No</th><th width="100px">Fax No</th><th width="130px">Email</th><th width="100px">Deals</th><th width="50px" >Edit</th><th width="90px">Delete</th>
</tr>
<?php
foreach($result as $v)
{
	if($v['id']==$_GET['tb_row'])
	{
		
?>
<tr>
<td style="text-align:center; font-size:12px"><input type="text" value="<?=$v['purchaser_post_name'];?>" id="purchaser_post_name" name="purchaser_post_name"/></td>
<td style="text-align:center; font-size:12px"><input type="text" value="<?=$v['purchaser_office_name'];?>" id="purchaser_office_name" name="purchaser_office_name"/></td>
<td style="text-align:center; font-size:12px"><input type="text" value="<?=$v['purchaser_tel'];?>" id="purchaser_tel" name="purchaser_tel"/></td>
<td style="text-align:center; font-size:12px"><input type="text" value="<?=$v['purchaser_mob'];?>" id="purchaser_mob" name="purchaser_mob"/></td>
<td style="text-align:center; font-size:12px"><input type="text" value="<?=$v['purchaser_residence'];?>" id="purchaser_residence" name="purchaser_residence"/></td>
<td style="text-align:center; font-size:12px"><input type="text" value="<?=$v['purchaser_fax'];?>" id="purchaser_fax" name="purchaser_fax"/></td>
<td style="text-align:center; font-size:12px"><input type="text" value="<?=$v['purchaser_email'];?>" id="purchaser_email" name="purchaser_email"/></td>
<td style="text-align:center; font-size:12px"><input type="text" value="<?=$v['purchaser_deals'];?>" id="purchaser_deals" name="purchaser_deals"/></td>
<input type="hidden" value="<?=$v['id'];?>" id="id" name="purchaser_post_name"/>
</td>
<td width="100" style="text-align:center; border:1px solid #666"><input type="image" class="Save_Button" value="" onClick="Edit_purchase_director()"></td>
<td width="100" style="text-align:center; border:1px solid #666"><a href="#" id="<?=$v['id'];?>" class="delete"><img src="main_images/delete.png" /></a></td>
</tr>
<?php	
}
else
{
?>
<tr>
<td style="text-align:center; font-size:12px;"><?=$v['purchaser_post_name'];?></td>
<td style="text-align:center; font-size:12px"><?=$v['purchaser_office_name'];?></td>
<td style="text-align:center; font-size:12px"><?=$v['purchaser_tel'];?></td>
<td style="text-align:center; font-size:12px"><?=$v['purchaser_mob'];?></td>
<td style="text-align:center; font-size:12px"><?=$v['purchaser_residence'];?></td>
<td style="text-align:center; font-size:12px"><?=$v['purchaser_fax'];?></td>
<td style="text-align:center; font-size:12px"><?=$v['purchaser_email'];?></td>
<td style="text-align:center; font-size:12px"><?=$v['purchaser_deals'];?></td>

<td style="text-align:center"><input type="image" class="edit_button" value="<?=$v['id']; ?>" onClick="Edit_Directors(this.value);"/></td>
<td style="text-align:center;"><a href="#" id="<?=$v['id'];?>" class="delete"><img src="main_images/delete.png" /></a></td>
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
	$('#pur_cnt_multipels').tableScroll({height:350});

	
});

/*]]>*/
</script>
</body>
</html>
