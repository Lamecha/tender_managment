<?php
require_once("main_includes/main_class.php");
$obj = new main_front_class();
$id=$_GET['id'];
$status=$_GET['status'];
$display=$_GET['show'];
$table=$_GET['table'];
$result=$obj->ChangeCommonStatus($id,$status,$table);
?>
<?php
if($result==1)
{
?>
<div id="msg_after_status_error" style="color:#900;">
Status changed to <?php echo $display; ?> 
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