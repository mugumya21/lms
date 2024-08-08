<?php include('db_connect.php');

if(isset($_GET['id'])){

    $id = $_GET['id'];
    $sql = "DELETE FROM suppliers where id = $id";

    $delete = $conn->query($sql);
    if($delete){
        header('location:index.php?page=supplier');

    }

}
?>
