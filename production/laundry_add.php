<?php include('head.php');?>

<?php
include 'db_connect.php';


$name = '';
$email = '';

$errormessage = '';
$successmessage = '';
$businessid = $_SESSION['business_id'];
$uid =  $_SESSION['login_id'];


if(isset($_POST['addlaundrylist'])){

    $supplier = $_POST['supplier'];
    $status = $_POST['status'];

    $total_quantity = str_replace("," , '', $_POST['total_quantity']);
    $total_amount = str_replace("," , '', $_POST['total_amount']);
    $paid = str_replace("," , '', $_POST['paid']);
    $payment_type  = $_POST['payment_type'];
    
    $comments = $_POST['comments'];
    $business = $_SESSION['business_id'];
    $created_by = $_SESSION['login_id'];



$sql = "INSERT INTO laundry_lists(`supplier_id`, `status`, `total_quantity`, `total_amount`, `payment_type`, `paid`, `comments`, `business_id`, `created_by`) VALUES ('$supplier', '$status', '$total_quantity', '$total_amount', '$payment_type', '$paid', '$comments', '$business', '$created_by')";

$results = $conn->query($sql);

if($results){

    $last_id = mysqli_insert_id($conn);


    $cart = mysqli_fetch_all(mysqli_query($conn,"SELECT *,(select name from laundry_categories where id=cart.item) as name FROM cart WHERE user_id='$uid'"),MYSQLI_ASSOC);

    foreach ($cart as $row) {
        $item_id = $row['id']; 
        $update_query = "UPDATE cart SET laundry_list_id='$last_id' WHERE id='$item_id'";
        $results = $conn->query( $update_query);
    }
    
echo'
<script>
window.location.href = "laundry_list.php"
</script>
';
    
} else {
    echo "Error: " . $conn->error;
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


if(isset($_POST['edititem'])){

      $id = $_POST['id'];
      $item = $_POST['item'];
      $quantity = str_replace("," , '', $_POST['quantity']);
      $amount = str_replace("," , '', $_POST['amount']);
      $updated_by = $_SESSION['login_id'];



$sql = "UPDATE cart SET `item` = '$item',`amount` = '$amount',`quantity` = '$quantity',`user_id` = '$updated_by'";

$results = $conn->query($sql);
}

?>



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
                                <div class="col-4">
                                    <form method="POST">

                                        <div class="form-group">

                                        </div>
                                        <label class="form-label">Category <span class="required">*</span></label>
                                        <select class="form-control custom-select" name="category" id="category"
                                            style="width: 100%; padding: 2px; font-size: 16px; border-radius: 5px;"
                                            required>
                                            <option value="" disabled selected>Select Category</option>
                                            <?php 

                                                $sql = "SELECT * FROM laundry_categories where business_id = $businessid";
                                                $results = $conn->query($sql);
                                                while ($rolerow = $results->fetch_assoc()) {
                                                    echo '<option value="'.$rolerow['id'].'">'.$rolerow['name'].'</option>';
                                                        }
                                                    ?>
                                        </select>

                                        <label class="form-label">Unit Amount<span></span></label>
                                        <div class="form-group">
                                            <input type="text" name="amount" class="form-control" required
                                                placeholder="Enter Unit Amount Charged" min="0"
                                                onkeyup="this.value=addCommas(this.value);">
                                        </div>

                                        <label class="form-label">Quantity<span class="required">*</span></label>
                                        <div class="form-group">
                                            <input type="number" name="quantity" id="quantity" class="form-control"
                                                placeholder="Enter Quantity" required>

                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="additemcart" class="btn btn-primary btn-sm"><i
                                                    class="fa fa-plus"></i> Add
                                                To Laundry </button>

                                        </div>
                                    </form>
                                    <?php
if(isset($_POST['additemcart'])){
    $cat = $_POST['category'];
    $qty = $_POST['quantity'];
    $amount = str_replace(",","",$_POST['amount']);
    $check = mysqli_query($conn,"SELECT * FROM cart WHERE item='$cat' and laundry_list_id IS NULL");
    if(mysqli_num_rows($check)>0){
          echo '                          <script>
                                    alert("This item already exists");
                                    history.go(-1);
                                    </script>';
    }else{
        $insert = mysqli_query($conn, "INSERT INTO cart (item,amount,quantity,user_id) VALUES('$cat','$amount','$qty','$uid')");
        if($insert){
            $successmessage = "Item added successfully";?>
                                    <script>
                                    window.location = "laundry_add.php"
                                    </script>
                                    <?php
        }
    }
}
?>
                                </div>
                                <div class="col-8">

                                    <div class="card-box table-responsive">

                                        <table id="cartTable" class="table table-striped table-bordered"
                                            style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Name</th>
                                                    <th>Quantity</th>
                                                    <th>Amount</th>
                                                    <th>Total</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php
                                               $no = 0;
                                               $total_quantity = 0;
                                               $total_amount = 0;
                                               $cart = mysqli_fetch_all(mysqli_query($conn,"SELECT *,(select name from laundry_categories where id=cart.item) as name FROM cart WHERE user_id='$uid' and laundry_list_id IS NULL"),MYSQLI_ASSOC);
                                               foreach ($cart as $row) {
                                                $no++; 
                                                $multy = $row['amount']*$row['quantity'];
                                                $total_quantity += $row['quantity'];
                                                $total_amount += $multy;
                                                ?>
                                                <tr>
                                                    <td><?=$no;?></td>
                                                    <td><?=$row['name'];?></td>
                                                    <td> <?=number_format( $row['quantity'] )?></td>
                                                    <td> <?=number_format( $row['amount'] )?></td>
                                                    <td> <?=number_format( $row['amount']*$row['quantity'] )?></td>
                                                    <td>
                                                        <center> <button type="submit" name="edituser"
                                                                onclick="openeditmodal(<?=$row['id']?>,'<?=$row['quantity']?>', '<?=$row['amount'] ?>')"
                                                                class="btn btn-primary btn-sm">Edit</button>

                                                            <button type="button" name=""
                                                                onclick="alertme(<?=$row['id']?>)"
                                                                class="btn btn-danger btn-sm">Delete</button>
                                                        </center>
                                                    </td>
                                                </tr>
                                                <?php
                                               }
                                               ?>
                                                <tr>
                                                    <td class="text-danger">Total Sum</td>
                                                    <td></td>
                                                    <td class="text-danger"> <?=number_format( $total_quantity)?></td>
                                                    <td></td>
                                                    <td class="text-danger"> <?=number_format( $total_amount)?></td>

                                                    <td></td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                    <form method="POST">
                                        <input type="hidden" name="total_quantity" class="form-control"
                                            value="<?=$total_quantity;?>" required>
                                        <input type="hidden" name="total_amount" class="form-control"
                                            value="<?=$total_amount;?>" required>


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
                                            <input type="text" name="paid" id="paid" class="form-control" value=""
                                                placeholder="Enter Amount Paid" min="0"
                                                onkeyup="this.value=addCommas(this.value);">
                                        </div>

                                        <label class="form-label">Comment <span></span></label>
                                        <div class="form-group">
                                            <textarea type="text" name="comments" id="comments" class="form-control"
                                                value=""></textarea>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary btn-sm"
                                                name="addlaundrylist"><i class="fa fa-check"></i> Submit</button>
                                            <button type="button" class="btn btn-secondary btn-sm"
                                                data-dismiss="modal"><i class="fa fa-times"></i> Close</button>

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

    <!-- edit user modal -->

    <div class="modal" id="myeditmodal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Laundry Item</h5>

                </div>
                <div class="modal-body">
                    <form method="POST">
                        <input type="hidden" name="id" id="edit_item_id" class="form-control" value="" required>

                        <label class="form-label">Category Name<span class="required">*</span></label>
                        <select class="form-control custom-select" name="item" id="item"
                            style="width: 100%; padding: 2px; font-size: 16px; border-radius: 5px;" required>
                            <option value="" disabled selected>Select Category</option>
                            <?php 

                                                $sql = "SELECT * FROM laundry_categories where business_id = $businessid";
                                                $results = $conn->query($sql);
                                                while ($rolerow = $results->fetch_assoc()) {
                                                    echo '<option value="'.$rolerow['id'].'">'.$rolerow['name'].'</option>';
                                                        }
                                                    ?>
                        </select>
                        <label class="form-label">Unit Amount<span class="required">*</span></label>
                        <div class="form-group">
                            <input type="text" name="amount" id="edit_item_amount" class="form-control" min="0"
                                onkeyup="this.value=addCommas(this.value);" value="">

                        </div>
                        <label class="form-label">Quantity<span class="required">*</span></label>
                        <div class="form-group">
                            <input type="text" name="quantity" id="edit_item_quantity" class="form-control" min="0"
                                onkeyup="this.value=addCommas(this.value);">

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-sm" name="edititem">Update</button>
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>

                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
    </div>
    <!-- end add modal-->

    <!-- footer content -->
    <?php include('footer.php');?>

    <!-- /footer content -->
    </div>
    </div>

    <?php include ("scripts.php") ?>
    <script type="text/javascript">
    const openeditmodal = (id, quantity, amount) => {
        $('#myeditmodal').modal('show');
        document.getElementById('edit_item_id').value = id;
        document.getElementById('edit_item_quantity').value = quantity;
        document.getElementById('edit_item_amount').value = amount;


        console.log(id, name, quantity, amount);
    };


    const alertme = (categoryid) => {
        var categoryid = categoryid;
        Swal.fire({
            title: "Do you want to Delete this Item?",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Delete",
            denyButtonText: `Don't Delete`
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "delete_cart_item.php?id=" + categoryid;
                Swal.fire("Deleted!", "", "success");
            } else if (result.isDenied) {
                Swal.fire("Item is not deleted", "", "info");
            }
        });
    }
    </script>

</body>

</html>
