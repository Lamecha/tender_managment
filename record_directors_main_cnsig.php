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
<title>Officers : Rainbow Tender Managment</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript">

	$(document).ready(function()
	{
		$('table#multipels td a.delete').click(function()
		{
			var delid=$(this).attr('id');
			
			var tablename="main_consignee_contacts";
			
			
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
	

	window.location="record_directors_main_cnsig.php?val=<?=$_GET['val'];?>&table=<?=$_GET['table'];?>&field=<?=$_GET['field'];?>&tb_row="+ss;
	
}
</script>
<script>
function Edit_Directors_2()
{
	var contact_postname = document.getElementById('contact_postname').value;
	
	var contact_officername = document.getElementById('contact_officername').value;
	
	var contact_telephone = document.getElementById('contact_telephone').value;
	var contact_mobile = document.getElementById('contact_mobile').value;
	var contact_residence = document.getElementById('contact_residence').value;
	var contact_fax = document.getElementById('contact_fax').value;
	var contact_email = document.getElementById('contact_email').value;
	var contact_deal = document.getElementById('contact_deal').value;
	var main_cnsige_id = document.getElementById('main_cnsige_id').value;
	
	
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
				window.location="record_directors_main_cnsig.php?val=<?=$_GET['val'];?>&table=<?=$_GET['table'];?>&field=<?=$_GET['field'];?>";
				window.opener.document.getElementById("update_row"+main_cnsige_id).innerHTML=main_consignee_contactsCall.responseText;
				}
			}
	
	main_consignee_contactsCall.open("GET","MainAjax.php?contact_postname="+contact_postname+"&contact_officername="+contact_officername+"&contact_telephone="+contact_telephone+"&contact_mobile="+contact_mobile+"&contact_residence="+contact_residence+"&contact_fax="+contact_fax+"&contact_email="+contact_email+"&contact_deal="+contact_deal+"&main_cnsige_id="+main_cnsige_id,true);
	main_consignee_contactsCall.send(null);
	
	
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
<caption>Contacts</caption>

<tr><th style="width:130px">Post Name</th><th style="width:130px">Officer Name</th><th style="width:130px">Telephone</th><th style="width:130px">Mobile</th><th style="width:130px">Fax</th><th style="width:130px">Residence No.</th><th style="width:110px">Email</th><th style="width:130px">Deals</th><th style="width:100px">Edit</th><th style="width:100px">Delete</th>
</tr>



<?php

foreach($result as $v)
{
	if($v['id']==$_GET['tb_row'])
	{
		
?>
<tr>
<td style="text-align:center; font-size:12px"><input type="text" value="<?=$v['contact_postname'];?>" id="contact_postname" name="contact_postname" style="width:130px; height:30px;"/></td>
<td style="text-align:center; font-size:12px"><input type="text" value="<?=$v['contact_officername'];?>" id="contact_officername" name="contact_officername" style="width:130px; height:30px;"/></td>
<td style="text-align:center; font-size:12px"><input type="text" value="<?=$v['contact_telephone'];?>" id="contact_telephone" name="contact_telephone" style="width:130px; height:30px;"/></td>
<td style="text-align:center; font-size:12px"><input type="text" value="<?=$v['contact_mobile'];?>" id="contact_mobile" name="contact_mobile" style="width:130px; height:30px;"/>
<input type="hidden" value="<?=$v['id'];?>" id="main_cnsige_id" name="main_cnsige_id"/>
</td>
<td style="text-align:center; font-size:12px"><input type="text" value="<?=$v['contact_fax'];?>" id="contact_fax" name="contact_fax" style="width:130px; height:30px;"/>
</td>
<td style="text-align:center; font-size:12px"><input type="text" value="<?=$v['contact_residence'];?>" id="contact_residence" name="contact_residence" style="width:130px; height:30px;"/>
</td>

<td style="text-align:center; font-size:12px"><input type="text" value="<?=$v['contact_email'];?>" id="contact_email" name="contact_email" style="width:130px; height:30px;"/>

</td>
<td style="text-align:center; font-size:12px"><input type="text" value="<?=$v['contact_deal'];?>" id="contact_deal" name="contact_deal" style="width:130px; height:30px;"/>
</td>

<td width="100" style="text-align:center; border:1px solid #666"><input type="button" class="Save_Button" value="" onClick="Edit_Directors_2()"></td>
<td width="100" style="text-align:center; border:1px solid #666"><a href="#" id="<?=$v['id'];?>" class="delete"><img src="main_images/delete.png" /></a></td>
</tr>

<?php	
}

else
{
?>
<tr>
<td style="text-align:center; font-size:12px; color:#FFFFFF; height:30px;"><?=$v['contact_postname'];?></td>
<td style="text-align:center; font-size:12px; color:#FFFFFF; height:30px;"><?=$v['contact_officername'];?></td>
<td style="text-align:center; font-size:12px; color:#FFF"><?=$v['contact_telephone'];?></td>
<td style="text-align:center; font-size:12px; color:#FFF"><?=$v['contact_mobile'];?></td>
<td style="text-align:center; font-size:12px; color:#FFF"><?=$v['contact_fax'];?></td>
<td style="text-align:center; font-size:12px; color:#FFF"><?=$v['contact_residence'];?></td>
<td style="text-align:center; font-size:12px; color:#FFF"><?=$v['contact_email'];?></td>
<td style="text-align:center; font-size:12px; color:#FFF"><?=$v['contact_deal'];?></td>
<td width="100" style="text-align:center;"><input type="button" class="edit_button" value="<?=$v['id']; ?>" onClick="Edit_Directors(this.value);"/></td>
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
