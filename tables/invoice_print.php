<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
body{
  font-family: Times new roman;
  font-size: 30px;
  font-color: black;
}
.invoice{
  width: 760px;
  /* height:700px; */
  /*width:1240px;
  height:874px;*/
  display: flex;
}
.left{
  width:20%;
  background-color: #ffffff;
}
.img-center {
  display: block;
  margin-left: auto;
  margin-right: auto;
}
.right{
  width:100%;
  /* background-color: #e0dee9; */
  /* padding: 3%; */
  padding-top: 80px;
}
h1{
  text-align: center;
  font-weight: 500;
  color:#282365;
}
.row1{
  display: flex;
  padding: 0px 0px 0 80px
}
.col1{
  width:50%;
}
.col2{
  width:50%;
}
table, td, th {
  /* border: 1px solid black; */
}
td{
  line-height: 35px;
}

table {
  width: 100%;
  border-collapse: collapse;
  font-size: 30px;
}
.row2{
  /* padding-top: 5%; */
  padding-bottom: 95px;
}
.row3{
  padding-top: 0px;
  display: flex;
  padding-bottom: 5px;
  padding-right: 30px;
}
.row4{
  /* padding-top: 8%; */
  display: flex;
  padding: 65px 0px 0 80px;
}
.col31{
  width: 78%;
  text-align: right;
  padding-right: 20px;
}
.col32{
  width: 22%;
  text-align: right;
  /* padding-right: 10px; */
}
.advance{
  /*text-decoration: underline;*/
  /* border-bottom: 1px solid;
  border-color: black; */
}
.balance{
  /* border-bottom: double;
  border-color: black; */
}
.col41{
  width: 25%;
  border-top: dotted;
  text-align: center;
}
.middle{
  width: 50%;
}
.col42{
  width: 25%;
  border-top: dotted;
  text-align: center;
}
.font-print{
  font-size: 14px;
}
</style>
<body>
<?php
  // Database Connection
  require '../include/config.php';
  $id = $_GET['id']; // get id through query string

  $qry = mysqli_query($conn,"SELECT * FROM jobs WHERE id=$id "); // select query

  $data = mysqli_fetch_array($qry); // fetch data
      
  $date = new DateTime(null, new DateTimeZone('Asia/Colombo'));

  $job_no =  $data['job_no'];

  $check= mysqli_query($conn, "SELECT * FROM invoice WHERE job_id='$job_no'");
	$count = mysqli_num_rows($check);

  if($count ==0){

    $check_get= mysqli_query($conn, "SELECT * FROM invoice ORDER BY invoice_id DESC LIMIT 1");
    $row = mysqli_fetch_array($check_get);
    $invoice_id= $row['invoice_id']+1;

    //Insert 
    $insert = "INSERT INTO invoice (job_id) VALUES ('$job_no')";
    $result = mysqli_query($conn,$insert);

  }else{

     $row = mysqli_fetch_array($check);
     $invoice_id= $row['invoice_id'];
  }

  $invoice_id = str_pad($invoice_id, 5, '0', STR_PAD_LEFT);

?>
<div class="invoice">

  <div class="left">
    <!-- <img src="../icon/logo-01.png" width="128px" height="128px" class="img-center"> -->
  </div><!--column 1-->

  <div class="right">
    <!-- <h1><i>INVOICE</i></h1> -->

    <div class="row1">

      <div class="col1">
        <label style="padding-right: 120px;"></label>
        <span class="font-print"><?php echo $data['customer'] ?> </span><br>

          <?php
          $c_name = $data['customer'];
          $qry_customer = mysqli_query($conn, "SELECT * FROM customer WHERE customer_name='$c_name'");
          $row = mysqli_fetch_array($qry_customer);

          ?>
        
        <label style="padding-right: 120px;"></label>
        <span class="font-print"><?php echo $row['address'] ?></span><br>
        
        <label style="padding-right: 120px;"></label>
        <span class="font-print"><?php echo $data['designed_by'] ?></span><br>
      </div>


      <div class="col2">
        <label style="padding-right: 173px;"></label>
        <span class="font-print"><?php echo $invoice_id; ?> </span><br>
        <label style="padding-right: 173px;"></label>
        <span class="font-print"><?php echo $date->format('Y-m-d H:i'); ?> </span><br>
        <label style="padding-right: 173px;"></label>
        <span class="font-print"><?php echo $data['job_no'] ?> </span><br>
      </div>
        <!-- <label style="padding-right: 5%;">Customer Name</label> -->
        <!-- <label style="padding-right: 1.5%;">Customer Address</label> -->
        <!-- <label style="padding-right: 6%;">Designer Name</label> -->
        <!-- <label style="padding-right: 14%;">Invoice No</label> -->
        <!-- <label style="padding-right: 1%;">Invoice Date/Time</label> -->
        <!-- <label style="padding-right: 20%;">Job No</label> -->
    </div>

    <div class="row2">
      <table>
        <!-- <tr>
          <td style="text-align: center;">Description<br></td>
          <td style="text-align: center;">Qty</td>
          <td style="text-align: center;">Unit price</td>
          <td style="text-align: center;">Amount</td>
          
        </tr> -->
        <br>
        <br>
        <tr>
          <td style="text-align: center; width: 390px;" class="font-print"><?php echo $data['product'] ?> </td>
          <td style="text-align: center;" class="font-print"><?php echo $data['quantity'] ?></td>
          <td style="text-align: center;" class="font-print">
            <?php 
              $unit_price = $data['unit_price'];
              echo number_format($unit_price,2,".",",") 
            ?>
          </td>
          <td style="text-align: center;" class="font-print">
            <?php 
              $budget = $data['budget'];
              echo number_format($budget,2,".",",") 
            ?> 
          </td>
        </tr>
      </table>
    </div><!--row 2-->
    <!-- <br>
    <br>
    <br> -->
    <!-- <br> -->
    <div class="row3">
      <div class="col31">
        <label class="font-print"></label>
      </div>
      <div class="col32">
        <span class="font-print">
        <?php 
          $discounted = $data['discounted'];
          echo number_format($discounted,2,".",",") 
        ?>
        </span><br>  
      </div>
    </div><!--row 3-->
    <div class="row3">
      <div class="col31">
        <label class="font-print"></label>
      </div>
      <div class="col32">
        <span class="advance font-print">
        <?php 
          $ad_pay_amount = $data['ad_pay_amount'];
          echo number_format($ad_pay_amount,2,".",",") 
        ?>
        </span><br>
      </div>
    </div><!--row 3-->
    <div class="row3">
      <div class="col31">
        <label class="font-print"></label>
      </div>
      <div class="col32">
        <span class="balance font-print"><b>
          <?php 
            $payment = $data['payment'];
            echo number_format($payment,2,".",",") 
          ?>
        </b></span><br>
      </div>
    </div><!--row 3-->

    <!-- <div class="row4">
      <div class="col41">
        <label class="font-print">Prepared by</label>
      </div>

      <div class="middle"></div>

      <div class="col42">
        <label class="font-print">customer</label>
      </div>

    </div> -->
    <!--row 4-->
  </div><!--column 2-->
</div><!--invoice-->

</body>

  <script>
  ////////////////  Print  ///////////////////////
  $(document).ready(function(){
     setTimeout(function(){ window.print(); }, 1500);
     // setTimeout(window.close, 3000);
  });
  ///////////////////////////////////////////
  </script>