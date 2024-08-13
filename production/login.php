<?php
     include("db_connect.php");
   session_start();
   $error='';
   if($_SERVER["REQUEST_METHOD"] == "POST") {
   
      $username =$_POST['username'];
      $password = $_POST['password']; 

      $sql = "SELECT * FROM users WHERE username = '$username' and password = '$password'";

      $result = $conn->query($sql);      

      if( $row=  $result->fetch_assoc()) {
	  
        $_SESSION['login_id'] = $row['id'];
        $_SESSION['login_role']  = $row['role_id'];
        $_SESSION['login_username']  = $row['username'];
        $_SESSION['login_name']  = $row['name'];

        $_SESSION['business_id']  = $row['business_id']; 
         header("location:index.php");
      } else {
         $error = "Your Login Name or Password is invalid";
      }


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
                        <h2 class="text-primary">Laundry Management System</h2>
                        <div>
                            <input type="text" class="form-control" name="username" placeholder="Username"
                                required="" />
                        </div>
                        <div>
                            <input type="password" class="form-control" name="password" placeholder="Password"
                                required="" />
                        </div>
                        <div>
                            <center> <button type="submit" class=" btn btn-small btn-primary submit">Log in</button>
                            </center>
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

            <div id="register" class="animate form registration_form">
                <section class="login_content">
                    <form>
                        <h1>Create Account</h1>
                        <div>
                            <input type="text" class="form-control" placeholder="Username" required="" />
                        </div>
                        <div>
                            <input type="email" class="form-control" placeholder="Email" required="" />
                        </div>
                        <div>
                            <input type="password" class="form-control" placeholder="Password" required="" />
                        </div>
                        <div>
                            <a class="btn btn-default submit" href="index.html">Submit</a>
                        </div>

                        <div class="clearfix"></div>

                        <div class="separator">
                            <p class="change_link">Already a member ?
                                <a href="#signin" class="to_register"> Log in </a>
                            </p>

                            <div class="clearfix"></div>
                            <br />

                            <div>
                                <p>©2016 All Rights Reserved. Mugumya Vicent</p>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</body>

</html>
