<?php	
	session_start();
	include("db_connect.php");
	$db=new DB_Connect();
	$con=$db->connect();
	
	if($_POST["productname"]==""){
		echo "productname";
	}
	else if($_POST["productdescription"]==""){
		echo "productdescription";
	}
	else{
		if(empty($_FILES['txtProductImage']['name'])){
			
			
			 $qry1="Select count(*) as cnt from product where Product_Name='".$_POST["productname"]."' and Category_ID='".$_POST["categoryid"]."' and ID!='".$_POST["id"]."'";
			//echo $qry;
			$result1=mysqli_query($con,$qry1);
			$row1=mysqli_fetch_array($result1);
				if($row1["cnt"]>0){
					echo "Exist";
				}
				else{
					
					 $qry="update product  set Product_Name='".$_POST["productname"]."',Product_Description='".$_POST["productdescription"]."',Status='".$_POST["status"]."' where ID='".$_POST["id"]."'";
					
					   if(mysqli_query($con,$qry)){
						echo "Success";
					}
					else{
						echo "Error";
					}
				
				}
			
			
		}else{
		
		
		 $profile_photo = $_FILES['txtProductImage']['name'];
			$profile_photo = str_replace(' ', '', $profile_photo);
			$profile_photo=date("dmYhis").'_'.$profile_photo;
			//echo $profile_photo;
			move_uploaded_file($_FILES['txtProductImage']['tmp_name'],"../Product/".$profile_photo);
		

		 $qry="Select count(*) as cnt from product where Product_Name='".$_POST["productname"]."' and Category_ID='".$_POST["categoryid"]."' and ID!='".$_POST["id"]."'";
		//echo $qry;
		$result=mysqli_query($con,$qry);
		$row=mysqli_fetch_array($result);
		if($row["cnt"]>0){
			echo "Exist";
		}
		else{
			 $qry="update product  set Product_Name='".$_POST["productname"]."',Product_Description='".$_POST["productdescription"]."',Product_Photo='".$profile_photo."',Status='".$_POST["status"]."' where ID='".$_POST["id"]."'";
			 //echo "else".$qry;
			   if(mysqli_query($con,$qry)){
				echo "Success";
			}
			else{
				echo "Error";
			}
		}
		}
	}
	
?>
