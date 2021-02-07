<?php
require("header.php");
$id='';
$customer = '';
$invoice_no = '';
$invoice_date = '';
$category = '';
$item = '';
$item_code ='';
$qty ='';
$unit = '';
$price_unit ='';
$dis_per = '';
$dis_amt = '';
$tax ='';
$tax_amt ='';
$amount ='';
$status= '';
$total = '';

if(isset($_GET['id']) && $_GET['id']!=''){
    $id = get_safe_value($con,$_GET['id']);
    $res= mysqli_query($con,"select * from `sales` where id='$id'");
    $check = mysqli_num_rows($res);
 
    if($check >0){
    $row = mysqli_fetch_assoc($res);
    $id=$row['id'];
    $customer = $row['customer'];
    $invoice_no = $row['invoice_no'];
    $invoice_date = $row['invoice_date'];
    $category = $row['category'];
    $item = $row['item'];
    $item_code =$row['item_code'];
    $qty =$row['qty'];
    $unit = $row['unit'];
    $price_unit =$row['price_unit'];
    $dis_per = $row['dis_per'];
    $dis_amt = $row['dis_amt'];
    $tax =$row['tax'];
    $tax_amt =$row['tax_amt'];
    $amount =$row['amount'];
    $status= $row['status'];
    $total = $row['total'];
     
     
    }
}

if(isset($_POST['submit'])){
    $id=get_safe_value($con,$_POST['id']);
    $customer = get_safe_value($con,$_POST['customer']);
    $invoice_no = get_safe_value($con,$_POST['invoice_no']);
    $invoice_date = get_safe_value($con,$_POST['invoice_date']);
    $category = get_safe_value($con,$_POST['category']);
    $item = get_safe_value($con,$_POST['item']);
    $item_code = get_safe_value($con,$_POST['item_code']);
    $qty = get_safe_value($con,$_POST['qty']);
    $unit = get_safe_value($con,$_POST['unit']);
    $price_unit = get_safe_value($con,$_POST['price_unit']);
    $dis_per = get_safe_value($con,$_POST['dis_per']);
    $dis_amt = get_safe_value($con,$_POST['dis_amt']);
    $tax = get_safe_value($con,$_POST['tax']);
    $tax_amt = get_safe_value($con,$_POST['tax_amt']);
    $amount = get_safe_value($con,$_POST['totalAmt']);
    $status= get_safe_value($con,$_POST['status']);
    $total = get_safe_value($con,$_POST['totalAmt']);

    if(isset($_GET['id']) && $_GET['id']!=''){


        if(mysqli_query($con,"UPDATE  `sales` set customer='$customer',invoice_no='$invoice_no' )")){
         echo "Done";

     }else{
        echo("Error description: " . mysqli_error($con));
     }

    }else{


   if(mysqli_query($con,"INSERT INTO `sales`(`customer`, `invoice_no`, `invoice_date`, `category`, `item`, `item_code`, `qty`, `unit`, `price_unit`, `dis_per`, `dis_amt`, `amount`, `tax_amt`, `tax`, `total`, `status`)
     VALUES ('$customer','$invoice_no','$invoice_date','$category','$item','$item_code','$qty','$unit','$price_unit','$dis_per','$dis_amt','$amount','$tax_amt','$tax','$total','$status')"))
     {
         echo "Done";

     }else{
        echo("Error description: " . mysqli_error($con));
     }

    }
 }

?>




<div class="container content pb-0" style="padding-top:3%;
">
    <!-- Content here -->

    <form method="POST" action="sales.php">
        <div class="row">
            <div class="col-sm-8">

                <!-- Default checked -->



                <div class="col-xs-2" style="
          width: 20rem;
          padding: 3%;
          ">
                    <div style="padding-bottom:3%;
          
          ">
                        <label style="padding-right:10%;
             font-weight: bold;
            font-size: larger;
    
             ">Sales:</label><input type="hidden" name="status" value="cash"><input type="checkbox" checked
                            data-toggle="toggle" data-on="Cash" data-off="Credit" data-onstyle="success"
                            data-offstyle="danger" name="status" value="credit">

                    </div>
                    <select name='customer' class="form-control">
                                    <option value="<?php echo $customer ?>" selected > <?php if($customer!=''){
                                        echo $customer;
                                    }else{
                                        echo "Select Customer";
                                    } ?></option>
                                    <?php

                                    $res = mysqli_query($con, "select id,name from customer order by id desc");
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        echo "<option  value=" . $row['name'] . ">" . $row['name'] . "</option>";
                                    }

                                    ?>
                                </select>
                   

                </div>
            </div>

            <div class="col-sm-4" style="padding-top: 20px;">

                <label>Invoice No.</label><input type="text" id="invoice_no" value="<?php echo $invoice_no ?>" name="invoice_no"><br>
                <label>Invoice Date</label><input type="date" id="invoice_date" value="<?php echo $invoice_date ?>" name="invoice_date">
            </div>
        </div>
        <div class="container" style="padding-top: 1cm;">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">CATEGORY</th>
                        <th scope="col">ITEM</th>
                        <th scope="col">ITEM CODE</th>
                        <th scope="col">QTY</th>
                        <th scope="col">UNIT</th>
                        <th scope="col">PRICE/UNIT</th>
                        <th scope="col" colspan="2" style="text-align: center;">DISCOUNT</th>
                        <th scope="col">AMOUNT</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- <tr>
                        <td colspan="7"></td>
                        <th style="text-align: center;">%</th>
                        <th style="text-align: center;">Amount</th>
                        <td colspan="2"></td>
                    </tr> -->
                    <tr>

                        <td><input type="text" id="id" name="id" value="<?php echo $id ?>" size="5"></td>
                        <td><input type="text" id="category" name="category" value="<?php echo $category ?>" size="5"></td>
                        <td><input type="text" id="item" name="item" value="<?php echo $item ?>" size="5"></td>
                        <td><input type="text" id="item_code" name="item_code" value="<?php echo $item_code ?>" size="5"></td>
                        <td><input type="text" id="qty" name="qty" value="<?php echo $qty ?>" size="5"></td>
                        <td><input type="text" id="unit" name="unit" value="<?php echo $unit ?>" size="5" ></td>
                        <td><input type="text" id="price_unit" name="price_unit" value="<?php echo $price_unit ?>" size="5"></td>
                        <td><input type="text" id="dis_per" name="dis_per"  placeholder="%" size="5" value="<?php echo $dis_per ?>" onchange="fillform();" ></td>
                        <td><input type="text" id="dis_amt" name="dis_amt"  placeholder="DisAmt" value="<?php echo $dis_amt ?>" size="5" ></td>
                        <td><input type="text" id="amount" name="amount" value="<?php echo $amount ?>" size="5"></td>
                    </tr>
                   
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-sm-8"></div>
            <div class="col-sm-4" style="padding-top: 2cm;">
                <label for="discount">Discount:</label><input type="text"  placeholder="(%)" id="disPer" value="<?php echo $dis_per ?>" name="disPer"  
                    style="width: 3rem;
              text-align: center;
              display: inline;">-<input type="text" placeholder="(Rs)" id="disAmt" name="disAmt" value="<?php echo $dis_amt ?>" style="width: 5rem;
              text-align: center;
              display: inline;"><br>
                <label style="padding-top: 20px;">Tax: </label><select id="tax" name="tax" value="<?php echo $tax ?>" onchange="filltax();">
                    <option value="null">None</option>
                    <option value="13">13%</option>
                    <option value="gst">GST</option>
                </select>
                <h6 style="padding-top: 10px;">Tax Amount:<?php  ?><input name="tax_amt" id="tax_amt" value="<?php echo $tax_amt ?>" type="text" ></h6>
                <label style="padding-top: 10px;">
                    Total:
                </label><input type="text" id="totalAmt" value="<?php echo $total ?>" name="totalAmt">
                <script>
                    function fillform()
                    {
                        
                        
                        var disPer=document.getElementById('dis_per').value;
                        document.getElementById('disPer').value=disPer;
                        var priceUnit=document.getElementById('price_unit').value;
                        var qty=document.getElementById('qty').value;
                        var total = priceUnit*qty;
                       
                        var disAmount = total * (disPer/100);
                        var totalAfterDis = total-disAmount;
                        document.getElementById('dis_amt').value=disAmount;
                        document.getElementById('disAmt').value=disAmount;
                        document.getElementById('amount').value=totalAfterDis;
                        
                              
                           
                    }
                    function filltax()
                    {
                        var tax = document.getElementById('tax').value;
                        var totalAfterDis= document.getElementById('amount').value;
                        var taxAmt=totalAfterDis*tax/100;
                        var totalAmt=Number(taxAmt) + Number(totalAfterDis);
                        document.getElementById('tax_amt').value=taxAmt;
                        document.getElementById('totalAmt').value=totalAmt;  
                    }


                </script>

               
                <br>
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        Share
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>

                </div>
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </div>
        </div>

    </form>
</div>

<?php
require("footer.php");
?>


