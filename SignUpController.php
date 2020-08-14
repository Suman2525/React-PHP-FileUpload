<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT");
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Credentials', 'true');
header("Access-Control-Allow-Headers: Content-Type, Origin, Accept, Authorization, X-Requested-With");
header("HTTP/1.1 200 OK");

/**
 * 
 */
class SignUpController extends CI_Controller
{
	
	function __construct()
	{

		parent::__construct();
		$this->load->model('SignUpModel');
	}

	function test(){
		echo "string";
	}

	function insertData(){

		$data = json_decode(file_get_contents('php://input'));
		$insertUser = $this->SignUpModel->insertUserData($data->name, $data->gender, $data->dob, $data->address, $data->contact, $data->email, md5($data->password), implode(",",$data->language), $data->country);

        if($insertUser){        
            echo json_encode(["success"=>"1","msg"=>"User Inserted."]);
        }
        else{
            echo json_encode(["success"=>"0","msg"=>"User Not Inserted!"]);
        }
	}

	function uploadFile(){

		$flag = 0;
        $err='';
        $config = array(
            'upload_path'   => './uploads/',
            'allowed_types' => 'jpg|gif|png',
            'overwrite'     => 1,                       
        );

        $this->load->library('upload', $config);

        $files = $_FILES;
        // print_r(implode(",",$files['files']['name']));
        $myFiles = implode(",",$files['files']['name']);

    	for($i=0; $i< count($files['files']['name']); $i++)
    	{           
        	$_FILES['files']['name']= $files['files']['name'][$i];
        	$_FILES['files']['type']= $files['files']['type'][$i];
        	$_FILES['files']['tmp_name']= $files['files']['tmp_name'][$i];
        	$_FILES['files']['error']= $files['files']['error'][$i];
        	$_FILES['files']['size']= $files['files']['size'][$i];    

        	$this->upload->initialize($config);

        	if($this->upload->do_upload('files')){
        		$flag=0;
        		$insertFile = $this->SignUpModel->uploadUserFile($files['files']['name'][$i]);  
        	}
        	else{
        		$flag=1;
        		// $err=$this->upload->display_errors();
        		// $err=substr($err, 1, (strlen($err)-1));
        	}
    	}

        if($flag==0){     
        	// $insertFile = $this->SignUpModel->uploadUserFile($myFiles);  
            echo json_encode(["success"=>"1","msg"=>"File Uploaded"]);
        }
        else{
            echo json_encode(["success"=>"0","msg"=>"File type not allowed! Allowed types are jpg,gif,png"]);
        }
        
	}

	function getFile(){
		$file_data=$this->SignUpModel->getUploadFile();
		// print_r($file_data);
		// foreach ($file_data as $value) {
		// 	echo $value->documents;
		// }
		echo json_encode(["success"=>"1", "fileData"=>$file_data]);
	}
}
?>