<?php include('db_connect.php');
session_start();
if(isset($_GET['id'])){

    $id = $_GET['id'];
    

    $status = $conn->query("UPDATE suppliers SET is_active = 0 where id = $id");
 
    if(  $status){
    header('location:supplier_list.php');

    exit;
    }

}
$conn->close();
?>
