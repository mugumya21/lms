<?php include('db_connect.php');
session_start();
$id = $_GET['id'];


?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <title> Receipt</title>
    <link href="../assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script type="text/javascript">
    window.onload = function() {
        window.print();
        var is_chrome = function() {
            return Boolean(window.chrome);
        }
        if (is_chrome) {
            setTimeout(function() {
                document.location.href = "laundry_list.php";
            }, 3000);
        } else {
            document.location.href = "laundry_list.php";
        }
    }
    </script>
</head>

<body>
    <div>
        <div>
            <div>

                <table width="100%">
                    <tr>
                        <th width="15%"></th>
                        <th width="70%">
                            <strong style="font-size: 21px;"></strong><br>
                            <span style="font-size: 15px;"></span><br>
                            <span style="font-size: 15px;"></span><br>
                            <span style="font-size: 15px;"></span><br>
                        </th>
                        <th width="15%"></th>
                    </tr>
                </table>
                <hr>
                <u>
                    <center><strong style="font-size: 20px;">
                            <h3>
                                <center>Receipt</center>
                            </h3>
                        </strong></center>
                </u>
                <table width="100%">
                    <?php
                    
                              $laundry_lists = "SELECT S.*, S.name as sname, St.*, St.name as stname,  L.paid , L.total_quantity , L.total_amount FROM laundry_lists L INNER JOIN suppliers S ON L.supplier_id = S.id  INNER JOIN laundry_statuses St ON L.status = St.id where L.id = $id";

                        $result = $conn->query($laundry_lists);
                        if ($row = $result->fetch_assoc()):?>
                    <tr>
                        <td><strong>Customer Name: </strong><?=$row['sname']?>
                        </td>
                        <td><span style="color:red; text-decoration:underline;"></span></td>
                    </tr>
                    <tr>
                        <td><strong>Date: </strong><?=  date('m/d/Y', strtotime( $row['created_at'])) ?></td>
                        <td></td>
                    </tr>
                    <?php endif?>
                </table>
                <hr>
                <table width="100%" border="1" style="border-collapse: collapse;width: 100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Qty</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $no = 0;
                            $laundry_lists = "SELECT S.*, S.name as sname, St.*, St.name as stname,  L.paid , L.total_quantity , L.total_amount FROM laundry_lists L INNER JOIN suppliers S ON L.supplier_id = S.id  INNER JOIN laundry_statuses St ON L.status = St.id where L.id = $id";

                        $result = $conn->query($laundry_lists);
                        while ($row = $result->fetch_assoc()):
                            $no++;
                                  ?>

                        <tr>

                            <td>
                                <?php echo $no ?>
                            </td>
                            <td>
                                <?php echo $row['sname'] ?>
                            </td>

                            <td>
                                <?=number_format( $row['total_quantity']) ?>
                            </td>

                            <td>
                                <?=number_format( $row['total_amount']) ?>
                            </td>


                        </tr>
                        <?php endwhile?>


                    </tbody>
                </table>

            </div>
            <div class="col-3"></div>
        </div>
    </div>
</body>

</html>
