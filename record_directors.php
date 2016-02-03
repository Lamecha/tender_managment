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
		$('table#multipels td a.delete').click(function()
		{
			var delid=$(this).attr('id');
			var tablename="consignee_director";
			
			
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
	

	window.location="record_directors.php?val=<?=$_GET['val'];?>&table=<?=$_GET['table'];?>&field=<?=$_GET['field'];?>&tb_row="+ss;
	
}
</script>
<script>
function Edit_Directors_2()
{
	
	var dir_name = document.getElementById('dir_name').value;
	var pan = document.getElementById('pan').value;
	var dir_mobile = document.getElementById('dir_mobile').value;
	var dir_id = document.getElementById('dir_id').value;
	
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
					
					
				window.location="record_directors.php?val=<?=$_GET['val'];?>&table=<?=$_GET['table'];?>&field=<?=$_GET['field'];?>";
				window.opener.document.getElementById("update_row"+dir_id).innerHTML=DirectorTableCall.responseText;
					
					
				}
			}
	
	DirectorTableCall.open("GET","MainAjax.php?dir_name="+dir_name+"&pan="+pan+"&dir_mobile="+dir_mobile+"&dir_id="+dir_id,true);
	DirectorTableCall.send(null);
	
	
}
</script>
<style>
#multipels tr td
{
	background:#06f;
}
</style>

</head>
<body style="background:#2ba6cb;">
<table  id="multipels" class="attachz">
<caption>Directors</caption>

<tr><th style="width:220px; height:30px;">Director</th><th style="width:220px;">PAN No.</th><th style="width:220px;">Mobile No.</th><th width="100px">Edit</th><th width="100px">Delete</th>
</tr>



<?php

foreach($result as $v)
{
	if($v['id']==$_GET['tb_row'])
	{
		
?>
<tr>
<td style="text-align:center; font-size:12px"><input type="text" value="<?=$v['csign_director'];?>" id="dir_name" name="dir_name" style="width:220px; height:30px;"/></td>
<td style="text-align:center; font-size:12px"><input type="text" value="<?=$v['csign_pan_number'];?>" id="pan" name="pan" style="width:220px; height:30px;"/></td>
<td style="text-align:center; font-size:12px"><input type="text" value="<?=$v['csign_tel_number'];?>" id="dir_mobile" name="dir_mobile" style="width:220px; height:30px;"/>
<input type="hidden" value="<?=$v['id'];?>" id="dir_id" name="dir_mobile"/>
</td>

<td width="100" style="text-align:center; border:1px solid #666"><input type="image" class="Save_Button" value="" onClick="Edit_Directors_2()"></td>
<td width="100" style="text-align:center; border:1px solid #666"><a href="#" id="<?=$v['id'];?>" class="delete"><img src="main_images/delete.png" /></a></td>
</tr>

<?php	
}

else
{
?>
<tr>
<td style="text-align:center; font-size:12px; color:#FFFFFF; height:30px;"><?=$v['csign_director'];?></td>
<td style="text-align:center; font-size:12px; color:#FFF"><?=$v['csign_pan_number'];?></td>
<td style="text-align:center; font-size:12px; color:#FFF"><?=$v['csign_tel_number'];?></td>

<td width="100" style="text-align:center;"><input type="image" class="edit_button" value="<?=$v['id']; ?>" onClick="Edit_Directors(this.value);"/></td>
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
