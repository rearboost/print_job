<?php
  // database Connection
  require '../include/config.php';
  // session check
  include('../include/check.php');

//  Dispatch Jobs use id  update status start
   if (isset($_POST['addproduction_job_edit']))
    {
        $addp_id = $_POST['addproduction_job_edit'];
        $newstatus ="production";

        $query ="UPDATE  jobs  SET state=?, production_by=?  WHERE id=?;";

        $stmt =mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$query))
        {
           echo "SQL Error";
        }
        else
        {
            mysqli_stmt_bind_param($stmt,"sss",$newstatus,$_SESSION['email'],$addp_id);
            $result =  mysqli_stmt_execute($stmt);
            if($result){
              echo "Success! Add To Production";
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


if(isset($_POST['from_btn_edit']))
{
  $job_edit =mysqli_real_escape_string($conn ,$_POST['job_edit']);

  $user_description_edit =mysqli_real_escape_string($conn ,$_POST['user_description_edit']);

  $query ="UPDATE  jobs  SET user_description=?  WHERE id=?;";

  $stmt =mysqli_stmt_init($conn);
  if(!mysqli_stmt_prepare($stmt,$query))
  {
     echo "SQL Error";
  }
  else
  {
      mysqli_stmt_bind_param($stmt,"ss",$user_description_edit,$job_edit);
      $result =  mysqli_stmt_execute($stmt);
      if($result){
        echo "Successfully Updated!";
      }
  }
}

?>
