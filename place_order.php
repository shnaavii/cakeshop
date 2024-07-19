<?php
session_start();
			require('cake_navfoot.php');
			require('config.php');
	
	if(isset($_SESSION['shop_username']) && isset($_GET['order']) && isset($_SESSION['user_id'])){
?>
<html>
	<head>
		<title>cart cake</title>
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
		<div class="container">
			<form method="POST" action="">
				<p class="display-4 fontt ps-0 p-3 ">Billing details</p>
				<div class="columninput  me-5">
					<div class="form-floating mb-3 ">
						<input type="text" class="form-control shadow-sm" name="fullname" id="floatingInput6" placeholder="name">
						<label for="floatingInput6" class="fs-5">Full Name</label>
					</div>
				</div>
				<div class="columninput ">
					<div class="form-floating mb-3">
						<input type="text" class="form-control shadow-sm" name="address" id="floatingInput5" placeholder="address">
						<label for="floatingInput5" class="fs-5">Your Address</label>
					</div>
				</div>
				<div class="columninput me-5">
					<div class="form-floating mb-3">
						<input type="number" class="form-control shadow-sm" name="contact" id="floatingInput7" placeholder="number">
						<label for="floatingInput7" class="fs-5">Contact Number</label>
					</div>
				</div>
				<div class="columninput">
					<div class="form-floating mb-3 ">
						<input type="text" class="form-control shadow-sm" name="pincode" id="floatingInput8" placeholder="pincode">
						<label for="floatingInput8" class="fs-5">Pincode</label>
					</div>
				</div>
				<div class="columninput me-5">
					<select class="form-select fs-5 mb-3 shadow-sm" name="country_name" aria-label="Default select example">
						<option selected >Select Country</option>
						<option value="India">India</option>
						<option value="SouthKorea">SouthKorea</option>
						<option value="France">France</option>
					</select>
				</div>
				<div class="columninput ">
					<select class="form-select fs-5 mb-3 shadow-sm" name="states"  aria-label="Default select example">
						<option selected >State</option>
						<option value="Maharashtra">Maharashtra</option>
						<option value="Jammu and Kashmir">Jammu And Kashmir</option>
						<option value="Kerela">Kerela</option>
						<option value="Arunachal Pradesh">Arunachal Pradesh</option>
						<option value="Bihar">Bihar</option>
						<option value="west Bengal">West Bengal</option>
						<option value="Andhra Pradesh">Andhra Pradesh</option>
						<option value="Goa">Goa</option>
						<option value="Gujrat">Gujrat</option>
						<option value="Punjab">Punjab</option>
						<option value="Haryana">Haryana</option>
						<option value="Uttar Pradesh">Uttar Pradesh</option>
						<option value="Assam">Assam</option>
						<option value="Meghalaya">Meghalaya</option>
						<option value="Sikkim">Sikkim</option>
						<option value="Odisa">Odisa</option>
						<option value="Madhya Pradesh">Madhya Pradesh</option>
						<option value="Tamil Nadu">Tamil Nadu</option>
						<option value="Karnatak">Karnatak</option>
						<option value="Uttarakhand">Uttarakhand</option>
						<option value="Manipur">Manipur</option>
						<option value="Chattisgarh">Chattisgarh</option>
						<option value="Mizoram">Mizoram</option>
						<option value="Tripura">Tripura</option>
						<option value="Himachal Pradesh">Himachal Pradesh</option>
						<option value="Haryana">Haryana</option>
						<option value="Jharkhand">Jharkhand</option>
						<option value="Rajasthan">Rajasthan</option>
						<option value="Nagaland">Nagaland</option>
						<option value="Telengana">Telengana</option>
					</select>
				</div>
				<div class="columninput me-5">
					<div class="form-floating mb-3">
						<input type="text" class="form-control shadow-sm" name="city" id="floatingInput10" placeholder="pincode">
						<label for="floatingInput10" class="fs-5">City</label>
					</div>
				</div>
				<div class="columninput ">
					<div class="form-floating mb-3">
						<input type="email" class="form-control shadow-sm" name="pemail" id="floatingInput9" placeholder="email">
						<label for="floatingInput9" class="fs-5">Email</label>
					</div>
				</div>
				<div>
					<p class="display-4 fontt">Your Order</p>
					<table class=" w-100 p-5">
						<tbody>
							<tr class="w-100 m-1">
								<th scope="col" class="fs-2 fontt">Product</th>
								<th scope="col" class="fs-2 fontt">Subtotal</th>
								<th scope="col" class="fs-2 fontt">Price of one</th>
							</tr>
<?php						
						$cart_query=mysqli_query($conn,"SELECT * FROM `cart`");
						$i=0;
						$_SESSION['prod_quant']=array();
						$_SESSION['img']=array();
						$totall=0;
						
						$cart_id = [];
						if(mysqli_num_rows($cart_query) > 0 ){
						
							while($row = mysqli_fetch_array($cart_query)){
								$i++;
								
								if($_SESSION['shop_username'].$_SESSION['user_id'] == $row['name']){
									
									$cart_id[$i]=$row['id'];
									
									$_SESSION['img'][$i] = $row['img'];
									$totall += (int)$row['total'];
									$_SESSION['prod_quant'][$i]="".$row['productname']." x ".$row['quantity']."";
										echo'
										<tr class="fs-4 m-1">
											<td>
												<img src="images/'.$_SESSION['img'][$i].'" height="150px" >
											</td>
											<td class="p-3">
												'.$row['productname'].'<br>  x  '.$row['quantity'].'
												<input type="hidden" value="'.$_SESSION['prod_quant'][$i].'" name="product_quant[]">
												
												<input type="hidden" value="'.$_SESSION['img'][$i].'" name="cart_img">
												
											</td>
											<td>
													<p>$'.$row['total'].'.00 </p>
											</td>
											
										</tr>
										';
								}
							}
							
							echo"
								<tr class='fs-3 fw-semibold m-1'>
									<td>Total Payment</td>
									<td>$".$totall.".00</td>
								</tr>
							";
						}
						
						
						if(isset($_POST['confirm'])){
							$user=$_SESSION['shop_username']."_id:".$_SESSION['user_id'];
							$fullname=$_POST['fullname'];
							$address=$_POST['address'];
							$city=$_POST['city'];
							$state=$_POST['states'];
							$pincode=$_POST['pincode'];
							$contact= $_POST['contact'];
							$country =$_POST['country_name'];
							$email= $_POST['pemail'];
							
							$prod_qty= implode(',',$_SESSION['prod_quant']);
							$imgg= implode('*',$_SESSION['img']);
							
							$order_query="INSERT INTO `placeorder`(`username`, `Fullname`, `Address`, `City`, `State`, `pincode`, `Contact`, `country`, `Email`, `product and quantity`, `total`,`image`) VALUES ('$user','$fullname','$address','$city','$state','$pincode','$contact','$country','$email','$prod_qty','$totall','$imgg')";
							
							$sql_order=mysqli_query($conn,$order_query);
							
							if($sql_order ){ 
								
								mysqli_query($conn,"DELETE FROM `cart` WHERE `name`='".$_SESSION['shop_username'].$_SESSION['user_id']."'");
							
								echo"
								<script>
									alert('order placed !!');
									window.location.href='index.php';
								</script>";
							
							}
							else{
								echo"
								<script>
									alert('sorry order not placed');
								</script>
								";
							}
							
						}
		
?>
						</tbody>
					</table>
				</div>
				<button class="btn border fs-3 m-5 shadow-sm ms-0 text-light fontt" style="background-color:#A37774;" type="submit" name="confirm">Confirm Order</button>
			</form>
		</div>
		<hr>
		<?php
			ft();
		?>
	</body>
</html>
<?php
	}
	else{
		echo"dosent place order";
	}
?>