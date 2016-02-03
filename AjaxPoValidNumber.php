<?php
require_once("main_includes/main_class.php");
$ajaxobj = new main_front_class(); 
/* RECEIVE VALUE */
$validateValue=$_REQUEST['fieldValue'];
$validateId=$_REQUEST['fieldId'];
/* RETURN VALUE */
$arrayToJs = array();
$arrayToJs[0] = $validateId;

/*$cn = mysql_connect("localhost","root","12345678");
mysql_select_db("rainbow",$cn);
$qs = mysql_query("SELECT `officer_user_name` FROM `officer` WHERE `officer` LIKE '".$validateValue."'");*/
if($validateId=="po_number")
{
	if($ajaxobj->Duplicate_Pin_Common($validateValue,"history_po","po_number"))
	{		// validate??
		$arrayToJs[1] = true;			// RETURN TRUE
		echo json_encode($arrayToJs);			// RETURN ARRAY WITH success
	
	}
	else
	{
	
			$arrayToJs[1] = false;
			echo json_encode($arrayToJs);		// RETURN ARRAY WITH 	
	}
}
else
{
	if($ajaxobj->Duplicate_Pin2_Common($validateValue,"history_po","po_number",$validateId))
	{		// validate??
		$arrayToJs[1] = true;			// RETURN TRUE
		echo json_encode($arrayToJs);			// RETURN ARRAY WITH success
	
	}
	else
	{
	
			$arrayToJs[1] = false;
			echo json_encode($arrayToJs);		// RETURN ARRAY WITH 	
	}
	
}

?>