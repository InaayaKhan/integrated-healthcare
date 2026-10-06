<?php	
	session_start();
	include("db_connect.php");
	$db=new DB_Connect();
	$con=$db->connect();
	
	if($_POST["productname"]==""){
		echo "productname";
	}
	else if($_POST["categoryid"]==""){
		echo "categoryid";
	}
	else if($_POST["productdescription"]==""){
		echo "productdescription";
	}else if(empty($_FILES['txtProductImage']['name'])){
		echo "Image";
	}
	else{
		 $profile_photo = $_FILES['txtProductImage']['name'];
			$profile_photo = str_replace(' ', '', $profile_photo);
			$profile_photo=date("dmYhis").'_'.$profile_photo;
			//echo $profile_photo;
			move_uploaded_file($_FILES['txtProductImage']['tmp_name'],"../Product/".$profile_photo);
		

		 $qry="Select count(*) as cnt from product where Product_Name='".$_POST["productname"]."' and Category_ID='".$_POST["categoryid"]."'";
		//echo $qry;
		$result=mysqli_query($con,$qry);
		$row=mysqli_fetch_array($result);
		if($row["cnt"]>0){
			echo "Exist";
		}
		else{	
			$qry="insert into product(Category_ID,Product_Name,Product_Photo,Product_Description,Status) values('".$_POST["categoryid"]."','".$_POST["productname"]."','".$profile_photo."','".$_POST["productdescription"]."','".$_POST["status"]."')";
			// echo $qry;
			 
			   if(mysqli_query($con,$qry)){
				echo "Success";
			}
			else{
				echo "Error";
			}
		}
	}
	
?>
