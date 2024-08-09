<?php include('db_connect.php');

if(isset($_GET['id'])){

    $id = $_GET['id'];
    $sql = "DELETE FROM businesses where id = $id";

    $delete = $conn->query($sql);
    if($delete){
   
        $done_by = $_SESSION['login_id'];
        $logsql = "INSERT INTO `activity_logs` (`user_id`, `url`, `action`) VALUES
        ( $done_by 'http://localhost/lms/production/business_list.php', 'deleted business successfully')";
        $logresults = $conn->query($logsql);



        header('location:business_list.php');

    }

}
?>
