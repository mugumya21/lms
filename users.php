<?php
include 'db_connect.php';
$name = '';
$email = '';

$errormessage = '';
$successmessage = '';


if(isset($_POST['adduser'])){

    $name = $_POST['name'];
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $phone = $_POST['email'];
    $address = $_POST['address'];
    $type = $_POST['type'];
    $password = $_POST['password'];


    
$sql = "INSERT INTO users(`name`, `username`, `phone`, `email`, `address`, `type`, `password`) VALUES ('$name', '$username', '$phone', '$email', '$address', '$type', '$password')";

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
                user</button>
        </div>
        <!-- add user modal -->

        <div class="modal" id="myaddmodal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add User</h5>

                    </div>
                    <div class="modal-body">
                        <form method="POST">
                            <input type="hidden" id="id" value="" name="id">
                            <label class="form-label">Name</label>
                            <div class="form-group">
                                <input type="text" name="name" id="name" class="form-control" value="">
                            </div>
                            <label class="form-label">Username</label>
                            <div class="form-group">
                                <input type="text" name="username" id="username" class="form-control" value="">
                            </div>
                            <label class="form-label">Phone Number</label>
                            <div class="form-group">
                                <input type="text" name="phone" id="phone" class="form-control" value="">
                            </div>
                            <label class="form-label">Address</label>
                            <div class="form-group">
                                <input type="text" name="address" id="address" class="form-control" value="">
                            </div>
                            <label class="form-label">Role</label>
                            <div class="form-group">
                                <select name="type" id="type" class="form-control">
                                    <option value="1">Admin</option>
                                    <option value="2">Staff</option>
                                </select>
                            </div>
                            <label class="form-label">Email</label>
                            <div class="form-group">
                                <input type="text" name="email" id="password" class="form-control" value="">
                            </div>
                            <label class="form-label">Password</label>
                            <div class="form-group">
                                <input type="text" name="password" id="password" class="form-control" value="">
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" name="adduser">Submit</button>
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
                        <th class="text-center">Username</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Contact</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
 					include 'db_connect.php';
 					$users = $conn->query("SELECT * FROM users order by name asc");
 					$i = 1;
 					while($row= $users->fetch_assoc()):
				 ?>
                    <tr>
                        <td>
                            <?php echo $i++ ?>
                        </td>
                        <td>
                            <?php echo $row['name'] ?>
                        </td>
                        <td>
                            <?php echo $row['username'] ?>
                        </td>
                        <td>
                            <?php echo $row['email'] ?>
                        </td>
                        <td>
                            <?php echo $row['phone'] ?>
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
                                        <a class="dropdown-item edit_user" href="javascript:void(0)"
                                            data-id='<?php echo $row['id'] ?>'>Edit</a>
                                        <div class="dropdown-divider"></div>
                                        <a type="submit" name="editcategory"
                                            href="delete_user.php?id=<?php echo $row['id'] ?>"
                                            class="btn btn-danger">Delete</a>
                                    </div>
                                </div>
                            </center>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
<script>
</script>
