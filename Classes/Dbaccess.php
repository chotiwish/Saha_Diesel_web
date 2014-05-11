<?php

include("Dbconnect.php");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Dbaccess
 *
 * @author Mashisam
 */
class Dbaccess {

    public static function getAllCategory() {
        $qstring = "SELECT * FROM sub_category";
        $result = mysql_query($qstring);
        while ($cell = mysql_fetch_array($result)) {
            echo $cell['main_category_category_id'];
            echo $cell['name'];
//            $cells[] = $cell['main_category.name'];
//            $cells[] = $cell['sub_category.name'];
        }
        return $cells;
    }

    public static function getCategoryName() {
//        $qstring = 'SELECT name FROM main_category where name LIKE \'%$term%\'';
//        echo $qstring;
//        $rows[] = array();
        $qstring = "SELECT * FROM main_category";
        $result = mysql_query($qstring);
        while ($row = mysql_fetch_array($result)) {
            $rows[] = $row['name'];
        }
        return $rows;
    }

    public static function autoCompleteName($term) {
        $qstring = "SELECT * FROM main_category where name like '" . $term . "%'";
        $result = mysql_query($qstring);
        while ($row = mysql_fetch_array($result)) {
            $rows[] = $row['name'];
        }
        return $rows;
    }

    public static function getCategory($name) {
        $qstring = "SELECT * FROM main_category where name = '" . $name . "'";
        $result = mysql_query($qstring);
        while ($data = mysql_fetch_array($result)) {

            $category[] = $data['category_id'];
            $category[] = $data['name'];
            $category[] = $data['image'];
            $category[] = $data['start_code'];
        }
        return $category;
    }

    public static function insertCategory($data) {
        $main_category = $data['main_category'];
        $sub_category = $data['sub_category'];
        $category_image = $data['category_image'];
        $prefix_product_id = $data['prefix_product_id'];
        $uom = $data['uom'];
        $option1 = $data['option1'];
        $option2 = $data['option2'];
        $option3 = $data['option3'];
        $option4 = $data['option4'];
        $option5 = $data['option5'];
        //main category
        $sql1 = "insert into main_category(name, image, start_code) values ('$main_category', '$category_image', '$prefix_product_id')";
        $objQuery1 = mysql_db_query(saha_diesel, $sql1);
        if ($objQuery1) {
            $last_id = mysql_query("SELECT LAST_INSERT_ID()");
            $result = mysql_fetch_assoc($last_id);
            $categoryId = $result['LAST_INSERT_ID()'];
        } else {
            $chkmain = "select * from main_category where name = '" . $main_category . "'";
            $chk = mysql_db_query(saha_diesel, $chkmain);
            if ($chk) {
                while ($chkId = mysql_fetch_array($chk)) {
                    $mainId[] = $chkId['category_id'];
                }
                $categoryId = $mainId[0];
            }
        }
        //sub category
        $chksub = "select * from sub_category where main_category_category_id = '" . $categoryId . "' and name = '" . $sub_category . "' ";
        $chk = mysql_db_query(saha_diesel, $chksub);
        while ($chkId = mysql_fetch_array($chk)) {
            $subId[] = $chkId['category_id'];
        }
        if ($subId != "") {
            $subId = $subId[0];
            echo "<br/>" . $subId[0];
            $feedback = 'หมวดหมู่ซ้ำ';
            return $feedback;
        } else {
            $sql2 = "insert into sub_category(main_category_category_id, name, uom) values ('$categoryId', '$sub_category', '$uom')";
            $objQuery2 = mysql_db_query(saha_diesel, $sql2);
            if ($objQuery2) {
                $last_id = mysql_query("SELECT LAST_INSERT_ID()");
                $result = mysql_fetch_assoc($last_id);
                $subCategoryId = $result['LAST_INSERT_ID()'];
                echo("save2<br/>" . $subCategoryId . "<br/>");
                $sql3 = "insert into category_options(sub_category_sub_category_id, option_1, option_2, option_3, option_4, option_5) values ('$subCategoryId', '$option1', '$option2', '$option3', '$option4', '$option5')";
                $objQuery3 = mysql_db_query(saha_diesel, $sql3);
                if ($objQuery3) {
                    echo("all done");
                } else {
                    echo("fail3");
                    echo(mysql_error());
                }
            } else {
                echo("fail2");
                echo(mysql_error());
            }
            $imageupload = $_FILES['category_image']['tmp_name'];
            $imageupload_name = $_FILES['category_image']['name'];
            if ($imageupload) {
                $arraypic = explode(".", $imageupload_name); //แบ่งชื่อไฟล์กับนามสกุลออกจากกัน
                $lastname = strtolower($arraypic);
                $filename = $categoryId; //ชื่อไฟล์
                $filetype = $arraypic[1]; //นามสกุลไฟล์
//นำนามสกุลไฟล์มาเช็ค
                if ($filetype == "jpg" || $filetype == "jpeg" || $filetype == "png" || $filetype == "gif") { //เพิ่มการอนุญาติให้ไฟล์นามสกุลอื่นๆ เพิ่มตรงนี้
                    $newimage = $filename . "." . $filetype; //รวมชื่อไฟล์กับนามสกุลเข้าด้วยกัน
                    $sqlImg = "UPDATE main_category set image='$newimage' where category_id =$categoryId";
                    $updateImg = mysql_db_query(saha_diesel, $sqlImg);
                    copy($imageupload, "uploads/" . $newimage); //โฟลเดอร์สำหรับเก็บรูป/ไฟล์รูป
                    echo "uploaded";
                } else {
                    echo "<h3>ERROR : ไม่สามารถ Upload รูปภาพ</h3>";
                }
            }
//         else {
//            echo("fail1");
//            echo(mysql_error());
//        }
            $feedback = 'success';
            return $feedback;
        }
    }

    public static function editCategory($data) {
        $main_category = $data['main_category'];
        $sub_category = $data['sub_category'];
        $category_image = $data['category_image'];
        $prefix_product_id = $data['prefix_product_id'];
        $uom = $data['uom'];
        $option1 = $data['option1'];
        $option2 = $data['option2'];
        $option3 = $data['option3'];
        $option4 = $data['option4'];
        $option5 = $data['option5'];
        $subId = $data['subId'];
        $sql = "SELECT * FROM main_category where name = '" . $main_category . "'";
        $objQuery = mysql_query($sql);
        if ($objQuery) {
            while ($maincat = mysql_fetch_array($objQuery)) {

                $mainId[] = $maincat['category_id'];
            }
            echo "<br/>" . $main_category . $mainId[0];
            $sql1 = "update main_category set start_code = '$prefix_product_id' where name = '" . $main_category . "'";
            $objQuery1 = mysql_db_query(saha_diesel, $sql1);
            if ($objQuery1) {
                echo "<br/>" . $subId;
                $sql2 = "UPDATE sub_category set main_category_category_id='$mainId[0]', name='$sub_category', uom='$uom' where sub_category_id = '" . $subId . "'";
                $objQuery2 = mysql_db_query(saha_diesel, $sql2);
                if ($objQuery2) {
//                $last_id = mysql_query("SELECT LAST_INSERT_ID()");
//                $result = mysql_fetch_assoc($last_id);
//                $last = $result['LAST_INSERT_ID()'];
//                echo("save2<br/>" . $last . "<br/>");
                    $sql3 = "UPDATE category_options set option_1='$option1', option_2='$option2', option_3='$option3', option_4='$option4', option_5='$option5' where sub_category_sub_category_id='" . $subId . "'";
                    $objQuery3 = mysql_db_query(saha_diesel, $sql3);
                    if ($objQuery3) {
                        echo("all done");
                    } else {
                        echo("fail3");
                        echo(mysql_error());
                    }
                } else {
                    echo("fail2");
                    echo(mysql_error());
                }
                $imageupload = $_FILES['category_image']['tmp_name'];
                $imageupload_name = $_FILES['category_image']['name'];
                if ($imageupload) {
                    $arraypic = explode(".", $imageupload_name); //แบ่งชื่อไฟล์กับนามสกุลออกจากกัน
                    $lastname = strtolower($arraypic);
                    $filename = $categoryId; //ชื่อไฟล์
                    $filetype = $arraypic[1]; //นามสกุลไฟล์
//นำนามสกุลไฟล์มาเช็ค
                    if ($filetype == "jpg" || $filetype == "jpeg" || $filetype == "png" || $filetype == "gif") { //เพิ่มการอนุญาติให้ไฟล์นามสกุลอื่นๆ เพิ่มตรงนี้
                        echo ('have image');
                        $newimage = $filename . "." . $filetype; //รวมชื่อไฟล์กับนามสกุลเข้าด้วยกัน
                        $sqlImg = "UPDATE main_category set image='$newimage' where category_id =$categoryId";
                        $updateImg = mysql_db_query(saha_diesel, $sqlImg);
                        copy($imageupload, "uploads/" . $newimage); //โฟลเดอร์สำหรับเก็บรูป/ไฟล์รูป
                    } else {
                        echo "<h3>ERROR : ไม่สามารถ Upload รูปภาพ</h3>";
                    }
                }
            } else {
                echo("fail1");
                echo(mysql_error());
            }
        } else {
            echo("fail");
            echo(mysql_error());
        }
    }

    public static function deleteSubCategory($data) {
        $subId = $data['subId'];
        $delOption = "DELETE FROM category_options WHERE sub_category_sub_category_id='" . $subId . "'";
        $optionQuery = mysql_db_query(saha_diesel, $delOption);
        if ($optionQuery) {
            $delSubCategory = "DELETE FROM sub_category WHERE sub_category_id='" . $subId . "'";
            $subCategoryQuery = mysql_db_query(saha_diesel, $delSubCategory);
            if ($subCategoryQuery) {
                echo 'sub Deleted';
            } else {
                echo 'sub failed';
                echo(mysql_error());
            }
            echo 'option deleted';
        } else {
            echo 'option failed';
            echo(mysql_error());
        }
    }

    public static function getSubCategory($subName) {
        $qstring2 = "SELECT * FROM sub_category where name = '" . $subName . "'";
        $result2 = mysql_query($qstring2);
        while ($subrow = mysql_fetch_array($result2)) {
            $subrows[] = $subrow['sub_category_id'];
        }
        return $subrows;
    }

    public static function getSubCategoryName($mainName) {
        $qstring = "SELECT * FROM main_category where name = '" . $mainName . "'";
        $result = mysql_query($qstring);
        $subrows = array();
        $rows = array();
        while ($row = mysql_fetch_array($result)) {
            $rows[] = $row['category_id'];
        }
        $qstring2 = "SELECT * FROM sub_category where main_category_category_id = '" . $rows[0] . "'";
        $result2 = mysql_query($qstring2);
        while ($subrow = mysql_fetch_array($result2)) {
            $subrows[] = $subrow['name'];
        }
        return $subrows;
    }

    public static function insertProduct($data) {
        $barCode = $data['barCode'];
        $subCategory = $data['subCategory'];
        $productBrand = $data['productBrand'];
        $supplier = $data['supplier'];
        $productName = $data['productName'];
        $productCode = $data['productCode'];
        $qTy = $data['qTy'];
        $size = $data['size'];
        $poNo = $data['poNo'];
        $receivedDate = $data['receivedDate'];
        $safetyStock = $data['safetyStock'];
        $buyPrice = $data['buyPrice'];
        $sellPrice = $data['sellPrice'];
        $price1 = $data['price1'];
        $price2 = $data['price2'];
        $price3 = $data['price3'];
        $option1 = $data['option1'];
        $option2 = $data['option2'];
        $option3 = $data['option3'];
        $option4 = $data['option4'];
        $option5 = $data['option5'];
        $sahaDieselBarcodeBuy = $data['sahaDieselBarcodeBuy'];
        $sahaDieselBarcodeSell = $data['sahaDieselBarcodeSell'];
        echo count($barCode);
        $qstring = "SELECT * FROM sub_category where name = '" . $subCategory . "'";
        $result = mysql_query($qstring);
        while ($row = mysql_fetch_array($result)) {
            $rows[] = $row['sub_category_id'];
        }
        $sql = "insert into product(sub_category_sub_category_id, productBrand, supplier, productName, productCode, qTy, size, poNo, receivedDate, safetyStock, buyPrice, sellPrice, price1, price2, price3, option1, option2, option3, option4, option5,sahaDieselBarcodeBuy,sahaDieselBarcodeSell) values ('$rows[0]', '$productBrand', '$supplier', '$productName', '$productCode', '$qTy', '$size', '$poNo', '$receivedDate', '$safetyStock', '$buyPrice', '$sellPrice', '$price1', '$price2', '$price3', '$option1', '$option2', '$option3', '$option4', '$option5', '$sahaDieselBarcodeBuy','$sahaDieselBarcodeSell')";
//        echo $sql;
        $objQuery = mysql_db_query(saha_diesel, $sql);
        if ($objQuery) {
            echo 'insert done';
            $last_id = mysql_query("SELECT LAST_INSERT_ID()");
            $result = mysql_fetch_assoc($last_id);
            $productId = $result['LAST_INSERT_ID()'];
            for ($x = 0; $x < count($barCode); $x++) {
                $barCodeSql = "insert into barcode(product_idProduct,barcode) values ('$productId', '$barCode[$x]')";
                mysql_db_query(saha_diesel, $barCodeSql);
            }
            $feedback = "success";
            return $feedback;
        } else {
            echo ('false');
            echo(mysql_error());
            $feedback = "รหัสสินค้าซ้ำ";
            return $feedback;
        }
    }

    public static function editProduct($data) {
        $productId = $data['productId'];
        $barCode = $data['barCode'];
        $mainCategory = $data['mainCategory'];
        $subCategory = $data['subCategory'];
        $productBrand = $data['productBrand'];
        $supplier = $data['supplier'];
        $productName = $data['productName'];
        $productCode = $data['productCode'];
        $qTy = $data['qTy'];
        $size = $data['size'];
        $poNo = $data['poNo'];
        $receivedDate = $data['receivedDate'];
        $safetyStock = $data['safetyStock'];
        $buyPrice = $data['buyPrice'];
        $sellPrice = $data['sellPrice'];
        $price1 = $data['price1'];
        $price2 = $data['price2'];
        $price3 = $data['price3'];
        $option1 = $data['option1'];
        $option2 = $data['option2'];
        $option3 = $data['option3'];
        $option4 = $data['option4'];
        $option5 = $data['option5'];
        $sahaDieselBarcodeBuy = $data['sahaDieselBarcodeBuy'];
        $sahaDieselBarcodeSell = $data['sahaDieselBarcodeSell'];

        $sql = "UPDATE product JOIN main_category ON main_category.name = '$mainCategory' JOIN sub_category ON main_category.category_id = sub_category.main_category_category_id AND sub_category.name = '$subCategory' set sub_category_sub_category_id = sub_category.sub_category_id, productBrand = '$productBrand', supplier = '$supplier', productName = '$productName', productCode = '$productCode', qTy = '$qTy', size = '$size', poNo = '$poNo', receivedDate = '$receivedDate', safetyStock = '$safetyStock', buyPrice = '$buyPrice', sellPrice = '$sellPrice', price1 = '$price1', price2 = '$price2', price3 = '$price3', option1 = '$option1', option2 = '$option2', option3 = '$option3', option4 = '$option4', option5 = '$option5',sahaDieselBarcodeBuy = '$sahaDieselBarcodeBuy',sahaDieselBarcodeSell = '$sahaDieselBarcodeSell' where idProduct = '$productId' ";
//        echo $sql;
        $objQuery = mysql_db_query(saha_diesel, $sql);
        if ($objQuery) {
            echo 'update is done';
            $delBarcode = "DELETE FROM barcode WHERE product_idProduct= '" . $productId . "'";
            mysql_db_query(saha_diesel, $delBarcode);
            for ($x = 0; $x < count($barCode); $x++) {
                $barCodeSql = "insert into barcode(product_idProduct,barcode) values ('$productId', '$barCode[$x]')";
                mysql_db_query(saha_diesel, $barCodeSql);
            }
            $feedback = "success";
            return $feedback;
        } else {
            echo ('false');
            echo(mysql_error());
            $feedback = "รหัสสินค้าซ้ำ";
            return $feedback;
        }
    }

    public static function deleteProduct($data) {
        $productId = $data['productId'];
        echo $productId;
        $delBarcode = "DELETE FROM barcode WHERE product_idProduct= '" . $productId . "'";
        $BarcodeQuery = mysql_db_query(saha_diesel, $delBarcode);
        if ($BarcodeQuery) {
            $delProduct = "DELETE FROM product WHERE idProduct= '" . $productId . "'";
            $productQuery = mysql_db_query(saha_diesel, $delProduct);
            if ($productQuery) {
                echo 'product deleted';
                $feedback = "success";
                return $feedback;
            } else {
                echo 'product failed';
                echo (mysql_error());
            }
        } else {
            echo 'Barcode failed';
            echo (mysql_error());
        }
    }

    public static function getDetailCategory($data) {
        $mainId = $data[0];
        $subname = $data[1];

        $qstring = "SELECT * FROM main_category where category_id = '" . $mainId . "'"; //mainCategory
        $result = mysql_query($qstring);
        while ($data = mysql_fetch_array($result)) {

            $category[] = $data['category_id'];
            $category[] = $data['name'];
            $category[] = $data['image'];
            $category[] = $data['start_code'];
        }
        //subcategory
        $qstring2 = "SELECT * FROM sub_category where main_category_category_id = '" . $mainId . "' and name  = '" . $subname . "'"; //subCategory
        $result2 = mysql_query($qstring2);
        while ($data2 = mysql_fetch_array($result2)) {

            $category[] = $data2['sub_category_id'];
            $category[] = $data2['name'];
            $category[] = $data2['main_category_category_id'];
            $category[] = $data2['uom'];
        }
        $qstring3 = "SELECT * FROM category_options where sub_category_sub_category_id = '" . $category[4] . "'"; //subCategory
        $result3 = mysql_query($qstring3);
        while ($data3 = mysql_fetch_array($result3)) {

            $category[] = $data3['option_1'];
            $category[] = $data3['option_2'];
            $category[] = $data3['option_3'];
            $category[] = $data3['option_4'];
            $category[] = $data3['option_5'];
        }
        return $category;
    }

    public static function getDetailProduct($data) {
        $productCode = $data;
//        
        $qstring = "SELECT * FROM product JOIN sub_category ON product.sub_category_sub_category_id = sub_category.sub_category_id JOIN main_category ON main_category.category_id = sub_category.main_category_category_id JOIN category_options ON category_options.sub_category_sub_category_id = sub_category.sub_category_id WHERE product.productCode = '" . $productCode . "'";
////        $qstring = "SELECT * FROM product where productName like '" . $productName . "%'"; //mainCategory
        $result = mysql_query($qstring);
        if ($result) {
            while ($data = mysql_fetch_array($result)) {
                for ($x = 0; $x < 37; $x++)
                    $product[] = $data[$x];
//                $product[] = $data[];
            }
            $barCodeString = "SELECT * FROM barcode WHERE product_idProduct = '" . $product[0] . "'";
            $code = mysql_query($barCodeString);
            while ($barCode = mysql_fetch_array($code)) {
                $product[] = $barCode['barcode'];
            }
            return $product;
        } else
            echo (mysql_error());
    }

    public static function searchProduct($data) {
        $productCode = $data;
        $qString = "SELECT productCode,  productName ,  productBrand ,  supplier FROM  product where productCode like '" . $productCode . "%'";
        $result = mysql_query($qString);
        if ($result) {
            while ($data = mysql_fetch_array($result)) {
                $product[] = $data['productCode'];
                $product[] = $data['productName'];
                $product[] = $data['productBrand'];
                $product[] = $data['supplier'];
            }
        }
        return $product;
    }

}

?>