<?php
include 'db_connect.php';
session_start();
$name = '';
$email = '';

$errormessage = '';
$successmessage = '';


if(isset($_POST['addcategory'])){

    $name = $_POST['name'];
    $price_per_kg = $_POST['price_per_kg'];
    $business = $_SESSION['business_id'];
    $created_by = $_SESSION['login_id'];



    
$sql = "INSERT INTO laundry_categories(`name`, `price_per_kg`, `business_id`, `created_by`) VALUES ('$name', '$price_per_kg', '$business', '$created_by')";

$results = $conn->query($sql);
}

if(isset($_POST['editcategory'])){

    $id = $_POST['id'];
    $name = $_POST['name'];
    $price_per_kg = $_POST['price_per_kg'];
    $business = $_SESSION['business_id'];
    $updated_by = $_SESSION['login_id'];

$sql = "UPDATE laundry_categories SET `name` = '$name', `price_per_kg` = '$price_per_kg', `business_id`='$business', `updated_by`='$updated_by' where id = $id";

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

                                                <label class="form-label">Price Per Kg<span
                                                        class="required">*</span></label>
                                                <div class="form-group">
                                                    <input type="number" name="price_per_kg" id="price_per_kg" min="1"
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
                                                        <th>Price Per Kg</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>


                                                <tbody>
                                                    <?php
 					include 'db_connect.php';
 					$businessid = $_SESSION['business_id'];
                    $laundry_categories = "SELECT * FROM laundry_categories where business_id = 	$businessid ";
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
                                                            <?=number_format( $row['price_per_kg'] )?>
                                                        </td>
                                                        <td>
                                                            <center> <button type="submit" name="editcategory"
                                                                    onclick="openeditmodal(<?=$row['id']?>,'<?=$row['name']?>','<?=$row['price_per_kg']?>')"
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
                                <input type="hidden" name="id" id="edit_id" class="form-control" value="" required>

                                <label class="form-label">Name<span class="required">*</span></label>
                                <div class="form-group">
                                    <input type="text" name="name" id="edit_name" class="form-control" value=""
                                        required>
                                </div>

                                <label class="form-label">Username<span class="required">*</span></label>
                                <div class="form-group">
                                    <input type="text" name="username" id="edit_username" class="form-control" value=""
                                        required>
                                </div>

                                <label class="form-label">Email<span class="required">*</span></label>
                                <div class="form-group">
                                    <input type="email" name="email" id="edit_email" class="form-control" value=""
                                        required>
                                </div>
                                <label class="form-label">Phone Number<span class="required">*</span></label>
                                <div class="form-group">
                                    <input type="text" name="phone" id="edit_phone" class="form-control" value=""
                                        required>
                                </div>
                                <label class="form-label">Address<span class="required">*</span></label>
                                <div class="form-group">
                                    <input type="text" name="address" id="edit_address" class="form-control" value=""
                                        required>
                                </div>
                                <label class="form-label">Password<span class="required">*</span></label>
                                <div class="form-group">
                                    <input type="password" name="password" id="edit_password" class="form-control"
                                        value="" required>
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
                                <label class="form-label">Business<span class="required">*</span></label>
                                <select class="form-control custom-select" name="business" id="business"
                                    style="width: 100%; padding: 2px; font-size: 16px; border-radius: 5px;">
                                    <?php 
                                            include 'db_connect.php';

                                                $sql = "SELECT * FROM businesses";
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
    const openeditmodal = (id, name, price_per_kg) => {
        $('#myeditmodal').modal('show');
        document.getElementById('edit_id').value = id;
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_price_per_kg').value = price_per_kg;


        console.log(id, name, price_per_kg);
    };


    const alertme = (categoryid) => {
        var categoryid = categoryid;
        Swal.fire({
            title: "Do you want to Delete this Business?",
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