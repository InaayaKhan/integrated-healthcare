<?php
include("db_connect.php");
	$db=new DB_connect();
	$con=$db->connect();
	
	// array for JSON response
$response = array();
 
// check for required fields
if (isset($_REQUEST['Name']) && isset($_REQUEST['MobileNumber']) && isset($_REQUEST['Password']) && isset($_REQUEST['Status']) ) {
 
    
    $Name = $_REQUEST['Name'];
	$MobileNumber = $_REQUEST['MobileNumber'];
	$Password = $_REQUEST['Password'];
	$Status = $_REQUEST['Status'];

	$count = 0;
	$qry1="SELECT COUNT(*) as cnt from user_registration WHERE MobileNumber ='".$MobileNumber."' ";
    $asd=mysqli_query($con,$qry1);
    $zxc=mysqli_fetch_array($asd);
    if($zxc["cnt"]==1){
      
		$response["success"] = 3;
		$response["message"] = "User already exists ";
		echo json_encode($response);
	
    
    }else{
		$qry="insert into user_registration (Name,MobileNumber,Password,Status) values ('".$Name."', '".$MobileNumber."', '".$Password."', '".$Status."')";
		//echo $qry;
			if($runi=mysqli_query($con,$qry)){
				
					$response["success"] = 1;
					$response["message"] = "Registrtation Successful ";
					echo json_encode($response);
				
			}
			else{
					$response["success"] = 2;
					$response["message"] = "Something went wrong";
					echo json_encode($response);
			}
		
		}
}
else {
			// required field is missing
			$response["success"] = 0;
			$response["message"] = "Required field(s) is missing.";
			// echoing JSON response
			echo json_encode($response);
		} 
		

 
?>