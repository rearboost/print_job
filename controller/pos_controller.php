    <?php
        // Database Connection
        require '../include/config.php';
        // session check
        include('../include/check.php');

           // Row Add Function 
        if(isset($_POST['addrow'])){

            $product_name = $_POST['product_name'];
            $quantity = $_POST['quantity'];
            $price = $_POST['price'];


            $sql ="SELECT * FROM pos_temp WHERE product= '$product_name' AND price='$price'";
            $result=mysqli_query($conn,$sql);
            $row_get = mysqli_fetch_assoc($result);
            $count =mysqli_num_rows($result);

            $amount = $quantity * $price;

                if($count==0){
                
                    $sql_temp = "INSERT INTO pos_temp (product,price,qty,amount) VALUES ('$product_name','$price','$quantity','$amount')";
                    $result_temp = mysqli_query($conn,$sql_temp);
                
                }else{

                        $sql_temp = "UPDATE pos_temp
                        SET qty = qty + $quantity, 
                            amount = amount + $amount
                        WHERE product= '$product_name'";
                        $result_temp = mysqli_query($conn,$sql_temp);
                }

                $sql ="SELECT SUM(amount) AS amount FROM pos_temp";
                $result=mysqli_query($conn,$sql);
                $row_get = mysqli_fetch_assoc($result);
                $amount = $row_get['amount'];
               
                echo $amount;
        }


        // Table Empty Function 
        if(isset($_POST['tmpEmpty'])){
            
            $empty_temp = "TRUNCATE pos_temp;";
            mysqli_query($conn,$empty_temp);   
        }

        // Remove  Function 
        if(isset($_POST['removeRow'])){
            
            $id = $_POST['id'];
            $remove_temp = "DELETE FROM pos_temp WHERE id='$id'";
            mysqli_query($conn,$remove_temp);

            $sql ="SELECT SUM(amount) AS amount FROM pos_temp";
            $result=mysqli_query($conn,$sql);
            $row_get = mysqli_fetch_assoc($result);
            $amount = $row_get['amount'];
            
            echo $amount;
    
        }

        //////////////////////////////////////////////////////////////

        // Save Function 
        if(isset($_POST['save'])){


            $total = $_POST['total'];
            $discount = $_POST['discount'];
            $payment = $_POST['payment'];
            $date = $_POST['date'];
            $inv_id = $_POST['inv_id'];
            $customer = $_POST['customer'];
            $address = $_POST['address'];

            $sql_sale = "INSERT INTO sales (discount,total,payment,date,inv_id,customer,address) VALUES ('$discount','$total','$payment','$date','$inv_id','$customer','$address')";
            mysqli_query($conn,$sql_sale);

            $sql ="SELECT id FROM sales ORDER BY id DESC LIMIT 1";
            $result=mysqli_query($conn,$sql);
            $row_get = mysqli_fetch_assoc($result);
            $invoice_id = $row_get['id'];

            $sql_temp=mysqli_query($conn,"SELECT * FROM pos_temp");

            $numRows = mysqli_num_rows($sql_temp); 

            if($numRows > 0) {

                while($row = mysqli_fetch_assoc($sql_temp)) {

                    $product=$row['product'];
                    $price=$row['price'];
                    $qty=$row['qty'];
                    $amount=$row['amount'];

                    $sql_sale_items = "INSERT INTO sale_items (sale_id,product,price,qty,amount) VALUES ('$invoice_id','$product','$price','$qty','$amount')";
                    mysqli_query($conn,$sql_sale_items);
                }
            }

            if($result){
                
                echo $invoice_id;

            }else{
                echo  mysqli_error($conn);		
            }

        
        }
       
    ?>