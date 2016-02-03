<?php
require_once("main_includes/main_class.php");
$objac = new main_front_class();
$q = strtolower($_GET["q"]);
if(false)
{
 return;
}else
{
$items = $objac->getAllItemsForSearch();
//print_r($items);
foreach ($items as $key=>$value) {
	if (strpos(strtolower($key), $q) !== false) {
		echo "$key|$value\n";
	}
}
}

?>