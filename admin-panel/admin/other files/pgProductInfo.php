<?php 

session_start();
if(!isset($_SESSION["username"])){
		header("Location:index.php");
	}
include("db_connect.php");
$db=new DB_Connect();
$con=$db->connect();
$id=$_REQUEST["id"];
$qry="Select * from category where ID= '".$id."' ";
 // echo $qry;
$run=mysqli_query($con,$qry);
$row=mysqli_fetch_array($run);


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Panel | Add New Product</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.ico" />

  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo" href="index.html"><img src="assets/images/logo.svg" alt="logo" /></a>
          <a class="navbar-brand brand-logo-mini" href="index.html"><img src="assets/images/logo-mini.svg" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item d-none d-lg-block full-screen-link">
              <a class="nav-link">
                <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
              </a>
            </li>
            
            <li class="nav-item nav-logout d-none d-lg-block">
              <a class="nav-link" onclick="logout();">
                <i class="mdi mdi-power"></i>
              </a>
            </li>
          </ul>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
           <li class="nav-item">
            <a class="nav-link" href="home.php">
              <span class="menu-title">Dashboard</span>
              <i class="mdi mdi-home menu-icon"></i>

            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="task.php">
              <span class="menu-title">Category List</span>
              <i class="mdi mdi-format-list-bulleted menu-icon"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Userregistered.php">
              <span class="menu-title">User Registered</span>
              <i class="mdi mdi-format-list-bulleted menu-icon"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="farmerregistered.php">
              <span class="menu-title">Farmer Registered</span>
              <i class="mdi mdi-format-list-bulleted menu-icon"></i>
            </a>
          </li>
		    <li class="nav-item">
            <a class="nav-link" href="pgViewOrder.php">
              <span class="menu-title">View Order</span>
              <i class="mdi mdi-format-list-bulleted menu-icon"></i>
            </a>
          </li>
		   <li class="nav-item">
            <a class="nav-link" href="Transaction.php">
              <span class="menu-title">View Transaction</span>
              <i class="mdi mdi-format-list-bulleted menu-icon"></i>
            </a>
          </li>
		   <li class="nav-item">
            <a class="nav-link" href="pgChangePassword.php">
              <span class="menu-title">Change Password</span>
              <i class="mdi mdi-format-list-bulleted menu-icon"></i>
            </a>
          </li>
          </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-format-list-bulleted"></i>
                </span>Product Details
              </h3>
            </div>
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                  <form method="post" enctype="multipart/form-data">
                      <div class="form-group">
                        <label for="txtTaskName">Category Name</label>
                        <input type="text" class="form-control" disabled value="<?php echo $row["Category_Name"] ; ?>" name="cname" id="txtCategoryName">
                      </div>
					  <div class="form-group">
                        <label for="txtTaskName">Product Name</label>
                        <input type="text" class="form-control" value="" name="cname" id="txtProductName">
                      </div>
                      <div class="form-group">
                        <label for="txtTaskDescription">Product Description</label>
                        <textarea class="form-control" name="cdesc" id="txtProductDescription"></textarea>
                      </div>

                      <div class="form-group">
							<label class="control-label col-sm-2">Image:</label>
							<div class="col-sm-6">          
							<input type="file" name="txtProductImage" id="txtProductImage">
									<p class="help-block text-danger"></p>
							</div>
							
							<div class="col-sm-6" id="diveditimg" style="display:none;">          
								<img id="my_image" src='' style="width:50px;height:50px;"/>
							</div>
						
						</div>
			<label>Status</label>	
			<select id="selStatus">
				<option value="On">On</option>
				<option value="Off">Off</option>
			</select><br><br>
				
					  <button type="submit" name="sub_ins" class="btn btn-gradient-primary mr-2" id="btnSubmit" onclick="saveProductDetails1();">Save</button>
                      <!-- <button id="taskGenerate" type="submit"class="btn btn-gradient-primary mr-2">Submit       </button> -->
                    </form>
                  </div>
				  <h3 style="padding:10px;">Product Details</h3>
				   <table id="tableData" class="table table-bordered">
            
                  </table>
                </div>
              </div>
            </div>
          </div>
		  
		  
		 
	<input type="hidden" id="hdnID" value="<?php echo $id; ?>">
	<input type="hidden" id="hdnIDProductid">
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="container-fluid clearfix">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2021</span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
   
	<script src="jquery.form.min.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <!-- End custom js for this page -->

    <script>
$(document).ready(function(){
	showData();
});
function logout () {
      var ans= confirm("are you sure to delete file");
		if(ans==true){
			window.open('logout.php?','_self');
		}
    }
$("#txtProductImage").change(function() {
  $("#diveditimg").css("display", "none");
});

function showData(){
		$.ajax({
			type:"POST",
			url:"getProductDetails.php",
			data:{id:$("#hdnID").val()},
			success:function(response){
				$("#tableData").html(response);
			}
		});
	}
// Get the elements with class="column"
var elements = document.getElementsByClassName("column");

// Declare a loop variable
var i;

// List View
function listView() {
  for (i = 0; i < elements.length; i++) {
    elements[i].style.width = "100%";
  }
}

// Grid View
function gridView() {
  for (i = 0; i < elements.length; i++) {
    elements[i].style.width = "50%";
  }
}
	
	function saveProductDetails1(){
	if($("#btnSubmit").html()=="Save"){
				$('form').ajaxForm({
					
				type:"POST",
				url:"saveProductDetails.php",
					data:{productname:$("#txtProductName").val(),categoryid:$("#hdnID").val(),productdescription:$("#txtProductDescription").val(),status:$("#selStatus").val()},
					success:function(response){
					 console.log(response);
					},
					complete:function(response){
					console.log(response);
         
					var resp=response.responseText;
					console.log(resp);
						if($.trim(resp)=="Success"){
							alert("Details Saved Successfully");
							$("#txtcategoryName").val("");
							$("#txtcategoryDescription").val("");
							$("#txtCategoryImage").val("");
							window.location.assign("pgProductInfo.php?id="+$("#hdnID").val())
							}
						else if($.trim(resp)=="productname"){
							alert("Enter Product Name");
							$("#txtProductName").focus();
						}
						else if($.trim(resp)=="productdescription"){
							alert("Enter Product Description");
							$("#txtProductDescription").focus();
						}
						else if($.trim(resp)=="Image"){
							alert("Upload Image");
						}
						else if($.trim(resp)=="Exist"){
							alert("this entry is already exist");
							
						}
						else{
							alert("Details Not Saved");
							window.location.reload();
							$("#txtProductName").val("");
							$("#txtProductDescription").val("");
						
							
						}
					}
				});
	}
	else{
		
		$('form').ajaxForm({
					
				type:"POST",
				url:"editProductDetails.php",
					data:{id:$("#hdnIDProductid").val(),productname:$("#txtProductName").val(),categoryid:$("#hdnID").val(),productdescription:$("#txtProductDescription").val(),status:$("#selStatus").val()},
					success:function(response){
					 console.log(response);
					},
					complete:function(response){
					console.log(response);
					var resp=response.responseText;
					console.log(resp);
						if($.trim(resp)=="Success"){
							alert("Details Updated Successfully");
							$("#txtProductName").val("");
							$("#txtProductDescription").val("");
							$("#txtProductImage").val("");
							$("#btnSubmit").html("Save");
							showData();
							window.location.reload();
							}
						else if($.trim(resp)=="productname"){
							alert("Enter Product Name ");
						}
						else if($.trim(resp)=="Exist"){
							alert("this entry is already exist");
							
						}
						else if($.trim(resp)=="productdescription"){
							alert("Enter Description");
						}
						else{
							alert("Details Not Saved");
							window.location.reload();
							$("#txtProductName").val("");
							$("#txtProductDescription").val("");
							$("#txtProductImage").val("");
						}
					}
				});
	}
	
	}
	function editCategoryDetails1(){
	
				 $('form').ajaxForm({
					
				type:"POST",
				url:"editCategoryDetails.php",
					data:{id:$("#hdnID").val() ,categoryname:$("#txtcategoryName").val(),categorydescription:$("#txtcategoryDescription").val()},
					success:function(response){
					 console.log(response);
					},
					complete:function(response){
					console.log(response);
					var resp=response.responseText;
					console.log(resp);
						if($.trim(resp)=="Success"){
							alert("Details Updated Successfully");
							$("#txtCategoryName").val("");
							$("#txtCategoryDescription").val("");
							$("#txtCategoryImage").val("");
							 $("#diveditimg").css("display", "none");
							window.location.reload();
							//showData();
							}
						else if($.trim(resp)=="categoryname"){
							alert("Enter Name ");
						}
						else if($.trim(resp)=="categorydescription"){
							alert("Enter Address");
						}
						else{
							alert("Details Not Saved");
							window.location.reload();
							$("#txtCategoryName").val("");
							$("#txtCategoryDescription").val("");
							$("#txtCategoryImage").val("");
							
						}
					}
				}); 
	
	}
	
	function editRecord(id){
	flag=1;
	$("#diveditimg").css("display", "block");
	//alert($("#C_Product_Photo"+id).html());
		$("#hdnIDProductid").val(id);
		$("#txtProductName").val($("#Product_Name"+id).html());
		$("#txtProductImage").val($("#Product_Photo"+id).val());
		$("#txtProductDescription").val($("#Product_Description"+id).val());
		$("#selStatus").val($("#Status"+id).html());
		$("#btnSubmit").html("Edit");
		
		 
		 $("#my_image").attr('src',"../Product/"+$("#C_Product_Photo"+id).val());
	}
	
	function deleteRecord(id){
		var ans= confirm("are you sure to delete file");
		if(ans==true){
		$.ajax({
			type:"POST",
			url:"deleteProductDetails.php",
			data:{id:id},
			success:function(response){
				console.log(response);

			if($.trim(response)=="Success"){
				alert("delete successfully");
				showData();
			}
			}
		});
	}
	}
	// Read a page's GET URL variables and return them as an associative array.
	function getUrlVars()
	{
		var vars = [], hash;
		var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
		for(var i = 0; i < hashes.length; i++)
		{
			hash = hashes[i].split('=');
			vars.push(hash[0]);
			vars[hash[0]] = hash[1];
		}
		return vars;
	}

	
</script>	
  </body>
</html>