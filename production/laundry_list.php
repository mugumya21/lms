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
                
                                            $laundry_lists = "SELECT S.*, S.name as sname, St.*, St.name as stname,  L.paid , L.total_quantity , L.total_amount, L.id as lid FROM laundry_lists L INNER JOIN suppliers S ON L.supplier_id = S.id  INNER JOIN laundry_statuses St ON L.status = St.id" ;
                                            $results= $conn->query($laundry_lists);
                                            $i = 1;
                                            while($row= $results->fetch_assoc()):
                                                $balance =$row['total_amount'] - $row['paid'];
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
                                                    <?=number_format( $row['total_amount']) ?>
                                                </td>

                                                <td>
                                                    <?=number_format(  $row['paid']) ?>
                                                </td>
                                                <td>
                                                    <?=number_format( $row['total_amount'] - $row['paid']) ?>
                                                </td>


                                                <td>

                                                    <?php if($row['paid'] == 0):
                                                    
                                        
                                                  ?>
                                                    <button type="button" name=""
                                                        onclick="generateinvoice(<?=$row['lid']?>)"
                                                        class="btn btn-secondary btn-sm">Invoice</button>
                                                    <button type="submit" name="makepayment"
                                                        class="btn btn-primary btn-sm">Pay</button>
                                                    <?php elseif($row['paid'] > 0 && $balance > 0): 
                                                       
                                                         ?>
                                                    <button type="button" name=""
                                                        onclick="generatereceipt(<?=$row['lid']?>)"
                                                        class="btn btn-danger btn-sm">Receipt</button>
                                                    <button type="submit" name="makepayment"
                                                        class="btn btn-primary btn-sm">Pay</button>
                                                    <?php else:
                                                        ?>
                                                    <button type="button" name=""
                                                        onclick="generatereceipt(<?=$row['lid']?>)"
                                                        class="btn btn-danger btn-sm">Receipt</button>

                                                    <?php endif?>

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
    <?php include('scripts.php')?>


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


    const generatereceipt = (id) => {
        var id = id;
        Swal.fire({
            title: "Do you want to Generate a Receipt?",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Generate",
            denyButtonText: `Don't Generate`
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "generate_receipt.php?id=" + id;

                Swal.fire("Generated!", "", "success");
            } else if (result.isDenied) {
                Swal.fire("Receipt is not Generated", "", "info");
            }
        });
    }

    const generateinvoice = (id) => {
        var id = id;
        Swal.fire({
            title: "Do you want to Generate a Invoice?",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Generate",
            denyButtonText: `Don't Generate`
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "generate_invoice.php?id=" + id;

                Swal.fire("Generated!", "", "success");
            } else if (result.isDenied) {
                Swal.fire("Invoice is not Generated", "", "info");
            }
        });
    }
    </script>


</body>

</html>
