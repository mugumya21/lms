<?php
include 'db_connect.php';
session_start();
$name = '';
$email = '';

$errormessage = '';
$successmessage = '';


if(isset($_POST['addcategory'])){

    $name = $_POST['name'];
    $unit_price = $_POST['unit_price'];
    $business = $_SESSION['business_id'];
    $created_by = $_SESSION['login_id'];



    
$sql = "INSERT INTO laundry_categories(`name`, `unit_price`, `business_id`, `created_by`) VALUES ('$name', '$unit_price', '$business', '$created_by')";

$results = $conn->query($sql);
}

if(isset($_POST['editcategory'])){

    $id = $_POST['id'];
    $name = $_POST['name'];
    $unit_price = $_POST['unit_price'];
    $business = $_SESSION['business_id'];
    $updated_by = $_SESSION['login_id'];

$sql = "UPDATE laundry_categories SET `name` = '$name', `unit_price` = '$unit_price', `business_id`='$business', `updated_by`='$updated_by' where id = $id";

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


            <!-- my category form -->

            <div class="row">
                <div class="col-6">
                    <div class="col-md-12 col-sm-12 ">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>
                                    <center>Category Form</center>
                                </h2>

                                <div class="clearfix"></div>
                            </div>

                            <div class="x_content">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card-box">

                                            <form method="POST">
                                                <input type="hidden" name="id" id="edit_id" class="form-control"
                                                    value="" required>

                                                <label class="form-label">Category Name<span
                                                        class="required">*</span></label>
                                                <div class="form-group">
                                                    <input type="text" name="name" id="categoryname"
                                                        class="form-control" value="" required>
                                                </div>

                                                <label class="form-label">Unit Price<span
                                                        class="required">*</span></label>
                                                <div class="form-group">
                                                    <input type="number" name="unit_price" id="unit_price" min="1"
                                                        step="any" class="form-control" value="">

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary"
                                                        name="addcategory">Submit</button>
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

                <!-- my category table-->
                <div class="col-6">
                    <div class="col-md-12 col-sm-12 ">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Categories List</h2>

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
                                                        <th>Unit Price</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>


                                                <tbody>
                                                    <?php
                                                            $businessid = $_SESSION['business_id'];
                                                            $laundry_categories = "SELECT * FROM laundry_categories where business_id = 	$businessid  and is_active = 1";
                                                            $results= $conn->query($laundry_categories);
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
                                                            <?=number_format( $row['unit_price'] )?>
                                                        </td>
                                                        <td>
                                                            <center> <button type="submit"
                                                                    onclick="openeditmodal(<?=$row['id'] ?>,'<?=$row['name']?>','<?=$row['unit_price']?>')"
                                                                    class="btn btn-primary">Edit</button>

                                                                <button type="button" name=""
                                                                    onclick="alertme(<?=$row['id']?>)"
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
                </div>
            </div>
            <!-- end of my data table-->
            <!-- edit user modal -->

            <div class="modal" id="myeditmodal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Category</h5>

                        </div>
                        <div class="modal-body">
                            <form method="POST">
                                <input type="hidden" name="id" id="edit_category_id" class="form-control" value=""
                                    required>

                                <label class="form-label">Category Name<span class="required">*</span></label>
                                <div class="form-group">
                                    <input type="text" name="name" id="edit_category_name" class="form-control" value=""
                                        required>
                                </div>

                                <label class="form-label">Unit Price<span class="required">*</span></label>
                                <div class="form-group">
                                    <input type="number" name="unit_price" id="edit_unit_price" min="1" step="any"
                                        class="form-control" value="">

                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" name="editcategory">Update</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

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
    const openeditmodal = (id, name, unit_price) => {
        $('#myeditmodal').modal('show');
        document.getElementById('edit_category_id').value = id;
        document.getElementById('edit_category_name').value = name;
        document.getElementById('edit_unit_price').value = unit_price;


        console.log(id, name, unit_price);
    };


    const alertme = (categoryid) => {
        var categoryid = categoryid;
        Swal.fire({
            title: "Do you want to Delete this Category?",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Delete",
            denyButtonText: `Don't Delete`
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "delete_category.php?id=" + categoryid;
                Swal.fire("Deleted!", "", "success");
            } else if (result.isDenied) {
                Swal.fire("Business is not deleted", "", "info");
            }
        });
    }
    </script>


</body>

</html>
