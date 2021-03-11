<body class="">
  <div class="wrapper ">

  <?php
    // Database Connection
    require '../include/config.php';
    $id = $_GET['id']; // get id through query string

    $qry = mysqli_query($conn,"SELECT * FROM jobs WHERE id=$id "); // select query

    $data = mysqli_fetch_array($qry); // fetch data
        
    $date = new DateTime(null, new DateTimeZone('Etc/GMT+8'));

?>

        <form id="print_form">
          <div>
             <span style="padding-left: 35px; font-size: 22px; color: black;"><b>JOB CARD</b></span><br>
             <span style="padding-left: 25px; font-size: revert; color: black;">Address :</span><br>
             <span style="padding-left: 30px; font-size: small; color: black;"><b>Hotline : *** - * *** ***</b></span>
             <br><br>
          </div>
            <div class="row"> 
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <label style="color: black; margin-bottom: 0;"><b>Date</b></label><span style="color: black;"> : <?php echo $date->format('Y-m-d H:i:sa'); ?> </span><br>
                  <label style="color: black; margin-bottom: 0;"><b>Job No</b></label><span style="color: black;"> : <?php echo $data['job_no'] ?> </span><br>
                  <label style="color: black; margin-bottom: 0;"><b>Customer</b></label><span style="color: black;"> : <?php echo $data['customer'] ?> </span><br>
                </div>
              </div> 
            </div> 
            <span style="color: black;">--------------------------------------------------</span>
            <div class="row"> 
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <label style="color: black; margin-bottom: 0;"><b>Description</b></label><span style="color: black;"> : <?php echo $data['product'] ?> </span><br>

                  <label style="color: black; margin-bottom: 0;"><b>Total Amount</b></label><span style="color: black;"> : <?php 
                                          $budget = $data['budget'];
                                          echo number_format($budget,2,".",",") ?> 
                  </span><br>

                  <label style="color: black; margin-bottom: 0;"><b>Discount</b></label><span style="color: black;"> : <?php 
                                          $discount = $data['discount'];
                                          echo number_format($discount,2,".",",") ?> </span><br>

                  <label style="color: black; margin-bottom: 0;"><b>Net Amount</b></label><span style="color: black;"> : <?php 
                                          $discounted = $data['discounted'];
                                          echo number_format($discounted,2,".",",") ?> </span><br>

                  <label style="color: black; margin-bottom: 0;"><b>Advance</b></label><span style="color: black;"> : <?php 
                                      $ad_pay_amount = $data['ad_pay_amount'];
                                      echo number_format($ad_pay_amount,2,".",",") ?> </span><br>

                  <label style="color: black; margin-bottom: 0;"><b>Payment</b></label><span style="color: black;"> : <?php 
                                      $payment = $data['payment'];
                                      echo number_format($payment,2,".",",") ?> </span><br>

                  <span style="color: black;">--------------------------------------------------</span><br>

                  <label style="color: black; margin-bottom: 0;"><b>CASH</b></label><span style="color: black;"> : <?php 
                                      $cash = $data['cash'];
                                      echo number_format($cash,2,".",",") ?> </span><br>

                  <label style="color: black; margin-bottom: 0;"><b>CHANGE</b></label><span style="color: black;"> : <?php 
                                      $change_amt = $data['change_amt'];
                                      echo number_format($change_amt,2,".",",") ?> </span><br>
                </div>
              </div> 
            </div> 
            
            <span style="color: black;">--------------------------------------------------</span>
            <h3>THANK YOU FOR VISIT US.</h3>
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