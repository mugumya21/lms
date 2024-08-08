<?php 
session_start();
include 'db_connect.php';

if(isset($_GET['id'])){
    $_SESSION['login_id'] = $_SESSION[''];
    $_SESSION['login_name'] = $_SESSION[''];
    $_SESSION['login_role']  = $_SESSION[''];

    header('location:login.php');

exit;


}

$conn->close();

?>
