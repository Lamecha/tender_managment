<?php
session_start();
require_once("main_includes/main_class.php");
$obj = new main_front_class();
if(isset($_GET['ref'])==1 && $_GET['ref']=="logout")
{
	session_destroy();
	$obj->redirect("index.php");
	
}

?>