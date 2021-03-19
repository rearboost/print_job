<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
body{
  font-family: Times new roman;
  font-size: 30px;
  font-color: black;
}
.invoice{
  width:2480px;
  height:1748px;
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
  width:80%;
  background-color: #e0dee9;
  padding: 3%;
}
h1{
  text-align: center;
  font-weight: 500;
  color:#282365;
}
.row1{
  display: flex;
  padding: 0 10px 0 10px;
}
.col1{
  width:50%;
}
.col2{
  width:50%;
}
table, td, th {
  border: 1px solid black;
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
  padding-top: 5%;
}
.row3{
  padding-top: 0px;
  display: flex;
}
.row4{
  padding-top: 8%;
  display: flex;
}
.col31{
  width: 78%;
  text-align: right;
  padding-right: 20px;
}
.col32{
  width: 22%;
  text-align: right;
  padding-right: 10px;
}
.advance{
  /*text-decoration: underline;*/
  border-bottom: 1px solid;
  border-color: black;
}
.balance{
  border-bottom: double;
  border-color: black;
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
</style>
<body>
<?php
  // Database Connection
  require '../include/config.php';
  $id = $_GET['id']; // get id through query string

  $qry = mysqli_query($conn,"SELECT * FROM jobs WHERE id=$id "); // select query

  $data = mysqli_fetch_array($qry); // fetch data
      
  $date = new DateTime(null, new DateTimeZone('Asia/Colombo'));

?>
<div class="invoice">

  <div class="left">
    <img src="../icon/logo-01.png" width="128px" height="128px" class="img-center">
  </div><!--column 1-->

  <div class="right">
    <h1><i>INVOICE</i></h1>

    <div class="row1">
      <div class="col1">
        <label style="padding-right: 38px;">Customer Name</label>
        <span><?php echo $data['customer'] ?> </span><br>

        <?php
        $c_name = $data['customer'];
        $qry_customer = mysqli_query($conn, "SELECT * FROM customer WHERE customer_name='$c_name'");
        $row = mysqli_fetch_array($qry_customer);

        ?>

        <label style="padding-right: 11px;">Customer Address</label>
        <span><?php echo $row['address'] ?></span><br>

        <label style="padding-right: 43px;">Designer Name</label>
        <span><?php echo $data['designed_by'] ?></span><br>
      </div>
      <div class="col2">
        <label style="padding-right: 102px;">Invoice No</label>
        <span> xxxx </span><br>

        <label style="padding-right: 11px;">Invoice Date/Time</label>
        <span><?php echo $date->format('Y-m-d H:i:sa'); ?> </span><br>

        <label style="padding-right: 150px;">Job No</label>
        <span><?php echo $data['job_no'] ?> </span><br>
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
        <tr>
          <td style="text-align: center;">Description</td>
          <td style="text-align: center;">Qty</td>
          <td style="text-align: center;">Unit price</td>
          <td style="text-align: center;">Amount</td>
        </tr>
        <tr>
          <td><?php echo $data['product'] ?> </td>
          <td style="text-align: right;"><?php echo $data['quantity'] ?></td>
          <td style="text-align: right;">
            <?php 
              $unit_price = $data['unit_price'];
              echo number_format($unit_price,2,".",",") 
            ?>
          </td>
          <td style="text-align: right;">
            <?php 
              $budget = $data['budget'];
              echo number_format($budget,2,".",",") 
            ?> 
          </td>
        </tr>
      </table>
    </div><!--row 2-->

    <div class="row3">
      <div class="col31">
        <label>Total Value</label>
      </div>
      <div class="col32">
        <span>
        <?php 
          $discounted = $data['discounted'];
          echo number_format($discounted,2,".",",") 
        ?>
        </span><br>  
      </div>
    </div><!--row 3-->

    <div class="row3">
      <div class="col31">
        <label>Advance Payment</label>
      </div>
      <div class="col32">
        <span class="advance">
        <?php 
          $ad_pay_amount = $data['ad_pay_amount'];
          echo number_format($ad_pay_amount,2,".",",") 
        ?>
        </span><br>
      </div>
    </div><!--row 3-->

    <div class="row3">
      <div class="col31">
        <label><b>Balance Payment</b></label>
      </div>
      <div class="col32">
        <span class="balance"><b>
          <?php 
            $payment = $data['payment'];
            echo number_format($payment,2,".",",") 
          ?>
        </b></span><br>
      </div>
    </div><!--row 3-->

    <div class="row4">
      <div class="col41">
        <label>Prepared by</label>
      </div>

      <div class="middle"></div>

      <div class="col42">
        <label>customer</label>
      </div>

    </div><!--row 4-->
  </div><!--column 2-->
</div><!--invoice-->

</body>

  <script>
  ////////////////  Print  ///////////////////////
  $(document).ready(function(){
      setTimeout(function(){ window.print(); }, 2000);
     // setTimeout(window.close, 3000);
  });
  ///////////////////////////////////////////
  </script>