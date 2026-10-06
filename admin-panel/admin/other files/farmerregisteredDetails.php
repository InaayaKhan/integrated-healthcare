<?php
session_start();
	include("db_connect.php");
	$db=new DB_Connect();
	$con=$db->connect();
	
	//$id=$_POST["ID"];
	$qry="Select * from farmer_registration order by ID Desc";
	//echo $qry;
	$run=mysqli_query($con,$qry);
	$i=1;
	$table="";
	$table.="<thead><tr><th>SR.NO</th><th> Name</th><th>MobileNumber</th><th>Status</th><th>Edit</th></tr></thead><tbody>";
	while($row=mysqli_fetch_array($run)){
		
		$table.="<tr>";
		$table.="<td>".$i."</td>"; 
		$table.="<td id='Name".$row["ID"]."'>".$row["Name"]."</td>";
		$table.="<td id='MobileNumber".$row["ID"]."'>".$row["MobileNumber"]."</td>";
	
        $table.="<td id='Status".$row["ID"]."'>".$row["Status"]."</td>";
		$table.="<td><a href='javascript:void(0)' onclick='editRecord(".$row["ID"].")'>Edit</a></td>";
		
		$i++;
		$table.="</tr>";
	}
	$table.="</tbody>";
	echo $table;
?>
