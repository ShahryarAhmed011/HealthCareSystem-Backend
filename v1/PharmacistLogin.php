<?php 
 
require_once '../includes/DBOperations.php';
 
$response = array(); 


if($_SERVER['REQUEST_METHOD']=='POST'){
 
  if(isset($_POST['email']) and 
        isset($_POST['password'])){
            
        $db = new DbOperations(); 
 
        if($db->pharmacistLogin($_POST['email'], $_POST['password'])){
            
            $user = $db->getPharmacistByEmail($_POST['email']);
            
            $response['error'] = false; 
            $response['id'] = $user['id'];
            $response['user_name'] = $user['user_name'];
            $response['email'] = $user['email'];
            $response['password'] = $user['password'];
            
            
        }else{
            $response['error'] = true; 
            $response['message'] = "Invalid username or password";          
        }
 
    }else{
        $response['error'] = true; 
        $response['message'] = "Required fields are missing";
    }
}
 
echo json_encode($response);