   <!--header -->
<?php require_once("../includes/Helpers/initialize.php");?>
<?php
$metadata = '#'; 
include_layout_template("header.php", "Home", "$metadata");   
//Activating our pagination system
//1. The current page number($current_page)
$page = !empty($_GET['page']) ? (int)$_GET['page']: 1;


//2. Records per page($per_page)
$per_page = 5;


//3. total record count ($total_count)
$total_count = Cart::count_all();

//Find all photos
//use pagination instead
//$photos = Photograph::find_all();

$pagination = new Pagination($page, $per_page, $total_count);
//instead of finding all records, just find the record
//for this page
$sql  = "SELECT * FROM cart ";
$sql .= "LIMIT {$per_page} ";
$sql .= "OFFSET {$pagination->offset()}";
$carts = Cart::find_by_sql($sql);

//Need to add ?page=$page to all links we want to
//maintain the current page (or store $page in session)
$sql_sum = "SELECT SUM(product_price * quantity) AS sum_value FROM cart;";
$carts_result = Cart::find_by_sql($sql_sum);



//sum of price

//Deleting Item
$cart_control = new CartControl();
//Deleting Item
if($cart_control->deleteItem()){
redirect_to('checkout.php');
}
//Updating Item
if($cart_control->updateEntry()){
    unset($_GET['up_key']);
    unset($_GET['value']);
redirect_to('checkout.php');
}

?>
   <?php if(!empty($_GET['msg'])){ ?>
    <script type="text/javascript">
        alert("<?php echo $_GET['msg']; ?>");
    </script>
<?php  } ?>
<!-- //banner-top -->
<!-- banner -->
<div class="page-head">
	<div class="container">
		<h3 style="color: white; ">Check Out</h3>
	</div>
</div>
<!-- //banner -->
<!-- check out -->
<div class="checkout">
	<div class="container">
		<h3>My Shopping Bag</h3>
		<div class="table-responsive checkout-right animated wow slideInUp" data-wow-delay=".5s">
			<table class="timetable_sub">
				<thead>
					<tr>
						<th style="background-color: #3b5998;">Remove</th>
                                                <th style="background-color: #3b5998;">Product</th>
                                                
						<th style="background-color: #3b5998;">Quantity</th>
						<th style="background-color: #3b5998;">Product Name</th>
                                                <th style="background-color: #3b5998;">Size</th>
						<th style="background-color: #3b5998;">Price</th>
                                                <th style="background-color: #3b5998;">Action</th>
					</tr>
				</thead>
                                    <?php foreach ($carts as $item): ?>
                                <form action="checkout.php" method="post">
					<tr class="rem1">
						<td class="invert-closeb">
							<div class="rem">
                                                         
                                                            <button type="submit" name="del_key" class="btn btn-danger">Delete</button>
							
                                                        </div>
						</td>
                                                <td class="invert-image"><a href="view_men.php?key=<?php echo $item->id; ?>"><img src="<?php echo $item->image; ?>" alt=" " class="img-responsive" /></a></td>
						<td class="invert">
                                                   
							 <div class="quantity"> 
								<div class="quantity-select">                           
<!--									<div class="entry value-minus">&nbsp;</div>-->
<input type="number" name="quantity" class="entry value" min="1" oninput="validity.valid||(value='1');" value="<?php echo $item->quantity; ?>" >
<input type="hidden" name="item_id" value="<?php echo $item->product_id; ?>">
<input type="hidden" name="id" value="<?php echo $item->id; ?>">
<!--									<div class="entry value"><span></span></div>-->
<!--									<div class="entry value-plus active">&nbsp;</div>-->
								</div>
							</div>
                                                    
						</td>
						<td class="invert"><?php echo $item->product_name; ?></td>
                                                <td class="invert"><?php echo $item->size; ?></td>
						<td class="invert">#<?php echo $item->product_price * $item->quantity ; ?></td>
                                               <td class="invert-closeb">
							<div class="rem">
                                                         
                                                            <button type="submit" name="up_key" class="btn btn-primary">Update</button>
							
                                                        </div>
						</td>
					</tr>
					
                                </form>
                        <?php endforeach; ?>
						
                                        
                                        <!--quantity-->
									<script>
									$('.value-plus').on('click', function(){
										var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)+1;
										divUpd.text(newVal);
									});

									$('.value-minus').on('click', function(){
										var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)-1;
										if(newVal>=1) divUpd.text(newVal);
									});
									</script>
								<!--quantity-->
			</table>
                     <div id="pagination" style="clear: both; ">
                        <?php
                        if($pagination->total_pages() > 1){

                            if($pagination->has_prevoius_page()){
                                echo "<a href=\"checkout.php?page=";
                                echo $pagination->previous_page();
                                echo "\">&laquo; Previous</a> ";
                            }

                            for($i=1; $i <= $pagination->total_pages(); $i++){
                                if($i == $page){
                                    echo " <span class=\"selected\">{$i}</span> ";
                                } else {
                                    echo " <a href=\"checkout.php.?page={$i}\">{$i}</a> ";
                                }

                            }

                            if($pagination->has_next_page()){
                                echo "<a href=\"checkout.php?page=";
                                echo $pagination->next_page();
                                echo "\">&raquo; Next</a> ";
                            }

                        }
                        ?>
                    </div>
		</div>
		<div class="checkout-left">	
				
				<div class="checkout-right-basket animated wow slideInRight" data-wow-delay=".5s">
                                    <a href="men_wears.php"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>Back To Shopping</a>
                                    <a href="https://developer.flutterwave.com/docs/rave-inline" target="blank" class="use1"><span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>Place Order</a>
                                  
				</div>
				<div class="checkout-left-basket animated wow slideInLeft" data-wow-delay=".9s">
					<h4 style="background-color: #3b5998;">Shopping basket</h4>
					<ul>
                                            <?php foreach ($carts as $item): ?>
                                           
<!--					        <li>Hand Bag <i>-</i> <span>$45.99</span></li>-->
						<li><?php echo $item->product_name ?> <i>-</i> <span>#<?php echo $item->product_price * $item->quantity ?></span></li>
						
                                                
                                                 <?php endforeach; ?>
                                                <?php foreach ($carts_result as $item): ?>
                                                <li style="color: #dd0b03;">Total <i>-</i> <span>#<?php echo $item ->sum_value; ?></span></li>
                                                 <?php endforeach; ?>
					</ul>
				</div>
				<div class="clearfix"> </div>
			</div>
	</div>
</div>	
<!-- //check out -->
<!-- //product-nav -->
<div class="modal fade" id="myModa33" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content modal-info">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
						</div>
						<div class="modal-body modal-spa">
							<div class="login-grids">
								<div class="login">
									<div class="login-bottom">
										<h3>Payment Gateway</h3>
                                                                                <form action="index.php" method="post">
                                                                                    <div class="sign-up">
												<h4>Fullname :</h4>
                                                                                                <input type="text" name="name" placeholder="Your Full Name" required="">	
                                                                                   </div>
                                                                                               <div class="sign-up">
                                                                                                   <h4>Select your Card Vendor:</h4>
                                                                                                <select class="form-control">
                                                                                                        <option value="null">Select Card Type</option>
                                                                                                        <option value="null">Electronics</option>     
                                                                                                        <option value="AX">kids Wear</option>
                                                                                                        <option value="AX">Men's Wear</option>
                                                                                                        <option value="AX">Women's Wear</option>
                                                                                                        <option value="AX">Watches</option>
                                                                                                </select>
                                                                                        </div>
                                                                                    <br>
                                                                                    <div class="sign-up">
												<h4>Credit/Debit card Number :</h4>
                                                                                                <input type="number" name="phone"  class="form-control" required="">	
                                                                                                <div class="clearfix"></div>
											</div>
                                                                                    <br>
											<div class="sign-up">
												<h4>CCV :</h4>
                                                                                                <input type="number" name="ccv"  class="form-control" required="">	
											
                                                                                        </div>
                                                                                    <br>
                                                                                    <div class="sign-up">
												<h4>PIN :</h4>
                                                                                                <input type="number" class="form-control" name="email"  required="">	
											
                                                                                    </div>
											
											
											
										</form>
									</div>
									<div class="login-right">
										<h3>User Information</h3>
										<form>
											<div class="sign-in">
												<h4>Email :</h4>
                                                                                                <input type="text" name="email"  placeholder="Your Email" required="">	
											</div>
											<div class="sign-in">
												<h4>Identification Key :</h4>
                                                                                                <input type="text" name="password"  placeholder="Your Password" required="">
<!--												<a href="#">Forgot password?</a>-->
											</div>
<!--											<div class="single-bottom">
												<input type="checkbox"  id="brand" value="">
												<label for="brand"><span></span>Remember Me.</label>
											</div>-->
											<div class="sign-in">
                                                                                            <input type="submit" name="submit" value="Generate Payment" >
											</div>
										</form>
									</div>
									<div class="clearfix"></div>
								</div>
								<p>Your card private credentials <a href="#">are secured with us</a> Always <a href="#"></a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
<!-- footer -->
<?php include_layout_template("footer.php"); ?>