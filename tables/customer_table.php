<!DOCTYPE html>
<html>
<head>
  <style type="text/css">
    .tablealign
    {
      margin-right: 10px;
    }
  </style>
  <title></title>
  <!-- Colour picker -->
  <script src="../js/jscolor.js"></script>

</head>
<body>
<?php
  // session check
  include('../include/check.php');
  // Database Connection
  require '../include/config.php';

  if(isset($_POST["query"]))
  {
     $search =$_POST["query"];
     $query = "SELECT * FROM customer WHERE customer_name LIKE '%".$search."%' ";

  }
  else
  {
     $query = "SELECT * FROM customer";
  }
  $result = mysqli_query($conn ,$query);

  if(mysqli_num_rows($result)>0)
  {
    ?>

 <div class="tablealign">
<!--  <script src="jquery.tabledit.min.js"></script> -->
 <meta name="viewport" content="width=device-width, initial-scale=1">
  <table id="example" class="table table-striped table-bordered" style="width:100%">
   <thead>
    <tr>
     <th>CUSTOMER</th>
     <th>CONTACT</th>
     <th>ADDRESS</th>
     <th></th>
     <th></th>
    </tr>
   </thead>
   <tbody>
   <?php
   $i=1;
   while($row = mysqli_fetch_array($result))
   {
    echo '
    <tr>
     <td>'.$row["customer_name"].'</td>
     <td>'.$row["contact"].'</td>
     <td>'.$row["address"].'</td>
     <td><button type="button"  id="'.$row["id"].'" name="'.$row["id"].'" class="btn btn-primary btn-sm view_data" data-toggle="modal" data-target="#myModal" style="background-color: transparent; border: 0px; color: #007bff; font-size: 16px; padding-top: 0px;">View</button></td>

     <td style="width: 5%;"><a href="../controller/custom_controller?c_delete_id='.$row["id"].'" onclick="confirmation(event)">Delete</a></td>';
    echo '</tr>';

    $i++;
   }
   ?>
   </tbody>
  </table>
</div>
   <?php
  }
  else
  {
   echo 'Data Not Found';
  }

?>
</body>
</html>

<script>

  // Delete Conformation function
  function confirmation(e) {
       var answer = confirm("Are you sure you want to permanently delete this record?")
    if (!answer){
      e.preventDefault();
      return false;
    }
  }

  // Modal load value in jquery
  $(document).on('click', '.view_data', function(){

    var view_id = $(this).attr("name");

    $.ajax({
         url:"../controller/custom_controller.php",
         method:"POST",
         data:{view_id:view_id},
         success:function(data){
            //$('#comment_val').html(data);
           var data =JSON.parse(data);

           //$('#customerid_edit').html(data['id']);
           
           $('#customerid_edit').val(data['id']);
           $('#customer_edit').val(data['customer_name']);
           $('#contact_edit').val(data['contact']);
           $('#address_edit').val(data['address']);
         }
    });
  });

  </script>

   <div id="myModal" class="modal fade">
    <div class="modal-dialog" style="max-width: 500px;">
     <div class="modal-content" style="height : auto;">
        <div class="modal-header" style="background-color: #507183;">
             <span style="font-size: 23px; font-family: monospace;"><b style="color: white;letter-spacing: 1.3px;">CUSTOMER</b></span>
             <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" style="background-color: #d6e1e9;">
         <form method="post" id="pmh_form_edit">
            <div class="col-sm-12">
              <label>Customer Name</label>
              <input type="text" name="customer_edit" id="customer_edit" class="form-control" style="margin-bottom: 10px;"/>
              <input type="hidden" name="customerid_edit" id="customerid_edit" class="form-control" style="margin-bottom: 10px;"/>
            </div>
            <div class="col-sm-12">
              <label>Contact</label>
              <input type="text" name="contact_edit" id="contact_edit" class="form-control" style="margin-bottom: 10px;"/>
            </div>
            <div class="col-sm-12">
              <label>Address</label>
              <input type="text" name="address_edit" id="address_edit" class="form-control" style="margin-bottom: 10px;"/>
            </div>
          
          <div class="col-sm-12">
            <button type="button" id="form_customer_edit" name="form_customer_edit"  onclick="customeredit()" class="btn btn-primary" style="height: 35px; width: 100px; color: white; border-color: #2CA8FF; background-color: #2CA8FF; font-size: 12px;  padding: 4px 10px; margin-top: 0px;     margin-left: 1.5%;">Edit</button>
          </div>
         </form>
        </div>
     </div>
    </div>
     <div id="snackbar"><p id="msg_view"></p></div>
 </div>

 <script>
   function customeredit() {

    var customerid_edit =document.getElementById('customerid_edit').value;
    var customerid_edit_check =document.getElementById('customerid_edit').value;

    var customer_edit =document.getElementById('customer_edit').value;
    var customer_edit_check =document.getElementById('customer_edit').value;

    var contact_edit =document.getElementById('contact_edit').value;
    var contact_edit_check =document.getElementById('contact_edit').value;

    var address_edit =document.getElementById('address_edit').value;
    var address_edit_check =document.getElementById('address_edit').value;

    var form_customer_edit =document.getElementById('form_customer_edit').name;


  if(customer_edit_check=='' || contact_edit_check=='' || address_edit_check==''){
    alert("Required field is empty");
  }
  else {

       $.ajax({
         url:"../controller/custom_controller.php",
         method:"POST",
         data:{customerid_edit:customerid_edit,customer_edit:customer_edit,contact_edit:contact_edit,address_edit:address_edit,form_customer_edit:form_customer_edit},
         success:function(data){

         // Message success call function
          myform1();
          $('#msg_view').html(data);

         }
      });
  }

 }

 // Message success view
 function myform1() {
     var x = document.getElementById("snackbar");
     x.className = "show";
     setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2500);

     // Location refech
     setTimeout(function(){location.reload(); },2500);
 }

  $(document).ready(function() {
      $('#example').DataTable();
  } );
</script>
 
