<?php

class main_front_class
{
	
	public $conn;
	function __construct()
	{
		$this->conn = new MySQLi("localhost","root","","rainbow");		
	}
	public function redirect($url)
	{
		echo "<script type='text/javascript'>";
		echo "window.location='$url'";
		echo "</script>";
			
	}
	function login($user,$pass,$table,$pin)
	{
		
		$return_data = array();
		$user1 = $table."_user_name";
		$pass1 = $table."_password";
		$query2 = $this->conn->query("SELECT * FROM `".$table."` WHERE `".$user1."` LIKE '".$user."' AND `".$pass1."` LIKE '".$pass."' ");
		$result = $query2->fetch_assoc();
		if($result!=NULL)
		{
			if($pin==1111)
			{
				
				$return_data[0]=0;
				$return_data[1]=1;
				return $return_data;
			 
			}
			else
			{
				$query3 = $this->conn->query("SELECT `id`,`employee_pin` FROM `employee` WHERE `employee_pin` LIKE '".$pin."'");
				$result12 = $query3->fetch_assoc();
				if($result12!=NULL)
				{
					
					
					$return_data[0]=2;
					$return_data[1]=$result12['id'];
					return $return_data;
					
				}
				else
				{
					$query34 = $this->conn->query("SELECT `id`,`officer_pin` FROM `officer` WHERE `officer_pin` LIKE '".$pin."'");
				$result124 = $query34->fetch_assoc();
					if($result124!=NULL)
					{
						//return true;
						$return_data[0]=1;
						$return_data[1]=$result124['id'];
						return $return_data;
					}
					else
					{
						return false;
					}
					
				}
				
				
				
			}
			
		
		}
		else
		{
		return false;
		}
	}
	public function officer_registration($officer_office,$officer_first_name,$officer_last_name,$officer_user_name,
$officer_password,$officer_pin,$officer_photo,
$officer_mail,$officer_mobile,$officer_address,
$titles,$finalName,$name,$created_by,$created_table,$text_on_others)
	{
		$updated_by=NULL;
		$updated_table=NULL;
		
		$query = $this->conn->prepare("INSERT INTO `officer`(`officer_office`,`officer_first_name`,`officer_last_name`, `officer_user_name`,`officer_password`,`officer_pin`,`officer_photo`,`officer_mail`,`officer_mobile`,`officer_address`,`created_by`,`created_table`,`updated_by`,`updated_table`) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
$query->bind_param("ssssssssssssss",$officer_office,$officer_first_name,$officer_last_name,$officer_user_name,
$officer_password,$officer_pin,$officer_photo,
$officer_mail,$officer_mobile,$officer_address,$created_by,$created_table,$updated_by,$updated_table);
		$query->execute();
		$query->store_result();
$officer_id = $query->insert_id;
	//$this->store_attachments($officer_id,'officer_attachments',$finalName,$titles,$name);
	$this->store_attachments_after_other($officer_id,'officer_attachments',$finalName,$titles,$name,$text_on_others);
		if($query->error)
		{
			return 0;
		}
		else
		{
			return 1;
		}
		
	}
public function specification_registration($specification_no,$part,$revision,$reaffirmed,$year,$title,$finalName,$name,$created_by,$created_table,$issued,$other_issued)
	{
		if(trim($other_issued)=='')
		{
			$oIs = NULL;
		}
		else
		{
			$oIs = trim($other_issued);
		}
		$updated_by=NULL;
		$updated_table=NULL;
		$query = $this->conn->prepare("INSERT INTO `specification`(`specification_no`,`part`,`revision`,`reaffirmed`,`year`,`title`,`issued`,`other_issued`,`created_by`,`created_table`,`updated_by`,`updated_table`) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
$query->bind_param("ssssssssssss",$specification_no,$part,$revision,$reaffirmed,
$year,$title,$issued,$oIs,$created_by,$created_table,$updated_by,$updated_table);
		$query->execute();
		$query->store_result();
		$spec_id = $query->insert_id;
	//$this->store_attachments_after_other($spec_id,'specification_attachements',$finalName,$titles,$name,$text_on_others);
		if($query->error)
		{
			return 0;
		}
		else
		{
			for($i=0;$i<sizeof($name);$i++)
			{
				if($name[$i]!='')
				{
				
				$query_i = $this->conn->prepare('INSERT INTO `specification_attachements` VALUES (NULL,?,?,?) ');
				$query_i->bind_param('iss',$spec_id,$name[$i],$finalName[$i]);
				$query_i->execute();
				}
			}
			return 1;
		}
		
		
	}
	
	public function officer_update($officer_office,$officer_first_name,$officer_last_name,$officer_user_name,
$officer_password,$officer_pin,$officer_photo,
$officer_mail,$officer_mobile,$officer_address,
$titles,$finalName,$name,$id,$updated_by,$updated_table,$other_title)
{
	$query = $this->conn->query("UPDATE `officer` SET `officer_office` = '".$officer_office."', `officer_first_name` = '".$officer_first_name."',`officer_last_name` = '".$officer_last_name."',`officer_user_name` = '".$officer_user_name."', `officer_password` = '".$officer_password."' , `officer_pin` = '".$officer_pin."' , `officer_photo` = '".$officer_photo."' , `officer_mail` = '".$officer_mail."' ,  `officer_mobile` = '".$officer_mobile."' , `officer_address` = '".$officer_address."',`updated_by` = '".$updated_by."',`updated_table`='".$updated_table."' WHERE `id` LIKE '".$id."'  ");
	
	//$this->store_attachments($id,'officer_attachments',$finalName,$titles,$name);
	$this->store_attachments_after_other($id,'officer_attachments',$finalName,$titles,$name,$other_title);
		if($query->error)
		{
			return 0;
		}
		else
		{
			return 1;
		}
	
	
}
public function Specification_update($specification_no,$part,$revision,$reaffirmed,$year,$title,$finalName,$name,$id,$updated_by,$updated_table,$issued,$other_issued)
{
	if(trim($other_issued)=='')
		{
			$oIs = NULL;
		}
		else
		{
			$oIs = trim($other_issued);
		}
	
	$query = $this->conn->query("UPDATE `specification` SET `specification_no` = '".$specification_no."', `part` = '".$part."',`revision` = '".$revision."',`reaffirmed` = '".$reaffirmed."', `year` = '".$year."',`title`='".$title."',`issued`='".$issued."',`other_issued`='".$oIs."',`updated_by` = '".$updated_by."',`updated_table`='".$updated_table."' WHERE `id` LIKE '".$id."'  ");
	if($query->error)
		{
			return 0;
		}
		else
		{
			for($i=0;$i<sizeof($name);$i++)
			{
				if($name[$i]!='')
				{
				$query_i = $this->conn->prepare('INSERT INTO `specification_attachements` VALUES (NULL,?,?,?) ');
				$query_i->bind_param('iss',$id,$name[$i],$finalName[$i]);
				$query_i->execute();
				}
			}
			return 1;
		}
	
	
}
	
public function employe_registration
($employee_first_name,$employee_last_name,$employee_office,$employee_user_name, $employee_password,$employee_pin,$employee_photo,
$employee_mail,$employee_mobile,$employee_address,
$titles,$finalName,$name,$created_by,$created_table,$text_on_others)
	{
		$updated_by=NULL;
		$updated_table=NULL;
$query = $this->conn->prepare("INSERT INTO `employee`(	`employee_first_name`,`employee_last_name`,`employee_office`,`employee_user_name`,
`employee_password`,`employee_pin`,`employee_photo`,
`employee_mail`,`employee_mobile`,`employee_address`,`created_by`,`created_table`,`updated_by`,`updated_table`) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
$query->bind_param("ssssssssssssss",
$employee_first_name,$employee_last_name,$employee_office,$employee_user_name,
$employee_password,$employee_pin,$employee_photo,
$employee_mail,$employee_mobile,$employee_address,$created_by,$created_table,$updated_by,$updated_table);
$query->execute();
$query->store_result();
$employee_id = $query->insert_id;
//$this->store_attachments($employee_id,'employee_attachments',$finalName,$titles,$name);
$this->store_attachments_after_other($employee_id,'employee_attachments',$finalName,$titles,$name,$text_on_others);

	if($query->error)
	{
		return 0;
	}
	else
	{
		return 1;
	}
	
		
}

public function employee_update($employee_first_name,$employee_last_name,$employee_office,$employee_user_name,
$employee_password,$employee_pin,$employee_photo,
$employee_mail,$employee_mobile,$employee_address,
$titles,$finalName,$name,$id,$updated_by,$updated_table,$other_title)
{
	$query = $this->conn->query("UPDATE `employee` SET `employee_first_name` = '".$employee_first_name."' , `employee_last_name` = '".$employee_last_name."' , `employee_office` = '".$employee_office."' , `employee_user_name` = '".$employee_user_name."' , `employee_password` = '".$employee_password."' , `employee_pin` = '".$employee_pin."' , `employee_photo` = '".$employee_photo."' , `employee_mail` = '".$employee_mail."' ,  `employee_mobile` = '".$employee_mobile."' , `employee_address` = '".$employee_address."',`updated_by`='".$updated_by."',`updated_table`='".$updated_table."' WHERE `id` LIKE '".$id."'");
	
	//$this->store_attachments($id,'employee_attachments',$finalName,$titles,$name);
	$this->store_attachments_after_other($id,'employee_attachments',$finalName,$titles,$name,$other_title);
	$officer_created = $this->conn->query("UPDATE `officer` SET `created_by`='".$employee_pin."' WHERE `created_by` LIKE '".$oldPin."' ");
	$officer_updated = $this->conn->query("UPDATE `officer` SET `updated_by`='".$employee_pin."' WHERE `updated_by` LIKE '".$oldPin."' ");
	
		if($query->error)
		{
			return 0;
		}
		else
		{
			return 1;
		}
	
	
}
   
public function office_registration($office_code,$office_name,$office_address,$office_city,$office_pin,$office_telephone,$office_fax,$office_contact_person,$office_mobile,$office_email,$created_by,$created_table)
	{
		$updated_by = '';
		$updated_table=NULL;
		$query=$this->conn->prepare("INSERT INTO `office`(`office_code`,`office_name`,`office_address`,`office_city`,`office_pin`,`office_telephone`,`office_fax`,`office_contact_person`,`office_mobile`,`office_email`,`created_by`,`created_table`,`updated_by`,`updated_table`)VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		
		$query->bind_param("ssssssssssssss",$office_code,$office_name,$office_address,$office_city,$office_pin,$office_telephone,$office_fax,$office_contact_person,$office_mobile,$office_email,$created_by,$created_table,$updated_by,$updated_table);
		$query->execute();
		$query->store_result();
		$office_id=$query->insert_id;
		//$this->store_attachments($office_id,'office_attachments',$finalName,$titles,$name);
		if($query->error)
		{
			return 0;
		}
		else
		{
			return 1;
		}
		
	}
	public function office_update($id,$office_code,$office_name,$office_address,$office_city,$office_pin,$office_telephone,$office_fax,$office_contact_person,$office_mobile,$office_email,$updated_by,$updated_table)
    {
		$query=$this->conn->prepare("UPDATE `office` SET `office_code`=?,`office_name`=?,`office_address`=?,`office_city`=?,`office_pin`=?,`office_telephone`=?,`office_fax`=?,`office_contact_person`=?,`office_mobile`=?,`office_email`=?,`updated_by`=?,`updated_table`=? WHERE `id` LIKE ?");
		
		$query->bind_param("ssssssssssssi",$office_code,$office_name,$office_address,$office_city,$office_pin,$office_telephone,$office_fax,$office_contact_person,$office_mobile,$office_email,$updated_by,$updated_table,$id);
	    $query->execute();
		$query->store_result();
		$query->affected_rows;
		//$this->store_attachments($id,'office_attachments',$finalName,$titles,$name);
		if($query->error)
		{
			return 0;
		}
		else
		{
			return 1;
		}
	
	
}

	
	public function consignee_registration($data,$finalName,$name,$created_by,$created_table)
	{
		
		$str_query =  "INSERT INTO `consignee` (";
		
		
		foreach($data as $k=>$v)
		{
			if(is_array($v)==0 && $k!="submit" && $k!="key" && $k!="hide_for_partner" && $k!="hide_for_add_firms")
			{
				$str_query .= "`".$k."`,";
				
			}
			
		}
			$str_query .="`created_by`,`created_table`,`updated_by`,`updated_table`";
			//$str_query = substr($str_query,0,strlen($str_query)-1);
			$str_query .=") VALUES(";
			
		
		foreach($data as $k=>$v)
		{
		if(is_array($v)==0 && $k!="submit" && $k!="key" && $k!="hide_for_partner" && $k!="hide_for_add_firms")
			{
				if($k=='csign_firm_name')
				{
					$name_short = $this->CAMMELCASESTRING($v);
					$str_query .= "'".$name_short."',";
				}
				else
				{
				$str_query .= "'".$v."',";
				}
				
			}
		}
			$updated_by = NULL;
			$updated_table = NULL;
			$str_query .="'".$created_by."',";
			$str_query .="'".$created_table."',";
			$str_query .="'".$updated_by."',";
			$str_query .="'".$updated_table."'";
			//$str_query = substr($str_query,0,strlen($str_query)-1);
			
			$str_query .=")";
			
			
			$qqs = $this->conn->query($str_query);
			$consignee_id_prepare = $this->conn->query("SELECT `id` FROM `consignee` ORDER BY `id` DESC LIMIT 1" );
			$consignee_id = $consignee_id_prepare->fetch_assoc();
			
			
			if(isset($data['dir_names']))
			{
			$this->store_directors($data['dir_names'],$data['pan'],$data['dir_mobile'],$consignee_id['id']);
			}
			if(isset($data['titles']))
			{
			$this->store_attachments_after_other($consignee_id['id'],'csign_attachments',$finalName,$data['titles'],$name,$data['text_on_others']);
			}
			return $qqs;
			
	}
	public function main_consignee_registration($data,$finalName,$name,$created_by,$created_table)
	{
		$str_query =  "INSERT INTO `main_consignee` (";
		
		
		foreach($data as $k=>$v)
		{
			if(is_array($v)==0 && $k!="submit" && $k!="key" && $k!="hide_for_main_consignee")
			{
				$str_query .= "`".$k."`,";
				
			}
			
		}
			$str_query .="`main_csign_createdby`,`created_table`,`main_csign_updatedby`,`updated_table` ";
			//$str_query = substr($str_query,0,strlen($str_query)-1);
			$str_query .=") VALUES(";
			
		
		foreach($data as $k=>$v)
		{
		if(is_array($v)==0 && $k!="submit" && $k!="key" && $k!="hide_for_main_consignee")
			{
				
				if($k=='main_csign_name')
				{
					$name_short = $this->CAMMELCASESTRING($v);
					$str_query .= "'".$name_short."',";
				}
				else
				{
				$str_query .= "'".$v."',";
				}

				
				
			}
		}
			$updated_by = NULL;
			$updated_table = NULL;
			$str_query .="'".$created_by."',";
			$str_query .="'".$created_table."',";
			$str_query .="'".$updated_by."',";
			$str_query .="'".$updated_table."'";
			//$str_query = substr($str_query,0,strlen($str_query)-1);
			
			$str_query .=")";
			$qqs = $this->conn->query($str_query);
			$consignee_id_prepare = $this->conn->query("SELECT `id` FROM `main_consignee` ORDER BY `id` DESC LIMIT 1" );
			$consignee_id = $consignee_id_prepare->fetch_assoc();
			
			if(isset($data['contact_officername']))
			{
			$this->store_contacts_main_csign($data['contact_officername'],$data['contact_telephone'],$data['contact_mobile'],$data['contact_fax'],$data['contact_residence'],$data['contact_email'],$data['contact_deal'],$consignee_id['id']);
			}
			/*if(isset($data['titles']))
			{
			$this->store_attachments($consignee_id['id'],'main_csign_attachments',$finalName,$data['titles'],$name);
			}*/
			return $qqs;
			
	}
	public function consignee_update($data,$finalName,$name,$id,$updated_by,$updated_table)
	{
		$str_query =  "UPDATE  `consignee` SET ";
		
		
		foreach($data as $k=>$v)
		{
			if(is_array($v)==0 && $k!="submit" && $k!="key" && $k!="hide_for_partner" && $k!="hide_for_add_firms")
			{
				if($k=='csign_firm_name')
				{
					$name_short = $this->CAMMELCASESTRING($v);
					$str_query .= "`".$k."` = ";
					$str_query .= "'".$name_short."' , ";
				}
				else
				{
				$str_query .= "`".$k."` = ";
				$str_query .= "'".$v."' , ";
				}
				
			}
			
		}
			$str_query .= "`updated_by` = ";
			$str_query .= "'".$updated_by."' , ";
			$str_query .="`updated_table` = ";
			$str_query .= "'".$updated_table."' ";
		
			$str_query = substr($str_query,0,strlen($str_query)-1);
			$str_query .= "WHERE `id` LIKE '".$id."' ";
			$qqs = $this->conn->query($str_query);
			if(isset($data['dir_names']))
			{
			$this->store_directors($data['dir_names'],$data['pan'],$data['dir_mobile'],$id);
			}
			if(isset($data['titles']))
			{
			//$this->store_attachments($id,'csign_attachments',$finalName,$data['titles'],$name);
			$this->store_attachments_after_other($id,'csign_attachments',$finalName,$data['titles'],$name,$data['text_on_others']);
			
			}
			return 1;
			
	}
	public function main_consignee_update($data,$finalName,$name,$id,$updated_by,$updated_table)
	{
		$str_query =  "UPDATE `main_consignee` SET ";
		
		
		foreach($data as $k=>$v)
		{
			if(is_array($v)==0 && $k!="submit" && $k!="key" && $k!="hide_for_main_consignee")
			{
				
				if($k=='main_csign_name')
				{
					$name_short = $this->CAMMELCASESTRING($v);
					$str_query .= "`".$k."` = ";
					$str_query .= "'".$name_short."' , ";
				}
				else
				{
				$str_query .= "`".$k."` = ";
				$str_query .= "'".$v."' , ";
				}
				
				
			}
			
		}
			$str_query .= "`main_csign_updatedby` = ";
			$str_query .= "'".$updated_by."',";
			$str_query .= "`updated_table` = ";
			$str_query .= "'".$updated_table."' ";
		
			$str_query = substr($str_query,0,strlen($str_query)-1);
			$str_query .= " WHERE `id` LIKE '".$id."' ";
			
			$qqs = $this->conn->query($str_query);
			if(isset($data['contact_officername']))
			{
			$this->store_contacts_main_csign($data['contact_officername'],$data['contact_telephone'],$data['contact_mobile'],$data['contact_fax'],$data['contact_residence'],$data['contact_email'],$data['contact_deal'],$id);
			}
			/*if(isset($data['titles']))
			{
			$this->store_attachments($id,'main_csign_attachments',$finalName,$data['titles'],$name);
			}*/
			return $qqs;
			
	}
	//-------------------MAHENDRA------------------------------
	public function purchaser_registration($data,$finalName,$name,$created_by,$created_table)
	{
		$str_query =  "INSERT INTO `create_purchaser` (";
		
		
		foreach($data as $k=>$v)
		{
			if(is_array($v)==0 && $k!="submit" && $k!="key" && $k!="hide_for_counter")
			{
				$str_query .= "`".$k."`,";
				
			}
			
		}
			$str_query .="`created_by`,`created_table`,`updated_by`,`updated_table` ";
			//$str_query = substr($str_query,0,strlen($str_query)-1);
			$str_query .=") VALUES(";
			
		
		foreach($data as $k=>$v)
		{
		if(is_array($v)==0 && $k!="submit" && $k!="key" && $k!="hide_for_counter")
			{
				if($k=="purchaser_name")
				{
					$name_short = $this->CAMMELCASESTRING($v);
					$str_query .= "'".$name_short."',";
					
				}
				else
				{
				$str_query .= "'".$v."',";
				}
				
			}
		}
			$updated_by = NULL;
			$updated_table = NULL;
			$str_query .="'".$created_by."',";
			$str_query .="'".$created_table."',";
			$str_query .="'".$updated_by."',";
			$str_query .="'".$updated_table."'";
			//$str_query = substr($str_query,0,strlen($str_query)-1);
			
			$str_query .=")";
			
			
			$qqs = $this->conn->query($str_query);
			$purchaser_id_prepare = $this->conn->query("SELECT `id` FROM `create_purchaser` ORDER BY `id` DESC LIMIT 1" );
			$purchaser_id = $purchaser_id_prepare->fetch_assoc();
			
			if(isset($data['purchaser_post_name']))
			{
			$this->store_directors_purchaser($data['purchaser_post_name'],$data['purchaser_office_name'],$data['purchaser_tel'],$data['purchaser_mob'],$data['purchaser_residence'],$data['purchaser_fax'],$data['purchaser_email'],$data['purchaser_deals'],$purchaser_id['id']);
			}
			return $qqs;
			/*if(isset($data['titles']))
			{
			$this->store_attachments($purchaser_id['id'],'purchase_attachments',$finalName,$data['titles'],$name);
			}*/
			
	}
	
	public function purchase_update($data,$finalName,$name,$id,$updated_by,$updated_table)
	{
		$str_query =  "UPDATE  `create_purchaser` SET ";
		
		
		foreach($data as $k=>$v)
		{
			if(is_array($v)==0 && $k!="submit" && $k!="key" && $k!="hide_for_counter")
			{
				if($k=='purchaser_name')
				{
					$name_short = $this->CAMMELCASESTRING($v);
					$str_query .= "`".$k."` = ";
					$str_query .= "'".$name_short."' , ";
				}
				else
				{
                $str_query .= "`".$k."` = ";
				$str_query .= "'".$v."' , ";				
				}
				
				
			}
			
		}
			$str_query .= "`updated_by` = ";
			$str_query .= "'".$updated_by."',";
			$str_query .= "`updated_table` = ";
			$str_query .= "'".$updated_table."' ";
			$str_query = substr($str_query,0,strlen($str_query)-1);
			$str_query .= "WHERE `id` LIKE '".$id."' ";
			$qqs = $this->conn->query($str_query);
			if(isset($data['purchaser_post_name']))
			{
			$this->store_directors_purchaser($data['purchaser_post_name'],$data['purchaser_office_name'],$data['purchaser_tel'],$data['purchaser_mob'],$data['purchaser_residence'],$data['purchaser_fax'],$data['purchaser_email'],$data['purchaser_deals'],$id);
			}
			/*if(isset($data['titles']))
			{
			$this->store_attachments($id,'purchase_attachments',$finalName,$data['titles'],$name);
			
			}*/
			return $qqs;
			
	}
	
	public function purchase_Update_Directors($id,$purchaser_post_name,$purchaser_office_name,$purchaser_tel,$purchaser_mob,$purchaser_residence,$purchaser_fax,$purchaser_email,$purchaser_deals)
	{
		$query=$this->conn->prepare("UPDATE `purchaser_director` SET `purchaser_post_name`=?,`purchaser_office_name`=?,`purchaser_tel`=?,`purchaser_mob`=?,`purchaser_residence`=?,`purchaser_fax`=?,`purchaser_email`=?,`purchaser_deals`=? WHERE `id` LIKE ?");
		$query->bind_param("ssssssssi",$purchaser_post_name,$purchaser_office_name,$purchaser_tel,$purchaser_mob,$purchaser_residence,$purchaser_fax,$purchaser_email,$purchaser_deals,$id);
		$query->execute();
		
		
	}
	public function store_contacts_main_csign($contact_officername,$contact_telephone,$contact_mobile,$contact_fax,$contact_residence,$contact_email,$contact_deal,$main_csign_id)
	{
		$id=NULL;
		for($i=0;$i<sizeof($contact_officername);$i++)
		{
		 if($contact_officername[$i]!="")
		{
		$query = $this->conn->prepare("INSERT INTO `main_consignee_contacts` VALUES(?,?,?,?,?,?,?,?,?)");
		$query->bind_param("iisssssss",$id,$main_csign_id,$contact_officername[$i],$contact_telephone[$i],$contact_mobile[$i],$contact_fax[$i],$contact_residence[$i],$contact_email[$i],$contact_deal[$i]);
		$query->execute();
		}	
		}
		
	}
	public function store_directors_purchaser($purchaser_post_name,$purchaser_office_name,$purchaser_tel,$purchaser_mob,$purchaser_residence,$purchaser_fax,$purchaser_email,$purchaser_deals,$id)
	{
		for($i=0;$i<sizeof($purchaser_post_name);$i++)
		{
		 if($purchaser_post_name[$i]!="" || $purchaser_office_name[$i]!="")
		{
		$query = $this->conn->prepare("INSERT INTO `purchaser_director` VALUES(NULL,?,?,?,?,?,?,?,?,?)");
		$query->bind_param("issssssss",$id,$purchaser_post_name[$i],$purchaser_office_name[$i],$purchaser_tel[$i],$purchaser_mob[$i],$purchaser_residence[$i],$purchaser_fax[$i],$purchaser_email[$i],$purchaser_deals[$i]);
		$query->execute();
		}	
		}
	}
	//-------------------------------------------------------
	public function Update_Directors($dir_name,$pan,$dir_mobile,$dir_id)
	{
		$query = $this->conn->query("UPDATE `consignee_director` SET `csign_director` = '".$dir_name."' , `csign_pan_number` = '".$pan."' , `csign_tel_number` = '".$dir_mobile."' WHERE `id` LIKE '".$dir_id."'  ");
		
	}
	public function Update_Main_Cnsigee_Directors($contact_officername,$contact_telephone,$contact_mobile,$contact_residence,$contact_fax,$contact_email,$contact_deal,$main_cnsige_id)
	{
		$query = $this->conn->query("UPDATE `main_consignee_contacts` SET `contact_officername`='".$contact_officername."',`contact_telephone`='".$contact_telephone."',`contact_mobile`='".$contact_mobile."',`contact_residence`='".$contact_residence."',`contact_fax`='".$contact_fax."',`contact_email`='".$contact_email."',`contact_deal`='".$contact_deal."' WHERE `id` LIKE ".$main_cnsige_id);
		
	}
	
	
	public function Update_Item($titles,$discription,$finalName,$name,$id,$updated_by,$updated_table)
	{
		$query = $this->conn->query("UPDATE `item_manager` SET `item_name` = '".$titles."' , `item_discription` = '".$discription."' , `file` = '".$finalName."' , `file_real_name` = '".$name."',`updated_by`='".$updated_by."',`updated_table`='".$updated_table."' WHERE `id` LIKE '".$id."'  ");
		if($query->error)
		{
			return 0;
		}
		else
		{
			return 1;
		}
		
	}
	//--------------Tender SAVING------------------------------
	public function tender_registration($data,$finalName,$name,$created_by,$created_table)
	{
		
		
		$query = $this->conn->prepare("INSERT INTO `tender`(`id`,`tender_office`,`tender_purchaser`,`tender_type`,`tender_number`,`tender_due_date`,`tender_time`,`tender_sample`,`tender_tdc`,`tender_emd`,`tender_criteria`,`created_by`,`created_table`,`updated_by`,`updated_table`,`status`,`firm_status`,`tender_composition_rate`) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		$id=NULL;
		$updated_by=NULL;
		$updated_table=NULL;
		$tender_composition_rate=NULL;
		$status=0;
		$firm_status=0;
		$correct_date_format = explode('-',$data['tender_due_date']);
		$final_date=$correct_date_format[2]."-".$correct_date_format[1]."-".$correct_date_format[0];
$query->bind_param("isiisssisssssssiis",$id,$data['tender_office'],$data['tender_purchaser'],$data['tender_type'],$data['tender_number'],
$final_date,$data['tender_time'],$data['tender_sample'],
$data['tender_tdc'],$data['tender_emd'],$data['tender_criteria'],$created_by,$created_table,$updated_by,$updated_table,$status,$firm_status,$tender_composition_rate);
		$query->execute();
		$query->store_result();
		if($query->error)
		{
			return 0;
		}
		else
		{
			$tender_id = $query->insert_id;
			//$this->store_tender_firms($data,$tender_id);
			$emp_cnsi=$this->store_tender_firms_product($data['category'],$_POST['inspection'],$data['discription'],$data['consignee'],$data['quantity'],$data['unit'],$tender_id);
			
			$this->store_attachments_after_other($tender_id,'tender_attachments',$data['File_Big_Re'],$data['Title_Re'],$data['File_Real_Re'],$data['Other_Title_Re']);
			$this->store_attachments_after_other($tender_id,'tender_attachments',$finalName,$data['titles'],$name,$data['text_on_others']);
			//$this->store_attachments($tender_id,'tender_attachments',$data['File_Big_Re'],$data['Title_Re'],$data['File_Real_Re']);
			$this->StoreLimitedFirms($tender_id,$data['LimitedFirm']);
			
			return 1;
		}
		
}
public function tender_registration_history_wala($data,$finalName,$name,$created_by,$created_table)
{
	$status=0;
$query = $this->conn->prepare("INSERT INTO `history_tender`(`id`,`tender_office`,`tender_purchaser`,`tender_number`,`tender_due_date`,`tender_sample`,`created_by`,`created_table`,`updated_by`,`updated_table`,`status`) VALUES(NULL,?,?,?,?,?,?,?,?,?,?)");
		//$id=0;
		$updated_by=NULL;
		$updated_table=NULL;
		$correct_date_format = explode('-',$data['tender_due_date']);
		$final_date=$correct_date_format[2]."-".$correct_date_format[1]."-".$correct_date_format[0];
$query->bind_param("sississssi",$data['tender_office'],$data['tender_purchaser'],$data['tender_number'],
$final_date,$data['tender_sample'],$created_by,$created_table,$updated_by,$updated_table,$status);
		$query->execute();
		$query->store_result();
		if($query->error)
		{
			return 0;
		}
		else
		{
			$tender_id = $query->insert_id;
			
			$emp_cnsi=$this->store_tender_firms_product_History($data['category'],$_POST['inspection'],$data['discription'],$data['consignee'],$data['quantity'],$data['unit'],$tender_id);
			$this->store_attachments_after_other($tender_id,'history_tender_attachments',$data['File_Big_Re'],$data['Title_Re'],$data['File_Real_Re'],$data['Other_Title_Re']);
			$this->store_attachments_after_other($tender_id,'history_tender_attachments',$finalName,$data['titles'],$name,$data['text_on_others']);
			
			
			return $query;
		}
	
}

public function po_registration_history_wala($data,$finalName,$name,$created_by,$created_table)
{
	
		$status=0;
$query = $this->conn->prepare("INSERT INTO `history_po`(`id`,`po_office`,`po_purchaser`,`po_firm`,`po_number`,`po_due_date`,`po_value`,`created_by`,`created_table`,`updated_by`,`updated_table`,`status`) VALUES(NULL,?,?,?,?,?,?,?,?,?,?,?)");
		//$id=0;
		$updated_by=NULL;
		$updated_table=NULL;
		$correct_date_format = explode('-',$data['po_due_date']);
		$final_date=$correct_date_format[2]."-".$correct_date_format[1]."-".$correct_date_format[0];
$query->bind_param("iiisssssssi",$data['po_office'],$data['tender_purchaser'],$data['po_firms'],$data['po_number'],
$final_date,$data['po_value'],$created_by,$created_table,$updated_by,$updated_table,$status);
		$query->execute();
		$query->store_result();
		if($query->error)
		{
			return 0;
		}
		else
		{
			$tender_id = $query->insert_id;
			
			$emp_cnsi=$this->store_po_firms_product_History($data['category'],$_POST['inspection'],$data['discription'],$data['consignee'],$data['quantity'],$data['unit'],$data['tax_type'],$data['tax'],$data['rate'],$tender_id);
			
			$this->store_attachments_after_other($tender_id,'history_po_attachements',$finalName,$data['titles'],$name,$data['text_on_others']);
			
			
			return $query;
		}
	
}
 public function StoreLimitedFirms($tender_id,$firm_id)
 {
	 	for($i=0;$i<sizeof($firm_id);$i++)
		{
			if($firm_id[$i]!="")
			{
$query = $this->conn->prepare("INSERT INTO `tender_limited_firm` VALUES(NULL,?,?)");        
		$query->bind_param("ii",$tender_id,$firm_id[$i]);
		$query->execute();
			}
		}
	 
	 
 }
public function tender_registration_update($data,$finalName,$name,$updated_by,$updated_table,$editID)
{
	$correct_date_format = explode('-',$data['tender_due_date']);
	$final_date=$correct_date_format[2]."-".$correct_date_format[1]."-".$correct_date_format[0];
	$query = $this->conn->query("UPDATE `tender` SET `tender_office`='".$data['tender_office']."',`tender_type`='".$data['tender_type']."',`tender_number`='".$data['tender_number']."',
`tender_due_date`='".$final_date."',`tender_time`='".$data['tender_time']."',`tender_sample`='".$data['tender_sample']."',
`tender_tdc`='".$data['tender_tdc']."',`tender_emd`='".$data['tender_emd']."',`tender_criteria`='".$data['tender_criteria']."',`updated_by`='".$updated_by."',`updated_table`='".$updated_table."' WHERE `id` LIKE ".$editID);

		if($query->error)
		{
			return 0;
		}
		else
		{
			
			
			$tender_id = $editID;
			$emp_cnsi=$this->store_tender_firms_product($data['category'],$_POST['inspection'],$data['discription'],$data['consignee'],$data['quantity'],$data['unit'],$tender_id);
			//$this->store_attachments($tender_id,'tender_attachments',$finalName,$data['titles'],$name);
			$this->store_attachments_after_other($tender_id,'tender_attachments',$finalName,$data['titles'],$name,$data['text_on_others']);
			$this->StoreLimitedFirms($tender_id,$data['LimitedFirm']);
			
			return 1;
		}
	
}
public function tender_registration_update_history_wale($data,$finalName,$name,$updated_by,$updated_table,$editID)
{
		$correct_date_format = explode('-',$data['tender_due_date']);
	$final_date=$correct_date_format[2]."-".$correct_date_format[1]."-".$correct_date_format[0];
	$query = $this->conn->query("UPDATE `history_tender` SET `tender_office`='".$data['tender_office']."',`tender_number`='".$data['tender_number']."',
`tender_due_date`='".$final_date."',`tender_sample`='".$data['tender_sample']."',
`updated_by`='".$updated_by."',`updated_table`='".$updated_table."' WHERE `id` LIKE ".$editID);

		if($query->error)
		{
			return 0;
		}
		else
		{
			
			$tender_id = $editID;
			$emp_cnsi=$this->store_tender_firms_product_History($data['category'],$_POST['inspection'],$data['discription'],$data['consignee'],$data['quantity'],$data['unit'],$tender_id);
			
			
			
			
			$this->store_attachments_after_other($tender_id,'history_tender_attachments',$finalName,$data['titles'],$name,$data['text_on_others']);
			
			
			return 1;
		}
	
}

/*public function store_tender_firms($data,$tender_id)
{
	for($i=0;$i<sizeof($data['firm']);$i++)
	{
		if($data['firm'][$i]!="")
		{
		$query_tender_firm = $this->conn->prepare("INSERT INTO `tender_firms`(`id`,`tender_id`,`firm_id`) VALUES (?,?,?)");
	 $id=NULL;
	 $query_tender_firm->bind_param("iii",$id,$tender_id,$data['firm'][$i]);
	 $query_tender_firm->execute();
	 $query_tender_firm->store_result();
	 $new_firm_id = $query_tender_firm->insert_id;
	 		if($query_tender_firm)
	 		{
	 		$this->store_tender_firms_product($tender_id,$new_firm_id,$data['category'.$i],$data['discription'.$i],$data['consignee'.$i],$data['quantity'.$i],$data['unit'.$i]);
			}
		}
	}
	
}*/
public function store_tender_firms_product($category,$inspection,$discription,$consignee,$quantity,$unit,$tender_id)
{
	$empty_consignee=1;
	//$status=0;
	
	for($i=0;$i<sizeof($category);$i++)
	{
		
		if($category[$i]!="" && $consignee[$i]!="")
		{
			
			$rest = $category[$i];
			$kk=explode("(",$rest);
			$final=explode(")",$kk[1]);
			//echo $final[0];

			
		$query_firm_product = $this->conn->query("INSERT INTO `tender_firm_product`(`tender_id`,`category`,`inspection`,`discription`,`consignee`,`quantity`,`unit`) VALUES ('".$tender_id."','".$final[0]."','".$inspection[$i]."','".$discription[$i]."','".$consignee[$i]."','".$quantity[$i]."','".$unit[$i]."') ");
		
	}
	}
	return $empty_consignee;
}
public function store_tender_firms_product_History($category,$inspection,$discription,$consignee,$quantity,$unit,$tender_id)
{
	
	$empty_consignee=1;
	//$status=0;
	
	for($i=0;$i<sizeof($category);$i++)
	{
		//echo $tender_id.','.$final[0].','.$inspection[$i].','.$discription[$i].','.$consignee[$i].','.$quantity[$i].','.$unit[$i];
		if($category[$i]!="" && $consignee[$i]!="")
		{
			
			$rest = $category[$i];
			$kk=explode("(",$rest);
			$final=explode(")",$kk[1]);
			//echo $final[0];
$query_firm_product = $this->conn->query("INSERT INTO `history_tender_firm_product`(`tender_id`,`category`,`inspection`,`discription`,`consignee`,`quantity`,`unit`) VALUES ('".$tender_id."','".$final[0]."','".$inspection[$i]."','".$discription[$i]."','".$consignee[$i]."','".$quantity[$i]."','".$unit[$i]."') ");

		
	}
	}
	return $empty_consignee;
	
}
public function store_po_firms_product_History($category,$inspection,$discription,$consignee,$quantity,$unit,$tax_type,$tax,$rate,$tender_id)
{
	$empty_consignee=1;
	//$status=0;
	
	for($i=0;$i<sizeof($category);$i++)
	{
		//echo $tender_id.','.$final[0].','.$inspection[$i].','.$discription[$i].','.$consignee[$i].','.$quantity[$i].','.$unit[$i];
		if($category[$i]!="" && $consignee[$i]!="")
		{
			
			$rest = $category[$i];
			$kk=explode("(",$rest);
			$final=explode(")",$kk[1]);
			//echo $final[0];
$query_firm_product = $this->conn->query("INSERT INTO `history_po_firm_product`(`po_id`,`category`,`inspection`,`discription`,`consignee`,`quantity`,`unit`,`tax_type`,`tax`,`rate`) VALUES ('".$tender_id."','".$final[0]."','".$inspection[$i]."','".$discription[$i]."','".$consignee[$i]."','".$quantity[$i]."','".$unit[$i]."','".$tax_type[$i]."','".$tax[$i]."','".$rate[$i]."') ");

		
	}
	}
	return $empty_consignee;
	
}

//----------------Tender Management Ends---------------------
	
	public function store_directors($name,$pan,$mobile,$id)
	{
		for($i=0;$i<sizeof($name);$i++)
		{
			if($name[$i]!="")
			{
		$query = $this->conn->prepare("INSERT INTO 		                        `consignee_director` VALUES(NULL,?,?,?,?)");        $query->bind_param("isss",$id,$name[$i],$pan[$i],
								  $mobile[$i]);
		$query->execute();
			}
			
		}
	}
	public function common_update($name_colm,$table)
	{
		
		$data = array();
		$query_update = $this->conn->query("SELECT `".$name_colm."` , `id` FROM `".$table."` ");
		$data = array();
		while($raw = $query_update->fetch_assoc())
		{
			$data[] = $raw;
		}
		return $data;
		
	}
	public function common_fetchdata($table,$id)
	{
		
		$query_update = $this->conn->query("SELECT * FROM `".$table."` WHERE `id` LIKE '".$id."' " );
		$data = $query_update->fetch_assoc();
		return $data;
		
	}
	public function common_fetchdata_FETCH_ARRAY($table,$id)
	{
		$query_update = $this->conn->query("SELECT * FROM `".$table."` WHERE `id` LIKE '".$id."' " );
		$data = $query_update->fetch_array();
		return $data;
		
	}
	public function LoginData($table,$username)
	{
		$user1 = $table."_user_name";
		$query_data = $this->conn->query("SELECT * FROM `".$table."` WHERE `".$user1."` LIKE '".$username."' " );
		
		$data = $query_data->fetch_assoc();
		return $data;
	}
/*	public function common_update_allcolm($table,$created,$updated)
	{
		$data = array();
		$query_update = $this->conn->query("SELECT *,(SELECT `admin`.`admin_first_name` FROM `rainbow`.`admin` WHERE `admin`.`pin` LIKE `".$table."`.`".$created."`) AS `adm_n`,(SELECT `officer`.`officer_first_name` FROM `rainbow`.`officer` WHERE `officer`.`officer_pin` LIKE `".$table."`.`".$created."`) AS `offi_n`,(SELECT `employee`.`employee_first_name` FROM `rainbow`.`employee` WHERE `employee`.`employee_pin` LIKE `".$table."`.`".$created."`) AS `emp_n`,(SELECT `admin`.`admin_first_name` FROM `rainbow`.`admin` WHERE `admin`.`pin` LIKE `".$table."`.`".$updated."`) AS `adm_U`,(SELECT `officer`.`officer_first_name` FROM `rainbow`.`officer` WHERE `officer`.`officer_pin` LIKE `".$table."`.`".$updated."`) AS `offi_U`,(SELECT `employee`.`employee_first_name` FROM `rainbow`.`employee` WHERE `employee`.`employee_pin` LIKE `".$table."`.`".$updated."`) AS `emp_U` FROM `".$table."`"); 
		$data = array();
		while($raw = $query_update->fetch_assoc())
		{
			$data[] = $raw;
		}
		return $data;
	}*/
	public function common_update_allcolm2($table,$created_by,$created_table,$updated_by,$updated_table)
	{
		
		$data = array();
		$query_update2 = $this->conn->query("SELECT *,`".$created_table."`,(IF (`".$created_table."` LIKE 0,(SELECT `admin_first_name` FROM `admin` WHERE `admin`.`id` LIKE `".$table."`.`".$created_by."`),IF (`".$created_table."` LIKE 1,(SELECT `officer_first_name` FROM `officer` WHERE `officer`.`id` LIKE `".$table."`.`".$created_by."` LIMIT 1),(SELECT `employee_first_name` FROM `employee` WHERE `employee`.`id` LIKE `".$table."`.`".$created_by."` LIMIT 1)))) AS 'created_by_name',(IF (`".$updated_table."` LIKE 0,(SELECT `admin_first_name` FROM `admin` WHERE `admin`.`id` LIKE `".$table."`.`".$updated_by."`),IF (`".$updated_table."` LIKE 1,(SELECT `officer_first_name` FROM `officer` WHERE `officer`.`id` LIKE `".$table."`.`".$updated_by."` LIMIT 1),(SELECT `employee_first_name` FROM `employee` WHERE `employee`.`id` LIKE `".$table."`.`".$updated_by."` LIMIT 1)))) AS 'updated_by_name' FROM `".$table."`");
		while($raw=$query_update2->fetch_assoc())
		{
			$data[]=$raw;
		}
		return $data;
		
	}
	public function common_update_allcolm2_order_by_short($table,$created_by,$created_table,$updated_by,$updated_table,$order)
	{
		$data = array();
		$query_update2 = $this->conn->query("SELECT *,`".$created_table."`,(IF (`".$created_table."` LIKE 0,(SELECT `admin_first_name` FROM `admin` WHERE `admin`.`id` LIKE `".$table."`.`".$created_by."`),IF (`".$created_table."` LIKE 1,(SELECT `officer_first_name` FROM `officer` WHERE `officer`.`id` LIKE `".$table."`.`".$created_by."` LIMIT 1),(SELECT `employee_first_name` FROM `employee` WHERE `employee`.`id` LIKE `".$table."`.`".$created_by."` LIMIT 1)))) AS 'created_by_name',(IF (`".$updated_table."` LIKE 0,(SELECT `admin_first_name` FROM `admin` WHERE `admin`.`id` LIKE `".$table."`.`".$updated_by."`),IF (`".$updated_table."` LIKE 1,(SELECT `officer_first_name` FROM `officer` WHERE `officer`.`id` LIKE `".$table."`.`".$updated_by."` LIMIT 1),(SELECT `employee_first_name` FROM `employee` WHERE `employee`.`id` LIKE `".$table."`.`".$updated_by."` LIMIT 1)))) AS 'updated_by_name' FROM `".$table."` ORDER BY `".$order."` ASC ");
		while($raw=$query_update2->fetch_assoc())
		{
			$data[]=$raw;
		}
		return $data;
		
	}
	public function common_update_allcolm2_order_by_short_on_Purchaser($table,$created_by,$created_table,$updated_by,$updated_table,$order,$pid)
	{
		$data = array();
		$query_update2 = $this->conn->query("SELECT *,`".$created_table."`,(IF (`".$created_table."` LIKE 0,(SELECT `admin_first_name` FROM `admin` WHERE `admin`.`id` LIKE `".$table."`.`".$created_by."`),IF (`".$created_table."` LIKE 1,(SELECT `officer_first_name` FROM `officer` WHERE `officer`.`id` LIKE `".$table."`.`".$created_by."` LIMIT 1),(SELECT `employee_first_name` FROM `employee` WHERE `employee`.`id` LIKE `".$table."`.`".$created_by."` LIMIT 1)))) AS 'created_by_name',(IF (`".$updated_table."` LIKE 0,(SELECT `admin_first_name` FROM `admin` WHERE `admin`.`id` LIKE `".$table."`.`".$updated_by."`),IF (`".$updated_table."` LIKE 1,(SELECT `officer_first_name` FROM `officer` WHERE `officer`.`id` LIKE `".$table."`.`".$updated_by."` LIMIT 1),(SELECT `employee_first_name` FROM `employee` WHERE `employee`.`id` LIKE `".$table."`.`".$updated_by."` LIMIT 1)))) AS 'updated_by_name' FROM `".$table."` WHERE `main_csign_purchaser` LIKE '".$pid."' ORDER BY `".$order."` ASC ");
		while($raw=$query_update2->fetch_assoc())
		{
			$data[]=$raw;
		}
		return $data;
		
	}
	public function common_update_allcolm2_order_by_short_on_Office($table,$created_by,$created_table,$updated_by,$updated_table,$order,$pid,$colm)
	{
		$data = array();
		$query_update2 = $this->conn->query("SELECT *,`".$created_table."`,(IF (`".$created_table."` LIKE 0,(SELECT `admin_first_name` FROM `admin` WHERE `admin`.`id` LIKE `".$table."`.`".$created_by."`),IF (`".$created_table."` LIKE 1,(SELECT `officer_first_name` FROM `officer` WHERE `officer`.`id` LIKE `".$table."`.`".$created_by."` LIMIT 1),(SELECT `employee_first_name` FROM `employee` WHERE `employee`.`id` LIKE `".$table."`.`".$created_by."` LIMIT 1)))) AS 'created_by_name',(IF (`".$updated_table."` LIKE 0,(SELECT `admin_first_name` FROM `admin` WHERE `admin`.`id` LIKE `".$table."`.`".$updated_by."`),IF (`".$updated_table."` LIKE 1,(SELECT `officer_first_name` FROM `officer` WHERE `officer`.`id` LIKE `".$table."`.`".$updated_by."` LIMIT 1),(SELECT `employee_first_name` FROM `employee` WHERE `employee`.`id` LIKE `".$table."`.`".$updated_by."` LIMIT 1)))) AS 'updated_by_name' FROM `".$table."` WHERE `".$colm."` LIKE '".$pid."' ORDER BY `".$order."` ASC ");
		
		while($raw=$query_update2->fetch_assoc())
		{
			$data[]=$raw;
		}
		return $data;
		
	}
	
	
	public function common_update_allcolm2_tender($table,$created_by,$created_table,$updated_by,$updated_table)
	{
		
		$data = array();
		$query_update2 = $this->conn->query("SELECT *,`".$created_table."`,(IF (`".$created_table."` LIKE 0,(SELECT `admin_first_name` FROM `admin` WHERE `admin`.`id` LIKE `".$table."`.`".$created_by."`),IF (`".$created_table."` LIKE 1,(SELECT `officer_first_name` FROM `officer` WHERE `officer`.`id` LIKE `".$table."`.`".$created_by."` LIMIT 1),(SELECT `employee_first_name` FROM `employee` WHERE `employee`.`id` LIKE `".$table."`.`".$created_by."` LIMIT 1)))) AS 'created_by_name',(IF (`".$updated_table."` LIKE 0,(SELECT `admin_first_name` FROM `admin` WHERE `admin`.`id` LIKE `".$table."`.`".$updated_by."`),IF (`".$updated_table."` LIKE 1,(SELECT `officer_first_name` FROM `officer` WHERE `officer`.`id` LIKE `".$table."`.`".$updated_by."` LIMIT 1),(SELECT `employee_first_name` FROM `employee` WHERE `employee`.`id` LIKE `".$table."`.`".$updated_by."` LIMIT 1)))) AS 'updated_by_name' FROM `".$table."` WHERE `status` LIKE 0");
		while($raw=$query_update2->fetch_assoc())
		{
			$data[]=$raw;
		}
		return $data;
		
		
	}
	
	public function attach_records($id,$table,$field)
	{
		
		$data = array();
		$query_update = $this->conn->query("SELECT * FROM `".$table."` WHERE `".$field."` LIKE '".$id."'  ");
		
		$data = array();
		while($raw = $query_update->fetch_assoc())
		{
			$data[] = $raw;
		}
		return $data;
		
	}
	
	public function attach_recordsXYZ($id,$table,$field)
	{
		
		
		$data = array();
		$query_update = $this->conn->query("SELECT * FROM ".$table." WHERE `".$field."` LIKE '".$id."'  ");
		$data = array();
		while($raw = $query_update->fetch_assoc())
		{
			$data[] = $raw;
		}
		return $data;
		
	}
	public function attach_records_tender($id,$table,$field)
	{
		$data = array();
		$query_update = $this->conn->query("SELECT `".$table."`.`id`,`item_manager`.`item_name`,`item_manager`.`item_discription` FROM `".$table."`,`item_manager` WHERE `".$table."`.`category` LIKE `item_manager`.`id` AND `".$table."`.`".$field."` LIKE '".$id."'");
		
		$data = array();
		while($raw = $query_update->fetch_assoc())
		{
			$data[] = $raw;
		}
		return $data;
		
	}
	public function attach_records_products($id,$table,$field)
	{
		$data = array();
		//$query_update = $this->conn->query("SELECT * FROM `".$table."` WHERE `".$field."` LIKE '".$id."'  ");
		$query_update = $this->conn->query("SELECT  item_manager.item_name,item_manager.item_discription,main_consignee.main_csign_short_name,tender_firm_product.* FROM `item_manager`,`main_consignee`,`tender_firm_product` WHERE item_manager.id LIKE tender_firm_product.category AND tender_firm_product.tender_id LIKE '".$id."' AND tender_firm_product.consignee LIKE main_consignee.id");
		
		$data = array();
		while($raw = $query_update->fetch_assoc())
		{
			$data[] = $raw;
		}
		return $data;
	}
	public function attach_records_products_of_tender_in_history($id,$table,$field)
	{
		$data = array();
		//$query_update = $this->conn->query("SELECT * FROM `".$table."` WHERE `".$field."` LIKE '".$id."'  ");
		$query_update = $this->conn->query("SELECT  item_manager.item_name,item_manager.item_discription,main_consignee.main_csign_short_name,history_tender_firm_product.* FROM `item_manager`,`main_consignee`,`history_tender_firm_product` WHERE item_manager.id LIKE history_tender_firm_product.category AND history_tender_firm_product.tender_id LIKE '".$id."' AND history_tender_firm_product.consignee LIKE main_consignee.id");
		
		$data = array();
		while($raw = $query_update->fetch_assoc())
		{
			$data[] = $raw;
		}
		return $data;
	}
	public function attach_records_products_single($id,$table)
	{
		$query = $this->conn->query("SELECT  item_manager.item_name,item_manager.item_discription,main_consignee.main_csign_short_name,tender_firm_product.* FROM `item_manager`,`main_consignee`,`tender_firm_product` WHERE item_manager.id LIKE tender_firm_product.category AND tender_firm_product.id LIKE '".$id."' AND tender_firm_product.consignee LIKE main_consignee.id");
		return $query->fetch_assoc();
		
		
	}
	public function attach_records_products_with_firms($tender_id)
	{
		$query_update_firm = $this->conn->query("SELECT  item_manager.item_name,tender_firm_product.id FROM `item_manager`,`tender_firm_product` WHERE item_manager.id LIKE tender_firm_product.category AND tender_firm_product.tender_id LIKE '".$tender_id."'");
		
		$data = array();
		while($raw = $query_update_firm->fetch_assoc())
		{
			$data[] = $raw;
		}
		return $data;
		
	}
	public function FirmsDetails($product_id)
	{
		$aditi = array();
		$query_firm=$this->conn->query("SELECT `tender_firms`.`id`,`consignee`.`csign_firm_name` FROM `tender_firms`,`consignee` WHERE `tender_firms`.`firm` LIKE `consignee`.`id` AND `tender_firms`.`product_id` LIKE ".$product_id);
		while($meenu = $query_firm->fetch_assoc())
		{
			$aditi[]=$meenu;
		}
		return $aditi;
	}
	
	
	
	public function store_attachmentsX($ref_id,$table,$attach)
	{
		$str_query = "INSERT INTO `".$table."` VALUES(NULL,?,?,?)";
		foreach($attach as $v)
		{
			$query = $this->conn->prepare($str_query);
			$query->bind_param("iss",$ref_id,$v['title'],$v['file_name']);
			$query->execute();
			if($query->insert_id!=0)
			{
				exit;
				return false;
			}
		}
		return true;
	}
	public function store_attachments($csign_id,$table,$file_name,$title,$real_name)	{
		
		
		for($i=0;$i<sizeof($file_name);$i++)
		{
			if($real_name[$i]!="")
			{
			
		$query = $this->conn->prepare("INSERT INTO 		                        `".$table."` VALUES(NULL,?,?,?,?)");        
		$query->bind_param("isss",$csign_id,$title[$i],$file_name[$i],$real_name[$i]);
		$query->execute();
			}
			
		}
		
	}
	public function store_attachments_after_other($csign_id,$table,$file_name,$title,$real_name,$text_on_others)
	{
		for($i=0;$i<sizeof($file_name);$i++)
		{
			//if($real_name[$i]!="")
			if($title[$i]!="" && $real_name[$i]!="")
			{
				if($title[$i]!=10)
				{
			$query = $this->conn->prepare("INSERT INTO `".$table."` VALUES(NULL,?,?,?,?,?)");        
		$query->bind_param("issss",$csign_id,$title[$i],$text_on_others[$i],$file_name[$i],$real_name[$i]);
		$query->execute();
				}
				else
				{
					if($text_on_others[$i]!="")
					{
						$query = $this->conn->prepare("INSERT INTO `".$table."` VALUES(NULL,?,?,?,?,?)");        
		$query->bind_param("issss",$csign_id,$title[$i],$text_on_others[$i],$file_name[$i],$real_name[$i]);
		$query->execute();
						
					}
					
				}
			}
			
		}
	}
	public function store_items_attachments($data,$created_by,$created_table)
	{
		$updated_by=NULL;
		$updated_table=NULL;
		
		for($i=0;$i<sizeof($data['titles']);$i++)
		{
			
			if($data['titles'][$i]!="")
			{
			
		$query = $this->conn->prepare("INSERT INTO `item_manager` VALUES(NULL,?,?,?,?,?,?)");        
		$query->bind_param("ssssss",$data['titles'][$i],$data['discription'][$i],$created_by,$created_table,$updated_by,$updated_table);
		$query->execute();
			}
			
		}
		
		
	}
	public function Update_Item_New($data,$updated_by,$update_table,$id)
	{
		$query = $this->conn->query("UPDATE `item_manager` SET `item_name`='".$data['titles'][0]."',`item_discription`='".$data['discription'][0]."',`updated_by`='".$updated_by."',`updated_table`='".$update_table."' WHERE `id` LIKE ".$id);
		return $query;
		
	}

	public function getExtension($str)
	 {
		$i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
	}
	public function nameGen()
 	{
	return md5(time() * rand());	 
	}
	public function DelRecord($id,$table,$subtable1,$subcolmn1,$subtable2,$subcolmn2)
	{
		
		$first_query=$this->conn->query("SELECT `id` FROM `".$subtable1."` WHERE `".$subcolmn1."` LIKE ".$id);
		$second_query=$this->conn->query("SELECT `id` FROM `".$subtable2."` WHERE `".$subcolmn2."` LIKE ".$id);
		if(($first_query->num_rows!=0) || ($second_query->num_rows!=0) )
		{
			return 0;
		}
		else
		{
			$query_main = $this->conn->query("DELETE FROM `".$table."` WHERE `id` LIKE '".$id."'");
			return 1;
		}
		
	}
	public function Duplicate_Username_Officer($validateValue)
	{
		$query = $this->conn->prepare("SELECT `officer_user_name` FROM `officer` WHERE `officer_user_name` LIKE ?");
		$query->bind_param("s",$validateValue);
		$query->bind_result($ress);
		$query->execute();
		$query->store_result();
		
		
	if($query->num_rows==0)
		{
			return true;
		}else
		{
			return false;
		}
		
		
		
	}
	public function Duplicate_Username2_Officer($validateValue,$validateId)
	{
		$query = $this->conn->prepare("SELECT `officer_user_name` FROM `officer` WHERE `officer_user_name` LIKE ? AND `id` NOT LIKE ? ");
		$query->bind_param("si",$validateValue,$validateId);
		$query->bind_result($ress);
		$query->execute();
		$query->store_result();
		
		
		if($query->num_rows==0)
		{
			return true;
		}
		else
		{
			return false;
		}
		
		
	}
	
	public function Duplicate_Pin_Common($validateValue,$table,$colm)
	{
		$queryAdminPin = $this->conn->query("SELECT `pin` FROM `admin` WHERE `pin` LIKE '".$validateValue."'  ");
		$querResult = $queryAdminPin->fetch_assoc();
if($querResult==0)
{
		$query = $this->conn->prepare("SELECT `".$colm."` FROM `".$table."` WHERE `".$colm."` LIKE ?");
		$query->bind_param("s",$validateValue);
		$query->bind_result($ress);
		$query->execute();
		$query->store_result();
		if($table=="officer")
		{
			$nxtTable = "employee";
			$nxtColm = "employee_pin";
		}
		else
		{
			$nxtTable = "officer";
			$nxtColm = "officer_pin";
		}
		
	if($query->num_rows==0)
		{
			
		//----------------FOR MAKIN PIN UNIQUE IN ALL TABLES-------//
			
				$queryQ = $this->conn->prepare("SELECT `".$nxtColm."` FROM `".$nxtTable."` WHERE `".$nxtColm."` LIKE ?");
		$queryQ->bind_param("s",$validateValue);
		$queryQ->bind_result($ress);
		$queryQ->execute();
		$queryQ->store_result();
			if($queryQ->num_rows==0)
			{
				return true;
			}else
			{
				return false;

			}
			//----------------END---------------//
		
		}
		else
		{
			return false;
		}
		
}
else
{
	return false;
}
		
}
	public function Duplicate_Pin2_Common($validateValue,$table,$colm,$validateId)
	{
		$queryAdminPin = $this->conn->query("SELECT `pin` FROM `admin` WHERE `pin` LIKE '".$validateValue."'");
		$querResult = $queryAdminPin->fetch_assoc();
if($querResult==0)
{
		$query = $this->conn->prepare("SELECT `".$colm."` FROM `".$table."` WHERE `".$colm."` LIKE ? AND `id` NOT LIKE ? ");
		$query->bind_param("si",$validateValue,$validateId);
		$query->bind_result($ress);
		$query->execute();
		$query->store_result();
		if($table=="officer")
		{
			$nxtTable = "employee";
			$nxtColm = "employee_pin";
		}
		else
		{
			$nxtTable = "officer";
			$nxtColm = "officer_pin";
		}
		
		if($query->num_rows==0)
		{
			
			$queryQSSZ = $this->conn->prepare("SELECT `".$nxtColm."` FROM `".$nxtTable."` WHERE `".$nxtColm."` LIKE ?");
		$queryQSSZ->bind_param("s",$validateValue);
		$queryQSSZ->bind_result($ress);
		$queryQSSZ->execute();
		$queryQSSZ->store_result();
			if($queryQSSZ->num_rows==0)
			{
				return true;
			}else
			{
				return false;

			}
			
		}
		else
		{
			return false;
		}
}
else
{
	return false;
}
		
		
	}
	public function Duplicate_User_Common($validateValue)
	{
		$queryAdminUser = $this->conn->query("SELECT `admin_user_name` FROM `admin` WHERE `admin_user_name` LIKE '".$validateValue."'");
		$querResult = $queryAdminUser->fetch_assoc();
if($querResult==0)
{
		$query = $this->conn->prepare("SELECT `officer_user_name` FROM `officer` WHERE `officer_user_name` LIKE ?");
		$query->bind_param("s",$validateValue);
		$query->bind_result($ress);
		$query->execute();
		$query->store_result();
		if($query->num_rows==0)
		{
			$queryQ = $this->conn->prepare("SELECT `employee_user_name` FROM `employee` WHERE `employee_user_name` LIKE ?");
			$queryQ->bind_param("s",$validateValue);
			$queryQ->bind_result($ress);
			$queryQ->execute();
			$queryQ->store_result();
			if($queryQ->num_rows==0)
			{
				return true;
			}else
			{
				return false;

			}
		}
		else
		{
			return false;
		}
		
}
else
{
	return false;
}
		
}
public function Duplicate_User2_Common($validateValue,$table,$colm,$validateId)
	{
$queryAdminUser = $this->conn->query("SELECT `admin_user_name` FROM `admin` WHERE `admin_user_name` LIKE '".$validateValue."'");
		$querResult = $queryAdminUser->fetch_assoc();
if($querResult==0)
{
		$query = $this->conn->prepare("SELECT `".$colm."` FROM `".$table."` WHERE `".$colm."` LIKE ? AND `id` NOT LIKE ? ");
		$query->bind_param("si",$validateValue,$validateId);
		$query->bind_result($ress);
		$query->execute();
		$query->store_result();
		if($table=="officer")
		{
			$nxtTable = "employee";
			$nxtColm = "employee_user_name";
		}
		else
		{
			$nxtTable = "officer";
			$nxtColm = "officer_user_name";
		}
		
		if($query->num_rows==0)
		{
			
			$queryQSS = $this->conn->prepare("SELECT `".$nxtColm."` FROM `".$nxtTable."` WHERE `".$nxtColm."` LIKE ?");
		$queryQSS->bind_param("s",$validateValue);
		$queryQSS->bind_result($ress);
		$queryQSS->execute();
		$queryQSS->store_result();
			if($queryQSS->num_rows==0)
			{
				return true;
			}else
			{
				return false;

			}
			
		}
		else
		{
			return false;
		}
}
else
{
	return false;
}
		
	}

	public function common_fetch_attachement($table,$colm,$id)
	{
		
		$query = $this->conn->query("SELECT * FROM `".$table."` WHERE `".$colm."` LIKE '".$id."' LIMIT 5 ");
		$data = array();
		while($raw = $query->fetch_assoc())
		{
			$data[]=$raw;
		}
		return $data;
		
	}
	public function common_fetch_attachement_limited_firm($table,$colm,$id)
	{
		$query = $this->conn->query("SELECT tender_limited_firm.*,consignee.csign_short_name FROM `tender_limited_firm`,`consignee` WHERE consignee.id LIKE tender_limited_firm.firm_id AND tender_limited_firm.tender_id LIKE '".$id."' LIMIT 5 ");
		$data = array();
		while($raw = $query->fetch_assoc())
		{
			$data[]=$raw;
		}
		return $data;
		
	}
	public function common_fetch_attachement_withItem($table,$colm,$id)
	{
		$data=array();
		$query=$this->conn->query("SELECT item_manager.item_name, item_manager.item_discription, main_consignee.main_csign_short_name,tender_firm_product.* FROM `item_manager`,`tender_firm_product`,`main_consignee` WHERE tender_firm_product.category LIKE item_manager.id AND tender_firm_product.consignee LIKE main_consignee.id AND tender_firm_product.tender_id LIKE '".$id."' LIMIT 5 ");
		while($raw = $query->fetch_assoc())
		{
			$data[]=$raw;
		}
		return $data;
	}
	public function common_fetch_attachement_withItem_nolimit($table,$colm,$id)
	{
		$data=array();
		$query=$this->conn->query("SELECT item_manager.item_name, item_manager.item_discription,item_manager.id as `item_id`, main_consignee.main_csign_short_name,tender_firm_product.* FROM `item_manager`,`tender_firm_product`,`main_consignee` WHERE tender_firm_product.category LIKE item_manager.id AND tender_firm_product.consignee LIKE main_consignee.id AND tender_firm_product.tender_id LIKE ".$id);
		while($raw = $query->fetch_assoc())
		{
			$data[]=$raw;
		}
		return $data;
		
		
	}
	public function common_fetch_limited_firm_withItem_nolimit($table,$colm,$id)
	{
		$data=array();
		$query=$this->conn->query("SELECT tender_limited_firm.*,consignee.csign_short_name FROM `tender_limited_firm`,`consignee` WHERE consignee.id LIKE tender_limited_firm.firm_id AND tender_limited_firm.tender_id LIKE '".$id."'");
		while($raw = $query->fetch_assoc())
		{
			$data[]=$raw;
		}
		return $data;
		
		
	}
	
	public function RecordInFront($id)
	{
	$query = $this->conn->query("SELECT * FROM `consignee_director` WHERE `id` LIKE ".$id);	
	$result = $query->fetch_assoc();
	return $result;
		
	}
	public function List_Drop_Down($table,$colm,$id)
	{
		$data = array();
		$query_office = $this->conn->query("SELECT `".$colm."`,`".$id."`FROM `".$table."`");
		while($rock = $query_office->fetch_assoc())
		{
			$data[] = $rock;
		}
		return $data;
	}
	public function List_Drop_down_onSelection_noAjax($table,$colm,$matchingColm,$matchinId)
	{
		$data = array();
		$query_main_cnsignee = $this->conn->query("SELECT `".$colm."`,`id` FROM `".$table."` WHERE `".$matchingColm."` LIKE ".$matchinId);
		while($rock = $query_main_cnsignee->fetch_assoc())
		{
			$data[] = $rock;
		}
		return $data;
	}
	public function List_Drop_down_onSelection($table,$colm,$matchingColm,$matchinId)
	{
		//$data = array();
		$str .="<option value=''>Please Select</option>";
		$query_office = $this->conn->query("SELECT `".$colm."`,`id` FROM `".$table."` WHERE `".$matchingColm."` LIKE ".$matchinId );
		while($rock = $query_office->fetch_assoc())
		{
			$str .="<option value=".$rock['id'].">".$rock['main_csign_short_name']."</option>";
		}
		return $str;
		
		
	}
	
	public function List_Drop_Down_tender($office,$purchaser,$status,$pg)
	{
		$data = array();
		if($pg!=0)
		{
		$pg = ($pg-1)*10;
		//$pg = ($pg-1)*2;
		}
		else
		{
		$pg = 0;
		}
		$cdate=date("Y-m-d");
		
	if($status==150 || $status==151 || $status==152)
	{
		if($status==150)
		{
		$status_new = 'tender.status LIKE 0';
		}
		if($status==151)
		{
		$status_new = "tender.status LIKE 1";
		}
		if($status==152)
		{
		$status_new = "(tender.status LIKE 2 OR tender.status LIKE 3)";
		}
		$query_tender = $this->conn->query("SELECT  create_purchaser.purchaser_short_name,tender.* FROM `create_purchaser`,`tender` WHERE create_purchaser.id LIKE tender.tender_purchaser AND tender.tender_office LIKE '".$office."' AND tender.tender_purchaser LIKE '".$purchaser."' AND tender.tender_due_date < '".$cdate."' AND ".$status_new." LIMIT ".$pg.",10");
		}
	else
	{
	$query_tender = $this->conn->query("SELECT  create_purchaser.purchaser_short_name,tender.* FROM `create_purchaser`,`tender` WHERE create_purchaser.id LIKE tender.tender_purchaser AND tender.status LIKE '".$status."'  AND tender.tender_office LIKE '".$office."' AND tender.tender_purchaser LIKE '".$purchaser."' AND tender.tender_due_date >= '".$cdate."' LIMIT ".$pg.",10");
	}

		
		while($rock = $query_tender->fetch_assoc())
		{
			
			$data[] = $rock;
			
		}
		return $data;
	
	
	}
	public function TotalPage($office,$purchaser,$status)
	{
		
		
		$cdate=date("Y-m-d");
		if($status==150 || $status==151 || $status==152)
		{
			if($status==150)
			{
			$status_new = "tender.status LIKE 0";
			}
			if($status==151)
			{
			$status_new = "tender.status LIKE 1";
			}
			if($status==152)
			{
			$status_new = "tender.status LIKE 2 OR tender.status LIKE 3";
			}
			$query_tender = $this->conn->query("SELECT  create_purchaser.purchaser_short_name,tender.* FROM `create_purchaser`,`tender` WHERE create_purchaser.id LIKE tender.tender_purchaser AND tender.tender_office LIKE '".$office."' AND tender.tender_purchaser LIKE '".$purchaser."'  AND tender.tender_due_date < '".$cdate."' AND ".$status_new." ");
		}
		else
		{
		$query_tender = $this->conn->query("SELECT  create_purchaser.purchaser_short_name,tender.* FROM `create_purchaser`,`tender` WHERE create_purchaser.id LIKE tender.tender_purchaser AND tender.tender_office LIKE '".$office."' AND tender.tender_purchaser LIKE '".$purchaser."'  AND tender.tender_due_date >= '".$cdate."' AND tender.status LIKE ".$status);
		}
		while($rock = $query_tender->fetch_assoc())
		{
			$data[] = $rock;
			$count++;
		}
		$per_page=10;
		$total_page=ceil($count/$per_page);
		return $total_page;
		
	}
	
	public function Common_name_id($table,$colm,$id)
	{
		
		$query_name_id = $this->conn->query("SELECT `".$colm."`,`id` FROM `".$table."` WHERE `id` LIKE ".$id);
		return $query_name_id->fetch_assoc();
		
	}
	public function CheckShortNameOnPurchase($sn,$pi,$edit_id)
	{
		if($edit_id=='')
		{
		$query_short_name = $this->conn->query("SELECT `main_csign_short_name` FROM `main_consignee` WHERE `main_csign_short_name` LIKE '".$sn."' AND `main_csign_purchaser` LIKE '".$pi."'");
		}
		else
		{
			$query_short_name = $this->conn->query("SELECT `main_csign_short_name` FROM `main_consignee` WHERE `main_csign_short_name` LIKE '".$sn."' AND `main_csign_purchaser` LIKE '".$pi."' AND `id` NOT LIKE ".$edit_id);
			
		}
		$check = $query_short_name->fetch_assoc();
		//if(is_array($check))
		if($check!="")
		{
			return 0;
		}
		else
		{
			return 1;
		}
		
	}
	public function getAllItemsForSearch()
	{
	$data = array();
		$query_office = $this->conn->query("SELECT `id`,`item_name`,`item_discription` FROM `item_manager`");
		while($rock = $query_office->fetch_assoc())
		{
			$data[] = $rock;
		}
		
return $this->formateDataForAC($data);	
	}
	public function getAllTenderForSearch($pID)
	{
	$data = array();
	$query_tender = $this->conn->query("SELECT `tender_number` FROM `tender` WHERE `tender_purchaser` LIKE ".$pID);
		while($rock = $query_tender->fetch_assoc())
		{
			$data[] = $rock;
		}
		//return $data;
		return $this->formateDataForNumber($data);	
	}
	public function getAllTenderForSearch_In_Po()
	{
		$data = array();
	//$query_tender = $this->conn->query("SELECT `tender_number` FROM `tender` WHERE `tender_purchaser` LIKE ".$pID);
	$cdate=date("Y-m-d");
	$query_tender = $this->conn->query("SELECT `tender_number`,`id` FROM `tender` WHERE `status` LIKE 2 OR `status` LIKE 3 AND `tender_due_date` < '".$cdate."'");
		while($rock = $query_tender->fetch_assoc())
		{
			$data[] = $rock;
		}
		//return $this->formateDataForNumber($data);	
		return $this->formatDataForPoStataement($data);
	}
	private function formateDataForAC($dd)
	{
		foreach($dd as $v)
		{
$ss = $v['item_name'].":-".$v['item_discription'].":(".$v['id'].")";
			$data[$ss] = $v['id'];
		}
		return $data;
	}
	private function formateDataForNumber($ds)
	{
		foreach($ds as $k)
		{
			$data[] = $k['tender_number'];
			
			
		}
		return $data;
	}
	private function formatDataForPoStataement($dd)
	{
			foreach($dd as $v)
		{
$ss = $v['tender_number'].":[".$v['id']."]";
			//$data[$ss] = $v['id'];
			$data[]=$v['tender_number'].":(".$v['id'].")";
		}
		return $data;
		
	}
	public function MsgPopUp($PinNumber,$Table)
	{
		if($Table==0)
		{
			$ckT='admin';
		}
		else if($Table==1)
		{
			$ckT='officer';
		}
		else
		{
			$ckT='employee';
		}
		$query_record = $this->conn->query("SELECT * FROM `".$ckT."` WHERE `id` LIKE ".$PinNumber);
		$result_query = array();
		$result_query[0]=$query_record->fetch_assoc();
		$result_query[1]=$ckT;
		return $result_query;
		/*$query_msg_admin = $this->conn->query("SELECT `id`,`admin_first_name`,`pin` FROM `admin` WHERE `pin` LIKE '".$PinNumber."'");
		$query_msg_officer = $this->conn->query("SELECT `id`,`officer_first_name`,`officer_pin`,`officer_office` FROM `officer` WHERE `officer_pin` LIKE '".$PinNumber."'");
		$query_msg_employee = $this->conn->query("SELECT `id`,`employee_first_name`,`employee_pin`,`employee_office` FROM `employee` WHERE `employee_pin` LIKE '".$PinNumber."'");
		$result_msg_admin = array();
		$result_msg_officer = array();
		$result_msg_employee = array();
		$result_msg_admin[0]='admin';
		$result_msg_officer[0]='officer';
		$result_msg_employee[0]='employee';
		$result_msg_admin[1] = $query_msg_admin->fetch_array();
		$result_msg_officer[1] = $query_msg_officer->fetch_array();
		$result_msg_employee[1] = $query_msg_employee->fetch_array();
		if($result_msg_admin[1]!="")
		{
			return $result_msg_admin;
			
		}
		else if($result_msg_officer[1]!="")
		{
			return $result_msg_officer;
		}
		else
		{
			return $result_msg_employee;
		}
		*/
	
		
	}
	public function curPageURL() {
 	$pageURL = 'http';
 	if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 	$pageURL .= "://";
 	if ($_SERVER["SERVER_PORT"] != "80") {
  	$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER[	"SERVER_PORT"].$_SERVER["REQUEST_URI"];
 	} 
	else 
	{
  	$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 	}
 	return $pageURL;
	}
	public function curPageName() {
 return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
}
	public function TotalDays($myDate,$st)
	{
		
		$now = time(); // or your date as well
     $your_date = strtotime($myDate);
     $datediff = $your_date-$now;
     $check_date= floor($datediff/(60*60*24)+1);
	 
	 
	/* if($check_date<0 && $check_date>-6)
	 {
		 return "Tender Lapsed";
	 }*/
	 //else if($check_date<=-6)
	 //if($check_date<=-6)
	 if($check_date<0)
	 {
		 //if($st==4)
		 //{
			 return "Tender Lapsed";
			 //return "Tender Lapsed Old";
			 
		// }
		 //else
		 //{
		 //return false;
		 //}
	 }
	 else if($check_date==0)
	 {
		 return "Today";
	 }
	 else
	 {
		 return $check_date;
	 }

	}
	/*************************************************************************
php easy :: pagination scripts set - Version Three
==========================================================================
Author:      php easy code, www.phpeasycode.com
Web Site:    http://www.phpeasycode.com
Contact:     webmaster@phpeasycode.com
*************************************************************************/
public function paginate_three($reload, $page, $tpages, $adjacents,$ot,$pt,$st) {
	
	$prevlabel = "&lsaquo; Prev";
	$nextlabel = "Next &rsaquo;";
	
	$out = "<div class=\"pagin\">\n";
	
	// previous
	if($page==1) {
		$out.= "<span>" . $prevlabel . "</span>\n";
	}
	elseif($page==2) {
		//$out.= "<a href=\"" . $reload . "\">" . $prevlabel . "</a>\n";
		$out.= "<a href=\"" . $reload . "&amp;ot=".$ot."&amp;pt=".$pt."&amp;st=".$st."&amp;page=" . ($page-1) .  "\">" . $prevlabel . "</a>\n";
	}
	else {
		
		$out.= "<a href=\"" . $reload . "&amp;ot=".$ot."&amp;pt=".$pt."&amp;st=".$st."&amp;page=" . ($page-1) . "\">" . $prevlabel . "</a>\n";
	}
	
	// first
	if($page>($adjacents+1)) {
		$out.= "<a href=\"" . $reload . "\">1</a>\n";
	}
	
	// interval
	if($page>($adjacents+2)) {
		$out.= "...\n";
	}
	
	// pages
	$pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
	$pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
	for($i=$pmin; $i<=$pmax; $i++) {
		if($i==$page) {
			$out.= "<span class=\"current\">" . $i . "</span>\n";
		}
		elseif($i==1) {
			//$out.= "<a href=\"" . $reload . "\">" . $i . "</a>\n";
			$out.= "<a href=\"" . $reload . "&amp;ot=".$ot."&amp;pt=".$pt."&amp;st=".$st."&amp;page=" . $i . "\">" . $i . "</a>\n";
		}
		else {
			//$out.= "<a href=\"" . $reload . "&amp;hv=".$hv."&amp;page=" . $i . "\">" . $i . "</a>\n";
			//------MEENU------
		$out.= "<a href=\"" . $reload . "&amp;ot=".$ot."&amp;pt=".$pt."&amp;st=".$st."&amp;page=" . $i . "\">" . $i . "</a>\n";
			
			
			//---------
		}
	}
	
	// interval
	if($page<($tpages-$adjacents-1)) {
		$out.= "...\n";
	}
	
	// last
	if($page<($tpages-$adjacents)) {
		$out.= "<a href=\"" . $reload . "&amp;ot=".$ot."&amp;pt=".$pt."&amp;st=".$st."&amp;page=" . $tpages . "\">" . $tpages . "</a>\n";
	}
	
	// next
	if($page<$tpages) {
		$out.= "<a href=\"" . $reload . "&amp;ot=".$ot."&amp;pt=".$pt."&amp;st=".$st."&amp;page=" . ($page+1) . "\">" . $nextlabel . "</a>\n";
	}
	else {
		$out.= "<span>" . $nextlabel . "</span>\n";
	}
	
	$out.= "</div>";
	
	return $out;
}
public function StoreFirmsWithProducts($firm,$consignee,$inspection,$quantity,$unit,$tdc,$emd,$rate,$taxtype,$taxper,$taxamount,$disper,$disamount,$othercharg,$validday,$payment,$delperod,$delschedule,$remark,$spinate,$PRODUCTID)
{
	$query_store_product = $this->conn->prepare("INSERT INTO `tender_firms` VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
	$id=NULL;
	$query_store_product->bind_param("iiiissssssssssssssssss",$id,$PRODUCTID,$firm,$consignee,$inspection,$quantity,$unit,$tdc,$emd,$rate,$taxtype,$taxper,$taxamount,$disper,$disamount,$othercharg,$validday,$payment,$delperod,$delschedule,$remark,$spinate);
	$query_store_product->execute();
	$query_store_product->free_result();
	
}
public function ProductExist($tenderID)
{
	$query=$this->conn->query("SELECT `id` FROM `tender_firm_product` WHERE `tender_id` LIKE '".$tenderID."' LIMIT 1 ");
	return $query->fetch_row();
}
public function FirmExist($productId)
{
	for($i=0;$i<sizeof($productId);$i++)
	{
	$query=$this->conn->query("SELECT `id` FROM `tender_firms` WHERE `product_id` LIKE '".$productId[$i]['id']."' LIMIT 1 ");
	if($query->fetch_assoc()!="")
	{
		return 1;
		break;
	}
	}
	
}
public function UpdateTenderFirm($datall)
{
	$query=$this->conn->query("UPDATE `tender_firms` SET `firm`='".$datall['firm']."',`quantity`='".$datall['quantity']."',`unit`='".$datall['unit']."',`rate`='".$datall['rate']."',`taxtype`='".$datall['taxtype']."',`taper`='".$datall['taxper']."',`taxamount`='".$datall['taxamount']."',`disper` = '".$datall['disper']."',`disamount`='".$datall['disamount']."',`othercharg` = '".$datall['othercharg']."',`validday`='".$datall['validday']."',`payment`='".$datall['payment']."',`delperod`='".$datall['delperod']."',`delschedule`='".$datall['delschedule']."',`remark`='".$datall['remark']."',`spinate`='".$datall['spinate']."' WHERE `id` LIKE ".$datall['idhide']);
	
}
public function CommonCheck($table,$matchin_colm,$id)
{
	$query_product = $this->conn->query("SELECT `id` FROM `".$table."` WHERE `".$matchin_colm."` LIKE ".$id);
	$data = array();
	while($raw = $query_product->fetch_assoc())
	{
		$data[]=$raw;
	}
	return $data;
	
}
public function display_discription($id)
{
	$discription = $this->conn->query("SELECT `discription` FROM `tender_firm_product` WHERE `tender_id` LIKE ".$id);
	$m=1;
	//$data2=array();
	
	while($raw=$discription->fetch_assoc())
	{
		
		$data3 .=' ['.$m.'] '.$raw['discription'];
		$m++;
	}
	return $data3;
}
  public function Date_Format($given_date)
  {
	  $newDate=explode('-',$given_date);
	  return $newDate[2]."-".$newDate[1]."-".$newDate[0];
	  
  }
  public function unit($unit_given)
  {
	  if($unit_given==1)
	  $send_unit='NOS';
	  if($unit_given==2)
	  $send_unit='Kg';
	  if($unit_given==3)
	  $send_unit='Mtr';
	  if($unit_given==4)
	  $send_unit='Pcs';
	  if($unit_given==5)
	  $send_unit='Pair';
	  if($unit_given==6)
	  $send_unit='Yard';
	  return $send_unit;
	}
	 public function inspection($inspection_given)
  {
	  if($inspection_given==1)
	  $send_inspection='RITES';
	  if($inspection_given==2)
	  $send_inspection='DQA';
	  if($inspection_given==3)
	  $send_inspection='RITES/DQA';
	  if($inspection_given==4)
	  $send_inspection='CONSIGNEE';
	   if($inspection_given==5)
	  $send_inspection='RDSO';
	  if($inspection_given==6)
	  $send_inspection='RITES/Visual';
	  if($inspection_given==7)
	  $send_inspection='RITES/MTC & GC';
	  if($inspection_given==8)
	  $send_inspection='DQA/Visual';
	  if($inspection_given==9)
	  $send_inspection='DQA/MTC & GC';
	   if($inspection_given==10)
	  $send_inspection='OTHERS';
	  return $send_inspection;
	}
	public function Schedule_Peride($firm_id)
	{
		$reult_schedule=$this->conn->query("SELECT `csign_delv_peride`, `csign_delv_schedule`,`csign_remark` FROM `consignee` WHERE `id` LIKE ".$firm_id);
		return $reult_schedule->fetch_row();
		
	}
	public function store_firms_under_tender($data,$pid,$created_by,$created_table)
	{
		$bid_number=NULL;
		$bid_rate=NULL;
		$bid_created_by=NULL;
		$bid_created_by_table=NULL;
		$flag=0;
		
		for($i=0;$i<sizeof($data['firm']);$i++)
		{
			if($data['firm']!='')
			{
			
		$query = $this->conn->prepare("INSERT INTO `tender_firms` VALUES(NULL,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		$query->bind_param("iissisisssssssssssssssssssi",$pid,$data['firm'][$i],$data['inspection'][$i],$data['rate'][$i],$data['taxtype'][$i],$data['taxper'][$i],$data['oct'][$i],$data['othercharg'][$i],$data['disper'][$i],$data['finalrate'][$i],$data['payment'][$i],$data['delperod'][$i],$data['delschedule'][$i],$data['validday'][$i],$data['remark'][$i],$data['tdc'][$i],$data['emd'][$i],$data['spinate'][$i],$bid_number,$bid_rate,$bid_created_by,$bid_created_by_table,$created_by,$created_table,$updated_by,$updated_table,$flag);
		$query->execute();
			}
		}
		return 1;
		
	}
	public function update_firms_under_tender($data,$pid,$updated_by,$updated_table,$update_id)
	{
		
	$query=$this->conn->query("UPDATE `tender_firms` SET `firm`='".$data['firm'][0]."',`inspection`='".$data['inspection'][0]."', `rate`='".$data['rate'][0]."', `taxtype`='".$data['taxtype'][0]."', `taxper`='".$data['taxper'][0]."', `oct`='".$data['oct'][0]."', `othercharg`='".$data['othercharg'][0]."', `disper`='".$data['disper'][0]."', `finalrate`='".$data['finalrate'][0]."', `delperod`='".$data['delperod'][0]."',`delschedule`='".$data['delschedule'][0]."',`validday`='".$data['validday'][0]."',`remark`='".$data['remark'][0]."',`tdc`='".$data['tdc'][0]."',`emd`='".$data['emd'][0]."',`spinate`='".$data['spinate'][0]."',`updated_by`='".$updated_by."',`updated_table`='".$updated_table."' WHERE `id` LIKE ".$update_id);
	
	return 1;	
		
		
	}
	public function firms_in_products($product_id)
	{
		$data=array();
		//$query=$this->conn->query("SELECT tender_firms.id,tender_firms.rate,consignee.csign_short_name FROM `tender_firms`,`consignee` WHERE consignee.id LIKE tender_firms.firm AND tender_firms.product_id LIKE ".$product_id);

		$query=$this->conn->query("SELECT tender_firms.id,tender_firms.rate,tender_firms.bid_number,tender_firms.flag,consignee.csign_short_name FROM `tender_firms`,`consignee` WHERE consignee.id LIKE tender_firms.firm AND tender_firms.product_id LIKE ".$product_id);

		
		while($raw = $query->fetch_assoc())
		{
			$data[]=$raw;
		}
		return $data;
		
	}
	public function All_Firm_Product_Data($fpid)
	{
		$query = $this->conn->query('SELECT tender_firms.*,consignee.csign_short_name FROM `tender_firms`,`consignee` WHERE tender_firms.firm LIKE consignee.id AND tender_firms.id LIKE '.$fpid);
		return $query->fetch_assoc();
	}
	public function UpdateProductFirm($category,$inspection,$discription,$consignee,$quantity,$unit,$pid)
	{
		$rest = $category;
		$kk=explode("(",$rest);
		$final=explode(")",$kk[1]);
		$query = $this->conn->query("UPDATE `tender_firm_product` SET `category` = '".$final[0]."',`inspection`='".$inspection."' , `discription`='".$discription."',`consignee`='".$consignee."' , `quantity` = '".$quantity."',`unit`='".$unit."' WHERE `id` LIKE '".$pid."'");
	}
	public function ProductFirmAfterUpdate($id)
	{
		$query=$this->conn->query("SELECT item_manager.item_name, item_manager.item_discription,item_manager.id as `item_id`, main_consignee.main_csign_short_name,tender_firm_product.* FROM `item_manager`,`tender_firm_product`,`main_consignee` WHERE tender_firm_product.category LIKE item_manager.id AND tender_firm_product.consignee LIKE main_consignee.id AND tender_firm_product.id LIKE ".$id);
		return $query->fetch_assoc();
		
	}
public function OldTenderSearch($pid,$tno,$table)
{
	if($table=='tender')
	{
	$query=$this->conn->query("SELECT tender.id,tender.tender_sample,tender. 	tender_tdc,tender.tender_emd,tender.tender_criteria FROM `tender` WHERE tender.tender_number LIKE '".$tno."' AND tender.tender_purchaser LIKE '".$pid."'");
	}
	if($table=='history_tender')
	{
	$query=$this->conn->query("SELECT history_tender.id,history_tender.tender_sample FROM `history_tender` WHERE history_tender.tender_number LIKE '".$tno."' AND history_tender.tender_purchaser LIKE '".$pid."'");
	}
	
	return $query->fetch_assoc();
	//return $this->formateTenderForJson($data);	
	
}
	private function formateTenderForJson($dd)
	{
		foreach($dd as $k=>$v)
		{
 //$ss = $v['item_name'].":-".$v['item_discription'].":(".$v['id'].")";
			$data[] = $k;
		}
		return $data;
	}

public function OldTenderProducts($tender_id,$table)
{
	//$query=$this->conn->query("SELECT tender_firm_product.*,item_manager.id AS `item_id`,item_manager.item_name,item_manager.item_discription FROM `tender_firm_product`,`item_manager` WHERE tender_firm_product.category LIKE item_manager.id AND tender_firm_product.tender_id LIKE ".$tender_id);
	$query=$this->conn->query("SELECT $table.*,item_manager.id AS `item_id`,item_manager.item_name,item_manager.item_discription FROM `".$table."`,`item_manager` WHERE $table.category LIKE item_manager.id AND $table.tender_id LIKE ".$tender_id);
		while($raw = $query->fetch_assoc())
		{
			$data[]=$raw;
		}
		return $data;
}
public function OldTenderAttachements($tender_id,$table)
{
	//$query=$this->conn->query("SELECT * FROM `tender_attachments` WHERE `tender_id` LIKE ".$tender_id);
	$query=$this->conn->query("SELECT * FROM `".$table."` WHERE `tender_id` LIKE ".$tender_id);
		while($raw = $query->fetch_assoc())
		{
			$data[]=$raw;
		}
		return $data;
}
public function OldTenderLimitedFirm($tender_id)
{
	$query=$this->conn->query("SELECT tender_limited_firm.*,consignee.csign_short_name FROM `tender_limited_firm`,`consignee` WHERE tender_limited_firm.firm_id LIKE consignee.id AND tender_limited_firm.tender_id LIKE ".$tender_id);
		while($raw = $query->fetch_assoc())
		{
			$data[]=$raw;
		}
		return $data;
	
}

public function UpdateLimitedFirm($firm,$id)
{
	$query = $this->conn->query("UPDATE `tender_limited_firm` SET `firm_id`='".$firm."' WHERE `id` LIKE '".$id."'");
	
}
public function LimitedFirmAfterUpdate($id)
{
	$query = $this->conn->query("SELECT tender_limited_firm.*,consignee.csign_short_name FROM `tender_limited_firm`,`consignee` WHERE consignee.id LIKE tender_limited_firm.firm_id AND tender_limited_firm.id LIKE '".$id."'");
	return $query->fetch_assoc();
}
public function CheckAvailabeTenderNumber($tender_number,$purchaser_id_tn,$edit_time_id)
{
	if($edit_time_id=='')
	{
		$query = $this->conn->query("SELECT * FROM `tender` WHERE `tender_number` LIKE '".$tender_number."' AND `tender_purchaser` LIKE '".$purchaser_id_tn."' LIMIT 1");
	}
	else
	{
	$query = $this->conn->query("SELECT * FROM `tender` WHERE `tender_number` LIKE '".$tender_number."' AND `tender_purchaser` LIKE '".$purchaser_id_tn."' AND `id` NOT LIKE '".$edit_time_id."' LIMIT 1");
	}
	$result=$query->fetch_assoc();
	
	if($result!='')
	{
		return 0;
	}
	else
	{
		return 1;
	}
}
public function Limited_Tender_Firms($tender_id)
{
	$data = array();
	$query = $this->conn->query("SELECT tender_limited_firm.*,consignee.csign_short_name,consignee.csign_delv_schedule,consignee.csign_delv_peride,consignee.csign_remark FROM `tender_limited_firm`,`consignee` WHERE tender_limited_firm.firm_id LIKE  consignee.id AND tender_limited_firm.tender_id LIKE ".$tender_id);
	while($raw = $query->fetch_assoc())
	{
		$data[]=$raw;
	}
	if($data[0]!='')
	{
	return $data;
	}
	else
	{
		return false;
	}
}
public function ChangeTenderStatus($id,$status)
{
	$query = $this->conn->query("UPDATE `tender` SET `status`='".$status."' WHERE `id` LIKE ".$id);
	if($query)
	{
		return 1;
	}
	else
	{
		return 0;
	}
}
public function ChangeTenderFirmStatusXXX($id,$status,$tender_it_self_status)
{
	if($tender_it_self_status==1)
	{
		if($status==0)
		{
	$query_XX = $this->conn->query('SELECT tender_firms.id FROM `tender_firms`,`tender_firm_product`,`tender` WHERE tender_firms.product_id LIKE tender_firm_product.id AND tender_firm_product.tender_id LIKE tender.id AND tender.id LIKE '.$id);
	}
	else
	{
		$query_XX = $this->conn->query("SELECT `id` FROM `tender_rate_attachements` WHERE `tender_id` LIKE ".$id);
		
	}
	
	if($query_XX->num_rows>0)
	{
	$query = $this->conn->query("UPDATE `tender` SET `firm_status`='".$status."',`status`=1 WHERE `id` LIKE ".$id);
	}
	else
	{
		$query = $this->conn->query("UPDATE `tender` SET `firm_status`='".$status."',`status`=0 WHERE `id` LIKE ".$id);
		
	}
	
}
else
{
	$query = $this->conn->query("UPDATE `tender` SET `firm_status`='".$status."' WHERE `id` LIKE ".$id);
	
}
if($query)
{
	return 1;
}
else
{
	return 0;
}
	
}
public function ChangeCommonStatus($id,$status,$table,$tender_firm_status)
{
	if($status==1)
	{
		if($tender_firm_status==0)
		{
	$query = $this->conn->query('SELECT tender_firms.id FROM `tender_firms`,`tender_firm_product`,`tender` WHERE tender_firms.product_id LIKE tender_firm_product.id AND tender_firm_product.tender_id LIKE tender.id AND tender.id LIKE '.$id);
			
		}
		else
		{
	$query = $this->conn->query("SELECT `id` FROM `tender_rate_attachements` WHERE `tender_id` LIKE ".$id);
			
		}
		if($query->num_rows>0)
		{
			$query_u = $this->conn->query("UPDATE `".$table."` SET `status`='".$status."' WHERE `id` LIKE ".$id);
			return 1;
			
		}
		else
		{
			return 1345;
		}
		
	}
 else
 {	
	$query_u = $this->conn->query("UPDATE `".$table."` SET `status`='".$status."' WHERE `id` LIKE ".$id);
	if($query_u)
	{
		return 1;
	}
	else
	{
		return 0;
	}
 }
	
}
public function ChangeTenderFirmStatus($id,$status,$table)
{
	$query = $this->conn->query("UPDATE `".$table."` SET `firm_status`='".$status."' WHERE `id` LIKE ".$id);
	if($query)
	{
		return 1;
	}
	else
	{
		return 0;
	}
	
}


public function taxType($tt)
{
	
	 if($tt==1)
	 $send_tt='VAT';
	 if($tt==2)
	 $send_tt='CST';
	 if($tt==3)
	 $send_tt='VAT INCL';
	 if($tt==4)
	 $send_tt='CST INCL';
	 return $send_tt;
}
public function taxType_in_Po($tt)
{
	
	 if($tt==1)
	 $send_tt='VAT Exclusive';
	 if($tt==2)
	 $send_tt='VAT Inclusive';
	 if($tt==3)
	 $send_tt='CST Exclusive';
	 if($tt==4)
	 $send_tt='CST Inclusive';
	 if($tt==5)
	 $send_tt='Nil';
	 return $send_tt;
}
 public function oct($oc)
 {
	 if($oc==1)
	 $send_oc='Percentez';
	 if($oc==2)
	 $send_oc='Amount';
	 return $send_oc;
	 
 }
 public function paymentOptn($po)
 {
	
	 if($po==1)
	 $send_po='100% after supl';
	 if($po==2)
	 $send_po='98%+2%';
	 if($po==3)
	 $send_po='95%+2%';
	 if($po==4)
	 $send_po='90%+10%';
	 return $send_po;
	 
 }
 public function paymentInPoOpt($po)
 {
	 if($po==1)
	 $send_po='100% against supply';
	 if($po==2)
	 $send_po='98% + 2%';
	 if($po==3)
	 $send_po='98% + 5%';
	 if($po==4)
	 $send_po='90% + 10%';
	 if($po==10)
	 $send_po='Other';
	 return $send_po;
	 
 }
 public function tdc_emd($te)
 {
     if($te==1)
	 $send_te='Exempted';
	 if($te==2)
	 $send_te='Paid';
	 if($te==3)
	 $send_te='Not Required';
	 return $send_te;
	 
 }
 public function SaveBidNumberInFirm($bid_number,$finalName,$name,$titles,$pin_id,$pin_table,$bid_rate,$id,$tender_id)
 {
	
	$query = $this->conn->query("UPDATE `tender_firms` SET `bid_number`='".$bid_number."',`bid_created_by`='".$pin_id."',`bid_created_by_table`='".$pin_table."',`bid_rate`='".$bid_rate."' WHERE `id` LIKE ".$id);
   $this->store_attachments($id,'tender_quoted_attachments',$finalName,$titles,$name);
   $result_for_status = $this->Tender_status_quoted_partiallyquoted($tender_id);
   $query_update_tender = $this->conn->query("UPDATE `tender` SET `status`='".$result_for_status."' WHERE `id` LIKE ".$tender_id); 
   if($query)
	 {
		 return true;
	 }
	 else
	 {
		 return false;
	 }
	 
 }
 
 public function SaveBidNumberInFirm_PRINTING_FIRM($bid_number,$finalName,$name,$titles,$pin_id,$pin_table,$bid_rate,$id,$tender_id)
 {
	
	$query = $this->conn->query("UPDATE `tender_rate_attachements` SET `bid_number`='".$bid_number."',`bid_created_by`='".$pin_id."',`bid_created_by_table`='".$pin_table."',`bid_rate`='".$bid_rate."' WHERE `id` LIKE ".$id);
	$this->store_attachments($id,'tender_quoted_attachments',$finalName,$titles,$name);
   $result_for_status = $this->Tender_status_quoted_partiallyquoted_IFPRINTINGFIRM($tender_id);
   $query_update_tender = $this->conn->query("UPDATE `tender` SET `status`='".$result_for_status."' WHERE `id` LIKE ".$tender_id); 
   if($query)
	 {
		 return true;
	 }
	 else
	 {
		 return false;
	 }
	 
 }
 public function Tender_status_quoted_partiallyquoted($tender_id)
 {
	$counter=0;
	$counter2=0;
	$query = $this->conn->query("SELECT DISTINCT tender_firms.id AS `firm_id`, tender_firms.bid_number FROM `tender_firms`,`tender_firm_product`,`tender` WHERE tender_firms.product_id LIKE tender_firm_product.id AND tender_firm_product.tender_id LIKE ".$tender_id);
	 while($raw = $query->fetch_assoc())
	 {
		 $counter++;
		 
	 }
	 ////////////COUNTING BID NUMBER GENERATED FIRMS////////////
	 $query2 = $this->conn->query("SELECT DISTINCT tender_firms.id AS `firm_id`, tender_firms.bid_number FROM `tender_firms`,`tender_firm_product`,`tender` WHERE tender_firms.product_id LIKE tender_firm_product.id AND tender_firms.bid_number NOT LIKE 'NULL' AND tender_firm_product.tender_id LIKE ".$tender_id);
	 while($raw = $query2->fetch_assoc())
	 {
		 $counter2++;
	 }
	 if($counter==$counter2)
	 {
		 return 3;
	 }
	 else
	 {
		 return 2;
	 }
	 
	
	
 }
 public function Tender_status_quoted_partiallyquoted_IFPRINTINGFIRM($tender_id)
 {
	$counter=0;
	$counter2=0;
$query = $this->conn->query("SELECT `id` FROM `tender_rate_attachements` WHERE `tender_id` LIKE ".$tender_id);
	 while($raw = $query->fetch_assoc())
	 {
		 $counter++;
		 
	 }
	 ////////////COUNTING BID NUMBER GENERATED FIRMS////////////
$query2 = $this->conn->query("SELECT `id` FROM `tender_rate_attachements` WHERE `bid_number` NOT LIKE 'NULL' AND `tender_id` LIKE ".$tender_id);
	 while($raw = $query2->fetch_assoc())
	 {
		 $counter2++;
	 }
	 if($counter==$counter2)
	 {
		 return 3;
	 }
	 else
	 {
		 return 2;
	 }
	 
 }
 
 public function NameOfLogedInPin($pin_table,$pin_id)
 {
	 if($pin_table==0)
	 {
	 $name='admin_first_name';
	 $table='admin';
	 }
	 else if($pin_table==1)
	 {
	 $name='officer_first_name';
	 $table='officer';
		 
	 }
	 else
	 {
	  $name='employee_first_name';
	 $table=' employee';
	}
	$result = $this->conn->query("SELECT `".$name."` AS `quoted_name` FROM `".$table."` WHERE `id` LIKE '".$pin_id."'");
	return $result->fetch_assoc();
	
	}
	public function Tender_status($tender_status)
	{
		if($tender_status==0)
		return 'Uploaded';
		else if($tender_status==1)
		return 'Rate Given';
		else if($tender_status==2)
		return 'Partially Quoted';
		else 
		return 'Quoted';
	}
	public function Office_name($office)
	{
		$query = $this->conn->query("SELECT `office_name` FROM `office` WHERE `id` LIKE ".$office);
		return $query->fetch_assoc();
	}
	public function List_Consignee_on_Purchaser($p_id)
	{
		$data = array();
		$query_update = $this->conn->query("SELECT `id`,`main_csign_short_name` FROM `main_consignee` WHERE `main_csign_purchaser` LIKE '".$p_id."' ORDER BY `main_csign_short_name` ASC ");
		$data = array();
		while($raw = $query_update->fetch_assoc())
		{
			$data[] = $raw;
		}
		return $data;
		
	}
	public function AttachementsInTenderRate($tender_id)
	{
		$data = array();
//$query_update = $this->conn->query("SELECT main_consignee.main_csign_short_name,tender_rate_attachements.* FROM `main_consignee`,`tender_rate_attachements` WHERE main_consignee.id LIKE tender_rate_attachements.title AND tender_rate_attachements.tender_id LIKE '".$tender_id."' LIMIT 5");
//$query_update = $this->conn->query("SELECT consignee.csign_short_name,tender_rate_attachements.* FROM `consignee`,`tender_rate_attachements` WHERE consignee.id LIKE tender_rate_attachements.title AND tender_rate_attachements.tender_id LIKE '".$tender_id."' LIMIT 5");
$query_update = $this->conn->query("SELECT * FROM `tender_rate_attachements` WHERE  `tender_id` LIKE '".$tender_id."' LIMIT 5");
		$data = array();
		while($raw = $query_update->fetch_assoc())
		{
			$data[] = $raw;
		}
		return $data;
		
		}
		
		public function AttachementsInTenderRateWithoutLimit($tender_id)
	{
		$data = array();
$query_update = $this->conn->query("SELECT consignee.csign_short_name,bid_number_printed_firm.* FROM `consignee`,`bid_number_printed_firm` WHERE consignee.id LIKE bid_number_printed_firm.firm_id AND bid_number_printed_firm.tender_id LIKE '".$tender_id."'");
//$query_update = $this->conn->query("SELECT * FROM `tender_rate_attachements` WHERE  `tender_id` LIKE '".$tender_id."'");
		$data = array();
		while($raw = $query_update->fetch_assoc())
		{
			$data[] = $raw;
		}
		return $data;
		}
		public function store_printed_firms($csign_id,$table,$file_name,$title,$real_name,$created_by,$created_table)	
		
		{
		$bid_number=NULL;
		$bid_rate=NULL;
		$bid_created_by=NULL;
		$bid_created_by_table=NULL;
		$updated_by=NULL;
		$updated_table=NULL;
		
		
		for($i=0;$i<sizeof($file_name);$i++)
		{
			if($real_name[$i]!="")
			{
			
		$query = $this->conn->prepare("INSERT INTO `".$table."` VALUES(NULL,?,?,?,?,?,?,?,?,?,?,?,?)");        
		$query->bind_param("isssssssssss",$csign_id,$title[$i],$file_name[$i],$real_name[$i],$bid_number,$bid_rate,$bid_created_by,$bid_created_by_table,$created_by,$created_table,$updated_by,$updated_table);
		$query->execute();
			}
			
		}
		
		
	}
	
	public function store_printed_firms_X($csign_id,$table,$file_name,$real_name,$created_by,$created_table)	
		
		{
		$bid_number=NULL;
		$bid_rate=NULL;
		$bid_created_by=NULL;
		$bid_created_by_table=NULL;
		$updated_by=NULL;
		$updated_table=NULL;
		
		
		for($i=0;$i<sizeof($file_name);$i++)
		{
			if($real_name[$i]!="")
			{
			
		$query = $this->conn->prepare("INSERT INTO `".$table."` VALUES(NULL,?,?,?,?,?,?,?,?,?,?,?)");        
		$query->bind_param("issssssssss",$csign_id,$file_name[$i],$real_name[$i],$bid_number,$bid_rate,$bid_created_by,$bid_created_by_table,$created_by,$created_table,$updated_by,$updated_table);
		$query->execute();
			}
			
		}
		
		
	}
	public function Firm_Data_Printing_Time($fpid)
	{
		$query = $this->conn->query('SELECT tender_rate_attachements.*, consignee.csign_short_name FROM `tender_rate_attachements`,`consignee` WHERE tender_rate_attachements.title LIKE consignee.id AND tender_rate_attachements.id LIKE '.$fpid);
		return $query->fetch_assoc();
	}
	public function Title_In_Firm_Registration($title)
	{
		if($title==1)
		return "NSIC Reg";
		else if($title==2)
		return "DGS & D Reg";
		else if($title==3)
		return "DGQA Reg";
		else if($title==4)
		return "CST/VAT Reg";
		else if($title==5)
		return "Performance";
		else if($title==6)
		return "Digital Signature";
		else if($title==7)
		return "PAN Card";
		else if($title==8)
		return "Certificate at Incorporation";
		else if($title==9)
		return "Memorandum at Article";
		else 
		return "Others" ;
	}
	public function Title_In_officer_Employee($title)
	{
		if($title==1)
		return "PAN Card";
		else if($title==2)
		return "ID Proof";
		else if($title==3)
		return "Address Proof";
		else if($title==4)
		return "Resume";
		else 
		return "Others" ;
	}
	
	public function Title_In_Tender_Attachements($title)
	{
		if($title==1)
		return "NIT";
		else if($title==2)
		return "Specification";
		else if($title==3)
		return "Drawing Copy";
		else if($title==4)
		return "Annexures";
		else if($title==5)
		return "Special Conditions";
		else 
		return "Others" ;
	}
	public function Title_In_Specification($title)
	{
		if($title==1)
		return "BIS";
		else if($title==2)
		return "DGQA";
		else if($title==3)
		return "Railway";
		else if($title==4)
		return "DGS & D";
		else 
		return "Others" ;
	}
	
	public function Update_Firm_Attachements($titles,$other_title,$finalName,$name,$id_firm_attachement)
	{
	/*	if($finalName==0)
		{
		$query = $this->conn->query("UPDATE `csign_attachments` SET `title`='".$titles."',`other_title`='".$other_title."' WHERE `id` LIKE ".$id_firm_attachement);
		return true;
			
		}*/
		//else
		//{
			$query = $this->conn->query("UPDATE `csign_attachments` SET `title`='".$titles."',`other_title`='".$other_title."',`file`='".$finalName."',`file_real_name`='".$name."' WHERE `id` LIKE ".$id_firm_attachement);
			return true;
			
		//}
		
	}
	public function Update_Officer_Attachements($titles,$other_title,$finalName,$name,$id_firm_attachement)
	{
		if($finalName==0)
		{
		$query = $this->conn->query("UPDATE `officer_attachments` SET `title`='".$titles."',`other_title`='".$other_title."' WHERE `id` LIKE ".$id_firm_attachement);
		
		
		return true;
			
		}
		
	
		else
		{
			$query = $this->conn->query("UPDATE `officer_attachments` SET `title`='".$titles."',`other_title`='".$other_title."',`file`='".$finalName."',`file_real_name`='".$name."' WHERE `id` LIKE ".$id_firm_attachement);
			return true;
			
		}
		
	}
	public function Update_Specification_Attachements($finalName,$name,$id_firm_attachement)
	{
		if($finalName==0)
		{
		//$query = $this->conn->query("UPDATE `specification_attachements` SET `title`='".$titles."',`other_title`='".$other_title."' WHERE `id` LIKE ".$id_firm_attachement);
		return true;
			
		}
		
	
		else
		{
	$query = $this->conn->query("UPDATE `specification_attachements` SET `file`='".$name."',`file_real_name`='".$finalName."' WHERE `id` LIKE ".$id_firm_attachement);
	
	
			return true;
			
		}
		
	}
	
	
	public function Update_Employee_Attachements($titles,$other_title,$finalName,$name,$id_firm_attachement)
	{
		if($finalName==0)
		{
		$query = $this->conn->query("UPDATE `employee_attachments` SET `title`='".$titles."',`other_title`='".$other_title."' WHERE `id` LIKE ".$id_firm_attachement);
		
		
		return true;
			
		}
		else
		{
			$query = $this->conn->query("UPDATE `employee_attachments` SET `title`='".$titles."',`other_title`='".$other_title."',`file`='".$finalName."',`file_real_name`='".$name."' WHERE `id` LIKE ".$id_firm_attachement);
			return true;
			
		}
		
	}
	public function Update_Tender_Attachements($titles,$other_title,$finalName,$name,$id_firm_attachement)
	{
		
		if($finalName==0)
		{
		$query = $this->conn->query("UPDATE `tender_attachments` SET `title`='".$titles."',`other_title`='".$other_title."' WHERE `id` LIKE ".$id_firm_attachement);
		
		
		return true;
			
		}
		else
		{
			$query = $this->conn->query("UPDATE `tender_attachments` SET `title`='".$titles."',`other_title`='".$other_title."',`file`='".$finalName."',`file_real_name`='".$name."' WHERE `id` LIKE ".$id_firm_attachement);
			return true;
			
		}
		
			
		
		
	}
	
function Update_Tender_Attachements_History($titles,$other_title,$finalName,$name,$id_firm_attachement)
{
	if($finalName==0)
		{
		$query = $this->conn->query("UPDATE `history_tender_attachments` SET `title`='".$titles."',`other_title`='".$other_title."' WHERE `id` LIKE ".$id_firm_attachement);
	
		
		
		return true;
			
		}
		else
		{
			$query = $this->conn->query("UPDATE `history_tender_attachments` SET `title`='".$titles."',`other_title`='".$other_title."',`file`='".$finalName."',`file_real_name`='".$name."' WHERE `id` LIKE ".$id_firm_attachement);
			return true;
			
		}
		
	
}
	
	
	public function ALertMessage($msg,$chk)
	{
		if($chk==1)
		{
			?>
            <script>
			alert('<?php echo $msg ?>');
			</script>
            <?php
		}
		else
		{
				?>
            <script>
			alert('There is some server error');
			</script>
            <?php
			
		}
		
	}
	

	public function BidNumberPrintedForm($tender_id,$select_firm,$bid_number,$created_by,$created_by_table)
	{
		$bqaz = 0;
		$query_delete = $this->conn->query("DELETE FROM `bid_number_printed_firm` WHERE `tender_id` LIKE ".$tender_id);
		for($i=0;$i<sizeof($select_firm);$i++)
		{
			if($select_firm[$i]!="")
			{
				if(trim($bid_number[$i])=='')
				{
					$toInsert=NULL;
				}
				else
				{
					$toInsert=trim($bid_number[$i]);
				}
				
				$bqaz++;
		$query = $this->conn->prepare("INSERT INTO `bid_number_printed_firm` VALUES (NULL,?,?,?,?,?) ");
		//$query->bind_param("iisss",$tender_id,$select_firm[$i],trim($bid_number[$i]),$created_by,$created_by_table);
		$query->bind_param("iisss",$tender_id,$select_firm[$i],$toInsert,$created_by,$created_by_table);
		$query->execute();
			}
		
		}
		$res = $this->ChangeTenderStatusInPrintedTime($tender_id);
	
  
}
public function ChangeTenderStatusInPrintedTime($tender_id)
{
	$query_b = $this->conn->query("SELECT `id` FROM `bid_number_printed_firm` WHERE   `tender_id` LIKE ".$tender_id);
	if($query_b->num_rows>0)
	{
		$query_ken = $this->conn->query("SELECT `id` FROM `bid_number_printed_firm` WHERE `bid_number` IS NULL AND `tender_id` LIKE ".$tender_id);
		if($query_ken->num_rows>0)
		{
		$stu = 2;
		}
		else
		{
		$stu = 3;	
		}
		$query_update = $this->conn->query("UPDATE `tender` SET `status`='".$stu."' WHERE `id` LIKE ".$tender_id);
	}
	else
	{
		$status = 1;
		$query_update = $this->conn->query("UPDATE `tender` SET `status`='".$status."' WHERE `id` LIKE ".$tender_id);
		
	}
	
}
	
	public function DeletedRecordJustIdTable($table,$id,$tender_id)
	{
		$query = $this->conn->query("DELETE FROM `".$table."` WHERE `id` LIKE ".$id);
		$res = $this->ChangeTenderStatusInPrintedTime($tender_id);
		if($query)
		{
			return 1;
		}
		else
		{
			return 0;
		}
		
		
	}
	public function GiveBidNumberInMannualFirms($bid_number,$firm_id,$bid_created_by,$bid_created_by_table,$tender_id,$Firms_For_Adding_In_Mannual_Bid,$Bid_Number_For_Flag1_Firms,$Product_Id_For_Flag1_Firms)
	{
		for($i=0;$i<sizeof($firm_id);$i++)
		{
			if(trim($bid_number[$i])=="")
			{
				$query = $this->conn->query("UPDATE `tender_firms` SET `bid_created_by`='".$bid_created_by."',`bid_created_by_table`='".$bid_created_by_table."',`bid_number`= NULL WHERE `id` LIKE ".$firm_id[$i]);
				
			}
			else
			{
				
			$query = $this->conn->query("UPDATE `tender_firms` SET `bid_created_by`='".$bid_created_by."',`bid_created_by_table`='".$bid_created_by_table."',`bid_number`='".trim($bid_number[$i])."' WHERE `id` LIKE ".$firm_id[$i]);	
				
			}
				
		}
		$flag=1;
		for($m=0;$m<sizeof($Firms_For_Adding_In_Mannual_Bid);$m++)
		{
			if($Firms_For_Adding_In_Mannual_Bid[$m]!='')
			{
				if(trim($Bid_Number_For_Flag1_Firms[$m])=='')
				{
					$biding = NULL;
				}
				else
				{
					$biding = trim($Bid_Number_For_Flag1_Firms[$m]);
				}
				
			$query = $this->conn->prepare("INSERT INTO `tender_firms` VALUES(NULL,?,?,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,?,?,?,NULL,?,?,NULL,NULL,?)");
		$query->bind_param("iisssssi",$Product_Id_For_Flag1_Firms[$m],$Firms_For_Adding_In_Mannual_Bid[$m],$biding,$bid_created_by,$bid_created_by_table,$bid_created_by,$bid_created_by_table,$flag);
		$query->execute();
			}
		}
		
	$result_for_status = $this->Tender_status_quoted_partiallyquotedXYZ($tender_id);
   $query_update_tender = $this->conn->query("UPDATE `tender` SET `status`='".$result_for_status."' WHERE `id` LIKE ".$tender_id); 
		
	}
	public function Tender_status_quoted_partiallyquotedXYZ($tender_id)
	{
		
		$query = $this->conn->query("SELECT tender_firms.id FROM `tender_firms`,`tender_firm_product`,`tender` WHERE tender.id LIKE tender_firm_product.tender_id AND tender_firm_product.id LIKE tender_firms.product_id AND tender.id LIKE ".$tender_id);
		$total_firms = $query->num_rows;
		
		if($query->num_rows>0)
		{
			$query_tt = $this->conn->query("SELECT tender_firms.id FROM `tender_firms`,`tender_firm_product`,`tender` WHERE tender.id LIKE tender_firm_product.tender_id AND tender_firm_product.id LIKE tender_firms.product_id AND tender_firms.bid_number IS NULL AND tender.id LIKE ".$tender_id);
			$total_Null_firms = $query_tt->num_rows;
			if($total_firms==$total_Null_firms)
			{
			 return 1;	
			}
			else if ($total_Null_firms==0)
			{
				return 3;
			}
			else
			{
				return 2;
			}
			
			
			
		}
		else
		{
			return 1;
		}
		
		
	}
	public function AttachementsInTenderRateWithoutLimitXXYYZZ($tender_id)
	{
		$data = array();
//$query_update = $this->conn->query("SELECT consignee.csign_short_name,bid_number_printed_firm.* FROM `consignee`,`bid_number_printed_firm` WHERE consignee.id LIKE bid_number_printed_firm.firm_id AND bid_number_printed_firm.tender_id LIKE '".$tender_id."'");
$query_update = $this->conn->query("SELECT * FROM `tender_rate_attachements` WHERE  `tender_id` LIKE '".$tender_id."'");
		$data = array();
		while($raw = $query_update->fetch_assoc())
		{
			$data[] = $raw;
		}
		return $data;
		}
	public function tender_bid_attachements_save($data,$finalName,$name,$tender_id)
	{
		$query = $this->conn->query("UPDATE `tender` SET `tender_composition_rate`='".$data['tender_composition_rate']."' WHERE `id` LIKE ".$tender_id);
		
		$this->store_attachments_after_other($tender_id,'tender_bid_attachements',$finalName,$data['titles'],$name,$data['text_on_others']);
		return $query;
		
		
	}
	public function Title_In_Tender_Bid_Attachements($title)
	{
		if($title==1)
		return "Finantial Tabulation";
		else if($title==2)
		return "Technical Tabulation";
		else if($title==3)
		return "Mannual Tabulation";
		else 
		return "Correspondance" ;
	}
	public function Update_Tender_Attachements_bid_wale($titles,$other_title,$finalName,$name,$id_firm_attachement)
	{
		
		if($finalName==0)
		{
		$query = $this->conn->query("UPDATE `tender_bid_attachements` SET `title`='".$titles."',`other_title`='".$other_title."' WHERE `id` LIKE ".$id_firm_attachement);
		
		
		return true;
			
		}
		else
		{
			$query = $this->conn->query("UPDATE `tender_bid_attachements` SET `title`='".$titles."',`other_title`='".$other_title."',`file`='".$finalName."',`file_real_name`='".$name."' WHERE `id` LIKE ".$id_firm_attachement);
			return true;
			
		}
		
	}
	public function Firms_In_Tabulation_stmt($product_id)
	{
		$query = $this->conn->query("SELECT tender_firms.*,consignee.csign_short_name FROM `tender_firms`,`consignee` WHERE tender_firms.firm LIKE consignee.id AND tender_firms.flag LIKE 0 AND tender_firms.product_id LIKE ".$product_id);
		while($raw = $query->fetch_assoc())
		{
			$data[]=$raw;
		}
		return $data;
		
	}
	public function FetchFirmsForRemarkInTabulation($tender_id)
	{
		$query = $this->conn->query("SELECT tender_firms.bid_number,tender_firms.remark,tender_firms.delperod 	,tender_firms.delschedule,tender_firms.spinate,consignee.csign_short_name FROM `consignee`,`tender`,`tender_firms`,`tender_firm_product` WHERE tender_firms.firm LIKE consignee.id AND tender_firms.product_id LIKE tender_firm_product.id AND tender_firm_product.tender_id LIKE tender.id AND tender.id LIKE '".$tender_id."' AND tender_firms.flag LIKE 0 ORDER BY consignee.csign_short_name ASC");
		while($raw = $query->fetch_assoc())
		{
			$data[] = $raw;
		}
		return $data;
		
	}
	
public function CAMMELCASESTRING($v)
{
	$t =  strtolower($v);
	return ucwords($t);
}
public function common_fetch_attachement_withItem_PO_HISTORY($table,$colm,$id)
	{
		$data=array();
		$query=$this->conn->query("SELECT item_manager.item_name, item_manager.item_discription, main_consignee.main_csign_short_name,history_po_firm_product.* FROM `item_manager`,`history_po_firm_product`,`main_consignee` WHERE history_po_firm_product.category LIKE item_manager.id AND history_po_firm_product.consignee LIKE main_consignee.id AND history_po_firm_product.po_id LIKE '".$id."' LIMIT 5 ");
		while($raw = $query->fetch_assoc())
		{
			$data[]=$raw;
		}
		return $data;
	}	
		public function common_fetch_attachement_withItem_nolimit_Po_History($table,$colm,$id)
	{
		$data=array();
		$query=$this->conn->query("SELECT item_manager.item_name, item_manager.item_discription,item_manager.id as `item_id`, main_consignee.main_csign_short_name,history_po_firm_product.* FROM `item_manager`,`history_po_firm_product`,`main_consignee` WHERE history_po_firm_product.category LIKE item_manager.id AND history_po_firm_product.consignee LIKE main_consignee.id AND history_po_firm_product.po_id LIKE ".$id);
		while($raw = $query->fetch_assoc())
		{
			$data[]=$raw;
		}
		return $data;
		
		
	}
	
	public function UpdateProductPoInHistory($category,$inspection,$discription,$consignee,$quantity,$unit,$tax_type,$tax,$rate,$pid)
	{
		$rest = $category;
		$kk=explode("(",$rest);
		$final=explode(")",$kk[1]);
		$query = $this->conn->query("UPDATE `history_po_firm_product` SET `category` = '".$final[0]."',`inspection`='".$inspection."' , `discription`='".$discription."',`consignee`='".$consignee."',`quantity` = '".$quantity."',`unit`='".$unit."',`tax_type`='".$tax_type."',`tax`='".$tax."',`rate`='".$rate."' WHERE `id` LIKE '".$pid."'");
	}
	public function ProductPoHistoryAfterUpdateInAjaxPage($id)
	{
		$query=$this->conn->query("SELECT item_manager.item_name, item_manager.item_discription,item_manager.id as `item_id`, main_consignee.main_csign_short_name,history_po_firm_product.* FROM `item_manager`,`history_po_firm_product`,`main_consignee` WHERE history_po_firm_product.category LIKE item_manager.id AND history_po_firm_product.consignee LIKE main_consignee.id AND history_po_firm_product.id LIKE ".$id);
		return $query->fetch_assoc();
		
	}
	public function Title_In_PO_History_Attachements($title)
	{
		if($title==1)
		return "IC Copy";
		else if($title==2)
		return "PO Copy";
		else if($title==3)
		return "Challan";
		else if($title==4)
		return "Bill Copy";
		else if($title==5)
		return "Full Case";
		else if($title==6)
		return "R.Note";
		else 
		return "Others" ;
	}
	public function Update_Po_Attachements_History($titles,$other_title,$finalName,$name,$id_firm_attachement)
	{
		
		if($finalName==0)
		{
		$query = $this->conn->query("UPDATE `history_po_attachements` SET `title`='".$titles."',`other_title`='".$other_title."' WHERE `id` LIKE ".$id_firm_attachement);
		
		
		return true;
			
		}
		else
		{
			$query = $this->conn->query("UPDATE `history_po_attachements` SET `title`='".$titles."',`other_title`='".$other_title."',`file`='".$finalName."',`file_real_name`='".$name."' WHERE `id` LIKE ".$id_firm_attachement);
			return true;
			
		}
		
	}
	
	public function Po_Update_History_Section($data,$finalName,$name,$updated_by,$updated_table,$editID)
{
	$correct_date_format = explode('-',$data['po_due_date']);
	$final_date=$correct_date_format[2]."-".$correct_date_format[1]."-".$correct_date_format[0];
	$query = $this->conn->query("UPDATE `history_po` SET `po_office`='".$data['po_office']."',`po_firm`='".$data['po_firms']."',`po_number`='".$data['po_number']."',
`po_due_date`='".$final_date."',`po_value`='".$data['po_value']."',`updated_by`='".$updated_by."',`updated_table`='".$updated_table."' WHERE `id` LIKE ".$editID);

if($query->error)
		{
			return $query;
		}
		else
		{
			
			
			$tender_id = $editID;
			$emp_cnsi=$this->store_po_firms_product_History($data['category'],$_POST['inspection'],$data['discription'],$data['consignee'],$data['quantity'],$data['unit'],$data['tax_type'],$data['tax'],$data['rate'],$tender_id);
			$this->store_attachments_after_other($tender_id,'history_po_attachements',$finalName,$data['titles'],$name,$data['text_on_others']);
			
			return 1;
		}
		
	}
	public function getAllTenderForSearch_History_Time($pID)
	{
	$data = array();
	$query_tender = $this->conn->query("SELECT `tender_number` FROM `history_tender` WHERE `tender_purchaser` LIKE ".$pID);
		while($rock = $query_tender->fetch_assoc())
		{
			$data[] = $rock;
		}
		//return $data;
		return $this->formateDataForNumber($data);	
	}
	
public function CheckAvailabeTenderNumberInHistory($tender_number,$purchaser_id_tn,$edit_time_id)
{
	if($edit_time_id=='')
	{
		$query = $this->conn->query("SELECT * FROM `history_tender` WHERE `tender_number` LIKE '".$tender_number."' AND `tender_purchaser` LIKE '".$purchaser_id_tn."' LIMIT 1");
		
	}
	else
	{
	$query = $this->conn->query("SELECT * FROM `history_tender` WHERE `tender_number` LIKE '".$tender_number."' AND `tender_purchaser` LIKE '".$purchaser_id_tn."' AND `id` NOT LIKE '".$edit_time_id."' LIMIT 1");
	}
	$result=$query->fetch_assoc();
	
	if($result!='')
	{
		return 0;
	}
	else
	{
		return 1;
	}
}

public function common_fetch_attachement_withItem_His($table,$colm,$id)
	{
		$data=array();
		$query=$this->conn->query("SELECT item_manager.item_name, item_manager.item_discription, main_consignee.main_csign_short_name,history_tender_firm_product.* FROM `item_manager`,`history_tender_firm_product`,`main_consignee` WHERE history_tender_firm_product.category LIKE item_manager.id AND history_tender_firm_product.consignee LIKE main_consignee.id AND history_tender_firm_product.tender_id LIKE '".$id."' LIMIT 5 ");
	
		while($raw = $query->fetch_assoc())
		{
			$data[]=$raw;
		}
		return $data;
	}	
	
	public function common_fetch_attachement_withItem_nolimit_his_wl($table,$colm,$id)
	{
		$data=array();
		$query=$this->conn->query("SELECT item_manager.item_name, item_manager.item_discription,item_manager.id as `item_id`, main_consignee.main_csign_short_name,history_tender_firm_product.* FROM `item_manager`,`history_tender_firm_product`,`main_consignee` WHERE history_tender_firm_product.category LIKE item_manager.id AND history_tender_firm_product.consignee LIKE main_consignee.id AND history_tender_firm_product.tender_id LIKE ".$id);
		
		while($raw = $query->fetch_assoc())
		{
			$data[]=$raw;
		}
		return $data;
		
		
	}
	public function UpdateProductFirmInHis($category,$inspection,$discription,$consignee,$quantity,$unit,$pid)
	{
		$rest = $category;
		$kk=explode("(",$rest);
		$final=explode(")",$kk[1]);
		$query = $this->conn->query("UPDATE `history_tender_firm_product` SET `category` = '".$final[0]."',`inspection`='".$inspection."' , `discription`='".$discription."',`consignee`='".$consignee."' , `quantity` = '".$quantity."',`unit`='".$unit."' WHERE `id` LIKE '".$pid."'");
	}
	public function ProductFirmAfterUpdateInHis($id)
	{
		$query=$this->conn->query("SELECT item_manager.item_name, item_manager.item_discription,item_manager.id as `item_id`, main_consignee.main_csign_short_name,history_tender_firm_product.* FROM `item_manager`,`history_tender_firm_product`,`main_consignee` WHERE history_tender_firm_product.category LIKE item_manager.id AND history_tender_firm_product.consignee LIKE main_consignee.id AND history_tender_firm_product.id LIKE ".$id);
		return $query->fetch_assoc();
		
	}
	
	public function Tender_type($tt)
	{
		if($tt==0)
		return 'Advertise' ;
		else if($tt==1)
		return 'Limited' ;
		else if($tt==2)
		return 'Bulletin' ;
		else if($tt==3)
		return 'SPL Limited' ;
		else
		return 'Local Purchaser' ;
		
	}
	public function Specification_type($tt)
	{
		if($tt==1)
		return 'BIS' ;
		else if($tt==2)
		return 'DGQA' ;
		else if($tt==3)
		return 'Railway' ;
		else if($tt==4)
		return 'DGS & D' ;
		else
		return 'Others' ;
		
	}
	public function Store_After_Pending_Status($tender_id,$status_after_pending,$remark_after_pending,$finalName,$name,$created_by,$created_table)
	{
	$query_delete = $this->conn->query("DELETE FROM `table_after_pending_status` WHERE `tender_id` LIKE ".$tender_id);	
	$query = $this->conn->prepare("INSERT INTO `table_after_pending_status` VALUES (NULL,?,?,?,?,?) ");
	$query->bind_param("iisss",$tender_id,$status_after_pending,$remark_after_pending,$created_by,$created_table);
	$query->execute();
	if($query->error)
		{
			return 0;
		}
		else
		{
			for($i=0;$i<sizeof($name);$i++)
			{
				if($name[$i]!='')
				{
	$query_i = $this->conn->prepare('INSERT INTO `attachements_after_pending_status` VALUES (NULL,?,?,?) ');
				$query_i->bind_param('iss',$tender_id,$name[$i],$finalName[$i]);
				$query_i->execute();
				}
			}
			return 1;
		}
	
		
	}
	public function Update_Pending_Attachements($finalName,$name,$id_firm_attachement)
	{
		if($finalName==0)
		{
		//$query = $this->conn->query("UPDATE `specification_attachements` SET `title`='".$titles."',`other_title`='".$other_title."' WHERE `id` LIKE ".$id_firm_attachement);
		return true;
			
		}
		
	
		else
		{
	$query = $this->conn->query("UPDATE `attachements_after_pending_status` SET `file`='".$name."',`file_real_name`='".$finalName."' WHERE `id` LIKE ".$id_firm_attachement);
	
	
	
			return true;
			
		}
		
	}
	public function Tender_Search_Last($office,$purchaser,$tender_number,$tender_due_date,$icat,$idis)
	{
		
		if($tender_due_date!="")
		{
			$date_seperate = explode('-',trim($tender_due_date));
			$date_1=$date_seperate[0];
			$date_1_A=explode('/',trim($date_1));
			
			$compare_date_1 = trim($date_1_A[2]).'-'.trim($date_1_A[0]).'-'.trim($date_1_A[1]);
			
			$date_2=$date_seperate[1];
			$date_2_A=explode('/',trim($date_2));
			$compare_date_2 = trim($date_2_A[2]).'-'.trim($date_2_A[0]).'-'.trim($date_2_A[1]);
			//$date_match="AND (`tender_due_date`>='".$compare_date_1."' AND `tender_due_date`<='".$compare_date_2."') ";
			$date_match = "AND `tender_due_date` between '".$compare_date_1."' AND '".$compare_date_2."' ";
			
			
		}
		else
		{
			$date_match="AND `tender_due_date` LIKE '%%'";
		}
		if($tender_number=="")
		{
			$tender_number_new='%%';
		}
		else
		{
			$tender_number_new='%'.$tender_number.'%';
		}
		if($icat=='%%' && $idis=='')
		{
		$query = $this->conn->query("SELECT create_purchaser.purchaser_short_name,tender.* FROM `create_purchaser`,`tender` WHERE create_purchaser.id LIKE tender.tender_purchaser AND tender.tender_office LIKE '".$office."' AND tender.tender_purchaser LIKE '".$purchaser."' AND tender.tender_number LIKE '".$tender_number_new."' ".$date_match." ");
		}
		if($icat=='%%' && $idis!='')
		{
			$new_idis = '%'.$idis.'%';
			//$query = $this->conn->query("SELECT DISTINCT  create_purchaser.purchaser_short_name,tender.* FROM `create_purchaser`,`tender`,`tender_firm_product`,`item_manager` WHERE create_purchaser.id LIKE tender.tender_purchaser AND tender.tender_office LIKE '".$office."' AND tender.tender_purchaser LIKE '".$purchaser."' AND tender.tender_number LIKE '".$tender_number_new."' AND tender.id LIKE tender_firm_product.tender_id AND tender_firm_product.category LIKE item_manager.id AND item_manager.item_discription LIKE '".$new_idis."' ");
			$query = $this->conn->query("SELECT DISTINCT  create_purchaser.purchaser_short_name,tender.* FROM `create_purchaser`,`tender`,`tender_firm_product` WHERE create_purchaser.id LIKE tender.tender_purchaser AND tender.tender_office LIKE '".$office."' AND tender.tender_purchaser LIKE '".$purchaser."' AND tender.tender_number LIKE '".$tender_number_new."' ".$date_match." AND tender.id LIKE tender_firm_product.tender_id AND tender_firm_product.discription LIKE '".$new_idis."' ");
		}
		if($icat!="%%" && $idis=="")
		{
		  $query = $this->conn->query("SELECT DISTINCT  create_purchaser.purchaser_short_name,tender.* FROM `create_purchaser`,`tender`,`tender_firm_product`,`item_manager` WHERE create_purchaser.id LIKE tender.tender_purchaser AND tender.tender_office LIKE '".$office."' AND tender.tender_purchaser LIKE '".$purchaser."' AND tender.tender_number LIKE '".$tender_number_new."' ".$date_match." AND tender.id LIKE tender_firm_product.tender_id AND tender_firm_product.category LIKE item_manager.id AND item_manager.id LIKE ".$icat);	
		}
		if($icat!="%%" && $idis!="")
		{
			$new_idis = '%'.$idis.'%';
		 // $query = $this->conn->query("SELECT DISTINCT  create_purchaser.purchaser_short_name,tender.* FROM `create_purchaser`,`tender`,`tender_firm_product`,`item_manager` WHERE create_purchaser.id LIKE tender.tender_purchaser AND tender.tender_office LIKE '".$office."' AND tender.tender_purchaser LIKE '".$purchaser."' AND tender.tender_number LIKE '".$tender_number_new."' AND tender.id LIKE tender_firm_product.tender_id AND tender_firm_product.category LIKE item_manager.id AND item_manager.id LIKE '".$icat."' AND item_manager.item_discription LIKE '".$new_idis."'");
		  $query = $this->conn->query("SELECT DISTINCT  create_purchaser.purchaser_short_name,tender.* FROM `create_purchaser`,`tender`,`tender_firm_product`,`item_manager` WHERE create_purchaser.id LIKE tender.tender_purchaser AND tender.tender_office LIKE '".$office."' AND tender.tender_purchaser LIKE '".$purchaser."' AND tender.tender_number LIKE '".$tender_number_new."' ".$date_match." AND tender.id LIKE tender_firm_product.tender_id AND tender_firm_product.category LIKE item_manager.id AND item_manager.id LIKE '".$icat."' AND tender_firm_product.discription LIKE '".$new_idis."'");	
		
		}
		
		while($rock = $query->fetch_assoc())
		{
			
			$data[] = $rock;
			
		}
		return $data;
		
		
	}
	
	public function Tender_Search_In_Current_And_History_Both($office,$purchaser,$tender_number,$tender_due_date,$icat,$idis,$min_range,$max_range)
	{
		
		if($tender_due_date!="")
		{
			$date_seperate = explode('-',trim($tender_due_date));
			$date_1=$date_seperate[0];
			$date_1_A=explode('/',trim($date_1));
			
			$compare_date_1 = trim($date_1_A[2]).'-'.trim($date_1_A[0]).'-'.trim($date_1_A[1]);
			
			$date_2=$date_seperate[1];
			$date_2_A=explode('/',trim($date_2));
			$compare_date_2 = trim($date_2_A[2]).'-'.trim($date_2_A[0]).'-'.trim($date_2_A[1]);
			//$date_match="AND (`tender_due_date`>='".$compare_date_1."' AND `tender_due_date`<='".$compare_date_2."') ";
			$date_match = "AND tender.tender_due_date between '".$compare_date_1."' AND '".$compare_date_2."' ";
			
			
		}
		else
		{
			$date_match="AND `tender_due_date` LIKE '%%'";
		}
		if($tender_number=="")
		{
			$tender_number_new='%%';
		}
		else
		{
			$tender_number_new='%'.$tender_number.'%';
		}
////////////////////////////////Queries For Current Tender///////////////////		
		if($icat=='%%' && $idis=='')
		{
		$query = $this->conn->query("SELECT create_purchaser.purchaser_short_name,tender.* FROM `create_purchaser`,`tender` WHERE create_purchaser.id LIKE tender.tender_purchaser AND tender.tender_office LIKE '".$office."' AND tender.tender_purchaser LIKE '".$purchaser."' AND tender.tender_number LIKE '".$tender_number_new."' ".$date_match."");
		}
		if($icat=='%%' && $idis!='')
		{
			$new_idis = '%'.$idis.'%';
			
			$query = $this->conn->query("SELECT DISTINCT  create_purchaser.purchaser_short_name,tender.* FROM `create_purchaser`,`tender`,`tender_firm_product` WHERE create_purchaser.id LIKE tender.tender_purchaser AND tender.tender_office LIKE '".$office."' AND tender.tender_purchaser LIKE '".$purchaser."' AND tender.tender_number LIKE '".$tender_number_new."' ".$date_match." AND tender.id LIKE tender_firm_product.tender_id AND tender_firm_product.discription LIKE '".$new_idis."' ");
		}
		if($icat!="%%" && $idis=="")
		{
		  $query = $this->conn->query("SELECT DISTINCT  create_purchaser.purchaser_short_name,tender.* FROM `create_purchaser`,`tender`,`tender_firm_product`,`item_manager` WHERE create_purchaser.id LIKE tender.tender_purchaser AND tender.tender_office LIKE '".$office."' AND tender.tender_purchaser LIKE '".$purchaser."' AND tender.tender_number LIKE '".$tender_number_new."' ".$date_match." AND tender.id LIKE tender_firm_product.tender_id AND tender_firm_product.category LIKE item_manager.id AND item_manager.id LIKE ".$icat);	
		}
		if($icat!="%%" && $idis!="")
		{
			$new_idis = '%'.$idis.'%';
	
		  $query = $this->conn->query("SELECT DISTINCT  create_purchaser.purchaser_short_name,tender.* FROM `create_purchaser`,`tender`,`tender_firm_product`,`item_manager` WHERE create_purchaser.id LIKE tender.tender_purchaser AND tender.tender_office LIKE '".$office."' AND tender.tender_purchaser LIKE '".$purchaser."' AND tender.tender_number LIKE '".$tender_number_new."' ".$date_match." AND tender.id LIKE tender_firm_product.tender_id AND tender_firm_product.category LIKE item_manager.id AND item_manager.id LIKE '".$icat."' AND tender_firm_product.discription LIKE '".$new_idis."'");	
		
		}
		while($rock = $query->fetch_assoc())
		{
			if($min_range=='' && $max_range=='')
			{
				
				$data[] = $rock;
			}
			else if($min_range!='' && $max_range=='')
			{
				$calculate_value = $this->CalculationOfTenderValue($rock['id']);
				if($calculate_value>=$min_range)
				{
					$data[] = $rock;
				}
			}
			else if($min_range=='' && $max_range!='')
			{
				$calculate_value = $this->CalculationOfTenderValue($rock['id']);
				if($calculate_value<=$max_range)
				{
					$data[] = $rock;
				}
			}
			else
			{
				$calculate_value = $this->CalculationOfTenderValue($rock['id']);
				if($calculate_value<=$max_range && $calculate_value>=$min_range )
				{
					$data[] = $rock;
				}
				
			}
		}
///////////////////////////////////////////////////////////////////////
/////////////////////////////////Queries For History Tender////////////////
	if($icat=='%%' && $idis=='')
		{
		$query_history = $this->conn->query("SELECT create_purchaser.purchaser_short_name,history_tender.* FROM `create_purchaser`,`history_tender` WHERE create_purchaser.id LIKE history_tender.tender_purchaser AND history_tender.tender_office LIKE '".$office."' AND history_tender.tender_purchaser LIKE '".$purchaser."' AND history_tender.tender_number LIKE '".$tender_number_new."' ".$date_match."");
		}
		if($icat=='%%' && $idis!='')
		{
			$new_idis = '%'.$idis.'%';
			
			$query_history = $this->conn->query("SELECT DISTINCT  create_purchaser.purchaser_short_name,history_tender.* FROM `create_purchaser`,`history_tender`,`tender_firm_product` WHERE create_purchaser.id LIKE history_tender.tender_purchaser AND history_tender.tender_office LIKE '".$office."' AND history_tender.tender_purchaser LIKE '".$purchaser."' AND history_tender.tender_number LIKE '".$tender_number_new."' ".$date_match." AND history_tender.id LIKE tender_firm_product.tender_id AND tender_firm_product.discription LIKE '".$new_idis."' ");
		}
		if($icat!="%%" && $idis=="")
		{
		  $query_history = $this->conn->query("SELECT DISTINCT  create_purchaser.purchaser_short_name,history_tender.* FROM `create_purchaser`,`history_tender`,`tender_firm_product`,`item_manager` WHERE create_purchaser.id LIKE history_tender.tender_purchaser AND history_tender.tender_office LIKE '".$office."' AND history_tender.tender_purchaser LIKE '".$purchaser."' AND history_tender.tender_number LIKE '".$tender_number_new."' ".$date_match." AND history_tender.id LIKE tender_firm_product.tender_id AND tender_firm_product.category LIKE item_manager.id AND item_manager.id LIKE ".$icat);	
		}
		if($icat!="%%" && $idis!="")
		{
			$new_idis = '%'.$idis.'%';
	
		 $query_history = $this->conn->query("SELECT DISTINCT  create_purchaser.purchaser_short_name,history_tender.* FROM `create_purchaser`,`history_tender`,`tender_firm_product`,`item_manager` WHERE create_purchaser.id LIKE history_tender.tender_purchaser AND history_tender.tender_office LIKE '".$office."' AND history_tender.tender_purchaser LIKE '".$purchaser."' AND history_tender.tender_number LIKE '".$tender_number_new."' ".$date_match." AND history_tender.id LIKE tender_firm_product.tender_id AND tender_firm_product.category LIKE item_manager.id AND item_manager.id LIKE '".$icat."' AND tender_firm_product.discription LIKE '".$new_idis."'");	
		
		}
		while($rockX = $query_history->fetch_assoc())
		{
			
				
				$data[] = $rockX;
		}
//////////////////////////////////////////////////////////////////////////
			
		return $data;	
		
		
	}
	public function CalculationOfTenderValue($tender_id)
	{
		$gamp = array();
		$gamp=0;
		$result = $this->conn->query("SELECT MIN(tender_firm_product.quantity * tender_firms.finalrate) AS `value_comes`,tender_firm_product.id AS `p_id` FROM `tender`,`tender_firm_product`,`tender_firms` WHERE tender_firms.product_id LIKE tender_firm_product.id AND tender_firms.flag LIKE 0 AND tender_firm_product.tender_id LIKE tender.id AND tender.id LIKE '".$tender_id."' GROUP BY `p_id`");
		
		
		while($remp = $result->fetch_assoc())
		{
			
			$gamp+=$remp['value_comes'];
		  	
		}
		return $gamp;
		
	}

public function display_discription_history_curent($id,$table)
{
	$discription = $this->conn->query("SELECT `discription` FROM `".$table."` WHERE `tender_id` LIKE ".$id);
	$m=1;
	//$data2=array();
	
	while($raw=$discription->fetch_assoc())
	{
		
		$data3 .=' ['.$m.'] '.$raw['discription'];
		$m++;
	}
	return $data3;
}	
public function Specification_Search($sn,$title,$issued_by)
{
	if($sn=='')
	{
		$specs_no='%%';
	}
	else
	{
		$specs_no='%'.$sn.'%';
	}
	if($title=='')
	{
		$tit='%%';
	}
	else
	{
		$tit='%'.$title.'%';
	}
  $query = $this->conn->query("SELECT * FROM `specification` WHERE `specification_no` LIKE '".$specs_no."' AND `title` LIKE '".$tit."' AND `issued` LIKE '".$issued_by."'");
  while($raw = $query->fetch_assoc())
  {
	  $data[] = $raw;
  }
  return $data;
	
	
}
public function Title_specs_issued_by($title)
{
	if($title==1)
	return 'BIS' ;
	else if($title==2)
	return 'DGQA';
	else if($title==3)
	return 'Railway';
	else if($title==4)
	return 'DGS & D';
	else
	return 'Others';  
	
}
public function Purchaser_office_name_id_in_po_statement($tender_id)
{
	$result = $this->conn->query("SELECT tender.tender_office,tender.tender_purchaser,create_purchaser.purchaser_short_name,office.office_code FROM `tender`,`create_purchaser`,`office` WHERE tender.tender_office LIKE office.id AND tender.tender_purchaser LIKE create_purchaser.id AND tender.id LIKE ".$tender_id);
	return $result->fetch_assoc();
	
}
public function List_All_Firms_In_Po_Section()
	{
		//$data = array();
		$str .="<option value=''>Please Select</option>";
		$query_office = $this->conn->query("SELECT `csign_short_name`,`id` FROM `consignee` ");
		while($rock = $query_office->fetch_assoc())
		{
			$str .="<option value=".$rock['id'].">".$rock['csign_short_name']."</option>";
		}
		return $str;
		
		
	}
public function List_All_Firms_In_Po_Section_In_we_have_tender_id($tender_id)
{
	$str .="<option value=''>Please Select</option>";
	$query = $this->conn->query("SELECT DISTINCT tender_firms.firm,consignee.csign_short_name FROM `tender_firms`,`tender_firm_product`,`tender`,`consignee` WHERE tender_firms.product_id LIKE tender_firm_product.id AND tender_firm_product.tender_id LIKE tender.id AND tender.id LIKE '".$tender_id."' AND tender_firms.firm LIKE consignee.id ");
	while($rock = $query->fetch_assoc())
		{
			$str .="<option value=".$rock['firm'].">".$rock['csign_short_name']."</option>";
		}
		return $str;
	}
public function AddOldProductsInPoSectionWithTenderAndFirmId($firm_id,$tender_id)
{
	
	$query = $this->conn->query("SELECT item_manager.id AS `item_id`,item_manager.item_name,item_manager.item_discription,tender_firm_product.unit,tender_firm_product.quantity,tender_firm_product.consignee,tender_firm_product.discription,tender_firms.inspection AS `inspection_in_firm`,tender_firms.rate,tender_firms.taxtype FROM `item_manager`,`tender_firms`,`tender_firm_product`,`tender` WHERE tender_firms.product_id LIKE tender_firm_product.id AND tender_firm_product.category LIKE item_manager.id AND tender_firm_product.tender_id LIKE tender.id AND tender_firms.firm LIKE '".$firm_id."' AND tender.id LIKE '".$tender_id."'");
		while($raw = $query->fetch_assoc())
		{
			$data[]=$raw;
		}
		return $data;
		
}
 public function Po_Registration_Final($tender_number,$tender_office,$tender_purchaser,$data,$finalName,$name,$created_by,$created_table)
 {
	
	 
	 $query = $this->conn->prepare("INSERT INTO `po`(`id`,`tender_type`,`tender_number`,`tender_id`,`tender_office`,`tender_purchaser`,`file_number`,`name_of_firm`,`po_number`,`due_date`,`refi_date`,`extended_date`,`security_deposit`,`security_deposit_text_area`,`created_by`,`created_table`,`updated_by`,`updated_table`) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		$id=NULL;
		$updated_by=NULL;
		$updated_table=NULL;
		if($data['due_date']!='')
		{
		$correct_due_date = explode('/',$data['due_date']);
		$final_due_date=$correct_due_date[2]."-".$correct_due_date[1]."-".$correct_due_date[0];
		}
		else
		{
		$final_due_date='0000-00-00';	
		}
		if($data['refi_date']!='')
		{
		$correct_refi_date = explode('/',$data['refi_date']);
		$final_refi_date=$correct_refi_date[2]."-".$correct_refi_date[1]."-".$correct_refi_date[0];
		}
		else
		{
			$final_refi_date='0000-00-00';
		}
		if($data['extended_date']!='')
		{
		$correct_extended_date = explode('/',$data['extended_date']);
		$final_extended_date=$correct_extended_date[2]."-".$correct_extended_date[1]."-".$correct_extended_date[0];
		}
		else
		{
		$final_extended_date='0000-00-00';	
		}
		if($data['hidden_box_for_tender_id_of_first_optn']=='')
		{
			$tndr_ID = NULL;
		}
		else
		{
			$tndr_ID = $data['hidden_box_for_tender_id_of_first_optn'];
		}
$query->bind_param("iiisiissssssssssss",$id,$data['tender_type'],$tender_number,$tndr_ID,$tender_office,$tender_purchaser,$data['file_number'],$data['name_of_firm'],$data['po_number'],$final_due_date,$final_refi_date,$final_extended_date,$data['security_deposit'],$data['security_deposit_text_area'],$created_by,$created_table,$updated_by,$updated_table);
		$query->execute();
		$query->store_result();
		if($query->error)
		{
			return 0;
		}
		else
		{
			$po_id = $query->insert_id;
		$emp_cnsi=$this->store_po_product_final($data['category'],$data['inspection'],$data['discription'],$data['consignee'],$data['quantity'],$data['unit'],$data['rate'],$data['taxtype'],$data['includingall'],$data['totalvalue'],$data['payment'],$data['paymentother'],$data['payingauthority'],$data['inspectionplace'],$data['deliverydate'],$data['quantitymannual'],$po_id);
			
			$this->store_attachments_after_other($po_id,'po_attachments',$data['File_Big_Re'],$data['Title_Re'],$data['File_Real_Re'],$data['Other_Title_Re']);
			$this->store_attachments_after_other($po_id,'po_attachments',$finalName,$data['titles'],$name,$data['text_on_others']);
			return 1;
		}
		
	 
 }
 public function store_po_product_final($category,$inspection,$discription,$consignee,$quantity,$unit,$rate,$taxtype,$includingall,$totalvalue,$payment,$paymentother,$payingauthority,$inspectionplace,$deliverydate,$quantitymannua,$po_id)
{
	$empty_consignee=1;
	//$status=0;
	
	for($i=0;$i<sizeof($category);$i++)
	{
		
		if($category[$i]!="" && $consignee[$i]!="")
		{
			
			$rest = $category[$i];
			$kk=explode("(",$rest);
			$final=explode(")",$kk[1]);
	$query_firm_product = $this->conn->query("INSERT INTO `po_products`(`po_id`,`category`,`inspection`,`discription`,`consignee`,`quantity`,`unit`,`rate`,`taxtype`,`includingall`,`totalvalue`,`payment`,`paymentother`,`payingauthority`,`inspectionplace`,`deliverydate`,`quantitymannual`) VALUES ('".$po_id."','".$final[0]."','".$inspection[$i]."','".$discription[$i]."','".$consignee[$i]."','".$quantity[$i]."','".$unit[$i]."','".$rate[$i]."','".$taxtype[$i]."','".$includingall[$i]."','".$totalvalue[$i]."','".$payment[$i]."','".$paymentother[$i]."','".$payingauthority[$i]."','".$inspectionplace[$i]."','".$deliverydate[$i]."','".$quantitymannua[$i]."') ");
		
	}
	}
	return $empty_consignee;
}

public function List_All_Firms_In_Po_Section_In_we_have_tender_id_No_Ajax($tender_id)
{
	
	$query = $this->conn->query("SELECT DISTINCT tender_firms.firm,consignee.csign_short_name,consignee.id FROM `tender_firms`,`tender_firm_product`,`tender`,`consignee` WHERE tender_firms.product_id LIKE tender_firm_product.id AND tender_firm_product.tender_id LIKE tender.id AND tender.id LIKE '".$tender_id."' AND tender_firms.firm LIKE consignee.id ");
	while($rock = $query->fetch_assoc())
		{
			$data[]=$rock;
			
		}
		return $data;
	}
	public function common_fetch_attachement_withItem_In_PO($table,$colm,$id)
	{
		$data=array();
		$query=$this->conn->query("SELECT item_manager.item_name, item_manager.item_discription,main_consignee.main_csign_short_name,po_products.* FROM `item_manager`,`po_products`,`main_consignee` WHERE po_products.category LIKE item_manager.id AND po_products.consignee LIKE main_consignee.id AND po_products.po_id LIKE '".$id."' LIMIT 5 ");
		while($raw = $query->fetch_assoc())
		{
			$data[]=$raw;
		}
		return $data;
	}
	
	public function common_fetch_attachement_withItem_In_PO_NO_Limit_Final($table,$colm,$id)
	{
		$data=array();
		$query=$this->conn->query("SELECT item_manager.item_name, item_manager.item_discription,main_consignee.main_csign_short_name,po_products.* FROM `item_manager`,`po_products`,`main_consignee` WHERE po_products.category LIKE item_manager.id AND po_products.consignee LIKE main_consignee.id AND po_products.po_id LIKE '".$id."'");
		while($raw = $query->fetch_assoc())
		{
			$data[]=$raw;
		}
		return $data;
	}
	public function Update_PO_CURRENT_OLD_Attachements($titles,$other_title,$finalName,$name,$id_firm_attachement)
	{
		
		if($finalName==0)
		{
		$query = $this->conn->query("UPDATE `po_attachments` SET `title`='".$titles."',`other_title`='".$other_title."' WHERE `id` LIKE ".$id_firm_attachement);
		
		
		return true;
			
		}
		else
		{
			$query = $this->conn->query("UPDATE `po_attachments` SET `title`='".$titles."',`other_title`='".$other_title."',`file`='".$finalName."',`file_real_name`='".$name."' WHERE `id` LIKE ".$id_firm_attachement);
			return true;
			
		}
		
			
		
		
	}
	public function PO_TYPE($po)
	{
		
		if($po==1)
		return 'Tender';
		else if($po==2)
		return 'Direct';
		else
		return 'Commision';
		
	}
	public function PO_update_final($data,$finalName,$name,$updated_by,$updated_table,$id)
	{
		if(trim($data['due_date'])!='')
		{
		$correct_due_date = explode('/',$data['due_date']);
		$final_due_date=$correct_due_date[2]."-".$correct_due_date[1]."-".$correct_due_date[0];
		}
		else
		{
			$final_due_date='0000-00-00';	
		}
		if(trim($data['refi_date'])!='')
		{
		$correct_refi_date = explode('/',$data['refi_date']);
		$final_refi_date=$correct_refi_date[2]."-".$correct_refi_date[1]."-".$correct_refi_date[0];
		}
		else
		{
			$final_refi_date='0000-00-00';
		}
		if(trim($data['extended_date'])!='')
		{
		$correct_extended_date = explode('/',$data['extended_date']);
		$final_extended_date=$correct_extended_date[2]."-".$correct_extended_date[1]."-".$correct_extended_date[0];
		}
		else
		{
		$final_extended_date='0000-00-00';	
		}
		$query = $this->conn->query("UPDATE `po` SET `file_number`='".$data['file_number']."',`name_of_firm`='".$data['name_of_firm']."',`po_number`='".$data['po_number']."',`due_date`='".$final_due_date."',`refi_date`='".$final_refi_date."',`extended_date`='".$final_extended_date."',`security_deposit`='".$data['security_deposit']."',`security_deposit_text_area`='".$data['security_deposit_text_area']."',`updated_by`='".$updated_by."',`updated_table`='".$updated_table."' WHERE `id` LIKE ".$id);
		
			
		if($query->error)
		{
			return 0;
		}
		else
		{
			//$po_id = $query->insert_id;
		$emp_cnsi=$this->store_po_product_final($data['category'],$data['inspection'],$data['discription'],$data['consignee'],$data['quantity'],$data['unit'],$data['rate'],$data['taxtype'],$data['includingall'],$data['totalvalue'],$data['payment'],$data['paymentother'],$data['payingauthority'],$data['inspectionplace'],$data['deliverydate'],$data['quantitymannual'],$id);
			
			//$this->store_attachments_after_other($po_id,'po_attachments',$data['File_Big_Re'],$data['Title_Re'],$data['File_Real_Re'],$data['Other_Title_Re']);
			$this->store_attachments_after_other($id,'po_attachments',$finalName,$data['titles'],$name,$data['text_on_others']);
			return 1;
		}
		
	}
	public function DynamicFileNumber($ofce_name)
	{
	$random = substr(number_format(time() * rand(),0,'',''),0,10);
	$to_send = $random.'_'.$ofce_name;
	return $to_send;
	}


}


?>