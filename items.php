<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" href="main_css/main_css.css"/>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
<style type="text/css">


</style>
<title>Items : Rainbow Tender Managment</title>


    <link rel="stylesheet" type="text/css" media="screen" href="main_css/jquery.ui.potato.menu.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="main_js/menu_bar/jquery.ui.potato.menu.js"></script>
<script type="text/javascript">
(function($) {
    $(document).ready(function(){
        $('#menu1').ptMenu();
    });
})(jQuery);
</script>

</head>

<body>
<div id="index-header">
<?php include_once("main_includes/main_header.php");?> 
</div>
<div id="index-navigation">
<?php include_once("main_includes/menu.php"); ?> 
</div>
<div id="index-main">
<span id="title_work_page">Items</span>
<div id="working-sub-main">
<div id="working-panel">

<table id="working-form">
<form>
<tr><td><label for="category_id">Category Name:</label></td>
<td><select>
<option value="">1</option>
<option value="">2</option>

</select></td></tr>
<tr><td><label for="name">Name:</label></td>
<td><input type="text" name="item_name" id="item_name" /></td></tr>
<tr><td><label for="description">Description:</label></td>
<td><textarea cols="15" rows="5" name="item_desc" id="item_desc"></textarea></td></tr>
<tr><td><label for="attachment_id">Attachment</label></td>
<td>
<input type="file" name=""/>
</td></tr>
<tr><td>&nbsp;</td>
<td><input type="submit" name="submit" value="submit" id="submit" /></td></tr>
 
</form>
</table>
	
</div>
</div>

</div>
<div id="index-footer">
<?php  include_once("main_includes/footer.php"); ?>

</div>


</body>
</html>