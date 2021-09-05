 <?php 
 
 
    class DBOperations{
 
        private $con; 
 
        function __construct(){
 
           /* require_once dirname(__FILE__).'/DBConnect.php';
 */
            require 'DBConnect.php';
            $db = new DBConnect();
 
            $this->con = $db->connect();
 
        }
 
    /*CREATE */
 
        public function createPatient($user_name,$email,$password){
           
            if($this->isUserExist($email,$password)){
                return 0; 
            }else{
               
               
              
               $stmt = $this->con->prepare("INSERT INTO `patients` (`id`, `user_name`, `email`, `password`) 
											VALUES (NULL, ?, ?, ?);
											");
                
               
                $stmt->bind_param("sss",$user_name,$email,$password);
     
               
               
               
               
/*               
 //0---------------------------------edited
    if (!$stmt) {
        echo "false";
        print_r($this->con->error);
    }
    else {
                $stmt->bind_param("ssssssssssss",$retailer_name,$nic,$phone_number,$email,$password,$img_url,$store_name,$latitude,$longitude,$store_location,$timestamp,$online_status);
     print_r($this->con->error);
    
     $stmt->execute();
       
        
    }//0---------------------------------edited*/
 
 
 
 
                if($stmt->execute()){
                    return 1; 
                }else{
                    return 2; 
                }
            }
        }
 
        public function userLogin($email, $password){
            $stmt = $this->con->prepare("SELECT id FROM patients WHERE email = ? AND BINARY password = ?");
            $stmt->bind_param("ss",$email,$password);
            $stmt->execute();
            $stmt->store_result(); 
            return $stmt->num_rows > 0; 
        }
 
        public function getUserByEmail($email){
            $stmt = $this->con->prepare("SELECT * FROM patients WHERE email = ?");
            $stmt->bind_param("s",$email);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        }
         
 
        private function isUserExist($email, $password){
            $stmt = $this->con->prepare("SELECT id FROM patients WHERE email = ? OR password = ?");
            $stmt->bind_param("ss", $email, $password);
            $stmt->execute(); 
            $stmt->store_result(); 
            return $stmt->num_rows > 0; 
        }
        
        
        
        	/* changes----------------------- */
 
  public function createDoctor($user_name,$email,$password,$phone_number,$address,$gender,$date_of_birth){
           
            if($this->isDoctorExist($email,$password)){
                return 0; 
            }else{
               
               $stmt = $this->con->prepare("INSERT INTO `doctor` (`id`, `user_name`, `email`, `password`, `phone_number`, `address`, `gender`, `date_Of_birth`) 
											VALUES (NULL, ?, ?, ?, ?, ?, ?, ?);
											");
                
               
                $stmt->bind_param("sssssss",$user_name,$email,$password,$phone_number,$address,$gender,$date_of_birth);
     
                if($stmt->execute()){
                    return 1; 
                }else{
                    return 2; 
                }
            }
        }
        
        
 public function createPharmacist($user_name,$email,$password){
           
            if($this->isPharmacistExist($email,$password)){
                return 0; 
            }else{
               
               $stmt = $this->con->prepare("INSERT INTO `pharmacist` (`id`, `user_name`, `email`, `password`) 
											VALUES (NULL, ?, ?, ?);
											");
                
               
                $stmt->bind_param("sss",$user_name,$email,$password);
     
                if($stmt->execute()){
                    return 1; 
                }else{
                    return 2; 
                }
            }
        }
        
        
        /* changes----------------------- */	
		public function doctorLogin($email, $password){
            $stmt = $this->con->prepare("SELECT id FROM doctor WHERE email = ? AND BINARY password = ?");
            $stmt->bind_param("ss",$email,$password);
            $stmt->execute();
            $stmt->store_result(); 
            return $stmt->num_rows > 0; 
        }
		
		public function pharmacistLogin($email, $password){
            $stmt = $this->con->prepare("SELECT id FROM pharmacist WHERE email = ? AND BINARY password = ?");
            $stmt->bind_param("ss",$email,$password);
            $stmt->execute();
            $stmt->store_result(); 
            return $stmt->num_rows > 0; 
        }
 
        
        
        public function getDoctorByEmail($email){
            $stmt = $this->con->prepare("SELECT * FROM doctor WHERE email = ?");
            $stmt->bind_param("s",$email);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        }
		
		public function getPharmacistByEmail($email){
            $stmt = $this->con->prepare("SELECT * FROM pharmacist WHERE email = ?");
            $stmt->bind_param("s",$email);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        }
        
        private function isDoctorExist($email, $password){
            $stmt = $this->con->prepare("SELECT id FROM doctor WHERE email = ? OR password = ?");
            $stmt->bind_param("ss", $email, $password);
            $stmt->execute(); 
            $stmt->store_result(); 
            return $stmt->num_rows > 0; 
        }
		
		private function isPharmacistExist($email, $password){
            $stmt = $this->con->prepare("SELECT id FROM pharmacist WHERE email = ? OR password = ?");
            $stmt->bind_param("ss", $email, $password);
            $stmt->execute(); 
            $stmt->store_result(); 
            return $stmt->num_rows > 0; 
        }
        
        /*-----------------Update--------------- */
        
       public function updateDoctor($user_email, $user_name,$email,$password,$phone_number,$address,$gender,$date_of_birth){
           
    
                $SQL = $this->con->prepare("UPDATE doctor SET user_name=?, email=?, password=?, phone_number=?, address=?, gender=?,date_of_birth=? WHERE email=?");

                $SQL->bind_param('ssssssss', $user_name, $email, $password, $phone_number, $address, $gender, $date_of_birth, $user_email);
                
                $SQL->execute();
         
                if($SQL->execute()){
                    return 1; 
                }else{
                    return 2; 
                }
        
        }
        
        /*             */
        public function addDoctorCategory($did, $email, $category,$speciality){
           
            if($this->isDoctorIDExist($did)){
                
                 $SQL = $this->con->prepare("UPDATE DoctorCategory SET email=?, category=?, speciality=? WHERE did=?");

                $SQL->bind_param('ssss', $email, $category, $speciality, $did);
                
                $SQL->execute();
         
                if($SQL->execute()){
                    return 3; 
                }else{
                    return 4; 
                }
        
                
                 /*updateDoctorCategory($did, $email, $category,$speciality);*/
                
                /*return 0; */
            }else{
               
               $stmt = $this->con->prepare("INSERT INTO `DoctorCategory` (`did`, `email`, `category`, `speciality`) 
											VALUES (?, ?, ?, ?);
											");
                
               
                $stmt->bind_param("ssss",$did,$email,$category, $speciality);
     
                if($stmt->execute()){
                    return 1; 
                }else{
                    return 2; 
                }
            }
        }
        
        
        private function isDoctorIDExist($did){
            $stmt = $this->con->prepare("SELECT did FROM DoctorCategory WHERE did = ?");
            $stmt->bind_param("s", $did);
            $stmt->execute(); 
            $stmt->store_result(); 
            return $stmt->num_rows > 0; 
        }
        
        public function updateDoctorCategory($did, $email, $category,$speciality){
           
    
      $SQL = $this->con->prepare("UPDATE DoctorCategory SET email=?, category=?, speciality=? WHERE did=?");

                $SQL->bind_param('ssss', $email, $category, $speciality, $did);
                
                $SQL->execute();
         
                if($SQL->execute()){
                    return 1; 
                }else{
                    return 2; 
                }
        
        }
        
        
        private function isDoctorCategoryExist($did){
            $stmt = $this->con->prepare("SELECT did FROM DoctorCategory WHERE did = ?");
            $stmt->bind_param("s", $did);
            $stmt->execute(); 
            $stmt->store_result(); 
            return $stmt->num_rows > 0; 
        }
        
        
        public function getDoctorCategory($did){
             if($this->isDoctorIDExist($did)){
               
                 $stmt = $this->con->prepare("SELECT * FROM DoctorCategory WHERE did = ?");
                 $stmt->bind_param("s",$did);
                 $stmt->execute();
                 return $stmt->get_result()->fetch_assoc();
               
                // return 10;
             }else{
                 return 20;
             }
            
        }
        
//------------doctor appointment---
        
        
        public function addDoctorAppointment($did, $time, $day,$availability){
           
      
               
               $stmt = $this->con->prepare("INSERT INTO `DoctorAppointment` (`did`, `time`, `day`, `availablity`)
											VALUES (?, ?, ?, ?);
											");
                
               
                $stmt->bind_param("ssss",$did,$time,$day, $availability);
     
                if($stmt->execute()){
                    return 1; 
                }else{
                    return 2; 
                }
            
        }
        
        
        //-----update doctor appointment
        
    public function updateDoctorAppointment($did, $time, $day,$availability){
        
        if(!$this->isDoctorAppointmentExist($did)){
            
            return 2;
           // echo 'this called';
            
        }else{
          //  echo 'this called';
    
      $SQL = $this->con->prepare("UPDATE DoctorAppointment SET time=?, availablity=? WHERE did=? AND day=?");


                 if($SQL !== FALSE) {
                
                $SQL->bind_param('ssss', $time, $availability, $did, $day);
                $SQL->execute();
                
          
             
             if (!$SQL->affected_rows)
                {
                return 3;    
                }else{
                 
                
                if($SQL->execute()){
                    return 1; 
                }else{
                     // echo 'sql else excute';
                    return 2; 
                }
                }
                
                     
                 }else{
                    echo "Wrong Query";
                }
            
        }
                
        }
        
        
        private function isDoctorAppointmentExist($did){
            $stmt = $this->con->prepare("SELECT did FROM DoctorAppointment WHERE did = ?");
            $stmt->bind_param("s", $did);
            $stmt->execute(); 
            $stmt->store_result(); 
            echo $stmt->num_rows > 0;
            return $stmt->num_rows > 0; 
    
        }
        
        
        public function getDoctorAppointments($did){
            $stmt = $this->con->prepare("SELECT did,time,day,availablity FROM DoctorAppointment WHERE did = ?");
            $stmt->execute();
            $arr = array();//new
            $stmt->bind_param("s",$did);
            $stmt->execute();
            //return $stmt->get_result()->fetch_assoc();
            
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            
            
            /*while ( $stmt->fetch() ) {
             $arr[] = $stmt->fetch();;
            }
            return $arr;
         */   
            
            
            
        }
        
        public function getPatientAppointments($did){
            $stmt = $this->con->prepare("SELECT pid,did,patientName,time,day FROM PatientAppointments WHERE did = ?");
            $stmt->execute();
            $arr = array();//new
            $stmt->bind_param("s",$did);
            $stmt->execute();
         
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            
          
            
            
        }
        
        public function deletePatientAppointments($pid){
            $stmt = $this->con->prepare("DELETE FROM PatientAppointments WHERE pid = ?");
          
            $stmt->bind_param("s",$pid);
          
            if($stmt->execute()){
                    return 0; 
                }else{
                     // echo 'sql else excute';
                    return 1; 
                }
            
        }
        
        //--------Add Patient Report
        public function updatePatientReport($pid, $did, $prescription, $diagnosis, $note, $date){
        
      $SQL = $this->con->prepare("UPDATE PatientReports SET prescription=?, diagnosis=?, note=?, date=? WHERE pid=? AND did=?");
        
        if($SQL !== FALSE) {
                $SQL->bind_param('ssssss', $prescription, $diagnosis, $note, $date, $pid, $did);
                $SQL->execute();
             
             if (!$SQL->affected_rows)
                {
                return 0;    
                }else{
               // return 1;  
                }
            
                 }else{
                     return 1;
                    echo "Wrong Query";
                }
            
        }
        
        public function getPatientReports($did){
            $stmt = $this->con->prepare("SELECT pid,did,patientName,prescription,diagnosis,note,date FROM PatientReports WHERE did = ?");
            $stmt->execute();
            $arr = array();//new
            $stmt->bind_param("s",$did);
            $stmt->execute();
         
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        
        }
 
    }