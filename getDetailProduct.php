<?php

include("Classes/Product.php");

session_start();

$term = trim(strip_tags($_GET['term']));

$product = Product::getDetailProduct($term);

$_SESSION['productId']= $product[0];

echo json_encode($product);

?>