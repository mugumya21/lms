<?php
include 'db_connect.php';
session_start();
$name = '';
$email = '';

$errormessage = '';
$successmessage = '';


if(isset($_POST['adduser'])){

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $business = $_SESSION['business_id'];
    $created_by = $_SESSION['login_id'];



    
$sql = "INSERT INTO users(`name`, `phone`, `address`, `username`, `email`, `password`, `role_id`, `business_id`, `created_by`) VALUES ('$name', '$phone', '$address', '$username', '$email', '$password', '$role', '$business', '$created_by')";

$results = $conn->query($sql);
}

if(isset($_POST['edituser'])){

    $id = $_POST['id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $business = $_SESSION['business_id'];
    $updated_by = $_SESSION['login_id'];

$sql = "UPDATE users SET `name` = '$name',`phone` = '$phone', `address` = '$address', `username`  = '$username', `email` = '$email', `password` = '$password', `role_id`='$role', `business_id`='$business', `updated_by`='$updated_by' where id = $id";

$results = $conn->query($sql);
}

$conn->close();


?>

<?php include('head.php');?>


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
                                    <input type="text" name="name" id="name" class="form-control" value="" required>
                                </div>
                                <label class="form-label">Username<span class="required">*</span></label>
                                <div class="form-group">
                                    <input type="text" name="username" id="username" class="form-control" value=""
                                        required>
                                </div>
                                <label class="form-label">Role<span class="required">*</span></label>
                                <select class="form-control custom-select" name="role" id="role"
                                    style="width: 100%; padding: 2px; font-size: 16px; border-radius: 5px;">
                                    <?php 
                                            include 'db_connect.php';

                                                $sql = "SELECT * FROM roles";
                                                $results = $conn->query($sql);
                                                while ($rolerow = $results->fetch_assoc()) {
                                                    echo '<option value="'.$rolerow['id'].'">'.$rolerow['name'].'</option>';
                                                        }
                                                    ?>
                                </select>

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
                                    <button type="submit" class="btn btn-primary" name="adduser">Save</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                </div>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- end add modal-->


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
                                        include 'db_connect.php';
                                            $users = "SELECT U.*,  R.name as rname, R.id as rid FROM users U INNER JOIN roles R 
                                            ON U.role_id = R.id order by U.id desc";
                
                                            $results= $conn->query($users);
                                            $i = 1;
                                            while($row= $results->fetch_assoc()):
                                            ?>
                                        <tr>
                                            <td>
                                                <?php echo $i++ ?>
                                            </td>
                                            <td>
                                                <?php echo $row['name'] ?>
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
                                                <center> <button type="submit" name="edituser"
                                                        onclick="openeditmodal(<?=$row['id']?>,'<?=$row['name']?>','<?=$row['email']?>', '<?=$row['phone'] ?>', '<?=$row['address'] ?>')"
                                                        class="btn btn-primary">Edit</button>

                                                    <button type="button" name="" onclick="alertme(<?=$row['id']?>)"
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
                            <label class="form-label">Role<span class="required">*</span></label>
                            <select class="form-control custom-select" name="role" id="role"
                                style="width: 100%; padding: 2px; font-size: 16px; border-radius: 5px;">
                                <?php 
                                            include 'db_connect.php';

                                                $sql = "SELECT * FROM roles";
                                                $results = $conn->query($sql);
                                                while ($rolerow = $results->fetch_assoc()) {
                                                    echo '<option value="'.$rolerow['id'].'">'.$rolerow['name'].'</option>';
                                                        }
                                                    ?>
                            </select>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" name="edituser">Update</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

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

    <!-- jQuery -->
    <script src="../assets/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="../assets/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../assets/vendors/nprogress/nprogress.js"></script>
    <!-- iCheck -->
    <script src="../assets/vendors/iCheck/icheck.min.js"></script>
    <!-- Datatables -->
    <script src="../assets/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../assets/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../assets/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../assets/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../assets/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../assets/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../assets/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../assets/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../assets/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../assets/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../assets/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../assets/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="../assets/vendors/jszip/dist/jszip.min.js"></script>
    <script src="../assets/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../assets/vendors/pdfmake/build/vfs_fonts.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../assets/build/js/custom.min.js"></script>

    <!-- Custom Theme Scripts -->
    <script type="text/javascript">
    const openeditmodal = (id, name, username, phone, address, email, password) => {
        $('#myeditmodal').modal('show');
        document.getElementById('edit_id').value = id;
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_username').value = username;
        document.getElementById('edit_email').value = email;

        document.getElementById('edit_phone').value = phone;
        document.getElementById('edit_address').value = address;
        document.getElementById('edit_password').value = password;
        console.log(id, name, phone, address, email, password);
    };


    const alertme = (businessid) => {
        var businessid = businessid;
        Swal.fire({
            title: "Do you want to Delete this Business?",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Delete",
            denyButtonText: `Don't Delete`
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "delete_business.php?id=" + businessid;

                Swal.fire("Deleted!", "", "success");
            } else if (result.isDenied) {
                Swal.fire("Business is not deleted", "", "info");
            }
        });
    }
    </script>


</body>

</html>