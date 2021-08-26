     <!--header -->
<?php

require_once("../includes/Helpers/initialize.php");


?>
<?php
$metadata = '#'; 
include_layout_template("header.php", "Home", "$metadata");   

?>
     <?php
         //checking if the user is logged in with the constructor
            
            $login_user = new LoginControl();
           // $login_user->is_Logged_in();
            
            //login the user if the form is posted
            //$login_user->loginUser($email="", $password="");
           // $message = $login_user->message;
          
               //initialising the user class for registration
   $new_user = new UserControl();
  
   //Object of the class user that controls error messages
   $message = $new_user->message;
?>
   
  <?php if(isset($_POST['msg'])){ ?>
        <script type="text/javascript">
        alert("<?php echo $message = $_POST['msg']; ?>")
        </script>
 <?php } ?>
<?php if(isset($_GET['msg'])){ ?>
        <script type="text/javascript">
        alert("<?php echo $message = $_GET['msg']; ?>")
        </script>
 <?php } ?>        
         <?php if(!empty($message)){ ?>
        <script type="text/javascript">
            alert("<?php echo $message; ?>");
        </script>
 <?php  } ?>
<?php     
/*******************Women Materias*****************************/
//Activating our pagination system
//1. The current page number($current_page)
$page = !empty($_GET['page']) ? (int)$_GET['page']: 1;


//2. Records per page($per_page)
$per_page = 4;


//3. total record count ($total_count)
$total_count = Women::count_all();

//Find all photos
//use pagination instead
//$photos = Photograph::find_all();

$pagination = new Pagination($page, $per_page, $total_count);
//instead of finding all records, just find the record
//for this page
$sql  = "SELECT * FROM women ";
$sql .= "LIMIT {$per_page} ";
$sql .= "OFFSET {$pagination->offset()}";
$items = Women::find_by_sql($sql);

//Need to add ?page=$page to all links we want to
//maintain the current page (or store $page in session)
/*********************END***************************************/


/*******************Men Materials*****************************/
//Activating our pagination system
//1. The current page number($current_page)
$men_page = !empty($_GET['men_page']) ? (int)$_GET['men_page']: 1;


//2. Records per page($per_page)
$men_per_page = 4;


//3. total record count ($total_count)
$men_total_count = Men::count_all();

//Find all photos
//use pagination instead
//$photos = Photograph::find_all();

$men_pagination = new Pagination($men_page, $men_per_page, $men_total_count);
//instead of finding all records, just find the record
//for this page
$men_sql  = "SELECT * FROM men ";
$men_sql .= "LIMIT {$men_per_page} ";
$men_sql .= "OFFSET {$men_pagination->offset()}";
$men_items = Men::find_by_sql($men_sql);

//Need to add ?page=$page to all links we want to
//maintain the current page (or store $page in session)
/*********************END***************************************/



/*******************recently ordered Materials*****************************/
//Activating our pagination system
//1. The current page number($current_page)
$order_page = !empty($_GET['order_page']) ? (int)$_GET['order_page']: 1;


//2. Records per page($per_page)
$order_per_page = 2;


//3. total record count ($total_count)
$order_total_count = Men::count_all();

//Find all photos
//use pagination instead
//$photos = Photograph::find_all();

$order_pagination = new Pagination($order_page, $order_per_page, $order_total_count);
//instead of finding all records, just find the record
//for this page
$order_sql  = "SELECT * FROM men WHERE category = 'Bags' ";
$order_sql .= "LIMIT {$order_per_page} ";
$order_sql .= "OFFSET {$order_pagination->offset()}";
$order_items = Men::find_by_sql($order_sql);

//Need to add ?page=$page to all links we want to
//maintain the current page (or store $page in session)
/*********************END***************************************/

?>
     
     
<!-- //banner-top -->
<!-- banner -->
<div class="banner-grid">
	<div id="visual">
			<div class="slide-visual">
				<!-- Slide Image Area (1000 x 424) -->
				<ul class="slide-group">
					<li><img class="img-responsive" src="images/b1.jpg" alt="Dummy Image" /></li>
                                        <li><img class="img-responsive" src="images/3.jpg" alt="Dummy Image" /></li>
					<li><img class="img-responsive" src="images/ba3.jpg" alt="Dummy Image" /></li>
                                        <li><img class="img-responsive" src="images/1.jpg" alt="Dummy Image" /></li>
					
				</ul>

				<!-- Slide Description Image Area (316 x 328) -->
				<div class="script-wrap">
					<ul class="script-group">
						<li><div class="inner-script"><img class="img-responsive" src="images/baa1.jpg" alt="Dummy Image" /></div></li>
                                                
						<li><div class="inner-script"><img class="img-responsive" src="images/baa2.jpg" alt="Dummy Image" /></div></li>
						<li><div class="inner-script"><img class="img-responsive" src="images/baa3.jpg" alt="Dummy Image" /></div></li>
					</ul>
					<div class="slide-controller">
						<a href="#" class="btn-prev"><img src="images/btn_prev.png" alt="Prev Slide" /></a>
						<a href="#" class="btn-play"><img src="images/btn_play.png" alt="Start Slide" /></a>
						<a href="#" class="btn-pause"><img src="images/btn_pause.png" alt="Pause Slide" /></a>
						<a href="#" class="btn-next"><img src="images/btn_next.png" alt="Next Slide" /></a>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div>
		</div>
	<script type="text/javascript" src="js/pignose.layerslider.js"></script>
	<script type="text/javascript">
	//<![CDATA[
		$(window).load(function() {
			$('#visual').pignoseLayerSlider({
				play    : '.btn-play',
				pause   : '.btn-pause',
				next    : '.btn-next',
				prev    : '.btn-prev'
			});
		});
	//]]>
	</script>

</div>
<!-- //banner -->
<!-- content -->


<div class="new_arrivals">
	<div class="container">
            <h3><span style="color: #3b5998;">new </span>arrivals</h3>
		<p>Navigate and Access our latest items and products for quick and effective choice making...</p>
		<div class="new_grids">
			<div class="col-md-4 new-gd-left">
                            <img src="images/tp5.jpg" alt=" " />
				<div class="wed-brand simpleCart_shelfItem">
					<h4>Women Collections</h4>
					<h5>Flat 20% Discount</h5>
                                        <p><i>#50000</i> <span class="item_price">#25000</span><a class="item_add hvr-outline-out button2" href="women_wears.php">Shop Items </a></p>
				</div>
			</div>
			<div class="col-md-4 new-gd-middle">
				<div class="new-levis">
                                    <div class="mid-img" style="background-color: #cc0000; width: 30%; 
                                         height: 40px;
                                         border-radius: 20px 0px 0px 0px;
                                         ">
                                        <p style="color: white; margin-top: 8px;">Women</p>
					</div>
					<div class="mid-text">
						<h4>up to 40% <span>off</span></h4>
                                                <a class="hvr-outline-out button2" href="women_wears.php">Shop now </a>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="new-levis">
					<div class="mid-text">
						<h4>up to 30% <span>off</span></h4>
                                                <a class="hvr-outline-out button2" href="men_wears.php">Shop now </a>
					</div>
                                    <div class="mid-img" style="background-color: #003399; ; 
                                         height: 40px;
                                         border-radius: 20px 0px 0px 0px;
                                         padding: 10px;
                                         ">
                                        <a href="men_wears.php"> <p style="color: white;">Men Wears</p></a>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="col-md-4 new-gd-left">
				<img src="images/wed2.jpg" alt=" " />
				<div class="wed-brandtwo simpleCart_shelfItem">
					<h4>Corporate Dresses</h4>
					<p>Shop Men</p>
                                        <div class="mid-text">
						<h4> 40% <span>off</span></h4>
                                                <a class="hvr-outline-out button2" href="men_wears.php">Shop now </a>
					</div>
				</div>
                                
			</div>
                    
			<div class="clearfix"></div>
		</div>
	</div>
</div>
<!-- //content -->

<!-- content-bottom -->

<div class="content-bottom">
	<div class="col-md-7 content-lgrid">
		<div class="col-sm-6 content-img-left text-center">
			<div class="content-grid-effect slow-zoom vertical">
                            <div class="img-box"><img src="images/new3.jpg" alt="image" class="img-responsive zoom-img"></div>
					<div class="info-box">
						<div class="info-content simpleCart_shelfItem">
									<h4 style="color: white;">Quality Bags</h4>
									<span class="separator"></span>
									<p><span class="item_price">#4000</span></p>
									<span class="separator"></span>
                                                                        <a class=" hvr-outline-out button2" href="men_wears.php">Chech it out </a>
						</div>
					</div>
			</div>
		</div>
		<div class="col-sm-6 content-img-right">
			<h3>Special Offers and 50%<span style="color: #3b5998;">Discount For</span> Customers</h3>
		</div>
		
		<div class="col-sm-6 content-img-right">
			<h3>Buy 1 get 1  free on <span style="color: #3b5998;"> Branded</span> Watches</h3>
		</div>
		<div class="col-sm-6 content-img-left text-center">
			<div class="content-grid-effect slow-zoom vertical">
				<div class="img-box"><img src="images/p2.jpg" alt="image" class="img-responsive zoom-img"></div>
					<div class="info-box">
						<div class="info-content simpleCart_shelfItem">
							<h4>Watches</h4>
							<span class="separator"></span>
							<p><span class="item_price">#2500</span></p>
							<span class="separator"></span>
                                                        <a class="hvr-outline-out button2" href="men_wears.php">Chech it out </a>
						</div>
					</div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="col-md-5 content-rgrid text-center">
		<div class="content-grid-effect slow-zoom vertical">
				<div class="img-box"><img src="images/p4.jpg" alt="image" class="img-responsive zoom-img"></div>
					<div class="info-box">
						<div class="info-content simpleCart_shelfItem">
									<h4 style="color:white;">Shoes</h4>
									<span class="separator"></span>
									<p><span class="item_price">#5000</span></p>
									<span class="separator"></span>
                                                                        <a class="hvr-outline-out button2" href="women_wears.php">Chech it out </a>
						</div>
					</div>
			</div>
	</div>
	<div class="clearfix"></div>
</div>
<!-- //content-bottom -->
<!-- product-nav -->

<div class="product-easy">
	<div class="container">
		
		<script src="js/easyResponsiveTabs.js" type="text/javascript"></script>
		<script type="text/javascript">
							$(document).ready(function () {
								$('#horizontalTab').easyResponsiveTabs({
									type: 'default', //Types: default, vertical, accordion           
									width: 'auto', //auto or any width like 600px
									fit: true   // 100% fit in a container
								});
							});
							
		</script>

	</div>
</div>
<!-- //product-nav -->

<div class="coupons">
	<div class="container">
		<div class="coupons-grids text-center">
			<div class="col-md-3 coupons-gd">
				<h3 style="color: white;">Buy your product in a simple way</h3>
			</div>
			<div class="col-md-3 coupons-gd">
				<span class="glyphicon glyphicon-user" aria-hidden="true" href="#" data-toggle="modal" data-target="#myModal4" style="background-color: #3b5998;"></span>
				<h4>LOGIN TO YOUR ACCOUNT</h4>
				<p>Log in to our Enterprise system with your registered credentials
			to access our products.</p>
			</div>
			<div class="col-md-3 coupons-gd">
				<span class="glyphicon glyphicon-ok" aria-hidden="true" style="background-color: #3b5998;"></span>
				<h4>SELECT YOUR ITEM</h4>
				<p>Select the item/product you want from the item list for adding to cart.</p>
			</div>
			<div class="col-md-3 coupons-gd">
				<span class="glyphicon glyphicon-credit-card" aria-hidden="true" style="background-color: #3b5998;"></span>
				<h4>MAKE PAYMENT</h4>
				<p>Make payment with our easy payment method  and delivery to be made within a short period.</p>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
</div>




<!-- footer -->
<?php include_layout_template("footer.php"); ?>