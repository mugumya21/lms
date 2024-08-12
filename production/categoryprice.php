<?php include('db_connect.php');


    $categoryid = $_POST['id'];
    $sql = "SELECT unit_price FROM  laundry_categories where id = $categoryid";

    $results = $conn->query($sql);
  
      if ($result) {
        $row = $result->fetch_assoc();
        echo $row['unit_price']; 
    } else {
        echo 0;
    }


?>
