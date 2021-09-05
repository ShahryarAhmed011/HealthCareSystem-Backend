<?php 
 
require_once '../includes/DBOperations.php';
 
$response = array(); 


if($_SERVER['REQUEST_METHOD']=='POST'){
 
  if(isset($_POST['email']) and 
        isset($_POST['password'])){
            
        $db = new DbOperations(); 
 
        if($db->doctorLogin($_POST['email'], $_POST['password'])){
            
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
            
            
            $json = json_encode($response);
            $json = json_decode($json, true);
           // echo "id is-->" +$json;
           
            //echo  $json['id'];
            
           // $doctorID=$response+['id'] = $user['id'];
            
            $myString = $json['id'];
           
           
           $stmst = $db->getDoctorCategory($_POST['id'] = $myString);
           
           if($stmst==20){
               $response['message'] = "Doctor Category Data Not Exist"; 
             
           }else{
                $response['message'] = "Doctor Category Data Exist";  
            
              $response['category'] = $stmst['category'];
              $response['speciality'] = $stmst['speciality'];
               
           }
          
          
          $doctorAppointments = $db->getDoctorAppointments($_POST['did'] = $myString);
            
            $response['error'] = false; 
            $response['AppointmentsData'] = $doctorAppointments;
            
        $patientAppointments = $db->getPatientAppointments($_POST['did'] = $myString);
            
            $response['error'] = false; 
            $response['PatientAppointmentsData'] = $patientAppointments;
        
        
        $patientReports = $db->getPatientReports($_POST['did'] = $myString);
            
            $response['error'] = false; 
            $response['PatientReportsData'] = $patientReports;

            
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