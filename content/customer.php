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
  <title>Job Shop - Customer Report</title>
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
        <li class="breadcrumb-item active">Customers</li>
      </ol>

      
      <div class="row">
      <div class="col-md-10">
      <input type="text" name="search_text" id="search_text" placeholder="Search by Customer name " class="form-control  form-control-sm" style="width: 40%;"/>
      <br>
      </div>
      <div class="col-md-2">
        <button type="button" id="" name="" class="btn btn-primary btn-sm submit_data" data-toggle="modal" data-target="#myModalcustomer" style="background-color: transparent; border: 0px; color: #007bff; font-size: 16px; padding-top: 0px; float:right" ><font color="green"><b>+ </b></font>New Customer</button>
      </div>
      </div>

      <div id="myModal1" class="modal fade">
      <div class="modal-dialog" style="max-width: 500px;">
        <div class="modal-content" style="height : auto;">
          <div class="modal-header" style="background-color: #507183;">
            <span style="font-size: 23px; font-family: monospace;"><b style="color: white;letter-spacing: 1.3px;">NEW CUSTOMER</b></span>
            <button type="button" class="close" data-dismiss="modal" onclick="form_reset()">&times;</button>
          </div>
          <div class="modal-body" style="background-color: #d6e1e9;">
            <form id="customer_submit">
                <div class="col-sm-12">
                  <label>Customer Name</label>
                  <input type="text" name="customer_name" id="customer_name" class="form-control" style="margin-bottom: 10px;"/>
                  <input type="hidden" name="customer_id" id="customer_id" class="form-control" style="margin-bottom: 10px;"/>
                </div>
                <div class="col-sm-12">
                  <label>Contact</label>
                  <input type="text" name="customer_contact" id="customer_contact" class="form-control" style="margin-bottom: 10px;"/>
                </div>
                <div class="col-sm-12">
                  <label>Address</label>
                  <input type="text" name="customer_address" id="customer_address" class="form-control" style="margin-bottom: 10px;"/>
                </div>
                
                <div class="col-sm-12">
                  <button type="button" id="form_customer_submit" name="form_customer_submit" onclick="CustomerInsert()" class="btn btn-primary" style="height: 35px; color: white; border-color: #2CA8FF; background-color: #2CA8FF; font-size: 15px;  padding: 4px 10px; margin-top: 0px; margin-left: 1.5%;">SUBMIT</button>
                </div>
            </form>
          </div>
        </div>
      </div>
     <div id="snackbar"><p id="msg_view"></p></div>
 </div>

       <!-- table view -->
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


<!-- Dispatch  table view in ajax -->
<script>
$(document).ready(function(){
 load_data();
 function load_data(query)
 {
  $.ajax({
   url:"../tables/customer_table.php",
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
  document.getElementById("customer_submit").reset();
}


////////////////////Data insert////////////////////////////////

function CustomerInsert() {

  var cust_id =document.getElementById('customer_id').value;
  var cust_id_checked =document.getElementById('customer_id').value;

  var customer =document.getElementById('customer_name').value;
  var customer_checked =document.getElementById('customer_name').value;

  var contact =document.getElementById('customer_contact').value;
  var contact_checked =document.getElementById('customer_contact').value;

  var address =document.getElementById('customer_address').value;
  var address_checked =document.getElementById('customer_address').value;

  var form_customer_submit =document.getElementById('form_customer_submit').name;

  if(cust_id_checked!=''){
    alert("This customer already exists.");
  }else if(customer_checked=='' || contact_checked=='' || address_checked==''){
    alert("Required field is empty.");  
  }else{
   $.ajax({
     url:"../controller/customer_controller.php",
     method:"POST",
     data:{customer:customer,contact:contact,address:address,form_customer_submit:form_customer_submit},
     success:function(data){

     // Message success call function
     myformcustomer();
     $('#msg_view').html(data);

     }
  });
 }
 }
 
// Message success view
function myformcustomer() {
   var x = document.getElementById("snackbar");
   x.className = "show";
   setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2500);

   // Location refech
   setTimeout(function(){location.reload(); },2500);
}
</script>
<!-- end -->


