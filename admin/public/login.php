<?php require_once("../includes/Helpers/initialize.php"); ?>
<?php
         //checking if the user is logged in with the constructor
            
            $login_user = new LoginControl();
            $login_user->is_Logged_in();
            
            //login the user if the form is posted
            $login_user->loginUser($email="", $password="");
           // $message = $login_user->message;
?>
 <?php if(isset($_POST['msg'])){ ?>
        <script type="text/javascript">
        alert("<?php echo $message = $_POST['msg']; ?>")
        </script>
 <?php } ?>
<!DOCTYPE html>
<head>
<title>HMS LOGIN</title>
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
<body style="background-image: url(images/ba2.jpg); background-repeat: ; background-size: cover;">
<div class="log-w3">
<div class="w3layouts-main">
	<h2 style="color: white;">Sign In Now</h2>
        <form action="login.php" method="post">
			<input type="email" class="ggg" name="email" placeholder="E-MAIL" required="">
			<input type="password" class="ggg" name="password" placeholder="PASSWORD" required="">
                        <span><input type="checkbox" name="checkbox" value="yes"/>Remember Me</span>
<!--			<h6><a href="#">Forgot Password?</a></h6>-->
				<div class="clearfix"></div>
				<input type="submit" value="Sign In" name="submit">
		</form>
<!--		<p>Don't Have an Account ?<a href="registration.html">Create an account</a></p>-->
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
