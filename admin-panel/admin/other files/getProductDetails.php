<?php
session_start();
	include("db_connect.php");
	$db=new DB_Connect();
	$con=$db->connect();
	
	//$id=$_POST["ID"];
	$qry="Select * from product where Category_ID='".$_POST["id"]."'";
	echo $qry;
	$run=mysqli_query($con,$qry);
	$i=1;
	$table="";
	$table.="<thead><tr><th>SR.NO</th><th>Product Image</th><th>Product Name</th><th>Status</th><th>Edit</th><th>Delete</th></tr></thead><tbody>";
	while($row=mysqli_fetch_array($run)){
	
		
		$table.="<tr>";
		$table.="<td>".$i."</td>"; 
		$table.="<td  id='Product_Photo".$row["ID"]."'><img src='../Product/".$row["Product_Photo"]."' height='25px !important' width='25px !important'' style='border-radius: 0;></td>";
		$table.="<input type='hidden' id='C_Product_Photo".$row["ID"]."' value='".$row["Product_Photo"]."'>";
		$table.="<input type='hidden' id='Product_Description".$row["ID"]."' value='".$row["Product_Description"]."'>";
		
		$table.="<td id='Product_Name".$row["ID"]."'>".$row["Product_Name"]."</td>";
	//	$table.="<td id='Product_Description".$row["ID"]."'>".$row["Product_Description"]."</td>";
		$table.="<td id='Status".$row["ID"]."'>".$row["Status"]."</td>";
		$table.="<td><a href='javascript:void(0)' onclick='editRecord(".$row["ID"].")'>Edit</a></td>";
		$table.="<td><a href='javascript:void(0)' onclick='deleteRecord(".$row["ID"].")'>Delete</a></td>";
		$i++;
		$table.="</tr>";
	}
	$table.="</tbody>";
	echo $table;
?>
