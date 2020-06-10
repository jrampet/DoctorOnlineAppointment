<?php
	session_start();
	$email=$_SESSION['email'];
	include "../dbconfig/db.php";
	if(isset($_POST["insert"]))  
	{  
	
		 $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));  
	
		 $queries= "update doctor set Image='".$file."' WHERE Email='$email'";
		 if(mysqli_query($conn, $queries))  
		 {  
			  echo '<script>alert("Image Inserted into Database")</script>';  
		 }  
	} 
	if(isset($_POST["insertproof"]))  
	{  
	
		 //$file = addslashes(file_get_contents($_FILES["imaged"]["tmp_name"]));  
		$file=null;
		 $queries= "update doctor set Proof='".$file."' WHERE Email='$email'";
		 if(mysqli_query($conn, $queries))  
		 {  
			  echo '<script>alert("Document Inserted into Database")</script>';  
		 }  
	} 
	$query = mysqli_query($conn,"select * from doctor where Email='$email'");
	$rows = mysqli_fetch_assoc($query);
	$num=mysqli_num_rows($query);
	if ($num == 1) {
		$name=$rows['Name'];
		$contact=$rows['Contact'];
		$special=$rows['Special'];
		$gender=$rows['Gender'];
		$dob=$rows['DOB'];
		$bio=$rows['BIO'];
		$cname=$rows['ClinicName'];
		$caddress=$rows['ClinicAddress'];
		$ccity=$rows['City'];
		$ccstate=$rows['State'];
		$ccountry=$rows['Country'];
		$cpcode=$rows['Pincode'];
		$service=$rows['Service'];
		$generalization=$rows['Special'];
		
	} 
	if (isset($_POST['login'])){
		$gender=$_POST['gender'];
		$dob=$_POST['dob'];
		$bio=$_POST['biography'];
		$cname=$_POST['cname'];
		$caddress=$_POST['caddress'];
		$ccity=$_POST['ccity'];
		$ccstate=$_POST['cstate'];
		$ccountry=$_POST['ccountry'];
		$cpcode=$_POST['cpcode'];
		$service=$_POST['services'];
		$generalization=$_POST['specialist'];
		//$sql = "INSERT INTO doctor (Gender,DOB,BIO,ClinicName,ClinicAddress,City,State,Country,Pincode,Service,Special)VALUES ('$gender','$dob','$bio','$cname','$caddress','$ccity','$ccity','$ccstate'',$ccountry','$cpcode','$service','$generalization') ";
		$sql = "UPDATE doctor SET Gender='".$gender."',DOB='".$dob."',BIO='".$bio."',ClinicName='".$cname."',		ClinicAddress='".$caddress."',City='".$ccity."',State='".$ccstate."',Country='".$ccountry."',Pincode='".$cpcode."',Service='".$service."',Special='".$generalization."' WHERE Email='$email'";
   
        if (mysqli_query($conn,$sql)){
                echo "Updated";
                }
			else
			{
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
	
	}
	
?>


<!DOCTYPE html> 
<html lang="en">
	
<!-- Docter/doctor-profile-settings.php  30 Nov 2019 04:12:14 GMT -->
<head>
		<meta charset="utf-8">
		<title>Doctor</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		 <script src="../assets/js/removebanner.js"></script>
		<!-- Favicons -->
		<link href="../assets/img/favicon.png" rel="icon">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="../assets/plugins/fontawesome/css/fontawesome.min.css">
		<link rel="stylesheet" href="../assets/plugins/fontawesome/css/all.min.css">
		
		<!-- Select2 CSS -->
		<link rel="stylesheet" href="../assets/plugins/select2/css/select2.min.css">
		<link rel="stylesheet" href="../assets/css/bootstrap-datetimepicker.min.css">
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="../assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css">
		
		<link rel="stylesheet" href="../assets/plugins/dropzone/dropzone.min.css">
		
		<!-- Main CSS -->
		<link rel="stylesheet" href="../assets/css/style.css">
			<!-- Image uploading -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
	
	</head>
	<body>

		<!-- Main Wrapper -->
		<div class="main-wrapper">
		
			<!-- Header -->
		
			<!-- /Header -->
			
			<!-- Breadcrumb -->
			<div class="breadcrumb-bar">
				<div class="container-fluid">
					<div class="row align-items-center">
						<div class="col-md-12 col-12">
							<nav aria-label="breadcrumb" class="page-breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="doctor-dashboard.php">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Profile Settings</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Profile Settings</h2>
						</div>
					</div>
				</div>
			</div>
			<!-- /Breadcrumb -->
			
			<!-- Page Content -->
			<div class="content">
				<div class="container-fluid">

					<div class="row">
						<div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
						
							<!-- Profile Sidebar -->
							<div class="profile-sidebar">
								<div class="widget-profile pro-widget-content">
									<div class="profile-info-widget">
										<a href="#" class="booking-doc-img">
											<?php echo '<img src="data:image/jpeg;base64,'.base64_encode($rows['Image'] ).'"  class="img-thumnail" />  ';?>
										</a>
										<div class="profile-det-info">
											<h3><?php echo $name;?></h3>
											
											<div class="patient-details">
												<h5 class="mb-0"><?php echo $special;?></h5>
											</div>
										</div>
									</div>
								</div>
								<div class="dashboard-widget">
									<nav class="dashboard-menu">
										<ul>
											<li>
												<a href="doctor-dashboard.php">
													<i class="fas fa-columns"></i>
													<span>Dashboard</span>
												</a>
											</li>
											<li>
												<a href="appointments.php">
													<i class="fas fa-calendar-check"></i>
													<span>Appointments</span>
												</a>
											</li>
											<li>
												<a href="my-patients.php">
													<i class="fas fa-user-injured"></i>
													<span>My Patients</span>
												</a>
											</li>
											
											
											<li class="active">
												<a href="doctor-profile-settings.php">
													<i class="fas fa-user-cog"></i>
													<span>Profile Settings</span>
												</a>
											</li>
											
											<li>
												<a href="doctor-change-password.php">
													<i class="fas fa-lock"></i>
													<span>Change Password</span>
												</a>
											</li>
											<li>
												<a href="../index.php">
													<i class="fas fa-sign-out-alt"></i>
													<span>Logout</span>
												</a>
											</li>
										</ul>
									</nav>
								</div>
							</div>
							<!-- /Profile Sidebar -->
							
						</div>
						<div class="col-md-7 col-lg-8 col-xl-9">
						
					
							<!-- Basic Information -->
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">Basic Information</h4>
									<div class="row form-row">
										<div class="col-md-12">
											<div class="form-group">
												<div class="change-avatar">
													<div class="profile-img">
														<?php echo '<img src="data:image/jpeg;base64,'.base64_encode($rows['Image'] ).'"  class="img-thumnail" />  ';?>
													</div>
		<form method="POST"  enctype="multipart/form-data" >
			<div class="upload-img">
				<div class="change-photo-btn">
					<span><i ></i> Select Photo</span>
					<input type="file" class="upload" name="image" id="image">
				</div>
				<small class="form-text text-muted">Allowed JPG, GIF or PNG. Max size of 2MB</small>
			</div>
			<div class="upload-img">
				<div class="change-photo-btn">
					<span><i class="fa fa-upload"></i> Upload Photo</span>
					<input type="submit" name="insert" id="insert" value="Insert" class="upload">
				
				</div>
				
			</div>
</form>
												</div>
											</div>
										</div>
											<form action="doctor-profile-settings.php" method="post" >
				<div class="col-md-6">
					<div class="form-group">
						<label>Doctor name <span class="text-danger">*</span></label>
						<input type="text" class="form-control" readonly value="<?php echo $name;?>" >
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Email <span class="text-danger">*</span></label>
						<input type="email" class="form-control" readonly value="<?php echo $email;?>">
					</div>
				</div>
				
				<div class="col-md-6">
					<div class="form-group">
						<label>Phone Number</label>
						<input type="text" class="form-control" readonly value="<?php echo $contact;?>">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Gender</label>
						<select class="form-control select" name="gender">
							<option><?php echo $gender;?></option>
							<option>Male</option>
							<option>Female</option>
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
				<label>Date of Birth</label>
				<div class="cal-icon">
						<input type="text" class="form-control datetimepicker"  value="<?php echo $dob;?>" name="dob">
													</div>
												</div>
				</div>
			</div>
		</div>
	</div>
							<!-- /Basic Information -->
		<form method="POST"  enctype="multipart/form-data" >
			<div class="upload-img">
				<div class="change-photo-btn">
					<span><i ></i> Proof for Doctor</span>
					<input type="file" class="upload" name="imaged" id="imageproof">
				</div>
				<small class="form-text text-muted">Submit any document that proves you are a doctor</small>
			</div>
			<div class="upload-img">
				<div class="change-photo-btn">
					<span><i class="fa fa-upload"></i> Upload Doc</span>
					<input type="submit" name="insertproof" id="insertproof" value="Insertproof" class="upload">
				
				</div>
				
			</div>
		</form>
							<!-- About Me -->
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">About Me</h4>
									<div class="form-group mb-0">
										<label>Biography</label>
										<textarea placeholder="<?php echo $bio;?>" class="form-control" value="<?php echo $bio;?>" rows="5" name="biography" > </textarea>
									</div>
								</div>
							</div>
							<!-- /About Me -->
							
							<!-- Clinic Info -->
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">Clinic Info</h4>
									<div class="row form-row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Clinic Name</label>
												<input type="text" class="form-control" name="cname" value="<?php echo $cname;?>">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Clinic Address</label>
												<input type="text" class="form-control" value="<?php echo $caddress;?>" name="caddress" >
											</div>
										</div>
									
									</div>
								</div>
							</div>
							<!-- /Clinic Info -->

							<!-- Contact Details -->
							<div class="card contact-card">
								<div class="card-body">
									<h4 class="card-title">Clinic Details</h4>
									<div class="row form-row">
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">City</label>
												<input type="text" class="form-control" value="<?php echo $ccity;?>" name="ccity">
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">State / Province</label>
												<input type="text" class="form-control" value="<?php echo $ccstate;?>" name="cstate">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Country</label>
												<input type="text" class="form-control" value="<?php echo $ccountry;?>" name="ccountry">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Postal Code</label>
												<input type="text" class="form-control" value="<?php echo $cpcode;?>" name="cpcode">
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- /Contact Details -->
							
							<!-- Pricing -->
						
							<!-- /Pricing -->
							
							<!-- Services and Specialization -->
	<div class="card services-card">
		<div class="card-body">
			<h4 class="card-title">Services and Specialization</h4>
			<div class="form-group">
				<label>Services</label>
				<input type="text" data-role="tagsinput" class="input-tags form-control" placeholder="Enter Services" name="services" value="<?php echo $service;?>"  id="services" name="service">
				<small class="form-text text-muted">Note : Type & Press enter to add new services</small>
			</div> 
			<div class="form-group mb-0">
				<label>Specialization </label>
				<input class="input-tags form-control" type="text" data-role="tagsinput" placeholder="Enter Specialization" name="specialist" value="<?php echo $generalization;?>"  id="specialist" >
				<small class="form-text text-muted">Note : Type & Press  enter to add new specialization</small>
			</div> 
		</div>              
	</div>
							<!-- /Services and Specialization -->
						 
							<!-- Education -->
							
							
							<div class="submit-section submit-btn-bottom">
								<button type="submit" class="btn btn-primary submit-btn" name="login" >Save Changes</button>
							</div>
							
						</div>
					</div>

				</div>

			</div>		
</form>
			<!-- /Page Content -->
   
			<!-- Footer -->
			<footer class="footer">
				
				<!-- Footer Top -->
				<div class="footer-top">
					<div class="container-fluid">
						<div class="row">
							<div class="col-lg-3 col-md-6">
							
								<!-- Footer Widget -->
								
								<!-- /Footer Widget -->
								
							</div>
							
							
								<!-- /Footer Widget -->
								
							</div>
							
						</div>
					</div>
				</div>
				<!-- /Footer Top -->
				
				<!-- Footer Bottom -->
                
				<!-- /Footer Bottom -->
				
			</footer>
			<!-- /Footer -->
		   
		</div>
		<!-- /Main Wrapper -->
	  
		<!-- jQuery -->
		<script src="../assets/js/jquery.min.js"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="../assets/js/popper.min.js"></script>
		<script src="../assets/js/bootstrap.min.js"></script>
		
		<!-- Sticky Sidebar JS -->
        <script src="../assets/plugins/theia-sticky-sidebar/ResizeSensor.js"></script>
        <script src="../assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js"></script>
		
		<!-- Select2 JS -->
		<script src="../assets/plugins/select2/js/select2.min.js"></script>
		
		<!-- Dropzone JS -->
		<script src="../assets/plugins/dropzone/dropzone.min.js"></script>
		<script src="../assets/js/moment.min.js"></script>
		<script src="../assets/js/bootstrap-datetimepicker.min.js"></script>
		<!-- Bootstrap Tagsinput JS -->
		<script src="../assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.js"></script>
		
		<!-- Profile Settings JS -->
		<script src="../assets/js/profile-settings.js"></script>
		
		<!-- Custom JS -->
		<script src="../assets/js/script.js"></script>

		
		
	</body>

<!-- Docter/doctor-profile-settings.php  30 Nov 2019 04:12:15 GMT -->
</html>