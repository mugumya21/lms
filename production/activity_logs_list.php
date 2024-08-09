<?php

include 'db_connect.php';
session_start();
if(!isset($_SESSION['login_id'])){
    header('location:login.php');

    exit;

}
$name = '';
$email = '';

$errormessage = '';
$successmessage = '';

?>
<?php include('head.php');?>


<body class="nav-md">
    <div class="container body">
        <div class="main_container">

            <?php include('topcontent.php');?>



            <!-- page content -->
            <?php include('globalsearch.php');?>


            <!-- add user modal -->

            <div class="modal" id="myaddmodal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Business</h5>

                        </div>
                        <div class="modal-body">
                            <form method="POST">
                                <label class="form-label">Name<span class="required">*</span></label>
                                <div class="form-group">
                                    <input type="text" name="name" id="name" class="form-control" value="" required>
                                </div>

                                <label class="form-label">Email<span class="required">*</span></label>
                                <div class="form-group">
                                    <input type="email" name="email" id="email" class="form-control" value="" required>
                                </div>
                                <label class="form-label">Phone Number<span class="required">*</span></label>
                                <div class="form-group">
                                    <input type="phone" name="phone" id="phone" class="form-control" value="" required>
                                </div>
                                <label class="form-label">Address<span class="required">*</span></label>
                                <div class="form-group">
                                    <input type="text" name="address" id="address" class="form-control" value=""
                                        required>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" name="addbusiness">Save</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                </div>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- end add modal-->


        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Activity Logs List</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
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
                                            <th>Done By</th>
                                            <th>URL</th>
                                            <th>Activity</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        <?php

                    $activity_logs = "SELECT A.*, U.username, U.name FROM activity_logs A  INNER JOIN users U
                    ON A.user_id = U.id   order by id desc";
                    $results= $conn->query($activity_logs);
 					$i = 1;
 					while($row= $results->fetch_assoc()):
				 ?>
                                        <tr>
                                            <td>
                                                <?php echo $i++ ?>
                                            </td>
                                            <td>
                                                <?php echo $row['username'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['url'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['action'] ?>
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
        <!-- end of my data table-->
        <!-- edit user modal -->

        <div class="modal" id="myeditmodal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Business</h5>

                    </div>
                    <div class="modal-body">
                        <form method="POST">
                            <input type="hidden" name="id" id="edit_id" class="form-control" value="" required>

                            <label class="form-label">Name<span class="required">*</span></label>
                            <div class="form-group">
                                <input type="text" name="name" id="edit_name" class="form-control" value="" required>
                            </div>

                            <label class="form-label">Email<span class="required">*</span></label>
                            <div class="form-group">
                                <input type="email" name="email" id="edit_email" class="form-control" value="" required>
                            </div>
                            <label class="form-label">Phone Number<span class="required">*</span></label>
                            <div class="form-group">
                                <input type="text" name="phone" id="edit_phone" class="form-control" value="" required>
                            </div>
                            <label class="form-label">Address<span class="required">*</span></label>
                            <div class="form-group">
                                <input type="text" name="address" id="edit_address" class="form-control" value=""
                                    required>
                            </div>


                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" name="editbusiness">Update</button>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    </script>


</body>

</html>
