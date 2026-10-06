<?php 
include("db_connect.php");
	$db=new DB_connect();
	$con=$db->connect();
	$response = array();
	$query="SELECT * FROM hca_chat_db where Symptoms like '%".$_REQUEST["term"]."%' or Disease like '%".$_REQUEST["term"]."%' order by ID desc";	
	$result=mysqli_query($con,$query);	
	$i=0;
	$desc="";
	while($row=mysqli_fetch_array($result)){
		if ($desc!="")
		{
			$desc.="\n\n=====================\n\n";
		}
		$desc.="Disease:".$row["Disease"]."\n\nSymptoms:".$row["Symptoms"]."\n\nMedicines:".$row["Medicines"]."\n\nRemedies".$row["Remedies"];
		$i=$i+1;
	}
	array_push($response,array('count'=>$i,'value'=>$desc));
	echo json_encode(array('response'=>$response));
?>