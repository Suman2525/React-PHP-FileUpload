<?php
/**
 * 
 */
class SignUpModel extends CI_Model
{
	function insertUserData($name,$gender,$dob,$address,$contact,$email,$password,$language,$country){

		$tuple=array('id' =>'' ,
		'name'=>$name,
		'gender'=>$gender,
		'dob'=>$dob,
		'address'=>$address,
		'contact'=>$contact,
		'email'=>$email,
		'password'=>$password,
		'language'=>$language,
		'country'=>$country,
		 );

		return($this->db->insert('signup', $tuple));
	}

	function uploadUserFile($myFiles){
		$tuple=array('id'=>'',
		'documents'=>$myFiles);
		return ($this->db->insert('tbl_file', $tuple));
	}

	function getUploadFile(){
		$qry = $this->db->query("SELECT * FROM tbl_file") ;
		return $qry->result();
	}
}
?>