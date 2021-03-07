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
  <link rel="shortcut icon" href="../icon/jobshop_logo.png" />
  <title>Job Shop - Inbound Requests</title>
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
          <a href="home">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Inbound Requests</li>
      </ol>
      <div class="row">
      <div class="col-md-10">
      <input type="text" name="search_text" id="search_text" placeholder="Search by Job ID " class="form-control  form-control-sm" style="width: 40%;"/>
      </div>
      <div class="col-md-2">
        <button type="button" id="" name="" class="btn btn-primary btn-sm submit_data" data-toggle="modal" data-target="#myModal1" style="background-color: transparent; border: 0px; color: #007bff; font-size: 16px; padding-top: 0px; float:right" ><font color="green"><b>+ </b></font>New Job</button>
      </div>
      </div>

      <div id="myModal1" class="modal fade">
      <div class="modal-dialog" style="max-width: 1000px;">
        <div class="modal-content" style="height : auto;">
          <div class="modal-header" style="background-color: #507183;">
            <span style="font-size: 23px; font-family: monospace;"><b style="color: white;letter-spacing: 1.3px;">NEW JOB ORDER</b></span>
            <button type="button" class="close" data-dismiss="modal" onclick="form_reset()">&times;</button>
          </div>
          <div class="modal-body" style="background-color: #d6e1e9;">
            <form id="order_submit">
                <input type="hidden" id="myitemjson" name="myitemjson"/>
                <div class="col-sm-12" style="display: inline-flex;">
                  <div class="col-sm-4" style="float: right;">
                    <label>Customer</label>
                    <input type="text" name="customer_name" id="customer_name" class="form-control view_customer" style="margin-bottom: 10px;"/>
                    <input type="hidden" name="customer_id" id="customer_id" class="form-control view_customer" style="margin-bottom: 10px;"/>
                  </div>
                  <div class="col-sm-4">
                    <label>Contact</label>
                    <input type="text" name="customer_contact" id="customer_contact" class="form-control" style="margin-bottom: 10px;"/>
                  </div>
                  <div class="col-sm-4">
                    <label>Address</label>
                    <input type="text" name="customer_address" id="customer_address" class="form-control" style="margin-bottom: 10px;"/>
                  </div>
                </div> 
                <hr>
                <div class="col-sm-12" style="display: inline-flex;">
                  <div class="col-sm-3">
                    <label>Select Channel</label>
                    <SELECT name="channel" id="channel" class="form-control" style="margin-bottom: 10px;">
                      <option selected="" disabled="">Select Channel</option>
                      <option value="EXP">Express Channel</option>
                      <option value="DIR">Direct Channel</option>
                    </SELECT>
                  </div>
                  <div class="col-sm-3">
                    <label>Select Job Type</label>
                    <SELECT name="type" id="type" class="form-control" style="margin-bottom: 10px;">
                      <option selected="" disabled="">Select Job Type</option>
                      <?php
                      $type = "SELECT *
                                FROM jobs_type";

                      $result = mysqli_query($conn,$type);
                      $numRows = mysqli_num_rows($result); 
       
                        if($numRows > 0) {
                          while($row = mysqli_fetch_assoc($result)) {

                          echo '<option value = "'.$row["type"].'"> '. $row['type'] .' </option>';
                            
                          }
                        }
                      ?>
                    </SELECT>
                  </div>
                  <div class="col-sm-3">
                    <label>Select Item</label>
                    <SELECT name="item" id="item" class="form-control" style="margin-bottom: 10px;">
                      <option selected="" disabled="">Select Job Type First</option>
                    </SELECT>
                  </div>
                  <div class="col-sm-3">
                    <label>Select Category</label>
                    <SELECT name="category" id="category" class="form-control" style="margin-bottom: 10px;">
                      <option selected="" disabled="">Select Item First</option>
                    </SELECT>
                  </div>
                </div>
                <div class="col-sm-12" style="display: inline-flex;">
                  <div class="col-sm-3">
                    <label>Quantity</label>
                    <input type="text" name="qty" id="qty" class="form-control" style="margin-bottom: 10px;"/>
                  </div>
                  <div class="col-sm-3" id="material1">
                    <label >Material</label>
                    <input type="text" name="material" id="material" class="form-control" style="margin-bottom: 10px;"/>
                  </div>
                  <div class="col-sm-3" id="size1">
                    <label>Size</label>
                    <input type="text" name="size" id="size" class="form-control" style="margin-bottom: 10px;"/>
                  </div>
                </div>
                <div class="col-sm-12" style="display: inline-flex;" id="bind1">
                  <div class="col-sm-3">
                    <label>Bind</label>
                    <SELECT name="bind" id="bind" class="form-control" style="margin-bottom: 10px;">
                      <option value="None">None</option>
                      <option value="Spiral">Spiral</option>
                      <option value="Perfect">Perfect</option>
                      <option value="Tape">Tape</option>
                      <option value="Hard Cover">Hard Cover</option>
                    </SELECT>
                  </div>
                  <div class="col-sm-3">
                    <label>Color</label>
                    <input type="color" name="colour1" id="colour1" style="margin-bottom: 10px; width: 100%; height: 45%;"/>
                  </div>
                  <div class="col-sm-2">
                    <button type="button" id="color_btn" name="color_btn" class="btn btn-primary" onclick="getValue()" style="height: 35px; width: 100px; color: white; border-color: #2CA8FF; background-color: #2CA8FF; font-size: 15px;  padding: 4px 10px; margin-top: 35px; margin-left: 1.5%;">Add</button>
                  </div>
                  <div class="col-sm-4">
                    <br>
                    <textarea name="color" id="color" class="form-control" style="resize: vertical; margin-bottom: 10px;" readonly></textarea>
                  </div>
                </div>
                <hr>
                <div class="col-sm-12" style="display: inline-flex;">
                  <div class="col-sm-4">
                    <label>Budget</label>
                    <input type="text" name="budget" id="budget" class="form-control" style="margin-bottom: 10px;"/>
                  </div>
                  <div class="col-sm-4">
                    <label>Discount (%)</label>
                    <input type="text" name="discount" id="discount" class="form-control" style="margin-bottom: 10px;"/>
                  </div>
                  <div class="col-sm-4">
                   <label>Discounted Price</label>
                   <input type="text" name="discounted" id="discounted" class="form-control" style="margin-bottom: 10px;" readonly/>
                  </div>
                </div>
                <div class="col-sm-12" style="display: inline-flex;">
                  <div class="col-sm-4">
                   <label>Payment Advance </label>
                   <input type="text" name="ad_pay_amount" id="ad_pay_amount" class="form-control" style="margin-bottom: 10px;"/>
                  </div>
                 <div class="col-sm-4">
                   <label>Rest Of the Budget</label>
                   <input type="text" name="rest" id="rest" class="form-control" style="margin-bottom: 10px;" readonly />
                 </div>
                 <div class="col-sm-4">
                   <label>Date</label>
                   <input type="date" name="date" id="date" class="form-control" style="margin-bottom: 10px;" />
                 </div>
                </div>
                <div class="col-sm-12">
                  <div class="col-sm-6" style="float: right;">
                    <label>User description</label>
                      <textarea name="user_description" id="user_description" class="form-control" style="resize: vertical; margin-bottom: 10px;" readonly></textarea>
                  </div>
                  <div class="col-sm-6">
                    <label>Admin description</label>
                      <textarea name="admin_description" id="admin_description" class="form-control" style="resize: vertical; margin-bottom: 10px;"></textarea>
                  </div>
                </div>
                <div class="col-sm-12">
                  <button type="button" id="form_btn_submit" name="form_btn_submit"  onclick="FormInsert()" class="btn btn-primary" style="height: 35px; width: 100px; color: white; border-color: #2CA8FF; background-color: #2CA8FF; font-size: 15px;  padding: 4px 10px; margin-top: 0px; margin-left: 1.5%;">SUBMIT</button>
                </div>
            </form>
          </div>
        </div>
      </div>
     <div id="snackbar"><p id="msg_view"></p></div>
 </div>

      <br>
       <!-- Inbound Requests table view -->
      <div id="result">

      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
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


<!-- Inbound Requests table view in ajax -->
<script>
$(document).ready(function(){
 load_data();
 function load_data(query)
 {
  $.ajax({
   url:"../tables/inbound_requests_table.php",
   method:"POST",
   data:{query:query},
   success:function(data)
   {
    $('#result').html(data);
   }
  });
 }

 $('#search_text').keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
   load_data(search);
  }
  else
  {
   load_data();
  }
 });


  $('#channel').on('change', function() {
    if ( this.value == 'EXP')
    //.....................^.......
    {
      $("#size1").hide();
      $("#bind1").hide();
      $("#material1").hide();
    }else{
      $("#size1").show();
      $("#bind1").show();
      $("#material1").show();
    }
  });

////////////// get items ///////////////////////
  $("#type").on('change',function(){
    var type = $(this).val();
    if(type){
      
      $.get(
        "../functions/get_products.php",
        {type:type},
        function (data) { 
          //alert(type)
          $('#item').html(data);
        }
      );
         
    }else{
      $('#item').html('<option>Select Job Type First</option>');
    }
  });

///////////// get categories /////////////////////
  $("#item").on('change',function(){
    var item = $(this).val();
   // alert(item)
    if(item){
      
      $.get(
        "../functions/get_category.php",
        {item:item},
        function (data) { 
          $('#category').html(data);
        }
      );
         
    }else{
      $('#category').html('<option>Select Item First</option>');
    }
  });

});

///////////////calculate the budget ///////////////////
$("#budget").keyup(function(){

  var budget =document.getElementById('budget').value;

  $('#rest').val(budget);
  $('#discounted').val(budget);

});

// Calulate Amount about  to the discount add
$("#discount").keyup(function(){

   var budget =document.getElementById('budget').value;
   var discount =document.getElementById('discount').value;


   var discount =(discount*budget/100).toFixed(2);
   var discounted =parseFloat(budget) - parseFloat(discount);

    $('#discounted').val(discounted);
    $('#rest').val(discounted);
});



$('#ad_pay_amount').keyup(function(){

  var discounted =document.getElementById('discounted').value;
  var ad_amount  =document.getElementById('ad_pay_amount').value;

  var rest_amt = parseFloat(discounted) - parseFloat(ad_amount);

  $('#rest').val(rest_amt);
    
});


$('#customer_name').on('keyup', function() {

  var customer  = $('#customer_name').val();

  $.ajax({
    url: '../functions/get_customer.php',
    method:"POST",
    data:{customer:customer},
    success: function (response) {
      // alert(customer)
      var obj = JSON.parse(response);

      var cust_id   =  obj.cust_id
      var contact   =  obj.contact
      var address   =  obj.address

      $('#customer_id').val(cust_id);
      $('#customer_contact').val(contact);
      $('#customer_address').val(address);
    }
  });
});

////////////////Form reset when close the form//////////////////////

function form_reset(){
  document.getElementById("order_submit").reset();
}


////////////////////Data insert////////////////////////////////

function FormInsert() {

  //Call to set the color arry 
  setArry();

  var cust_id =document.getElementById('customer_id').value;
  var customer =document.getElementById('customer_name').value;
  var contact =document.getElementById('customer_contact').value;
  var address =document.getElementById('customer_address').value;

  var channel =document.getElementById('channel').value;
  var type =document.getElementById('type').value;
  var item =document.getElementById('item').value;
  var category =document.getElementById('category').value;

  var qty =document.getElementById('qty').value;
  var material =document.getElementById('material').value;
  var size =document.getElementById('size').value;
  var bind =document.getElementById('bind').value;

  var budget =document.getElementById('budget').value;
  var discount =document.getElementById('discount').value;
  var discounted =document.getElementById('discounted').value;
  var ad_pay_amount =document.getElementById('ad_pay_amount').value;
  var rest =document.getElementById('rest').value;
  var date =document.getElementById('date').value;

  var admin_description =document.getElementById('admin_description').value;

  var form_btn_submit =document.getElementById('form_btn_submit').name;

  if(customer=='' || item=='' || budget==''){
    alert("Required field is empty!");
  }
  else {

   $.ajax({
     url:"../controller/inbound_requests_controller.php",
     method:"POST",
     data:{cust_id:cust_id,customer:customer,contact:contact,address:address,channel:channel,type:type,item:item,category:category,qty:qty,material:material,size:size,bind:bind,budget:budget,discount:discount,discounted:discounted,ad_pay_amount:ad_pay_amount,rest:rest,date:date,admin_description:admin_description,form_btn_submit:form_btn_submit},
     success:function(data){

     // Message success call function
     myformorder();
     $('#msg_view').html(data);

     }
  });
 }
 }

// Message success view
function myformorder() {
   var x = document.getElementById("snackbar");
   x.className = "show";
   setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2500);

   // Location refech
   setTimeout(function(){location.reload(); },2500);
}

//  Insert Into the textarea 
 function getValue(){

      var x = document.getElementById("colour1").value;
      var space =' , ';
      var textarea = document.getElementById('color');
      textarea.value = textarea.value +x +'\n';
  
  }
 
 // Pushed to the arry multiple color codes 
  function setArry(){
    var array=[];
    var lines = $('#color').val().split('\n');
    $.each(lines, function(i){
      array.push({no:i,code:this});
    });
    array.splice(-1,1)
    console.log(JSON.stringify(array, null, 1));
    $('#myitemjson').val(JSON.stringify(array));
  }

</script>
<!-- end -->
