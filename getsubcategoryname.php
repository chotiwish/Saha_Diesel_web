<?php

include("Classes/Category.php");

$term = trim(strip_tags($_GET['term']));

$rows = Category::getSubCategoryName($term);

echo json_encode($rows);

?>