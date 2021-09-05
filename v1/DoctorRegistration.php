<?php 
 
require_once '../includes/DBOperations.php';
 
$response = array(); 
 
if($_SERVER['REQUEST_METHOD']=='POST'){
    if(
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
        
        $result = ($db-> createDoctor($_POST['user_name'],
				$_POST['email'],
				$_POST['password'],
				$_POST['phone_number'],
				$_POST['address'],
				$_POST['gender'],
				$_POST['date_of_birth']));


        if($result == 1){
            $response['error'] = false; 
            $response['message'] = "Doctor registered successfully";
            
            
            
            $user = $db->getDoctorByEmail($_POST['email']);
            
            $response['error'] = false; 
            $response['id'] = $user['id'];
            $response['user_name'] = $user['user_name'];
            $response['email'] = $user['email'];
            $response['password'] = $user['password'];
            $response['phone_number'] = $user['phone_number'];
            $response['address'] = $user['address'];
            $response['gender'] = $user['gender'];
            $response['date_of_birth'] = $user['date_of_birth'];
            
            //---adding default appointment times
            
            $json = json_encode($response);
            $json = json_decode($json, true);
            $doctorID = $json['id'];
           
           
           $stmst = $db->getDoctorCategory($_POST['id'] = $doctorID);
            
            
            $time = "8:00 PM";
            $day = "Monday";
            $availablility = "Available";
            
            $monday = ($db-> addDoctorAppointment($_POST['did'] = $doctorID,
				$_POST['time'] = "8:00 PM",
			    $_POST['day'] = "Monday",
				$_POST['availability'] = "Not Available"));
			
            $tuesday = ($db-> addDoctorAppointment($_POST['did'] = $doctorID,
				$_POST['time'] = "8:00 PM",
			    $_POST['day'] = "Tuesday",
				$_POST['availability'] = "Not Available"));
				
		    $wednesday = ($db-> addDoctorAppointment($_POST['did'] = $doctorID,
				$_POST['time'] = "8:00 PM",
			    $_POST['day'] = "Wednesday",
				$_POST['availability'] = "Not Available"));	
				
			$monday = ($db-> addDoctorAppointment($_POST['did'] = $doctorID,
				$_POST['time'] = "8:00 PM",
			    $_POST['day'] = "Thursday",
				$_POST['availability'] = "Not Available"));
            
            $friday = ($db-> addDoctorAppointment($_POST['did'] = $doctorID,
				$_POST['time'] = "8:00 PM",
			    $_POST['day'] = "Friday",
				$_POST['availability'] = "Not Available"));
				
			$saturday = ($db-> addDoctorAppointment($_POST['did'] = $doctorID,
				$_POST['time'] = "8:00 PM",
			    $_POST['day'] = "Saturday",
				$_POST['availability'] = "Not Available"));
				
			$sunday = ($db-> addDoctorAppointment($_POST['did'] = $doctorID,
				$_POST['time'] = "8:00 PM",
			    $_POST['day'] = "Sunday",
				$_POST['availability'] = "Not Available"));	
            
            
           
            
            
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