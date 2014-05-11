<?php
include 'Classes/Category.php';


if (!empty($_POST['submit'])) {
    session_start();
    $data[] = array();
    if(!empty($_REQUEST["main_category"]))$data['main_category'] = $_REQUEST["main_category"];
    if(!empty($_REQUEST["sub_category"]))$data['sub_category'] = $_REQUEST["sub_category"];
    if (!empty($_REQUEST["category_image"]))
        $data['category_image'] = $_REQUEST["category_image"];
    if(!empty($_REQUEST["prefix_product_id"]))$data['prefix_product_id'] = $_REQUEST["prefix_product_id"];
    if(!empty($_REQUEST["uom"]))$data['uom'] = $_REQUEST["uom"];
    if(!empty($_REQUEST["option1"]))$data['option1'] = $_REQUEST["option1"];
    if(!empty($_REQUEST["option2"]))$data['option2'] = $_REQUEST["option2"];
    if(!empty($_REQUEST["option3"]))$data['option3'] = $_REQUEST["option3"];
    if(!empty($_REQUEST["option4"]))$data['option4'] = $_REQUEST["option4"];
    if(!empty($_REQUEST["option5"]))$data['option5'] = $_REQUEST["option5"];

    $submit = $_POST["submit"];
    if(!empty($_SESSION['subId']))$data['subId'] = $_SESSION['subId'];
    $message = null;

    if ($submit == 'แก้ไข') {
        $message = Category::editCategory($data);
    }
    if ($submit == 'ลบ') {
        $message = Category::deleteSubCategory($data);
    }
}
?>

<link rel="stylesheet" type="text/css" href="css/style.css" >
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css" >
<script type="text/javascript" src="javascript/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="javascript/jquery-ui.min.js"></script>
<script type="text/javascript" src="javascript/form.js" ></script>
<script type="text/javascript" src="javascript/autocomplete.js" ></script>

<html>
    <head>
        <meta charset="UTF-8">
        <title>แก้ไขหมวดหมู่</title>
    </head>
    <body>
        <div>
            ค้นหา
            <input type="text" name="category" id="textSearchCat"> ค้นหาจากตัวเลือก
            <select name="listCategory" id="selectCategory">
                <option></option>
                <?php
                $qstring = "SELECT * FROM main_category";
                $rows = Category::getCategoryName($qstring);
                foreach ($rows as $categoryName) {
                    echo '<option>' . $categoryName . '</option>';
                };
                ?>
            </select>
            <table class="search">
                <thead>
                    <tr>
                        <th>หมวดหมู่หลัก</th>
                        <th>หมวดหมู่ย่อย</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="5">
                            <div class="tableoverflow">
                                <table class="bodysearch">

                                </table>
                        </td>
                    </tr>
                    </div>
                </tbody>
            </table>
        </div>
        <div>
            <form method="post" action="" enctype='multipart/form-data'>
                <h3>ข้อมูลหมวดหมู่ และ หมวดหมู่ย่อย</h3>
                <table>
                    <tr> 
                        <td>ชื่อหมวดหมู่หลัก</td>
                        <td><select name="main_category" id="main_category">
                                <option></option>
                                <?php
                                $qstring = "SELECT * FROM main_category";
                                $rows = Category::getCategoryName($qstring);
                                foreach ($rows as $categoryName) {
                                    echo '<option>' . $categoryName . '</option>';
                                };
                                ?>
                            </select></td>
                    </tr>
                    <tr>
                        <td>ชื่อหมวดหมู่ย่อย</td>
                        <td><input type="text" name="sub_category" id="sub_category"></td>
                    </tr>
                    <tr>
                        <td>รูปภาพ Standard</td>
                        <td><div id="img"></div><br/><input type="file" name="category_image" id="category_image"></td>
                    </tr>
                    <tr>
                        <td>รหัสเริ่มต้นสินค้า</td>
                        <td><input type="text" name="prefix_product_id" id="prefix_product_id"></td>
                    </tr>
                    <tr>
                        <td>หน่วย</td>
                        <td><input type="text" name="uom" id="uom"></td>
                    </tr>
                </table>

                <h2>ข้อมูลสินค้าในหมวดหมู่ </h2>
                <div class="content">
                    <h3>ข้อมูลเริ่มต้น </h3>
                    <input type="checkbox"checked disabled> รหัสสินค้า<br />
                    <input type="checkbox"checked disabled> ชื่อสินค้า<br />
                    <input type="checkbox"checked disabled> ชื่อยี่ห้อ<br />
                    <input type="checkbox"checked disabled> ชื่อบริษัทผู้ขาย<br />
                    <input type="checkbox"checked disabled> ราคาทุนต่อหน่วย<br />
                    <input type="checkbox"checked disabled> ราคาขายหน้าร้าน<br />
                    <input type="checkbox"checked disabled> ราคาขายพิเศษ 1<br />
                    <input type="checkbox"checked disabled> ราคาขายพิเศษ 2<br />
                    <input type="checkbox"checked disabled> ราคาขายพิเศษ 3<br />
                    <input type="checkbox"checked disabled> ขนาด<br />
                    <input type="checkbox"checked disabled> วันที่รับสินค้า<br />
                    <input type="checkbox"checked disabled> Barcode สินค้า<br />
                    <input type="checkbox"checked disabled> Barcode สหดีเซล<br />
                    <input type="checkbox"checked disabled> เลขที่ใบสั่งซื้อ<br />
                    <input type="checkbox"checked disabled> เตือนเมื่อจำนวนสินค้าต่ำกว่า<br />
					<input type="checkbox"checked disabled> ตำแหน่งสินค้า <br />
					<input type="checkbox"checked disabled> ยี่ห้อรถ<br />
					<input type="checkbox"checked disabled> OEM Code<br />
                </div>
                <div class="content">
                    <h3>ข้อมูลเพิ่มเติมที่ต้องการให้กรอก</h3>
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
                    <input type="submit" name="submit" id="updateproduct" value="แก้ไข">
                    <input type="button" name="cancel" value="ยกเลิก">
                    <input type="submit" name="submit" id="delete" value="ลบ">
                    <input type="button" name="export" id="export_excel"value="Export">
                    <input type="button" onClick="window.location.href = 'index.php'" value="กลับสู่หน้าแรก">
                    
                    <input type="hidden" name="export_sub_id" id="export_sub_id" value="0">
                </div>
            </form>
        </div>
    </body>
    <?php
    if (isset($message)) {
        if (($message == "ลบหมวดหมู่เสร็จสิ้น")||($message == "แก้ไขหมวดหมู่เสร็จสิ้น")) {
            echo "<script>"
            . "alert('$message');"
            . "window.location = 'index.php';"
            . "</script>";
        } else {
            echo "<script>"
            . "alert('$message');"
            . "window.history.back(-1);"
            . "</script>";
        }
    }
    ?>
</html>