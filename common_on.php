<?php
require_once("main_includes/main_class.php");
$obj = new main_front_class();
$id=$_GET['id'];
$status=$_GET['status'];
//$display=$_GET['show'];
$table=$_GET['table'];
$result=$obj->ChangeTenderFirmStatusXXX($id,$status);
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