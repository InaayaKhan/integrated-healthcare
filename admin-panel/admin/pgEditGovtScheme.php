<?php 
session_start();
if(!isset($_SESSION["username"])){
	header("Location:index.php");
}
	
include("db_connect.php");
$db=new DB_Connect();
$con=$db->connect();
$id=$_REQUEST["id"];
//Fetch Scheme Details  
$qry="Select * from hca_govt_schemes where ID= '".$id."' ";
$run=mysqli_query($con,$qry);
$row=mysqli_fetch_array($run);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Panel | Edit Govt Schemes</title>
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
  <link rel="shortcut icon" href="assets/images/logo.png" />

  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="index.html"><img src="assets/images/logo.png" alt="logo" style="width:50px; height:auto;" /></a>
        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="assets/images/logo.png" alt="logo" style="width:50px; height:auto;" /></a>
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
            <a class="nav-link" href="pgDoctorsRegistered.php">
              <span class="menu-title">Registered Doctors</span>
              <i class="mdi mdi-stethoscope menu-icon"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pgPatientRegistered.php">
              <span class="menu-title">Registered Patients</span>
              <i class="mdi mdi-account menu-icon"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pgGovtScheme.php">
              <span class="menu-title">Govt. Schemes</span>
              <i class="mdi mdi-note menu-icon"></i>
            </a>
          </li>
		   <li class="nav-item">
            <a class="nav-link" href="pgChangePassword.php">
              <span class="menu-title">Change Password</span>
              <i class="mdi mdi-lock menu-icon"></i>
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
                  <i class="mdi mdi-note"></i>
                </span> Edit Govt Scheme Details
              </h3>
            </div>
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" id="txtName" value="<?php echo $row["Name"]; ?>">
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                 
                      <div class="form-group">
                        <label>Start Date</label>
                        <input type="date" class="form-control" id="txtStartDate" value="<?php echo $row["StartDate"]; ?>">
                      </div>
                      <div class="form-group">
                        <label>End Date</label>
                        <input type="date" class="form-control" id="txtEndDate" value="<?php echo $row["EndDate"]; ?>">
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                      <div class="form-group">
                        <label for="txtLink">URL</label>
                        <input type="text" class="form-control" id="txtURL" value="<?php echo $row["Website"]; ?>">
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
					          <button type="submit" name="sub_ins" class="btn btn-gradient-primary mr-2" id="btnSubmit" onclick="updateRecord();">Update Scheme</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
	<input type="hidden" id="hdnID" value="<?php echo $id; ?>">
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="container-fluid clearfix">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2022</span>
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
	
});
function logout () {
      var ans= confirm("Are you sure to logout?");
		if(ans==true){
			window.open('logout.php','_self');
		}
    }
	function updateRecord(){
    if($("#txtName").val()==""){
			alert("Enter scheme name");
			$("#txtName").focus();
		}
		else if($("#txtURL").val()==""){
			alert("Enter URL");
			$("#txtURL").focus();
		}
    else
    {
  $.ajax({
			type:"POST",
			url:"apiUpdateGovtScheme.php",
			data:{id:$("#hdnID").val(),name:$("#txtName").val(),startdate:$("#txtStartDate").val(),enddate:$("#txtEndDate").val(),url:$("#txtURL").val()},
			success:function(response){
				if($.trim(response)=="Success"){
					alert("Record updated successfully!");
					window.location.assign("pgGovtScheme.php")
				}
				else{
					alert("Something Went Wrong!");
					
				}
			}
		});
  }
	
	}
</script>	
  </body>
</html>