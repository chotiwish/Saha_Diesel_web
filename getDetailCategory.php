<?php
session_start();
include("Classes/Category.php");

$mainCategoryId = trim(strip_tags($_GET['mainCategoryId']));
$subName = trim(strip_tags($_GET['subName']));

$data[]=$mainCategoryId;
$data[]=$subName;

$rows = Category::getDetailCategory($data);
$_SESSION['subId']=$rows[3];

echo json_encode($rows);

?>