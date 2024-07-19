<?php
				session_start();
				if(isset($_REQUEST['url'])){
				$url=$_REQUEST['url'];
				$website = $url;
					if (!preg_match("'/^http?:\/\/(localhost|([a-z0-9-]+\.)+[a-z]{2,6}/i",$website)) {
						echo"<script>alert('Invalid URL');</script>";
					}
				}
?>
<html>
	<head>
		<title>index cake shop</title>
		<?php
			include('cake_navfoot.php');
			abc();
		
		?>
		<style>
				
		</style>
	</head>
	<body>
		<?php
		
			nv();
		
		?>
		
		<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
			<div class="carousel-inner">
				<div class="carousel-item active mainslider">
				<img src="images/slide1.jpg" class="d-block w-100 h-100" alt="...">
				</div>
				<div class="carousel-item mainslider">
				<img src="images/slide2.jpg" class="d-block w-100 h-100" alt="...">
				</div>
				<div class="carousel-item mainslider">
				<img src="images/slide3.jpg" class="d-block w-100 h-100" alt="...">
				</div>
				<div class="carousel-item mainslider">
				<img src="images/slide5.jpg" class="d-block w-100 h-100" alt="...">
				</div>
			</div>
			<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Previous</span>
			</button>
			<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Next</span>
			</button>
		</div>
		
		<center>
			<div class=" card-group w-100   p-3 pt-0 ">
				<div class="card rounded m-3 border-0 shadow-sm">
					<section class="image1 rounded" >
						<img src="images/box1.jpg" class="card-img object-fit-fill rounded" alt="...">
						<div class="card-img-overlay z-3">
							<h5 class="card-title mt-5 pt-5 fw-bold">Ice Cream</h5>
							<p class="card-text fw-semibold">Specialties with 100% cocoa</p>
						</div>
					</section>
				</div>
				<div class="card  rounded m-3 border-0 shadow-sm">
					<section class="image1 rounded">
						<img src="images/box2.jpg" class="card-img" alt="...">
						<div class="card-img-overlay z-3 ">
							<h5 class="card-title fw-bold mt-5 pt-5">Choco Nuts</h5>
							<p class="card-text fw-semibold">Specialties with 100% cocoa</p>
						</div>
					</section>
				</div>
				<div class="card rounded m-3 border-0 shadow-sm">
					<section class="image1 rounded">
						<img src="images/box3.jpg" class="card-img" alt="...">
						<div class="card-img-overlay z-3">
							<h5 class="card-title fw-bold mt-5 pt-5">Choco  Fruits</h5>
							<p class="card-text fw-semibold">Specialties with 100% cocoa</p>
						</div>
					</section>
				</div>
					<div class="card rounded m-3 border-0 shadow-sm">
					<section class="image1 rounded">
						<img src="images/box4.jpg" class="card-img" alt="...">
						<div class="card-img-overlay z-3">
							<h5 class="card-title fw-bold mt-5 pt-5">Gift Boxes</h5>
							<p class="card-text fw-semibold">Specialties with 100% cocoa</p>
						</div>
					</section>
				</div>
			</div>
			<div class="w-100 mb-5">
				<p class="fs-3" style="color:#C09891;">CHOCO LOVE</p>
				
				<h2 class="fw-semibold display-3" style="font-family: 'Cormorant', serif;color:#775144;">BAKED INTO A <br> TRUE PERFECTION</h2>
				<span class="fs-2 mb-3" style="color:#f2e4cd;">Delight</span>
			</div>
		</center>
			
			<div class="bg" style="background-image:url('images/hotc.png');">
				<div class="float-end wid " >
					<p class="hc fs-3 text-light" style="font-family: 'Cormorant', serif;">Hot Choclate</p>
					<p class="big display-3 fw-bold"style="font-family: 'Cormorant', serif;color:#f7dad9;text-shadow: .1em .1em 0 hsl(200 100% 20%);">THE SPECIAL TASTE</p>
					<button class="read fs-3"style="font-family: 'Cormorant', serif;">Read more  <i class="ri-arrow-right-line"></i> </button>
				</div>
			</div>
			<div class="w-100 p-3 cream" style="background-color:#FDF9EC;font-family: 'Cormorant', serif;">
					<a class="fs-2 text-decoration-none text-dark m-3 ps-4 pe-4" style="float:left;">
						<i class="ri-men-line p-2"></i>
						Customer Service
					</a>
					<a class="fs-2 text-decoration-none text-dark m-3 ps-4 pe-4"  style="float:left;">
						<i class="ri-price-tag-3-line p-1"></i>
						Buy Choclate Online
					</a>
					<a class="fs-2 text-decoration-none text-dark m-3 ps-4 pe-4"  style="float:left;">
						<i class="ri-map-pin-line p-2"></i>
						Find Us
					</a>
			</div>

			
			<?php
				ft();
			?>
	</body>
	
</html>