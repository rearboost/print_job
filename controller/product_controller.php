<?php
  // database Connection
  require '../include/config.php';
  // session check
  include('../include/check.php');

  /////////////////////insert job type //////////////////////////////

  if(isset($_POST['form_type_submit'])){

    $job_id =mysqli_real_escape_string($conn ,$_POST['job_id']);
    $job_type =mysqli_real_escape_string($conn ,$_POST['job_type']);    

    $type_insert = mysqli_query($conn, "INSERT INTO jobs_type(id,type) VALUES ($job_id,'$job_type')");
        
    if($type_insert){
        echo "Successfull!";
    }else{
        echo "Failed!";
    }

  }

  ////////////////////insert product///////////////////////

  if(isset($_POST['form_product_submit'])){

    $pro_id =mysqli_real_escape_string($conn ,$_POST['pro_id']);
    $jtype =mysqli_real_escape_string($conn ,$_POST['jtype']);    
    $product =mysqli_real_escape_string($conn ,$_POST['product']);    

    $product_insert = mysqli_query($conn, "INSERT INTO product(id,name) VALUES ($pro_id,'$product')");

    $product_type_insert = mysqli_query($conn, "INSERT INTO product_type (product_id,type_id) VALUES ($pro_id,$jtype)");
        
    if($product_type_insert){
        echo "Successfull!";
    }else{
        echo "Failed!";
    }

  }

  ////////////////////insert category///////////////////////

  if(isset($_POST['form_category_submit'])){

    $cat_id =mysqli_real_escape_string($conn ,$_POST['cat_id']);
    $pitem =mysqli_real_escape_string($conn ,$_POST['pitem']);    
    $category =mysqli_real_escape_string($conn ,$_POST['category']);    

    $category_insert = mysqli_query($conn, "INSERT INTO category(id,category) VALUES ($cat_id,'$category')");

    $category_type_insert = mysqli_query($conn, "INSERT INTO product_category(product_id,category_id) VALUES ($pitem,$cat_id)");
        
    if($category_type_insert){
        echo "Successfull!";
    }else{
        echo "Failed!";
    }

  }

 ?>
