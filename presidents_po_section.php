<?php
$searchTerm = $_GET['term'];
require_once("main_includes/main_class.php");
$au_obj = new main_front_class();
$_COOKIE['tp_id']='%%';
	
	$items = $au_obj->getAllTenderForSearch_In_Po($_COOKIE['tp_id']);

if(isset($_COOKIE['tp_id'])==1 && $_COOKIE['tp_id']!='')
{
	$items = $au_obj->getAllTenderForSearch_In_Po($_COOKIE['tp_id']);
	
	
	
    $presidents = $items;

function filter($president) {
  global $searchTerm;
  return stripos($president, $searchTerm) !== false;
}

print(json_encode(array_values(array_filter($presidents, "filter"))));





}
?>