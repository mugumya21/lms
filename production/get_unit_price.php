<?php include('db_connect.php');
session_start();
if(isset($_POST['id'])){

    $id = $_POST['id'];
    

    $unitprice = mysqli_fetch_array(mysqli_query( $conn, "SELECT unit_price FROM laundry_categories where id = $id"))['unit_price'];
 
    if(  $unitprice){
        echo  $unitprice;
    }

}
?>
