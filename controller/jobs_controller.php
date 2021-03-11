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
            if($result){
              header("location:../content/jobs.php"); // redirects to all records page
              exit;
            }
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

   // // Inbound Requests form form submit btn update details php code strat
   //  if(isset($_POST['from_btn_edit']))
   //  {
   //    //  echo $_POST['job_edit'];
   //      $job_edit =mysqli_real_escape_string($conn ,$_POST['job_edit']);

   //      $quantity_edit =mysqli_real_escape_string($conn ,$_POST['quantity_edit']);
   //      $material_edit =mysqli_real_escape_string($conn ,$_POST['material_edit']);
   //      $size_edit =mysqli_real_escape_string($conn ,$_POST['size_edit']);
   //      $bind_edit =mysqli_real_escape_string($conn ,$_POST['bind_edit']);
   //      // $colour_edit =mysqli_real_escape_string($conn ,$_POST['colour_edit']);

   //      $budget_edit =mysqli_real_escape_string($conn ,$_POST['budget_edit']);
   //      $discount_edit =mysqli_real_escape_string($conn ,$_POST['discount_edit']);
   //      $discounted_edit =mysqli_real_escape_string($conn ,$_POST['discounted_edit']);
   //      $ad_pay_amount_edit =mysqli_real_escape_string($conn ,$_POST['ad_pay_amount_edit']);
   //      $rest_edit =mysqli_real_escape_string($conn ,$_POST['rest_edit']);
   //      $date_edit =mysqli_real_escape_string($conn ,$_POST['date_edit']);

   //      $admin_description_edit =mysqli_real_escape_string($conn ,$_POST['admin_description_edit']);
   //      $status_edit =mysqli_real_escape_string($conn ,$_POST['status_edit']);

   //      $query ="UPDATE  jobs  SET material=?,size=?,bind=?,date=?,quantity=?,budget=?,discount=?,discounted=?,ad_pay_amount=?,rest=?,admin_description=?,state=?  WHERE id=?;";

   //      $stmt =mysqli_stmt_init($conn);
   //      if(!mysqli_stmt_prepare($stmt,$query))
   //      {
   //         echo "SQL Error";
   //      }
   //      else
   //      {
   //          mysqli_stmt_bind_param($stmt,"sssssssssssss",$material_edit,$size_edit,$bind_edit,$date_edit,$quantity_edit,$budget_edit,$discount_edit,$discounted_edit,$ad_pay_amount_edit,$rest_edit,$admin_description_edit,$status_edit,$job_edit);
   //          $result =  mysqli_stmt_execute($stmt);
   //      }
   //  }

 ?>
