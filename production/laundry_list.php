<?php include('head.php');?>

<?php
include 'db_connect.php';

$name = '';
$email = '';

$errormessage = '';
$successmessage = '';

if(isset($_POST['addpayment'])){

      $id = $_POST['id'];
      $amount = str_replace("," , '', $_POST['amount']);
      $updated_by = $_SESSION['login_id'];

 $sql = ("SELECT * FROM laundry_lists where id = $id");

    $results = $conn->query($sql);
     $row = $results->fetch_assoc();
   $totalpaid = $row['paid'] +  $amount ;
    
    $sql = "UPDATE laundry_lists SET `paid` = '$totalpaid' ,`updated_by` = '$updated_by' where id = $id";

    $updated = $conn->query($sql);
}

?>





<body class="nav-md">
    <div class="container body">
        <div class="main_container">

            <?php include('topcontent.php');?>


            <!-- page content -->
            <?php include('globalsearch.php');?>

            <!-- add user modal -->

            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Laundry List</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="laundry_add.php" class="btn btn-primary float-right btn-sm"><i
                                        class="fa fa-plus"></i>
                                    Add
                                    Laundry</a>

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
                                                <th>Customer</th>
                                                <th>Quantity</th>
                                                <th>Status</th>
                                                <th>Amount</th>
                                                <th>Paid</th>
                                                <th>Balance</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>


                                        <tbody>
                                            <?php
                
                                            $laundry_lists = "SELECT S.*, S.name as sname, St.*, St.name as stname,  L.paid , L.total_quantity , L.total_amount, L.id as lid FROM laundry_lists L INNER JOIN suppliers S ON L.supplier_id = S.id  INNER JOIN laundry_statuses St ON L.status = St.id" ;
                                            $results= $conn->query($laundry_lists);
                                            $i = 1;
                                            while($row= $results->fetch_assoc()):
                                                $balance =$row['total_amount'] - $row['paid'];
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $i++ ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['sname'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['total_quantity'] ?>
                                                </td>
                                                <td>


                                                    <?php  if($row['stname'] =="incoming"):
                                                    
                                                    echo '<h5 class="badge bg-danger text-white"> '.$row['stname'].'    </h5> '?>
                                                    <?php elseif($row['stname'] =="ongoing"): 

                                                    echo '<h5 class="badge bg-primary text-white"> '.$row['stname'].'    </h5> '?>


                                                    <?php elseif($row['stname'] =="ready"):
                                                    echo '<h5 class="badge bg-danger text-white"> '.$row['stname'].'    </h5> '?>

                                                    <?php else:
                                                    
                                                    echo '<h5 class="badge bg-warning text-white"> '.$row['stname'].'    </h5> '?>


                                                    <?php endif?>

                                                </td>
                                                <td>
                                                    <?=number_format( $row['total_amount']) ?>
                                                </td>

                                                <td>
                                                    <?=number_format(  $row['paid']) ?>
                                                </td>
                                                <td>
                                                    <?=number_format( $row['total_amount'] - $row['paid']) ?>
                                                </td>


                                                <td>

                                                    <?php if($row['paid'] == 0):
                                                    
                                        
                                                  ?>
                                                    <button type="button" name=""
                                                        onclick="generateinvoice(<?=$row['lid']?>)"
                                                        class="btn btn-secondary btn-sm">Invoice</button>

                                                    <button type="button" name="makepayment"
                                                        onclick="openpaymodal(<?=$row['lid']?>,<?=$row['total_amount']?>, <?=$row['paid']?>)"
                                                        class="btn btn-danger btn-sm">Pay</button>
                                                    <?php elseif($row['paid'] > 0 && $balance > 0): 
                                                       
                                                         ?>
                                                    <button type="button" name=""
                                                        onclick="generatereceipt(<?=$row['lid']?>)"
                                                        class="btn btn-danger btn-sm">Receipt</button>

                                                    <button type="button" name="makepayment"
                                                        onclick="openpaymodal(<?=$row['lid']?>,<?=$row['total_amount']?>, <?=$row['paid']?>)"
                                                        class="btn btn-danger btn-sm">Pay</button>
                                                    <?php else:
                                                        ?>
                                                    <button type="button" name=""
                                                        onclick="generatereceipt(<?=$row['lid']?>)"
                                                        class="btn btn-danger btn-sm">Receipt</button>

                                                    <?php endif?>

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
    <!-- end add modal-->
    <!-- pay add modal-->
    <div class="modal" id="mypaymodal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Payment</h5>

                </div>
                <div class="modal-body">
                    <form method="POST">
                        <input type="hidden" name="id" id="edit_pay_id" class="form-control" value="" required>


                        <label class="form-label"> Amount<span class="required">*</span></label>
                        <div class="form-group">
                            <input type="text" name="amount" id="edit_pay_amount" class="form-control" min="0"
                                onkeyup="this.value=addCommas(this.value);" value="">

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-sm" name="addpayment">Update</button>
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>

                        </div>
                    </form>

                </div>

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
    const openpaymodal = (id, amount, paid) => {
        $('#mypaymodal').modal('show');
        var balance = amount - paid;
        document.getElementById('edit_pay_id').value = id;
        document.getElementById('edit_pay_amount').value = balance;

        console.log(id, name, balance);
    };


    const generatereceipt = (id) => {
        var id = id;
        Swal.fire({
            title: "Do you want to Generate a Receipt?",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Generate",
            denyButtonText: `Don't Generate`
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "generate_receipt.php?id=" + id;

                Swal.fire("Generated!", "", "success");
            } else if (result.isDenied) {
                Swal.fire("Receipt is not Generated", "", "info");
            }
        });
    }

    const generateinvoice = (id) => {
        var id = id;
        Swal.fire({
            title: "Do you want to Generate a Invoice?",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Generate",
            denyButtonText: `Don't Generate`
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "generate_invoice.php?id=" + id;

                Swal.fire("Generated!", "", "success");
            } else if (result.isDenied) {
                Swal.fire("Invoice is not Generated", "", "info");
            }
        });
    }
    </script>


</body>

</html>
