<?php include('db_connect.php');
session_start();
if(isset($_GET['id'])){

    $id = $_GET['id'];
    

    $deletefromcart = $conn->query("DELETE FROM cart where id = $id");
 
    if(  $deletefromcart){
    header('location:laundry_add.php');

    exit;
    }

}
$conn->close();
?>
