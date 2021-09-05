<?php

	class DBConnect{

		private $con;

		function _construct(){

		}

		function connect(){
		
		/*	include_once dirname(_file_).'/constants.php';
		*/
		
		    include 'Constants.php';
		
			$this->con = new mysqli(DB_HostName,DB_User,DB_Password,DB_Name);




			if(mysqli_connect_error()){
				echo "Faild To Connect With Database".mysqli_connect_error;
			}

			return $this->con;

		}

	}
	/*	echo "Connection Successful!!!";*/

?>