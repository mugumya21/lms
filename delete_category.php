<?php include('db_connect.php');

if(isset($_GET['id'])){

    $id = $_GET['id'];
    $sql = "DELETE FROM laundry_categories where id = $id";

    $delete = $conn->query($sql);
    if($delete){
        header('location:index.php?page=categories');

    }

}
?>
