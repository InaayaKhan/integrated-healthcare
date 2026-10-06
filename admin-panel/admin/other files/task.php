<?php 
session_start();
if(!isset($_SESSION["username"])){
		header("Location:index.php");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Admin Panel | Category List</title>
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
              </span> Category List
            </h3>
          </div>
          
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-description" style="text-align:right;"><a href="addTask1.php?type=add&id="> + Add new Category </a></p>
                  <table id="tableData" class="table table-bordered">
            
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
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
  <script type="text/javascript">

$(document).ready(function(){
	showData();
});
	function showData(){
		$.ajax({
			type:"POST",
			url:"getCategoryDetails.php",
			data:{},
			success:function(response){
				$("#tableData").html(response);
			}
		});
	}
	
	function deleteRecord(id){
		//alert(id);
		 var ans= confirm("are you sure to delete file");
		if(ans==true){
		$.ajax({
			type:"POST",
			url:"deleteCategoryDetails.php",
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
	function editRecord(id){
		window.open('addTask1.php?type=edit&id='+id,'_self');
			/* $("#hdnID").val(id);
			$("#txtCategoryName").val($("#Category_Name"+id).html());
			$("#txtCategoryDescription").val($("#Category_Description"+id).html());
			$("#selStatus").val($("#Status"+id).html());
			$("#btnSubmit").val("Edit"); */
	}
	function ProductRecord(id){
		window.open('pgProductInfo.php?id='+id,'_self');
	}
	function logout () {
      var ans= confirm("are you sure to delete file");
		if(ans==true){
			window.open('logout.php?','_self');
		}
    }
</script> 
<!-- endinject -->
<!-- Custom js for this page -->
<!-- End custom js for this page -->
</body>
</html>