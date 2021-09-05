<?php 
 
require_once '../includes/DBOperations.php';
 
$response = array(); 
 
if($_SERVER['REQUEST_METHOD']=='POST'){
    if(			
			isset($_POST['doctor_email']) and
			isset($_POST['user_name']) and
			isset($_POST['email']) and
			isset($_POST['password'])  and
			isset($_POST['phone_number'])  and
			isset($_POST['address'])  and
			isset($_POST['gender'])  and
			isset($_POST['date_of_birth']))
        {
        //operate the data further 
 
		$db = new DBOperations; 
        
        $result = ($db-> updateDoctor($_POST['doctor_email'],
				$_POST['user_name'],
				$_POST['email'],
				$_POST['password'],
				$_POST['phone_number'],
				$_POST['address'],
				$_POST['gender'],
				$_POST['date_of_birth']));


        if($result == 1){
            $response['error'] = false; 
            $response['message'] = "Doctor Update successfully";
        }elseif($result == 2){
            $response['error'] = true; 
            $response['message'] = "Some error occurred please try again";          
        }elseif($result == 0){
            $response['error'] = true; 
            $response['message'] = "It seems you are already registered, please choose a different email and username";                     
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