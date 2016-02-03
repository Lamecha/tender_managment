<?php
require_once("main_includes/main_class.php");
$obj = new main_front_class();
$id=$_GET['id'];
$status=$_GET['status'];
$result=$obj->ChangeTenderStatus($id,$status);
?>
<?php
if($result==1)
{
?>
<div id="msg_after_uploaded">
Status changed to Uploaded
</div>
<?php
}
else
{
	?>
<div id="msg_after_status_error">
Status can't change to uploaded, some error
</div>
<?php	
}
?>