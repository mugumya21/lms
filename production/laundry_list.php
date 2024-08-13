<?php include('head.php');?>

<?php
include 'db_connect.php';

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
    $business = $_POST['business'];
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
    $business = $_POST['business'];
    $updated_by = $_SESSION['login_id'];

$sql = "UPDATE users SET `name` = '$name',`phone` = '$phone', `address` = '$address', `username`  = '$username', `email` = '$email', `password` = '$password', `role_id`='$role', `business_id`='$business', `updated_by`='$updated_by' where id = $id";

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

            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Laundry List</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="laundry_add.php" class="btn btn-primary float-right btn-sm"><i
                                        class="fa fa-plus"></i>
                                    Add
                                    Laundry</a>

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
                                                <th>Status</th>
                                                <th>Amount</th>
                                                <th>Paid</th>
                                                <th>Balance</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>


                                        <tbody>
                                            <?php
                                                    include 'db_connect.php';
                
                                            $laundry_lists = "SELECT S.*, S.name as sname, St.*, St.name as stname,  L.paid , L.balance , L.total_quantity , L.total_amount FROM laundry_lists L INNER JOIN suppliers S ON L.supplier_id = S.id  INNER JOIN laundry_statuses St ON L.status = St.id" ;
                                            $results= $conn->query($laundry_lists);
                                            $i = 1;
                                            while($row= $results->fetch_assoc()):
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $i++ ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['sname'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['total_quantity'] ?>
                                                </td>
                                                <td>


                                                    <?php  if($row['stname'] =="incoming"):
                                                    
                                                    echo '<h5 class="badge bg-danger text-white"> '.$row['stname'].'    </h5> '?>
                                                    <?php elseif($row['stname'] =="ongoing"): 

                                                    echo '<h5 class="badge bg-primary text-white"> '.$row['stname'].'    </h5> '?>


                                                    <?php elseif($row['stname'] =="ready"):
                                                    echo '<h5 class="badge bg-danger text-white"> '.$row['stname'].'    </h5> '?>

                                                    <?php else:
                                                    
                                                    echo '<h5 class="badge bg-warning text-white"> '.$row['stname'].'    </h5> '?>


                                                    <?php endif?>

                                                </td>
                                                <td>
                                                    <?php echo $row['total_amount'] ?>
                                                </td>

                                                <td>
                                                    <?php echo $row['paid'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['balance'] ?>
                                                </td>


                                                <td>

                                                    <?php if($row['paid'] > 0):
                                                    
                                               
                                                    echo ' <a href="generate_receipt.php" type="submit" name="" class="btn-sm  btn btn-primary">
                                                        Receipt</a>'?>
                                                    <?php else:
                                                          echo ' <a  href="generate_invoice.php" type="submit" name="" class=" btn-sm btn btn-primary">
                                                        Invoice</a>'  
                                                        ?>

                                                    <?php endif?>

                                                    <button type="submit" name="edituser"
                                                        class="btn btn-primary btn-sm">Edit</button>

                                                    <button type="button" name=""
                                                        class="btn btn-danger btn-sm">Delete</button>

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
