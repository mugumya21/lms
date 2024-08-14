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

                            <div class="x_content">

                                <?php
 

                                    $claimedLaundries = array();
                                    $count = 0;

                                    $results = mysqli_query($conn, "SELECT * FROM laundry_claimed_chart");
                                    while($row = mysqli_fetch_array($results)){
                                            $claimedLaundries[$count] ['label'] = $row['month'];
                                            $claimedLaundries[$count] ['y'] = $row['quantity'];
                                            $count++ ;
                                    }
                                    
                                    ?>


                                <div id="chartContainer" style="height: 240px; width: 100%;"></div>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4">
                        <div class="x_panel tile fixed_height_320 overflow_hidden">

                            <div class="x_content">

                                <?php
 

                                    $claimedLaundries = array();
                                    $count = 0;

                                    $results = mysqli_query($conn, "SELECT * FROM laundry_claimed_chart");
                                    while($row = mysqli_fetch_array($results)){
                                            $claimedLaundries[$count] ['label'] = $row['month'];
                                            $claimedLaundries[$count] ['y'] = $row['quantity'] / 100;
                                            $count++ ;
                                    }
                                    
                                    ?>


                                <div id="piechart" style="height: 240px; width: 100%;"></div>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4">
                        <div class="x_panel tile fixed_height_320">

                            <div class="x_content">

                                <?php
 

                                    $claimedLaundries = array();
                                    $count = 0;

                                    $results = mysqli_query($conn, "SELECT * FROM laundry_claimed_chart");
                                    while($row = mysqli_fetch_array($results)){
                                            $claimedLaundries[$count] ['label'] = $row['month'];
                                            $claimedLaundries[$count] ['y'] = $row['quantity'] / 100;
                                            $count++ ;
                                    }
                                    
                                    ?>


                                <div id="profitschart" style="height: 240px; width: 100%;"></div>

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
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

    <script>
    window.onload = function() {

        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            theme: "light2",
            title: {
                text: "Monthly Claimed Laundry"
            },
            axisY: {
                title: "Quantity"
            },
            data: [{
                type: "column",
                yValueFormatString: "#,##0",
                dataPoints: <?php echo json_encode($claimedLaundries, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();




        var piechart = new CanvasJS.Chart("piechart", {
            animationEnabled: true,
            title: {
                text: "Monthly Laundry Customers"
            },
            subtitles: [{
                text: "Year 2024"
            }],
            data: [{
                type: "pie",
                yValueFormatString: "#,##0\"%\"",
                indexLabel: "{label} ({y})",
                dataPoints: <?php echo json_encode($claimedLaundries, JSON_NUMERIC_CHECK); ?>
            }]
        });
        piechart.render();


        var profitschart = new CanvasJS.Chart("profitschart", {
            animationEnabled: true,
            theme: "light2",
            title: {
                text: "Monthly Laundry Profits"
            },
            axisY: {
                title: "Quantity"
            },
            data: [{
                type: "column",
                yValueFormatString: "#,##0",
                dataPoints: <?php echo json_encode($claimedLaundries, JSON_NUMERIC_CHECK); ?>
            }]
        });
        profitschart.render();

    }
    </script>
</body>

</html>
