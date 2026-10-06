<?php	
	
	include("db_connect.php");
	$db=new DB_Connect();
	$con=$db->connect();
	

	if($_POST["categoryname"]==""){
		echo "categoryname";
	}else if($_POST["categorydescription"]==""){
		echo "categorydescription";
	}else if(empty($_FILES['txtCategoryImage']['name'])){
		echo "Image";
	}
	 else{
		 $profile_photo = $_FILES['txtCategoryImage']['name'];
			$profile_photo = str_replace(' ', '', $profile_photo);
			$profile_photo=date("dmYhis").'_'.$profile_photo;
			//echo $profile_photo;
			move_uploaded_file($_FILES['txtCategoryImage']['tmp_name'],"../img/".$profile_photo);
		

		 $qry="Select count(*) as cnt from category where Category_Name='".$_POST["categoryname"]."'";
	//	echo $qry;
		$result=mysqli_query($con,$qry);
		$row=mysqli_fetch_array($result);
		if($row["cnt"]>0){
			echo "Exist";
		}
		else{	
			$qry="insert into category (Category_Name,Category_Description,Category_Photo,Status) values('".$_POST["categoryname"]."','".$_POST["categorydescription"]."','".$profile_photo."','".$_POST["status"]."')";
			//echo $qry;
			 
			   if(mysqli_query($con,$qry)){
				echo "Success";
			}
			else{
				echo "Error";
			}
		}
	} 
	
?>
