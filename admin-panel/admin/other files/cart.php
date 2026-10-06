<?php
include("db_connect.php");
	$db=new DB_connect();
	$con=$db->connect();
	
	// array for JSON response
$response = array();


    if(isset($_REQUEST['UserID']) && isset($_REQUEST['Product_ID']) && isset($_REQUEST['Quantity']) && isset($_REQUEST['ShippingCharge'])
		&& isset($_REQUEST['Totaltax'])&& isset($_REQUEST['Totalamount'])&& isset($_REQUEST['OrderStatus']) ){
      
    $UserID = $_REQUEST['UserID'];
	$Product_ID = $_REQUEST['Product_ID'];
	$Quantity = $_REQUEST['Quantity'];
	$ShippingCharge	= $_REQUEST['ShippingCharge'];
	$Totaltax=$_REQUEST['Totaltax'];
	$Totalamount= $_REQUEST['Totalamount'];
	$OrderStatus = $_REQUEST['OrderStatus'];
	{
	
    
  	$qry="insert into cart (UserID,Product_ID,Quantity,ShippingCharge,Totaltax,Totalamount,OrderStatus) values ('".$UserID."', '".$Product_ID."'
	, '".$Quantity."', '".$ShippingCharge."', '".$Totaltax."', '".$Totalamount."', '".$OrderStatus."')";
		//echo $qry;
			if($runi=mysqli_query($con,$qry)){
				
					$response["success"] = 1;
					$response["message"] = "Added to cart Successful ";
					echo json_encode($response);
				
			}
			else{
					$response["success"] = 1;
					$response["message"] = "Something went wrong";
					echo json_encode($response);
			}
	}	

		}else {
			// required field is missing
			$response["success"] = 0;
			$response["message"] = "Required field(s) is missing.";
			// echoing JSON response
			echo json_encode($response);
		} 
 
?>