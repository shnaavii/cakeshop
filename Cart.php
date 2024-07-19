<?php
session_start();
			require('cake_navfoot.php');
			require('config.php');		
	if(isset($_SESSION['user_id'])){
		$sql=mysqli_query($conn,"SELECT * FROM `cart`");
			
?>
<html>
	<head>
		<title>cart cake</title>
		<?php
			
			abc();
			
		?>
	</head>
	<body>
		<?php
		
			nv();
		
		?>
		<div class="container p-3">
			<p class="display-2 "> Cart / <?php echo $_SESSION['shop_username']  ?></p>
			<p class="text-danger mbv-view"><small>*Scroll the table to see the subtotal </small></p>
		</div>
		<div class="container table-responsive">
			
			<table class="table w-100 ">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col" class="fs-3">Product</th>
						<th scope="col" class="fs-3">Price</th>
						<th scope="col" class="fs-3">Quantity</th>
						<th scope="col" class="fs-3">SubTotal</th>
					</tr>
				</thead>
				<tbody>
		<?php
		$totall = 0;
		$p=0;
		$message='';
		if(mysqli_num_rows($sql) > 0){
							
			while($row = mysqli_fetch_array($sql)){
							
				$p++;
				if($_SESSION['shop_username'].$_SESSION['user_id'] == $row['name'] ){
						
					$_SESSION['up_id']= mysqli_real_escape_string($conn,$row['id']);
					// $totall += (int)$row['total'];
					$id= mysqli_real_escape_string($conn,$row['id']);
					$img= mysqli_real_escape_string($conn,$row['img']);
					$productname= mysqli_real_escape_string($conn,$row['productname']);
					$price= mysqli_real_escape_string($conn,$row['price']);
					$totalrow =mysqli_real_escape_string($conn,$row['total']);
					$totall += (int)$totalrow;
					echo'<form method="POST">
							<tr class="w-100">
								<th scope="row" >
									<button class="btn"  name="del">
										<i class="fa fa-trash" aria-hidden="true"></i>
									</button>
									<input type="hidden" name="id" value="'.$id.'">
									
								</th>
								<td class="">
									<img src="images/'.$img .'" height="150px">
									<p>'.$productname.'</p>
								</td>
								<td class="">$'.$price.'.00</td>
								
								<td class="">
									
								
									<input type="number" class="form-control" min="1"  name="quantity" value="'.$row['quantity'].'" onkeyup="if(this.value<0 ){this.value= this.value * -1}">
									<input type="hidden" class="form-control" name="s_price" value="'.$row['price'].'">
									<button class="btn border m-1"  name="update_q" >Update</button>
								</td>
								<td class="">$'.$totalrow.'.00</td>
							</tr>
						</form>			
						';
				}
					
					
				if(isset($_POST['update_q']) && isset($id) && isset($_POST['quantity']) && isset($_POST['s_price'])){
						
					$quant = filter_var($_POST['quantity'],FILTER_SANITIZE_STRING);
					$priice = filter_var($_POST['s_price'],FILTER_SANITIZE_STRING);
			
					
					if(empty($_POST['quantity'])){
						$message="no";
					}
					else{
						$inpuy_query=mysqli_query($conn,"SELECT  `price` FROM `cart` WHERE `id`='".$id."'");
							while( $roww = mysqli_fetch_assoc($inpuy_query)){
								$ids=filter_var($_POST['id'],FILTER_SANITIZE_STRING);
								if($roww['price'] == $_POST['s_price']){
									$total= (int)$priice * (int)$quant;
									$updatequery = "UPDATE `cart` SET `quantity`='".$quant ."', `total`='".$total."' WHERE `id`=".$ids."";
									$query_run= mysqli_query($conn,$updatequery);
									if($query_run){
										echo'done';
										
										echo'<script>alert(" Updated The Cart");
										window.location.href = "Cart.php";
										</script>';
									}	
									else{
										echo'<script>alert("not done");</script>';
										}
								}
							}	
					}
								
				}
			}
			if($message == 'no'){
				echo'<script>alert("Please fill the Quantity");</script>';
			}
						
			if(isset($_POST['del'])){
				$ids=filter_var($_POST['id'],FILTER_SANITIZE_STRING);
				$delete_query = mysqli_query($conn,"DELETE FROM `cart` WHERE `id`='".$ids."'");
				
				if ($delete_query ) {
					
					echo "<script>alert('Record deleted successfully');
						window.location.href='Cart.php';
					</script>";
					
					
				} else {
					echo "<script>alert(not deleted);</script>";
				}
				
			}
			echo"
				<tr>
					<th class='w-25 fs-4'>Total Price</th>
					<td class='w-25 fw-semibold fs-4'>$".$totall.".00</td>
					<input type='hidden' name='total_value' value=".$totall.">
				</tr>	
			";
						
		}
?>
						
				</tbody>
			</table>
				
		</div>
		<a href="place_order.php?order='<?php echo $totall ?>'" class='btn border border-2 fs-3 shadow-sm mb-5 mt-3 ms-5'  name="placeorder">Place Order</a> 
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