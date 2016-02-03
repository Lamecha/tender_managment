
<?php
//----ATTACHEMENTS-------
 	$finalName = array();
	for($i=0;$i<sizeof($_POST['titles']);$i++)
	{
		$name = $_FILES['files']['name'][$i];
		$tmp_name = $_FILES['files']['tmp_name'][$i];
		$ext = $obj->getExtension($name);
		$newName = $obj->nameGen();
		$finalName[$i]  = $newName.".".$ext;
		move_uploaded_file($tmp_name,"attachements/employee_attach/".$finalName[$i]);
	}
 //----ATTACHEMENTS_END-----
 ?>