<?php 
 
require_once '../includes/DBOperations.php';
 
$response = array(); 
 
if($_SERVER['REQUEST_METHOD']=='POST'){
    if(
			isset($_POST['did']) and
			isset($_POST['monTime']) and
			isset($_POST['monAvailability']) and
			
			isset($_POST['tueTime']) and
			isset($_POST['tueAvailability']) and
			
			isset($_POST['wedTime']) and
			isset($_POST['wedAvailability']) and
			
			isset($_POST['thurTime']) and
			isset($_POST['thurAvailability']) and
			
			isset($_POST['friTime']) and
			isset($_POST['friAvailability']) and
			
			isset($_POST['satTime']) and
			isset($_POST['satAvailability']) and
			
			isset($_POST['sunTime']) and
			isset($_POST['sunAvailability'])
			
			)
        {
        //operate the data further 
 
		$db = new DBOperations; 
        
/*        $monday = "Monday";
        $monday = "Tuesday";
        $monday = "Wednesday";
        $monday = "Thursday";
        $monday = "Friday";
        $monday = "Saturday";
        $monday = "Sunday";*/
        
            
           // $monday = ($db-> addDoctorAppointment($_POST['did'] = $doctorID,
        
        
        $result = ($db-> updateDoctorAppointment($_POST['did'],
				$_POST['monTime'],
				$_POST['day'] = "Monday",
				$_POST['monAvailability']));
				
		$tue = ($db-> updateDoctorAppointment($_POST['did'],
				$_POST['tueTime'],
				$_POST['day'] = "Tuesday",
				$_POST['tueAvailability']));
				
		$wed = ($db-> updateDoctorAppointment($_POST['did'],
				$_POST['wedTime'],
				$_POST['day'] = "Wednesday",
				$_POST['wedAvailability']));
				
		$thur = ($db-> updateDoctorAppointment($_POST['did'],
				$_POST['thurTime'],
				$_POST['day'] = "Thursday",
				$_POST['thurAvailability']));
				
		$fri = ($db-> updateDoctorAppointment($_POST['did'],
				$_POST['friTime'],
				$_POST['day'] = "Friday",
				$_POST['friAvailability']));
				
		$sat = ($db-> updateDoctorAppointment($_POST['did'],
				$_POST['satTime'],
				$_POST['day'] = "Saturday",
				$_POST['satAvailability']));
				
		$sun = ($db-> updateDoctorAppointment($_POST['did'],
				$_POST['sunTime'],
				$_POST['day'] = "Sunday",
				$_POST['sunAvailability']));



        if($result == 1){
            $response['Monday error'] = false; 
            $response['Monday message'] = "Monday update successfully";
        }elseif($result == 2){
            $response['Monday error'] = true; 
            $response['Monday message'] = "Monday Doctor Not Exist";          
        }elseif($result == 3){
            $response['Monday error'] = true; 
            $response['Monday message'] = "Monday Data Already Exist Or Update Failed";          
        }
        
        if($tue == 1){
            $response['Tuesday error'] = false; 
            $response['Tuesday message'] = "Tuesday Update successfully";
        }elseif($tue == 2){
            $response['Tuesday error'] = true; 
            $response['Tuesday message'] = "Tuesday Doctor Not Exist";          
        }elseif($tue == 3){
            $response['Tuesday error'] = true; 
            $response['Tuesday message'] = "Tuesday Data Already Exist Or Update Failed";          
        }

         if($wed == 1){
            $response['Wednesday error'] = false; 
            $response['Wednesday message'] = "Wednesday Update successfully";
        }elseif($wed == 2){
            $response['Wednesday error'] = true; 
            $response['Wednesday message'] = "Wednesday Doctor Not Exist";          
        }elseif($wed == 3){
            $response['Wednesday error'] = true; 
            $response['Wednesday message'] = "Wednesday Data Already Exist Or Update Failed";          
        }

        if($thur == 1){
            $response['Thursday error'] = false; 
            $response['Thursday message'] = "Thursday Update successfully";
        }elseif($thur == 2){
            $response['Thursday error'] = true; 
            $response['Thursday message'] = "Thursday Doctor Not Exist";          
        }elseif($thur == 3){
            $response['Thursday error'] = true; 
            $response['Thursday message'] = "Thursday Data Already Exist Or Update Failed";          
        }
        
         if($fri == 1){
            $response['Friday error'] = false; 
            $response['Friday message'] = "Friday Update successfully";
        }elseif($fri == 2){
            $response['Friday error'] = true; 
            $response['Friday message'] = "Friday Doctor Not Exist";          
        }elseif($fri == 3){
            $response['Friday error'] = true; 
            $response['Friday message'] = "Friday Data Already Exist Or Update Failed";          
        }
        
        if($sat == 1){
            $response['Saturday error'] = false; 
            $response['Saturday message'] = "Saturday Update successfully";
        }elseif($sat == 2){
            $response['Saturday error'] = true; 
            $response['Saturday message'] = "Saturday Doctor Not Exist";          
        }elseif($sat == 3){
            $response['Saturday error'] = true; 
            $response['Saturday message'] = "Saturday Data Already Exist Or Update Failed";          
        }
        
         if($sun == 1){
            $response['Sunday error'] = false; 
            $response['Sunday message'] = "Sunday Update successfully";
        }elseif($sun == 2){
            $response['Sunday error'] = true; 
            $response['Sunday message'] = "Sunday Doctor Not Exist";          
        }elseif($sun == 3){
            $response['Sunday error'] = true; 
            $response['Sunday message'] = "Sunday Data Already Exist Or Update Failed";          
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