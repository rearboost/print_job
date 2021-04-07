<?php
  // database Connection
  require '../include/config.php';
  // session check
  include('../include/check.php');

// Logic Delete the  Inbound Requests  use id start
   if (isset($_GET['j_delete_id']))
    {
        $id = $_GET['j_delete_id'];
        $query ="DELETE FROM web_product_type WHERE id=?;";
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
              header("location:../content/web_category.php"); // redirects to all records page
              exit;
            }
        }
    }
    // Logic Delete the  Inbound Requests  use id end


    //Inbound Requests php code strat
   if(isset($_POST['view_id']))
   {
     $val =$_POST['view_id'];
     $query_obj ="SELECT * FROM web_product_type WHERE id='".$val."'";
     $result_obj =mysqli_query($conn,$query_obj);

     $object_obj =mysqli_fetch_object($result_obj);
     echo json_encode($object_obj);

   }

   // Inbound Requests form form submit btn update details php code strat
    if(isset($_POST['form_type_edit']))
    {
        $cat_id_edit =mysqli_real_escape_string($conn ,$_POST['cat_id_edit']);
        $job_type_edit =mysqli_real_escape_string($conn ,$_POST['job_type_edit']);

        $sqli = mysqli_query($conn,"SELECT image FROM web_product_type WHERE id=$cat_id_edit");

        $data   = mysqli_fetch_assoc($sqli);
        $exist_img = $data['image']; 

        if($_FILES["type_img_edit"]["name"] != '')
        {
          $test = explode('.', $_FILES["type_img_edit"]["name"]);
          $ext = end($test);
          $name_edit = 'works-'. $cat_id_edit .'.' . $ext;
      
          $location = '../../print_web/assets/img/' . $name_edit;
          move_uploaded_file($_FILES["type_img_edit"]["tmp_name"], $location);

        }else{
          $name_edit = $exist_img;
        }

        $query ="UPDATE web_product_type SET type=?,image=? WHERE id=?;";

        $stmt =mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$query))
        {
           echo "SQL Error";
        }
        else
        {
            mysqli_stmt_bind_param($stmt,"sss",$job_type_edit,$name_edit,$cat_id_edit);
            $result =  mysqli_stmt_execute($stmt);
            if($result){
              echo "Successfully Updated!";
            }
        }
    }

    /////////// insert a new category /////////////
    if(isset($_POST['form_type_submit'])){

      $job_id =mysqli_real_escape_string($conn ,$_POST['job_id']);
      $job_type =mysqli_real_escape_string($conn ,$_POST['job_type']);

      if($_FILES["type_img"]["name"] != '')
      {
        $test = explode('.', $_FILES["type_img"]["name"]);
        $ext = end($test);
        $name1 = 'works-'. $job_id .'.' . $ext;
    
        $location = '../../print_web/assets/img/' . $name1;
        move_uploaded_file($_FILES["type_img"]["tmp_name"], $location);

      }else{
        $name1 ="works-0.jpg";
      }

      $insert_category = mysqli_query($conn, "INSERT INTO web_product_type (id,type,image) VALUES ('$job_id','$job_type','$name1')");


        if($insert_category){
            echo "Successfull!";
        }else{
            echo "Failed!";
        }
    }
?>


