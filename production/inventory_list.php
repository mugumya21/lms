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
    $address = $_POST['address'];
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
    $address = $_POST['address'];
    $email = $_POST['email'];
    $business =  $_SESSION['business_id'];
    $updated_by = $_SESSION['login_id'];

$sql = "UPDATE suppliers SET `name` = '$name',`phone` = '$phone', `address` = '$address', `email` = '$email', `business_id`='$business', `updated_by`='$updated_by' where id = $id";

$results = $conn->query($sql);
}                      





?>
<?php
    $laundry_lists = "SELECT S.*, S.name as sname ,  L.total_quantity as quantity FROM laundry_lists L  INNER JOIN suppliers S on L.supplier_id = S.id where status != 4";
    $results= $conn->query($laundry_lists);
    $i = 1;
    $total_inventory = 0;

    while($row= $results->fetch_assoc()):
        $total_inventory += $row['quantity'];
    ?>

<?php endwhile ?>


<body class="nav-md">
    <div class="container body">
        <div class="main_container">

            <?php include('topcontent.php');?>


            <!-- page content -->
            <?php include('globalsearch.php');?>



        </div>


        <div class="col-md-8 col-sm-8">
            <div class="x_panel">
                <div class="x_title">
                    <h2> Total Laundry in Stock: <span class="text-danger"> <?=$total_inventory?></span>
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a class="btn btn-primary float-right btn-sm" href="laundry_list.php">

                                Laundry List </a>

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
                                            <th>Customer</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        <?php                         
                                            $laundry_lists = "SELECT S.*, S.name as sname ,  L.total_quantity as quantity FROM laundry_lists L  INNER JOIN suppliers S on L.supplier_id = S.id where status != 4";
                                            $results= $conn->query($laundry_lists);
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
                                                <?php echo $row['quantity'] ?>
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
