<?php
  // database Connection
  require '../include/config.php';
  // session check
  include('../include/check.php');

// Logic Delete the  Inbound Requests  use id start
   if (isset($_GET['j_delete_id']))
    {
        $id = $_GET['j_delete_id'];
        $query ="DELETE FROM  jobs WHERE id=?;";
        $stmt =mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$query))
        {
           echo "SQL Error";
        }
        else
        {
            mysqli_stmt_bind_param($stmt,"s",$id);
            $result =  mysqli_stmt_execute($stmt);
        }
    }
    // Logic Delete the  Inbound Requests  use id end


    //Inbound Requests php code strat
   if(isset($_POST['view_id']))
   {
     $val =$_POST['view_id'];
     $query_obj ="SELECT * FROM jobs WHERE id='".$val."'";
     $result_obj =mysqli_query($conn,$query_obj);

     $object_obj =mysqli_fetch_object($result_obj);
     echo json_encode($object_obj);

   }

   // Inbound Requests form form submit btn update details php code strat
    if(isset($_POST['from_btn_edit']))
    {
      //  echo $_POST['job_edit'];
        $job_edit =mysqli_real_escape_string($conn ,$_POST['job_edit']);

        $quantity_edit =mysqli_real_escape_string($conn ,$_POST['quantity_edit']);
        $material_edit =mysqli_real_escape_string($conn ,$_POST['material_edit']);
        $size_edit =mysqli_real_escape_string($conn ,$_POST['size_edit']);
        $bind_edit =mysqli_real_escape_string($conn ,$_POST['bind_edit']);
        // $colour_edit =mysqli_real_escape_string($conn ,$_POST['colour_edit']);

        $budget_edit =mysqli_real_escape_string($conn ,$_POST['budget_edit']);
        $discount_edit =mysqli_real_escape_string($conn ,$_POST['discount_edit']);
        $discounted_edit =mysqli_real_escape_string($conn ,$_POST['discounted_edit']);
        $ad_pay_amount_edit =mysqli_real_escape_string($conn ,$_POST['ad_pay_amount_edit']);
        $rest_edit =mysqli_real_escape_string($conn ,$_POST['rest_edit']);
        $date_edit =mysqli_real_escape_string($conn ,$_POST['date_edit']);

        $admin_description_edit =mysqli_real_escape_string($conn ,$_POST['admin_description_edit']);
        $status_edit =mysqli_real_escape_string($conn ,$_POST['status_edit']);

        $query ="UPDATE  jobs  SET material=?,size=?,bind=?,date=?,quantity=?,budget=?,discount=?,discounted=?,ad_pay_amount=?,rest=?,admin_description=?,state=?  WHERE id=?;";

        $stmt =mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$query))
        {
           echo "SQL Error";
        }
        else
        {
            mysqli_stmt_bind_param($stmt,"sssssssssssss",$material_edit,$size_edit,$bind_edit,$date_edit,$quantity_edit,$budget_edit,$discount_edit,$discounted_edit,$ad_pay_amount_edit,$rest_edit,$admin_description_edit,$status_edit,$job_edit);
            $result =  mysqli_stmt_execute($stmt);
        }
    }


  if(isset($_POST['form_btn_submit'])){

    $cust_id =mysqli_real_escape_string($conn ,$_POST['cust_id']);
    $customer =mysqli_real_escape_string($conn ,$_POST['customer']);
    $contact =mysqli_real_escape_string($conn ,$_POST['contact']);
    $address =mysqli_real_escape_string($conn ,$_POST['address']);

    $channel =mysqli_real_escape_string($conn ,$_POST['channel']);
    $type =mysqli_real_escape_string($conn ,$_POST['type']);
    $item =mysqli_real_escape_string($conn ,$_POST['item']);
    $category =mysqli_real_escape_string($conn ,$_POST['category']);

    $qty =mysqli_real_escape_string($conn ,$_POST['qty']);
    $material =mysqli_real_escape_string($conn ,$_POST['material']);
    $size =mysqli_real_escape_string($conn ,$_POST['size']);
    $bind =mysqli_real_escape_string($conn ,$_POST['bind']);

    $budget =mysqli_real_escape_string($conn ,$_POST['budget']);
    $discount =mysqli_real_escape_string($conn ,$_POST['discount']);
    $discounted =mysqli_real_escape_string($conn ,$_POST['discounted']);
    $ad_pay_amount =mysqli_real_escape_string($conn ,$_POST['ad_pay_amount']);
    $rest =mysqli_real_escape_string($conn ,$_POST['rest']);
    $date =mysqli_real_escape_string($conn ,$_POST['date']);

    $admin_description =mysqli_real_escape_string($conn ,$_POST['admin_description']);

    $sqli = mysqli_query($conn,"SELECT MAX(id) as max_no FROM jobs ORDER BY id ASC");

    $data   = mysqli_fetch_assoc($sqli);
    $max_no = $data['max_no']+1; 

    $duration = date('Ymdhis');
    $job_no   = $duration . $max_no;

    $status ="request";
    $by     = $_SESSION['email'];       

    if($cust_id=='')
    {
        $customer_insert = mysqli_query($conn, "INSERT INTO customer (customer_name,contact,address) VALUES ('$customer','$contact','$address')");

        $job_insert = mysqli_query($conn, "INSERT INTO jobs (job_no,customer,channel,job_type,product,  category,material,size,bind,colour,date,quantity,budget,discount,discounted,ad_pay_amount,rest,admin_description,state, accepted_by) VALUES ('$job_no','$customer','$channel','$type','$item','$category','$material','$size','$bind','red','$date','$qty','$budget','$discount','$discounted','$ad_pay_amount','$rest','$admin_description','$status','$by')");

    }else{
         $job_insert = mysqli_query($conn, "INSERT INTO jobs (job_no,customer,channel,job_type,product,  category,material,size,bind,colour,date,quantity,budget,discount,discounted,ad_pay_amount,rest,admin_description,state, accepted_by) VALUES ('$job_no','$customer','$channel','$type','$item','$category','$material','$size','$bind','red','$date','$qty','$budget','$discount','$discounted','$ad_pay_amount','$rest','$admin_description','$status','$by')");
        
    }
    if($job_insert){
        echo "Successfull!";
    }else{
        echo "Failed!";
    }

  }

 ?>
