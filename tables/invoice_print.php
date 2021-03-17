<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
body{
  font-family: arial;
  font-size: 14px;
  font-color: black;
}
</style>
<body class="">
  <div class="wrapper ">

  <?php
    // Database Connection
    require '../include/config.php';
    $id = $_GET['id']; // get id through query string

    $qry = mysqli_query($conn,"SELECT * FROM jobs WHERE id=$id "); // select query

    $data = mysqli_fetch_array($qry); // fetch data
        
    $date = new DateTime(null, new DateTimeZone('Asia/Colombo'));

?>
        <form id="print_form">
          <div>
            <!-- <img src="../icon/small.jpg" style="padding-left: 6%;" height="60px" width="60px"><br><br> -->
            <br>
            <span style="padding-left: 0px; font-family: calibri; font-size: 15px;">
                <B>NAVIGATE PRINTERS & ADVERTISING</B>
            </span><br>
            <span style="padding-left: 6px;"> 
                No:170, Welipanna Rd, Aluthgama
            </span><br>
            <span style="padding-left:40px;"> 
                071 2 123 078
            </span><br><br>
          </div>
            <div class="row"> 
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <label>Date</label>
                  <span> : 
                      <?php echo $date->format('Y-m-d H:i:sa'); ?> 
                  </span><br>

                  <label>Job No</label>
                  <span> : 
                      <?php echo $data['job_no'] ?> 
                  </span><br>

                  <label>Customer</label>
                  <span> : 
                      <?php echo $data['customer'] ?> 
                  </span><br>

                </div>
              </div> 
            </div> 
            <span>--------------------------------------------------</span>
            <div class="row"> 
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <label>Description</label><span> : 
                      <?php echo $data['product'] ?> 
                  </span><br>

                  <label>Total Amount</label><span> : 
                      <?php 
                        $budget = $data['budget'];
                        echo number_format($budget,2,".",",") 
                      ?> 
                  </span><br>

                  <label>Discount (%)</label><span> :
                     <?php 
                        $discount = $data['discount'];
                        echo number_format($discount,2,".",",") 
                      ?> 
                  </span><br>

                  <label>Net Amount</label><span> : 
                      <?php 
                        $discounted = $data['discounted'];
                        echo number_format($discounted,2,".",",") 
                      ?> 
                  </span><br>

                  <label>Advance</label><span> : 
                      <?php 
                        $ad_pay_amount = $data['ad_pay_amount'];
                        echo number_format($ad_pay_amount,2,".",",") 
                      ?> 
                  </span><br>

                  <label>Payment</label><span> : 
                      <?php 
                        $payment = $data['payment'];
                        echo number_format($payment,2,".",",") 
                      ?> 
                  </span><br>

                  <span>--------------------------------------------------</span><br>

                  <label>CASH</label><span> : 
                      <?php 
                        $cash = $data['cash'];
                        echo number_format($cash,2,".",",") 
                      ?> 
                  </span><br>

                  <label>CHANGE</label><span> : 
                      <?php 
                        $change_amt = $data['change_amt'];
                        echo number_format($change_amt,2,".",",") 
                      ?> 
                  </span><br>
                </div>
              </div> 
            </div> 
            
            <span>--------------------------------------------------</span>
            <h4 style="padding-left: 15px;">THANK YOU FOR VISIT US.</h4>
         </form>
  </div>

  <script>
  ////////////////  Print  ///////////////////////
  $(document).ready(function(){
      setTimeout(function(){ window.print(); }, 2000);
     // setTimeout(window.close, 3000);
  });
  ///////////////////////////////////////////
  </script>