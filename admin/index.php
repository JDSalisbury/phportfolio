<?php include 'includes/admin_header.php'; ?>
    <div id="wrapper">



        <!-- Navigation -->
        <?php include 'includes/admin_nav.php'; ?>


        <div id="page-wrapper">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            ADMIN PAGE
                            <small>WELCOME <?php echo $_SESSION['username'] ?></small>

                        </h1>
                            <?php if($connection) echo "connected"; ?>
                        
                    </div>
                </div>
                <!-- /.row -->
                <?php include 'includes/admin_dash.php'; ?>

            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->



    </div>
    <!-- /#wrapper -->
<?php include 'includes/admin_footer.php'; ?>
