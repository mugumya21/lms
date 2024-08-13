    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
        <div class="menu_section">
            <h3>General</h3>
            <ul class="nav side-menu">
                <li>
                    <a href="index.php"><i class="fa fa-home"></i> Dashboard
                        </span></a>

                </li>
                <li>
                    <a href="inventory_list.php"><i class="fa fa-edit"></i> Inventory
                        </span></a>
                </li>
                <!-- for the business -->

                <?php if($_SESSION['login_name'] == 'superadmin' ):
                echo '<li>
                    <a href="business_list.php"><i class="fa fa-edit"></i> Manage Businesses
                    </a>

                </li>';
                ?>
                <?php endif ?>

                <!-- for the laundry -->

                <li>
                    <a><i class="fa fa-edit"></i> Laundry
                        <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li>
                            <a href="category_list.php">Category</a>
                        </li>
                        <li>
                            <a href="laundry_add.php">Add Laundry</a>
                        </li>
                        <li>
                            <a href="laundry_list.php">List</a>
                        </li>
                    </ul>
                </li>

                <!-- end of the laundry-->

                <li>
                    <a href="supplier_list.php"><i class="fa fa-edit"></i> Customers
                        </span></a>
                </li>

                <!-- for the Users -->

                <?php if($_SESSION['login_role'] == 1 || $_SESSION['login_name'] == 'superadmin' ):
                echo '<li>
                    <a href="users_list.php"><i class="fa fa-edit"></i> Users
                    </a>

                </li>';
    ?>
                <?php endif?>

                <!-- end of the laundry-->

                <!-- for the logs -->

                <?php if(  $_SESSION['login_name'] == 'superadmin'):
                echo '<li>
                    <a href="activity_logs_list.php"><i class="fa fa-edit"></i> Activity Logs
                    </a>

                </li>';
    ?>
                <?php endif?>
                <!-- end of the logs-->
            </ul>
        </div>
    </div>
    <!-- /sidebar menu -->