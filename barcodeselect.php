<?php
include 'Classes/Category.php';
include 'Classes/Product.php';
if (!empty($_POST['submit'])) {
    session_start();
    $data[] = array();
    if (!empty($_REQUEST['note']))
        $data['note'] = $_REQUEST['note'];
    if (!empty($_REQUEST['carBrand']))
        $data['carBrand'] = $_REQUEST['carBrand'];
    if (!empty($_REQUEST['oemCode']))
        $data['oemCode'] = $_REQUEST['oemCode'];
    if (!empty($_REQUEST['barCode']))
        $data['barCode'] = $_REQUEST['barCode'];
    if (!empty($_SESSION['productId']))
        $data['productId'] = $_SESSION['productId'];
    if (!empty($_REQUEST["product_image"]))
        $data['product_image'] = $_REQUEST["product_image"];
    if (!empty($_REQUEST["submit"]))
        $data['submit'] = $_REQUEST["submit"];
    if (!empty($_REQUEST["mainCategory"]))
        $data['mainCategory'] = $_REQUEST["mainCategory"];
    if (!empty($_REQUEST["subCategory"]))
        $data['subCategory'] = $_REQUEST["subCategory"];
    if (!empty($_REQUEST["productBrand"]))
        $data['productBrand'] = $_REQUEST["productBrand"];
    if (!empty($_REQUEST["supplier"]))
        $data['supplier'] = $_REQUEST["supplier"];
    if (!empty($_REQUEST["productName"]))
        $data['productName'] = $_REQUEST["productName"];
    if (!empty($_REQUEST["productCode"]))
        $data['productCode'] = $_REQUEST["productCode"];
    if (!empty($_REQUEST["qTy"]))
        $data['qTy'] = $_REQUEST["qTy"];
    if (!empty($_REQUEST["size"]))
        $data['size'] = $_REQUEST["size"];
    if (!empty($_REQUEST["poNo"]))
        $data['poNo'] = $_REQUEST["poNo"];
    if (!empty($_REQUEST["receivedDate"]))
        $data['receivedDate'] = $_REQUEST["receivedDate"];
	if (!empty($_REQUEST["itemLocation"]))
        $data['itemLocation'] = $_REQUEST["itemLocation"];
    if (!empty($_REQUEST["safetyStock"]))
        $data['safetyStock'] = $_REQUEST["safetyStock"];
    if (!empty($_REQUEST["buyPrice"]))
        $data['buyPrice'] = $_REQUEST["buyPrice"];
    if (!empty($_REQUEST["sellPrice"]))
        $data['sellPrice'] = $_REQUEST["sellPrice"];
    if (!empty($_REQUEST["price1"]))
        $data['price1'] = $_REQUEST["price1"];
    if (!empty($_REQUEST["price2"]))
        $data['price2'] = $_REQUEST["price2"];
    if (!empty($_REQUEST["price3"]))
        $data['price3'] = $_REQUEST["price3"];
    if (!empty($_REQUEST["option1"]))
        $data['option1'] = $_REQUEST["option1"];
    if (!empty($_REQUEST["option2"]))
        $data['option2'] = $_REQUEST["option2"];
    if (!empty($_REQUEST["option3"]))
        $data['option3'] = $_REQUEST["option3"];
    if (!empty($_REQUEST["option4"]))
        $data['option4'] = $_REQUEST["option4"];
    if (!empty($_REQUEST["option5"]))
        $data['option5'] = $_REQUEST["option5"];
    if (!empty($_REQUEST["sahaDieselBarcodeBuy"]))
        $data['sahaDieselBarcodeBuy'] = $_REQUEST["sahaDieselBarcodeBuy"];
    if (!empty($_REQUEST["sahaDieselBarcodeSell"]))
        $data['sahaDieselBarcodeSell'] = $_REQUEST["sahaDieselBarcodeSell"];
    $submit = $_POST['submit'];
    $message = null;


}
?>
<link rel="stylesheet" type="text/css" href="css/style-remain.css" >
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css" >
<script type="text/javascript" src="javascript/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="javascript/jquery-ui.min.js"></script>
<script type="text/javascript" src="javascript/barcode_form.js" ></script>
<script type="text/javascript" src="javascript/sahadieselcode.js" ></script>
<script type="text/javascript" src="javascript/autocomplete.js" ></script>

<html>
    <head>
        <meta charset="UTF-8">
        <title>ตรวจสอบจำนวนสินค้า</title>
    </head>
    <body>
        ค้นหา <input type="text" id="textSearchPro">
        <select id='searchType'>
            <option>รหัสสินค้า</option>
            <option>ชื่อสินค้า</option>
            <option>หมวดหมู่ย่อย</option>
            <option>ยี่ห้อรถ</option>
            <option>oemcode</option>
            <option>barcode</option>
        </select>
        <button id="searchRemainingProduct">ค้นหา</button>
        <input type="button" onClick="window.location.href = 'index.php'" value="กลับสู่หน้าแรก">

           
            <div class="tableoverflow" style="display:none;">
                <table class="bodysearch">
                              <thead>
                <tr>
                    <th>รหัสสินค้า</th>
                    <th>ชื่อสินค้า</th>
                    <th>ชื่อยี่ห้อ</th>
                    <th>หมวดหมู่ย่อย</th>
                    <th>note</th>
                    <th><span id="extra">code</span></th>
                    <th>คงเหลือ</th>
                    <th>สหดีเซลโค้ด</th>
                    <th>สหดีเซลโค้ด</th>
                    <th></th>
                </tr>
            </thead>
                        <tbody>
        </tbody>
                </table>
            </td>
                </tr>
            </div>
   
               <div class="tableoverflow printsection" style="display:none;">
               <button id="printbarcode"class="product_po" disabled="disabled"> Print Barcode</button>
        		<!--<button id="printbarcode"class="product_po" onClick="window.open('printbarcoderesult.php','PrintBarcode',' width=800,height=1000')" > Print Barcode</button>-->
                <table class="barcodeTableBody">
                              <thead>
                <tr>
                    <th>รหัสสินค้า</th>
                    <th>ชื่อสินค้า</th>
                    <th>สหดีเซลโค้ด</th>
                    <th>สหดีเซลโค้ด</th>
                    <th>จำนวน</th>
                    <th></th>
                </tr>
            </thead>
                        <tbody>
        </tbody>
                </table>
            </td>
                </tr>
            </div>
   
</body>

</html>