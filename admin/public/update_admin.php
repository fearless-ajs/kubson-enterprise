<?php require_once("../includes/Helpers/initialize.php"); ?>


<?php
//makes sure we get an id
if(empty($_GET['key'])){
    $_POST['msg'] = "No Staff was provided";
    $message = $_POST['msg'];
    //redirect_to('ward_list');
}

//find the photo with the provided id
$staff = User::find_by_id($_GET['key']);
if(!$staff){
    $_POST['msg'] = "Admin not Found";
    $message = $_POST['msg'];
    //redirect_to('index.php');
}

//update ward
//initialising the user class for registration
$new_staff = new UserControl();
//Object of the class user that controls error messages
$message = $new_staff->message;


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
                            Update Admin Information
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" action="update_admin.php?key=<?php echo $_GET['key']; ?>" method="post">
                                 <div class="form-group">
                                         <label for="exampleInputPassword1">Admin's ID</label>
                                         <input type="text"disabled="disabled" value = "<?php echo $staff->id; ?>" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                         <label for="exampleInputPassword1">Admin's Name</label>
                                        <input type="text" value = "<?php echo $staff->fullname; ?>"  name="name" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email</label>
                                        <input type="email" name="email" value = "<?php echo $staff->email; ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                                    </div>
                                   <div class="form-group">
                                        <label for="exampleInputEmail1">Password</label>
                                        <input type="text" name="password" value = "<?php echo $staff->password; ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <button type="submit" class="btn btn-success" name="update">Save</button>

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


