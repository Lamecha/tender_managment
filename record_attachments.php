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
<title>Attachments : Rainbow Tender Managment</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript">

	$(document).ready(function()
	{
		$('table#attachments td a.delete').click(function()
		{
			var delid=$(this).attr('id');
			
			var tablename=$('#mytable').val();
			
			
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

</head>
<body style="background:#2ba6cb;">
<table  id="attachments" class="attachz">
<caption>Attachments</caption>
<tr><th width="130">Title</th><th width="180">File</th>
<th width="100px">Delete</th>
</tr>
<?php
foreach($result as $v)
{
?>
<tr>
<td style="text-align:center; font-size:12px;color:#FFF"><?=$v['title'];?></td>
<td style="text-align:center; font-size:12px;color:#FFF"><?=$v['file_real_name'];?></td>
<td width="100" style="text-align:center;color:#FFF"><a href="#" id="<?=$v['id'];?>" class="delete"><img src="main_images/delete.png" /></a></td>
</tr>
<?php	
}
?>
</table>
<input type="hidden" value="<?php echo $_GET['table']; ?>" id="mytable"/>
</body>
</html>
