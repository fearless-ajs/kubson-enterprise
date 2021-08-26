     <!--header -->
<?php require_once("../includes/Helpers/initialize.php"); ?>
<?php 
            $login_user = new LoginControl();
            //checks if the user is not logged in, then redirects if true to the login page
            $login_user->is_not_Logged_in_within();
?>
<?php
$metadata = 'New clinic'; 
include_layout_template("header.php", "Home", "$metadata");   
include_layout_template("sidebar.php");
?> 
<!--header end-->
<!--sidebar start-->

<!--sidebar end-->
<!--main content start-->
<section id="main-content" style="background-image: url(images/ba2.jpg); background-repeat: no-repeat; background-size: cover;">
	<section class="wrapper" >
             <?php if(!empty($_GET['msg'])){ ?>
        <script type="text/javascript">
            alert("<?php echo $_GET['msg']; ?>");
        </script>
 <?php unset($_GET['msg']); } ?>
		<!-- //market-->
		<div class="market-updates">
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-2">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-user" style="color: white; font-size: 40px;"> </i>
					</div>
					 <div class="col-md-8 market-update-left"><a href="add_customer.php">
					 <h4>Register</h4>
					<h3>Customer</h3>
					<p>Register new customers</p></a>
				  </div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-1">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-shopping-cart" ></i>
					</div>
                                    <div class="col-md-8 market-update-left"><a href="add_men.php">
					<h4>Add New item</h4>
						<h3>For Men</h3>
                            <p>Add New men item to list</p></a>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
                    <div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-1">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-shopping-cart" ></i>
					</div>
                                    <div class="col-md-8 market-update-left"><a href="add_kids.php">
					<h4>Add New item</h4>
						<h3>For Kids</h3>
                            <p>Add New kid item to list</p></a>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-3">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-shopping-cart" style="color: white; font-size: 40px;"></i>
					</div>
                                    <div class="col-md-8 market-update-left"><a href="add_women.php">
						<h4>Add item</h4>
						<h3>Women</h3>
                            <p>Add New women item</p></a>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>

		   <div class="clearfix"> </div>
            <br>
<!--            <div class="col-md-3 market-update-gd">
                <div class="market-update-block clr-block-4">
                    <div class="col-md-4 market-update-right">
                        <i class="fa fa-user-md"  style="color: white; font-size: 40px;" aria-hidden="true"></i>
                    </div>
                    <div class="col-md-8 market-update-left"><a href="discharge_list.php">
                        <h4>Discharge</h4>
                        <h3>Patients</h3>
                            <p>Discharge patients from the hospital</p></a>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>-->
<!--            <div class="col-md-3 market-update-gd">
                <div class="market-update-block clr-block-3">
                    <div class="col-md-4 market-update-right">
                        <i class="fa fa-usd"></i>
                    </div>
                    <div class="col-md-8 market-update-left">
                        <h4>Referrer</h4>
                        <h3>System</h3>
                        <p>Medical referrer system for patients</p>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>-->
<!--            <div class="col-md-3 market-update-gd">
                <div class="market-update-block clr-block-1">
                    <div class="col-md-4 market-update-right">
                        <i class="fa fa-hospital-o" style="color: white; font-size: 40px;" ></i>
                    </div>
                    <div class="col-md-8 market-update-left">
                        <h4>About</h4>
                        <h3>System</h3>
                        <p>What the system is all about</p>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>-->
		</div>	
		<!-- //market-->


			<!-- tasks -->
			

</section>
    <br>
    <br>
    <br><br>
    <br>
 <?php include_layout_template("footer.php"); ?>