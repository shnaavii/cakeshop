<?php
	session_start();
			require('cake_navfoot.php');
			require('config.php');
	if(isset($_SESSION['user_id'])&& isset($_SESSION['shop_username']) && isset($_SESSION['type']) && isset($_GET['wow'])){
		// $value = $_GET['up_id'];
		$type_query=mysqli_query($conn,"SELECT * FROM `cakeloginregister` WHERE `type`='ow436r'");
		if($_SESSION['type'] == $_GET['wow']){
		
	
?>
<html>
	<head>
		<title>admin upload product </title>
		<?php
			
			abc();
		
		?>
	</head>
	<body>
		<?php
			nv();
		?>
		<div class="container mt-5 shadow p-3  mb-5">
			<h2> Fill Product Details</h2>
			<form method="POST" action="img_cake_upload.php" enctype="multipart/form-data" class=" w-100 p-3">
				<div class="input-group flex-nowrap m-2 admin-input" style="float:left;">
					<span class="input-group-text" id="addon-wrapping">upload image</span>
					<input type="file" name="uploadimage[]" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="addon-wrapping" multiple>
				</div>
				<div class="input-group flex-nowrap m-2 admin-input"  style="float:left;">
					<span class="input-group-text" id="addon-wrapping"> product name</span>
					<input type="text" name="pname" class="form-control" placeholder="product name" aria-label="Username" aria-describedby="addon-wrapping">
				</div>
				<div class="input-group flex-nowrap m-2 admin-input"   style="float:left;">
					<input type="hidden" name="id" />
					<span class="input-group-text" id="addon-wrapping"> product price</span>
					<input type="text" name="price" class="form-control" placeholder="product price" aria-label="Username" aria-describedby="addon-wrapping">
				</div>
				<div class="input-group flex-nowrap m-2 admin-input"  style="float:left;">
					<input type="hidden" name="id" />
					<span class="input-group-text" id="addon-wrapping">Quantity</span>
					<input type="number" name="quantity" class="form-control" placeholder="product price" aria-label="Username" aria-describedby="addon-wrapping">
				</div>
				
				<div class="input-group flex-nowrap m-2 admin-input" >
					<button type="submit" name="upload" class="btn border border-3 bg-secondary-subtle ms-2 mt-5 "  >Upload</button>
				</div>
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
	
	echo'you are not admin ';
			
		}
	}else{
		echo'
				<script>
					alert("you are not admin");
					window.location.href ="index.php";
				</script>
			';
	}
?>