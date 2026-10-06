<?php	
	session_start();
	include("db_connect.php");
	$db=new DB_Connect();
	$con=$db->connect();
	$qry="insert into hca_govt_schemes(Name, StartDate, EndDate, Website) values('".$_POST["name"]."','".$_POST["startdate"]."','".$_POST["enddate"]."','".$_POST["url"]."')";
	if(mysqli_query($con,$qry)){
		echo "Success";
	}
	else{
		echo "Error";
	}
?>
