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
<div id="msg_after_rate_given">
Status changed to Rate Given
</div>
<?php
}
else
{
	?>
<div id="msg_after_status_error">
Status can't change to rate given, some error
</div>
<?php	
}
?>