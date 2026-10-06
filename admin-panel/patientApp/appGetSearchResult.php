<?php 
include("db_connect.php");
	$db=new DB_connect();
	$con=$db->connect();

	$Name = $_REQUEST['Name'];
	$Specialized = $_REQUEST['Specialized'];
	$City = $_REQUEST['City'];

	// array for JSON response
	$response = array();
	
	
	// check for required fields
		$query="SELECT ID,Name,Experience,Address FROM hca_doctor_registration where";
		$where="";
		if ($Name!="Any")
		{
			$where=" Name like '%".$Name."%'";
		}
		if ($Specialized!="Any")
		{
			if ($where=="")
			{
				$where=" SpecializedIn='".$Specialized."'";
			}
			else
			{
				$where.=" and SpecializedIn='".$Specialized."'";
			}
		}
		if ($City!="Any")
		{
			if ($where=="")
			{
				$where=" City like '%".$City."%'";
			}
			else
			{
				$where.=" and City like '%".$City."%'";
			}
		}
		if ($where!="")
		{
			$where.=" and";
		}
		$query.=$where." Status='On'";		
		$result=mysqli_query($con,$query);
		
		while($row=mysqli_fetch_array($result)){
			$desc = $row["Experience"]." years exp. | ".$row["Address"];
		    array_push($response,array('ID'=>$row["ID"],'Name'=>$row["Name"],'Description'=>$desc));
		}
		echo json_encode(array('response'=>$response));
?>