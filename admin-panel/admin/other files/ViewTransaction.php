<?php
session_start();
	include("db_connect.php");
	$db=new DB_Connect();
	$con=$db->connect();
	
	//$id=$_POST["ID"];
	$qry="Select * from farmer_user_transaction order by ID Desc";
	$run=mysqli_query($con,$qry);
	
	//$run=mysqli_query($con,$qry);
	$i=1;
	$table="";
	$table.="<thead><tr><th>SR.NO</th><th>User</th><th>Order ID</th><th>Total Amount</th><th>Order Status</th><th>Reason</th></tr></thead><tbody>";
	
	while($row=mysqli_fetch_array($run)){
		
	 $query1="SELECT * FROM user_registration WHERE ID='".$row["User_ID"]."'  ";
		$result1=mysqli_query($con,$query1);
		$row1=mysqli_fetch_array($result1);

		
		
		$table.="<tr>";
		$table.="<td>".$i."</td>"; 
		
		$table.="<td id='User_ID".$row["ID"]."'>".$row1["Name"]."</td>";
		$table.="<td id='Order_ID".$row["ID"]."'>".$row["Order_ID"]."</td>";
		$table.="<td id='Total_Amount".$row["ID"]."'>".$row["Total_Amount"]."</td>";
       // $table.="<td id='Transaction_Status".$row["ID"]."'>".$row["Transaction_Status"]."</td>";
        $table.="<td id='Order_Status".$row["ID"]."'>".$row["Order_Status"]."</td>";
		$table.="<input type='hidden' id='Reason".$row["ID"]."' value='".$row["Reason"]."'>";
		
	if($row["Order_Status"]=='Rejected'){
		$table.="<td><a href='javascript:void(0)' onclick='view(".$row["ID"].")'>View</a></td>";
		}
		
		
		
		
		
		$i++;
		$table.="</tr>";
		
	}
	
	
	
	$table.="</tbody>";
	echo $table;
	
	
?>







