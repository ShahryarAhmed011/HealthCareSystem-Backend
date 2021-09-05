<?php 
 
require_once '../includes/DBOperations.php';
 
$response = array(); 
 
if($_SERVER['REQUEST_METHOD']=='POST'){
    if(
			isset($_POST['pid']) and
			isset($_POST['did']) and
			isset($_POST['prescription'])  and
			isset($_POST['diagnosis'])  and
			isset($_POST['note'])  and
			isset($_POST['date']))
        {
        //operate the data further 
 
		$db = new DBOperations; 
        
        $result = ($db-> updatePatientReport($_POST['pid'],
				$_POST['did'],
				$_POST['prescription'],
				$_POST['diagnosis'],
				$_POST['note'],
				$_POST['date']
				));


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