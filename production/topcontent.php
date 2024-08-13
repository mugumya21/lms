<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0">
            <a href="index.php" class="site_title"><i class="fa fa-paw"></i> <span>Laundry System</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img" />
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2><?=$_SESSION['login_name']?></h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <?php include('sidebar.php');?>

        <!-- /menu footer buttons -->

        <!-- /menu footer buttons -->
    </div>
</div>
<!-- top navigation -->
<div class="top_nav">
    <div class="nav_menu">
        <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        <nav class="nav navbar-nav">
            <ul class="navbar-right">
                <li> <a class="dropdown-item" href="logout.php?id=<?=$_SESSION['login_id']?>"><i
                            class="fa fa-sign-out pull-right"></i>
                        Log Out</a>
                </li>



            </ul>
            </li>
            </ul>
        </nav>
    </div>
</div>
<!-- /top navigation -->