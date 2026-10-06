<?php 
include("db_connect.php");
	$db=new DB_connect();
	$con=$db->connect();
	$response = array();
	$query="SELECT Disease FROM hca_chat_db order by Disease asc";	
	$result=mysqli_query($con,$query);	
	$i=0;
	$desc="";
	while($row=mysqli_fetch_array($result)){
		$i=$i+1;
		$desc.=$i.". ".$row["Disease"]."\n\n";
	}
	array_push($response,array('count'=>$i,'value'=>$desc));
	echo json_encode(array('response'=>$response));
?>