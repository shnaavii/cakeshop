<?php
	session_start();
$conn = mysqli_connect("localhost","root","","sample");

if(!$conn){
	mysqli_connect_error();
}
			
	
			$sql=mysqli_query($conn,"SELECT * FROM `cart`");
			// $row=mysqli_fetch_array($sql);
			
			// var_dump($row);
			
			// echo"<br>";
			// $id=$row['id'];
			// foreach($row as $key => $value){
				// $hii= $row['name'][$key];
				// echo $hii;
			// }
	$resultArr = array();//to store results
//to execute query
$executingFetchQuery = mysqli_query($conn,"SELECT `name` FROM `cart`");
if($executingFetchQuery)
{
	while($row= mysqli_fetch_array($executingFetchQuery)){
		$resultArr[]=$row['name'];
	
   // while($arr = $executingFetchQuery->fetch_assoc())
   // {
        // $resultArr[] = $arr['productname'];//storing values into an array
   }
}
 print_r($resultArr);//print the rows returned by query, containing specified columns

?>	
			
