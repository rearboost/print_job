<?php	
	require '../include/config.php';

	if(isset($_GET['year'])){	
		$year = $_GET['year'];

		$get_month = mysqli_query($conn, "SELECT DISTINCT(dispatch_month) as dispatch_month FROM jobs WHERE dispatch_year='$year' ORDER BY dispatch_month ASC") ;

		$count = mysqli_num_rows($get_month);

		if($count>0){
			echo '<option selected="" disabled="">Select Year First</option>';
			while($row = mysqli_fetch_array($get_month)){

                $dt = DateTime::createFromFormat('!m', $row['dispatch_month']);
                $text_month =  $dt->format('F');

				echo '<option value ="'.$row['dispatch_month'].'" >'.$row['dispatch_month']. ' | '  .$text_month.'</option>';
			}
		}else{
			echo '<option>No Months</option>';
		}
		
	}else{
		echo '<h1> Error</h1>';
	}



?>