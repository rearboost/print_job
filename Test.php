<!doctype html>
<html lang="en">
  <head>
    <!-- Database Connection -->
    <?php
    	$severname = "localhost";
    	$username = "root";
    	$password = "root";
    	$db = "jobinfor";

    	$conn = mysqli_connect($severname,$username,$password);
    	mysqli_select_db($conn,$db);

    	$dbh = new PDO("mysql:dbname={$db};host={$severname};port={3306}", $username, $password);

       if(!$dbh){

          echo "unable to connect to database";
       }
    ?>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <title>Hello, world!</title>
    <style>
    /* snackbar css strat */
#snackbar {
visibility: hidden;
min-width: 250px;
margin-left: -125px;
background-color: #333;
color: #fff;
text-align: center;
border-radius: 2px;
padding: 16px;
position: fixed;
z-index: 1;
left: 50%;
bottom: 30px;
font-size: 17px;
}

#snackbar.show {
visibility: visible;
-webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
animation: fadein 0.5s, fadeout 0.5s 2.5s;
}

@-webkit-keyframes fadein {
from {bottom: 0; opacity: 0;}
to {bottom: 30px; opacity: 1;}
}

@keyframes fadein {
from {bottom: 0; opacity: 0;}
to {bottom: 30px; opacity: 1;}
}

@-webkit-keyframes fadeout {
from {bottom: 30px; opacity: 1;}
to {bottom: 0; opacity: 0;}
}

@keyframes fadeout {
from {bottom: 30px; opacity: 1;}
to {bottom: 0; opacity: 0;}
}
/* snackbar css end */
    </style>

  </head>
  <body>
    <br><br><br>


    <div class="div1" style="width: 50%;">

    </div>
    <div class="div2" style="width: 50%; float: right;">
         <form>
      <div class="col-sm-12 form-group" style="margin-bottom: 15px;">
      <div class="col-sm-6">
        <label style="margin-bottom: 10px;">Type of material to be used</label>
        <select id="material" class="form-control" style="border: 1px solid; height: 33px;" name="material">
          <option value="">Select</option>
          <option value="Plastic">Plastic</option>
          <option value="Stainless Steel">Stainless Steel</option>
          <option value="Aluminium">Aluminium</option>
        </select>
        <label id="material_error" class="error" for="material" style="display: none; color: red;">This field is required.</label>
      </div>
      </div>
      <div class="col-sm-12 form-group">
      <div class="col-sm-4"><label>Colour</label>
      <input id="colour" style="margin-bottom: 10px; width: 100%; height: 34px;" type="color" name="colour"/></div>
      </div>
      <div class="col-sm-12" style="display: inline-flex;">
      <div class="col-sm-4"><label>Height</label>
      <input id="height" class="form-control" style="margin-bottom: 10px;" name="height" type="text" /></div>
      <div class="col-sm-4"><label>Width</label>
      <input id="width" class="form-control" style="margin-bottom: 10px;" name="width" type="text" /></div>
      <div class="col-sm-4"><label>Length</label>
      <input id="length" class="form-control" style="margin-bottom: 10px;" name="length" type="text" /></div>
      </div>
      <div class="col-sm-12" style="display: inline-flex;">
      <div class="col-sm-6"><label>Your budget</label>
      <input id="budget" class="form-control" style="margin-bottom: 10px;" name="budget" type="text" /></div>
      <label id="budget_error" class="error" for="budget" style="display: none; color: red;">This field is required.</label>
      </div>
      <div class="col-sm-12" style="display: inline-flex;">
      <div class="col-sm-6"><label>Discount coupon</label>
      <input id="discount" class="form-control" style="margin-bottom: 10px;" name="discount" type="text" /></div>
      </div>
      <div class="col-sm-12 form-group" style="padding-left: 29px; padding-right: 29px;">

      <label>Additional Information</label>
         <textarea id="user_description" class="form-control" style="resize: vertical; border: 1px solid;" name="user_description"></textarea>
        <label id="user_description_error" class="error" for="user_description" style="display: none; color: red;">This field is required.</label>
      </div>
      <div class="col-sm-12" style="display: inline-flex; margin-bottom: 12px;">
      <div class="col-sm-4"><label>Name</label>
      <input id="user_name" class="form-control" style="margin-bottom: 10px;" name="user_name" type="text" />
      <label id="user_name_error" class="error" for="user_name" style="display: none; color: red;">This field is required.</label>
      </div>
      <div class="col-sm-4"><label>Email</label>
      <input id="user_email" class="form-control" style="margin-bottom: 10px;" name="user_email" type="text" />
      <label id="user_email_error" class="error" for="user_email" style="display: none; color: red;">This field is required.</label>
     </div>
      <div class="col-sm-4"><label>Phone</label>
      <input id="user_phone" class="form-control" style="margin-bottom: 10px;" name="user_phone" type="text" />
      <label id="user_phone_error" class="error" for="user_phone" style="display: none; color: red;">This field is required.</label>
     </div>
      </div>
      <div class="col-sm-12 form-group">
         <button id="cfrom_btn" onclick="myFormcreate()" class="btn btn-primary" style="height: 42px; width: 23%; color: white; border-color: #2CA8FF; background-color: #f89a20; font-size: 14px; padding: 4px 10px; margin-top: 0px; margin-left: 2.5%; border-radius: 8px;" name="cfrom_btn" type="button">Send Enquiry</button></div>
    </div>

  <div id="snackbar"><p id="msg_view"></p></div>
    <!--?php echo "PP"; ?-->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script> -->
  </body>
</html>


<script>


    $(document).ready(function(){

       $('#material').change(function(){

         var val =$(this).val();
         if(val==''){

         }
         else{
           $('#material_error').css("display", "none");
           $('#material').css("border", "1px solid #ced4da");
         }
       });
       $('#user_description').keydown(function(){

         var val1 =$(this).val();

         if(val1==''){

         }
         else{
           $('#user_description_error').css("display", "none");
           $('#user_description').css("border", "1px solid #ced4da");
         }

       });
       $('#user_name').keydown(function(){

         var val2 =$(this).val();

         if(val2==''){

         }
         else{
           $('#user_name_error').css("display", "none");
           $('#user_name').css("border", "1px solid #ced4da");
         }

       });
       $('#user_email').keydown(function(){

         var val3 =$(this).val();

         if(val3==''){

         }
         else{
           $('#user_email_error').css("display", "none");
           $('#user_email').css("border", "1px solid #ced4da");
         }

       });

       $('#user_phone').keydown(function(){

         var val3 =$(this).val();

         if(val3==''){

         }
         else{
           $('#user_phone_error').css("display", "none");
           $('#user_phone').css("border", "1px solid #ced4da");
         }

       });
    });


function myFormcreate(){

   var material =document.getElementById('material').value;
   var materialcheck =document.getElementById('material').value;

   var colour =document.getElementById('colour').value;
   var height =document.getElementById('height').value;
   var width =document.getElementById('width').value;
   var length =document.getElementById('length').value;

   var budget =document.getElementById('budget').value;

   var discount =document.getElementById('discount').value;

   var user_description =document.getElementById('user_description').value;
   var user_descriptioncheck  =document.getElementById('user_description').value;

   var user_name =document.getElementById('user_name').value;
   var user_namecheck =document.getElementById('user_name').value;

   var user_email =document.getElementById('user_email').value;
   var user_emailcheck =document.getElementById('user_email').value;

   var user_phone =document.getElementById('user_phone').value;
   var user_phonecheck =document.getElementById('user_phone').value;


   var cfrom_btn =document.getElementById('cfrom_btn').name;


   if(materialcheck=='' && user_descriptioncheck=='' && user_namecheck=='' && user_emailcheck==''  && user_phonecheck==''){
     $('#material_error').css("display", "inherit");
     $('#material').css("border", "1px solid red");

     $('#user_description_error').css("display", "inherit");
     $('#user_description').css("border", "1px solid red");

     $('#user_name_error').css("display", "inherit");
     $('#user_name').css("border", "1px solid red");

     $('#user_email_error').css("display", "inherit");
     $('#user_email').css("border", "1px solid red");

     $('#user_phone_error').css("display", "inherit");
     $('#user_phone').css("border", "1px solid red");
   }
   else if (user_descriptioncheck=='') {
     $('#user_description_error').css("display", "inherit");
     $('#user_description').css("border", "1px solid red");
   }
   else if (user_namecheck=='') {
     $('#user_name_error').css("display", "inherit");
     $('#user_name').css("border", "1px solid red");
   }
   else if (user_emailcheck=='') {
     $('#user_email_error').css("display", "inherit");
     $('#user_email').css("border", "1px solid red");
   }
   else if (user_phonecheck=='') {
     $('#user_phone_error').css("display", "inherit");
     $('#user_phone').css("border", "1px solid red");
   }
   else {
     $.ajax({
          url:"Test1.php",
          method:"POST",
          data:{material:material,colour:colour,height:height,width:width,length:length,budget:budget,discount:discount,user_description:user_description,user_name:user_name,user_email:user_email,user_phone:user_phone,cfrom_btn:cfrom_btn},
          success:function(data){

            $('#msg_view').html(data);
            myform();
          }
     });
   }
   // Message success view
   function myform() {
       var x = document.getElementById("snackbar");
       x.className = "show";
       setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);

       // Location refech
       setTimeout(function(){location.reload(); },3000);
   }
  }
</script>
