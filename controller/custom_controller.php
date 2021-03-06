<?php
  // database Connection
  require '../include/config.php';
  // session check
  include('../include/check.php');

// Logic Delete the  Inbound Requests  use id start
   if (isset($_GET['c_delete_id']))
    {
        $id = $_GET['c_delete_id'];
        $query ="DELETE FROM  customer WHERE id=?;";
        $stmt =mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$query))
        {
           echo "SQL Error";
        }
        else
        {
            mysqli_stmt_bind_param($stmt,"s",$id);
            $result =  mysqli_stmt_execute($stmt);
            if($result){
              header("location:../content/customer.php"); // redirects to all records page
              exit;
            }
        }
    }
    // Logic Delete the  Inbound Requests  use id end


    //Inbound Requests php code strat
   if(isset($_POST['view_id']))
   {
     $val =$_POST['view_id'];
     $query_obj ="SELECT * FROM customer WHERE id='".$val."'";
     $result_obj =mysqli_query($conn,$query_obj);

     $object_obj =mysqli_fetch_object($result_obj);
     echo json_encode($object_obj);

   }

   // Inbound Requests form form submit btn update details php code strat
    if(isset($_POST['form_customer_edit']))
    {
      //  echo $_POST['job_edit'];
        $customerid_edit =mysqli_real_escape_string($conn ,$_POST['customerid_edit']);

        $customer_edit =mysqli_real_escape_string($conn ,$_POST['customer_edit']);
        $contact_edit =mysqli_real_escape_string($conn ,$_POST['contact_edit']);
        $address_edit =mysqli_real_escape_string($conn ,$_POST['address_edit']);

        $query ="UPDATE customer SET customer_name=?,contact=?,address=? WHERE id=?;";

        $stmt =mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$query))
        {
           echo "SQL Error";
        }
        else
        {
            mysqli_stmt_bind_param($stmt,"ssss",$customer_edit,$contact_edit,$address_edit,$customerid_edit);
            $result =  mysqli_stmt_execute($stmt);
        }
    }


  if(isset($_POST['form_customer_submit'])){

    $customer =mysqli_real_escape_string($conn ,$_POST['customer']);
    $contact =mysqli_real_escape_string($conn ,$_POST['contact']);
    $address =mysqli_real_escape_string($conn ,$_POST['address']);

    $customer_insert = mysqli_query($conn, "INSERT INTO customer (customer_name,contact,address) VALUES ('$customer','$contact','$address')");
        
    if($customer_insert){
        echo "Successfull!";
    }else{
        echo "Failed!";
    }

  }

 ?>
