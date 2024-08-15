<?php include('head.php');?>

<?php
     include("db_connect.php");

   ?>


<body class="nav-md">
    <div class="container body">
        <div class="main_container">


            <?php include('topcontent.php');?>

            <!-- page content -->
            <div class="right_col" role="main">
                <!-- top tiles -->


                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <div class="x_panel tile fixed_height_320">
                            <div class="x_title">
                                <h2>
                                    <center>
                                        <p><b>
                                                <large>Total Claimed Laundry Today</large>
                                            </b></p>
                                    </center>
                                </h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <h4>
                                    <center <p><b>
                                            <large>


                                                <?php 
                                            $laundry = $conn->query("SELECT COUNT(*) as `count` FROM laundry_lists where  status = 4 and date(created_at) = '".date('Y-m-d')."'");
                                            $results = $laundry->num_rows > 0 ? number_format($laundry->fetch_array()['count']) : "0.00";
                                            echo($results);

                                    

                                            ?>
                                            </large>
                                        </b></p>
                                    </center>
                                </h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4">
                        <div class="x_panel tile fixed_height_320 overflow_hidden">
                            <div class="x_title">
                                <h2>
                                    <center>
                                        <p><b>
                                                <large>Total Customer Today</large>
                                            </b></p>
                                    </center>
                                </h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <h4>
                                    <center <p><b>
                                            <large>

                                                <?php 
                                            $laundry = $conn->query("SELECT COUNT(*) as `count` FROM suppliers where date(created_at) = '".date('Y-m-d')."'");
                                            $results = $laundry->num_rows > 0 ? number_format($laundry->fetch_array()['count']) : "0.00";
                                            echo($results);

                                    

                                            ?></large>
                                        </b></p>
                                    </center>
                                </h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4">
                        <div class="x_panel tile fixed_height_320">
                            <div class="x_title">
                                <h2>
                                    <center>
                                        <p><b>
                                                <large>Total Profit Today</large>
                                            </b></p>
                                    </center>
                                </h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <h4>
                                    <center <p><b>
                                            <large>
                                                <?php 
                                           
                                    		$laundry = $conn->query("SELECT SUM(paid) as amount FROM laundry_lists where payment_type= 3 or payment_type = 2 and date(created_at)= '".date('Y-m-d')."'");
                                            $results = $laundry->num_rows > 0 ? number_format($laundry->fetch_array()['amount']) : "0";
					                          echo('UGX '.$results);

                                            ?></large>
                                        </b></p>
                                    </center>
                                </h4>
                            </div>
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
</body>

</html>