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
  <title>Admin Panel | Home</title>
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
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  
  <!-- Morris charts -->
	  <link rel="stylesheet" href="graph/morris.css">
		<!-- Font Awesome -->
	  <link rel="stylesheet" href="graph/font-awesome.min.css">
	  <!-- Ionicons -->
	  <link rel="stylesheet" href="graph/ionicons.min.css">
</head>
<style>
.grid-container {
  display: grid;
  grid-template-columns:auto auto auto auto;
  grid-column-gap: 10px;
  grid-row-gap: 10px;
 
  padding: 10px;
}
.pointer {cursor: pointer;}


</style>
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
                <i class="mdi mdi-home"></i>
              </span> Dashboard
            </h3>
          </div>
		<div class="grid-container" >
		
		
<div class="pointer">
	  <div class="box1"  onclick="window.location.href = 'pgDoctorsRegistered.php';"style=" border-radius: 25px;  background-color: #24b0d6; text-align: center;
			 padding: 20px 0; font-size: 25px;"> 
		
			
		
				 <i class="mdi mdi-stethoscope" aria-hidden="true"  style="font-size:50px; color:#ffffff;"></i>
				<br><br> 

					  <?php
					  include("db_connect.php");
						$db=new DB_connect();
						$con=$db->connect();
						
						
						$query="SELECT Count(*) as cnt FROM hca_doctor_registration Order by ID desc";
						$result=mysqli_query($con,$query);
						$row=mysqli_fetch_array($result);
						
						$TotalDoctors=$row[0];
						if($row["cnt"]==0){
								echo  "Total Doctors <br> " . 0;
							}
							else{
								echo  'Total Doctors <br> <span style="color:black;font-weight:bold">' .$TotalDoctors;
							}
					  ?>
					  </div>
					  </div>
					  
					  	<div class="pointer">
							  <div class="box2" onclick="window.location.href = 'pgPatientRegistered.php';"
							  style=" border-radius: 25px;  background-color: #24b0d6; text-align: center;
									 padding: 20px 0; font-size: 25px;"> 
							 
							 <i class="mdi mdi-account" aria-hidden="true"  style="font-size:50px; color:#ffffff;"></i>
							<br><br> 
								<?php
							  
								$query="SELECT Count(*) as cnt FROM hca_patient_registration Order by ID desc";
								$result=mysqli_query($con,$query);
								$row=mysqli_fetch_array($result);
								
								$TotalPatients=$row[0];
								if($row["cnt"]==0){
										echo  "Total Patients <br> " . 0;
								}
									else{
									echo  'Total Patients <br> <span style="color:black;font-weight:bold">' .$TotalPatients;
								}
							  ?>
							  </div>
							  </div>
					</div>
					<div style="width:100%;">
						<canvas id="canvas"></canvas>
					</div>
				
		</div>
							
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
  <!-- Morris.js charts -->
	<script src="graph/raphael.min.js"></script>
	<script src="graph/morris.min.js"></script>
	<script src="graph/jquery.flot.js"></script>
	<script src="graph/jquery.flot.resize.js"></script>
	<script src="graph/jquery.flot.categories.js"></script>
	
	
	<script src="assets/js/Chart.min.js"></script>
  <script type="text/javascript">
  

function logout () {
		var ans= confirm("Are you sure to logout?");
		if(ans==true){
			window.open('logout.php','_self');
		}
    }
	
$(document).ready(function(){
	graph();	
});
var valmonths = [];
var valsale = [];
function graph(){
		 $.ajax({
			type:"POST",
			url:"getTransactionbygraph.php",
			dataType:"JSON",
			data:{},
			success:function(response){
					console.log(response);
					
					// valmonths.push(response);
					// alert(valmonths);
					
					for (var i=0; i<response.length; i++){
					//for (var name in response[i]) {
						 valmonths.push(response[i].x);
						 valsale.push(response[i].y);
						 
						 console.log(valmonths);
						console.log(valsale);
					} 
					
					
					//--graph start
	   
		 /* var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

		var Sales = [0,0,0,0,0,0,0,0,0,0,400];
		alert(MONTHS);
		alert(Sales); */
	 var MONTHS = valmonths;

		var Sales = valsale;
	 
		 var config = {
			type: 'line',
			data: {
				labels: [],
				datasets: [{
					label: 'Yearly Sales',
					 backgroundColor: '#000000',
					borderColor: '#000000', 
					data: [
					],
					fill: false,
				}]
			},
			options: {
				responsive: true,
				title: {
					display: true,
					text: 'Chart.js Line Chart'
				},
				tooltips: {
					mode: 'index',
					intersect: false,
				},
				hover: {
					mode: 'nearest',
					intersect: true
				},
				scales: {
					xAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Month'
						}
					}],
					yAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Total Amount'
						}
					}]
				}
			}
		};

		window.onload = function() {
			var ctx = document.getElementById('canvas').getContext('2d');
			window.myLine = new Chart(ctx, config);
			
			var i;
			for (i = 0; i < 12; i++) {
				if (config.data.datasets.length > 0) {
					var month = MONTHS[i];
					config.data.labels.push(month);

					config.data.datasets.forEach(function(dataset) {
						var salesdata = Sales[i];
						dataset.data.push(salesdata);
					});
					window.myLine.update();
				}
			}
		}; 
					//--graph end
					

					
						//}
		//});
	}
});
}
	
</script> 
<!-- endinject -->
<!-- Custom js for this page -->
<!-- End custom js for this page -->
</body>
</html>