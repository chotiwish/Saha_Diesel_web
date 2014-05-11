<?php

session_start();

//header('Location: ' . $_SERVER['HTTP_REFERER']);
include("Classes/Product.php");


$data[] = array();
$data['note'] = $_POST['note'];
$data['carBrand'] = $_POST['carBrand'];
$data['oemCode'] = $_POST['oemCode'];
$data['barCode'] = $_POST['barCode'];
$data['productId'] = $_SESSION['productId'];
$data['submit'] = $_POST["submit"];
$data['mainCategory'] = $_POST["mainCategory"];
$data['subCategory'] = $_POST["subCategory"];
$data['productBrand'] = $_POST["productBrand"];
$data['supplier'] = $_POST["supplier"];
$data['productName'] = $_POST["productName"];
$data['productCode'] = $_POST["productCode"];
$data['qTy'] = $_POST["qTy"];
$data['size'] = $_POST["size"];
$data['poNo'] = $_POST["poNo"];
$data['receivedDate'] = $_POST["receivedDate"];
$data['safetyStock'] = $_POST["safetyStock"];
$data['buyPrice'] = $_POST["buyPrice"];
$data['sellPrice'] = $_POST["sellPrice"];
$data['price1'] = $_POST["price1"];
$data['price2'] = $_POST["price2"];
$data['price3'] = $_POST["price3"];
$data['option1'] = $_POST["option1"];
$data['option2'] = $_POST["option2"];
$data['option3'] = $_POST["option3"];
$data['option4'] = $_POST["option4"];
$data['option5'] = $_POST["option5"];
$data['sahaDieselBarcodeBuy'] = $_POST["sahaDieselBarcodeBuy"];
$data['sahaDieselBarcodeSell'] = $_POST["sahaDieselBarcodeSell"];

echo($data['oemCode'][0]."<br/>");
echo($data['oemCode'][1]."<br/>");
echo($data['note']."<br/>");
echo("0 : " . $data['productId'] . "<br/>");
echo("1 : " . $data['mainCategory'] . "<br/>");
echo("2 : " . $data['subCategory'] . "<br/>");
echo("3 : " . $data['productBrand'] . "<br/>");
echo("4 : " . $data['supplier'] . "<br/>");
echo("5 : " . $data['productName'] . "<br/>");
echo("6 : " . $data['productCode'] . "<br/>");
echo("7 : " . $data['qTy'] . "<br/>");
echo("8 : " . $data['size'] . "<br/>");
echo("9 : " . $data['poNo'] . "<br/>");
echo("10 : " . $data['receivedDate'] . "<br/>");
echo("11 : " . $data['safetyStock'] . "<br/>");
echo("12 : " . $data['buyPrice'] . "<br/>");
echo("13 : " . $data['sellPrice'] . "<br/>");
echo("14 : " . $data['price1'] . "<br/>");
echo("15 : " . $data['price2'] . "<br/>");
echo("16 : " . $data['price3'] . "<br/>");
echo("17 : " . $data['option1'] . "<br/>");
echo("18 : " . $data['option2'] . "<br/>");
echo("19 : " . $data['option3'] . "<br/>");
echo("20 : " . $data['option4'] . "<br/>");
echo("21 : " . $data['option5'] . "<br/>");
echo("22 : " . $data['sahaDieselBarcodeBuy'] . "<br/>");
echo("23 : " . $data['sahaDieselBarcodeSell'] . "<br/>");

echo $data['submit'];

if ($data['submit'] == "เพิ่ม") {
    $message = Product::insertProduct($data);
} else if ($data['submit'] == "แก้ไข") {
    $message = Product::editProduct($data);
} else if ($data['submit'] == "ลบ") {
    $message = Product::deleteProduct($data);
}
$_SESSION['status'] = $message;
?>