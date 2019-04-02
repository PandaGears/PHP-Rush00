<?php
/*
**  Login and Database information
*/
$servername = "localhost";
$username = "root";
$password = "nopenope";
$dbname = "not_rush00";
$tbl_cart = "cart";
$tbl_cats = "categories";
$tbl_gend = "genders";
$tbl_prod = "products";
$tbl_cust = "customers";

// Create connection
$conn = mysqli_connect($servername, $username, $password);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error()."<br>");
}

// Create database if it hasn't been already
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if (mysqli_query($conn, $sql)) {
    echo "Database created successfully<br>";
} else {
    echo "Error creating database: " . mysqli_error($conn)."<br>";
}

// Refresh connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error()."<br>");
}

// Checkout Cart Table
$sql = "CREATE TABLE IF NOT EXISTS $tbl_cart (
    p_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL, 
    ip_add VARCHAR(255) NOT NULL,
    qty INT(10) NOT NULL)";

if (mysqli_query($conn, $sql)) {
    echo " Cart Table created successfully<br>";
} else {
    echo "Error creating table: ".mysqli_error($conn)."<br>";
}

// Victim Category Table
$sql = "CREATE TABLE IF NOT EXISTS $tbl_cats (
	cat_id INT(100) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL, 
	cat_title TEXT NOT NULL)";
	
if (mysqli_query($conn, $sql)) {
	echo "Categories Table created successfully<br>";
} else {
	echo "Error creating table: ".mysqli_error($conn)."<br>";
}

$sql = "INSERT INTO $tbl_cats (cat_id, cat_title) VALUES
(1, 'Humans'),
(2, 'Orcs'),
(3, 'Elves'),
(4, 'Dwarves'),
(5, 'Tieflings'),
(6, 'Dragonborns'),
(7, 'Halflings'),
(10, 'Gnomes')";

if (mysqli_query($conn, $sql)) {
    echo "Categories created successfully<br>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn)."<br>";
}

// Gender Table
$sql = "CREATE TABLE IF NOT EXISTS $tbl_gend (
    gender_id INT(100) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL, 
    gender_title TEXT NOT NULL)";
    
if (mysqli_query($conn, $sql)) {
    echo "Gender Table created successfully<br>";
} else {
    echo "Error creating table: ".mysqli_error($conn)."<br>";
}

$sql = "INSERT INTO $tbl_gend (gender_id, gender_title) VALUES
(1, 'Male'),
(2, 'Female'),
(3, 'Other')";

if (mysqli_query($conn, $sql)) {
    echo "Gender records created successfully<br>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn)."<br>";
}

// Details of Products Table
$sql = "CREATE TABLE IF NOT EXISTS $tbl_prod (
    product_id INT(100) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL, 
    product_cat VARCHAR(30) NOT NULL,
    product_cat2 VARCHAR(30) NOT NULL,
    product_title VARCHAR(30) NOT NULL,
	product_price VARCHAR(100) NOT NULL,
	product_desc TEXT NOT NULL,
	product_image TEXT NOT NULL,
	product_keywords TEXT NOT NULL)";

if (mysqli_query($conn, $sql)) {
    echo "Products Table created successfully<br>";
} else {
    echo "Error creating table: ".mysqli_error($conn)."<br>";
}

$sql = "INSERT INTO $tbl_prod (product_id, product_cat, product_cat2, product_title, product_price, product_desc, product_image, product_keywords) VALUES
(1, 2, 1, 'Orca', '1500', '<p>She Attac, She Protec, but most importantly, she does you a Heck</p>', 'Orca.png', 'Half-Orc, Female'),
(2, 3, 2, 'Neebs', '2', '<p>(4 gold if you want an unlimited supply of wonderbrooms)</p>', 'wood-elf.png', 'Elf, Tightanus'),
(3, 7, 3, 'not a bull', '100', '<p>A Halfling with a skin condition, no big</p>', 'goblin.png', 'Halfling?'),
(4, 1, 0, 'Pomp', 'free', '<p>Errrrrmmmmm... He really knows how to blow a horn?</p>', 'Human_bard.png', 'Bard'),
(5, 1, 1, 'Bullete', '2000', '<p>Is adamant that she is a human, refuses to believe otherwise</p>', 'Hathor_p146.jpg', 'Taur'),
(6, 4, 2, 'Nameless Harem', '150000', '<p>These people are a bundle special, for your eyes only (shhhhhhhhhhhh)</p>', 'Elligables.jpg', 'Harem'),
(7, 5, 1, 'Poly & Amori', '3000', '<p>Another Package deal for the lonely soul</p>', '2_for_1.png', 'Poly'),
(8, 3, 2, 'Not Sera', '1500', '<p>Insta cash with busker spouse</p>', 'Elf_3.jpg', 'Elf'),
(9, 7, 2, 'Pinto', '1500', '<p>Do not ask why we have so many bards...</p>', 'Halfling.png', 'Strings'),
(10, 6, 0, 'Garr', '5000', '<p>This old veteran wants another chance at love, even if someone has to pay for it</p>', 'Webp.net-resizeimage.jpg', 'Dragonborn')";

if (mysqli_query($conn, $sql)) {
    echo "Products records created successfully<br>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn)."<br>";
}

// User Table
$sql = "CREATE TABLE IF NOT EXISTS $tbl_cust (
	customer_id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	customer_ip VARCHAR(255) NOT NULL,
	customer_name TEXT NOT NULL,
  	customer_lname TEXT NOT NULL,
  	customer_email VARCHAR(255) NOT NULL,
  	customer_pass VARCHAR(100) NOT NULL,
  	customer_country TEXT NOT NULL,
  	customer_city TEXT NOT NULL,
  	customer_contact VARCHAR(255) NOT NULL,
  	customer_address TEXT NOT NULL,
  	customer_image TEXT NOT NULL
	)";
	
if (mysqli_query($conn, $sql)) {
	echo "Table Users created successfully<br>";
} else {
	echo "Error creating table: ".mysqli_error($conn)."<br>";
}

mysqli_close($conn);
?>