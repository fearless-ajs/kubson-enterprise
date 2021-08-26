<?php
require_once("../includes/Helpers/initialize.php");


   
   //checks if the admin is logged in
   $login_user = new LoginControl();
   $login_user->is_not_Logged_in_within();
   
   //initialising the user class for registration
   $new_user = new UserControl();
   
   //Object of the class user that controls error messages
   $message = $new_user->message;
   
   

?>
 <?php if(!empty($message)){ ?>
        <script type="text/javascript">
            alert("<?php echo $message; ?>");
        </script>
 <?php  } ?>
<!DOCTYPE html>
<head>
<title>ADMIN REGISTRATION</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="#" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="css/bootstrap.min.css" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/style-responsive.css" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="css/font.css" type="text/css"/>
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
<script src="js/jquery2.0.3.min.js"></script>
</head>
<body style="background-image: url(images/ba2.jpg); background-repeat: no-repeat; background-size: cover;">
<div class="reg-w3" >
<div class="w3layouts-main" style="opacity: 2;" >
	<h2 style="color: white;">Register Admin</h2>
        <form action="registration.php" method="post">
			<input type="text" class="ggg" name="name" placeholder="FULL NAME" required="">
			<input type="email" class="ggg" name="email" placeholder="E-MAIL" required="">
                        <input type="password" class="ggg" name="password" placeholder="PASSWORD" required="">
			<input type="password" class="ggg" name="v_password" placeholder="VERIFY PASSWORD" required="">
                        <h4><input type="checkbox" name="checkbox" checked="" value="yes">I agree to the Terms of Service and Privacy Policy</h4>
			
				<div class="clearfix"></div>
				<input type="submit" value="submit" name="submit">
        </form>
		<p>Already Registered.<a href="login.html">Login</a></p>
</div>
</div>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/scripts.js"></script>
<script src="js/jquery.slimscroll.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="js/jquery.scrollTo.js"></script>
</body>
</html>
