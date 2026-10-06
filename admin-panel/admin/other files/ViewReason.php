<?php 
include("db_connect.php");
	$db=new DB_connect();
	$con=$db->connect();
	$response = array();
	
	$query="SELECT * FROM `farmer_user_transaction`   ";		
	$result=mysqli_query($con,$query);
	$row=mysqli_fetch_array($result);

	if(["Reason"]=='Rejected'){
		
		while($row=mysqli_fetch_array($result)){
	
		    array_push($response,array('Reason'=>$row["Reason"]));
		}
		echo json_encode(array('response'=>$response));
	
	}else(["Reason"]!='Rejected'){
		echo "No reason";
	}
	// array for JSON response
	
	/* if(isset($_REQUEST['User_ID'])){
			$User_ID = $_REQUEST['User_ID']; */
			
	
	// check for required fields
		

?>