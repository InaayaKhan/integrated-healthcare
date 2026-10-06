<?php
session_start();
	include("db_connect.php");
	$db=new DB_Connect();
	$con=$db->connect();
	
	//$id=$_POST["ID"];
	$qry="Select * from user_order_details order by ID Desc";
	//echo $qry;
	$run=mysqli_query($con,$qry);
	$i=1;
	$table="";
	$table.="<thead><tr><th>SR.NO</th><th>Order ID</th><th> Name</th><th>Total Quantity</th><th>Total Amount</th><th>Order Status</th><th>Date</th><th>View</th></tr></thead><tbody>";
	while($row=mysqli_fetch_array($run)){
		
		$qry1="Select * from user_registration where ID=".$row["User_ID"]."";
		//echo $qry1;
		$run1=mysqli_query($con,$qry1);
		$row1=mysqli_fetch_array($run1);
		
		$table.="<tr>";
		$table.="<td>".$i."</td>"; 
		$table.="<td id='Order_ID".$row["ID"]."'>".$row["Order_ID"]."</td>";
		$table.="<td id='Name".$row1["Name"]."'>".$row1["Name"]."</td>";
		
        $table.="<td id='Total_Quantity".$row["ID"]."'>".$row["Total_Quantity"]."</td>";
		
        $table.="<td id='Total_Amount".$row["ID"]."'>".$row["Total_Amount"]."</td>";
		$table.="<td id='Order_Status".$row["ID"]."'>".$row["Order_Status"]."</td>";
	
        $table.="<td id='Date".$row["ID"]."'>".$row["Date"]."</td>";
		$table.="<td><a href='javascript:void(0)' onclick='editRecord(".$row["ID"].")'>View</a></td>";
		
		$i++;
		$table.="</tr>";
	}
	$table.="</tbody>";
	echo $table;
?>
