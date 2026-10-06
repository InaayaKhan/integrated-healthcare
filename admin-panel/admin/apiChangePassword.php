<?php
session_start();
    include("db_connect.php");
	$db=new DB_connect();
	$con=$db->connect();
	
    $OldPassword = $_POST['oldpswd'];
	$NewPassword = $_POST['newpswd'];
	$ConfirmPassword = $_POST['retypepswd'];
	$ID = $_SESSION["username"];
    
	$qry1="SELECT COUNT(*) as cnt from hca_admin_login WHERE Password ='".$OldPassword."' and id='".$ID."' ";
    $asd=mysqli_query($con,$qry1);
    $zxc=mysqli_fetch_array($asd);
	if($zxc["cnt"]==1){
            if ($OldPassword ==  $NewPassword){
                echo "OldPassword";
            }else if($NewPassword != $ConfirmPassword){
                echo "Mismatched";
            }
            else{
                $qry1=" UPDATE hca_admin_login SET Password ='".$NewPassword."' Where id= '".$ID."' ";
                if($runi=mysqli_query($con,$qry1)){
                    echo "Success";
                }
                else{
                    echo "error";
                }
            }
    }else{              
        echo "Invalid";
    }
  
	
?>