<?php 
 
require_once '../includes/DBOperations.php';
 
$response = array(); 
 
if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['pid'])){
        //operate the data further 
 
		$db = new DBOperations; 
        
        $result = ($db-> deletePatientAppointments($_POST['pid']));

        if($result == 0){
            $response['error'] = false; 
            $response['message'] = "Request Successful";
        }elseif($result == 1){
            $response['error'] = true; 
            $response['message'] = "Some error occurred please try again";          
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