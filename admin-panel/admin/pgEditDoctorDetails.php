<?php 
session_start();
if(!isset($_SESSION["username"])){
	header("Location:index.php");
}
	
include("db_connect.php");
$db=new DB_Connect();
$con=$db->connect();
$id=$_REQUEST["id"];
//Fetch Doctor Details  
$qry="Select * from hca_doctor_registration where ID= '".$id."' ";
$run=mysqli_query($con,$qry);
$row=mysqli_fetch_array($run);

//Fetch Link for Video Conf.
$qry2="Select Link from hca_doctor_vc_link where Doctor_ID= '".$id."' ";
$run2=mysqli_query($con,$qry2);
$row2=mysqli_fetch_array($run2);


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Panel | Doctor Registration Details</title>
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
                  <i class="mdi mdi-stethoscope"></i>
                </span> Change Doctor Login Status
              </h3>
            </div>
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                 
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" Disabled value="<?php echo $row["Name"]; ?>">
                      </div>
                      <div class="form-group">
                        <label>MobileNumber</label>
                        <input type="text" class="form-control" Disabled value="<?php echo $row["MobileNumber"]; ?>">
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
                        <label>Specialized In</label>
                        <input type="text" class="form-control" Disabled value="<?php echo $row["SpecializedIn"]; ?>">
                      </div>
                      <div class="form-group">
                        <label>Years of Experience</label>
                        <input type="text" class="form-control" Disabled value="<?php echo $row["Experience"]; ?>">
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
                        <label>Address</label>
                        <input type="text" class="form-control" Disabled value="<?php echo $row["Address"]; ?>">
                      </div>
                      <div class="form-group">
                        <label>Pincode</label>
                        <input type="text" class="form-control" Disabled value="<?php echo $row["Pincode"]; ?>">
                      </div>
                      <div class="form-group">
                        <label>City</label>
                        <input type="text" class="form-control" Disabled value="<?php echo $row["City"]; ?>">
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
                        <label for="txtLink">Video Conference Link</label>
                        <input type="text" class="form-control" Disabled value="<?php echo $row2["Link"]; ?>">
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
						<label for="selStatus">Status</label>	
						<select id="selStatus" value="<?php echo $row["Status"]; ?>" class="form-control">
							<option value="On">On</option>
							<option value="Off">Off</option>
						</select>
					</div>
					 
					<button type="submit" name="sub_ins" class="btn btn-gradient-primary mr-2" id="btnSubmit" onclick="updateStatus();">Change Status</button>
                   
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
	function updateStatus(){
  $.ajax({
			type:"POST",
			url:"apiUpdateDoctorStatus.php",
			data:{id:$("#hdnID").val(),Status:$("#selStatus").val()},
			success:function(response){
				console.log(response);
				if($.trim(response)=="Success"){
					alert("Status Updated Successfully!");
					window.location.assign("pgDoctorsRegistered.php")
				}
				else{
					alert("Something Went Wrong!");
					
				}
			}
		});  
	
	}
</script>	
  </body>
</html>