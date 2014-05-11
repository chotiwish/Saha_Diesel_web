<?php

include("Classes/Category.php");

$term = trim(strip_tags($_GET['term']));

$rows = Category::getCategory($term);

echo json_encode($rows);

?>