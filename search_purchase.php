<?php
require("header.php");
$party = '';
$msg = " ";
$netTotal = 0;

if (isset($_POST['submit'])) {
    $party = get_safe_value($con, $_POST['party']);
    
}
?>



<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="car">
                    <div class="card-body">
                        <form method="POST" action="search_purchase.php">
                            <div class="form-group">
                                <label for="category" class=" form-control-label"> Search Party</label>
                                <select name='party' class="form-control">
                                    <option>Select Party</option>
                                    <?php

                                    $res = mysqli_query($con, "select id,party from purchase order by id desc");
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        echo "<option  value=" . $row['party'] . ">" . $row['party'] . "</option>";
                                    }

                                    ?>
                                </select>

                            </div>
                            <button name="submit" type="submit" class="btn btn-lg btn-info btn-block">
                                <span id="payment-button-amount">Submit</span>
                            </button>
                        </form>
                        <div class="card-body">
                            <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Party</th>
                                        <th scope="col">Bill No</th>
                                        <th scope="col">Bill Date</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Item</th>
                                        <th scope="col">ItemCode</th>
                                        <th scope="col">QTY</th>

                                        <th scope="col">PRICE/UNIT</th>
                                        <th scope="col" style="text-align: center;">DISCOUNT</th>
                                        <th scope="col">DISAMT</th>
                                        <th scope="col">TAX</th>
                                        <th scope="col">TAX AMT</th>
                                        <th scope="col">TOTAL</th>

                                    </tr>
                                </thead>
                                <tbody>


                                    <?php
                    $res=mysqli_query($con,"SELECT * FROM `purchase` WHERE party='$party'");
                    $netTotal=0;
                    while($row=mysqli_fetch_assoc($res)){
                       
                     //  print_r($row);
                        ?>

                                    <tr>



                                        <th><?php echo $row['id'] ?></th>
                                        <th><?php echo $row['party'] ?></th>
                                        <th><?php echo $row['bill_no'] ?></th>
                                        <th><?php echo $row['bill_date'] ?></th>
                                        <th><?php echo $row['category'] ?></th>
                                        <th><?php echo $row['item'] ?></th>
                                        <th><?php echo $row['item_code'] ?></th>
                                        <th><?php echo $row['qty'] ?></th>

                                        <th><?php echo $row['price_unit'] ?></th>
                                        <th><?php echo $row['dis_per'] ?></th>
                                        <th><?php echo $row['dis_amt'] ?></th>
                                        <th><?php echo $row['tax'] ?></th>
                                        <th><?php echo $row['tax_amt'] ?></th>
                                        <th><?php echo $row['total'] ?></th>
                                        <?php $netTotal = $row['total'] +$netTotal ?>
                                       


                                    </tr>

                        <?php
                    }
                    ?>

                                </tbody>

                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <b>
        <?php if ($party != '') {
            echo "The total sales done by " . $party . " : " . $netTotal;
        } 
       
           
        ?></b>

    <?php
    require("footer.php")
    ?>