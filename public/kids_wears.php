<?php require_once("../includes/Helpers/initialize.php"); ?>
<?php
$metadata = '#'; 
include_layout_template("header.php", "Home", "$metadata");

/*******************Men Shoes*****************************/
//Activating our pagination system
//1. The current page number($current_page)
$page = !empty($_GET['page']) ? (int)$_GET['page']: 1;


//2. Records per page($per_page)
$per_page = 4;


//3. total record count ($total_count)
$total_count = Kids::count_men_by_cat("Shoes");

//Find all photos
//use pagination instead
//$photos = Photograph::find_all();

$pagination = new Pagination($page, $per_page, $total_count);
//instead of finding all records, just find the record
//for this page
$sql  = "SELECT * FROM kids WHERE category = 'Shoes' ";
$sql .= "LIMIT {$per_page} ";
$sql .= "OFFSET {$pagination->offset()}";
$items = Kids::find_by_sql($sql);

//Need to add ?page=$page to all links we want to
//maintain the current page (or store $page in session)
/*********************END***************************************/


/*******************Men Clothes*****************************/
//Activating our pagination system
//1. The current page number($current_page)
$cloth_page = !empty($_GET['cloth_page']) ? (int)$_GET['cloth_page']: 1;


//2. Records per page($per_page)
$cloth_per_page = 4;


//3. total record count ($total_count)
$cloth_total_count = Kids::count_men_by_cat("Clothes");

//Find all photos
//use pagination instead
//$photos = Photograph::find_all();

$cloth_pagination = new Pagination($cloth_page, $cloth_per_page, $cloth_total_count);
//instead of finding all records, just find the record
//for this page
$cloth_sql  = "SELECT * FROM kids WHERE category = 'Clothes' ";
$cloth_sql .= "LIMIT {$cloth_per_page} ";
$cloth_sql .= "OFFSET {$cloth_pagination->offset()}";
$Cloth_items = Kids::find_by_sql($cloth_sql);

//Need to add ?page=$page to all links we want to
//maintain the current page (or store $page in session)
/*********************END***************************************/



/*******************Men Bags*****************************/
//Activating our pagination system
//1. The current page number($current_page)
$bags_page = !empty($_GET['bags_page']) ? (int)$_GET['bags_page']: 1;


//2. Records per page($per_page)
$bags_per_page = 2;


//3. total record count ($total_count)
$bags_total_count = Kids::count_men_by_cat("Bags");

//Find all photos
//use pagination instead
//$photos = Photograph::find_all();

$bags_pagination = new Pagination($bags_page, $bags_per_page, $bags_total_count);
//instead of finding all records, just find the record
//for this page
$bags_sql  = "SELECT * FROM kids WHERE category = 'Bags' ";
$bags_sql .= "LIMIT {$cloth_per_page} ";
$bags_sql .= "OFFSET {$cloth_pagination->offset()}";
$bags_items = Kids::find_by_sql($bags_sql);

//Need to add ?page=$page to all links we want to
//maintain the current page (or store $page in session)
/*********************END***************************************/



/*******************Men Watches*****************************/
//Activating our pagination system
//1. The current page number($current_page)
$watches_page = !empty($_GET['watches_page']) ? (int)$_GET['watches_page']: 1;


//2. Records per page($per_page)
$watches_per_page = 2;


//3. total record count ($total_count)
$watches_total_count = Kids::count_men_by_cat("Watches");

//Find all photos
//use pagination instead
//$photos = Photograph::find_all();

$watches_pagination = new Pagination($watches_page, $watches_per_page, $watches_total_count);
//instead of finding all records, just find the record
//for this page
$watches_sql  = "SELECT * FROM kids WHERE category = 'Watches' ";
$watches_sql .= "LIMIT {$watches_per_page} ";
$watches_sql .= "OFFSET {$watches_pagination->offset()}";
$watches_items = Kids::find_by_sql($watches_sql);

//Need to add ?page=$page to all links we want to
//maintain the current page (or store $page in session)
/*********************END***************************************/
/***********CARTING CLASS********************************/
   //initialising the user class for registration
   $new_cart = new CartControl();
   
   //Object of the class user that controls error messages
   $message = $new_cart->message;


/*******************************************************/

?>
 <?php if(!empty($message)){ ?>
        <script type="text/javascript">
            alert("<?php echo $message; ?>");
        </script>
 <?php  } ?>
<div class="page-head">
	<div class="container">
            <h3 style="color: white;">Kids Wears</h3>
	</div>
</div>

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
		<div class="sap_tabs">
			<div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
				<ul class="resp-tabs-list">
					<li class="resp-tab-item" aria-controls="tab_item-0" role="tab" style="border-color: #3b5998;"><span>Kids Shoes</span></li> 
					<li class="resp-tab-item" aria-controls="tab_item-1" role="tab"><span>Kids Clothes</span></li> 
					<li class="resp-tab-item" aria-controls="tab_item-2" role="tab"><span>Kids Bags</span></li> 
                                        <li class="resp-tab-item" aria-controls="tab_item-2" role="tab"><span>Kids Watches</span></li> 
				</ul>				  	 
				<div class="resp-tabs-container">
					<div class="tab-1 resp-tab-content" aria-labelledby="tab_item-0">
						  <?php foreach ($items as $item): ?>
                                                  <?php 
                                                  //parameters for carting
                                                  $productId = $item->id;
                                                  $productName = $item->name;
                                                  $productSize = $item->size;
                                                  $quantity   = 1;
                                                  $productPrice = $item->price;
                                                  $productImage = $item->full_view;
                                                  
                                                  ?>
						<div class="col-md-3 product-men yes-marg">
							<div class="men-pro-item simpleCart_shelfItem">
								<div class="men-thumb-item">
                                                                    <img src="../admin/public/<?php echo $item->front_view; ?>" alt="" class="pro-image-front">
									<img src="../admin/public/<?php echo $item->back_view; ?>" alt="" class="pro-image-back">
										<div class="men-cart-pro">
											<div class="inner-men-cart-pro">
                                                                                            <a href="view_kids.php?key=<?php echo $item->id; ?>" class="link-product-add-cart">Quick View</a>
											</div>
										</div>
										<span class="product-new-top">New</span>
                                                                                <div>
                                                                                    <p style="text-align: center;
                                                                                       color: #3b4590;
                                                                                       font-weight: bold;
                                                                                       ">Size</p>
                                                                                       <p style="text-align: center;
                                                                                   background-color: #f08d00;
                                                                                   color: white;
                                                                                   font-weight: normal;
                                                                                   height: 40px;
                                                                                   width:   40px;
                                                                                   margin: auto;
                                                                                   padding-top: 10px;
                                                                                   border-radius: 50px;
                                                                                   "><?php echo $item->size; ?></p>
                   
                                                                                   </div>
										
								</div>
								<div class="item-info-product ">
                                                                    <h4><a style="color: #3b5998;" href="view_kids.php?key=<?php echo $item->id; ?>"><?php echo $item->name; ?></a></h4>
									<div class="info-product-price">
										<span class="item_price">#<?php echo $item->price; ?></span>
										<del>#<?php echo $item->price + 3000; ?></del>
									</div>
                                                                        <a href="kids_wears.php?cartId=<?php echo $productId; ?>&&cartName=<?php echo $productName; ?>&&cartSize=<?php echo $productSize; ?>&&cartQuantity=<?php echo $quantity; ?>&&cartPrice=<?php echo $productPrice; ?>&&cartImage=../admin/public/<?php echo $productImage; ?>" class="item_add single-item hvr-outline-out button2">Add to cart</a>									
								</div>
							</div>
						</div>
                                           
                                            <?php endforeach; ?>
                                         
						<div class="clearfix"></div>
                                                    <div id="pagination" style="clear: both; ">
                        <?php
                        if($pagination->total_pages() > 1){

                            if($pagination->has_prevoius_page()){
                                echo "<a href=\"kids_wears.php?page=";
                                echo $pagination->previous_page();
                                echo "\">&laquo; Previous</a> ";
                            }

                            for($i=1; $i <= $pagination->total_pages(); $i++){
                                if($i == $page){
                                    echo " <span class=\"selected\">{$i}</span> ";
                                } else {
                                    echo " <a href=\"kids_wears.php.?page={$i}\">{$i}</a> ";
                                }

                            }

                            if($pagination->has_next_page()){
                                echo "<a href=\"kids_wears.php?page=";
                                echo $pagination->next_page();
                                echo "\">&raquo; Next</a> ";
                            }

                        }
                        ?>
                    </div>
					</div>
					<div class="tab-1 resp-tab-content" aria-labelledby="tab_item-1">
						
						
						 <?php foreach ($Cloth_items as $item): ?>
					  <?php 
                                                  //parameters for carting
                                                  $productId = $item->id;
                                                  $productName = $item->name;
                                                  $quantity   = 1;
                                                  $productPrice = $item->price;
                                                  $productImage = $item->full_view;
                                                  ?>
						<div class="col-md-3 product-men yes-marg">
							<div class="men-pro-item simpleCart_shelfItem">
								<div class="men-thumb-item">
                                                                    <img src="../admin/public/<?php echo $item->front_view; ?>" alt="" class="pro-image-front">
									<img src="../admin/public/<?php echo $item->back_view; ?>" alt="" class="pro-image-back">
										<div class="men-cart-pro">
											<div class="inner-men-cart-pro">
												<a href="view_kids.php?key=<?php echo $item->id; ?>" class="link-product-add-cart">Quick View</a>
											</div>
										</div>
										<span class="product-new-top">New</span>
										<div>
                                                                                    <p style="text-align: center;
                                                                                       color: #3b4590;
                                                                                       font-weight: bold;
                                                                                       ">Size</p>
                                                                                       <p style="text-align: center;
                                                                                   background-color: #f08d00;
                                                                                   color: white;
                                                                                   font-weight: normal;
                                                                                   height: 40px;
                                                                                   width:   40px;
                                                                                   margin: auto;
                                                                                   padding-top: 10px;
                                                                                   border-radius: 50px;
                                                                                   "><?php echo $item->size; ?></p>
                   
                                                                                   </div>
								</div>
								<div class="item-info-product ">
									<h4><a style="color: #3b5998;" href="view_kids.php?key=<?php echo $item->id; ?>"><?php echo $item->name; ?></a></h4>
									<div class="info-product-price">
										<span class="item_price">#<?php echo $item->price; ?></span>
										<del>#<?php echo $item->price + 3000; ?></del>
									</div>
									<a href="kids_wears.php?cartId=<?php echo $productId; ?>&&cartName=<?php echo $productName; ?>&&cartSize=<?php echo $productSize; ?>&&cartQuantity=<?php echo $quantity; ?>&&cartPrice=<?php echo $productPrice; ?>&&cartImage=../admin/public/<?php echo $productImage; ?>" class="item_add single-item hvr-outline-out button2">Add to cart</a>									
								</div>
							</div>
						</div>
                                            <?php endforeach; ?>
						<div class="clearfix"></div>	
                                                <div id="pagination" style="clear: both; ">
                        <?php
                        if($cloth_pagination->total_pages() > 1){

                            if($cloth_pagination->has_prevoius_page()){
                                echo "<a href=\"kids_wears.php?cloth_page=";
                                echo $cloth_pagination->previous_page();
                                echo "\">&laquo; Previous</a> ";
                            }

                            for($i=1; $i <= $cloth_pagination->total_pages(); $i++){
                                if($i == $cloth_page){
                                    echo " <span class=\"selected\">{$i}</span> ";
                                } else {
                                    echo " <a href=\"kids_wears.php.?cloth_page={$i}\">{$i}</a> ";
                                }

                            }

                            if($cloth_pagination->has_next_page()){
                                echo "<a href=\"kids_wears.php?cloth_page=";
                                echo $cloth_pagination->next_page();
                                echo "\">&raquo; Next</a> ";
                            }

                        }
                        ?>
                    </div>
					</div>	
                                    				<div class="tab-1 resp-tab-content" aria-labelledby="tab_item-2">
						
					
						 <?php foreach ($bags_items as $item): ?>
					  <?php 
                                                  //parameters for carting
                                                  $productId = $item->id;
                                                  $productName = $item->name;
                                                  $quantity   = 1;
                                                  $productPrice = $item->price;
                                                  $productImage = $item->full_view;
                                                  ?>
						<div class="col-md-3 product-men yes-marg">
							<div class="men-pro-item simpleCart_shelfItem">
								<div class="men-thumb-item">
                                                                    <img src="../admin/public/<?php echo $item->front_view; ?>" alt="" class="pro-image-front">
									<img src="../admin/public/<?php echo $item->back_view; ?>" alt="" class="pro-image-back">
										<div class="men-cart-pro">
											<div class="inner-men-cart-pro">
												<a href="view_kids.php?key=<?php echo $item->id; ?>" class="link-product-add-cart">Quick View</a>
											</div>
										</div>
										<span class="product-new-top">New</span>
										<div>
                                                                                    <p style="text-align: center;
                                                                                       color: #3b4590;
                                                                                       font-weight: bold;
                                                                                       ">Size</p>
                                                                                       <p style="text-align: center;
                                                                                   background-color: #f08d00;
                                                                                   color: white;
                                                                                   font-weight: normal;
                                                                                   height: 40px;
                                                                                   width:   40px;
                                                                                   margin: auto;
                                                                                   padding-top: 10px;
                                                                                   border-radius: 50px;
                                                                                   "><?php echo $item->size; ?></p>
                   
                                                                                   </div>
								</div>
								<div class="item-info-product ">
									<h4><a style="color: #3b5998;" href="view_kids.php?key=<?php echo $item->id; ?>"><?php echo $item->name; ?></a></h4>
									<div class="info-product-price">
										<span class="item_price">#<?php echo $item->price; ?></span>
										<del>#<?php echo $item->price + 3000; ?></del>
									</div>
									<a href="kids_wears.php?cartId=<?php echo $productId; ?>&&cartName=<?php echo $productName; ?>&&cartSize=<?php echo $productSize; ?>&&cartQuantity=<?php echo $quantity; ?>&&cartPrice=<?php echo $productPrice; ?>&&cartImage=../admin/public/<?php echo $productImage; ?>" class="item_add single-item hvr-outline-out button2">Add to cart</a>									
								</div>
							</div>
						</div>
                                            <?php endforeach; ?>

						<div class="clearfix"></div>
                                                 <div id="pagination" style="clear: both; ">
                        <?php
                        if($bags_pagination->total_pages() > 1){

                            if($bags_pagination->has_prevoius_page()){
                                echo "<a href=\"kids_wears.php?bags_page=";
                                echo $bags_pagination->previous_page();
                                echo "\">&laquo; Previous</a> ";
                            }

                            for($i=1; $i <= $bags_pagination->total_pages(); $i++){
                                if($i == $bags_page){
                                    echo " <span class=\"selected\">{$i}</span> ";
                                } else {
                                    echo " <a href=\"kids_wears.php.?bags_page={$i}\">{$i}</a> ";
                                }

                            }

                            if($bags_pagination->has_next_page()){
                                echo "<a href=\"kids_wears.php?bags_page=";
                                echo $bags_pagination->next_page();
                                echo "\">&raquo; Next</a> ";
                            }

                        }
                        ?>
                    </div>
					</div>
                                    <div class="tab-1 resp-tab-content" aria-labelledby="tab_item-3">
						
						 <?php foreach ($watches_items as $item): ?>
					  <?php 
                                                  //parameters for carting
                                                  $productId = $item->id;
                                                  $productName = $item->name;
                                                  $quantity   = 1;
                                                  $productPrice = $item->price;
                                                  $productImage = $item->full_view;
                                                  ?>
						<div class="col-md-3 product-men yes-marg">
							<div class="men-pro-item simpleCart_shelfItem">
								<div class="men-thumb-item">
                                                                    <img src="../admin/public/<?php echo $item->front_view; ?>" alt="" class="pro-image-front">
									<img src="../admin/public/<?php echo $item->back_view; ?>" alt="" class="pro-image-back">
										<div class="men-cart-pro">
											<div class="inner-men-cart-pro">
												<a href="view_kids.php?key=<?php echo $item->id; ?>" class="link-product-add-cart">Quick View</a>
											</div>
										</div>
										<span class="product-new-top">New</span>
                                                                                <div>
                                                                                    <p style="text-align: center;
                                                                                       color: #3b4590;
                                                                                       font-weight: bold;
                                                                                       ">Size</p>
                                                                                       <p style="text-align: center;
                                                                                   background-color: #f08d00;
                                                                                   color: white;
                                                                                   font-weight: normal;
                                                                                   height: 40px;
                                                                                   width:   40px;
                                                                                   margin: auto;
                                                                                   padding-top: 10px;
                                                                                   border-radius: 50px;
                                                                                   "><?php echo $item->size; ?></p>
                   
                                                                                   </div>
										
								</div>
								<div class="item-info-product ">
									<h4><a style="color: #3b5998;" href="view_kids.php?key=<?php echo $item->id; ?>"><?php echo $item->name; ?></a></h4>
									<div class="info-product-price">
										<span class="item_price">#<?php echo $item->price; ?></span>
										<del>#<?php echo $item->price + 3000; ?></del>
									</div>
									<a href="kids_wears.php?cartId=<?php echo $productId; ?>&&cartName=<?php echo $productName; ?>&&cartSize=<?php echo $productSize; ?>&&cartQuantity=<?php echo $quantity; ?>&&cartPrice=<?php echo $productPrice; ?>&&cartImage=../admin/public/<?php echo $productImage; ?>" class="item_add single-item hvr-outline-out button2">Add to cart</a>									
								</div>
							</div>
						</div>
                                            <?php endforeach; ?>
						<div class="clearfix"></div>	
                                                <div id="pagination" style="clear: both; ">
                        <?php
                        if($watches_pagination->total_pages() > 1){

                            if($watches_pagination->has_prevoius_page()){
                                echo "<a href=\"kids_wears.php?watches_page=";
                                echo $watches_pagination->previous_page();
                                echo "\">&laquo; Previous</a> ";
                            }

                            for($i=1; $i <= $watches_pagination->total_pages(); $i++){
                                if($i == $watches_page){
                                    echo " <span class=\"selected\">{$i}</span> ";
                                } else {
                                    echo " <a href=\"kids_wears.php.?watches_page={$i}\">{$i}</a> ";
                                }

                            }

                            if($watches_pagination->has_next_page()){
                                echo "<a href=\"kids_wears.php?watches_page=";
                                echo $watches_pagination->next_page();
                                echo "\">&raquo; Next</a> ";
                            }

                        }
                        ?>
                    </div>
					</div>	
				</div>	
			</div>
		</div>
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


<?php include_layout_template('footer.php'); ?>
