<?php
require_once("main_includes/main_class.php");
$obj = new main_front_class();
$id=$_GET['id'];
$status=$_GET['status'];
//$display=$_GET['show'];
$table=$_GET['table'];
$tender_it_self_status=$_GET['tender_it_self_status'];
$result=$obj->ChangeTenderFirmStatusXXX($id,$status,$tender_it_self_status);
?>
<?php
if($result==1)
{
echo 1;
}
else
{
	echo 0;
}
?>