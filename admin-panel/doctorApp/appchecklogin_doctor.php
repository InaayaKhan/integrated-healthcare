<?php
include("db_connect.php");
	$db=new DB_connect();
	$con=$db->connect();
	
	// array for JSON response
$response = array();
 
// check for required fields
if (isset($_REQUEST['MobileNumber']) && isset($_REQUEST['Password'])  ) {
 
    
   
	$MobileNumber = $_REQUEST['MobileNumber'];
	$Password = $_REQUEST['Password'];
	

	
		$qry="SELECT COUNT(*) as cnt from hca_doctor_registration WHERE MobileNumber='".$MobileNumber."' and Password ='".$Password."'";
		//echo $qry;

        $asd=mysqli_query($con,$qry);
        $zxc=mysqli_fetch_array($asd);


			if($zxc["cnt"]==1){
				
					$qry1="SELECT ID,Status from hca_doctor_registration WHERE MobileNumber='".$MobileNumber."'";
					//echo $qry;

					$asd1=mysqli_query($con,$qry1);
					$zxc1=mysqli_fetch_array($asd1);
					if ($zxc1["Status"]=="On")
					{
						$response["success"] = 1;
						$response["message"] = "Login Successful-".$zxc1["ID"];
						echo json_encode($response);
					}
					else if($zxc1["Status"]=="Pending")
					{
						$response["success"] = 0;
						$response["message"] = "Account under verification, please check again later";
						echo json_encode($response);
					}
					else if($zxc1["Status"]=="Off")
					{
						$response["success"] = 0;
						$response["message"] = "Account blocked, please contact admin";
						echo json_encode($response);
					}
				
			}
			else{
					$response["success"] = 0;
					$response["message"] = "Invalid Username and password";
					echo json_encode($response);
			}
		

		}else {
			// required field is missing
			$response["success"] = 0;
			$response["message"] = "Required field(s) is missing.";
			// echoing JSON response
			echo json_encode($response);
		} 
		

 
?>