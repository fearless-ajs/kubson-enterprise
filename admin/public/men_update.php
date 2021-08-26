<?php require_once("../includes/Helpers/initialize.php"); ?>


<?php
//update ward
//initialising the user class for registration
$new_item = new MenControl();
//Object of the class user that controls error messages
$message = $new_item->message;

//Deleting Ward
if($new_item->deleteItem()){
redirect_to('men_list.php');
}
//makes sure we get an id
if(empty($_GET['key'])){
    $_POST['msg'] = "No Product was provided";
    $message = $_POST['msg'];
    redirect_to('men_list.php');
}

//find the photo with the provided id
$item = Men::find_by_id($_GET['key']);
if(!$item){
    $_POST['msg'] = "the Product could not be located";
    $message = $_POST['msg'];
    redirect_to('index.php');
}



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
                           <?php echo $item->name; ?>'s  Information
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" action="men_update.php?del_key=<?php echo $_GET['key']; ?>" method="post">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Product Id</label>
                                        <input type="text" disabled="disabled" value = "<?php echo $item->id; ?>"  name="doctor_id" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Product Name</label>
                                        <input type="text" disabled="disabled" value = "<?php echo $item->name; ?>"  name="name" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Product Size</label>
                                        <input type="text" disabled="disabled" value = "<?php echo $item->size; ?>"  name="name" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Price</label>
                                        <input type="text" disabled="disabled" name="f_name" value = "#<?php echo $item->price; ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Category</label>
                                        <input type="text" disabled="disabled" value = "<?php echo $item->category; ?>"  class="form-control" id="exampleInputPassword1" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Stock Date</label>
                                        <input type="text" disabled="disabled" value = "<?php echo $item->stock_date; ?>"  class="form-control" id="exampleInputPassword1" placeholder="Password">
                                    </div>
                                    <hr>
                                    <h3>Other Information About The Product</h3>
                                    <hr>
                                    <div class="form-group">
                                         <label for="exampleInputPassword1"  style="color: #4f57f1;">Description</label>
                                        <div style="
                                             border: 1px solid black;
                                             border-width: 0px 0px 1px 0px;
                                             width: 100%;
                                             padding: 5px;
                                             text-align: justify;
                                             ">
                                            <p><?php echo $item->description; ?></p>
                                        </div>
                                       
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1" style="color: #4f57f1;">Admin Review</label>
                                        <div style="
                                             border: 1px solid black;
                                             border-width: 0px 0px 1px 0px;
                                             width: 100%;
                                             padding: 5px;
                                             text-align: justify;
                                             ">
                                            <p><?php echo $item->review; ?></p>
                                        </div>

                                    <hr>
                                    <h3> Product Images</h3>
                                    <hr>

		<h2 class="w3ls_head">Gallery</h2>
		
				<div class="gallery-top-grids">
					<div class="col-sm-6 gallery-grids-left">
						<div class="gallery-grid">
							<a class="example-image-link" href="<?php echo $item->full_view; ?>" data-lightbox="example-set" data-title="The full view of <?php echo $item->name; ?> in stock">
								<img src="<?php echo $item->full_view; ?>" alt="" />
								<div class="captn">
									<h4>Full View</h4>
									<p>View Fullscreen</p>
								</div>
							</a>
						</div>
					</div>
					<div class="col-sm-6 gallery-grids-left">
						<div class="gallery-grid">
							<a class="example-image-link" href="<?php echo $item->front_view; ?>" data-lightbox="example-set" data-title="The front view of <?php echo $item->name; ?> in stock">
								<img src="<?php echo $item->front_view; ?>" alt="" />
								<div class="captn">
									<h4>Front View</h4>
									<p>View Fullscreen</p>
								</div>
							</a>
						</div>
					</div>
					
				
				<div class="gallery-top-grids">
					
					
					
					<div class="clearfix"> </div>
				</div>
				
					<div class="col-sm-6 gallery-grids-left">
						<div class="gallery-grid">
							<a class="example-image-link" href="<?php echo $item->back_view; ?>" data-lightbox="example-set" data-title="The back view of <?php echo $item->name; ?> in stock">
								<img src="<?php echo $item->back_view; ?>" alt="" />
								<div class="captn">
									<h4>Back View</h4>
									<p>View Fullscreen</p>
								</div>
							</a>
						</div>
					</div>
					<div class="col-sm-6 gallery-grids-left">
						<div class="gallery-grid">
							<a class="example-image-link" href="<?php echo $item->side_view; ?>" data-lightbox="example-set" data-title="The side view of <?php echo $item->name; ?> in stock">
								<img src="<?php echo $item->side_view; ?>" alt="" />
								<div class="captn">
									<h4>Side View</h4>
									<p>View Fullscreen</p>
								</div>
							</a>
						</div>
					</div>
					
					<div class="clearfix"> </div>
				
				<div class="clearfix"> </div>
				<script src="js/lightbox-plus-jquery.min.js"> </script>
		
	
	</div>
                                  
                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <a class="btn btn-danger"href="men_update.php?del_key=<?php echo $item->id;?>">Delete this product from stock</a>

                                        </div>
                                    </div>

                                </form
                                 
                            </div>

                        </div>





                    </section>

                </div>

            </div>
            <!-- page end-->
        </div>
    </section>



    <?php include_layout_template("footer.php"); ?>


