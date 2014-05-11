<?php
include 'Classes/Category.php';

if (!empty($_POST['submit'])) {
    $submit = $_POST['submit'];
    $data[] = array();
    $data['main_category'] = $_REQUEST["main_category"];
    $data['sub_category'] = $_REQUEST["sub_category"];
    if(!empty($_REQUEST["category_image"]))$data['category_image'] = $_REQUEST["category_image"];
    $data['prefix_product_id'] = $_REQUEST["prefix_product_id"];
    $data['uom'] = $_REQUEST["uom"];
    $data['option1'] = $_REQUEST["option1"];
    $data['option2'] = $_REQUEST["option2"];
    $data['option3'] = $_REQUEST["option3"];
    $data['option4'] = $_REQUEST["option4"];
    $data['option5'] = $_REQUEST["option5"];

    $message = null;
    if ($submit == 'เพิ่ม') {
        $message = Category::insertCategory($data);
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
        <title>เพิ่มหมวดหมู่</title>
    </head>
    <body>
        <div>
            <form method="post" action="" enctype='multipart/form-data' id="addCategory">
                <h2>ข้อมูลหมวดหมู่ และ หมวดหมู่ย่อย</h2>
                <table>
                    <tr> 
                        <td>ชื่อหมวดหมู่หลัก</td>
                        <td><input type="text" name="main_category" id="main_category"></td>
                        <td><input type="checkbox" name="copy_default" id="copy">Copy ค่า Default จากหมวดหมู่อื่น</td>
                    </tr>
                    <tr>
                        <td>ชื่อหมวดหมู่ย่อย</td>
                        <td><input type="text" name="sub_category" id="sub_category"></td>
                        <td><select name="selectCategory" id="copyCategory" disabled>
                                <option></option>
                                <?php
                                $rows = Category::getCategoryName();
                                foreach ($rows as $categoryName) {
                                    echo '<option>' . $categoryName . '</option>';
                                };
                                ?>
                            </select></td>
                    </tr>
                    <tr>
                        <td>รูปภาพ Standard</td>
                        <td><input type="file" name="category_image" id="category_image"></td>
                    </tr>
                    <tr>
                        <td>รหัสเริ่มต้นสินค้า</td>
                        <td><input type="text" name="prefix_product_id" id="prefix_product_id"></td>
                    </tr>
                    <tr>
                        <td>หน่วย</td>
                        <td><input type="text" name="uom" id="uom" ></td>
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
                    <input type="text" name="option1" value=""><br/>
                    ข้อมูลเพิ่มเติม 2
                    <input type="text" name="option2" value=""><br/>
                    ข้อมูลเพิ่มเติม 3
                    <input type="text" name="option3" value=""><br/>
                    ข้อมูลเพิ่มเติม 4
                    <input type="text" name="option4" value=""><br/>
                    ข้อมูลเพิ่มเติม 5
                    <input type="text" name="option5" value=""><br/>
                    <input type="submit" name="submit" value="เพิ่ม">
                    <input type="button" name="cancel" value="ยกเลิก">
                    <input type="button" onClick="window.location.href = 'index.php'" value="กลับสู่หน้าแรก">
                </div>
            </form>
        </div>
    </body>
    <?php
    if (isset($message)) {
        if ($message == "หมวดหมู่ซ้ำ") {
            echo "<script>"
            . "alert('$message');"
            . "window.history.back(-1);"
            . "</script>";
        }
        if ($message == "success") {
            echo "<script>"
            . "alert('$message');"
            . "window.location = 'index.php';"
            . "</script>";
        }
    }
    ?>
</html>