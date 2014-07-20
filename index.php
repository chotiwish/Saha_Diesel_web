<?php include("Classes/Product.php"); ?>
<link rel="stylesheet" type="text/css" href="css/style.css" >
<link rel="stylesheet" type="text/css" href="css/main_page.css" >
<html>
    <head>
        <meta charset="UTF-8">
        <title>เมนูหลัก</title>
    </head>
    <body>
        <h1>ยินดีต้อนรับ : </h1>
        <h3>หมวดหมู่</h3>
        <table>
            <tr> 
                <td> <button id="add_category" onClick="window.location = 'addcategory.php'">เพิ่มหมวดหมู่</button></td>
                <td> <button id="edit_category" onClick="window.location = 'editcategory.php'" >แก้ไขหมวดหมู่</button></td>
            </tr>
        </table>
        <h3>สินค้า</h3>
        <table>
            <tr>
                <td> <button id="add_product"  onClick="window.location = 'addproduct.php'">เพิ่มสินค้าด้วยตนเอง</button></td>
                <td> <button id="edit_product" onClick="window.location = 'editproduct.php'">แก้ไขสินค้าด้วยตนเอง</button></td>
                <td> <button id="add_product_exel" onClick="window.location = 'importexcel.php'">เพิ่มสินค้าด้วย Excel</button></td>
                <td> <button id="check_product" class="product_po" onClick="window.location = 'remainingproduct.php'">ตรวจสอบสินค้า</button></td>
                <td> <button id="printbarcode"class="product_po" onClick="window.open('printbarcoderesult.php','PrintBarcode',' width=800,height=1000')" >Sample Print Barcode</button></td>
            </tr>
        </table>
        
        <h3>สินค้าที่ใกล้จะหมด</h3>
        
        <table class="search">
            <thead>
                <tr>
                    <th>รหัสสินค้า</th>
                    <th>ชื่อสินค้า</th>
                    <th>คงเหลือ</th>
                </tr>
            </thead>
            <?php
            $safetyStock = Product::safetyStock();
            foreach ($safetyStock as $value) {
                echo "<tr>";
                foreach ($value as $data) {
                    echo "<td>".$data."</td>";
                }
                echo "</tr>";
            }
            
            ?>
        </table>
    </body>
</html>