<?php
include 'db_connect.php';

session_start();
$name = '';
$email = '';

$errormessage = '';
$successmessage = '';
$businessid = $_SESSION['business_id'];


if(isset($_POST['addlaundrylist'])){

    $supplier = $_POST['supplier'];
    $category = $_POST['category'];
    $status = $_POST['status'];
    $quantity = $_POST['quantity'];
    $amount = $_POST['amount'];
    $payment_type  = $_POST['payment_type'];

    $paid = $_POST['paid'];
    if($paid == ''){
        $paid = 0;
    }
    $balance = $amount - $paid;
    $comments = $_POST['comments'];
    $business = $_SESSION['business_id'];
    $created_by = $_SESSION['login_id'];


    
$sql = "INSERT INTO laundry_lists(`supplier_id`, `category_id`, `status`, `quantity`, `amount`, `payment_type`, `paid`, `balance`, `comments`, `business_id`, `created_by`) VALUES ('$supplier', '$category', '$status', '$quantity', '$amount', '$payment_type', '$paid','$balance', '$comments', '$business', '$created_by')";

$results = $conn->query($sql);

if($results){
    
    header('location:laundry_list.php');
}

}

if(isset($_POST['editlaundrylist'])){

    $id = $_POST['id'];
    $supplier = $_POST['supplier'];
    $category = $_POST['category'];
    $status = $_POST['status'];
    $quantity = $_POST['quantity'];
    $amount = $_POST['amount'];
    $payment_type  = $_POST['payment_type'];
    $paid = $_POST['paid'];
    $comments = $_POST['comments'];
    $business = $_SESSION['business_id'];
    $updated_by = $_SESSION['login_id'];

$sql = "UPDATE laundry_lists SET `supplier_id` = '$supplier',`category_id` = '$category', `status` = '$status', `quantity`  = '$quantity', `amount` = '$amount', `payment_type` = '$payment_type', `paid`='$paid', `comments`='$comments', `business_id`='$business', `updated_by`='$updated_by' where id = $id";

$results = $conn->query($sql);
}




?>

<?php include('head.php');?>


<body class="nav-md">
    <div class="container body">
        <div class="main_container">

            <?php include('topcontent.php');?>


            <!-- page content -->
            <?php include('globalsearch.php');?>

            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Laundry Form <small></small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="laundry_list.php" class="btn btn-primary float-right btn-sm"><i
                                            class="fa fa-list"></i>

                                        Laundry List</a>

                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="row">
                                <div class="col-6">
                                    <form method="POST">
                                        <label class="form-label">Customer <span class="required">*</span></label>

                                        <select class="form-control custom-select" name="supplier" id="supplier"
                                            style="width: 100%; padding: 2px; font-size: 16px; border-radius: 5px;">
                                            <?php 

                                                $sql = "SELECT * FROM suppliers where business_id = $businessid";
                                                $results = $conn->query($sql);
                                                while ($rolerow = $results->fetch_assoc()) {
                                                    echo '<option value="'.$rolerow['id'].'">'.$rolerow['name'].'</option>';
                                                        }
                                                    ?>
                                        </select>
                                        <div class="form-group">

                                        </div>
                                        <label class="form-label">Category <span class="required">*</span></label>
                                        <select class="form-control custom-select" name="category" id="category"
                                            style="width: 100%; padding: 2px; font-size: 16px; border-radius: 5px;">
                                            <?php 

                                                $sql = "SELECT * FROM laundry_categories where business_id = $businessid";
                                                $results = $conn->query($sql);
                                                while ($rolerow = $results->fetch_assoc()) {
                                                    echo '<option value="'.$rolerow['id'].'">'.$rolerow['name'].'</option>';
                                                        }
                                                    ?>
                                        </select>
                                        <label class="form-label">Status <span class="required">*</span></label>
                                        <select class="form-control custom-select" name="status" id="status"
                                            style="width: 100%; padding: 2px; font-size: 16px; border-radius: 5px;">
                                            <?php 

                                                $sql = "SELECT * FROM laundry_statuses ";
                                                $results = $conn->query($sql);
                                                while ($rolerow = $results->fetch_assoc()) {
                                                    echo '<option value="'.$rolerow['id'].'">'.$rolerow['name'].'</option>';
                                                        }
                                                    ?>
                                        </select>

                                        <label class="form-label">Quantity<span class="required">*</span></label>
                                        <div class="form-group">
                                            <input type="number" name="quantity" id="quantity" class="form-control"
                                                value="">

                                        </div>


                                        <label class="form-label">Amount<span class="required">*</span></label>
                                        <div class="form-group">
                                            <input type="number" name="amount" id="amount" class="form-control"
                                                value="">

                                        </div>


                                </div>
                                <div class="col-6">
                                    <label class="form-label">Payment Method<span class="required">*</span></label>
                                    <select class="form-control custom-select" name="payment_type" id="payment_type"
                                        style="width: 100%; padding: 2px; font-size: 16px; border-radius: 5px;">
                                        <?php 

                                                $sql = "SELECT * FROM payment_types ";
                                                $results = $conn->query($sql);
                                                while ($rolerow = $results->fetch_assoc()) {
                                                    echo '<option value="'.$rolerow['id'].'">'.$rolerow['name'].'</option>';
                                                        }
                                                    ?>
                                    </select>
                                    <label class="form-label">Paid<span></span></label>
                                    <div class="form-group">
                                        <input type="number" name="paid" id="paid" class="form-control" value="">
                                    </div>

                                    <label class="form-label">Comment <span></span></label>
                                    <div class="form-group">
                                        <textarea type="text" name="comments" id="comments" class="form-control"
                                            value=""></textarea>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary"
                                            name="addlaundrylist">Submit</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>

                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->

    <!-- footer content -->
    <?php include('footer.php');?>

    <!-- /footer content -->
    </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="../assets/vendors/validator/multifield.js"></script>
    <script src="../assets/vendors/validator/validator.js"></script>

    <!-- Javascript functions	-->

    <script>

    </script>

    <!-- jQuery -->
    <script src="../assets/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="../assets/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../assets/vendors/nprogress/nprogress.js"></script>
    <!-- validator -->
    <!-- <script src="../assets/vendors/validator/validator.js"></script> -->

    <!-- Custom Theme Scripts -->
    <script src="../assets/build/js/custom.min.js"></script>

</body>

</html>