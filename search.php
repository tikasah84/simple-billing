<?php
require("header.php");
$customer = '';
$msg = " ";
$netTotal = 0;

if (isset($_POST['submit'])) {
    $customer = get_safe_value($con, $_POST['customer']);
    echo " <a href='print.php?type=" . $customer . " ' <button style='font-size:24px;color: darkviolet; '>Print <i class='fa fa-print'></i></button> </a>";
}
?>



<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="car">
                    <div class="card-body">
                        <form method="POST" action="search.php">
                            <div class="form-group">
                                <label for="category" class=" form-control-label"> Search Customer</label>
                                <select name='customer' class="form-control">
                                    <option>Select Customer</option>
                                    <?php

                                    $res = mysqli_query($con, "select id,customer from sales order by id desc");
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        echo "<option  value=" . $row['customer'] . ">" . $row['customer'] . "</option>";
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
                                        $res = mysqli_query($con, "SELECT * FROM `sales` WHERE customer='$customer' ");
                                        while ($row = mysqli_fetch_assoc($res)) {

                                            // print_r($row);
                                        ?>

                                            <tr>



                                                <th><?php echo $row['id'] ?></th>
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
                                                <?php $netTotal = $row['total'] + $netTotal ?>

                                            <?php



                                        }
                                       ?>



                                            </tr>



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
        <?php if ($customer != '') {
            echo "The total sales done by " . $customer . " : " . $netTotal;
        } 
       
           
        ?></b>

    <?php
    require("footer.php")
    ?>