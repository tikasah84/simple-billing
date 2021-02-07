<?php
require("header.php");
?>
<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="car">
                    <div class="card-body">
                        <h4 class="box-title">Purchase Details </h4>

                    </div>
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
                    $res=mysqli_query($con,"SELECT * FROM `purchase` WHERE 1");
                    while($row=mysqli_fetch_assoc($res)){
                        $netTotal=0;
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
                                        <th>
                                            <?php 
                                    
                                     if($row['payment']=="cash")
                                     {
                                         echo "<span class='badge badge-pending'><a href='?type=status&operation=deactive&id=".$row['id']."' > Credit</a></span>&nbsp";
                                     } 
                                     else{
                                         echo "<span class='badge badge-complete'><a href='?type=status&operation=active&id=".$row['id']."' >Cash</a></span>&nbsp";
                                     }
                                  
                                     echo "<span class='badge badge-edit'><a href='manage_categories.php?id=".$row['id']."' >Edit</a></span>&nbsp";
                                    echo "<span class='badge badge-delete'><a href='?type=delete&id=".$row['id']."'  >Delete</a></span>";
                                
                              }
                              ?>
                                        </th>


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

<?php
require("footer.php")
?>