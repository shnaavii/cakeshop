<?php
session_start();
		
			require('config.php');
	if(isset($_SESSION['shop_username']) && isset($_SESSION['user_id'])){
		
		if(isset($_POST['upload']) && isset($_POST['pname']) && isset($_POST['price'])){
			$name=filter_var($_POST['pname'],FILTER_SANITIZE_STRING);
		$price= filter_var($_POST['price'],FILTER_SANITIZE_STRING);
		$quant= filter_var($_POST['quantity'],FILTER_SANITIZE_STRING);
				$p=1;
				$b=6;
				$i=uniqid(1);
				foreach ($_FILES['uploadimage']['name'] as $key => $image) {
					$p++;
					$filenamee = $_FILES['uploadimage']['name'][$key];
					$i++;
					$filetempname = $_FILES['uploadimage']['tmp_name'][$key];
				
					
					if($p <= $b){
						move_uploaded_file($filetempname,"images/$i".$filenamee);
						mysqli_query($conn, "INSERT INTO `cakeshop`(`image`,`productname` ,`price`,`quantity`) VALUES ('$filenamee','$name','$price','$quant')");
						// $_SESSION['image']= $filenamee;
						// $_SESSION['productname']= $name;
						// $_SESSION['price']= $price;
						$_SESSION['quantity']= $quant;
					}
					else{
						echo"you cannot enter more than five images";
						// echo "The file already exists on the server. Please choose a different name.";
					
					}
				}	
				
		}
		else{
			echo "image not found!";
		}
		echo'
				<script>
					alert("done");
					window.location.href="shop.php";
					</script>';
	
	
	}
	else{
		echo'only admin can acess this page';
	}
?>