<?php require_once("../includes/Helpers/initialize.php"); ?>


<?php
//$login_user = new LoginControl();
//$login_user->is_not_Logged_in();

//initialising the user class for registration
$new_women = new WomenControl();
//Object of the class user that controls error messages
$message = $new_women->message;
//Those are the codes need on this page

?>

<?php if(!empty($message)){ ?>
    <script type="text/javascript">
        alert("<?php echo $message; ?>");
    </script>
<?php  } ?>

<?php  include_layout_template("header.php"); ?>
<?php  include_layout_template("sidebar.php"); ?>
<section id="main-content">
    <section class="wrapper">



        <!-- The form section-->
        <div class="form-w3layouts">
            <!-- page start-->
            <!-- page start-->
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Add New Product For Women
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" action="add_women.php" enctype="multipart/form-data" method="post">
                                   
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Product Name</label>
                                        <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Product Size</label>
                                        <input type="number" name="size" class="form-control" id="exampleInputEmail1" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Price</label>
                                        <input type="number" name="price" class="form-control" id="exampleInputEmail1" placeholder="">
                                    </div>
                                     <div class="form-group">
                                        <label for="exampleInputPassword1">Category</label>
                                        <select class="form-control m-bot15" name="category">
                                            <option value="Clothes">Clothes</option>
                                            <option value="Shoes">Shoes</option>
                                            <option value="Bags">Bags</option>
                                           <option value="Watches">Watches</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Description</label>
                                        <textarea name="description" class="form-control"></textarea>
                                    </div>
                                     <div class="form-group">
                                        <label for="exampleInputPassword1">Admin Review</label>
                                        <textarea name="review" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Full View Image</label>
                                        <input type="file" name="full_view_file" class="form-control" placeholder="Picture">
                                    </div> 
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Front View Image</label>
                                        <input type="file" name="front_view_file" class="form-control" placeholder="Picture">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Back View Image</label>
                                         <input type="file" name="back_view_file" class="form-control" placeholder="Picture">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Side View Image</label>
                                         <input type="file" name="side_view_file" class="form-control" placeholder="Picture">
                                    </div>
                                   
                                   
                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <button type="submit" name="submit" class="btn btn-success">Publish Product</button>

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

