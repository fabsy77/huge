<!doctype html>
<html>
<head>
    <title>DeRoupas</title>
    <!-- META -->
    <meta charset="utf-8">
    <!-- send empty favicon fallback to prevent user's browser hitting the server for lots of favicon requests resulting in 404s -->

    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo Config::get('URL'); ?>css/style.css" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
  
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>  


<script>
    $(document).ready(function () {
    $('#query_table').DataTable();
    } );
</script>
   <style>
    .logo2 {
    width: 352px;
    height: 350px;
    border-radius: 50%;
    background-image: url("<?= Config::get('URL');?>productImages/DeRoupasLogo.jpg");
    margin: auto;
    }
    </style>
</head>
<body>

    <!-- wrapper, to center website -->
    <div class="wrapper">
        <!-- logo -->
        <div class="logo2"></div>

        <!-- navigation -->
        <ul class="navigation" style="z-index: 20;" >
            <?php if (Session::userIsLoggedIn()) { ?>
                <li <?php if (View::checkForActiveController($filename, "index")) { echo ' class="active" '; } ?> >
                <a href="<?php echo Config::get('URL'); ?>index/index">Startseite</a>
                </li>
                <li <?php if (View::checkForActiveController($filename, "product")) { echo ' class="active" '; } ?> >
                    <a href="<?php echo Config::get('URL'); ?>product/index">Produkte</a>
            </li>
             <!-- comentar -->
             <?php if (Session::get("user_account_type") != 7) : ?>
            <li <?php if (View::checkForActiveControllerAndAction($filename, "productCart/index")) { echo ' class="active" '; } ?> >
                    <a class="notification" href="<?php echo Config::get('URL'); ?>productCart">
                        <span>Cart</span>
                        <span class="badge"></span>
                    </a>
            </li>
            <?php endif; ?>
            
            <?php } else { ?>
                <!-- for not logged in users -->
                <li <?php if (View::checkForActiveController($filename, "index")) { echo ' class="active" '; } ?> >
                <a href="<?php echo Config::get('URL'); ?>index/index">Startseite</a>
            </li>
            </li>
                <li <?php if (View::checkForActiveController($filename, "product")) { echo ' class="active" '; } ?> >
                    <a href="<?php echo Config::get('URL'); ?>product/index">Produkte</a>
            </li>
                
            </li>
            <?php } ?>
        </ul>

        <!-- my account -->
        <ul class="navigation right">
        <?php if (Session::userIsLoggedIn()) : ?>
            <li <?php if (View::checkForActiveController($filename, "user")) { echo ' class="active" '; } ?> >
                <a href="<?php echo Config::get('URL'); ?>user/index">My Account</a>
                <ul class="navigation-submenu" style="z-index: 20;">
                     <?php if (Session::get("user_account_type") == 7) : ?>
                        <li <?php if (View::checkForActiveController($filename, "admin")) {echo ' class="active" '; } ?> >
                            <a href="<?php echo Config::get('URL'); ?>admin/">Admin</a>
                        </li>
                        <li <?php if (View::checkForActiveController($filename, "user")) { echo ' class="active" '; } ?> >
                            <a href="<?php echo Config::get('URL'); ?>productStatistic/index">Product Statistics</a>
                        </li>
                        <li <?php if (View::checkForActiveController($filename, "productAdm")) { echo ' class="active" '; } ?> >
                            <a href="<?php echo Config::get('URL'); ?>productAdm/index">Product Adm</a>
                        </li>

                    <?php endif; ?>
                    <li <?php if (View::checkForActiveController($filename, "index")) { echo ' class="active" '; } ?> >
                    <a href="<?php echo Config::get('URL'); ?>orderOverview/index">Order Overview</a>
                    </li>
                    <!--<li <?php if (View::checkForActiveController($filename, "user")) { echo ' class="active" '; } ?> >
                        <a href="<?php echo Config::get('URL'); ?>user/edituseremail">Edit my email</a>
                    </li> -->
                    <li <?php if (View::checkForActiveController($filename, "user")) { echo ' class="active" '; } ?> >
                        <a href="<?php echo Config::get('URL'); ?>user/changePassword">Change Password</a>
                    </li>
                    <li <?php if (View::checkForActiveController($filename, "login")) { echo ' class="active" '; } ?> >
                        <a href="<?php echo Config::get('URL'); ?>login/logout">Logout</a>
                    </li>
                </ul>
            </li>
        <?php endif; ?>
        <?php if(!Session::userIsLoggedIn()) { ?>
            <li <?php if (View::checkForActiveControllerAndAction($filename, "register/index")) { echo ' class="active" '; } ?> >
                    <a href="<?php echo Config::get('URL'); ?>register/index">Register</a>
                </li>
            <li <?php if (View::checkForActiveControllerAndAction($filename, "login/index")) { echo ' class="active" '; } ?> >
                    <a href="<?php echo Config::get('URL'); ?>login/index">Login</a>
                </li>
            <?php }?>
        </ul>