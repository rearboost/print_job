<?php
  // session check
  include('../include/check.php');
  // Database Connection
  require '../include/config.php';

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- head title and icon -->
  <link rel="shortcut icon" href="../icon/small.jpg" />
  <title>Job Ordering System - POS</title>
  <!-- header -->
  <?php include('../include/head.php'); ?>

</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <?php include('../include/nav.php'); ?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">POS</li>
      </ol>

      <!-- <input type="text" name="search_text" id="search_text" placeholder="Search by Job ID " class="form-control  form-control-sm" style="width: 25%;"/> -->
      <br>

      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <h1><strong>POS</strong></h1>
              <form id="productAdd">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Description</label>
                        <input type="text" class="form-control" name="product_name" id="product_name" placeholder="Item Description here.." required="">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Unit Price</label>
                        <input type="text" class="form-control" name="price" id="price" required="">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>QTY</label>
                        <input type="number" class="form-control" name="quantity" id="quantity" required="">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <i class="fa fa-plus-circle" style="cursor: pointer; margin-top: 35px; font-size: 22px;" onclick="AddPro()"></i>
                    </div>
                  </div>   
                </div>  
              </form>

              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-12" style="height: 240px; overflow-y: auto; overflow-x: auto;">
                    <div id="here">
                      <div class="table-responsive">
                        <table id="example1" class="table table-bordered" style="width: 100%;">
                          <thead>
                            <tr>
                              <th>Product</th>
                              <th>Price</th>
                              <th>QTY</th>
                              <th>Amount</th>
                              <th>Remove</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              $sql=mysqli_query($conn,"SELECT * FROM pos_temp");
                              
                                $numRows = mysqli_num_rows($sql); 
                          
                                if($numRows > 0) {

                                  $total_amt = 0;
                                  
                                  while($row = mysqli_fetch_assoc($sql)) {

                                    $product = $row['product'];
                                    $price   = $row['price'];
                                    $qty  = $row['qty'];
                                    $amount   = $row['amount'];
                                    $id   = $row['id'];
                                    echo ' <tr>';
                                    echo ' <td>'.$product.' </td>';
                                    echo ' <td>'.$price.' </td>';
                                    echo ' <td>'.$qty.' </td>';
                                    echo ' <td>'.$amount.' </td>';
                                    echo '<td class="td-center"><button class="btn-edit" id="DeleteButton" onclick="removeForm('.$id.')">Delete</button></td>';
                                    echo ' </tr>';
                                     $total_amt = $total_amt + $amount;

                                  }
                                }
                              ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div> <!-- table div end -->
                </div><!-- 2nd row end -->
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Gross</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" name="gross" id="gross" placeholder="0.00" readonly/>
                          </div>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group row">
                      <label class="col-sm-4 col-form-label">Date</label>
                          <div class="col-sm-8">
                            <input type="date" class="form-control" name="date" id="date" value="<?php echo date("Y-m-d"); ?>"  required/>
                          </div>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <?php

                        $sql ="SELECT id FROM sales ORDER BY id DESC LIMIT 1";
                        $result=mysqli_query($conn,$sql);
                        $row_get = mysqli_fetch_assoc($result);
                        $count =mysqli_num_rows($result);

                        $year = date('Y');

                        if($count==0){
                          $nextID = 1;
                        }else{
                          $nextID =$row_get['id']+1;
                        }

                      ?>
                      <input type="hidden" id="inv_id" value="<?php echo $year.$nextID ?>">
                      <!-- <b><label class="col-sm-12 col-form-label">Invoice # - <?php //echo  $year.$nextID; ?></label></b> -->
                      <div class="form-group row">
                      <label class="col-sm-4 col-form-label">Customer</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" name ="customer" id="customer" placeholder="Customer name here.." />
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group row">
                      <label class="col-sm-4 col-form-label">Discount</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" name ="discount" id="discount" onkeyup="myFunction()"  placeholder="0.00" />
                        </div>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group row">
                      <label class="col-sm-4 col-form-label">Payment</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" name ="payment" id="payment" onkeyup="paymentFun()" placeholder="0.00" required/>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group row">
                      <label class="col-sm-4 col-form-label">Address</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" name ="address" id="address" placeholder="Customer address here.." />
                        </div>
                      </div>
                    </div>

                  </div>

                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group row">
                      <label class="col-sm-4 col-form-label">Total</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" style="font-weight: 600;" name="total" id="total" placeholder="0.00" readonly/>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group row">
                      <label class="col-sm-4 col-form-label">Due</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" name ="due" id="due"  placeholder="0.00" readonly/>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <button type="button"  onclick="printForm()" class="btn btn-primary" style="width:59%">PRINT</button>
                      <button type="button" onclick="cancelForm()" class="btn btn-danger" style="width:39%">CLOSE</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- card end -->
        </div> 
      </div>
    </div><!-- /.container-fluid-->
  </div><!-- /.content-wrapper-->
    
    
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Your Website 2021</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <?php include('../include/modal.php'); ?>
    <!-- Bootstrap core JavaScript-->
    <?php include('../include/footer_js.php'); ?>
  </div>
</body>

</html>


<!-- Dispatch  table view in ajax -->
<script>
  var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;

    $(document).ready(function() {

        tmpEmpty();
    });

    //Discount On Change
    function myFunction(){

        var gross= $('#gross').val();
        var discount= $('#discount').val();

        if(numberRegex.test(discount)){

          var total = (Number(gross) - Number(discount)).toFixed(2)
          $('#total').val(total);

        }else{

          if(discount!=''){
              swal({
              title: "Discount must be Number !",
              text: "Validation",
              icon: "error",
              button: "Ok !",
              });
              $('#discount').val('');
          }
        }
    }

    function paymentFun(){

        var total= $('#total').val();
        var payment= $('#payment').val();
        
        if(numberRegex.test(payment)){

          var due = (Number(payment) - Number(total)).toFixed(2)
          $('#due').val(due);

        }else{

          if(payment!=''){
              swal({
              title: "Payment must be Number !",
              text: "Validation",
              icon: "error",
              button: "Ok !",
              });
              $('#payment').val('');
          }
        }

    }

    // Data add to the Temp POS table                      
    function AddPro(){

      var addrow  ="addrow";

      var product_name= $('#product_name').val();
      var quantity= $('#quantity').val();
      var price= $('#price').val();

      if(product_name!='' && quantity !='' && price !='' && numberRegex.test(quantity)){

       $.ajax({
          type: 'post',
          url: '../controller/pos_controller.php',
          data: {addrow:addrow,product_name:product_name,quantity:quantity,price:price},
          success: function (data) {

            $('#product_name').val("")
            $('#quantity').val("")
            $('#price').val("")

            $("#here" ).load(window.location.href + " #here" );
            $("#gross").val(data);
            $("#total").val(data);
                      
            } 
        });     
      }else{
        alert('Required field is Empty!');
      }
    }
    ///////////////////////////////////

    function tmpEmpty() {

      var tmpEmpty  ="tmpEmpty";

        $.ajax({
            type: 'post',
            url: '../controller/pos_controller.php',
            data: {tmpEmpty:tmpEmpty},
            success: function (data) {

                 $( "#here" ).load(window.location.href + " #here" );
              } 
        });
    }

     /////////// Remove the Row 
    function removeForm(id){

        var removeRow  ="removeRow";

         $.ajax({
            type: 'post',
            url: '../controller/pos_controller.php',
            data: {removeRow:removeRow,id:id},
            success: function (data) {
                $( "#here" ).load(window.location.href + " #here" );
                $("#gross").val(data);
                $("#total").val(data)
              } 
        });
    }

    function printForm(){

        var save  ="save";
    
        var total= $('#total').val();
        var discount= $('#discount').val();
        var payment= $('#payment').val();
        var date= $('#date').val();
        var inv_id= $('#inv_id').val();
        var customer= $('#customer').val();
        var address= $('#address').val();

        if(payment!='' && numberRegex.test(payment)){

            $.ajax({
                type: 'post',
                url: '../controller/pos_controller.php',
                data: {save:save,total:total,discount:discount,payment:payment,date:date,inv_id:inv_id,customer:customer,address:address},
                success: function (data) {

                    setTimeout(function(){window.open('pos_print?id='+inv_id, '_blank'); }, 100);

                    setTimeout(function(){ location.reload(); }, 2500);

                } 
            });  
        }
    }

    function cancelForm(){

        window.location.href = "pos_items.php";
    }
     /////////////////////////////////////////////////////////////////

</script>
<!-- end -->
