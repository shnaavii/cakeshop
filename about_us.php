<?php
	session_start();
?>
<html>
	<head>
		<title>about cake</title>
		<?php
			include('cake_navfoot.php');
			abc();
		
		?>
	</head>
	<body>
		<?php
		
			nv();
		
		?>
		<div class="w-100">
			<img src="images/about-us-bg-img.jpg" width="100%" height="84%" class="object-fit-cover">
		</div>
		<div class="  pt-5" style="background-color:#fcf8ed;">
			<center>
				<p class="fs-4 p-1"> Choco Love</p>
				<p class="display-3 pt-1 logo-font ">ABOUT US</p>
				<div>
					<p class="fs-3 p-4 ">
						The Cake Shop is a Cake Studio specializing in Wedding cakes, Custom Cakes, and Dessert Bars. <br> We also offer a variety of bite sized treats.<br> Everything is made from scratch in house and with locally sourced ingredients when possible. <br>

						The Cake Shop is not a retail bakery. We are by appointment only. This way we can give each of our clients and their order the care and attention they deserve.<br> We love working with our clients to make their dessert dreams come true!
					</p>
				</div>
			</center>
		</div>
		<div class="container  d-flex about-div w-100">
			<div class="ab-img w-100 p-2 " style="">
				<img src="images/about-us-img-3.jpg" height="100%" >
			</div>
			<div class="p-3 fs-5 ms-2 w-100">
				<p class="display-3 text-center mt-1 fontt" style="color:#775144;">The woman behind the cakes</p>
				<p>I am Stacey Lorraine, the owner, cake artist, office manager and dishwasher of The Cake Shop! Born and raised near Washington DC, I got my start working at a bakery when I was 16. I immediately fell in love with everything baking. I applied and was accepted to The Culinary Institute of America where I received my AOS and BPS in baking and pastry. After graduating I spent a short stint in restaurants before finding my true passion- custom cakes. Since then, I’ve had the honor to work with and learn from, some of the best cake designers in the country. Following an internship at Mark Joseph Cakes in NYC, I spent 4 years decorating cakes at Betty Bakery and Cheryl Kleinman Cakes in Brooklyn, New York. I then spent 3 years at BAKED custom cakes in Seattle. I’ve designed and collaborated on several cakes that have been featured in different wedding magazines. I also have competed on several Food Network shows!
				</p>
			</div>
		</div>
		<div  style="background-color:#fcf8ed;">	
			<div class="container d-flex about-div justify-content-around  w-100" style="background-color:#fcf8ed;">
				<div class="p-3 fs-5 ms-2   w-100">
					<p class="display-3 text-center mt-1 fontt" style="color:#775144;">We Are open</p>
					<ul class="list-group " >
						<li class="list-group-item p-4 border-bottom border-0 rounded-0 border-2" style="background-color:#fcf8ed;">Mon - Fri     <span class="ms-5"> 10: 00 AM - 6: 00 PM </span></li>
						<li class="list-group-item p-4 border-bottom border-0 rounded-0 border-2" style="background-color:#fcf8ed;">Saturday    <span class="ms-5"> 11: 00 AM - 3: 00 PM </span></li>
						<li class="list-group-item p-4 border-bottom border-0 rounded-0 border-2" style="background-color:#fcf8ed;">Sunday     <span class="ms-5"> 11: 00 AM - 1: 00 PM </span></li>
						
					</ul>
				</div>
				<div class="ab-img w-100 p-4" style="">
					<img src="images/about-us-img-9.jpg" height="100%" >
				</div>
			</div>
		</div>
		<?php
				ft();
			?>
	</body>
</html>