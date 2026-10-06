<?php	
	session_start();
	include("db_connect.php");
	$db=new DB_Connect();
	$con=$db->connect();
	
	if($_POST["categoryname"]==""){
		echo "categoryname";
	}else if($_POST["categorydescription"]==""){
		echo "categorydescription";
	}
	else{
		if(empty($_FILES['txtCategoryImage']['name'])){
			
			$qry1="Select count(*) as cnt from category where Category_Name='".$_POST["categoryname"]."' and ID!='".$_POST["id"]."'";
			//echo $qry1;
			$result1=mysqli_query($con,$qry1);
			$row1=mysqli_fetch_array($result1);
			if($row1["cnt"]>0){
				echo "Exist";
			}
			else{
					$qry="update category  set Category_Name='".$_POST["categoryname"]."',Category_Description='".$_POST["categorydescription"]."',Status='".$_POST["status"]."' where ID='".$_POST["id"]."'";
					//echo "if".$qry;
					   if(mysqli_query($con,$qry)){
						echo "Success";
					}
					else{
						echo "Error";
					}
			}
			
			
		}else{
		
		
		 $profile_photo = $_FILES['txtCategoryImage']['name'];
			$profile_photo = str_replace(' ', '', $profile_photo);
			$profile_photo=date("dmYhis").'_'.$profile_photo;
			//echo $profile_photo;
			move_uploaded_file($_FILES['txtCategoryImage']['tmp_name'],"../img/".$profile_photo);
		

		$qry="Select count(*) as cnt from category where Category_Name='".$_POST["categoryname"]."' and ID!='".$_POST["id"]."'";
		//echo $qry;
		$result=mysqli_query($con,$qry);
		$row=mysqli_fetch_array($result);
		if($row["cnt"]>0){
			echo "Exist";
		}
		else{
			 $qry="update category  set Category_Name='".$_POST["categoryname"]."', Category_Photo='".$profile_photo."',Category_Description='".$_POST["categorydescription"]."' ,Status='".$_POST["status"]."' where ID='".$_POST["id"]."'";
			// echo "else".$qry;
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
