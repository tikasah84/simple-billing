<?php
require("header.php");



if(isset($_POST['submit'])){
    $party = get_safe_value($con,$_POST['party']);
    $bill_no = get_safe_value($con,$_POST['bill_no']);
    $bill_date = get_safe_value($con,$_POST['bill_date']);
    $category = get_safe_value($con,$_POST['category']);
    $item = get_safe_value($con,$_POST['item']);
    $item_code = get_safe_value($con,$_POST['item_code']);
    $qty = get_safe_value($con,$_POST['qty']);
    $price_unit = get_safe_value($con,$_POST['price_unit']);
    $dis_per = get_safe_value($con,$_POST['dis_per']);
    $dis_amt = get_safe_value($con,$_POST['dis_amt']);
    $tax = get_safe_value($con,$_POST['tax']);
    $tax_amt = get_safe_value($con,$_POST['tax_amt']);
    $amount = get_safe_value($con,$_POST['AmtAfterDis']);
    $payment= get_safe_value($con,$_POST['payment_type']);
    $total = get_safe_value($con,$_POST['total']);

   if(mysqli_query($con,"INSERT INTO `purchase`( `party`, `bill_no`, `bill_date`, `category`, `item`, `item_code`, `qty`, `price_unit`, `dis_per`, `dis_amt`, `tax`, `tax_amt`, `amount`, `payment`, `total`)
    VALUES ('$party','$bill_no','$bill_date','$category','$item','$item_code','$qty','$price_unit','$dis_per','$dis_amt','$tax','$tax_amt',$amount,'$payment','$total')")){
         echo "Done";

     }else{
        echo("Error description: " . mysqli_error($con));
     }
 }
?>






<div class="container" style="padding-top:3%;">
    <!-- Content here -->

    <form method="post" action="purchase.php">
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
    
             ">Purchase:</label>
                    </div>
                    <input class="form-control" type="text" placeholder="* Party" id="party" name="party" required>

                </div>
            </div>

            <div class="col-sm-4" style="padding-top: 20px;">

                <label>Bill No.</label><input type="number" id="bill_no" name="bill_no"><br>
                <label>Bill Date: </label><input type="date" id="bill_date" name="bill_date">
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
                    
                        <th scope="col">PRICE/UNIT</th>
                        <th scope="col" colspan="2" style="text-align: center;">DISCOUNT</th>
                        <th scope="col">AMOUNT</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="6"></td>
                        <th style="text-align: center;">%</th>
                        <th style="text-align: center;">Amount</th>
                        <td colspan="2"></td>
                    </tr>
                    <tr>

                        <td><input type="text" id="id" name="id" size="5"></td>
                        <td><input type="text" id="category" name="category" size="5"></td>
                        <td><input type="text" id="item" name="item" size="5"></td>
                    
                        <td><input type="text" id="item_code" name="item_code" size="5"></td>
                        <td><input type="text" id="qty" name="qty" size="5"></td>
                        <td><input type="text" id="price_unit" name="price_unit" size="5"></td>
                        <td><input type="text" id="dis_per" name="dis_per" onchange="fillform();" size="5"></td>
                        <td><input type="text" id="dis_amt" name="dis_amt" size="5"></td>
                        <td><input type="text" id="AmtAfterDis" name="AmtAfterDis" size="5"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-sm-8">

                <!-- Default dropright button -->
                <div class="btn-group dropright" style="padding-top:70px;">
                    <select type="button" class="btn btn-secondary dropdown-toggle payment_type" id="payment_type" name="payment_type" data-toggle="dropdown">
                        <option value="check">Cash</option>
                        <option value="cash">Cheque</option>
                        <option value="credit">credit</option>
</select>
                   
                </div>

                <!-- <div class="form-group" style="padding:5px;">
                    <label for="exampleFormControlTextarea2">Add description</label>
                    <textarea class="form-control rounded-0" id="exampleFormControlTextarea2" rows="2"
                        style="width:350px;"></textarea>
                </div> -->

                <!-- <div class="input-group" style="padding:5px;
            width:300px;">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                            aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">Choose Image</label>
                    </div>
                </div> -->
            </div>
            <div class="col-sm-4" style="padding-top: 2cm;">
                <label for="discount">Discount:</label><input type="text" name="disPer" id="disPer" placeholder="(%)" style="width: 3rem;
              text-align: center;
              display: inline;">-<input type="text" placeholder="(Rs)" name="disAmt" id="disAmt" style="width: 5rem;
              text-align: center;
              display: inline;"><br>
                <label style="padding-top: 20px;">Tax: </label><select onchange="filltax();" name="tax" id="tax" >
                    <option value="null">None</option>
                    <option value="13">13%</option>
                    <option></option>
                </select>
                <h6 style="padding-top: 10px;">Tax Amount:<input name="tax_amt" id="tax_amt" /></h6>
                <label style="padding-top: 10px;">
                    Total:<input name="total" id="total">
                </label>
                <td></td>
                <br>
                <!-- <div class="btn-group">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        Share
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>

                </div> -->
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </div>
        </div>

    </form>
</div>
<script>

function fillform()
{
    var qty = document.getElementById('qty').value;
    var priceUnit =document.getElementById('price_unit').value;
    var disPer=document.getElementById('dis_per').value;
    var disAmt=(qty*priceUnit) * (disPer/100);
    var AfterDisAmt=(qty*priceUnit) - disAmt;
    document.getElementById('disPer').value = disPer;
    document.getElementById('dis_amt').value = disAmt;
    document.getElementById('disAmt').value = disAmt;
    document.getElementById('AmtAfterDis').value = AfterDisAmt;
}
function filltax()
{
    var tax=document.getElementById('tax').value;
    console.log(tax);
    
    var AfterDisAmt = document.getElementById('AmtAfterDis').value;
    var taxAmt=AfterDisAmt*(tax/100);
    var total=Number(AfterDisAmt)+taxAmt;
    
    document.getElementById('tax_amt').value=taxAmt;
    document.getElementById('total').value=total;
}

</script>


<?php
require("footer.php")
?>