<?php	
	//error_reporting(0);
	require '../include/config.php';

	if(isset($_GET['type'])){	
		$type_name = $_GET['type'];

		$get_typeid = mysqli_query($conn, "SELECT id FROM jobs_type WHERE type='$type_name'");
		$data = mysqli_fetch_assoc($get_typeid);
		$type_id = $data['id'];

		$get_products = mysqli_query($conn, "SELECT product.id AS product_id, product.name AS product_name FROM product INNER JOIN product_type ON product.id = product_type.product_id WHERE product_type.type_id='$type_id'");

		$count = mysqli_num_rows($get_products);

		if($count>0){
			echo '<option selected="" disabled="">Select Job Type First</option>';
			while($row = mysqli_fetch_array($get_products)){
				echo '<option value ="'.$row['product_id'].'" >'.$row['product_name'].'</option>';
			}
		}else{
			echo '<option>No products available</option>';
		}
		
	}else{
		echo '<h1> Error</h1>';
	}



?>