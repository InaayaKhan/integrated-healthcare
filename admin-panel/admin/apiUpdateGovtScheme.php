<?php	
	session_start();
	include("db_connect.php");
	$db=new DB_Connect();
	$con=$db->connect();
	$qry="update hca_govt_schemes set Name='".$_POST["name"]."',StartDate='".$_POST["startdate"]."',EndDate='".$_POST["enddate"]."',Website='".$_POST["url"]."' where ID='".$_POST["id"]."'";
	if(mysqli_query($con,$qry)){
		echo "Success";
	}
	else{
		echo "Error";
	}
?>
