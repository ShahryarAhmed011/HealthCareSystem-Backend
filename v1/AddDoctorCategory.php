<?php 
 
require_once '../includes/DBOperations.php';
 
$response = array(); 
 
if($_SERVER['REQUEST_METHOD']=='POST'){
    if(
			isset($_POST['did']) and
			isset($_POST['email']) and
			isset($_POST['category'])  and
			isset($_POST['speciality']))
        {
        //operate the data further 
 
		$db = new DBOperations; 
        
        $result = ($db-> addDoctorCategory($_POST['did'],
				$_POST['email'],
				$_POST['category'],
				$_POST['speciality']));


        if($result == 1){
            $response['error'] = false; 
            $response['message'] = "Doctor Category Added successfully";
        }elseif($result == 2){
            $response['error'] = true; 
            $response['message'] = "Some error occurred please try again";          
        }elseif($result == 0){
            $response['error'] = true; 
            $response['message'] = "It seems doctor category already added, please choose a different doctor id";                     
        }elseif($result == 3){
            $response['error'] = true; 
            $response['message'] = "Update Successful";                     
        }elseif($result == 4){
            $response['error'] = true; 
            $response['message'] = "Unknown Error";                     
        }
        
 
    }else{
        $response['error'] = true; 
        $response['message'] = "Required fields are missing";
    }
}else{
    $response['error'] = true; 
    $response['message'] = "Invalid Request";
}
 
echo json_encode($response);