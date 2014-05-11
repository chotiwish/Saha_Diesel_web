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

    if ($data['submit'] == "แก้ไข") {
        $message = Product::editProduct($data);
    } else if ($data['submit'] == "ลบ") {
        $message = Product::deleteProduct($data);
    }
}
?>
<link rel="stylesheet" type="text/css" href="css/style.css" >
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css" >
<script type="text/javascript" src="javascript/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="javascript/jquery-ui.min.js"></script>
<script type="text/javascript" src="javascript/form.js" ></script>
<script type="text/javascript" src="javascript/sahadieselcode.js" ></script>
<script type="text/javascript" src="javascript/autocomplete.js" ></script>

<html>
    <head>
        <meta charset="UTF-8">
        <title>แก้ไขสินค้าด้วยตนเอง</title>
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
        <button id="searchProduct">ค้นหา</button>
        <table class="search">
            <thead>
                <tr>
                    <th>รหัสสินค้า</th>
                    <th>ชื่อสินค้า</th>
                    <th>ชื่อยี่ห้อ</th>
                    <th>หมวดหมู่ย่อย</th>
                    <th>note</th>
                    <th><span id="extra">code</span></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="6">
            <div class="tableoverflow">
                <table class="bodysearch">
                    
                </table>
            </td>
                </tr>
            </div>
        </tbody>
    </table>
    <div>
        <div>
            <form method="post" action="" id="addProduct" enctype='multipart/form-data'>
                <h2>ข้อมูลสินค้า</h2>
                <div class="content">
                    <table>
                        <tr> 
                            <td>ชื่อหมวดหมู่หลัก</td>
                            <td>
                                <select id="mainCategory" name="mainCategory">
                                    <option></option>
<?php
$rows = Category::getCategoryName();
foreach ($rows as $categoryName) {
    echo '<option>' . $categoryName . '</option>';
};
?>
                                </select>
                            </td>

                        </tr>
                        <tr>
                            <td>ชื่อหมวดหมู่ย่อย</td>
                            <td><select id="subCategory" name="subCategory"></select></td>
                        </tr>
                        <tr>
                            <td>ชื่อยี่ห้อ</td>
                            <td><input type="text" name="productBrand" id="productBrand"></td>
                        </tr>
                        <tr>
                            <td>รูปภาพสินค้า</td>
                            <td><div id="img"></div><br/><input type="file" name="product_image" id="product_image "style="width:150px;"></td>
                        </tr>
                        <tr>
                            <td>ชื่อบริษัทผู้ขาย</td>
                            <td><input type="text" name="supplier" id="supplier"></td>
                        </tr>
                        <tr>
                            <td>ชื่อสินค้า</td>
                            <td><input type="text" name="productName" id="productName"></td>
                        </tr>
                        <tr>
                            <td>รหัสสินค้า</td>
                            <td><input type="text" name="productCode" id="productCode"></td>
                        </tr>
                        <tr>
                            <td>จำนวน</td>
                            <td><input type="text" name="qTy" id="qTy"></td>
                        </tr>
                        <tr>
                            <td>ขนาด</td>
                            <td><input type="text" name="size" id="size"></td>
                        </tr>
                        <tr>
                            <td>เลขที่ใบสั่งซื้อ</td>
                            <td><input type="text" name="poNo" id="poNo"></td>
                        </tr>
                        <tr>
                            <td>วันที่รับสินค้า</td>
                            <td><input type="text" name="receivedDate" id="receivedDate"></td>
                        </tr>
						<tr>
                            <td>ตำแหน่งสินค้า</td>
                            <td><input type="text" name="itemLocation" id="itemLocation"></td>
                        </tr>
                        <tr>
                            <td>เตือนเมื่อจำนวนต่ำกว่ากำหนด</td>
                            <td><input type="text" name="safetyStock" id="safetyStock"></td>
                        </tr>
                        <tr>
                            <td>ยี่ห้อรถ</td>
                            <td><input type="text" name="carbrand" id="inputCarBrand"><button id="addCarBrand">+</button></td>
                        </tr>
                        <tr>
                            <td>ยี่ห้อรถ</td>
                            <td>
                                <select size="6" id="selectCarBrand" style="width:150px;overflow:scroll;" multiple>
                                    <option>Hino</option>
                                    <option>Isuzu</option>
                                    <option>Nissan</option>
                                    <option>Mitsubishi</option>
                                    <option>Toyota</option>
                                    <option>หางพ่วง</option>
                                    <option>Other</option>
                                </select>
                            <td>
                                <button id="useSelectCarBrand"> > </button><br/>
                                <button id="unusedSelectCarBrand"> < </button><br/>
                                <button id="delCarBrand">-</button>
                                </td>
                                <td>
                            <select size="6" id="carBrand" name="carBrand[]" style="width:150px;overflow:scroll;" multiple >
                                    
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>OEM's Code</td>
                            <td><input type="text" name="oemcode" id="inputOemCode"><button id="addOemCode">+</button></td>
                        </tr>
                        <tr>
                            <td>OEM's Code</td>
                            <td><select size="6" id="oemCode" name="oemCode[]" style="width:100px;overflow:scroll;" multiple ></select><button id="delOemCode">-</button></td>
                        </tr>
                    </table>
                </div>
                <div>
                    <h2>ราคา </h2>
                    <table>
                        <tr>
                            <td>ราคาทุน</td>
                            <td><input type="text" name="buyPrice" id="buyPrice"></td>
                        </tr>
                        <tr>
                            <td>ราคาขายหน้าร้าน</td>
                            <td><input type="text" name="sellPrice" id="sellPrice"></td>
                        </tr>
                        <tr>
                            <td>ราคาพิเศษ 1</td>
                            <td><input type="text" name="price1" id="price1"></td>
                        </tr>
                        <tr>
                            <td>ราคาพิเศษ 2</td>
                            <td><input type="text" name="price2" id="price2"></td>
                        </tr>
                        <tr>
                            <td>ราคาพิเศษ 3</td>
                            <td><input type="text" name="price3" id="price3"></td>
                        </tr>
                        <tr>
                            <td>Barcode สินค้า</td>
                            <td><input type="text" name="barcode" id="inputBarCode"><button id="addBarCode">+</button></td>
                        </tr>
                        <tr>
                            <td>Barcode สินค้า</td>
                            <td><select size="6" id="barCode" name="barCode[]" style="width:100px;overflow:scroll;" multiple ></select><button id="delBarCode">-</button></td>
                        </tr>
                        <tr>
                            <td>Barcode Saha Diesel (ซื้อ)</td>
                            <td><input type="text" name="sahaDieselBarcodeBuy" id="sahaDieselBarcodeBuy"></td>
                        </tr>
                        <tr>
                            <td>Barcode Saha Diesel (ขาย)</td>
                            <td><input type="text" name="sahaDieselBarcodeSell" id="sahaDieselBarcodeSell"></td>
                        </tr>
                        <tr>
                            <td>Note</td>
                            <td><textarea rows="5" name="note" form="addProduct" id='note'></textarea></td>
                        </tr>
                    </table>
                </div>
                <div class="content">
                    <div id="divOption">
                        <h3>ข้อมูลพิเศษ</h3>
                        <div id="option">
                            ข้อมูลเพิ่มเติม 1
                            <input type="text" name="option1" id="option1"><br/>
                            ข้อมูลเพิ่มเติม 2
                            <input type="text" name="option2" id="option2"><br/>
                            ข้อมูลเพิ่มเติม 3
                            <input type="text" name="option3" id="option3"><br/>
                            ข้อมูลเพิ่มเติม 4
                            <input type="text" name="option4" id="option4"><br/>
                            ข้อมูลเพิ่มเติม 5
                            <input type="text" name="option5" id="option5"><br/>
                        </div>
                    </div>
                    <input type="submit" name="submit" id="updateproduct" value="แก้ไข">
                    <input type="submit" name="submit" id="delete" value="ลบ">
                    <input type="button" onClick="window.location.href = 'index.php'" value="กลับสู่หน้าแรก">
                </div>
            </form>
        </div>
</body>
<?php
if (isset($message)) {
    
    if (($message == "แก้ไขหมวดหมู่เสร็จสิ้น")||($message == "ลบหมวดหมู่เสร็จสิ้น")) {
        echo "<script>"
        . "alert('$message');"
        . "window.location = 'index.php';"
        . "</script>";
    }
    else{
        echo "<script>"
        . "alert('$message');"
        . "window.history.back(-1);"
        . "</script>";
    }
}
?>
</html>