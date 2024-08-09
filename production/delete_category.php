<?php include('db_connect.php');
session_start();
if(isset($_GET['id'])){

    $id = $_GET['id'];
    $name = mysqli_fetch_array(mysqli_query($conn, "SELECT name FROM laundry_categories where id = $id"))['name'];
    $done_by = $_SESSION['login_id'];
    $action = $_SESSION['login_name']. " deleted a laundry category $name";

    $logsql = "INSERT INTO `activity_logs` (`user_id`, `url`, `action`) VALUES
    ( $done_by, 'http://localhost/lms/production/category_list.php', '$action')";
    $logresults = $conn->query($logsql);

    // $setstatus = "UPDATE laundry_categories "
 

    header('location:category_list.php');

    exit;

}
$conn->close();
?>