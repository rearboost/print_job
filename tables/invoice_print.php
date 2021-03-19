<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<style>
body{
  font-family: Times new roman;
  font-size: 14px;
  font-color: black;
}
.invoice{
  width:595px;
  height:420px;
  display: flex;
}
.left{
  width:20%;
  padding-left: 10px;
  padding-right: 10px;
  background-color: #ffffff;
/*  align-items: center;
  justify-content: center;*/
}
.right{
  width:80%;
  background-color: #e0dee9;
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

table {
  width: 100%;
  border-collapse: collapse;
}
.row2{
  padding: 10px;
}
.row3{
  padding: 10px;
}
.col31{
  width: 75%;
  text-align: right;
  padding-right: 20px;
}
.col32{
  width: 25%;
}
</style>
<body class="">
  <!-- <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row"> -->

        <div class="invoice">

        <div class="left">
          <img src="../icon/logo-01.png" width="128px" height="128px">
        </div><!--column 1-->

        <div class="right">
          <h1><i>INVOICE</i></h1>
          <div class="row1">
            <div class="col1">
              <label>Customer Name</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <span class="data">Amali Senadheera</span><br>

              <label>Customer Address</label>&nbsp;&nbsp;
              <span class="data">Panadura</span><br>

              <label>Designer Name</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <span class="data">Kasun Madusanka</span><br>
            </div>
            <div class="col2">
              <label>Invoice No</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <span class="data">Kasun Madusanka</span><br>

              <label>Invoice Date/Time</label>&nbsp;&nbsp;
              <span class="data">Kasun Madusanka</span><br>

              <label>Job No</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <span class="data">Kasun Madusanka</span><br>
            </div>
          </div>

          <div class="row2">
          <table>
              <tr>
                <th>Description</th>
                <th>Qty</th>
                <th>Unit price</th>
                <th>Amount</th>
              </tr>
              <tr>
                <td>xxxxxxxxxxx</td>
                <td style="text-align: right;">xx</td>
                <td style="text-align: right;">xxx</td>
                <td style="text-align: right;">xxxx</td>
              </tr>
            </table>
          </div><!--row 2-->
          <div class="row3">
            <div class="col31">
              
            </div>
            <div class="col32">
              
            </div>
          </div><!--row 3-->
        </div><!--column 2-->

      </div><!--invoice-->

      <!--/div><row-->
    <!--/div><container-fluid-->
  <!--/div><content-wrapper-->
</body>

  <script>
  ////////////////  Print  ///////////////////////
  $(document).ready(function(){
      setTimeout(function(){ window.print(); }, 2000);
     // setTimeout(window.close, 3000);
  });
  ///////////////////////////////////////////
  </script>