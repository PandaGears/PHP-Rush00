<!DOCTYPE>
<?php 
session_start();
include("functions/functions.php");

?>
<html>
	<head>
		<title>Wethinkwed</title>
		
		
	<link rel="stylesheet" href="style/style.css" media="all" /> 
	</head>
	
<body>
	
	<!--Main Container starts here-->
	<div class="main_wrapper">
	
		<!--Header starts here-->
		<div class="header_wrapper">
		
			<a href="index.php"><img id="logo" src="img/logo.jpg" /> </a>
			<img id="banner" src="img/banner.jpg" />
		</div>
		<!--Header ends here-->
		
		<!--Navigation Bar starts-->
		<div class="menubar">
			
			<ul id="menu">
				<li><a href="index.php">Home</a></li>
				<li><a href="all_products.php">All Products</a></li>
				<li><a href="customer/my_account.php">My Account</a></li>
				<li><a href="customer_login.php">Sign Up</a></li>
				<li><a href="cart.php">Shopping Cart</a></li>
				<li><a href="#">Contact Us</a></li>
			
			</ul>
			
			<div id="form">
				<form method="get" action="results.php" enctype="multipart/form-data">
					<input type="text" name="user_query" placeholder="Search a Product" /> 
					<input type="submit" name="search" value="Search" />
				</form>
			
			</div>
			
		</div>
		<!--Navigation Bar ends-->
	
		<!--Content wrapper starts-->
		<div class="content_wrapper">
		
			<div id="sidebar">
			
				<div id="sidebar_title">Categories</div>
				
				<ul id="cats">
				
				<?php getCats(); ?>
				
				<ul>
					
				<div id="sidebar_title">Genders</div>
				
				<ul id="cats">
					
					<?php getCats2(); ?>
				
				<ul>
			
			
			</div>
		
			<div id="content_area">
			
			<?php cart(); ?>
			
			<div id="shopping_cart"> 
					
					<span style="float:right; font-size:18px; padding:5px; line-height:40px;">
					
					<?php 
					if(isset($_SESSION['customer_email'])){
					echo "<b>Welcome:</b>" . $_SESSION['customer_email'] . "<b style='color:White;'>Your</b>" ;
					}
					else {
					echo "<b>Welcome Guest:</b>";
					}
					?>
					
					
					<b style="color:White">Shopping Cart -</b> Total Items: <?php total_items();?> Total Price: <?php total_price(); ?> <a href="cart.php" style="color:White">Go to Cart</a>
					
					
					
					</span>
			</div>
			
				<div id="products_box">
				
				<?php 
				if(!isset($_SESSION['customer_email'])){
					
					include("customer_login.php");
				}
				else {
					include("payment.php");
				}
				?>
				<h1 style="text-align: center;"><strong>PROCEED TO PAYMENT</strong></h1>
<p><a title="PayPal" href="https://www.paypal.com"><img style="display: block; margin-left: auto; margin-right: auto;" src="http://pluspng.com/img-png/paypal-png--1024.jpg" alt="PayPal" width="512" height="256" /></a></p>
				</div>
			
			</div>
			
		</div>
		<!--Content wrapper ends-->

		<div id="footer">
		<h2 style="text-align:center; padding-top:30px;">&copy; 2018 by wethinkcode </h2>
		</div>
	</div> 
<!--Main Container ends here-->


</body>
</html>