<?php include('db_connect.php');

  

if($_SERVER['REQUEST_METHOD'] =='GET'){

    if($_GET['id']){
    $id = $_GET['id'];
    
      $sql = "SELECT * FROM laundry_categories";

      $result = $conn->query($sql);      

      if( $row=  $result->fetch_assoc()) {
	  
        $name = $row['name'];
        $price  = $row['price'];


      }
 
  

}
} else {
        
    $name = $_POST['name'];
    $price = $_POST['price'];
    $deletesql = "UPDATE TABLE  laundry_categories SET 'name'= $name, 'price'= $price where id = $id";
    $result = $conn->query($deletesql);

   
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
                        <input type="text" class="hidden" name="id">
                        <?php 
					
								$cats = $conn->query("SELECT * FROM laundry_categories where id = $id");
								while($row=$cats->fetch_assoc()){
                                    echo '
                                     <div class="card-body">
                            <div class="form-group">
                                <label class="control-label">Category</label>
                                <textarea name="name" id="" cols="30" rows="2" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Price per kg.</label>
                                <input type="number" class="form-control text-right" min="1" step="any" name="price">
                            </div>

                        </div>';
                                };
								?>


                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-sm btn-primary col-sm-3 offset-md-3">
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
                                        <a href="categories?id=<?php echo $row['id']?>">Edit</a>
                                        <!-- <a href="categories?id=<?php echo $row['id']?>">Delete</a> -->
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Table Panel -->
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
<script>
$('#manage-categoryytt').submit(function(e) {
    e.preventDefault()
    start_load()
    $.ajax({
        url: 'ajax.php?action=save_category',
        data: new FormData($(this)[0]),
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        type: 'POST',
        success: function(resp) {
            if (resp == 1) {
                alert_toast("Data successfully added", 'success')
                setTimeout(function() {
                    location.reload()
                }, 1500)

            } else if (resp == 2) {
                alert_toast("Data successfully updated", 'success')
                setTimeout(function() {
                    location.reload()
                }, 1500)

            }
        }
    })
})
$('.edit_cat').click(function() {
    start_load()
    var cat = $('#manage-categoryt')
    cat.get(0).reset()
    cat.find("[name='id']").val($(this).attr('data-id'))
    cat.find("[name='name']").val($(this).attr('data-name'))
    end_load()
})
$('.delete_cat').click(function() {
    _conf("Are you sure to delete this category?", "delete_cat", [$(this).attr('data-id')])
})

function delete_cat($id) {
    start_load()
    $.ajax({
        url: 'ajax.php?action=delete_category',
        method: 'POST',
        data: {
            id: $id
        },
        success: function(resp) {
            if (resp == 1) {
                alert_toast("Data successfully deleted", 'success')
                setTimeout(function() {
                    location.reload()
                }, 1500)

            }
        }
    })
}
</script>