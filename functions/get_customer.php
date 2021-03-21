<?php	
// error_reporting(0);
	require '../include/config.php';

	if(isset($_POST["customer"]))  
	{  
		$output = '';  
		$query = "SELECT * FROM customer WHERE customer_name LIKE '%".$_POST["customer"]."%'";  
		$result = mysqli_query($conn, $query);  
		$output = '<ul class="pointer">';  
		if(mysqli_num_rows($result) > 0)  
		{  
			while($row = mysqli_fetch_array($result))  
			{  
					$output .= '<li>'.$row["customer_name"].'</li>';  
			}  
		}  
		else  
		{  
			$output .= '<li>Country Not Found</li>';  
		}  
		$output .= '</ul>';  
		echo $output;  
	} 


	if(isset($_POST["customerName"]))  
	{ 
		$val =$_POST['customerName'];
	    $get_name = mysqli_query($conn,"SELECT * FROM customer WHERE customer_name = '$val'");
		$data    = mysqli_fetch_array($get_name);
		$cust_id	 = $data['id'];
		$contact	 = $data['contact'];
		$address	 = $data['address'];

		$myObj->cust_id  = $cust_id;
		$myObj->contact  = $contact;
		$myObj->address  = $address;
		
		$myJSON = json_encode($myObj);

		echo $myJSON;
	}
 

?>