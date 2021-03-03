<body class="">
  <div class="wrapper ">

  <?php
    // Database Connection
    require '../include/config.php';
    //$id = $_GET['id']; // get id through query string

    $qry = mysqli_query($conn,"SELECT * FROM jobs WHERE id='10' "); // select query

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
                  <label style="color: black; margin-bottom: 0;"><b>Job No</b></label><span style="color: black;"> : <?php echo $data['id'] ?> </span><br>
                  <label style="color: black; margin-bottom: 0;"><b>Customer</b></label><span style="color: black;"> : <?php echo $data['customer'] ?> </span><br>
                </div>
              </div> 
            </div> 
            <span style="color: black;">--------------------------------------------------</span>
            <div class="row"> 
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <label style="color: black; margin-bottom: 0;"><b>Description</b></label><span style="color: black;"> : <?php echo $data['product'] ?> </span><br>
                  <label style="color: black; margin-bottom: 0;"><b>Total Amount</b></label><span style="color: black;"> : <?php echo $data['budget'] ?> </span><br>
                  <label style="color: black; margin-bottom: 0;"><b>Discount</b></label><span style="color: black;"> : <?php echo $data['discount'] ?> </span><br>
                  <label style="color: black; margin-bottom: 0;"><b>Net Amount</b></label><span style="color: black;"> : <?php echo $data['discounted'] ?> </span><br>
                  <label style="color: black; margin-bottom: 0;"><b>Advance</b></label><span style="color: black;"> : <?php echo $data['ad_pay_amount'] ?> </span><br>
                  <label style="color: black; margin-bottom: 0;"><b>Rest</b></label><span style="color: black;"> : <?php echo $data['payment'] ?> </span><br>

                  <span style="color: black;">--------------------------------------------------</span><br>

                  <label style="color: black; margin-bottom: 0;"><b>Cash</b></label><span style="color: black;"> : <?php echo $data['cash'] ?> </span><br>
                  <label style="color: black; margin-bottom: 0;"><b>CHANGE</b></label><span style="color: black;"> : <?php echo $data['change_amt'] ?> </span><br>
                </div>
              </div> 
            </div> 
            
            <span style="color: black;">--------------------------------------------------</span>
            <h3>THANK YOU FOR VISIT US.</h3>
         </form>
  </div>