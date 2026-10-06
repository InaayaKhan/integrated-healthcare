<?php
session_start();
	include("db_connect.php");
	$db=new DB_Connect();
	$con=$db->connect();
	
	$qry="Select * from hca_govt_schemes order by ID Desc";
	$run=mysqli_query($con,$qry);
	$i=1;
	$table="";
	$table.="<thead><tr><th>#</th><th>Name</th><th>Start Date</th><th>End Date</th><th>URL</th><th>Edit</th><th>Delete</th></tr></thead><tbody>";
	while($row=mysqli_fetch_array($run)){
		
		$table.="<tr>";
		$table.="<td>".$i."</td>"; 
		$table.="<td>".$row["Name"]."</td>";
		$table.="<td>".$row["StartDate"]."</td>";
		$table.="<td>".$row["EndDate"]."</td>";
		$table.="<td style='text-align:center;'><a href='".$row["Website"]."' target='_blank'><i class='mdi mdi-web'></i></a></td>";
		$table.="<td><a href='javascript:void(0)' onclick='editRecord(".$row["ID"].")'>Edit</a></td>";
		$table.="<td><a href='javascript:void(0)' onclick='deleteRecord(".$row["ID"].")'>Delete</a></td>";
		
		$i++;
		$table.="</tr>";
	}
	$table.="</tbody>";
	echo $table;
?>
