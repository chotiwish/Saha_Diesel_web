<?php

include("Classes/Category.php");

$term = trim(strip_tags($_GET['term']));

$rows = Category::getSubCategory($term);

echo json_encode($rows);

?>