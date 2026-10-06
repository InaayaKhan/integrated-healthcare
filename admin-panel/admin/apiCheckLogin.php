<?php
	session_start();
	include("db_connect.php");
	$db=new DB_Connect();
	$con=$db->connect();
	
	$username=$_POST["username"];
	$password=$_POST["password"];
	
	$qry="select count(*) from hca_admin_login where username='".$username."' and password='".$password."' and Status='On'" ;
	$count=0;
	$run=mysqli_query($con,$qry);
	$result=mysqli_fetch_array($run);
	if($result[0]>0){
		
		$qry1="select * from hca_admin_login where username='".$username."' and password='".$password."' and Status='On'" ;
		$run1=mysqli_query($con,$qry1);
		$result1=mysqli_fetch_array($run1);
		$_SESSION["username"]=$result1["ID"];
		echo "Success";
	}
	else{
		echo "Error";
	}
	
?>