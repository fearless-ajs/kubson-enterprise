   <!--header -->
<?php require_once("../includes/Helpers/initialize.php"); ?>
<?php
$metadata = '#'; 
include_layout_template("header.php", "Home", "$metadata");
?>
<!-- //banner-top -->
<!-- banner -->
<div class="page-head">
	<div class="container">
		<h3>Men's Wear</h3>
	</div>
</div>
<!-- //banner -->
<!-- mens -->
<div class="men-wear">
	<div class="container">
		<div class="col-md-4 products-left">
			<div class="filter-price">
				<h3>Filter By Price</h3>
					<ul class="dropdown-menu6">
						<li>                
							<div id="slider-range"></div>							
							<input type="text" id="amount" style="border: 0; color: #ffffff; font-weight: normal;" />
						</li>			
					</ul>
							<!---->
							<script type='text/javascript'>//<![CDATA[ 
							$(window).load(function(){
							 $( "#slider-range" ).slider({
										range: true,
										min: 0,
										max: 9000,
										values: [ 1000, 7000 ],
										slide: function( event, ui ) {  $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
										}
							 });
							$( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) + " - $" + $( "#slider-range" ).slider( "values", 1 ) );

							});//]]>  

							</script>
						<script type="text/javascript" src="js/jquery-ui.js"></script>
					 <!---->
			</div>
			<div class="css-treeview">
				<h4>Categories</h4>
				<ul class="tree-list-pad">
					<li><input type="checkbox" checked="checked" id="item-0" /><label for="item-0"><span></span>Men's Wear</label>
						<ul>
							<li><input type="checkbox" id="item-0-0" /><label for="item-0-0">Ethinic Wear</label>
								<ul>
									<li><a href="mens.php">Shirts</a></li>
									<li><a href="mens.php">Caps</a></li>
									<li><a href="mens.php">Shoes</a></li>
									<li><a href="mens.php">Pants</a></li>
									<li><a href="mens.php">SunGlasses</a></li>
									<li><a href="mens.php">Trousers</a></li>
								</ul>
							</li>
							<li><input type="checkbox"  id="item-0-1" /><label for="item-0-1">Party Wear</label>
								<ul>
									<li><a href="mens.php">Shirts</a></li>
									<li><a href="mens.php">Caps</a></li>
									<li><a href="mens.php">Shoes</a></li>
									<li><a href="mens.php">Pants</a></li>
									<li><a href="mens.php">SunGlasses</a></li>
									<li><a href="mens.php">Trousers</a></li>
								</ul>
							</li>
							<li><input type="checkbox"  id="item-0-2" /><label for="item-0-2">Casual Wear</label>
								<ul>
									<li><a href="mens.php">Shirts</a></li>
									<li><a href="mens.php">Caps</a></li>
									<li><a href="mens.php">Shoes</a></li>
									<li><a href="mens.php">Pants</a></li>
									<li><a href="mens.php">SunGlasses</a></li>
									<li><a href="mens.php">Trousers</a></li>
								</ul>
							</li>
						</ul>
					</li>
					<li><input type="checkbox" id="item-1" checked="checked" /><label for="item-1">Best Collections</label>
						<ul>
							<li><input type="checkbox" checked="checked" id="item-1-0" /><label for="item-1-0">New Arrivals</label>
								<ul>
									<li><a href="mens.php">Shirts</a></li>
									<li><a href="mens.php">Shoes</a></li>
									<li><a href="mens.php">Pants</a></li>
									<li><a href="mens.php">SunGlasses</a></li>
								</ul>
							</li>
							
						</ul>
					</li>
					<li><input type="checkbox" checked="checked" id="item-2" /><label for="item-2">Best Offers</label>
						<ul>
							<li><input type="checkbox"  id="item-2-0" /><label for="item-2-0">Summer Discount Sales</label>
								<ul>
									<li><a href="mens.php">Shirts</a></li>
									<li><a href="mens.php">Shoes</a></li>
									<li><a href="mens.php">Pants</a></li>
									<li><a href="mens.php">SunGlasses</a></li>
								</ul>
							</li>
							<li><input type="checkbox" id="item-2-1" /><label for="item-2-1">Exciting Offers</label>
								<ul>
									<li><a href="mens.php">Shirts</a></li>
									<li><a href="mens.php">Shoes</a></li>
									<li><a href="mens.php">Pants</a></li>
									<li><a href="mens.php">SunGlasses</a></li>
								</ul>
							</li>
							<li><input type="checkbox" id="item-2-2" /><label for="item-2-2">Flat Discounts</label>
								<ul>
									<li><a href="mens.php">Shirts</a></li>
									<li><a href="mens.php">Shoes</a></li>
									<li><a href="mens.php">Pants</a></li>
									<li><a href="mens.php">SunGlasses</a></li>
								</ul>
							</li>
						</ul>
					</li>
				</ul>
			</div>
			<div class="community-poll">
				<h4>Community Poll</h4>
				<div class="swit form">	
					<form>
					<div class="check_box"> <div class="radio"> <label><input type="radio" name="radio" checked=""><i></i>More convenient for shipping and delivery</label> </div></div>
					<div class="check_box"> <div class="radio"> <label><input type="radio" name="radio"><i></i>Lower Price</label> </div></div>
					<div class="check_box"> <div class="radio"> <label><input type="radio" name="radio"><i></i>Track your item</label> </div></div>
					<div class="check_box"> <div class="radio"> <label><input type="radio" name="radio"><i></i>Bigger Choice</label> </div></div>
					<div class="check_box"> <div class="radio"> <label><input type="radio" name="radio"><i></i>More colors to choose</label> </div></div>	
					<div class="check_box"> <div class="radio"> <label><input type="radio" name="radio"><i></i>Secured Payment</label> </div></div>
					<div class="check_box"> <div class="radio"> <label><input type="radio" name="radio"><i></i>Money back guaranteed</label> </div></div>	
					<div class="check_box"> <div class="radio"> <label><input type="radio" name="radio"><i></i>Others</label> </div></div>		
					<input type="submit" value="SEND">
					</form>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="col-md-8 products-right">
			<h5>Product Compare(0)</h5>
			<div class="sort-grid">
				<div class="sorting">
					<h6>Sort By</h6>
					<select id="country1" onchange="change_country(this.value)" class="frm-field required sect">
						<option value="null">Default</option>
						<option value="null">Name(A - Z)</option> 
						<option value="null">Name(Z - A)</option>
						<option value="null">Price(High - Low)</option>
						<option value="null">Price(Low - High)</option>	
						<option value="null">Model(A - Z)</option>
						<option value="null">Model(Z - A)</option>					
					</select>
					<div class="clearfix"></div>
				</div>
				<div class="sorting">
					<h6>Showing</h6>
					<select id="country2" onchange="change_country(this.value)" class="frm-field required sect">
						<option value="null">7</option>
						<option value="null">14</option> 
						<option value="null">28</option>					
						<option value="null">35</option>								
					</select>
					<div class="clearfix"></div>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="men-wear-top">
				<script src="js/responsiveslides.min.js"></script>
				<script>
						// You can also use "$(window).load(function() {"
						$(function () {
						 // Slideshow 4
						$("#slider3").responsiveSlides({
							auto: true,
							pager: true,
							nav: false,
							speed: 500,
							namespace: "callbacks",
							before: function () {
						$('.events').append("<li>before event fired.</li>");
						},
						after: function () {
							$('.events').append("<li>after event fired.</li>");
							}
							});
						});
				</script>
				<div  id="top" class="callbacks_container">
					<ul class="rslides" id="slider3">
						<li>
							<img class="img-responsive" src="images/men1.jpg" alt=" "/>
						</li>
						<li>
							<img class="img-responsive" src="images/men2.jpg" alt=" "/>
						</li>
						<li>
							<img class="img-responsive" src="images/men1.jpg" alt=" "/>
						</li>
						<li>
							<img class="img-responsive" src="images/men2.jpg" alt=" "/>
						</li>
					</ul>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="men-wear-bottom">
				<div class="col-sm-4 men-wear-left">
					<img class="img-responsive" src="images/men3.jpg" alt=" " />
				</div>
				<div class="col-sm-8 men-wear-right">
					<h4>Exclusive Men's Collections</h4>
					<p>Best of all Men wears. Premium shoes, watches, clothes at economic prices 
                                            and to bring satisfaction to our customers.Easy Navigation through our
                                            items/goods, carting and ordering of carted items. Fast and free delivery 
                                            method that's been tested and validated for optimal servicing of customer's 
                                            Needs.24/7 Customer's relation service available to all customers at any time.
                                        </p>
				</div>
				<div class="clearfix"></div>
			</div>
				<div class="col-md-4 product-men no-pad-men">
					<div class="men-pro-item simpleCart_shelfItem">
						<div class="men-thumb-item">
							<img src="images/ep2.png" alt="" class="pro-image-front">
							<img src="images/ep2.png" alt="" class="pro-image-back">
										<div class="men-cart-pro">
											<div class="inner-men-cart-pro">
												<a href="single.php" class="link-product-add-cart">Quick View</a>
											</div>
										</div>
										<span class="product-new-top">New</span>
										
						</div>
						<div class="item-info-product ">
									<h4><a href="single.php">Watches</a></h4>
									<div class="info-product-price">
										<span class="item_price">$45.99</span>
										<del>$69.71</del>
									</div>
									<a href="#" class="item_add single-item hvr-outline-out button2">Add to cart</a>									
						</div>
					</div>
				</div>
				<div class="col-md-4 product-men no-pad-men">
					<div class="men-pro-item simpleCart_shelfItem">
						<div class="men-thumb-item">
							<img src="images/a2.png" alt="" class="pro-image-front">
							<img src="images/a2.png" alt="" class="pro-image-back">
										<div class="men-cart-pro">
											<div class="inner-men-cart-pro">
												<a href="single.php" class="link-product-add-cart">Quick View</a>
											</div>
										</div>
										<span class="product-new-top">New</span>
										
						</div>
						<div class="item-info-product ">
									<h4><a href="single.php">Blazers</a></h4>
									<div class="info-product-price">
										<span class="item_price">$45.99</span>
										<del>$69.71</del>
									</div>
									<a href="#" class="item_add single-item hvr-outline-out button2">Add to cart</a>									
						</div>
					</div>
				</div>
				<div class="col-md-4 product-men no-pad-men">
					<div class="men-pro-item simpleCart_shelfItem">
						<div class="men-thumb-item">
							<img src="images/mw2.png" alt="" class="pro-image-front">
							<img src="images/mw2.png" alt="" class="pro-image-back">
										<div class="men-cart-pro">
											<div class="inner-men-cart-pro">
												<a href="single.php" class="link-product-add-cart">Quick View</a>
											</div>
										</div>
										<span class="product-new-top">New</span>
										
						</div>
						<div class="item-info-product ">
									<h4><a href="single.php">Shirts</a></h4>
									<div class="info-product-price">
										<span class="item_price">$45.99</span>
										<del>$69.71</del>
									</div>
									<a href="#" class="item_add single-item hvr-outline-out button2">Add to cart</a>									
						</div>
					</div>
				</div>
				
				<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
		<div class="single-pro">
			
			<div class="col-md-3 product-men">
				<div class="men-pro-item simpleCart_shelfItem">
					<div class="men-thumb-item">
						<img src="images/a8.png" alt="" class="pro-image-front">
						<img src="images/a8.png" alt="" class="pro-image-back">
							<div class="men-cart-pro">
								<div class="inner-men-cart-pro">
									<a href="single.php" class="link-product-add-cart">Quick View</a>
								</div>
							</div>
							<span class="product-new-top">New</span>				
					</div>
					<div class="item-info-product ">
						<h4><a href="single.php">Blazers</a></h4>
						<div class="info-product-price">
							<span class="item_price">$45.99</span>
							<del>$69.71</del>
						</div>
						<a href="#" class="item_add single-item hvr-outline-out button2">Add to cart</a>									
					</div>
				</div>
			</div>
			<div class="col-md-3 product-men">
				<div class="men-pro-item simpleCart_shelfItem">
					<div class="men-thumb-item">
						<img src="images/mw1.png" alt="" class="pro-image-front">
						<img src="images/mw1.png" alt="" class="pro-image-back">
							<div class="men-cart-pro">
								<div class="inner-men-cart-pro">
									<a href="single.php" class="link-product-add-cart">Quick View</a>
								</div>
							</div>
							<span class="product-new-top">New</span>				
					</div>
					<div class="item-info-product ">
						<h4><a href="single.php">Sandals</a></h4>
						<div class="info-product-price">
							<span class="item_price">$45.99</span>
							<del>$69.71</del>
						</div>
						<a href="#" class="item_add single-item hvr-outline-out button2">Add to cart</a>									
					</div>
				</div>
			</div>
			<div class="col-md-3 product-men">
				<div class="men-pro-item simpleCart_shelfItem">
					<div class="men-thumb-item">
						<img src="images/ep3.png" alt="" class="pro-image-front">
						<img src="images/ep3.png" alt="" class="pro-image-back">
							<div class="men-cart-pro">
								<div class="inner-men-cart-pro">
									<a href="single.php" class="link-product-add-cart">Quick View</a>
								</div>
							</div>
							<span class="product-new-top">New</span>				
					</div>
					<div class="item-info-product ">
						<h4><a href="single.php">Watches</a></h4>
						<div class="info-product-price">
							<span class="item_price">$45.99</span>
							<del>$69.71</del>
						</div>
						<a href="#" class="item_add single-item hvr-outline-out button2">Add to cart</a>									
					</div>
				</div>
			</div>
			<div class="col-md-3 product-men">
				<div class="men-pro-item simpleCart_shelfItem">
					<div class="men-thumb-item">
						<img src="images/mw3.png" alt="" class="pro-image-front">
						<img src="images/mw3.png" alt="" class="pro-image-back">
							<div class="men-cart-pro">
								<div class="inner-men-cart-pro">
									<a href="single.php" class="link-product-add-cart">Quick View</a>
								</div>
							</div>
							<span class="product-new-top">New</span>				
					</div>
					<div class="item-info-product ">
						<h4><a href="single.php">Shoes</a></h4>
						<div class="info-product-price">
							<span class="item_price">$45.99</span>
							<del>$69.71</del>
						</div>
						<a href="#" class="item_add single-item hvr-outline-out button2">Add to cart</a>									
					</div>
				</div>
			</div>
			<div class="col-md-3 product-men yes-marg">
							<div class="men-pro-item simpleCart_shelfItem">
								<div class="men-thumb-item">
									<img src="images/g3.png" alt="" class="pro-image-front">
									<img src="images/g3.png" alt="" class="pro-image-back">
										<div class="men-cart-pro">
											<div class="inner-men-cart-pro">
												<a href="single.php" class="link-product-add-cart">Quick View</a>
											</div>
										</div>
										<span class="product-new-top">New</span>
										
								</div>
								<div class="item-info-product ">
									<h4><a href="single.php">Shirts</a></h4>
									<div class="info-product-price">
										<span class="item_price">$45.99</span>
										<del>$69.71</del>
									</div>
									<a href="#" class="item_add single-item hvr-outline-out button2">Add to cart</a>									
								</div>
							</div>
						</div>
						<div class="col-md-3 product-men yes-marg">
							<div class="men-pro-item simpleCart_shelfItem">
								<div class="men-thumb-item">
									<img src="images/ep4.png" alt="" class="pro-image-front">
									<img src="images/ep4.png" alt="" class="pro-image-back">
										<div class="men-cart-pro">
											<div class="inner-men-cart-pro">
												<a href="single.php" class="link-product-add-cart">Quick View</a>
											</div>
										</div>
										<span class="product-new-top">New</span>
										
								</div>
								<div class="item-info-product ">
									<h4><a href="single.php">Watches</a></h4>
									<div class="info-product-price">
										<span class="item_price">$119.99</span>
										<del>$150.71</del>
									</div>
									<a href="#" class="item_add single-item hvr-outline-out button2">Add to cart</a>									
								</div>
							</div>
						</div>
			<div class="col-md-3 product-men yes-marg">
							<div class="men-pro-item simpleCart_shelfItem">
								<div class="men-thumb-item">
									<img src="images/mw2.png" alt="" class="pro-image-front">
									<img src="images/mw2.png" alt="" class="pro-image-back">
										<div class="men-cart-pro">
											<div class="inner-men-cart-pro">
												<a href="single.php" class="link-product-add-cart">Quick View</a>
											</div>
										</div>
										<span class="product-new-top">New</span>
										
								</div>
								<div class="item-info-product ">
									<h4><a href="single.php">T shirts</a></h4>
									<div class="info-product-price">
										<span class="item_price">$45.99</span>
										<del>$69.71</del>
									</div>
									<a href="#" class="item_add single-item hvr-outline-out button2">Add to cart</a>									
								</div>
							</div>
						</div>
			<div class="col-md-3 product-men yes-marg">
							<div class="men-pro-item simpleCart_shelfItem">
								<div class="men-thumb-item">
									<img src="images/g2.png" alt="" class="pro-image-front">
									<img src="images/g2.png" alt="" class="pro-image-back">
										<div class="men-cart-pro">
											<div class="inner-men-cart-pro">
												<a href="single.php" class="link-product-add-cart">Quick View</a>
											</div>
										</div>
										<span class="product-new-top">New</span>
										
								</div>
								<div class="item-info-product ">
									<h4><a href="single.php"> Shirts</a></h4>
									<div class="info-product-price">
										<span class="item_price">$45.99</span>
										<del>$69.71</del>
									</div>
									<a href="#" class="item_add single-item hvr-outline-out button2">Add to cart</a>									
								</div>
							</div>
						</div>
			<div class="clearfix"></div>
		</div>
		<div class="pagination-grid text-right">
			<ul class="pagination paging">
				<li><a href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
				<li class="active"><a href="#">1<span class="sr-only">(current)</span></a></li>
				<li><a href="#">2</a></li>
				<li><a href="#">3</a></li>
				<li><a href="#">4</a></li>
				<li><a href="#">5</a></li>
				<li><a href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
			</ul>
		</div>
	</div>
</div>	
<!-- //mens -->
<!-- //product-nav -->
<div class="coupons">
	<div class="container">
		<div class="coupons-grids text-center">
			<div class="col-md-3 coupons-gd">
				<h3>Buy your product in a simple way</h3>
			</div>
			<div class="col-md-3 coupons-gd">
				<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
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
<!-- footer -->
<?php include_layout_template('footer.php'); ?>