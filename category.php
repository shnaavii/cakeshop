<?php
	session_start();
			require('cake_navfoot.php');
			require('config.php');
			
			$cat = $_GET['cat'];
		if(isset($_GET['cat'])){
			if($cat == 'Appetizing'){
				$sql = mysqli_query($conn, "SELECT * FROM `cakeshop` WHERE `Categories` = '$cat'");
			}
			elseif($cat == 'Candy'){
				$sql = mysqli_query($conn,"SELECT * FROM `cakeshop` WHERE `Categories` = '$cat'");
			}
			elseif($cat == 'Chocolate'){
				$sql=mysqli_query($conn,"SELECT * FROM `cakeshop` WHERE `Categories` = '$cat'");
			}
			elseif($cat == 'Specialities'){
				$sql=mysqli_query($conn,"SELECT * FROM `cakeshop` WHERE `Categories` = '$cat'");
			}
			elseif($cat == 'Sweet'){
				$sql=mysqli_query($conn,"SELECT * FROM `cakeshop` WHERE `Categories` = '$cat'");
			}
			else{
				$sql='';
			}
 ?>
<html>
	<head>
		<title>Sorted cakeshop products</title>
		<?php
			
			
			abc();
		
		?>
	</head>
	<body>
		<?php
		
			nv();
		
		?>
		<div class="container mt-5">
			<?php	


		$message='';
		if(!empty($sql)){
			if(mysqli_num_rows($sql) > 0){
				while($row = mysqli_fetch_assoc($sql)){	
				
					$_SESSION['id']++;	
					$_SESSION['idd']++;
					$cart_id = mysqli_real_escape_string($conn,$row['id']);
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
								<img src="images'.$row['image'].'" width="100%" >
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
						$img =$_POST['image'];
						$name =filter_var($_POST['pro_name'],FILTER_SANITIZE_STRING);
						$price =filter_var($_POST['pricee'],FILTER_SANITIZE_STRING);
						$quantt =filter_var( $_POST['quann'],FILTER_SANITIZE_STRING);
						
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
		}
			elseif(empty($sql)){
				echo'There was no such search results!';
			}
			else{
				echo'There was no such search results!';
			}
		
?>			

		</div>
</html>
<?php
}
		else{
			echo'There was no such search results!';
		}
?>