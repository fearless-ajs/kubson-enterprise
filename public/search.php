<?php require_once("../includes/Helpers/initialize.php"); ?>
<?php
$metadata = '#'; 
include_layout_template("header.php", "Home", "$metadata");

/*******************Female cat*****************************/
//processing the select box
if(isset($_POST['search'])){
    if(empty($_POST['category'])){
      
        redirect_to("index.php?msg=Select a category");
    } elseif(empty($_POST['name'])) {
        redirect_to("index.php?msg=Enter a search value");
    } else {
          $cat = $_POST['category'];
          $name = $_POST['name'];
    }

    
}
//Activating our pagination system
//1. The current page number($current_page)
$page = !empty($_GET['page']) ? (int)$_GET['page']: 1;


//2. Records per page($per_page)
$per_page = 4;


//3. total record count ($total_count)
$total_count = Women::count_by_name_and_cat($name, $cat);


//Find all photos
//use pagination instead
//$photos = Photograph::find_all();

$pagination = new Pagination($page, $per_page, $total_count);
//instead of finding all records, just find the record




//for this page
$sql  = "SELECT * FROM women WHERE Match(name) Against('{$name}') AND category = '{$cat}' ";
$sql .= "LIMIT {$per_page} ";
$sql .= "OFFSET {$pagination->offset()}";
$items = Women::find_by_sql($sql);

//Need to add ?page=$page to all links we want to
//maintain the current page (or store $page in session)
/*********************END***************************************/


/*******************Male cat*****************************/
//Activating our pagination system
//1. The current page number($current_page)
$m_page = !empty($_GET['m_page']) ? (int)$_GET['m_page']: 1;


//2. Records per page($per_page)
$m_per_page = 4;


//3. total record count ($total_count)
$m_total_count = Men::count_by_name_and_cat($name, $cat);

//Find all photos
//use pagination instead
//$photos = Photograph::find_all();

$m_pagination = new Pagination($m_page, $m_per_page, $m_total_count);
//instead of finding all records, just find the record
//for this page
$m_sql   = "SELECT * FROM men WHERE Match(name) Against('{$name}') AND category = '{$cat}' ";
$m_sql  .= "LIMIT {$m_per_page} ";
$m_sql  .= "OFFSET {$m_pagination->offset()}";
$m_items = Men::find_by_sql($m_sql);

//Need to add ?page=$page to all links we want to
//maintain the current page (or store $page in session)
/*********************END***************************************/

/*******************Kids cat*****************************/
//Activating our pagination system
//1. The current page number($current_page)
$k_page = !empty($_GET['k_page']) ? (int)$_GET['k_page']: 1;


//2. Records per page($per_page)
$k_per_page = 4;


//3. total record count ($total_count)
$k_total_count = Kids::count_by_name_and_cat($name, $cat);

//Find all photos
//use pagination instead
//$photos = Photograph::find_all();

$k_pagination = new Pagination($k_page, $k_per_page, $k_total_count);
//instead of finding all records, just find the record
//for this page
$k_sql   = "SELECT * FROM kids WHERE Match(name) Against('{$name}') AND category = '{$cat}' ";
$k_sql  .= "LIMIT {$k_per_page} ";
$k_sql  .= "OFFSET {$k_pagination->offset()}";
$k_items = Kids::find_by_sql($k_sql);

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

?>
 <?php if(!empty($message)){ ?>
        <script type="text/javascript">
            alert("<?php echo $message; ?>");
        </script>
 <?php  } ?>
<div class="page-head">
	<div class="container">
            <h3 style="color: white">Search Result</h3>
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
					<li class="resp-tab-item" aria-controls="tab_item-0" role="tab" style="border-color: #3b5998;"><span>Females</span></li> 
					<li class="resp-tab-item" aria-controls="tab_item-1" role="tab"><span>Males</span></li> 
					<li class="resp-tab-item" aria-controls="tab_item-2" role="tab"><span>Kids Items</span></li> 
                                       
				</ul>				  	 
				<div class="resp-tabs-container">
					<div class="tab-1 resp-tab-content" aria-labelledby="tab_item-0">
						  <?php foreach ($items as $item): ?>
					  <?php 
                                                  //parameters for carting
                                                  $productId = $item->id;
                                                  $productName = $item->name;
                                                  $productSize  = $item->size;
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
												<a href="view_women.php?key=<?php echo $item->id; ?>" class="link-product-add-cart">Quick View</a>
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
									<h4><a style="color: #3b5998;" href="view_women.php?key=<?php echo $item->id; ?>"><?php echo $item->name; ?></a></h4>
									<div class="info-product-price">
										<span class="item_price">#<?php echo $item->price; ?></span>
										<del>#<?php echo $item->price + 3000; ?></del>
									</div>
                                                                        <a href="women_wears.php?cartId=<?php echo $productId; ?>&&cartName=<?php echo $productName; ?>&&cartSize=<?php echo $productSize; ?>&&cartQuantity=<?php echo $quantity; ?>&&cartPrice=<?php echo $productPrice; ?>&&cartImage=../admin/public/<?php echo $productImage; ?>" class="item_add single-item hvr-outline-out button2">Add to cart</a>									
								</div>
							</div>
						</div>
                                            <?php endforeach; ?>
                                         
						<div class="clearfix"></div>
                                                    <div id="pagination" style="clear: both; ">
                        <?php
                        if($pagination->total_pages() > 1){

                            if($pagination->has_prevoius_page()){
                                echo "<a href=\"search.php?page=";
                                echo $pagination->previous_page();
                                echo "\">&laquo; Previous</a> ";
                            }

                            for($i=1; $i <= $pagination->total_pages(); $i++){
                                if($i == $page){
                                    echo " <span class=\"selected\">{$i}</span> ";
                                } else {
                                    echo " <a href=\"search.php.?page={$i}\">{$i}</a> ";
                                }

                            }

                            if($pagination->has_next_page()){
                                echo "<a href=\"search.php?page=";
                                echo $pagination->next_page();
                                echo "\">&raquo; Next</a> ";
                            }

                        }
                        ?>
                    </div>
					</div>
					<div class="tab-1 resp-tab-content" aria-labelledby="tab_item-1">
						
						
						 <?php foreach ($m_items as $item): ?>
					  <?php 
                                                  //parameters for carting
                                                  $productId = $item->id;
                                                  $productName = $item->name;
                                                  $productSize  = $item->size;
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
												<a href="view_men.php?key=<?php echo $item->id; ?>" class="link-product-add-cart">Quick View</a>
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
									<h4><a style="color: #3b5998;" href="view_men.php?key=<?php echo $item->id; ?>"><?php echo $item->name; ?></a></h4>
									<div class="info-product-price">
										<span class="item_price">#<?php echo $item->price; ?></span>
										<del>#<?php echo $item->price + 3000; ?></del>
									</div>
									<a href="men_wears.php?cartId=<?php echo $productId; ?>&&cartName=<?php echo $productName; ?>&&cartSize=<?php echo $productSize; ?>&&cartQuantity=<?php echo $quantity; ?>&&cartPrice=<?php echo $productPrice; ?>&&cartImage=../admin/public/<?php echo $productImage; ?>" class="item_add single-item hvr-outline-out button2">Add to cart</a>									
								</div>
							</div>
						</div>
                                            <?php endforeach; ?>
						<div class="clearfix"></div>	
                                                <div id="pagination" style="clear: both; ">
                        <?php
                        if($m_pagination->total_pages() > 1){

                            if($m_pagination->has_prevoius_page()){
                                echo "<a href=\"search.php?m_page=";
                                echo $m_pagination->previous_page();
                                echo "\">&laquo; Previous</a> ";
                            }

                            for($i=1; $i <= $m_pagination->total_pages(); $i++){
                                if($i == $m_page){
                                    echo " <span class=\"selected\">{$i}</span> ";
                                } else {
                                    echo " <a href=\"search.php?m_page={$i}\">{$i}</a> ";
                                }

                            }

                            if($m_pagination->has_next_page()){
                                echo "<a href=\"search.php?m_page=";
                                echo $m_pagination->next_page();
                                echo "\">&raquo; Next</a> ";
                            }

                        }
                        ?>
                    </div>
					</div>	
                                    				<div class="tab-1 resp-tab-content" aria-labelledby="tab_item-2">
						
					
						 <?php foreach ($k_items as $item): ?>
					  <?php 
                                                  //parameters for carting
                                                  $productId = $item->id;
                                                  $productName = $item->name;
                                                  $productSize  = $item->size;
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
                        if($k_pagination->total_pages() > 1){

                            if($k_pagination->has_prevoius_page()){
                                echo "<a href=\"search.php?k_page=";
                                echo $k_pagination->previous_page();
                                echo "\">&laquo; Previous</a> ";
                            }

                            for($i=1; $i <= $k_pagination->total_pages(); $i++){
                                if($i == $k_page){
                                    echo " <span class=\"selected\">{$i}</span> ";
                                } else {
                                    echo " <a href=\"search.php?k_page={$i}\">{$i}</a> ";
                                }

                            }

                            if($k_pagination->has_next_page()){
                                echo "<a href=\"men_wears.php?k_page=";
                                echo $k_pagination->next_page();
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
				<h3>Buy your product in a simple way</h3>
			</div>
			<div class="col-md-3 coupons-gd">
				<span class="glyphicon glyphicon-user" aria-hidden="true" href="#" data-toggle="modal" data-target="#myModal4"></span>
				<h4>LOGIN TO YOUR ACCOUNT</h4>
				<p>Log in to our Enterprise system with your registered credentials
			to access our products.</p>
			</div>
			<div class="col-md-3 coupons-gd">
				<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
				<h4>SELECT YOUR ITEM</h4>
				<p>Select the item/product you want from the item list for adding to cart.</p>
			</div>
			<div class="col-md-3 coupons-gd">
				<span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span>
				<h4>MAKE PAYMENT</h4>
				<p>Make payment with our easy payment method  and delivery to be made within a short period.</p>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
</div>

<?php include_layout_template('footer.php'); ?>
