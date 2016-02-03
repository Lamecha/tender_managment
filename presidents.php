<?php
$searchTerm = $_GET['term'];
require_once("main_includes/main_class.php");
$au_obj = new main_front_class();

	
	$items = $au_obj->getAllTenderForSearch($_COOKIE['tp_id']);

if(isset($_COOKIE['tp_id'])==1 && $_COOKIE['tp_id']!='')
{
	$items = $au_obj->getAllTenderForSearch($_COOKIE['tp_id']);
	//$items = $au_obj->getAllTenderForSearch($_GET['pid']);
	
	
    $presidents = $items;


function filter($president) {
  global $searchTerm;
  return stripos($president, $searchTerm) !== false;
}

print(json_encode(array_values(array_filter($presidents, "filter"))));
//print_r(json_encode($items));


}



?>