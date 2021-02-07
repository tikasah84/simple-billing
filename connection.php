<?php 
session_start();
$con = mysqli_connect("localhost","root","","vyapar");
if($con){
    echo "";
}else{
    echo "Database failed to connect";
}
define('SITE_PATH','http://localhost/vyapar/');
;

?>