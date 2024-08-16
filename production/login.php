<?php
     include("db_connect.php");
   session_start();
   $error='';
   if(isset($_POST["loginuser"])== "POST") {
   
      $email = $_POST['email'];
      $password = mysqli_real_escape_string($conn,$_POST['password']); 
      
      $getuser = $conn->query("SELECT * , 
      (SELECT name FROM businesses  where business.business_id = users.business_id) as business_name 
       FROM users WHERE email = '$email'");
      $row = $getuser->fetch_assoc();
       $hashedpassword= $row['password'];
      if(password_verify($password, $hashedpassword)){
    
        $_SESSION['login_id'] = $row['user_id'];
        $_SESSION['business_id']  = $row['business_id'];
        die($_SESSION['business_name']  = $row['business_name'] 
) ;
         header("location:index.php");

        }
    
      }   

   else {
         $error = "Your Login Name or Password is invalid";
      }


   


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>LMS</title>
    <?php include('links.php')?>
</head>

<body class="login">
    <div>


        <div class="login_wrapper">
            <div class="  login_form">
                <section class="login_content">
                    <form method="POST">


                        <img src="images/logo2.png" alt="..." class=" profile_img" />
                        <h2 class="">Login</h2>

                        <div>
                            <input type="email" class="form-control" name="email" placeholder="email" required />
                        </div>
                        <div>
                            <input type="password" class="form-control" name="password" placeholder="Password"
                                required />
                        </div>
                        <div>
                            <button name="loginuser" type="submit" class=" btn btn-small btn-primary submit">Log
                                in</button>

                            <!-- <a class="reset_pass" href="#">Lost your password?</a> -->

                        </div>

                        <div class="clearfix"></div>

                        <div class="separator">
                            <!-- <p class="change_link">New to site?
                                <a href="#signup" class="to_register"> Create Account </a>
                            </p> -->

                            <div class="clearfix"></div>
                            <br />


                            <div>
                                <?php 
                                $year = new DateTime();
                                $formatedyear = $year->format('Y');
                                ?>
                                <p>©<?=$formatedyear?> All Rights Reserved. Mugumya Vicent</p>
                            </div>
                        </div>
                    </form>
                </section>
            </div>


        </div>
    </div>
</body>

</html>