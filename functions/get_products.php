<?php	
	//error_reporting(0);
	require '../include/config.php';
	if(isset($_POST['type_name'])){	
// 	$val =$_POST['type']; 

//     $get_id = mysqli_query($conn,"SELECT id FROM jobs_type WHERE type='$val'");

// 	$data    = mysqli_fetch_array($get_id);
// 	$type_id	 = $data['id'];

// // SELECT product_type.type_id,product.id,product.name FROM product INNER JOIN product_type ON product.id = product_type.product_id WHERE product_type.type_id='$type_id'

// 	$sql = "SELECT product.name AS name FROM product INNER JOIN product_type ON product.id = product_type.product_id WHERE product_type.type_id='$type_id'";

// 	$result = $mysqli->query($sql);
// 	$json = [];
// 	while($row = $result->fetch_assoc()){
// 		$json[$row['name']] = $row['name'];
// 	}
// 	echo json_encode($json);
	
		$get_typeid = mysqli_query($conn, "SELECT id FROM jobs_type WHERE type=".$_POST['type_name']);
		$data = mysqli_fetch_array($get_typeid);
		$type_id = $data['id'];

		$get_products = mysqli_query($conn, "SELECT product.name AS product_name FROM product INNER JOIN product_type ON product.id = product_type.product_id WHERE product_type.type_id='$type_id'");

		//$result = $mysqli->query($sql);
// 	$json = [];
 	while($row = $get_products->fetch_assoc()){
 		$products[$row['name']] = $row['name'];
 	}
 	echo json_encode($products);
	}



?>