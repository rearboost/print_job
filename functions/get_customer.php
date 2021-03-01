<?php	
error_reporting(0);
	require '../include/config.php';
	
	 // $val =$_POST['customer'];
  //    $sql_obj ="SELECT * FROM jobs WHERE customer='$val'";
  //    $result_obj1 =mysqli_query($conn,$sql_obj);

  //    $object_obj1 =mysqli_fetch_object($result_obj1);
  //    echo json_encode($object_obj1);
	
	$val =$_POST['customer']; 

    $get_name = mysqli_query($conn,"SELECT * FROM customer WHERE customer_name='$val'");

	$data    = mysqli_fetch_array($get_name);

	$cust_id	 = $data['id'];
	$contact	 = $data['contact'];
	$address	 = $data['address'];

	$myObj->cust_id  = $cust_id;
	$myObj->contact  = $contact;
	$myObj->address  = $address;
	
	$myJSON = json_encode($myObj);

	echo $myJSON;
	//echo $mail;


?>