<?php
	session_start();
	include("db_connect.php");
	$db=new DB_Connect();
	$con=$db->connect();
	
	//$fqry="select Email from testcatmaster where TCM_ID='".$_POST["id"]."'";
	//$fresult=mysqli_query($con,$fqry);
	//$frow=mysqli_fetch_array($fresult);
	
	$qry="delete from category where ID='".$_POST["id"]."'";	
			if(mysqli_query($con,$qry)){
					echo "Success";
				}
				else{
					echo "Error";
				}
?>