<?php
session_start();
			
			require('config.php');
			// $sqll=mysqli_query($conn,"SELECT * FROM `cakeloginregister`");
			
			// signup form
			
		if(isset($_POST['name']) && isset($_POST['email'] )&& isset( $_POST["password"])){
			
		
			$email = filter_var($_POST['email'],FILTER_SANITIZE_STRING);
			$passw = filter_var($_POST["password"],FILTER_SANITIZE_STRING);
			$name = filter_var($_POST["name"],FILTER_SANITIZE_STRING);
			$type = 0;
			
			$sqlr="SELECT * FROM `cakeloginregister` WHERE (`email`='$email')";
			$res=mysqli_query($conn,$sqlr);
			
			if (mysqli_num_rows($res) > 0){
					
					$row = mysqli_fetch_assoc($res);
					$s_email=mysqli_real_escape_string($conn,$row['email']);
					if($email== $s_email )
					{		
							
						echo "<script>alert('email already exists');</script>";
						header('Location:index.php');
				
					}
					else{
						echo "<script>alert('something went wrong');</script>";
						// header('Location:index.php');
				
					}
			}
				if(!preg_match('/^[a-z0-9]+@[a-z\.]+$/i', $email))
				{
					
					 
					echo"<script>alert('please enter valid details');
						window.location.href='index.php';
					</script>";
					
				}
				else{
					
					$sqll ="INSERT INTO `cakeloginregister`(`email`, `password`,`name`,`type`,`approval`) VALUES ('$email','$passw','$name','$type','no')";
					$sqll = mysqli_query($conn,$sqll);
					echo "<script>alert('done  now login to add your fav items to cart');</script>";
					
					header('Location:index.php');
					
					
				}
			
		}
		
		
		//signup form complete
?>

<?php	
				// login page validationss
if(isset($_POST["lname"]) && isset($_POST["lemail"]) && isset($_POST["lpass"])){
		$username=filter_var($_POST["lname"],FILTER_SANITIZE_STRING);
		$login_email=filter_var($_POST["lemail"],FILTER_SANITIZE_STRING);
		$login_pass =filter_var( $_POST["lpass"],FILTER_SANITIZE_STRING);
				
		$sql = mysqli_query($conn,"SELECT * FROM `cakeloginregister` WHERE  `email`='$login_email' and BINARY `password`='$login_pass'");
		
		if(!filter_var($login_email, FILTER_VALIDATE_EMAIL)){
		$emailErr = "Invalid email format";
		echo $emailErr;
		}
		// if(preg_match('/^[0-9a-f]{50}$/', $login_pass)) {
			// $err_msg .= ' The password does not meet the requirements!';
			// echo $err_msg;
		// }
	else {
			if(mysqli_num_rows($sql)){
				
				$row=mysqli_fetch_assoc($sql);
				$approval=mysqli_real_escape_string($conn,$row['approval']);
				if($approval== 'yes'){
				$user_type = filter_var($row['type'],FILTER_SANITIZE_STRING);
				$_SESSION['shop_username']=filter_var($_POST["lname"],FILTER_SANITIZE_STRING);	
				$_SESSION['user_id']=filter_var($row["id"],FILTER_SANITIZE_STRING);	
				$_SESSION['type']=mysqli_real_escape_string($conn,$row["type"]);	
					if($user_type == 0){
						
						echo"<script> 
							alert ('successfully logged in as user 
							') ; 
							
						</script>";
						header('Location:index.php?user');
						
					}
					elseif($user_type == "ow436r"){
						header('Location:index.php?king');
						
						echo"<script> alert ('add your products to the shop ') ; 
								
						</script>";
					}
					else{
						echo"<script> alert ('not done login again') ;
							
						</script>";
						header('Location:index.php');
						
					}
				}
				if($approval == 'no'){
			
				echo'<script>alert("wait for admins approval");
				window.location.href="index.php";
				</script>';
			
				}
				
			
			}else{
				echo"<script> alert ('error not done login again') ; 
					window.location.href='index.php';
				</script>";
			}
			
			
	}
}
?>