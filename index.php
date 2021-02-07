<?php
require("header.php");
$TotalPurchase = 0;
$TotalSales = 0;
$TotalSalesToReceive = 0;
$PurshaseRes = mysqli_query($con, "SELECT * FROM `purchase` WHERE 1");
$SalesRes =  mysqli_query($con, "SELECT * FROM `sales` WHERE 1");
$SalesToReceive =  mysqli_query($con, "SELECT * FROM `sales` WHERE status=0");
while ($purchase = mysqli_fetch_assoc($PurshaseRes)) {
    $TotalPurchase = $TotalPurchase + $purchase['total'];
}

while ($sales = mysqli_fetch_assoc($SalesRes)) {
    $TotalSales = $TotalSales + $sales['total'];
}

while ($salesReceive = mysqli_fetch_assoc($SalesToReceive)) {
    $TotalSalesToReceive = $TotalSalesToReceive + $salesReceive['total'];
}




?>

<div class="container">

    <div class="row" style="margin-top: 50px;">
        <a href="sales.php">
            <div class="col">
                <div class="card bg-light mb-3">
                    <div class="card-header">Sale:</div>
                    <div class="card-body">
                    <h6 class="card-title">
                            <div class="dropdown">
                                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Select
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">This Month</a>
                                    <a class="dropdown-item" href="#">This Year</a>
                                    <a class="dropdown-item" href="#">Total</a>
                                </div>
                            </div>
                        </h6>
                        <p class="card-text" > Rs <?php echo number_format($TotalSales) ?></p>
                    </div>
                </div>
            </div>
        </a>

        <div class="col">
            <div class="card bg-light mb-3">
                <div class="card-header">To Receive:</div>
                <div class="card-body">

                    <p class="card-text" style="padding-top: 50px; color:red;">Rs <?php echo number_format($TotalSalesToReceive) ?></p>
                </div>
            </div>
        </div>

        <a href="purchase.php">
            <div class="col">
                <div class="card bg-light mb-3">
                    <div class="card-header">Purchase:</div>
                    <div class="card-body">
                        <h6 class="card-title">
                            <div class="dropdown">
                                <button class="btn dropdown-toggle" type="hidden" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Select
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">This Month</a>
                                    <a class="dropdown-item" href="#">This Year</a>
                                    <a class="dropdown-item" href="#">Total</a>
                                </div>
                            </div>
                        </h6>
                        <p class="card-text" style="color:black;"> Rs <?php echo number_format($TotalPurchase) ?></p>
                    </div>
                </div>
            </div>
        </a>

        <div class="col">
            <div class="card bg-light mb-3">
                <div class="card-header">Expenses:</div>
                <div class="card-body">
                    <h6 class="card-title">
                        <div class="dropdown">
                            <button class="btn dropdown-toggle" type="hidden" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Select
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">This Month</a>
                                <a class="dropdown-item" href="#">This Year</a>
                                <a class="dropdown-item" href="#">Total</a>
                            </div>
                        </div>
                    </h6>
                    <p class="card-text"> Rs <?php number_format(123456) ?></p>
                </div>
            </div>
        </div>






    </div>

    <div class="row" style="margin-top: 50px;">
        <div class="col-3">
            <div class="card bg-light mb-3">
                <div class="card-header">Stock Value:</div>
                <div class="card-body">

                    <p class="card-text" style="padding-top: 50px;">Rs <?php echo number_format(($TotalPurchase - $TotalSales)) ?></p>
                </div>
            </div>
        </div>

        <div class="col-3">
            <div class="card bg-light mb-3">
                <div class="card-header">Cash in Hand:</div>
                <div class="card-body">

                    <p class="card-text" style="padding-top: 50px;">Rs <?php echo number_format(($TotalSales - $TotalSalesToReceive)) ?></p>
                </div>
            </div>
        </div>


        <div class="card" style="width: 18rem;">
            <div class="card-header">
                Stock Left
            </div>
            <ul class="list-group list-group-flush">
                <?php
                $res = mysqli_query($con, "SELECT * FROM `purchase` WHERE 1 order by qty desc Limit 5");
                while ($row = mysqli_fetch_assoc($res)) {
                ?>
                    <li class="list-group-item" > <b style="color:red;"><?php echo $row['item']."  quantity left ".$row['qty']  ?></b> </li>
                <?php

                }
                ?>

            </ul>
        </div>




    </div>





</div>



<?php
require("footer.php")
?>