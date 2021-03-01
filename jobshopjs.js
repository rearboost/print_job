

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
