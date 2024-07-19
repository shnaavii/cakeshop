<!DOCTYPE html>
<?php
			session_start();
			
			$conn = mysqli_connect("localhost","root","","sample");
			
			$limit = 6;
			$page = $_GET['page'] ?? 1;
			$start = ($page - 1) * $limit;
			
			if(!$conn){
				mysqli_connect_error();
			}
			$_SESSION['id']=0;
			$_SESSION['idd']=6;
			$sql=mysqli_query($conn,"SELECT * FROM `cakeshop` LIMIT $start, $limit");
?>
<html>
	<head>
		<title>shop of cake</title>
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
			$low="low_to_high";
			$high="high_to_low";
		?>
	<div class="container whole d-flex w-100 p-3">
			<div class="fisrt rounded  ps-2 pe-2 me-5">
				<div class="m-3 ms-0">
					<form method='POST'>
						<div class="dropdown ">
							<button class="btn border border-2 pe-4  ps-4 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
								Select to Sort
							</button>
							<ul class="dropdown-menu">
								<li>
									<a class="dropdown-item" href="sort.php?sortedby=<?php echo $low ?>">Sort By price low to high</a>
								</li>
								<li>
									<a class="dropdown-item" href="sort.php?sortedby=<?php echo $high ?>">Sort By price high to low</a>
								</li>
								<li>
									<a class="dropdown-item" href="#">Sort by popularity</a>
								</li>
							</ul>
						</div>
						<!--<select class="form-select" aria-label="Default select example">
							<option selected>Default Sorting</option>
							<a href=''>
								<option value="1" name="low_to_high">
									Sort By price low to high
								</option>
							</a>
							<option value="2" name="high_to_low">
								<a href='sort.php?sortedby=hello'>Sort by price high to low </a>
							</option>
							<option value="3" name="popular">
								Sort by popularity
							</option>
						</select> -->
					</form>
				</div>
<?php 	
		
		$i=0;
		$message='';
			if(mysqli_num_rows($sql) > 0){
				while($row = mysqli_fetch_assoc($sql)){
				
					$_SESSION['id']++;	
					$_SESSION['idd']++;
					$cart_id = $row['id'];
					
					echo '
					<form method="POST" class="shopc  me-4" style="float:left;">
						<div class="card mb-3  me-2 shopc " >
							<section class="image1 card-img-top">
								<div class="like-add bg-light position-absolute">
									<div class=" h-75 w-50 border m-1" style="position:relative;">
										<button class="btn cartadd" type="submit" name="add" >
											<input type="checkbox" class="plus-checkbox"  id="plus-checkbox'.$_SESSION['id'].'">
											<label for="plus-checkbox'.$_SESSION['id'].'" class="fa fa-plus fs-5 p-2 text-dark css-label-plusadd" ></label>
											<label for="plus-checkbox'.$_SESSION['id'].'" class="fas fa-check fs-5 p-2 css-label-add" style="">	 </label>
										</button>
									</div>
									<div class="h-75 w-50 border m-1 position-relative"   >
										<button name="like" class="btn  ">
											<input type="checkbox" class="heart-checkbox"  id="heart-checkbox'.$_SESSION['id'].'">
											<label for="heart-checkbox'.$_SESSION['id'].'" class="heart fs-4 ">&#10084;</label>
										</button>
									</div>
								</div>
								<img src="images/'.$row['image'].'" width="100%" >
								<input class="form-control" value="'.$row['image'].'"readonly="readonly"  name="image" type="hidden">
							</section>
							<div class="card-body text-center">
								<p class="card-title fw-semibold fs-3">'.$row['productname'].'</p>
								<input class="form-control" value="'.$row['productname'].'" readonly="readonly"  name="pro_name" type="hidden">
								<p class="card-text fs-5">Caramel   , Confiseurs</p>
								<pre class="card-text mainprice">$'.$row['price'].'.00</pre>
								
								<input class="form-control" value='.$row['price'].' id="'.$_SESSION['id'].'" name="pricee" readonly="readonly"   type="hidden" >
								
								<input class="form-control" value="1" readonly="readonly"  name="quann" type="hidden">
								
							</div>
						</div>
					</form>';
					
					if(isset($_POST["add"]) && isset($_POST["image"]) && isset($_POST["pro_name"]) && isset($_POST["pricee"]) && isset($_SESSION['shop_username']) && isset($_POST['quann']) && isset($_SESSION['user_id']) && isset($cart_id)){ 
						$img =$_POST['image'];
						$name =$_POST['pro_name'];
						$price =$_POST['pricee'];
						$quantt = $_POST['quann'];
						
						$total= (int)$price * (int)$quantt;
						$inpuy_query=mysqli_query($conn,"SELECT  `price`,`productname` FROM `cakeshop` WHERE `id`='".$cart_id."'");
							while( $roww = mysqli_fetch_assoc($inpuy_query)){
								
								if($roww['price'] == $_POST['pricee'] && $roww['productname'] == $_POST['pro_name']){
									if(mysqli_num_rows($inpuy_query)!=0){
										if(mysqli_num_rows($sql)!=0 ){
											
											$add_query= mysqli_query($conn,"INSERT INTO `cart`(`name`,`img`, `productname`, `price`, `quantity`,`total`) VALUES ('".$_SESSION['shop_username']."".$_SESSION['user_id']."','".$img."','".$name."','".$price."','".$quantt."','".$total."')");
											
											
										}
										$message = 'yes';	
									}
								}
								else{
									// $message = 'not done';
								}
								
							
							}
						
					}
					
					
					if(isset($_POST["like"]) && isset($_POST["image"]) && isset($_POST["pro_name"]) && isset($_POST["pricee"]) && isset($_SESSION['shop_username']) && isset($_POST['quann']) && isset($_SESSION['user_id'])){
						$img =$_POST['image'];
						$name =$_POST['pro_name'];
						$price =$_POST['pricee'];
						$quantt = $_POST['quann'];
						$total= (int)$price * (int)$quantt;
						$inpuy_query=mysqli_query($conn,"SELECT  `price` FROM `cakeshop` WHERE `id`='".$cart_id."'");
						
						while( $roww = mysqli_fetch_assoc($inpuy_query)){
								
								if($roww['price'] == $_POST['pricee']){
									if(mysqli_num_rows($inpuy_query)!=0){
										$add_query= mysqli_query($conn,"INSERT INTO `wishlist`(`name`,`img`, `productname`, `price`) VALUES ('".$_SESSION['shop_username']."".$_SESSION['user_id']."','".$img."','".$name."','".$price."')");
										
										if($add_query){
											echo"<script>alert('Added to Wishlist');</script>";
										
										}
										else{
											echo"<script>alert('error adding to cart');</script>";
										}

									}
								}
						}
					}
					
				}
				
							
					if($message == 'yes'){
						echo '<script>alert("inserted in cart..!!")</script>';
					}
							
			}				 
?>				
				
				<div class="w-100" style="float:left;">	
					<nav aria-label="Page navigation example">
						<ul class="pagination justify-content-center">
							
							<li class="page-item"><a class="page-link" href="shop.php">1</a></li>
							<li class="page-item"><a class="page-link" href="shop2.php">2</a></li>
							<li class="page-item"><a class="page-link" href="shop3.php">3</a></li>
							
						</ul>
					</nav>
				</div>
			</div>		
			<div class="searchdiv">
				<nav class="navbar bg-body-tertiary w-100">
					<div class="container-fluid">
						<form class="d-flex" role="search" method="POST">
							<input class="form-control me-2" name="searchh" type="search" placeholder="Search" aria-label="Search">
							<button class="btn btn-outline-success" name="s_submit" type="submit">Search</button>
						</form>
					<?php
						if(isset($_POST['s_submit']) && isset($_POST['searchh'])){
							$word=$_POST['searchh'];
							// header('Location:search.php?word='.$word.'');
							echo'<script>
									window.location.href="search.php?word='.$word.'";
								</script>';
						}
					?>
					</div>
				</nav>
				<ul class="list-group m-2">
					<p class="fs-3 fw-semibold">Categories</p>
					<li class="list-group-item">Appetizing</li>
					<li class="list-group-item">Candy</li>
					<li class="list-group-item">Chocobar</li>
					<li class="list-group-item">Chocolate</li>
					<li class="list-group-item">Hot Chocolate</li>
					<li class="list-group-item">Specialities</li>
					<li class="list-group-item">Sweet</li>
				</ul>
				<div class="m-2">
					<p class="fs-2 ">Popular Products</p>
					<div class="card mb-3 d-flex flex-row" style="max-width: 540px;">
						<div class="col-md-4">
							<img src="shop1.jpg" class="img-fluid rounded-start" alt="...">
						</div>
						
						<div class="card-body">
							<h5 class="card-title">Creme Brulle</h5>
							<pre class="card-text">$52.00</pre>
							
						</div>
					</div>
					
					<div class="card mb-3 d-flex flex-row " style="max-width: 540px;">
						<div class="">
							<img src="shop2.jpg" class="img-fluid rounded-start" alt="...">
						</div>
						<div class="card-body">
							<h5 class="card-title">Dark Pralines</h5>
							<pre class="card-text">$21.00</pre>
							
						</div>
					</div>
					<div class="card mb-3 d-flex flex-row " style="max-width: 540px;">
						<div class="">
							<img src="shop3.jpg" class="img-fluid rounded-start" alt="...">
						</div>
						<div class="card-body">
							<h5 class="card-title">Coconut</h5>
							<pre class="card-text">$44.00</pre>
							
						</div>
					</div>

				</div>
				<!--filterdiv -->
				
				<!--follow us div-->
				<div class="container">
					<div class="" style="height:290px;">
						<img src="insta-follow.jpg" height="100%">
					</div>
					<p class="fs-3 text-center">Follow US</p>
					<div class="all-icons d-flex flex-row justify-content-between ms-5" style="height:40px;">
							<img src="facebook.svg">
							<img src="twitter-154.svg">
							<img src="pintrest.svg">
							<img src="youtube.svg">
							<img src="instagram.svg">
					</div>
				</div>
			</div>
		
	</div>
		<?php
				ft();
		?>
			
	</body>
</html>
	