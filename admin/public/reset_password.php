<?php require_once("../includes/Helpers/initialize.php"); ?>


<?php



//update ward
//initialising the user class for registration
$new_user = new UserControl();
//Object of the class user that controls error messages
$message = $new_user->message;


?>

<?php if(!empty($message)){ ?>
    <script type="text/javascript">
        alert("<?php echo $message; ?>");
    </script>
<?php  } ?>

<?php  include_layout_template("header.php"); ?>
<?php  include_layout_template("sidebar.php"); ?>
<section id="main-content" style="background-image: url(images/sp2.jpg); background-repeat: no-repeat; background-size: cover;">
    <section class="wrapper">



        <!-- The form section-->
        <div class="form-w3layouts">
            <!-- page start-->
            <!-- page start-->
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Reset Password
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" action="reset_password.php" method="post">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email</label>
                                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter Your Email">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Old Password</label>
                                        <input type="password" name="old_password" class="form-control" id="exampleInputPassword1" placeholder="Old Password">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Choose New Password</label>
                                        <input type="password" name="new_password" class="form-control" id="exampleInputPassword1" placeholder="Choose New Password">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Confirm Password</label>
                                        <input type="password" name="v_password" class="form-control" id="exampleInputPassword1" placeholder="Confirm password">
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <button type="submit" class="btn btn-success" name="reset">Reset Password</button>

                                        </div>
                                    </div>

                                </form>
                            </div>

                        </div>





                    </section>

                </div>

            </div>
            <!-- page end-->
        </div>
    </section>



    <?php include_layout_template("footer.php"); ?>

