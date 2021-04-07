<?php
  // database Connection
  require '../include/config.php';
  // session check
  include('../include/check.php');

// Logic Delete the  Inbound Requests  use id start
   if (isset($_GET['j_delete_id']))
    {
        $id = $_GET['j_delete_id'];
        $query ="DELETE FROM web_trending_products WHERE id=?;";
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
              header("location:../content/web_trending.php"); // redirects to all records page
              exit;
            }
        }
    }

   if(isset($_POST['view_id']))
   {
     $val =$_POST['view_id'];
     $query_obj ="SELECT * FROM web_trending_products WHERE id='".$val."'";
     $result_obj =mysqli_query($conn,$query_obj);

     $object_obj =mysqli_fetch_object($result_obj);
     echo json_encode($object_obj);

   }

   // Inbound Requests form form submit btn update details php code strat
    if(isset($_POST['form_trending_edit']))
    {
        $t_id_edit =mysqli_real_escape_string($conn ,$_POST['t_id_edit']);
        $jptype_edit =mysqli_real_escape_string($conn ,$_POST['jptype_edit']);
        $T_product_edit =mysqli_real_escape_string($conn ,$_POST['T_product_edit']);
        $price_edit =mysqli_real_escape_string($conn ,$_POST['price_edit']);

        $sqli = mysqli_query($conn,"SELECT image FROM web_trending_products WHERE id=$t_id_edit");

        $data   = mysqli_fetch_assoc($sqli);
        $exist_img = $data['image']; 

        if($_FILES["t_image_edit"]["name"] != '')
        {
          $test = explode('.', $_FILES["t_image_edit"]["name"]);
          $ext = end($test);
          $name_edit = 'trending--'. $t_id_edit .'.' . $ext;
      
          $location = '../../print_web/assets/img/' . $name_edit;
          move_uploaded_file($_FILES["t_image_edit"]["tmp_name"], $location);

        }else{
          $name_edit=$exist_img;
        }

        $query ="UPDATE web_trending_products SET product=?,type=?,price=?,image=? WHERE id=?;";

        $stmt =mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$query))
        {
           echo "SQL Error";
        }
        else
        {
            mysqli_stmt_bind_param($stmt,"sssss",$T_product_edit,$jptype_edit,$price_edit,$name_edit,$t_id_edit);
            $result =  mysqli_stmt_execute($stmt);
            if($result){
              echo "Successfully Updated!";
            }
        }
    }


    if(isset($_POST['form_trending_submit'])){

      $t_id =mysqli_real_escape_string($conn ,$_POST['t_id']);
      $jptype =mysqli_real_escape_string($conn ,$_POST['jptype']);
      $T_product =mysqli_real_escape_string($conn ,$_POST['T_product']);
      $price =mysqli_real_escape_string($conn ,$_POST['price']);

      if($_FILES["t_image"]["name"] != '')
      {
        $test = explode('.', $_FILES["t_image"]["name"]);
        $ext = end($test);
        $name1 = 'trending-'. $t_id .'.' . $ext;
    
        $location = '../../print_web/assets/img/' . $name1;
        move_uploaded_file($_FILES["t_image"]["tmp_name"], $location);

      }else{
        $name1 = "trending-0.jpg";
      }
        $insert_category = mysqli_query($conn, "INSERT INTO web_trending_products (id,  product,type,price,image) VALUES ('$t_id','$T_product','$jptype','$price','$name1')");

        if($insert_category){
            echo "Successfull!";
        }else{
            echo "Failed!";
        }
    }
?>