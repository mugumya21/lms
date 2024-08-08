<?php
include 'db_connect.php';
$name = '';
$email = '';

$errormessage = '';
$successmessage = '';


if(isset($_POST['addsupplier'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];



    
$sql = "INSERT INTO suppliers(`name`, `email`, `phone`, `address`) VALUES ('$name', '$email', '$phone', '$address')";

$results = $conn->query($sql);
}

if(isset($_POST['editsupplier'])){

    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];


$sql = "UPDATE suppliers SET `name` = '$name',`email` = '$email', `phone` = '$phone', `address` = '$address' where id = $id";

$results = $conn->query($sql);
}

$conn->close();


?>
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-12">
            <button class="btn btn-primary float-right btn-sm" data-toggle="modal" data-target="#myaddmodal"><i
                    class="fa fa-plus"></i>
                New
                supplier</button>
        </div>
        <!-- add supplier modal -->

        <div class="modal" id="myaddmodal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Supplier</h5>

                    </div>
                    <div class="modal-body">
                        <form method="POST">
                            <label class="form-label">Name</label>
                            <div class="form-group">
                                <input type="text" name="name" id="name" class="form-control" value="">
                            </div>

                            <label class="form-label">Email</label>
                            <div class="form-group">
                                <input type="email" name="email" id="email" class="form-control" value="">
                            </div>
                            <label class="form-label">Phone Number</label>
                            <div class="form-group">
                                <input type="text" name="phone" id="phone" class="form-control" value="">
                            </div>
                            <label class="form-label">Address</label>
                            <div class="form-group">
                                <input type="text" name="address" id="address" class="form-control" value="">
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" name="addsupplier">Submit</button>
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
<br>
<div class="row">
    <div class="card col-lg-12">
        <div class="card-body">
            <table class="table-striped table-bordered col-md-12">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Contact</th>
                        <th class="text-center">Address</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
 					include 'db_connect.php';
 					$suppliers = $conn->query("SELECT * FROM suppliers order by name asc");
 					$i = 1;
 					while($row= $suppliers->fetch_assoc()):
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
                            <center>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary">Action</button>
                                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <button type="submit" name="editsupplier"
                                            onclick="openeditmodal(<?=$row['id']?>,'<?=$row['name']?>', '<?=$row['email'] ?>', '<?=$row['phone'] ?>', '<?=$row['address'] ?>')"
                                            class="btn btn-primary">Edit</button>
                                        <div class="dropdown-divider"></div>
                                        <a type="submit" name="" href="delete_supplier.php?id=<?php echo $row['id'] ?>"
                                            class="btn btn-danger">Delete</a>
                                    </div>
                                </div>
                            </center>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

            <!-- edit supplier modal -->

            <div class="modal" id="myeditmodal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Supplier</h5>

                        </div>
                        <div class="modal-body">
                            <form method="POST">
                                <input type="hidden" id="edit_id" value="" name="id">
                                <label class="form-label">Name</label>
                                <div class="form-group">
                                    <input type="text" name="name" id="edit_name" class="form-control" value="">
                                </div>
                                <label class="form-label">Email</label>
                                <div class="form-group">
                                    <input type="email" name="email" id="edit_email" class="form-control" value="">
                                </div>
                                <label class="form-label">Phone Number</label>
                                <div class="form-group">
                                    <input type="text" name="phone" id="edit_phone" class="form-control" value="">
                                </div>

                                <label class="form-label">Address</label>
                                <div class="form-group">
                                    <input type="text" name="address" id="edit_address" class="form-control" value="">
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" name="editsupplier">Update</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                </div>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- end edit modal-->
    </div>
</div>
</div>

</div>
<script src="assets/js/jquery-te-1.4.0.min.js"></script>
<script type="text/javascript">
const openeditmodal = (id, name, email, phone, address) => {
    $('#myeditmodal').modal('show');
    document.getElementById('edit_id').value = id;
    document.getElementById('edit_name').value = name;
    document.getElementById('edit_email').value = email;
    document.getElementById('edit_phone').value = phone;
    document.getElementById('edit_address').value = address;
    console.log(id, name, email, phone, address);
};
</script>
