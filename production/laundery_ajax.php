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
                                        <div class="form-group">
                                            <button type="button" name="additemcart" id="additemcart"
                                                class="btn btn-primary">Add
                                                To Laundry </button>

                                        </div>

                                </div>
                                <div class="col-6">

                                    <div class="card-box table-responsive">

                                        <table id="cartTable" class="table table-striped table-bordered"
                                            style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Quantity</th>
                                                    <th>Amount</th>
                                                    <th>Total</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>


                                            <tbody>
                                                <!-- adding items to the table-->

                                            </tbody>
                                        </table>
                                    </div>
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

    <?php include ("scripts.php") ?>
    <script type="text/javascript">
    $(document).ready(function() {

        $('#additemcart').click(function() {
            var cartData = [];

            var categoryid = $("#category").val();
            if (categoryid) {
                <?php 

                $sql = "SELECT * FROM laundry_categories where id = $categoryid";
                $results = $conn->query($sql);
                while ($row = $results->fetch_assoc()) {
                    $categoryprice = $row['unit_price'];
                
                        }
                    ?>
            }
            var categoryname = $("#category option:selected").text();
            var categoryprice = $categoryprice;

            var quantity = parseInt($("#quantity").val(), 10);
            if (quantity && categoryname != '' && quantity > 0) {

                category = cartData.find(function(item) {
                    return item.categoryid == categoryid;
                });

                if (category) {

                    category.quantity += quantity;
                    category.total = category.quantity * category.categoryprice;

                } else {
                    cartData.push({
                        categoryid: categoryid,
                        quantity: quantity,
                        categoryname: categoryname
                    });

                    console.log(categoryid);
                }

                refreshCartTable();
            } else {
                alert(
                    "Please select a category, enter a valid quantity"
                );
            }

            function refreshCartTable() {
                var cartTable = $("#cartTable tbody");
                cartTable.empty();

                var grandTotal = 0;

                cartData.forEach(function(item) {
                    cartTable.append(
                        '<tr>' +
                        '<td>' + item.categoryname + '</td>' +
                        '<td contenteditable="true" class="editable-field quantity">' + item
                        .quantity +
                        '</td>' +
                        '<td contenteditable="true" class="editable-field price">' + item
                        .categoryprice + '</td>' +
                        '<td>' + item.total + '</td>' +
                        '<td><button class="btn btn-danger btn-mini remove-item" data-product-id="' +
                        item.productid + '">Remove</button></td>' +
                        '</tr>'
                    );

                    grandTotal += item.total;
                });

                $("#grand-total").text('Grand Total: Ugx ' + grandTotal);

            }




        });

    });
    </script>

</body>

</html>
