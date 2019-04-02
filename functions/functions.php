<?php
$con = mysqli_connect("localhost","root","nopenope","not_rush00");
$sql = "SET GLOBAL sql_mode=\'\'";
if (mysqli_connect_errno()){
	echo "Nope, no connections happening, mate..." . mysql_connect_error();
}

function getIp() {
	$ip = $_SERVER['REMOTE_ADDR'];

	if (!empty($_SERVER['HTTP_CLIENT_IP'])){
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	}
	elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	return $ip;
}

function cart(){

	if(isset($_GET['add_cart'])){
		global $con; 
		$ip = getIp();
		$pro_id = $_GET['add_cart'];
		$check_pro = "select * from cart where ip_add='$ip' AND p_id='$pro_id'";
		$run_check = mysqli_query($con, $check_pro); 
		
		$quant = 1;

		if(mysqli_num_rows($run_check)>0){
		echo "";
		}
		else {
		$insert_pro = "insert into cart (p_id,ip_add,qty) values ('$pro_id','$ip','$quant')";
		$run_pro = mysqli_query($con, $insert_pro); 
		echo "<script>alert('Successfully added to cart!')</script>";
		echo "<script>window.open('index.php','_self')</script>";
		}
	}	
}
function updatecart(){
		
	global $con; 
	
	$ip = getIp();
	
	if(isset($_POST['update_cart'])){
		foreach($_POST['remove'] as $remove_id){
		$delete_product = "delete from cart where p_id='$remove_id' AND ip_add='$ip'";
		$run_delete = mysqli_query($con, $delete_product); 
		if($run_delete){
		echo "<script>window.open('cart.php','_self')</script>";
		}
		}
	}
	if(isset($_POST['continue'])){
	echo "<script>window.open('index.php','_self')</script>";
	
	}

}
echo @$up_cart = updatecart();

function total_items(){
 
	if(isset($_GET['add_cart'])){
	
		global $con; 
		
		$ip = getIp(); 
		$get_items = "select * from cart where ip_add='$ip'";
		$run_items = mysqli_query($con, $get_items); 
		$count_items = mysqli_num_rows($run_items);		
		}	
		else {	
		global $con; 	
		$ip = getIp(); 
		$get_items = "select * from cart where ip_add='$ip'";	
		$run_items = mysqli_query($con, $get_items); 	
		$count_items = mysqli_num_rows($run_items);
		}
	
	echo $count_items;
	}
  
// Getting the total price of the items in the cart 
	
	function total_price(){
	
		$total = 0;
		
		global $con; 
		$ip = getIp(); 
		$sel_price = "select * from cart where ip_add='$ip'";
		$run_price = mysqli_query($con, $sel_price); 	
		while($p_price=mysqli_fetch_array($run_price)){	
			$pro_id = $p_price['p_id']; 
			$pro_price = "select * from products where product_id='$pro_id'";
			$run_pro_price = mysqli_query($con,$pro_price); 
			while ($pp_price = mysqli_fetch_array($run_pro_price)){
			$product_price = array($pp_price['product_price']);		
			$values = array_sum($product_price);
			$total +=$values;
			
			}		
		}		
		echo $total . "Gp";
		
	
	}

//getting the categories
function getCats() {
	global $con;
	$get_cats = "select * from categories";
	$run_cats = mysqli_query($con, $get_cats);
	while ($row_cats=mysqli_fetch_array($run_cats)) {
		
		$cat_id = $row_cats['cat_id'];
		$cat_title = $row_cats['cat_title'];
		echo "<li><a href='index.php?cat=$cat_id'>$cat_title</a></li>";
	}
}
function getCats2() {
	global $con;
	$get_cats2 = "select * from genders";
	$run_cats2 = mysqli_query($con, $get_cats2);
	while ($row_cats2=mysqli_fetch_array($run_cats2)) {
		
		$gender_id = $row_cats2['gender_id'];
		$gender_title = $row_cats2['gender_title'];
		echo "<li><a href='index.php?cat2=$gender_id'>$gender_title</a></li>";
	}
}

function getPro () {
	
	if(!isset($_GET['cat'])) {
		if(!isset($_GET['cat2'])) {
		global $con;
		$get_pro = "select * from products order by RAND() LIMIT 0,6";
		$run_pro = mysqli_query($con, $get_pro);
		while ($row_pro = mysqli_fetch_array($run_pro)) {
		
			$pro_id = $row_pro['product_id'];
			$pro_cat = $row_pro['product_cat'];
			$pro_cat2 = $row_pro['product_cat2'];
			$pro_title = $row_pro['product_title'];
			$pro_price = $row_pro['product_price'];
			$pro_image = $row_pro['product_image'];
			echo "
				<div id='single_product'>
					<h3>$pro_title</h3>
					<img src='admin_area/product_images/$pro_image' width='180' height='180' />
					<p><b> $pro_price Gp</b></p>
					<a href='details.php?pro_id=$pro_id' style='float:left';>Details</a>
					<a href='index.php?add_cart=$pro_id'><button style='float:right'>Add to Cart</button></a>
				</div>
			";
		}
		}
	}
}
//getting the product details for categories 
function getCatPro () {
	
	if(isset($_GET['cat'])){
		
		$cat_id = $_GET['cat'];
		global $con;
		$get_cat_pro = "select * from products where product_cat=$cat_id";
		$run_cat_pro = mysqli_query($con, $get_cat_pro);
		$count_cats = mysqli_num_rows($run_cat_pro);
		
		if($count_cats==0) {
			echo "<h2>Still Scouting, Stay Right Where You Are...</h2>";
			exit();
		}
		else {
			
			while ($row_cat_pro = mysqli_fetch_array($run_cat_pro)) {
		
				$pro_id = $row_cat_pro['product_id'];
				$pro_cat = $row_cat_pro['product_cat'];
				$pro_cat2 = $row_cat_pro['product_cat2'];
				$pro_title = $row_cat_pro['product_title'];
				$pro_price = $row_cat_pro['product_price'];
				$pro_image = $row_cat_pro['product_image'];
				echo "
					<div id='single_product'>
						<h3>$pro_title</h3>
						<img src='admin_area/product_images/$pro_image' width='180' height='180' />
						<p><b> $pro_price Gp</b></p>
						<a href='details.php?pro_id=$pro_id' style='float:left';>Details</a>
						<a href='index.php?add_cart=$pro_id'><button style='float:right'>Add to Cart</button></a>
					</div>
				";
			}
		}
	}
}
function getCat2Pro () {
	
	if(isset($_GET['cat2'])){
		
		$gender_id = $_GET['cat2'];
		global $con;
		$get_cat2_pro = "select * from products where product_cat2=$gender_id";
		$run_cat2_pro = mysqli_query($con, $get_cat2_pro);
		$count_cats2 = mysqli_num_rows($run_cat2_pro);
		
		if($count_cats2==0) {
			echo "<h2>Still Scouting, Stay Right Where You Are...</h2>";
			exit();
		}
		else {
			
			while ($row_cat2_pro = mysqli_fetch_array($run_cat2_pro)) {
		
				$pro_id = $row_cat2_pro['product_id'];
				$pro_cat = $row_cat2_pro['product_cat'];
				$pro_cat2 = $row_cat2_pro['product_cat2'];
				$pro_title = $row_cat2_pro['product_title'];
				$pro_price = $row_cat2_pro['product_price'];
				$pro_image = $row_cat2_pro['product_image'];
				echo "
					<div id='single_product'>
						<h3>$pro_title</h3>
						<img src='admin_area/product_images/$pro_image' width='180' height='180' />
						<p><b> $pro_price Gp</b></p>
						<a href='details.php?pro_id=$pro_id' style='float:left';>Details</a>
						<a href='index.php?add_cart=$pro_id'><button style='float:right'>Add to Cart</button></a>
					</div>
				";
			}
		}
	}
}
?>