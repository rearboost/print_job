<?php
  // database Connection
  require '../include/config.php';
  session_start();

//  Dispatch Jobs use id  update status start
   if (isset($_POST['addcomplete_job_edit']))
    {
        $addc_id = $_POST['addcomplete_job_edit'];
        $newstatus ="complete";

        $query ="UPDATE  jobs  SET state=?  WHERE id=?;";

        $stmt =mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$query))
        {
           echo "SQL Error";
        }
        else
        {
            mysqli_stmt_bind_param($stmt,"ss",$newstatus,$addc_id);
            $result =  mysqli_stmt_execute($stmt);
            if($result){
              echo "Success! Add To Complete";
            }
         }
    }

    // Dispatch Jobs  use id update status end


    //Dispatch Jobs php code strat
   if(isset($_POST['view_id']))
   {
     $val =$_POST['view_id'];
     $query_obj ="SELECT * FROM jobs WHERE id='".$val."'";
     $result_obj =mysqli_query($conn,$query_obj);

     $object_obj =mysqli_fetch_object($result_obj);
     echo json_encode($object_obj);

   }


   if(isset($_POST['form_bill']))
    {
        $job_edit =mysqli_real_escape_string($conn ,$_POST['job_edit']);

        $cash_edit =mysqli_real_escape_string($conn ,$_POST['cash_edit']);
        $change_edit =mysqli_real_escape_string($conn ,$_POST['change_edit']);
        $payment_edit =mysqli_real_escape_string($conn ,$_POST['payment_edit']);
        $dispatch_day_edit =mysqli_real_escape_string($conn ,$_POST['dispatch_day_edit']);

          $date = explode('-', $dispatch_day_edit);

          $dispatch_year  = $date[0];
          $dispatch_month = $date[1];

        $query_dispatch ="UPDATE  jobs  SET cash=?,change_amt=?,payment=?,dispatch_day=?,dispatch_year=?,dispatch_month=? WHERE id=?;";

        $stmt =mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$query_dispatch))
        {
           echo "SQL Error";
        }
        else
        {
            mysqli_stmt_bind_param($stmt,"sssssss",$cash_edit,$change_edit,$payment_edit,$dispatch_day_edit,$dispatch_year,$dispatch_month,$job_edit);
            $result =  mysqli_stmt_execute($stmt);
        }
    }

 ?>
