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
  // session check
  include('../include/check.php');

  $date = new DateTime(null, new DateTimeZone('Asia/Colombo'));

   // Get Print ID Data
    if(isset($_GET['id'])){

        $print_id = $_GET['id'];

        $sql=mysqli_query($conn,"SELECT * FROM sales WHERE inv_id='$print_id'");  
        $numRows = mysqli_num_rows($sql); 
        if($numRows > 0) {
          while($row = mysqli_fetch_assoc($sql)) {

            $sales_id  = $row['id'];
            $invoice_id  = $row['inv_id'];
            $total  = $row['total'];
            $customer  = $row['customer'];
            $address  = $row['address'];
          }
        }
    }


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
        <span class="font-print"><?php echo $customer; ?> </span><br>
        
        <label style="padding-right: 120px;"></label>
        <span class="font-print"><?php echo $address; ?></span><br>
        
        <label style="padding-right: 120px;"></label>
        <span class="font-print"><?php echo $email; ?></span><br>
      </div>


      <div class="col2">
        <label style="padding-right: 173px;"></label>
        <span class="font-print"><?php echo $invoice_id; ?> </span><br>
        <label style="padding-right: 173px;"></label>
        <span class="font-print"><?php echo $date->format('Y-m-d H:i'); ?> </span><br>
        <label style="padding-right: 173px;"></label>
        <span class="font-print"><?php echo $invoice_id; ?> </span><br>
      </div>
    </div>

    <div class="row2">
      <table>
        <br>
        <br>
        <?php
        $items_qry = mysqli_query($conn, "SELECT * FROM sale_items WHERE sale_id='$sales_id'");
        $count = mysqli_num_rows($items_qry);
        if($count>0){
          while($data = mysqli_fetch_assoc($items_qry)){
        ?>
          <tr>
            <td style="text-align: center; width: 390px;" class="font-print"><?php echo $data['product'] ?> </td>
            <td style="text-align: center;" class="font-print"><?php echo $data['qty'] ?></td>
            <td style="text-align: center;" class="font-print">
              <?php 
                $price = $data['price'];
                echo number_format($price,2,".",",") 
              ?>
            </td>
            <td style="text-align: center;" class="font-print">
              <?php 
                $amount = $data['amount'];
                echo number_format($amount,2,".",",") 
              ?> 
            </td>
          </tr>

        <?php
          }
        }
        
        ?>
        
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
          //$total = $row['total'];
          echo number_format($total,2,".",",") 
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
          $ad_pay_amount = 0;
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
            //$total = $data['total'];
            echo number_format($total,2,".",",") 
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