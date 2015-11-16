<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <!-- Head -->
    <head>
        <meta charset="utf-8" />
        <title>Dashboard</title>

        <meta name="description" content="Dashboard" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/favicon.png" type="image/x-icon">

            <script type="text/javascript">
                var SITE_URL = "<?php echo site_url(); ?>";
                var BASE_URL = "<?php echo base_url(); ?>";
            </script>
            <!--Basic Styles-->
            <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" />
            <link id="bootstrap-rtl-link" href="<?php echo site_url(); ?>" rel="stylesheet" />
            <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet" />
            <link href="<?php echo base_url(); ?>assets/css/weather-icons.min.css" rel="stylesheet" />

            <!--Fonts-->
            <!-- <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300" rel="stylesheet" type="text/css">
                 <link href='http://fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'> -->
            <!--Beyond styles-->
            <link id="beyond-link" href="<?php echo base_url(); ?>assets/css/beyond.min.css" rel="stylesheet" type="text/css" />
            <link href="<?php echo base_url(); ?>assets/css/demo.min.css" rel="stylesheet" />
            <link href="<?php echo base_url(); ?>assets/css/typicons.min.css" rel="stylesheet" />
            <link href="<?php echo base_url(); ?>assets/css/animate.min.css" rel="stylesheet" />
            <link id="skin-link" href="<?php echo site_url(); ?>" rel="stylesheet" type="text/css" />

            <!--Skin Script: Place this script in head to load scripts for skins and rtl support-->
            <script src="<?php echo base_url(); ?>assets/js/skins.min.js"></script>
    </head>
    <!-- /Head -->
    <!-- Body -->
    <body>

        <!-- Loading Container -->
        <div class="loading-container">
            <div class="loader"></div>
        </div>
        <!--  /Loading Container -->


        <?php
        include 'navigation.php';
        ?>


        <!-- Main Container -->
        <div class="main-container container-fluid">
            <!-- Page Container -->
            <div class="page-container">
                <?php
                include 'leftmenu.php';
                ?>


                <!-- Page Content -->
                <div class="page-content">
                    <!-- Page Breadcrumb -->
                    <div class="page-breadcrumbs">
                        <ul class="breadcrumb">
                            <li>
                                <i class="fa fa-home"></i>
                                <a href="index.html#">Home</a>
                            </li>
                            <li class="active">Dashboard</li>
                        </ul>
                    </div>
                    <!-- /Page Breadcrumb -->
                    <!-- Page Header -->
                    <div class="page-header position-relative">
                        <div class="header-title">
                            <h1>
                                Dashboard
                            </h1>
                        </div>
                        <!--Header Buttons-->

                        <!--Header Buttons End-->
                    </div>
                    <!-- /Page Header -->
                    <!-- Page Body -->
                    <div class="page-body">
                        <?php
                            include 'home.php';
                        ?>

                    </div>
                    <!-- /Page Body -->
                </div>
                <!-- /Page Content -->








            </div>
            <!-- /Page Container -->
            <!-- Main Container -->
        </div>


        <!--Basic Scripts-->
        <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/slimscroll/jquery.slimscroll.min.js"></script>

        <!--Beyond Scripts-->
        <script src="<?php echo base_url(); ?>assets/js/beyond.js"></script>



    </body>
    <!--  /Body -->
</html>