<?php
  // database Connection
  require '../include/config.php';
  // session check
  include('../include/check.php');

// Logic Delete the  Inbound Requests  use id start
   if (isset($_GET['j_delete_id']))
   {
      $id = $_GET['j_delete_id'];

      //$query1 =mysqli_query($conn,"DELETE web_product_rel,web_products FROM web_product_rel INNER JOIN web_products ON web_product_rel.product_id=web_products.id WHERE web_product_rel.id=$id");

      $query1 =mysqli_query($conn,"DELETE FROM web_product_rel WHERE id=$id");

          if($query1){
            header("location:../content/web_product.php"); // redirects to all records page
            exit;
          }

   }

    //Inbound Requests php code strat
   if(isset($_POST['view_id']))
   {
     $val =$_POST['view_id'];
     $query_obj ="SELECT R.id as id, P.name as name, P.image as image, T.type as type FROM web_products P JOIN web_product_rel R ON P.id = R.product_id JOIN web_product_type T ON T.id = R.type_id WHERE R.id='".$val."'";

     $result_obj =mysqli_query($conn,$query_obj);

     $object_obj =mysqli_fetch_object($result_obj);
     echo json_encode($object_obj);

   }

    //////////////////// edit item ////////////////////////
    if(isset($_POST['form_product_edit']))
    {
        $pro_id_edit =mysqli_real_escape_string($conn ,$_POST['pro_id_edit']);
        $product_edit =mysqli_real_escape_string($conn ,$_POST['product_edit']);

        $sqli = mysqli_query($conn,"SELECT * FROM web_product_rel WHERE id=$pro_id_edit");

        $data   = mysqli_fetch_assoc($sqli);
        $id = $data['product_id']; 

        $image = mysqli_query($conn,"SELECT * FROM web_products WHERE id=$id");

        $data1   = mysqli_fetch_assoc($image);
        $exist_image = $data1['image']; 

        if($_FILES["p_image_edit"]["name"] != '')
        {
          $test = explode('.', $_FILES["p_image_edit"]["name"]);
          $ext = end($test);
          $name_edit = 'product-'. $id .'.' . $ext;
      
          $location = '../../print_web/assets/img/' . $name_edit;
          move_uploaded_file($_FILES["p_image_edit"]["tmp_name"], $location);

        }else{
          $name_edit = $exist_image;
        }

        $query ="UPDATE web_products SET name=?,image=? WHERE id=?;";

        $stmt =mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$query))
        {
           echo "SQL Error";
        }
        else
        {
            mysqli_stmt_bind_param($stmt,"sss",$product_edit,$name_edit,$id);
            $result =  mysqli_stmt_execute($stmt);
            if($result){
              echo "Successfully Updated!";
            }
        }
    }

    /////// insert new item /////////////
    if(isset($_POST['form_product_submit'])){

      $pro_id =mysqli_real_escape_string($conn ,$_POST['pro_id']);
      $jtype =mysqli_real_escape_string($conn ,$_POST['jtype']);
      $product =mysqli_real_escape_string($conn ,$_POST['product']);

      if($_FILES["p_image"]["name"] != '')
      {
        $test = explode('.', $_FILES["p_image"]["name"]);
        $ext = end($test);
        $name1 = 'product-'. $pro_id .'.' . $ext;
    
        $location = '../../print_web/assets/img/' . $name1;
        move_uploaded_file($_FILES["p_image"]["tmp_name"], $location);

      }else{
        $name1 ="product-0.jpg";
      }

        $insert_category = mysqli_query($conn, "INSERT INTO web_products (id,name,image) VALUES ('$pro_id','$product','$name1')");

        $insert_rel = mysqli_query($conn, "INSERT INTO web_product_rel (product_id,type_id) VALUES ('$pro_id','$jtype')");

        if($insert_category){
            echo "Successfull!";
        }else{
            echo "Failed!";
        }

    }
?>