<?php	
	session_start();
	include("db_connect.php");
	$db=new DB_Connect();
	$con=$db->connect();

			$qry="update user_registration  set Status='".$_POST["Status"]."' where ID='".$_POST["id"]."'";
			// echo $qry;
			 
			if(mysqli_query($con,$qry)){
				echo "Success";
			}
			else{
				echo "Error";
			}
	

	
?>
