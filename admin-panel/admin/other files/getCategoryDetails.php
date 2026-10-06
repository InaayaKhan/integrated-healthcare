<?php
session_start();
	include("db_connect.php");
	$db=new DB_Connect();
	$con=$db->connect();
	
	//$id=$_POST["ID"];
	$qry="Select * from category order by ID Desc";
	//echo $qry;
	$run=mysqli_query($con,$qry);
	$i=1;
	$table="";
	$table.="<thead><tr><th>SR.NO</th><th>Category Name</th><th>Category Image</th><th>Status</th><th>Edit</th><th>Delete</th><th>Add Product</th></tr></thead><tbody>";
	while($row=mysqli_fetch_array($run)){
		
		$table.="<tr>";
		$table.="<td>".$i."</td>"; 
		$table.="<td id='Category_Name".$row["ID"]."'>".$row["Category_Name"]."</td>";
		$table.="<td  id='Category_Photo".$row["ID"]."'><img src='../img/".$row["Category_Photo"]."' height='50px !important' width='50px !important'' style='border-radius: 0;' ></td>";
		//$table.="<td id='Category_Description".$row["ID"]."'>".$row["Category_Description"]."</td>";
		$table.="<td id='Status".$row["ID"]."'>".$row["Status"]."</td>";
		$table.="<td><a href='javascript:void(0)' onclick='editRecord(".$row["ID"].")'>Edit</a></td>";
		$table.="<td><a href='javascript:void(0)' onclick='deleteRecord(".$row["ID"].")'>Delete</a></td>";
		$table.="<td><a href='javascript:void(0)' onclick='ProductRecord(".$row["ID"].")'>Add Product</a></td>";
		$i++;
		$table.="</tr>";
	}
	$table.="</tbody>";
	echo $table;
?>
