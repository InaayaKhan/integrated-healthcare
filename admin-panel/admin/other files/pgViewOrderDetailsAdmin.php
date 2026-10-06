<?php 
session_start();
if(!isset($_SESSION["username"])){
		header("Location:index.php");
	}
	include("db_connect.php");
	$db=new DB_connect();
	$con=$db->connect();
	
	$qry1="Select * from user_order_details where ID='".$_REQUEST["id"]."' order by ID Desc";
	echo $qry1;
	$run1=mysqli_query($con,$qry1);
	$row11=mysqli_fetch_array($run1);
	
	$qry2="Select * from user_registration where ID='".$row11["User_ID"]."' order by ID Desc";
	echo $qry2;
	$run2=mysqli_query($con,$qry2);
	$row12=mysqli_fetch_array($run2);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Admin Panel | View Order</title>
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
  
  <style>
     .navbar-custom-menu, .main-header .navbar-right {
    float: right;
}
@media (min-width: 768px)
.navbar-nav {
    float: left;
    margin: 0;
}

.navbar-nav {
    margin: 7.5px -15px;
}
.nav {
    padding-left: 0;
    margin-bottom: 0;
    list-style: none;
}
.navbar-custom-menu>.navbar-nav>li {
    position: relative;
}
@media (min-width: 768px)
.navbar-nav>li {
    float: left;
}
.nav>li {
    position: relative;
    display: block;
}
.navbar-custom-menu>.navbar-nav>li {
    position: relative;
}
@media (min-width: 768px)
.navbar-nav>li {
    float: left;
}
.nav>li {
    position: relative;
    display: block;
}
.dropdown, .dropup {
    position: relative;
}
 .navbar .nav>li>a {
    color: #fff;
}
@media (min-width: 768px)
.navbar-nav>li>a {
    padding-top: 15px;
    padding-bottom: 15px;
}
.navbar-nav>li>a {
    padding-top: 10px;
    padding-bottom: 10px;
    line-height: 20px;
}
.nav>li>a {
    position: relative;
    display: block;
    padding: 10px 15px;
}
 .navbar .nav>li>a>.label {
    position: absolute;
    top: 9px;
    right: 7px;
    text-align: center;
    font-size: 9px;
    padding: 2px 3px;
    line-height: .9;
}
.navbar-custom-menu>.navbar-nav>li>.dropdown-menu {
    position: absolute;
    right: 0;
    left: auto;
}
.navbar-nav>.notifications-menu>.dropdown-menu, .navbar-nav>.messages-menu>.dropdown-menu, .navbar-nav>.tasks-menu>.dropdown-menu {
    width: 280px;
    padding: 0 0 0 0;
    margin: 0;
    top: 100%;
}
.navbar-nav>li>.dropdown-menu {
    margin-top: 0;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
}
.open>.dropdown-menu {
    display: block;
}
.dropdown-menu {
    box-shadow: none;
    border-color: #eee;
}
.dropdown-menu {
    position: absolute;
    top: 100%;
    left: 0;
    z-index: 1000;
    display: none;
    float: left;
    min-width: 160px;
    padding: 5px 0;
    margin: 2px 0 0;
    font-size: 14px;
    text-align: left;
    list-style: none;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ccc;
    border: 1px solid rgba(0,0,0,.15);
    border-radius: 4px;
    -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
    box-shadow: 0 6px 12px rgba(0,0,0,.175);
}
.navbar-nav>.messages-menu>.dropdown-menu>li.header, .navbar-nav>.tasks-menu>.dropdown-menu>li.header {
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0;
    background-color: #ffffff;
    padding: 7px 10px;
    border-bottom: 1px solid #f4f4f4;
    color: #444444;
    font-size: 14px;
}
.navbar-nav>.notifications-menu>.dropdown-menu>li, .navbar-nav>.messages-menu>.dropdown-menu>li, .navbar-nav>.tasks-menu>.dropdown-menu>li {
    position: relative;
}
.navbar-nav>.messages-menu>.dropdown-menu>li .menu, .navbar-nav>.tasks-menu>.dropdown-menu>li .menu {
    max-height: 200px;
    margin: 0;
    padding: 0;
    list-style: none;
    overflow-x: hidden;
}
.pull-left {
    float: left;
}
.pull-left {
    float: left!important;
}
.navbar-nav>.messages-menu>.dropdown-menu>li .menu>li>a {
    margin: 0;
    padding: 10px 10px;
}
.navbar-nav>.notifications-menu>.dropdown-menu>li .menu>li>a, .navbar-nav>.messages-menu>.dropdown-menu>li .menu>li>a, .navbar-nav>.tasks-menu>.dropdown-menu>li .menu>li>a {
    display: block;
    white-space: nowrap;
    border-bottom: 1px solid #f4f4f4;
}
a {
    color: #3c8dbc;
}
a {
    color: #337ab7;
    text-decoration: none;
}
a {
    background-color: transparent;
}
.pull-left {
    float: left!important;
}
.pull-left {
    float: left;
}
.pull-left {
    float: left;
}
.navbar-nav>.messages-menu>.dropdown-menu>li .menu>li>a>h4 {
    padding: 0;
    margin: 0 0 0 45px;
    color: #444444;
    font-size: 15px;
    position: relative;
}
.navbar-nav>.messages-menu>.dropdown-menu>li .menu>li>a>h4>small {
    color: #999999;
    font-size: 10px;
    position: absolute;
    top: 0;
    right: 0;
}
.navbar-nav>.messages-menu>.dropdown-menu>li .menu>li>a>p {
    margin: 0 0 0 45px;
    font-size: 12px;
    color: #888888;
}
}

.navbar-nav>.messages-menu>.dropdown-menu>li .menu>li>a>div>img {
    margin: auto 10px auto auto;
    width: 40px;
    height: 40px;
}
.img-circle {
    border-radius: 50%;
	margin: auto 10px auto auto;
    width: 40px;
    height: 40px;
}
img {
    vertical-align: middle;
}
img {
    border: 0;
}
.footers {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    border-bottom-right-radius: 4px;
    border-bottom-left-radius: 4px;
    font-size: 12px;
    background-color: #fff;
    padding: 7px 10px;
    border-bottom: 1px solid #eeeeee;
    color: #444 !important;
    text-align: center;
}

	

.progressbar li {
  position: relative;
  list-style: none;
  float: left;
  width: 25%;
  text-align: center;
}

/* Circles */
.progressbar li:before {
  content: counter(step);
  counter-increment: step;
  width: 40px;
  height: 40px;
  border: 1px solid #2979FF;
  display: block;
  text-align: center;
  margin: 0 auto 10px auto;
  border-radius: 50%;
  background-color: #FF9100;
   
  /* Center # in circle */
  line-height: 39px;
}

.progressbar li:after {
  content: "";
  position: absolute;
  width: 100%;
  height: 2px;
  background: orange ;
  top: 20px; /*half of height Parent (li) */
  left: -50%;
  z-index: -1;
}

.progressbar li:first-child:after {
  content: none;
}

.progressbar li.active:before {
  background: #00E676;
  content: "✔";  
}

.progressbar li.active + li:after {
  background: #00E676;
}
.table th{font-size:10px;padding: 5px 0px 5px 0px;}
.table td{font-size:10px;padding: 5px 0px 5px 0px;}

@media only screen and (max-width: 600px) {
	.progressbar {
	  counter-reset: step;
	  margin-left: -35px;
	}
	.statusdiv{}
	.mobile{display: block;}
	.desktop{display: none;}
}
@media only screen and (min-width: 768px) {
	.progressbar {
	  counter-reset: step;
	}
	.statusdiv{float:right;width: 120px;}
	.mobile{display: none;}
	.desktop{display: block;}
}

  </style>
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
              </span> View Order
            </h3>
          </div>
          
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-description" style="text-align:right;"><a href="Editregistereddetails.php?type=add&id=">  </a></p>
                  
				  
				  
				  
				  
				  	<div class="php-email-form">
								<div style="background-color: #FFFFFF;padding: 10px;width: 100%;border-color: #CBCBCD;border-bottom: 2px solid #CBCBCD;border-style: dashed;">
								
								<div class="row" style="background-color:#FCFCFC;margin:10px;border-color: #CBCBCD;">
									<div class="col-lg-4 col-md-4 col-sm-12 col-12 " >
											
										<font style="font-size: 10px;"><b>Name : </b></font><font style="font-size: 12px;"><?php echo $row12["Name"]; ?></font><br>
										<font style="font-size: 10px;"><b>Mobile Number : </b></font><font style="font-size: 12px;"><?php echo $row12["MobileNumber"]; ?></font><br>
										
										
										
									</div>
									<div class="col-lg-4 col-md-4 col-sm-12 col-12 " >
										<font style="font-size: 10px;"><b>Order Status</b><br><font style="font-size: 12px;"><?php echo $row11["Order_Status"]; ?></font></font><br>
										
										
									</div>
									<div class="col-lg-4 col-md-4 col-sm-12 col-12 " >
									
									</div>
								</div>
								
								<!--start-->
								
								<div  style="padding-top: 10px;border-color: #CBCBCD;border-top: 1px solid;">
								
								
										<?php $qry="Select * from user_vieworder_details where Order_ID='".$_REQUEST["id"]."' order by ID Desc";
										//echo $qry;
										$run=mysqli_query($con,$qry);
										while($row=mysqli_fetch_array($run)){
											//---start  new user
											
											 $query1="SELECT * FROM farmer_registration WHERE ID='".$row["Farmer_ID"]."' ";
											$result1=mysqli_query($con,$query1);
											$row1=mysqli_fetch_array($result1);
											
											 $query2="SELECT * FROM product WHERE ID='".$row["Product_ID"]."' ";
											$result2=mysqli_query($con,$query2);
											$row2=mysqli_fetch_array($result2);
											 
											$query3="SELECT * FROM totalproductstock WHERE Product_ID='".$row["Product_ID"]."' and Farmer_ID='".$row["Farmer_ID"]."' ";
											$result3=mysqli_query($con,$query3);
											$row3=mysqli_fetch_array($result3);
											
											
											
											?>
												
												<div class="row" style="padding: 10px;">
												
											
														<div class="col-lg-2 col-md-2 col-sm-12 col-12" >
															<img src="../Product/<?php echo $row2["Product_Photo"];?>"  style="width:100px; height:100px;"></img><br>
														</div>
													<div class="col-lg-10 col-md-10 col-sm-12 col-12" >
														<p class="desktop" style="font-size:12px;">
																<text style="font-weight:700;font-size:15px;"><?php echo $row2["Product_Name"];?></text>
																<text style="float: right;">
																	<text>Total Amount : </text>
																	<text style="font-weight:700;"><i class="fa fa-inr" aria-hidden="true"></i>Rs.<?php echo $row["Totalamount"];?></text>
																</text>
															<br>
																<text style="float: right;">
																	<text>Quantity : </text>
																	<text style="font-weight:700;"><?php echo $row["Quantity"];?></text>
																</text>
															</p>	
															<p class="desktop" style="font-size:12px;">
																<text>Amount : </text><i class="fa fa-inr" aria-hidden="true"></i> <text style="font-weight:700;">Rs.<?php echo $row3["Amount"];?> x Rs.<?php echo $row["Quantity"];?> = <i class="fa fa-inr" aria-hidden="true"></i> Rs.<?php echo $row["Totalamount"];?></text>
															</p>
															
															
															<br>	
															
														
													</div>
												
												
												</div>
												
											
									
										<?php }	
									?>
								
									
								</div>
								<!--end-->
								<div class="center">
								</div>
								
								</div>
							</div>
				  
				  
				  
				  
				  
				  
				  
				  
				  
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
function logout () {
      var ans= confirm("are you sure to delete file");
		if(ans==true){
			window.open('logout.php?','_self');
		}
    }
	function showData(){
		$.ajax({
			type:"POST",
			url:"getvieworderDetails.php",
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
			url:"deleteregistrationDetails.php",
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
		window.open('ViewOrderDetailsAdmin.php?type=edit&id='+id,'_self');
		
	}
</script> 
<!-- endinject -->
<!-- Custom js for this page -->
<!-- End custom js for this page -->
</body>
</html>