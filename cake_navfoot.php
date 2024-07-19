<?php
	
		
	 function abc(){
		 
		 echo'
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="cakes.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.6.0/remixicon.css" integrity="sha512-GL7EM8Lf8kU23I3kTio2kRWt8YRDVIQcSZjRVtVRfk05kB/QvkyafuTC94Ev0X6qk7Z0r5s06c1lsP1p/ezDYw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Arsenal&family=Cormorant:ital,wght@0,300..700;1,300..700&display=swap" rel="stylesheet">
		 ';
	 }
	
// navbar function
		function nv(){
			
			echo'
				<nav class="navbar navbar-expand-lg border-bottom">
			<div class="container-fluid">
				<div class="" style="height:100px;width:100px;float:left;">
					<img src="images/logoo.jpg" height="100%" width="100%">
				</div>
				<a class="navbar-brand fw-semibold fs-1 me-1 logo-font text-decoration-none" href="index.php" style="float:left;">Swiss Delight</a>
				<button class="navbar-toggler" type="button" style="float:left;" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse ms-5" id="navbarNavDropdown">
					<ul class="navbar-nav ">
						<li class="nav-item">
							<a class="nav-link  fs-4 me-3" aria-current="page" href="index.php">Home</a>
						</li>
						<li class="nav-item">
							<a class="nav-link fs-4 me-3" href="about_us.php">About us</a>
						</li>
						<li class="nav-item">
							<a class="nav-link fs-4 me-3" href="Cart.php">Cart</a>
						</li>
						<li class="nav-item ">
							<a class="nav-link  fs-4" href="shop.php" role="button" >	shop </a>
						</li>
						<li class="nav-item ">
							<a class="nav-link  pe-4 fs-4" href="wishlist.php" role="button" > Wishlist </a>
						</li>';
						if(isset($_SESSION['type']) && isset($_SESSION['user_id'])){
							$conn = mysqli_connect("localhost","root","","sample");
							if(!$conn){
								mysqli_connect_error();
							}
							$message='';
							if($_SESSION['type']== 'ow436r'){ 
								$queryy=mysqli_query($conn,"SELECT * FROM `cakeloginregister` WHERE `type`= '0'");
								
								echo'
								
								<button class="btn shadow-sm mb-3 ps-3 pe-3 me-3 btn-sm mt-2" style="max-width:18em;"> 
										<a class="text-decoration-none text-dark fs-4 " href="owner_upload.php?wow=ow436r">Admin Upload </a> 
								</button>
								
								<div class="dropdown">
									<button class="btn dropdown-toggle fs-5 mt-2 text-light" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color:#775144;">
										Approve Request
									</button>
									<ul class="dropdown-menu" style="width:50vh;">
								';
							while($roww = mysqli_fetch_assoc($queryy)){
									$emailid=mysqli_real_escape_string($conn,$roww['email']);
									echo'
										<li>
										<form method="POST" class="d-flex flex-row">
											<a class="dropdown-item" style="max-width:12em;" href="#">'.$roww['email'].'</a>  
											<input type="hidden" value="'.$roww['email'].'" name="eemail">
												<button class="btn border me-3" name="yes" >yes</button> 
												<button class="btn border"  name="no">No</button>
										
										</form>
										</li>
										';
									
								
								if(isset($_POST['yes']) && isset($_POST['eemail'])){
									// $rowws = mysqli_fetch_assoc($queryy);
									$approval_email=mysqli_real_escape_string($conn,$_POST['eemail']);
									if($emailid == $approval_email){
										$yesquery=mysqli_query($conn,"UPDATE `cakeloginregister` SET `approval`='yes' WHERE `email`='".$emailid."'");
										
										if($yesquery){
											echo'<script>alert("approoved");</script>';
											
										}
										else{
											echo'<script>alert("not approved");</script>';
										}
									}
								}
								if(isset($_POST['no'])  && isset($_POST['eemail'])){
									
									if($emailid == $approval_email){
										$yesquery=mysqli_query($conn,"UPDATE `cakeloginregister` SET `approval`='No' WHERE `email`='".$emailid."'");
										
										if($yesquery){
											echo'<script>alert("notapprooved");</script>';
											
										}
										else{
											echo'<script>alert("error");</script>';
										}
									}
									
								}
							}	
								echo'	</ul>
								</div>
								
								 	
							</ul>';
								
							}
							else{
								echo'<li class="fs-3 " style="float:left;"><i class="fas fa-user fs-5 pe-2"></i>'.$_SESSION['shop_username'].'</li>
								</ul>';
							}
						}
					echo '
					
											
						<!-- Button trigger modal -->';
						
						
						
						 
						 if(isset($_SESSION['shop_username']) && isset($_SESSION['user_id'])){
							echo '	<button type="button" class="btn border border-2 shadow float-end ms-5 " style="float:left; ">
										<a href="logout.php" class="text-decoration-none fs-4 text-dark">	Logout </a>
									</button>';
						 }else{
							echo'<button type="button" class="btn border border-2 shadow float-end ms-5 fs-4" style="float:left;" data-bs-toggle="modal" data-bs-target="#staticBackdrop" id="signip">
									Login/register
								</button>'; 
						 }
						
				echo'<!-- Modal -->
				
					<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
								
									<div class="modal-body">
										<p class="d-inline-flex gap-1 fs-5 w-100" >
											<a class="btn btn-primary w-50" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" onclick="getLocation()">
												Login
											</a>
											<button class="btn btn-primary w-50" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample2" >
												Register
											</button>
											

										</p>
										
										<div class="collapse" id="collapseExample">
											<div class="card card-body">
												<form method="POST" action="cake_sign_log_in.php">
													<div class="form-floating mb-3">
														<input type="text" class="form-control" name="lname" id="floatingInput4" placeholder="vaishnavi">
														<label for="floatingInput4">Username</label>
													</div>
													<div class="form-floating mb-3">
														<input type="email" class="form-control" name="lemail" id="floatingInput7" placeholder="name@example.com">
														<label for="floatingInput7">Email address</label>
													</div>
													<div class="form-floating">
														<input type="password" class="form-control" name="lpass" id="floatingPassword4" placeholder="password">
														<label for="floatingPassword4">Password</label>
													</div>
													<button type="submit" class="btn btn-primary m-2 w-50 fs-5" onclick="nosignup()" >login</button>
												</form>
											</div>
										</div>
										<div class="collapse" id="collapseExample2">
											<div class="card card-body">
												<form method="POST" action="cake_sign_log_in.php">
													<div class="form-floating mb-3">
														<input type="text" class="form-control" name="name" id="floatingInput1" placeholder="vaishnavi">
														<label for="floatingInput1">Username</label>
													</div>
													<div class="form-floating mb-3">
														<input type="email" class="form-control" name="email" id="floatingInput2" placeholder="name@example.com">
														<label for="floatingInput2">Email address</label>
													</div>
													<div class="form-floating">
														<input type="password" class="form-control" name="password" id="floatingPassword1" placeholder="Password">
														<label for="floatingPassword1">Password</label>
													</div>
													<button type="submit" class="btn  btn-primary m-2 w-50 fs-5">register</button>
													
												</form>
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
										
									</div>
								</div>
							</div>
					</div>
					
				</div>
			</div>
		</nav>
		
		

			';
		}
		
		// footer function
		
		function ft(){
			echo'
				<footer >
				<div class="container d-flex  end-footer mb-3">
					<ul class="list-group hello border m-4 ms-0" style="float:left;">
						<li class="list-group-item border-0 fs-3 fw-bold fontt" >Useful Links</li>
						<li class="list-group-item border-0 fs-5">About us</li>
						<li class="list-group-item border-0 fs-5">History</li>
						<li class="list-group-item border-0 fs-5">Our Locations</li>
						<li class="list-group-item border-0 fs-5">Todays Menu</li>
						<li class="list-group-item border-0 fs-5">Blog</li>
					</ul>
					<ul class="list-group me-3 hello border m-4 ms-0" style="float:left;">
						<li class="list-group-item border-0 fs-3 fw-bold fontt" >Favourite</li>
						<li class="list-group-item border-0	fs-5">Orange Pralines</li>
						<li class="list-group-item border-0	fs-5">Amaretti Oreo</li>
						<li class="list-group-item border-0	fs-5">Choco Mousse</li>
						<li class="list-group-item border-0	fs-5">Choclate Truffles</li>
						<li class="list-group-item border-0	fs-5">American cake</li>
					</ul>
					<div class="hello p-3" style="float:left;">
						<p class="fs-3 fw-bold fontt" >Newsletter</p>
						<p class="fs-5">Subscribe to get special offers, free gifts<br> and once-in-a-lifetime deals.</p>
						<div class="form-floating mb-3">
							<input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
							<label for="floatingInput" class="w-100 fw-bold fs-5">Email address <i class="far fa-envelope float-end fs-4"></i></label>
						</div>
						<div class="all-icons d-flex flex-row justify-content-between ms-5" style="height:40px;">
							<img src="images/facebook.svg">
							<img src="images/twitter-154.svg">
							<img src="images/pintrest.svg">
							<img src="images/youtube.svg">
							<img src="images/instagram.svg">
						</div>
						
					</div>
					<hr>
				</div>	
				
			</footer>
			';
		}
		
		
?>
