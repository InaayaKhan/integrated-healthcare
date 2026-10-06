<?php
session_start();
	include("db_connect.php");
	$db=new DB_Connect();
	$con=$db->connect();
	
	//$id=$_POST["ID"];
	$qry="Select * from hca_patient_registration order by ID Desc";
	//echo $qry;
	$run=mysqli_query($con,$qry);
	$i=1;
	$table="";
	$table.="<thead><tr><th>#</th><th> Name</th><th>MobileNumber</th><th>Status</th><th>Edit</th><th>Delete</th></tr></thead><tbody>";
	while($row=mysqli_fetch_array($run)){
		
		$table.="<tr>";
		$table.="<td>".$i."</td>"; 
		$table.="<td>".$row["Name"]."</td>";
		$table.="<td>".$row["MobileNumber"]."</td>";
        $table.="<td>".$row["Status"]."</td>";
		$table.="<td><a href='javascript:void(0)' onclick='editRecord(".$row["ID"].")'>Edit</a></td>";
		$table.="<td><a href='javascript:void(0)' onclick='deleteRecord(".$row["ID"].")'>Delete</a></td>";
		
		$i++;
		$table.="</tr>";
	}
	$table.="</tbody>";
	echo $table;
?>
