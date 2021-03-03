<?php	
	//error_reporting(0);
	require '../include/config.php';

	if(isset($_GET['item'])){	
		$item_name = $_GET['item'];

		$get_itemid = mysqli_query($conn, "SELECT id FROM product WHERE name='$item_name'");
		$data = mysqli_fetch_assoc($get_itemid);
		$item_id = $data['id'];

		$get_category = mysqli_query($conn, "SELECT category.category AS category_name FROM category INNER JOIN product_category ON category.id = product_category.category_id WHERE product_category.product_id='$item_id'");

		$count = mysqli_num_rows($get_category);

		if($count>0){
			while($row = mysqli_fetch_array($get_category)){
				echo '<option value ="'.$row['category_name'].'" >'.$row['category_name'].'</option>';
			}
		}else{
			echo '<option>No products available</option>';
		}
		
	}else{
		echo '<h1> Error</h1>';
	}



?>