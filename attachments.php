<?php
require_once("main_includes/main_class.php");
$obj = new main_front_class();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" href="main_css/main_css.css"/>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
<title>Attachement : Rainbow Tender Managment</title>


<?php include_once("main_includes/main_menu.php");?> 
<script type="text/javascript" src="main_includes/add_new_row.js"></script>

</head>

<body>
<div id="index-header">
<?php include_once("main_includes/main_header.php");?> 
</div>
<div id="index-navigation">
<?php include_once("main_includes/menu.php"); ?> 
</div>
<div id="index-main">
<span id="title_work_page">Attchments</span>
<div id="working-sub-main">
<div id="working-panel">
<form method="post" enctype="multipart/form-data">
<table  id="attachments" class="attachz">

<tr><th>Title</th><th>File</th></tr>

<tr id="first_c">
<td><input type="text" name="titles[]"/></td>
<td><input type="file" name="files[]"/></td>
</tr>

<tr style="background:#fff;"><td>&nbsp;</td><td><input type="button" name="add_more" id="add_more" value="Add More" class="add_more" onclick="add_mores_firm_regi('first_c');"/></td></tr>
<tr><td><input type="submit" name="submit" value="upload"/></td><td>&nbsp;</td></tr>

</table></form>


</div></div>
</div>
<div id="index-footer">
<?php  include_once("main_includes/footer.php"); ?>

</div>


</body>
</html>