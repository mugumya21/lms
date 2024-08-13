<?php 
include("db_connect.php");
session_start();
if(isset($_GET['id'])){

   

    $_SESSION['login_id'] = $_SESSION[''];
    $_SESSION['login_name'] = $_SESSION[''];
    $_SESSION['login_role']  = $_SESSION[''];
    $_SESSION['business_id']  = $_SESSION[''];

    header('location:login.php');
    

  

exit;


}

$conn->close();

?>