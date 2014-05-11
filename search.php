<?php

include("Classes/Category.php");
include("Classes/Product.php");

$term = trim(strip_tags($_GET['term']));
if(!empty($_GET['type'])){
$type = trim(strip_tags($_GET['type']));
$data[] =$term;
}

if(empty($type))
$rows = Category::autoCompleteName($term);

elseif($type=='รหัสสินค้า'){
    $type = 'productCode';
    $data[] = $type;
    $rows = Product::autoComplete($data);
    
}

elseif($type=='ชื่อสินค้า'){
    $type = 'productName';
    $data[] = $type;
    $rows = Product::autoComplete($data);
    
}
   
elseif($type=='หมวดหมู่ย่อย'){
    $type = 'name';
    $data[] = $type;
    $rows = Product::autoComplete($data);
}

elseif($type=='ยี่ห้อรถ'){
    $type = 'carbrand';
    $data[] = $type;
    $rows = Product::autoComplete($data);
}

elseif($type=='oemcode'){
    $type = 'oemcode';
    $data[] = $type;
    $rows = Product::autoComplete($data);
}
echo json_encode($rows);

?>