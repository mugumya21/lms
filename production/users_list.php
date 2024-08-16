<?php include('head.php');?>

<?php
include 'db_connect.php';
$name = '';
$email = '';

$errormessage = '';
$usernameexists  = '';
$successmessage = '';
$business = $_SESSION['business_id'];


if(isset($_POST['addemployee'])){

    $name = $_POST['full_name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $business = $_SESSION['business_id'];
    $created_by = $_SESSION['login_id'];
    $checkemail = mysqli_query($conn, "SELECT * FROM users where email = '$email'");
    if(mysqli_num_rows($checkemail) > 0){
       echo ' <script>
        alert("This  ' . $email. ' exists in the database, use another email");    history.go(-1);;
        </script>';
    }else{

    $employeesql =mysqli_query($conn, "INSERT INTO employees(`full_name`, `phone`, `address`, `created_by`) VALUES ('$name', '$phone', '$address',  '$created_by')");
    $getemployeeid = mysqli_insert_id($conn);

    $password = $_POST['password'];
    $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
    
    $usersql = mysqli_query($conn,  "INSERT INTO users(`email`, `password`, `employee_id`, `business_id`) VALUES ('$email', '$hashedpassword', '$getemployeeid', '$business')");
    }



}

if(isset($_POST['edituser'])){

    $id = $_POST['id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
    $role = $_POST['role'];
    $business = $_SESSION['business_id'];
    $updated_by = $_SESSION['login_id'];

$sql = "UPDATE users SET `name` = '$name',`phone` = '$phone', `address` = '$address', `username`  = '$username', `email` = '$email', `password` = '$hashedpassword', `role_id`='$role', `business_id`='$business', `updated_by`='$updated_by' where id = $id";

$results = $conn->query($sql);
}


?>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">

            <?php include('topcontent.php');?>


            <!-- page content -->
            <?php include('globalsearch.php');?>

            <!-- add user modal -->

            <div class="modal" id="myaddmodal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add User</h5>

                        </div>
                        <div class="modal-body">
                            <form method="POST">
                                <label class="form-label">Name<span class="required">*</span></label>
                                <div class="form-group">
                                    <input type="text" name="full_name" id="name" class="form-control" value=""
                                        required>
                                </div>


                                <label class="form-label">Email<span class="required">*</span></label>
                                <div class="form-group">
                                    <input type="email" name="email" id="email" class="form-control" value="" required>
                                </div>
                                <label class="form-label">Phone Number<span class="required">*</span></label>
                                <div class="form-group">
                                    <input type="phone" name="phone" id="phone" class="form-control" value="" required>
                                </div>
                                <label class="form-label">Address<span class="required">*</span></label>
                                <div class="form-group">
                                    <input type="text" name="address" id="address" class="form-control" value=""
                                        required>
                                </div>
                                <label class="form-label">Password<span class="required">*</span></label>
                                <div class="form-group">
                                    <input type="password" name="password" id="password" class="form-control" value=""
                                        required>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary btn-sm"
                                        name="addemployee">Save</button>
                                    <button type="button" class="btn btn-secondary btn-sm"
                                        data-dismiss="modal">Close</button>

                                </div>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- end add modal-->

        <?php if($usernameexists):
                        echo '    <div class="alert alert-dismissible alert-danger ">
                        <strong>      '.$usernameexists.'  </strong>
                            <button type="button" class=" btn-close float-right" data-bs-dismiss="alert"></button>
                            
                        </div>'
                            
                            ?>

        <?php endif?>
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Users List</h2>

                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <button class="btn btn-primary float-right btn-sm" data-toggle="modal"
                                data-target="#myaddmodal"><i class="fa fa-plus"></i>
                                Add
                                User</button>

                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">

                                <table id="datatable-buttons" class="table table-striped table-bordered"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Contact</th>
                                            <th>Address</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        <?php
 					$users = $conn->query("SELECT users.*,
                              
                                employees.*
                                FROM users, employees where employees.employee_id = users.employee_id and users.business_id = $business");
 					$i = 1;
 					while($row= $users->fetch_assoc()):
				 ?>
                                        <tr>
                                            <td>
                                                <?php echo $i++ ?>
                                            </td>
                                            <td>
                                                <?php echo $row['full_name'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['email'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['phone'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['address'] ?>
                                            </td>

                                            <td>
                                                <center> <button type="submit" name="editbusiness"
                                                        onclick="openeditmodal()" class="btn btn-primary">Edit</button>

                                                    <button type="button" name=""
                                                        onclick="alertme(<?=$row['user_id']?>)"
                                                        class="btn btn-danger">Delete</button>
                                                </center>

                                            </td>
                                        </tr>
                                        <?php endwhile?>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of my data table-->
        <!-- edit user modal -->

        <div class="modal" id="myeditmodal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit User</h5>

                    </div>
                    <div class="modal-body">
                        <form method="POST">
                            <input type="hidden" name="id" id="edit_id" class="form-control" value="" required>

                            <label class="form-label">Name<span class="required">*</span></label>
                            <div class="form-group">
                                <input type="text" name="name" id="edit_name" class="form-control" value="" required>
                            </div>

                            <label class="form-label">Username<span class="required">*</span></label>
                            <div class="form-group">
                                <input type="text" name="username" id="edit_username" class="form-control" value=""
                                    required>
                            </div>

                            <label class="form-label">Email<span class="required">*</span></label>
                            <div class="form-group">
                                <input type="email" name="email" id="edit_email" class="form-control" value="" required>
                            </div>
                            <label class="form-label">Phone Number<span class="required">*</span></label>
                            <div class="form-group">
                                <input type="text" name="phone" id="edit_phone" class="form-control" value="" required>
                            </div>
                            <label class="form-label">Address<span class="required">*</span></label>
                            <div class="form-group">
                                <input type="text" name="address" id="edit_address" class="form-control" value=""
                                    required>
                            </div>
                            <label class="form-label">Password<span class="required">*</span></label>
                            <div class="form-group">
                                <input type="password" name="password" id="edit_password" class="form-control" value=""
                                    required>
                            </div>


                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-sm" name="edituser">Update</button>
                                <button type="button" class="btn btn-secondary btn-sm"
                                    data-dismiss="modal">Close</button>

                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- end add modal-->




    <!-- /page content -->

    <!-- footer content -->
    <?php include('footer.php')?>

    <!-- /footer content -->
    </div>
    </div>

    <?php include('scripts.php')?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js">
    </script>

    <!-- Custom Theme Scripts -->
    <script type="text/javascript">
    const openeditmodal = (id, name, username, email, phone, address, password) => {
        $('#myeditmodal').modal('show');
        document.getElementById('edit_id').value = id;
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_username').value = username;
        document.getElementById('edit_email').value = email;

        document.getElementById('edit_phone').value = phone;
        document.getElementById('edit_address').value = address;
        document.getElementById('edit_password').value = password;
        console.log(id, name, username, email, phone, address, password);
    };


    const alertme = (businessid) => {
        var businessid = businessid;
        Swal.fire({
            title: "Do you want to Delete this User?",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Delete",
            denyButtonText: `Don't Delete`
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "delete_user.php?id=" + businessid;

                Swal.fire("Deleted!", "", "success");
            } else if (result.isDenied) {
                Swal.fire("User is not deleted", "", "info");
            }
        });
    }
    </script>


</body>

</html>
