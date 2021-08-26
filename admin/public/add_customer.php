<?php require_once("../includes/Helpers/initialize.php"); ?>


<?php
//$login_user = new LoginControl();
//$login_user->is_not_Logged_in();

//initialising the user class for registration
$new_doctor = new CustomersControl();
//Object of the class user that controls error messages
$message = $new_doctor->message;
//Those are the codes need on this page

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
                            Add New Customer
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" action="add_customer.php" method="post">
                                 
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Full Name</label>
                                        <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email</label>
                                        <input type="text" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Phone Number</label>
                                        <input type="text" name="phone" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                    </div>
                                  <div class="form-group">
                                        <label for="exampleInputPassword1">Password</label>
                                        <input type="text" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <button type="submit" name="submit" class="btn btn-success">Submit</button>

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


