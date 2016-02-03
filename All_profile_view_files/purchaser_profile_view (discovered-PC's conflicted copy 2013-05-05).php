<?php
session_start();
require_once("../main_includes/main_class.php");
$obj = new main_front_class();
if(!isset($_SESSION['rb_uname']) || !isset($_SESSION['rb_pass']) || !isset($_SESSION['rb_pin']) || !isset($_SESSION['rb_power']))
{
	$obj->redirect("index.php");
}
else
{
	$result_login = $obj->LoginData($_SESSION['rb_power'],$_SESSION['rb_uname']);
	
}
if(isset($_GET['val']) && $_GET['val']!="")
{
	$result=$obj->common_fetchdata('create_purchaser',$_GET['val']);
	$result_product = $obj->attach_records($_GET['val'],'purchaser_director','purchase_id');
	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../main_css/main_css.css"/>
<script type="text/javascript" src="../js/jquery-1.9.1.min.js"></script>
<style type="text/css">
*
{
	margin:0;
	padding:0;
	
}
#wrapper
{
	width:1200px;
	height:auto;
	min-height:600px;

	margin:5px auto 0px auto;
}
#office
{
	width:100%;
	height:25px;
    font-family: 'BebasNeueRegular';
	letter-spacing:1px;
	color:#363636;
	border-bottom:1px solid #000;
		border-top:1px solid #000;
		line-height:25px;
		padding-left:5px;

	
	
}
#sec_strip
{
	width:100%;
	height:25px;
    font-family: 'BebasNeueRegular';
		letter-spacing:1px;
	color:#363636;
	border-bottom:1px solid #000;
		border-top:1px solid #000;
		line-height:25px;
		padding-left:5px;
		margin-top:10px;
		

	
	
}
#sec_strip span
{
	font-family: 'BebasNeueRegular';
	letter-spacing:1px;
	color:#363636;
	margin-left:130px;		

}
p
{
	text-align:center;
	font-family: 'BebasNeueRegular';
	letter-spacing:1px;
	color:#363636;
	margin-top:5px;
}
table
{
	border-collapse:collapse;
	text-align:center;
	margin:0 auto;
	margin-top:10px;
}
table th
{
	text-align:center;
	font-family: 'BebasNeueRegular';
	letter-spacing:1px;
	color:#363636;
	font-weight:normal;
	height:30px;
}
table tr td
{
	min-height:35px;
	height:auto;
	word-wrap:break-word;
	font-size:12px;
	height:20px;
}
</style>
<script type="text/javascript">
    $(document).ready(function() {
    $('.print').click(function() {
    window.print();
    return false;
    });
    });
</script>
<title>Information of <?php print_r($result['purchaser_short_name']); ?></title>
</head>

<body>
<div id="wrapper">
<p><input type="button" class="print" value="Print" /></p>
<p>Short Name : <?php print_r($result['purchaser_short_name']); ?></p>
<p style="font-size:19px;">Name : <?php print_r($result['purchaser_name']); ?></p>
<table width="800" border="1">
  <tr>
    <th width="157" scope="col">Address</th>
    <th width="589" scope="col"><?php print_r($result['purchaser_address']); ?></th>
  </tr>
   <tr>
    <th width="157" scope="col">City</th>
    <th width="589" scope="col"><?php print_r($result['city']); ?></th>
  </tr>
   <tr>
    <th width="157" scope="col">Pin Code</th>
    <th width="589" scope="col"><?php print_r($result['pin']); ?></th>
  </tr>
   <tr>
    <th width="157" scope="col">Fax No.</th>
    <th width="589" scope="col"><?php print_r($result['Fax_No']); ?></th>
  </tr>
   <tr>
    <th width="157" scope="col">Website</th>
    <th width="589" scope="col"><?php print_r($result['website']); ?></th>
  </tr>
   <tr>
    <th width="157" scope="col">Store Home Page.</th>
    <th width="589" scope="col"><?php print_r($result['store_page']); ?></th>
  </tr>
   <tr>
    <th width="157" scope="col">Tender URL</th>
    <th width="589" scope="col"><?php print_r($result['bulletin_url']); ?></th>
  </tr>
   <tr>
    <th width="157" scope="col">PO Detail URL</th>
    <th width="589" scope="col"><?php print_r($result['limited_url']); ?></th>
  </tr>
  
  </table>

<!------------------------------------------------------>
 <?php if($result_product[0]!='')
 {
	 ?>
     <table style="width:450px;margin-left:0px; margin:10px auto; table-layout:fixed;">
     <tr>
 <th style="width:100px; border:1px solid #333;">POST NAME</th> 
 <th style="width:100px; border:1px solid #333;">OFFICER NAME</th>
 <th style="width:100px; border:1px solid #333;">TELEPHONE</th>
 <th style="width:100px; border:1px solid #333;">MOBILE</th>
 <th style="width:100px; border:1px solid #333;">Residence No.</th>
 <th style="width:100px; border:1px solid #333;">Fax No</th>
 <th style="width:100px; border:1px solid #333;">Email</th>
 <th style="width:100px; border:1px solid #333;">DEALS</th>
</tr>
<?php
foreach($result_product as $mj) 
	{
		
		?>
    	<tr id="update_row<?=$mj['id'];?>">
      <td style="border:1px solid #333;"><?=$mj['purchaser_post_name'];?></td>
    <td style="border:1px solid #333;"><?=$mj['purchaser_office_name'];?></td>
    <td style="border:1px solid #333;"><?=$mj['purchaser_tel'];?></td>
     <td style="border:1px solid #333;"><?=$mj['purchaser_mob'];?></td>
      <td style="border:1px solid #333;"><?=$mj['purchaser_residence'];?></td>
       <td style="border:1px solid #333;"><?=$mj['purchaser_fax'];?></td>
        <td style="border:1px solid #333;"><?=$mj['purchaser_email'];?></td>
         <td style="border:1px solid #333;"><?=$mj['purchaser_deals'];?></td>
   
    </tr>
	<?php
	}    
 
 ?>
 
     </table>
     
     <?php
	
 }
 
 ?>
<!------------------------------------------------------>


</div>

</body>
</html>
