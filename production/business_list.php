<?php
session_start();
include 'db_connect.php';
$name = '';
$email = '';

$errormessage = '';
$successmessage = '';


if(isset($_POST['addbusiness'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $created_by = $_SESSION['login_id'];
    $updated_by = $_SESSION['login_id'];



    
$sql = "INSERT INTO businesses(`name`, `email`, `phone`, `address`, `created_by`, `updated_by`) VALUES ('$name', '$email', '$phone', '$address','$created_by' ,'$updated_by' )";

$results = $conn->query($sql);
}

if(isset($_POST['editbusiness'])){

    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $updated_by = $_SESSION['login_id'];

$sql = "UPDATE businesses SET `name` = '$name',`email` = '$email', `phone` = '$phone', `address`  = '$address',`updated_by`  = '$updated_by'  where id = $id";

$results = $conn->query($sql);
}

$conn->close();


?>
<?php include('head.php');?>


<body class="nav-md">
    <div class="container body">
        <div class="main_container">

            <?php include('topcontent.php');?>

            <!-- top navigation -->
            <?php include('topnavbar.php');?>

            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3> <small></small></h3>
                        </div>

                        <div class="title_right">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search for...">
                                    <span class="input-group-btn">
                                        <button class="btn btn-secondary" type="button">Go!</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <!-- add user modal -->

                    <div class="modal" id="myaddmodal">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Business</h5>

                                </div>
                                <div class="modal-body">
                                    <form method="POST">
                                        <label class="form-label">Name<span class="required">*</span></label>
                                        <div class="form-group">
                                            <input type="text" name="name" id="name" class="form-control" value="">
                                        </div>

                                        <label class="form-label">Email<span class="required">*</span></label>
                                        <div class="form-group">
                                            <input type="email" name="email" id="email" class="form-control" value="">
                                        </div>
                                        <label class="form-label">Phone Number<span class="required">*</span></label>
                                        <div class="form-group">
                                            <input type="phone" name="phone" id="phone" class="form-control" value="">
                                        </div>
                                        <label class="form-label">Address<span class="required">*</span></label>
                                        <div class="form-group">
                                            <input type="text" name="address" id="address" class="form-control"
                                                value="">
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary"
                                                name="addbusiness">Save</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>

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
                            <h2>Businesses List</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li class="dropdown">
                                    <button class="btn btn-primary float-right btn-sm" data-toggle="modal"
                                        data-target="#myaddmodal"><i class="fa fa-plus"></i>
                                        Add
                                        Business</button>

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
 					$businesses = $conn->query("SELECT * FROM businesses order by name asc");
 					$i = 1;
 					while($row= $businesses->fetch_assoc()):
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
                                                        <center> <button type="submit" name="editbusiness"
                                                                onclick="openeditmodal(<?=$row['id']?>,'<?=$row['name']?>', '<?=$row['phone'] ?>', '<?=$row['address'] ?>',  '<?=$row['email'] ?>')"
                                                                class="btn btn-primary">Edit</button>

                                                            <a type="submit" name=""
                                                                href="delete_user.php?id=<?php echo $row['id'] ?>"
                                                                class="btn btn-danger">Delete</a>
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
                                <h5 class="modal-title">Edit Business</h5>

                            </div>
                            <div class="modal-body">
                                <form method="POST">
                                    <input type="hidden" name="id" id="edit_id" class="form-control" value="">

                                    <label class="form-label">Name<span class="required">*</span></label>
                                    <div class="form-group">
                                        <input type="text" name="name" id="edit_name" class="form-control" value="">
                                    </div>

                                    <label class="form-label">Email<span class="required">*</span></label>
                                    <div class="form-group">
                                        <input type="email" name="email" id="edit_email" class="form-control" value="">
                                    </div>
                                    <label class="form-label">Phone Number<span class="required">*</span></label>
                                    <div class="form-group">
                                        <input type="text" name="phone" id="edit_phone" class="form-control" value="">
                                    </div>
                                    <label class="form-label">Address<span class="required">*</span></label>
                                    <div class="form-group">
                                        <input type="text" name="address" id="edit_address" class="form-control"
                                            value="">
                                    </div>


                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary"
                                            name="editbusiness">Update</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>

                                    </div>
                                </form>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- end add modal-->




        </div>
    </div>
    </div>
    <!-- /page content -->

    <!-- footer content -->
    <?php include('footer.php')?>

    <!-- /footer content -->
    </div>
    </div>

    <?php include('scripts.php')?>

    <!-- Custom Theme Scripts -->
    <script type="text/javascript">
    const openeditmodal = (id, name, phone, address, email) => {
        $('#myeditmodal').modal('show');
        document.getElementById('edit_id').value = id;
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_phone').value = phone;
        document.getElementById('edit_address').value = address;
        document.getElementById('edit_email').value = email;
        console.log(id, name, phone, address, email);
    };
    </script>


</body>

</html>
