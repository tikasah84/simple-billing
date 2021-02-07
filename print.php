<?php
include('header.php');
$netTotal=0;
$customer='';


if(isset($_GET['type']) && $_GET['type']!=''){
    
    $customer = get_safe_value($con,$_GET['type']);
  
}



$html = '<div class="content pb-0">
<div class="orders">
    <div class="row">
        <div class="col-xl-12">
            <div class="car">
                <div class="card-body">
                    <h4  style="
                        display: inline-block;
                         margin-bottom: .5rem;
                         font-family: "Lohit Devanagari" !important;
                    ">'.$customer.' Sales Details </h4>

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
                            <tbody>';


                
                $res=mysqli_query($con,"SELECT * FROM `sales` WHERE customer='$customer' ");
            
                
                while($row=mysqli_fetch_assoc($res)){
                   // print_r($row);
                   $netTotal = $row['total'] +$netTotal ;

                      $html.=' <tr>



                                    <th>'.$row['id'].'</th>
                                    <th>'.$row['category'].'</th>
                                    <th>'.$row['item'].'</th>
                                    <th>'.$row['item_code'].'</th>
                                    <th>'.$row['qty'].'</th>

                                    <th>'.$row['price_unit'].'</th>
                                    <th>'.$row['dis_per'].'</th>
                                    <th>'.$row['dis_amt'].'</th>
                                    <th>'.$row['tax'].'</th>
                                    <th>'.$row['tax_amt'].'</th>
                                    <th>'.$row['total'].'</th>
                                     
                                   


                                </tr>';

                }


 $html.='
  <tr>



                                    <th colspan="10"></th>
                                    
                                    <th>NetTotal '.$netTotal.'</th>
                                     
                                   


                                </tr>
 
 </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
</div>
</div>';

$css=file_get_contents('assets/css/style.css');

include('vendor/autoload.php');
$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($css,1);
$mpdf->WriteHTML($html,2);
$mpdf->Output($customer.'.pdf','F');


?>