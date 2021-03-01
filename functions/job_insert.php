<?php
  require '../include/config.php';

// if(isset($_POST['submit'])){

//   $date      = date("Ymdhisa");
  
//   $sqli = mysqli_query($conn,"SELECT MAX(id) as max_no FROM jobs ORDER BY id DESC");

//   $data = mysqli_fetch_array($sqli);
//   $max_no = $data['max_no']; 

//   $job_no = $date . $max_no;

//   $id          = $_POST['id'];
//   $name        = $_POST['name'];
//   $contact     = $_POST['contact'];
//   $address     = $_POST['address'];

//   $channel     = $_POST['channel'];
//   $type        = $_POST['type'];
//   $item        = $_POST['item'];
//   $by          = $_SESSION['email'];

//   // if(empty($id)){

//   //     $insert_customer = mysqli_query($conn,"INSERT INTO customer (name,contact,address) VALUES ('$name','$contact','$address')");

//   //     $insert_order = mysqli_query($conn,"INSERT INTO jobs (job_no,channel,type,item,by,state) VALUES ('$job_no','$channel','$type','$item',$by,'pending')");


//   // }else{

//     $insert_order = mysqli_query($conn,"INSERT INTO jobs (customer,uemail,uphone,job_no,channel,type,item,by,state) VALUES ('$name','$address','$contact',$job_no','$channel','$type','$item',$by,'pending')");
//   // }
// } 

// mysqli_close($conn);



    if(isset($_POST['from_btn_edit']))
    {
      //  echo $_POST['job_edit'];
        $job_edit =mysqli_real_escape_string($conn ,$_POST['job_edit']);

        $customer_edit =mysqli_real_escape_string($conn ,$_POST['customer_edit']);
        $material_edit =mysqli_real_escape_string($conn ,$_POST['material_edit']);
        $height_edit =mysqli_real_escape_string($conn ,$_POST['height_edit']);
        $width_edit =mysqli_real_escape_string($conn ,$_POST['width_edit']);

        $length_edit =mysqli_real_escape_string($conn ,$_POST['length_edit']);
        $quantity_edit =mysqli_real_escape_string($conn ,$_POST['quantity_edit']);
        $colour_edit =mysqli_real_escape_string($conn ,$_POST['colour_edit']);
        $date_edit =mysqli_real_escape_string($conn ,$_POST['date_edit']);

        $budget_edit =mysqli_real_escape_string($conn ,$_POST['budget_edit']);
        $tax_edit =mysqli_real_escape_string($conn ,$_POST['tax_edit']);
        $discount_edit =mysqli_real_escape_string($conn ,$_POST['discount_edit']);
        $admin_description_edit =mysqli_real_escape_string($conn ,$_POST['admin_description_edit']);

        $discount =$budget_edit*($discount_edit/100);
        $budget_edit =$budget_edit+$discount;

        $tax =$budget_edit*($tax_edit/100);
        $amount_edit =$budget_edit-$tax;



      // $amount_edit =mysqli_real_escape_string($conn ,$_POST['amount_edit']);
        $ad_pay_amount_edit =mysqli_real_escape_string($conn ,$_POST['ad_pay_amount_edit']);

        $status_edit =mysqli_real_escape_string($conn ,$_POST['status_edit']);


        $query ="UPDATE  jobs  SET material=?,height=?,width=?,length=?,colour=?,quantity=?,budget=?,tax=?,discount=?,amount=?,ad_pay_amount=? ,admin_description=?,state=?  WHERE id=?;";

        $stmt =mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$query))
        {
           echo "SQL Error";
        }
        else
        {
            mysqli_stmt_bind_param($stmt,"ssssssssssssss",$material_edit,$height_edit,$width_edit,$length_edit,$colour_edit,$quantity_edit,$budget_edit,$tax_edit,$discount_edit,$amount_edit,$ad_pay_amount_edit,$admin_description_edit,$status_edit,$job_edit);
            $result =  mysqli_stmt_execute($stmt);
        }

    }

?> 