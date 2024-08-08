<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>LMS </title>

    <!-- Bootstrap -->
    <link href="../assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../assets/vendors/nprogress/nprogress.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../assets/build/css/custom.min.css" rel="stylesheet">
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <?php include('toplogoprofile.php')?>
                        <!-- /menu profile quick info -->

                        <br />

                        <!-- sidebar menu -->
                        <?php include('sidebar.php')?>

                        <!-- /sidebar menu -->

                        <!-- /menu footer buttons -->
                        <?php include('footer_button.php')?>

                        <!-- /menu footer buttons -->
                    </div>
                </div>

                <!-- top navigation -->
                <?php include('topnavbar.php')?>

                <!-- /top navigation -->

                <!-- page content -->
                <div class="right_col" role="main">
                    <div class="">
                        <div class="page-title">
                            <div class="title_left">
                                <h3></h3>
                            </div>

                            <div class="title_right">
                                <div class="col-md-5 col-sm-5 form-group pull-right top_search">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search for...">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button">Go!</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>USer Form<small></small></h2>
                                        <ul class="nav navbar-right panel_toolbox">
                                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                            </li>
                                            <li class="">
                                                <a href="#" class="btn btn-primary" role="button"><i
                                                        class="fa fa-list"></i>
                                                    Users</a>

                                            </li>
                                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                                            </li>
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <form class="" action="" method="post" novalidate>
                                            <div class="field item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3  label-align">Name<span
                                                        class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input class="form-control" data-validate-length-range="6"
                                                        data-validate-words="2" name="name" placeholder=""
                                                        required="required" />
                                                </div>
                                            </div>
                                            <div class="field item form-group">
                                                <label
                                                    class="col-form-label col-md-3 col-sm-3  label-align">Occupation<span
                                                        class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input class="form-control" class='optional' name="occupation"
                                                        data-validate-length-range="5,15" type="text" />
                                                </div>
                                            </div>
                                            <div class="field item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3  label-align">email<span
                                                        class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input class="form-control" name="email" class='email'
                                                        required="required" type="email" />
                                                </div>
                                            </div>
                                            <div class="field item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3  label-align">Confirm
                                                    email
                                                    address<span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input class="form-control" type="email" class='email'
                                                        name="confirm_email" data-validate-linked='email'
                                                        required='required' />
                                                </div>
                                            </div>
                                            <div class="field item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3  label-align">Number
                                                    <span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input class="form-control" type="number" class='number'
                                                        name="number" data-validate-minmax="10,100" required='required'>
                                                </div>
                                            </div>
                                            <div class="field item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3  label-align">Date<span
                                                        class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input class="form-control" class='date' type="date" name="date"
                                                        required='required'>
                                                </div>
                                            </div>
                                            <div class="field item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3  label-align">Time<span
                                                        class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input class="form-control" class='time' type="time" name="time"
                                                        required='required'>
                                                </div>
                                            </div>

                                            <div class="field item form-group">
                                                <label
                                                    class="col-form-label col-md-3 col-sm-3  label-align">Password<span
                                                        class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input class="form-control" type="password" id="password1"
                                                        name="password"
                                                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}"
                                                        title="Minimum 8 Characters Including An Upper And Lower Case Letter, A Number And A Unique Character"
                                                        required />

                                                    <span style="position: absolute;right:15px;top:7px;"
                                                        onclick="hideshow()">
                                                        <i id="slash" class="fa fa-eye-slash"></i>
                                                        <i id="eye" class="fa fa-eye"></i>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="field item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3  label-align">Repeat
                                                    password<span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input class="form-control" type="password" name="password2"
                                                        data-validate-linked='password' required='required' />
                                                </div>
                                            </div>
                                            <div class="field item form-group">
                                                <label
                                                    class="col-form-label col-md-3 col-sm-3  label-align">Telephone<span
                                                        class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input class="form-control" type="tel" class='tel' name="phone"
                                                        required='required' data-validate-length-range="8,20" />
                                                </div>
                                            </div>
                                            <!-- <div class="field item form-group">
                                                <label
                                                    class="col-form-label col-md-3 col-sm-3  label-align">message<span
                                                        class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6">
                                                    <textarea required="required" name='message'></textarea>
                                                </div>
                                            </div> -->
                                            <div class="ln_solid">
                                                <div class="form-group">
                                                    <div class="col-md-6 offset-md-3">
                                                        <button type='submit' class="btn btn-primary">Submit</button>
                                                        <button type='reset' class="btn btn-success">Reset</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
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


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="../assets/vendors/validator/multifield.js"></script>
        <script src="../assets/vendors/validator/validator.js"></script>

        <!-- Javascript functions	-->
        <script>
        function hideshow() {
            var password = document.getElementById("password1");
            var slash = document.getElementById("slash");
            var eye = document.getElementById("eye");

            if (password.type === 'password') {
                password.type = "text";
                slash.style.display = "block";
                eye.style.display = "none";
            } else {
                password.type = "password";
                slash.style.display = "none";
                eye.style.display = "block";
            }

        }
        </script>

        <script>
        // initialize a validator instance from the "FormValidator" constructor.
        // A "<form>" element is optionally passed as an argument, but is not a must
        var validator = new FormValidator({
            "events": ['blur', 'input', 'change']
        }, document.forms[0]);
        // on form "submit" event
        document.forms[0].onsubmit = function(e) {
            var submit = true,
                validatorResult = validator.checkAll(this);
            console.log(validatorResult);
            return !!validatorResult.valid;
        };
        // on form "reset" event
        document.forms[0].onreset = function(e) {
            validator.reset();
        };
        // stuff related ONLY for this demo page:
        $('.toggleValidationTooltips').change(function() {
            validator.settings.alerts = !this.checked;
            if (this.checked)
                $('form .alert').remove();
        }).prop('checked', false);
        </script>

        <!-- jQuery -->
        <script src="../assets/vendors/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <!-- FastClick -->
        <script src="../assets/vendors/fastclick/lib/fastclick.js"></script>
        <!-- NProgress -->
        <script src="../assets/vendors/nprogress/nprogress.js"></script>
        <!-- validator -->
        <!-- <script src="../assets/vendors/validator/validator.js"></script> -->

        <!-- Custom Theme Scripts -->
        <script src="../assets/build/js/custom.min.js"></script>

</body>

</html>
