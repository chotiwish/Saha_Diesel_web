<?php

include("Classes/Product.php");

$term = trim(strip_tags($_GET['term']));
$type = trim(strip_tags($_GET['type']));


$data[]=$term;
$data[]=$type;

$rows = Product::searchProductAndAllCodes($data);

echo json_encode($rows);
?>