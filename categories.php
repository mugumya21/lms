<?php include('db_connect.php');

if(isset($_POST['addcategorybtn'])){

    $name = $_POST['name'];
    $price = $_POST['price'];


    $sql = "INSERT INTO laundry_categories(`name`, `price`) VALUES ('$name', '$price')";

    $results = $conn->query($sql);

    if(!empty($results)){

        $successmessage = "Category inserted succcessfully";
    }


}
if(isset($_POST['updatecategorybtn'])){
    $id = $_POST['categoryid'];
    $name = $_POST['categoryname'];
    $price = $_POST['categoryprice'];

    $sql = "UPDATE  laundry_categories SET `name` = '$name', `price` = '$price' where id= $id";

    $results = $conn->query($sql);

}


?>

<div class="container-fluid">

    <div class="col-lg-12">
        <div class="row">

            <!-- FORM Panel -->
            <div class="col-md-4">
                <form action="" id="manage-categorytttt" , method="POST">
                    <div class="card">
                        <div class="card-header">
                            Laundry Category Form
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label class="control-label">Category</label>
                                <textarea name="name" id="" cols="30" rows="2" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Price per kg.</label>
                                <input type="number" class="form-control text-right" min="1" step="any" name="price">
                            </div>

                        </div>

                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" name="addcategorybtn"
                                        class="btn btn-sm btn-primary col-sm-3 offset-md-3">
                                        Submit</button>
                                    <button class="btn btn-sm btn-default col-sm-3" type="button"
                                        onclick="$('#manage-categorytt').get(0).reset()"> Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- FORM Panel -->

            <!-- Table Panel -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
								$i = 1;
								$cats = $conn->query("SELECT * FROM laundry_categories order by id desc");
								while($row=$cats->fetch_assoc()):
								?>
                                <tr>
                                    <td class="text-center"><?php echo $i++ ?></td>
                                    <td class="">
                                        <p>Name : <b><?php echo $row['name'] ?></b></p>
                                        <p>Price : <b>UGX<?php echo number_format($row['price']) ?></b></p>
                                    </td>
                                    <td class="text-center">
                                        <button type="submit" name="editcategory"
                                            onclick="openeditmodal(<?=$row['id']?>,'<?=$row['name']?>', '<?=$row['price'] ?>')"
                                            class="btn btn-primary">Edit</button>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Table Panel -->
            <!-- edit modal -->

            <div class="modal" id="mymodal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Category</h5>

                        </div>
                        <div class="modal-body">
                            <form method="POST">
                                <input type="hidden" id="categoryid" value="" name="categoryid">
                                <label class="form-label">Name</label>
                                <div class="form-group">
                                    <input type="text" name="categoryname" id="categoryname" class="form-control"
                                        value="">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Price per kg.</label>
                                    <input type="number" class="form-control text-right" id="categoryprice" min="1"
                                        step="any" name="categoryprice">
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary"
                                        name="updatecategorybtn">Update</button>
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
<style>
td {
    vertical-align: middle !important;
}

td p {
    margin: unset
}
</style>
<script src="assets/js/jquery-te-1.4.0.min.js"></script>
<script type="text/javascript">
const openeditmodal = (id, name, price) => {
    $('#mymodal').modal('show');
    document.getElementById('categoryid').value = id;
    document.getElementById('categoryname').value = name;
    document.getElementById('categoryprice').value = price;
    console.log(id, name, price);
};
</script>
