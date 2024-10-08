<?php include('head.php');?>
<?php
include 'db_connect.php';
$name = '';
$email = '';

$errormessage = '';
$successmessage = '';
$business =  $_SESSION['business_id'];


if(isset($_POST['addsupplier'])){

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    
    $address = mysqli_real_escape_string($conn,$_POST['address']);
    $email = $_POST['email'];
    $business =  $_SESSION['business_id'];
    $created_by = $_SESSION['login_id'];




$sql = "INSERT INTO suppliers(`name`, `phone`, `address`, `email`, `business_id`, `created_by`) VALUES ('$name', '$phone', '$address', '$email', '$business', '$created_by')";

$results = $conn->query($sql);
}

if(isset($_POST['editsupplier'])){

    $id = $_POST['id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = mysqli_real_escape_string($conn,$_POST['address']);
    $email = $_POST['email'];
    $business =  $_SESSION['business_id'];
    $updated_by = $_SESSION['login_id'];

$sql = "UPDATE suppliers SET `name` = '$name',`phone` = '$phone', `address` = '$address', `email` = '$email', `business_id`='$business', `updated_by`='$updated_by' where id = $id";

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
                            <h5 class="modal-title">Add Customer</h5>

                        </div>
                        <div class="modal-body">
                            <form method="POST">
                                <label class="form-label">Name<span class="required">*</span></label>
                                <div class="form-group">
                                    <input type="text" name="name" id="name" class="form-control" value="" required>
                                </div>


                                <label class="form-label">Email<span class=""></span></label>
                                <div class="form-group">
                                    <input type="email" name="email" id="email" class="form-control" value="">
                                </div>
                                <label class="form-label">Phone Number<span class="required">*</span></label>
                                <div class="form-group">
                                    <input type="phone" name="phone" id="phone" class="form-control" value="" required>
                                </div>
                                <label class="form-label">Address<span class=""></span></label>
                                <div class="form-group">
                                    <input type="text" name="address" id="address" class="form-control" value="">
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary btn-sm"
                                        name="addsupplier">Save</button>
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


        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Customers List</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <button class="btn btn-primary float-right btn-sm" data-toggle="modal"
                                data-target="#myaddmodal"><i class="fa fa-plus"></i>
                                Add
                                Customer</button>

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
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        <?php
                
                                            $suppliers = "SELECT * FROM suppliers  where is_active is true  and business_id = $business order by id desc";
                                            $results= $conn->query($suppliers);
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
                                                        class="btn btn-primary btn-sm">Edit</button>

                                                    <button type="button" name="" onclick="alertme(<?=$row['id']?>)"
                                                        class="btn btn-danger btn-sm">Delete</button>
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
                        <h5 class="modal-title">Edit Customer</h5>

                    </div>
                    <div class="modal-body">
                        <form method="POST">
                            <input type="hidden" name="id" id="edit_id" class="form-control" value="" required>

                            <label class="form-label">Name<span class="required">*</span></label>
                            <div class="form-group">
                                <input type="text" name="name" id="edit_name" class="form-control" value="" required>
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


                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-sm" name="editsupplier">Update</button>
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


    <!-- Custom Theme Scripts -->
    <script type="text/javascript">
    const openeditmodal = (id, name, email, phone, address) => {
        $('#myeditmodal').modal('show');
        document.getElementById('edit_id').value = id;
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_email').value = email;
        document.getElementById('edit_phone').value = phone;
        document.getElementById('edit_address').value = address;
        console.log(id, name, phone, address, email);
    };


    const alertme = (customerid) => {
        var customerid = customerid;
        Swal.fire({
            title: "Do you want to Delete this Customer?",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Delete",
            denyButtonText: `Don't Delete`
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "delete_customer.php?id=" + customerid;

                Swal.fire("Deleted!", "", "success");
            } else if (result.isDenied) {
                Swal.fire("Customer is not deleted", "", "info");
            }
        });
    }
    </script>


</body>

</html>
