<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Admin | Laundry Management System</title>


    <?php include('./header.php'); ?>
    <?php
     include("db_connect.php");
   session_start();
   $error='';
   if($_SERVER["REQUEST_METHOD"] == "POST") {
   
      $username =$_POST['username'];
      $mypassword = $_POST['password']; 

      $sql = "SELECT * FROM users WHERE username = '$username' and password = '$mypassword'";

      $result = $conn->query($sql);      

      if( $row=  $result->fetch_assoc()) {
	  
        $_SESSION['login_id'] = $row['id'];
        $_SESSION['login_type']  = $row['type'];
        $_SESSION['login_name']  = $row['username'];
         header("location:index.php");
      } else {
         $error = "Your Login Name or Password is invalid";
      }
   }


?>

</head>
<style>
body {
    width: 100%;
    height: calc(100%);
    /*background: #007bff;*/
}

main#main {
    width: 100%;
    height: calc(100%);
    background: white;
}

#login-right {
    position: absolute;
    right: 0;
    width: 40%;
    height: calc(100%);
    background: white;
    display: flex;
    align-items: center;
}

#login-left {
    position: absolute;
    left: 0;
    width: 60%;
    height: calc(100%);
    background: #59b6ec61;
    display: flex;
    align-items: center;
}

#login-right .card {
    margin: auto
}

.logo {
    margin: auto;
    font-size: 8rem;
    background: white;
    padding: .5em 0.7em;
    border-radius: 50% 50%;
    color: #000000b3;
}
</style>

<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4">
                <main id="main" class=" ">

                    <div>
                        <div class="w-100">
                            <br>
                            <br>
                            <h4 class="text-primary">
                                <center><b>Laundry Management System</b></center>
                            </h4>
                            <br>
                            <br>
                            <center> <img src="assets/img/logo3.png" alt="..." width="30%">
                            </center>
                            <div class="card ">
                                <div class="card-body">
                                    <form action="" method='POST'>
                                        <div class="form-group">
                                            <label for="username" class="control-label">Username</label>
                                            <input type="text" id="username" name="username" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="password" class="control-label">Password</label>
                                            <input type="password" id="password" name="password" class="form-control">
                                        </div>
                                        <center><button
                                                class="btn-sm btn-block btn-wave col-md-4 btn-primary">Login</button>
                                        </center>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                </main>

                <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
            </div>
            <div class="col-4"></div>
        </div>
    </div>


</body>
<script>

</script>

</html>
