<?php
require("header.php");
$customer = '';
$msg = "";
$netTotal = 0;

if (isset($_POST['submit'])) {
    $customer = get_safe_value($con, $_POST['customer']);
    $res=mysqli_query($con,"SELECT * FROM `customer` WHERE name='$customer' ");
    if($row=mysqli_fetch_assoc($res))
     {
         $msg="Customer Already exist";

     }else{
         mysqli_query($con,"INSERT INTO `customer`(`name`) VALUES ('$customer')");
     }

}
?>



<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="car">
                    <div class="card-body">
                        <form method="POST" action="addCustomer.php">
                            <div class="form-group">
                                <label for="category" class=" form-control-label"> Add Customer</label>
                                <input class="form-control" placeholder="Customer Name" name="customer" id="customer">

                            </div>
                            <span><h6 style="color: red;
                            padding:5px;
                            "><?php echo $msg ?></h6> </span>
                            <button name="submit" type="submit" class="btn btn-lg btn-info btn-block">
                                <span id="payment-button-amount">Submit</span>
                            </button>
                        </form>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    require("footer.php")
    ?>