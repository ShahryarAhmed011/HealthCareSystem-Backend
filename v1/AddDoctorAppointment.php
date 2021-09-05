<?php 
 
require_once '../includes/DBOperations.php';
 
$response = array(); 
 
if($_SERVER['REQUEST_METHOD']=='POST'){
    if(
			isset($_POST['did']) and
			isset($_POST['time']) and
			isset($_POST['day']) and
			isset($_POST['availability']))
        {
        //operate the data further 
 
		$db = new DBOperations; 
        
        $result = ($db-> addDoctorAppointment($_POST['did'],
				$_POST['time'],
				$_POST['day'],
				$_POST['availability']));


        if($result == 1){
            $response['error'] = false; 
            $response['message'] = "addDoctorAppointment successfully";
        }elseif($result == 2){
            $response['error'] = true; 
            $response['message'] = "Some error occurred please try again";          
        }elseif($result == 0){
            $response['error'] = true; 
            $response['message'] = "It seems appointments are already added";                     
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