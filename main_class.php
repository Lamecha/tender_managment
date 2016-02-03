<?php

class main_front_class
{
	
	public $conn;
	function __construct()
	{
		$this->conn = new MySQLi("localhost","root","12345678","mca");
		
	}
	public function emp_registration($uname,$pass)
	{
		$query = $this->conn->prepare("INSERT INTO `login` VALUES(NULL,?,?)");
		$query->bind_param("ss",$uname,$pass);
		$query->execute();
		$id =  $query->insert_id;
		$query->free_result();
		return $id;
		
		
		
	}
	
	
}



?>