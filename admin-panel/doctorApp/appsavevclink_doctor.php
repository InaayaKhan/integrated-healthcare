<?php
include("db_connect.php");
$db=new DB_connect();
$con=$db->connect();
$response = array();
if (isset($_REQUEST['link']) && isset($_REQUEST['ID']) )
{
    $link = $_REQUEST['link'];
	$ID = $_REQUEST['ID'];
    $qry1 = "";
	$qry1="SELECT COUNT(*) as cnt from hca_doctor_vc_link where Doctor_ID='".$ID."'";
    $asd=mysqli_query($con,$qry1);
    $zxc=mysqli_fetch_array($asd);
    $qry1 = "";
	if($zxc["cnt"]==0)
    {
        $qry1="insert into hca_doctor_vc_link(Doctor_ID,Link) values('".$ID."','".$link."')";
    }
    else
    {
        $qry1="UPDATE hca_doctor_vc_link SET Link ='".$link."' Where Doctor_ID= '".$ID."' ";
    }
    if($runi=mysqli_query($con,$qry1))
    {
        $response["success"] = 1;
        $response["message"] = "Link updated successfully";
        echo json_encode($response);
    }
    else
    {
        $response["success"] = 0;
        $response["message"] = "Something went wrong";
        echo json_encode($response);
    }
}
else{
    
    $response["success"] = 0;
    $response["message"] = "Required field missing";
    echo json_encode($response);
	
}		
?>