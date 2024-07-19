<!DOCTYPE html>
<?php
			session_start();
			require('cake_navfoot.php');
			require('config.php');
			
			$limit = 6;
			$page = $_GET['page'] ?? 4;
			$start = ($page - 1) * $limit;
			
			
			$_SESSION['id']=0;
			$_SESSION['idd']=6;
			$sql=mysqli_query($conn,"SELECT * FROM `cakeshop` LIMIT $start, $limit");
?>
<html>
	<head>
		<title>shop  page 3</title>
		<?php
			
			
			abc();
		
		?>
		<style>
			
		</style>
	</head>
	<body>
		<?php
		
			nv();
		
		?>
	<div class="container whole d-flex w-100 p-3">
			<div class="fisrt rounded  ps-2 pe-2 me-5">
				<div class="m-3 ms-0">
					<select class="form-select" aria-label="Default select example">
						<option selected>Default Sorting</option>
						<option value="1">Sort By price low to high</option>
						<option value="2">Sort by price high to low</option>
						<option value="3">Sort by popularity</option>
					</select>
				</div>
<?php 	
		//$cart_id=[];
		$i=0;
		$message='';
			if(mysqli_num_rows($sql) > 0){
				while($row = mysqli_fetch_assoc($sql)){
					//$i++;
					$_SESSION['id']++;	
					$_SESSION['idd']++;
					$cart_id =mysqli_real_escape_string($conn, $row['id']);
					
					$product_name= mysqli_real_escape_string($conn,$row['productname']);
					$price= mysqli_real_escape_string($conn,$row['price']);
					$image= mysqli_real_escape_string($conn,$row['image']);
					
					
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
								<input class="form-control" value="'.$image.'"readonly="readonly"  name="image" type="hidden">
							</section>
							<div class="card-body text-center">
								<p class="card-title fw-semibold fs-3">'.$product_name.'</p>
								<input class="form-control" value="'.$product_name.'" readonly="readonly"  name="pro_name" type="hidden">
								<p class="card-text fs-5">Caramel   , Confiseurs</p>
								<pre class="card-text mainprice">$'.$price.'.00</pre>
								
								<input class="form-control" value='.$price.' id="'.$_SESSION['id'].'" name="pricee" readonly="readonly"   type="hidden" >
								
								<input class="form-control" value="1" readonly="readonly"  name="quann" type="hidden">
								
							</div>
						</div>
					</form>';
					
					if(isset($_POST["add"]) && isset($_POST["image"]) && isset($_POST["pro_name"]) && isset($_POST["pricee"]) && isset($_SESSION['shop_username']) && isset($_POST['quann']) && isset($_SESSION['user_id']) && isset($cart_id)){ 
						$img =filter_var($_POST['image'],FILTER_SANITIZE_STRING);
						$name =filter_var($_POST['pro_name'],FILTER_SANITIZE_STRING);
						$price =filter_var($_POST['pricee'],FILTER_SANITIZE_STRING);
						$quantt =filter_var($_POST['quann'],FILTER_SANITIZE_STRING);
						
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
						$name =filter_var($_POST['pro_name'],FILTER_SANITIZE_STRING);
						$price =filter_var($_POST['pricee'],FILTER_SANITIZE_STRING);
						$quantt =filter_var($_POST['quann'],FILTER_SANITIZE_STRING);
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
							<li class="page-item"><a class="page-link" href="shop4.php">4</a></li>
							
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
							$word=filter_var($_POST['searchh'],FILTER_SANITIZE_STRING);
							// header('Location:search.php?word='.$word.'');
							echo'<script>
									window.location.href="search.php?word='.$word.'";
								</script>';
						}
						$A ="Appetizing";
						$B ="Candy";
						$C ="Chocolate";
						$D ="Specialities";
						$E ="Sweet";
					?>
					</div>
				</nav>
				<ul class="list-group m-2">
					<p class="fs-3 fw-semibold">Categories</p>
					<li class="list-group-item"><a href="category.php?cat=<?php echo $A ?>" class="text-decoration-none text-dark " >Appetizing </a></li>
					<li class="list-group-item"><a href="category.php?cat=<?php echo $B ?>" class="text-decoration-none text-dark " >Candy </a></li>
					<li class="list-group-item"><a href="category.php?cat=<?php echo $C ?>" class="text-decoration-none text-dark " >Chocolate </a></li>
					<li class="list-group-item"><a href="category.php?cat=<?php echo $D ?>" class="text-decoration-none text-dark " >Specialities</a></li>
					<li class="list-group-item"><a href="category.php?cat=<?php echo $E ?>" class="text-decoration-none text-dark " >Sweet</a></li>
				</ul>
				<div class="m-2">
					<p class="fs-2 ">Popular Products</p>
					<div class="card mb-3 d-flex flex-row" style="max-width: 540px;">
						<div class="col-md-4">
							<img src="images/shop1.jpg" class="img-fluid rounded-start" alt="...">
						</div>
						
						<div class="card-body">
							<h5 class="card-title">Creme Brulle</h5>
							<pre class="card-text">$52.00</pre>
							
						</div>
					</div>
					
					<div class="card mb-3 d-flex flex-row " style="max-width: 540px;">
						<div class="">
							<img src="images/shop2.jpg" class="img-fluid rounded-start" alt="...">
						</div>
						<div class="card-body">
							<h5 class="card-title">Dark Pralines</h5>
							<pre class="card-text">$21.00</pre>
							
						</div>
					</div>
					<div class="card mb-3 d-flex flex-row " style="max-width: 540px;">
						<div class="">
							<img src="images/shop3.jpg" class="img-fluid rounded-start" alt="...">
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
						<img src="images/insta-follow.jpg" height="100%">
					</div>
					<p class="fs-3 text-center">Follow US</p>
					<div class="all-icons d-flex flex-row justify-content-between ms-5" style="height:40px;">
							<img src="images/facebook.svg">
							<img src="images/twitter-154.svg">
							<img src="images/pintrest.svg">
							<img src="images/youtube.svg">
							<img src="images/instagram.svg">
					</div>
				</div>
			</div>
		
	</div>
		<?php
				ft();
		?>
			
	</body>
</html>
	