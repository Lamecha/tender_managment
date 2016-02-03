<?php
require_once("main_includes/main_class.php");
$objac = new main_front_class();
$pID=$_GET['pID'];
$items = $objac->getAllTenderForSearch($pID);
echo json_encode($items);
?>