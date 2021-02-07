<?php
require("header.php");





if(isset($_GET['type']) && $_GET['type']!=''){
    $type = get_safe_value($con,$_GET['type']);
    if($type == 'status'){
        $operation = get_safe_value($con,$_GET['operation']);
        $id = get_safe_value($con,$_GET['id']);
        if($operation == 'active')
        {
            $status = '1';
        }
        else{
            $status = '0';
        }
        $update_status = "update `sales` set status='$status' where id='$id' ";
        mysqli_query($con,$update_status);
    }
}

if(isset($_GET['type']) && $_GET['type']!=''){
    $type = get_safe_value($con,$_GET['type']);
    if($type == 'delete'){
       
        $id = get_safe_value($con,$_GET['id']);
       
        $delete_sql = "delete from `sales`  where id='$id' ";
        mysqli_query($con,$delete_sql);
    }
}
?>
<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="car">
                    <div class="card-body">
                        <h4 class="box-title">Sales Details </h4>

                    </div>
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
                    $res=mysqli_query($con,"SELECT * FROM `sales` WHERE 1");
                    while($row=mysqli_fetch_assoc($res)){
                        $netTotal=0;
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
                                        <?php $netTotal = $row['total'] +$netTotal ?>
                                        <th>
                                            <?php 
                                    
                                     if($row['status']==1)
                                     {
                                         echo "<span class='badge badge-pending'><a href='?type=status&operation=deactive&id=".$row['id']."' > Credit</a></span>&nbsp";
                                     } 
                                     else{
                                         echo "<span class='badge badge-complete'><a href='?type=status&operation=active&id=".$row['id']."' >Cash</a></span>&nbsp";
                                     }
                                  
                                     echo "<span class='badge badge-edit'><a href='sales.php?id=".$row['id']."' >Edit</a></span>&nbsp";
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