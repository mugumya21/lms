<?php
     include("db_connect.php");
   session_start();
   if(!isset($_SESSION['login_id'])){
    
    header('location:login.php');

    exit;
   }
   ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>Laundry Management System</title>
    <?php include('links.php');?>

</head>
<?php
    echo '
<script>
function addCommas(x) {
//remove commas
retVal = x ? parseFloat(x.replace(/,/g, \'\')) : 0;
//apply formatting
return retVal.toString().replace(/\\B(?=(\\d{3})+(?!\\d))/g, ",");
}
</script>';
    ?>