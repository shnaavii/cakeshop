<?php
session_start();
			require('cake_navfoot.php');
			require('config.php');
			
		if(isset($_SESSION['shop_username']) && isset($_SESSION['user_id'])){
			$sql=mysqli_query($conn,"SELECT * FROM `wishlist`");
			
?>
<html>
	<head>
		<title>Wishlist</title>
		<?php
		
			abc();
		
		?>
	</head>
	<body>
		<?php
		
			nv();
		
		?>
		<div class="p-3">
			<p class="display-2 ms-5"> Wishlist / <?php echo $_SESSION['shop_username']  ?></p>
		</div>
		<div>
			
			<table class="table w-100">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col" class="fs-3">
							<p>Product</p>
						</th>
						<th scope="col" class="fs-3">
							<p>Price</p>
						</th>
						<th scope="col" class=""></th>
						
					</tr>
				</thead>
				<tbody>
		<?php
				$totall = 0;
				$message='';
				if(mysqli_num_rows($sql) > 0 ){
							
						while($row = mysqli_fetch_array($sql)){
							
							if($_SESSION['shop_username'].$_SESSION['user_id'] == $row['name']){
								$cart_id = $row['id'];
							
							echo'	<form method="POST">
										<tr class="w-100">
											<th scope="row" >
												<button class="btn" type="submit" name="del">
													<i class="fa fa-trash" aria-hidden="true"></i>
												</button>
												<input type="hidden" name="id" value="'.$row['id'].'">
												
											</th>
											<td class="">
												<img src="images/'.$row['img'] .'" height="150px">
												<input type="hidden" value="'.$row['img'].'" name="wimg">
												<p>'.$row['productname'].'</p>
												<input type="hidden" value="'.$row['productname'].'" name="wname">
											</td>
											<td class="">
												<p>$'.$row['price'].'.00 </p>
												<input type="hidden" value="'.$row['price'].'" name="wprice">
												<input type="hidden" value="1" name="quann">
											</td>
											<td class="">
												<button class="btn bg-secondary-subtle" type="submit" name="addcart">Add to  Cart</button>
											</td>
										</tr>
									</form>
							';
							}
							if(isset($_POST["addcart"]) && isset($_POST["wimg"]) && isset($_POST["wname"]) && isset($_POST["wprice"]) && isset($_SESSION['shop_username']) && isset($_SESSION['user_id']) && isset($cart_id)){ 
								$img =$_POST['wimg'];
								$name =mysqli_real_escape_string($conn,$_POST['wname']);
								$price =mysqli_real_escape_string($conn,$_POST['wprice']);
								$quantt = mysqli_real_escape_string($conn,$_POST['quann']);
								
								$total= (int)$price * (int)$quantt;
								$inpuy_query=mysqli_query($conn,"SELECT  `price`,`productname` FROM `wishlist` WHERE `id`='".$cart_id."'");
									while( $roww = mysqli_fetch_assoc($inpuy_query)){
										
										if($roww['price'] == $_POST['wprice'] && $roww['productname']== $_POST['wname']){
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
							
							
						}
						if($message == 'yes'){
						echo '<script>alert("inserted in cart..!!")</script>';
						}
						
						if(isset($_POST['del'])){
							
							$delete_query = mysqli_query($conn,"DELETE FROM `wishlist` WHERE `id`='".$_POST['id']."'");
							
							if ($delete_query ) {
								
								echo "<script>alert('Record deleted successfully');
									window.location.href='wishlist.php';
								</script>";
								
								
							} else {
								echo "<script>alert(not deleted);</script>";
							}
							
						}
						
				}
?>
				</tbody>
			</table>
			
		</div>
	<script>
		
		</script>
		
	</body>
</html>
<?php
		}
		else{
	
			echo'
				<script>
					window.location.href ="index.php";
				</script>
			';
		}
		
		
?>