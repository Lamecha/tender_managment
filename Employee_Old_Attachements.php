<?php 
session_start();
require_once("main_includes/main_class.php");
$obj = new main_front_class();
if(isset($_GET['val']) && $_GET['val']!="")
{
	$result = $obj->attach_records($_GET['val'],$_GET['table'],$_GET['field']);
	
}
if(isset($_POST['save']))
{
	
	if($_FILES['file']['size']!=0)
	{
		
		$name = $_FILES['file']['name'];
		$tmp_name = $_FILES['file']['tmp_name'];
		$ext = $obj->getExtension($name);
		$newName = $obj->nameGen();
		$finalName  = $newName.".".$ext;
		move_uploaded_file($tmp_name,"attachements/employee_attach/".$finalName);
	}
	else
	{
		$finalName=0;
		$name=0;
		
	}
	$result = $obj->Update_Employee_Attachements($_POST['titles'],$_POST['other_title'],$finalName,$name,$_POST['id_firm_attachement']);
	if($result==1)
	{
		?>
        <script>
       window.location="Employee_Old_Attachements.php?val=<?=$_GET['val'];?>&table=<?=$_GET['table'];?>&field=<?=$_GET['field'];?>";
		</script>
        <?php
		
	
	}
	
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
<title>Old Officer Attachments : Rainbow Tender Managment</title>
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
<script>
function Edit_Directors(ss)
{
	

	window.location="Employee_Old_Attachements.php?val=<?=$_GET['val'];?>&table=<?=$_GET['table'];?>&field=<?=$_GET['field'];?>&tb_row="+ss;
}
</script>
<script>
function RemoveReadOnly()
{
	var a = parseInt(document.getElementById('title').value);
	
	if(a==10)
	{
		document.getElementById('other_title').disabled=false;
		
	}
	else
	{
		document.getElementById('other_title').value="";
		document.getElementById('other_title').disabled=true;
	}
}
</script>


</head>
<body style="background:#2ba6cb;">

<table  id="attachments" class="attachz">
<caption>Attachments</caption>
<tr><th width="130">Title</th>
<th width="130">Other Title</th>
<th width="180">File</th>
<th width="130px;">Edit</th>
<th width="100px">Delete</th>
</tr>
<?php
foreach($result as $v)
{
	if($v['id']==$_GET['tb_row'])
	{
?>
   <form id="muform" name="myform" action="#" enctype="multipart/form-data" method="post">
	<tr>
    
    
	<td style="text-align:center; font-size:12px">
    <?php
	$select_opt = "_".$v['title']."_M";
	$$select_opt = "selected='selected'";
	 ?>
    <select name="titles" id="title" style="width:120px; height:30px; border:1px solid #333;" onChange="RemoveReadOnly()">
<option value="">Please Select</option>
<option value="1" <?=$_1_M;?>>PAN Card</option>
<option value="2" <?=$_2_M;?>>ID Proof</option>
<option value="3" <?=$_3_M;?>>Address Proof</option>
<option value="4" <?=$_4_M;?>>Resume</option>
<option value="10" <?=$_10_M;?>>Others</option>
	</select>
    </td>
    
    <td style="text-align:center; font-size:12px"><input type="text" id="other_title" name="other_title" value="<?=$v['other_title'];?>" <?php if($v['title']!=10){ echo 'disabled'; } ?>></td>
<td style="text-align:center; font-size:12px"><input type="file" value="<?=$v['file_real_name'];?>" id="file" name="file">
<input type="hidden" value="<?=$v['id'];?>" id="id_firm_attachement" name="id_firm_attachement"/>
</td>
<td width="100" style="text-align:center; border:1px solid #666"><input type="submit" id="save" name="save" value="Save" style="background:#063; height:30px; width:60px; border:1px solid #003;"></td>
<td width="100" style="text-align:center; border:1px solid #666"><a href="#" id="<?=$v['id'];?>" class="delete"><img src="main_images/delete.png" /></a></td>
</tr>
</form>
<?php	
}
else
{	
	


$title_value = $obj->Title_In_officer_Employee($v['title']);
?>
<tr>
<td style="text-align:center; font-size:12px;color:#FFF; height:30px;">
<?php
echo $title_value;
?>
</td>
<td style="text-align:center; font-size:12px;color:#FFF; height:30px;">
<?=$v['other_title'];?>
</td>
<td style="text-align:center; font-size:12px;color:#FFF; height:30px;"><?=$v['file_real_name'];?></td>
<td width="100" style="text-align:center;"><input type="image" class="edit_button" value="<?=$v['id']; ?>" onClick="Edit_Directors(this.value);"/></td>

<td width="100" style="text-align:center;color:#FFF; height:30px;"><a href="#" id="<?=$v['id'];?>" class="delete"><img src="main_images/delete.png" /></a></td>
</tr>
<?php	
}
}
?>
</table>

<input type="hidden" value="<?php echo $_GET['table']; ?>" id="mytable"/>
</body>
</html>
