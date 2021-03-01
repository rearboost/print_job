<?php
    // session check
   include('../include/check.php');
   // Database Connection
   require '../include/config.php';

// Inbound Requests form submit btn insert details php code start                 
  if(isset($_POST['form_btn_submit'])){

    $cust_id =mysqli_real_escape_string($conn ,$_POST['cust_id']);
    $customer =mysqli_real_escape_string($conn ,$_POST['customer']);
    $contact =mysqli_real_escape_string($conn ,$_POST['contact']);
    $address =mysqli_real_escape_string($conn ,$_POST['address']);

    $channel =mysqli_real_escape_string($conn ,$_POST['channel']);
    $type =mysqli_real_escape_string($conn ,$_POST['type']);
    $item =mysqli_real_escape_string($conn ,$_POST['item']);

    
    $budget =mysqli_real_escape_string($conn ,$_POST['budget']);
    $discount =mysqli_real_escape_string($conn ,$_POST['discount']);
    $discounted =mysqli_real_escape_string($conn ,$_POST['discounted']);

    $ad_pay_amount =mysqli_real_escape_string($conn ,$_POST['ad_pay_amount']);
    $rest =mysqli_real_escape_string($conn ,$_POST['rest']);
    $date =mysqli_real_escape_string($conn ,$_POST['date']);

    $admin_description =mysqli_real_escape_string($conn ,$_POST['admin_description']);

    

    $sqli = mysqli_query($conn,"SELECT MAX(id) as max_no FROM jobs ORDER BY id ASC");

    $data = mysqli_fetch_array($sqli);
    $max_no = $data['max_no']; 
    $duration   = date("Ymdhisa");
    $job_no = $duration . $max_no;

    $status ="request";
    $by     = $_SESSION['email'];

        

    if(empty($cust_id))
    {
        $customer_insert = "INSERT INTO jobs (customer,contact,address) VALUES (?,?,?);";

        $stmt =mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$customer_insert))
        {
           echo "SQL Error";
        }
        else
        {
            mysqli_stmt_bind_param($stmt,"sss",$customer,$contact,$address);
            $result =  mysqli_stmt_execute($stmt);
        }

        $job_insert = "INSERT INTO jobs (job_no,customer,channel,type,item,budget,discount,discounted,ad_pay_amount,rest,date,admin_description,state,accept_by) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?);";

        $stmt1 =mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt1,$job_insert))
        {
           echo "SQL Error";
        }
        else
        {
            mysqli_stmt_bind_param($stmt1,"ssssssssssssss",$job_no,$customer,$channel,$type,$item,$budget,$discount,$discounted,$ad_pay_amount,$rest,$date,$admin_description,$status,$by);
            $result1 =  mysqli_stmt_execute($stmt1);
        }
    }
    else
    {
         $job_insert = "INSERT INTO jobs (job_no,customer,channel,type,item,budget,discount,discounted,ad_pay_amount,rest,date,admin_description,state,accept_by) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?);";

        $stmt1 =mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt1,$job_insert))
        {
           echo "SQL Error";
        }
        else
        {
            mysqli_stmt_bind_param($stmt1,"ssssssssssssss",$job_no,$customer,$channel,$type,$item,$budget,$discount,$discounted,$ad_pay_amount,$rest,$date,$admin_description,$status,$by);
            $result1 =  mysqli_stmt_execute($stmt1);
        }
    }

  }
?>