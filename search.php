<?php
	session_start();
	$email=$_SESSION['email'];
	$user=$_SESSION['user'];
include "dbconfig/db.php";
$query = mysqli_query($conn,"select * from patient where Email='$email'");
	$rows = mysqli_fetch_assoc($query);
	$num=mysqli_num_rows($query);
	if ($num == 1) {
		$name=$rows['Name'];
		$contact=$rows['Contact'];	
		$city=$rows['city'];
		$state=$rows['state'];
		$country=$rows['country'];
		$pcode=$rows['pincode'];	
	} 
	if(isset($_POST['filter'])){
		if(isset($_POST['place'])&&isset($_POST['gender'])){
			$query=$_POST['place'];
			$gender=$_POST['gender'];
			
			if(count($gender)==2){
				if(in_array('country', $query)){
					$sql1 = "Select * from doctor where Country='$country'";				
				}else if(in_array('state', $query)){
					$sql1 = "Select * from doctor where State='$state'";			
				}else if(in_array('city', $query)){
					$sql1 = "Select * from doctor where City='$city'";			
				}else if(in_array('town', $query)){
					$sql1 = "Select * from doctor where Pincode='$pcode'";			
				}else{
					$sql1 = "Select * from doctor";
				}
			}else{
				if(in_array('country', $query)){
					$sql1 = "Select * from doctor where Country='$country' and Gender='$gender[0]'";				
				}else if(in_array('state', $query)){
					$sql1 = "Select * from doctor where State='$state' and Gender='$gender[0]'";			
				}else if(in_array('city', $query)){
					$sql1 = "Select * from doctor where City='$city' and Gender='$gender[0]'";			
				}else if(in_array('town', $query)){
					$sql1 = "Select * from doctor where Pincode='$pcode' and Gender='$gender[0]'";			
				}else{
					$sql1 = "Select * from doctor where Gender='$gender[0]'";
				}
			}
			
		}else if(isset($_POST['gender'])){
			$gender=$_POST['gender'];
			if(count($gender)==2){
				$sql1 = "Select * from doctor";
			}else{
				$sql1 = "Select * from doctor where Gender='$gender[0]'";
			}
		}else if(isset($_POST['place'])){
			$query=$_POST['place'];
			if(in_array('country', $query)){
				$sql1 = "Select * from doctor where Country='$country'";				
			}else if(in_array('state', $query)){
				$sql1 = "Select * from doctor where State='$state'";			
			}else if(in_array('city', $query)){
				$sql1 = "Select * from doctor where City='$city'";			
			}else if(in_array('town', $query)){
				$sql1 = "Select * from doctor where Pincode='$pcode'";			
			}else{
				$sql1 = "Select * from doctor";
			}
		}
			
		
	
			
	
	}else{
		$sql1 = "Select * from doctor";
	}
	
	
$result1=mysqli_query($conn, $sql1);
$num=mysqli_num_rows($result1);
$i=0;
while($row1 = mysqli_fetch_array($result1)){
	//echo $row1['Name'];
	$doctors[$i]=$row1['Name'];
	$service[$i]=$row1['Service'];
	$specialist[$i]=$row1['Special'];
	$docmail[$i]=$row1['Email'];
	$docountry[$i]=$row1['Country'];
	$dp[$i]=$row1['Image'];
	$i++;

}
// $i=0;
// while($i<$num){
// 	echo $doctors[$i];
// 	echo $service[$i];
// 	echo $specialist[$i];
// 	echo $email[$i];
// 	$i++;
// }
?>
<!DOCTYPE html> 
<html lang="en">
	
<!-- Docter/search.php  30 Nov 2019 04:12:16 GMT -->
<head>
		<meta charset="utf-8">
		<title>Doctor</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<script src="assets/js/removebanner.js"></script>
		<!-- Favicons -->
		<link href="assets/img/favicon.png" rel="icon">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
		
		<!-- Datetimepicker CSS -->
		<link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css">
		
		<!-- Select2 CSS -->
		<link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
		
		<!-- Fancybox CSS -->
		<link rel="stylesheet" href="assets/plugins/fancybox/jquery.fancybox.min.css">
		
		<!-- Main CSS -->
		<link rel="stylesheet" href="assets/css/style.css">
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
	
	</head>
	<body>

		<!-- Main Wrapper -->
		<div class="main-wrapper">
		
			<!-- Header -->
			<header class="header">
				<nav class="navbar navbar-expand-lg header-nav">
					<div class="navbar-header">
						<a id="mobile_btn" href="javascript:void(0);">
							<span class="bar-icon">
								<span></span>
								<span></span>
								<span></span>
							</span>
						</a>
						<a href="search.php" class="navbar-brand logo">
							<img src="assets/img/logo.png" class="img-fluid" alt="Logo">
						</a>
					</div>
					<div class="main-menu-wrapper">
						<div class="menu-header">
							<a href="search.php" class="menu-logo">
								<img src="assets/img/logo.png" class="img-fluid" alt="Logo">
							</a>
							<a id="menu_close" class="menu-close" href="javascript:void(0);">
								<i class="fas fa-times"></i>
							</a>
						</div>
						<ul class="main-nav">
							<li>
								<a href="search.php">Home</a>
							</li>
							
							<li class="has-submenu active">
								<a href="#">Patients <i class="fas fa-chevron-down"></i></a>
								<ul class="submenu">
								    <li ><a href="patient-dashboard.php">Dashboard</a></li>
									<li class="active"><a href="search.php">Search Doctor</a></li>
					
									
									
									
									
									
									<li><a href="profile-settings.php">Profile Settings</a></li>
									<li><a href="change-password.php">Change Password</a></li>
									<li><a href="index.php">Logout</a></li>
								</ul>
							</li>	
						
							
						</ul>
					</div>		 
					<ul class="nav header-navbar-rht">
						<li class="nav-item contact-item">
							<div class="header-contact-img">
								<i class="far fa-hospital"></i>							
							</div>
							<div class="header-contact-detail">
								<p class="contact-header">Contact</p>
								<p class="contact-info-header"><?php echo $contact;?></p>
							</div>
						</li>
						
					</ul>
				</nav>
			</header>
			<!-- /Header -->
			
			<!-- Breadcrumb -->
			<div class="breadcrumb-bar">
				<div class="container-fluid">
					<div class="row align-items-center">
						<div class="col-md-8 col-12">
							<nav aria-label="breadcrumb" class="page-breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="search.php">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Search</li>
								</ol>
							</nav>
							
						</div>
						<!-- <div class="col-md-4 col-12 d-md-block d-none">
							<div class="sort-by">
								<span class="sort-title">Sort by</span>
								<span class="sortby-fliter">
									<select class="select">
										<option>Select</option>
										<option class="sorting">Rating</option>
										<option class="sorting">Popular</option>
										<option class="sorting">Latest</option>
										<option class="sorting">Free</option>
									</select>
								</span>
							</div>
						</div> -->
					</div>
				</div>
			</div>
			<!-- /Breadcrumb -->
			
			<!-- Page Content -->
			<div class="content">
				<div class="container-fluid">

					<div class="row">
						<div class="col-md-12 col-lg-4 col-xl-3 theiaStickySidebar">
						
							<!-- Search Filter -->
							<form method="POST" action="search.php">
		<div class="card search-filter">
			<div class="card-header">
				<h4 class="card-title mb-0">Search Filter</h4>
			</div>
			<div class="card-body">
			
			<div class="filter-widget">
				<h4>Search By</h4>
				<div>
					<label class="custom_check">
						<input type="checkbox" name="place[]" value="town">
						<span class="checkmark"></span> Your Town
					</label>
				</div>
				<div>
					<label class="custom_check">
						<input type="checkbox" name="place[]" value="city">
						<span class="checkmark"></span>Your City
					</label>
				</div>
				<div>
					<label class="custom_check">
						<input type="checkbox" name="place[]" value="state">
						<span class="checkmark"></span>Your State
					</label>
				</div>
				<div>
					<label class="custom_check">
						<input type="checkbox" name="place[]"  value="country">
						<span class="checkmark"></span>Your Country
					</label>
				</div>
			</div>
			<div class="filter-widget">
			<h4>Gender</h4>
									<div>
										<label class="custom_check">
											<input type="checkbox" name="gender[]" value="male">
											<span class="checkmark"></span> Male Doctor
										</label>
									</div>
									<div>
										<label class="custom_check">
											<input type="checkbox" name="gender[]" value="female">
											<span class="checkmark"></span> Female Doctor
										</label>
									</div>
			</div>
				<div class="btn-search">
					
					<button type="submit" class="btn btn-block" name="filter">
					<i class="fas fa-search"></i>	
					Search</button>
				</div>	
			</div>
		</div>
							<!-- /Search Filter -->
							
						</div>
</form>	
						<div class="col-md-12 col-lg-8 col-xl-9">

							<!-- Doctor Widget -->
						<?php	
						$i=0;
						while($i<$num){
						echo '<div class="card">
<div class="card-body">
<div class="doctor-widget">
	<div class="doc-info-left">
		<div class="doctor-img">
			<a href="">
				<img class="img-fluid" src="data:image/jpeg;base64,'.base64_encode($dp[$i]).'"   alt=""/>
			</a>
		</div>

		<div class="doc-info-cont">
			<h4 class="doc-name"><a href="doctor/doctor-profile.php">'.$doctors[$i].'</a></h4>
			<p class="doc-speciality">'.$specialist[$i].'</p>
			<div class="clinic-details">
		<p class="doc-location"><i class="fas fa-map-marker-alt"></i> , '.$docountry[$i].'</p>
	</div>
			
			<div class="clinic-services">
				<span>'.$service[$i].'</span>
				
				
			</div>
		</div>
	</div>
	<div class="doc-info-right">
		
		<div class="clinic-booking">
		
			<a class="apt-btn" href="booking.php?dmail=\''.$docmail[$i].'\'">Book Appointment</a>
		</div>
	</div>
</div>
</div>
</div>';

$i++;
						}
							?>
							

							
						</div>
					</div>

				</div>

			</div>		
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
		<script src="assets/js/jquery.min.js"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="assets/js/popper.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		
		<!-- Sticky Sidebar JS -->
        <script src="assets/plugins/theia-sticky-sidebar/ResizeSensor.js"></script>
        <script src="assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js"></script>
		
		<!-- Select2 JS -->
		<script src="assets/plugins/select2/js/select2.min.js"></script>
		
		<!-- Datetimepicker JS -->
		<script src="assets/js/moment.min.js"></script>
		<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
		
		<!-- Fancybox JS -->
		<script src="assets/plugins/fancybox/jquery.fancybox.min.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>
		
	</body>

<!-- Docter/search.php  30 Nov 2019 04:12:16 GMT -->
</html>