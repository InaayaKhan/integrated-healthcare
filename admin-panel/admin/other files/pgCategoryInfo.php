<!DOCTYPE html>
<?php
session_start();
if(!isset($_SESSION["bausername"])){
		header("Location:index.php");
	}
?>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Bike Customization</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="../css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="../css/clean-blog.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
* {
    box-sizing: border-box;
}

/* Create two equal columns that floats next to each other */
.column {
    float: left;
    width: 12.5%;
    padding: 10px;
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}
/* Style the buttons */
.btn {
    border: none;
    outline: none;
    padding: 12px 16px;
    background-color: #f1f1f1;
    cursor: pointer;
}

.btn:hover {
    background-color: #ddd;
}

.btn.active {
    background-color: #666;
    color: white;
}


</style>
  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand" href="pgAdminPanel.php">Bike Customization</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
           <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="pgAdminPanel.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pgCustomerInfo.php">Customer</a>
            </li>
			<li class="nav-item">
              <a class="nav-link" href="pgCategoryInfo.php">Category</a>
            </li>
			<li class="nav-item">
              <a class="nav-link" href="pgProductInfo.php">Spare Parts</a>
            </li>
			<li class="nav-item">
              <a class="nav-link" href="pgPriority.php">Priority</a>
            </li>
			<li class="nav-item">
              <a class="nav-link" href="pgUserAllOrder.php">View Order</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pgChangePassword.php">Change Password</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pgLogout.php">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Header -->
    <header class="masthead"style="background-image: url('../img/ism.jpg')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="site-heading">
              <h2>Category Master </h2>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <div class="container">
	<form method="post" enctype="multipart/form-data">
      <div class="row">
        <div class="col-lg-12 col-md-12 mx-auto">

			<div class="control-group">
				  <div class="form-group controls">
					<label>Category Name</label>
					<input type="text" class="form-control" placeholder="Name" id="txtCategoryName" required data-validation-required-message="Please enter your category name."/>
					<p class="help-block text-danger"></p>
				  </div>
            </div>
			<div class="control-group">
				  <div class="form-group col-xs-12 controls">
					<label>Category Photo</label><br>
					<input type="file" name="txtCategoryImage" id="txtCategoryImage">
					<p class="help-block text-danger"></p>
				  </div>
            </div><br>
			
			<div class="control-group">
				  <div class="form-group controls">
					<label>Category Description</label>
					<textarea rows="4" cols="50"type="text" class="form-control" placeholder="Category Description" id="txtCategoryDescription" required data-validation-required-message="Please enter your category description."/></textarea>
					<p class="help-block text-danger"></p>
				  </div>
            </div>
			
          <br>
				
			<label>Status</label>	
			<select id="selStatus">
				<option value="On">On</option>
				<option value="Off">Off</option>
			</select>
				  <br>
				  <input type="tel" class="form-control" id="pTxt" hidden>
			<!--<p id="pTxt" class="txt"></p>-->
	<p id="counted"></p>
			</div>
				  
				  
			</div><br>
			
			<input type="hidden" id="hdnID">
			<div class="form-group">
              <center><input type="submit" id="btnSubmit" class="btn btn-primary" onclick="saveCategoryDetails();" style="background-color: #0085a1;" value="Save"></center>
            </div>
			
			<table id="tableData" border="1" width="100%">
			</table>
			
				</form>
          <!-- Pager -->
        </div>

    <hr>

    <!-- Footer -->
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <ul class="list-inline text-center">
              <li class="list-inline-item">
                <a href="#">
                  <span class="fa-stack fa-lg">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                  </span>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <span class="fa-stack fa-lg">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                  </span>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <span class="fa-stack fa-lg">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-github fa-stack-1x fa-inverse"></i>
                  </span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="../css/jquery/jquery.min.js"></script>
    <script src="../css/bootstrap/js/bootstrap.bundle.min.js"></script>

	<script src="jquery.form.min.js"></script>
	
    <!-- Custom scripts for this template -->
    <script src="../js/clean-blog.min.js"></script>

<script>
$(document).ready(function(){
	showData();
});

 
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
	
	function saveCategoryDetails(){
		
		if($("#btnSubmit").val()=="Save"){
				//alert("k");
				$('form').ajaxForm({
					
				type:"POST",
				url:"saveCategoryDetails.php",
					data:{categoryname:$("#txtCategoryName").val(),categorydescription:$("#txtCategoryDescription").val(),status:$("#selStatus").val()},
					success:function(response){
					 console.log(response);
					},
					complete:function(response){
					console.log(response);
					var resp=response.responseText;
					console.log(resp);
						if($.trim(resp)=="Success"){
							alert("Details Saved Successfully");
							$("#txtCategoryName").val("");
							$("#txtCategoryDescription").val("");
							$("#txtCategoryImage").val("");
							//window.location.assign("pgCustomerLogin.php")
							showData();
							}
						else if($.trim(resp)=="categoryname"){
							alert("Enter Category Name ");
							$("#txtCategoryName").focus();
						}
						else if($.trim(resp)=="categorydescription"){
							alert("Enter Category Description");
							$("#txtCategoryDescription").focus();
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
							$("#txtCategoryName").val("");
							$("#txtCategoryDescription").val("");
							$("#txtCategoryImage").val("");
							
						}
					}
				});
		}
		else{
			$('form').ajaxForm({
					
				type:"POST",
				url:"editCategoryDetails.php",
					data:{id:$("#hdnID").val() ,categoryname:$("#txtCategoryName").val(),categorydescription:$("#txtCategoryDescription").val(),status:$("#selStatus").val()},
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
							$("#btnSubmit").val("Save");
							//window.location.assign("pgCustomerLogin.php")
							showData();
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

	
	function showData(){
	var id = getUrlVars()["id"];
		$.ajax({
			type:"POST",
			url:"getCategoryDetails.php",
			data:{},
			success:function(response){
				$("#tableData").html(response);
			}
		});
	}
	
	function editRecord(id){
	flag=1;
	//alert(flag);
		$("#hdnID").val(id);
		$("#txtCategoryName").val($("#Category_Name"+id).html());
		$("#txtCategoryDescription").val($("#Category_Description"+id).html());
		$("#selStatus").val($("#Status"+id).html());
		$("#btnSubmit").val("Edit");
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
</script>	
	
  </body>
</html>