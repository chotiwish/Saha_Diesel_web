<?php

include_once("Dbconnect.php");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Product
 *
 * @author Mashisam
 */
class Product {

    public static function insertProduct($data) {
        if (!empty($data['product_image']))
            $product_image = $data['product_image'];
        
            else$product_image = "";
        if (!empty($data['barCode']))
            $barCode = $data['barCode'];
            else
			$barCode = "";
        if (!empty($data['subCategory']))
            $subCategory = $data['subCategory'];
            else
			$subCategory = "";
        if (!empty($data['productBrand']))
            $productBrand = $data['productBrand'];
            else
			$productBrand = "";
        if (!empty($data['supplier']))
            $supplier = $data['supplier'];
            else
			$supplier = "";
        if (!empty($data['productName']))
            $productName = $data['productName'];
            else
			$productName = "";
        if (!empty($data['productCode']))
            $productCode = $data['productCode'];
            else
			$productCode = "";
        if (!empty($data['qTy']))
            $qTy = $data['qTy'];
            else
			$qTy = "";
        if (!empty($data['size']))
            $size = $data['size'];
            else
			$size = "";
        if (!empty($data['poNo']))
            $poNo = $data['poNo'];
            else
			$poNo = "";
        if (!empty($data['receivedDate']))
            $receivedDate = $data['receivedDate'];
		else $receivedDate = "";
		
		if (!empty($data['itemLocation']))
            $itemLocation = $data['itemLocation'];
        else $itemLocation = "";
		
        if (!empty($data['safetyStock']))
            $safetyStock = $data['safetyStock'];
            else
			$safetyStock = "";
        if (!empty($data['carBrand']))
            $carBrand = $data['carBrand'];
            else
			$carBrand = "";
        if (!empty($data['oemCode']))
            $oemCode = $data['oemCode'];
            else
			$oemCode = "";
        if (!empty($data['buyPrice']))
            $buyPrice = $data['buyPrice'];
            else
			$buyPrice = "";
        if (!empty($data['sellPrice']))
            $sellPrice = $data['sellPrice'];
            else
			$sellPrice = "";
        if (!empty($data['price1']))
            $price1 = $data['price1'];
            else
			$price1 = "";
        if (!empty($data['price2']))
            $price2 = $data['price2'];
            else
			$price2 = "";
        if (!empty($data['price3']))
            $price3 = $data['price3'];
            else
			$price3 = "";
        if (!empty($data['option1']))
            $option1 = $data['option1'];
            else
			$option1 = "";
        if (!empty($data['option2']))
            $option2 = $data['option2'];
            else
			$option2 = "";
        if (!empty($data['option3']))
            $option3 = $data['option3'];
            else
			$option3 = "";
        if (!empty($data['option4']))
            $option4 = $data['option4'];
            else
			$option4 = "";
        if (!empty($data['option5']))
            $option5 = $data['option5'];
            else
			$option5 = "";
        if (!empty($data['sahaDieselBarcodeBuy']))
            $sahaDieselBarcodeBuy = $data['sahaDieselBarcodeBuy'];
            else
			$sahaDieselBarcodeBuy = "";
        if (!empty($data['sahaDieselBarcodeSell']))
            $sahaDieselBarcodeSell = $data['sahaDieselBarcodeSell'];
            else
			$sahaDieselBarcodeSell = "";
        if (!empty($data['note']))
            $note = $data['note'];
            else
			$note = "";
        $qstring = "SELECT * FROM sub_category where name = '" . $subCategory . "'";
        $mydb = new Dbconnect();
        $result = $mydb->query($qstring);
        while ($row = $result->fetch_array()) {
            $rows[] = $row['sub_category_id'];
        }
        $sql = "insert into product(sub_category_sub_category_id, productBrand, supplier, productName, productCode, qTy, size, poNo, receivedDate,itemLocation, safetyStock, buyPrice, sellPrice, price1, price2, price3, option1, option2, option3, option4, option5,sahaDieselBarcodeBuy,sahaDieselBarcodeSell,note) values ('$rows[0]', '$productBrand', '$supplier', '$productName', '$productCode', '$qTy', '$size', '$poNo', '$receivedDate','$itemLocation', '$safetyStock', '$buyPrice', '$sellPrice', '$price1', '$price2', '$price3', '$option1', '$option2', '$option3', '$option4', '$option5', '$sahaDieselBarcodeBuy','$sahaDieselBarcodeSell','$note')";
        $objQuery = $mydb->query($sql);
        if ($objQuery) {
            $productId = $mydb->lastInsertID();
            if (!empty($barCode)) {
                for ($x = 0; $x < count($barCode); $x++) {
                    $barCodeSql = "insert into barcode(product_idProduct,barcode) values ('$productId', '$barCode[$x]')";
                    $mydb->query($barCodeSql);
                }
            }
            if (!empty($oemCode)) {
                for ($x = 0; $x < count($oemCode); $x++) {
                    $oemCodeSql = "insert into oem(product_idProduct,oemcode) values ('$productId', '$oemCode[$x]')";
                    $mydb->query($oemCodeSql);
                }
            }
            if (!empty($carBrand)) {
                for ($x = 0; $x < count($carBrand); $x++) {
                    $carBrandSql = "insert into carbrand(product_idProduct,carbrand) values ('$productId', '$carBrand[$x]')";
                    $mydb->query($carBrandSql);
                }
            }
            $imageupload = $_FILES['product_image']['tmp_name'];
            $imageupload_name = $_FILES['product_image']['name'];
            if ($imageupload) {
                $arraypic = explode(".", $imageupload_name); //แบ่งชื่อไฟล์กับนามสกุลออกจากกัน
                $filename = "product" . $productId; //ชื่อไฟล์
                $filetype = $arraypic[1]; //นามสกุลไฟล์
//นำนามสกุลไฟล์มาเช็ค
                if ($filetype == "jpg" || $filetype == "jpeg" || $filetype == "png" || $filetype == "gif") { //เพิ่มการอนุญาติให้ไฟล์นามสกุลอื่นๆ เพิ่มตรงนี้
                    $newimage = $filename . "." . $filetype; //รวมชื่อไฟล์กับนามสกุลเข้าด้วยกัน
                    $sqlImg = "UPDATE product set image='$newimage' where idProduct =$productId";
                    $updateImg = $mydb->query($sqlImg);
                    copy($imageupload, "uploads/" . $newimage); //โฟลเดอร์สำหรับเก็บรูป/ไฟล์รูป
                }
            } else {
                $imgMainCategory = "select main_category.image from main_category join sub_category on sub_category.main_category_category_id=main_category.category_id where sub_category.sub_category_id='" . $rows[0] . "'";
                $imgquery = $mydb->query($imgMainCategory);
                while ($img = $imgquery->fetch_array()) {
                    $image = $img[0];
                }
                $sqlImg = "UPDATE product set image='$image' where idProduct =$productId";
                $updateImg = $mydb->query($sqlImg);
            }
            $feedback = "success";
            return $feedback;
        } else {
           // echo ('false');
            echo(mysql_error());
            $feedback = "รหัสสินค้าซ้ำ";
            return $feedback;
        }
    }

    public static function editProduct($data) {
        if (!empty($data['product_image']))
            $product_image = $data['product_image'];
            else
			$product_image = "";
        if (!empty($data['barCode']))
            $barCode = $data['barCode'];
            else
			$barCode = "";
        if (!empty($data['subCategory']))
            $subCategory = $data['subCategory'];
            else
			$subCategory = "";
        if (!empty($data['productBrand']))
            $productBrand = $data['productBrand'];
            else
			$productBrand = "";
        if (!empty($data['supplier']))
            $supplier = $data['supplier'];
            else
			$supplier = "";
        if (!empty($data['productName']))
            $productName = $data['productName'];
            else
			$productName = "";
        if (!empty($data['productCode']))
            $productCode = $data['productCode'];
            else
			$productCode = "";
        if (!empty($data['qTy']))
            $qTy = $data['qTy'];
            else
			$qTy = "";
        if (!empty($data['size']))
            $size = $data['size'];
            else
			$size = "";
        if (!empty($data['poNo']))
            $poNo = $data['poNo'];
            else
			$poNo = "";
        if (!empty($data['receivedDate']))
            $receivedDate = $data['receivedDate'];
            else
			$receivedDate = "";
        if (!empty($data['safetyStock']))
            $safetyStock = $data['safetyStock'];
            else
			$safetyStock = "";
        if (!empty($data['carBrand']))
            $carBrand = $data['carBrand'];
            else
			$carBrand = "";
        if (!empty($data['oemCode']))
            $oemCode = $data['oemCode'];
            else
			$oemCode = "";
        if (!empty($data['buyPrice']))
            $buyPrice = $data['buyPrice'];
            else
			$buyPrice = "";
        if (!empty($data['sellPrice']))
            $sellPrice = $data['sellPrice'];
            else
			$sellPrice = "";
        if (!empty($data['price1']))
            $price1 = $data['price1'];
            else
			$price1 = "";
        if (!empty($data['price2']))
            $price2 = $data['price2'];
            else
			$price2 = "";
        if (!empty($data['price3']))
            $price3 = $data['price3'];
            else
			$price3 = "";
        if (!empty($data['option1']))
            $option1 = $data['option1'];
            else
			$option1 = "";
        if (!empty($data['option2']))
            $option2 = $data['option2'];
            else
			$option2 = "";
        if (!empty($data['option3']))
            $option3 = $data['option3'];
            else
			$option3 = "";
        if (!empty($data['option4']))
            $option4 = $data['option4'];
            else
			$option4 = "";
        if (!empty($data['option5']))
            $option5 = $data['option5'];
            else
			$option5 = "";
        if (!empty($data['sahaDieselBarcodeBuy']))
            $sahaDieselBarcodeBuy = $data['sahaDieselBarcodeBuy'];
            else
			$sahaDieselBarcodeBuy = "";
        if (!empty($data['sahaDieselBarcodeSell']))
            $sahaDieselBarcodeSell = $data['sahaDieselBarcodeSell'];
            else
			$sahaDieselBarcodeSell = "";
        if (!empty($data['note']))
            $note = $data['note'];
            else
			$note = "";
        if (!empty($data['productId']))
            $productId = $data['productId'];
            else
			$productId = "";
        if (!empty($data['mainCategory']))
            $mainCategory = $data['mainCategory'];
            else 
			$mainCategory= "";

        $sql = "UPDATE product JOIN main_category ON main_category.name = '$mainCategory' JOIN sub_category ON main_category.category_id = sub_category.main_category_category_id AND sub_category.name = '$subCategory' set sub_category_sub_category_id = sub_category.sub_category_id, productBrand = '$productBrand', supplier = '$supplier', productName = '$productName', productCode = '$productCode', qTy = '$qTy', size = '$size', poNo = '$poNo', receivedDate = '$receivedDate', safetyStock = '$safetyStock', buyPrice = '$buyPrice', sellPrice = '$sellPrice', price1 = '$price1', price2 = '$price2', price3 = '$price3', option1 = '$option1', option2 = '$option2', option3 = '$option3', option4 = '$option4', option5 = '$option5',sahaDieselBarcodeBuy = '$sahaDieselBarcodeBuy',sahaDieselBarcodeSell = '$sahaDieselBarcodeSell',note = '$note' where idProduct = '$productId' ";
//        echo $sql;
        $mydb = new Dbconnect();
        $objQuery = $mydb->query($sql);
        if ($objQuery) {
            $delBarcode = "DELETE FROM barcode WHERE product_idProduct= '" . $productId . "'";
            $mydb->query($delBarcode);
            $delOemcode = "DELETE FROM oem WHERE product_idProduct= '" . $productId . "'";
            $mydb->query($delOemcode);
            $delcarbrand = "DELETE FROM carbrand WHERE product_idProduct= '" . $productId . "'";
            $mydb->query($delcarbrand);
            if (!empty($barCode)) {
//            $delBarcode = "DELETE FROM barcode WHERE product_idProduct= '" . $productId . "'";
//            $mydb->query($delBarcode);
                for ($x = 0; $x < count($barCode); $x++) {
                    $barCodeSql = "insert into barcode(product_idProduct,barcode) values ('$productId', '$barCode[$x]')";
                    $mydb->query($barCodeSql);
                }
            }
            if (!empty($oemCode)) {
//            $delOemcode = "DELETE FROM oem WHERE product_idProduct= '" . $productId . "'";
//            $mydb->query($delOemcode);
                for ($x = 0; $x < count($oemCode); $x++) {
                    $oemCodeSql = "insert into oem(product_idProduct,oemcode) values ('$productId', '$oemCode[$x]')";
                    $mydb->query($oemCodeSql);
                }
            }
            if (!empty($carBrand)) {
//            $delcarbrand = "DELETE FROM carbrand WHERE product_idProduct= '" . $productId . "'";
//            $mydb->query($delcarbrand);
                for ($x = 0; $x < count($carBrand); $x++) {
                    $carbrandSql = "insert into carbrand(product_idProduct,carbrand) values ('$productId', '$carBrand[$x]')";
                    $mydb->query($carbrandSql);
                }
            }
            $imageupload = $_FILES['product_image']['tmp_name'];
            $imageupload_name = $_FILES['product_image']['name'];
            if ($imageupload) {
                $arraypic = explode(".", $imageupload_name); //แบ่งชื่อไฟล์กับนามสกุลออกจากกัน
                $filename = "product" . $productId; //ชื่อไฟล์
                $filetype = $arraypic[1]; //นามสกุลไฟล์
//นำนามสกุลไฟล์มาเช็ค
                if ($filetype == "jpg" || $filetype == "jpeg" || $filetype == "png" || $filetype == "gif") { //เพิ่มการอนุญาติให้ไฟล์นามสกุลอื่นๆ เพิ่มตรงนี้
                    $newimage = $filename . "." . $filetype; //รวมชื่อไฟล์กับนามสกุลเข้าด้วยกัน
                    $sqlImg = "UPDATE product set image='$newimage' where idProduct =$productId";
                    $updateImg = $mydb->query($sqlImg);
                    copy($imageupload, "uploads/" . $newimage); //โฟลเดอร์สำหรับเก็บรูป/ไฟล์รูป
                }
            }
            $feedback = "แก้ไขหมวดหมู่เสร็จสิ้น";
            return $feedback;
        } else {
            echo ('false');
            echo(mysql_error());
            $feedback = "รหัสสินค้าซ้ำ";
            return $feedback;
        }
    }
   public static function editProductFromProductCode($data) {
         if (!empty($data['product_image']))
            $product_image = $data['product_image'];
            else
			$product_image = "";
        if (!empty($data['barCode']))
            $barCode = $data['barCode'];
            else
			$barCode = "";
        if (!empty($data['subCategory']))
            $subCategory = $data['subCategory'];
            else
			$subCategory = "";
        if (!empty($data['productBrand']))
            $productBrand = $data['productBrand'];
            else
			$productBrand = "";
        if (!empty($data['supplier']))
            $supplier = $data['supplier'];
            else
			$supplier = "";
        if (!empty($data['productName']))
            $productName = $data['productName'];
            else
			$productName = "";
        if (!empty($data['productCode']))
            $productCode = $data['productCode'];
            else
			$productCode = "";
        if (!empty($data['qTy']))
            $qTy = $data['qTy'];
            else
			$qTy = "";
        if (!empty($data['size']))
            $size = $data['size'];
            else
			$size = "";
        if (!empty($data['poNo']))
            $poNo = $data['poNo'];
            else
			$poNo = "";
        if (!empty($data['receivedDate']))
            $receivedDate = $data['receivedDate'];
            else
			$receivedDate = "";
        if (!empty($data['safetyStock']))
            $safetyStock = $data['safetyStock'];
            else
			$safetyStock = "";
        if (!empty($data['carBrand']))
            $carBrand = $data['carBrand'];
            else
			$carBrand = "";
        if (!empty($data['oemCode']))
            $oemCode = $data['oemCode'];
            else
			$oemCode = "";
        if (!empty($data['buyPrice']))
            $buyPrice = $data['buyPrice'];
            else
			$buyPrice = "";
        if (!empty($data['sellPrice']))
            $sellPrice = $data['sellPrice'];
            else
			$sellPrice = "";
        if (!empty($data['price1']))
            $price1 = $data['price1'];
            else
			$price1 = "";
        if (!empty($data['price2']))
            $price2 = $data['price2'];
            else
			$price2 = "";
        if (!empty($data['price3']))
            $price3 = $data['price3'];
            else
			$price3 = "";
        if (!empty($data['option1']))
            $option1 = $data['option1'];
            else
			$option1 = "";
        if (!empty($data['option2']))
            $option2 = $data['option2'];
            else
			$option2 = "";
        if (!empty($data['option3']))
            $option3 = $data['option3'];
            else
			$option3 = "";
        if (!empty($data['option4']))
            $option4 = $data['option4'];
            else
			$option4 = "";
        if (!empty($data['option5']))
            $option5 = $data['option5'];
            else
			$option5 = "";
        if (!empty($data['sahaDieselBarcodeBuy']))
            $sahaDieselBarcodeBuy = $data['sahaDieselBarcodeBuy'];
            else
			$sahaDieselBarcodeBuy = "";
        if (!empty($data['sahaDieselBarcodeSell']))
            $sahaDieselBarcodeSell = $data['sahaDieselBarcodeSell'];
            else
			$sahaDieselBarcodeSell = "";
        if (!empty($data['note']))
            $note = $data['note'];
            else
			$note = "";


		//check if productID exists
		$getProduct = "SELECT * FROM product where product.productCode = '".$productCode."'";

        $mydb = new Dbconnect();
		$productQuery = $mydb->query($getProduct);
		if(productQuery)
		{
			while ($row = $productQuery->fetch_array()) {
            		$rows[] = $row['idProduct'];
       		 }
			 $productId = $rows[0];
		}
        $sql = "UPDATE product set productBrand = '$productBrand', supplier = '$supplier', productName = '$productName', productCode = '$productCode', qTy = '$qTy', size = '$size', poNo = '$poNo', receivedDate = '$receivedDate', safetyStock = '$safetyStock', buyPrice = '$buyPrice', sellPrice = '$sellPrice', price1 = '$price1', price2 = '$price2', price3 = '$price3', option1 = '$option1', option2 = '$option2', option3 = '$option3', option4 = '$option4', option5 = '$option5',sahaDieselBarcodeBuy = '$sahaDieselBarcodeBuy',sahaDieselBarcodeSell = '$sahaDieselBarcodeSell',note = '$note' where idProduct = '$productId' ";
//        echo $sql;
        //$mydb = new Dbconnect();
        $objQuery = $mydb->query($sql);
        if ($objQuery) {
            $delBarcode = "DELETE FROM barcode WHERE product_idProduct= '" . $productId . "'";
            $mydb->query($delBarcode);
            $delOemcode = "DELETE FROM oem WHERE product_idProduct= '" . $productId . "'";
            $mydb->query($delOemcode);
            $delcarbrand = "DELETE FROM carbrand WHERE product_idProduct= '" . $productId . "'";
            $mydb->query($delcarbrand);
            if (!empty($barCode)) {
//            $delBarcode = "DELETE FROM barcode WHERE product_idProduct= '" . $productId . "'";
//            $mydb->query($delBarcode);
                for ($x = 0; $x < count($barCode); $x++) {
                    $barCodeSql = "insert into barcode(product_idProduct,barcode) values ('$productId', '$barCode[$x]')";
                    $mydb->query($barCodeSql);
                }
            }
            if (!empty($oemCode)) {
//            $delOemcode = "DELETE FROM oem WHERE product_idProduct= '" . $productId . "'";
//            $mydb->query($delOemcode);
                for ($x = 0; $x < count($oemCode); $x++) {
                    $oemCodeSql = "insert into oem(product_idProduct,oemcode) values ('$productId', '$oemCode[$x]')";
                    $mydb->query($oemCodeSql);
                }
            }
            if (!empty($carBrand)) {
//            $delcarbrand = "DELETE FROM carbrand WHERE product_idProduct= '" . $productId . "'";
//            $mydb->query($delcarbrand);
                for ($x = 0; $x < count($carBrand); $x++) {
                    $carbrandSql = "insert into carbrand(product_idProduct,carbrand) values ('$productId', '$carBrand[$x]')";
                    $mydb->query($carbrandSql);
                }
            }

            
            $feedback = "แก้ไขสินค้า ID: ".$productId." เสร็จสิ้น";
            return $feedback;
        } else {
            echo(mysql_error());
            $feedback = "รหัสสินค้าซ้ำ";
            return $feedback;
        }
    }
    public static function deleteProduct($data) {
        $productId = $data['productId'];
        $delBarcode = "DELETE FROM barcode WHERE product_idProduct= '" . $productId . "'";
        $mydb = new Dbconnect();

          $BarcodeQuery = $mydb->query($delBarcode);
           if ($BarcodeQuery) {
            $delOemcode = "DELETE FROM oem WHERE product_idProduct= '" . $productId . "'";
            $oemcodeQuery = $mydb->query($delOemcode);
            if ($oemcodeQuery) {
                $delCarbrand = "DELETE FROM carbrand WHERE product_idProduct= '" . $productId . "'";
                $carbrandQuery = $mydb->query($delCarbrand);
                if ($carbrandQuery) {
                    $imgProduct = "select image from product where idProduct= '" . $productId . "'";
                    $imgquery = $mydb->query($imgProduct);
                    while ($img = $imgquery->fetch_array()) {
                        $image = $img[0];
                    }
                    $delProduct = "DELETE FROM product WHERE idProduct= '" . $productId . "'";
                    $productQuery = $mydb->query($delProduct);
                    if ($productQuery) {
                        if ($image[0] == 'p')
                            unlink("uploads/" . $image);
                        $feedback = "ลบสินค้าเสร็จสิ้น";
                        return $feedback;
                    }
                }
            }
	   }
    }
	
    public static function deleteProductFromProductCode($data) {
		//$productId = $data['productCode'];
		$productCode = $data['productCode'];
		//check if productID exists
		$getProduct = "SELECT * FROM product where product.productCode = '".$productCode."'";

        $mydb = new Dbconnect();
		$productQuery = $mydb->query($getProduct);
		if(productQuery)
		{
			while ($row = $productQuery->fetch_array()) {
            		$rows[] = $row['idProduct'];
       		 }
			 $productId = $rows[0];
		   $delBarcode = "DELETE FROM barcode WHERE product_idProduct= '" . $productId . "'";
          $BarcodeQuery = $mydb->query($delBarcode);
           if ($BarcodeQuery) {
            $delOemcode = "DELETE FROM oem WHERE product_idProduct= '" . $productId . "'";
            $oemcodeQuery = $mydb->query($delOemcode);
            if ($oemcodeQuery) {
                $delCarbrand = "DELETE FROM carbrand WHERE product_idProduct= '" . $productId . "'";
                $carbrandQuery = $mydb->query($delCarbrand);
                if ($carbrandQuery) {
                    $imgProduct = "select image from product where idProduct= '" . $productId . "'";
                    $imgquery = $mydb->query($imgProduct);
                    while ($img = $imgquery->fetch_array()) {
                        $image = $img[0];
                    }
                    $delProduct = "DELETE FROM product WHERE idProduct= '" . $productId . "'";
                    $productQuery = $mydb->query($delProduct);
                    if ($productQuery) {
                        if ($image[0] == 'p')
                            unlink("uploads/" . $image);
                        $feedback = "ลบสินค้า Code :".$productCode." เสร็จสิ้น";
                        return $feedback;
                    }
                }
            }
          }
	   }
    }
    public static function getDetailProduct($data) {
        $productCode = $data;
//        
        $qstring = "SELECT * FROM product JOIN sub_category ON product.sub_category_sub_category_id = sub_category.sub_category_id JOIN main_category ON main_category.category_id = sub_category.main_category_category_id JOIN category_options ON category_options.sub_category_sub_category_id = sub_category.sub_category_id WHERE product.idProduct = '" . $productCode . "'";
////        $qstring = "SELECT * FROM product where productName like '" . $productName . "%'"; //mainCategory
        $mydb = new Dbconnect();
        $result = $mydb->query($qstring);
        if ($result) {
            while ($data = $result->fetch_array()) {
                for ($x = 0; $x < count($data) / 2; $x++)
                    $product[] = $data[$x];
//                $product[] = $data[];
            }
            $barCodeString = "SELECT * FROM barcode WHERE product_idProduct = '" . $productCode . "'";
            $code = $mydb->query($barCodeString);
            $oemCodeString = "SELECT * FROM oem WHERE product_idProduct = '" . $productCode . "'";
            $oem = $mydb->query($oemCodeString);
            $carbrandString = "SELECT * FROM carbrand WHERE product_idProduct = '" . $productCode . "'";
            $brand = $mydb->query($carbrandString);
            if ($code) {
                while ($barCode = $code->fetch_array()) {
                    $product[] = $barCode['barcode'];
                }
            }

            if ($oem) {
                $product[] = "oemcode";
                while ($oemCode = $oem->fetch_array()) {
                    $product[] = $oemCode['oemcode'];
                }
            }
            if ($brand) {
                $product[] = "carbrand";
                while ($carbrand = $brand->fetch_array()) {
                    $product[] = $carbrand['carbrand'];
                }
            }
            return $product;
        } else
            echo (mysql_error());
    }

    public static function searchProduct($data) {
        $term = $data[0];
        $product = null;
		
		$qstring = "select product.idProduct, product.productCode,  product.productName ,  product.productBrand  , sub_category.name , product.note, product.itemLocation from product join sub_category on product.sub_category_sub_category_id=sub_category.sub_category_id ";
		
        if (empty($term))
            if ($data[1] == "ยี่ห้อรถ")
			{
			    $qstring = "select product.idProduct, product.productCode,  product.productName ,  product.productBrand  , sub_category.name , product.note,carbrand.carbrand from product join sub_category on product.sub_category_sub_category_id=sub_category.sub_category_id ";
                $where = "join carbrand on product.idProduct=carbrand.product_idProduct ";
			}
			else if ($data[1] == "oemcode")
			{
				$qstring = "select product.idProduct, product.productCode,  product.productName ,  product.productBrand  , sub_category.name , product.note,oem.oemcode from product join sub_category on product.sub_category_sub_category_id=sub_category.sub_category_id ";
                $where = "join oem on product.idProduct=oem.product_idProduct";
			}
			else if ($data[1] == "barcode")
			{
				$qstring = "select product.idProduct, product.productCode,  product.productName ,  product.productBrand  , sub_category.name , product.note,barcode.barcode from product join sub_category on product.sub_category_sub_category_id=sub_category.sub_category_id ";
                $where = "join barcode on product.idProduct=barcode.product_idProduct";
			}
			else{
				//all other section 
				$where = "";
			}
			
        else {
            if ($data[1] == "รหัสสินค้า")
                $where = "join barcode on product.idProduct=barcode.product_idProduct where product.productCode like '%" . $term . "%'";
            else if ($data[1] == "ชื่อสินค้า")
                $where = "join barcode on product.idProduct=barcode.product_idProduct where product.productName like '%" . $term . "%'";
            else if ($data[1] == "หมวดหมู่ย่อย")
                $where = "join barcode on product.idProduct=barcode.product_idProduct where sub_category.name like '%" . $term . "%'";
            else if ($data[1] == "ยี่ห้อรถ")
			{
				$qstring = "select product.idProduct, product.productCode,  product.productName ,  product.productBrand  , sub_category.name , product.note,carbrand.carbrand from product join sub_category on product.sub_category_sub_category_id=sub_category.sub_category_id ";
                $where = "join carbrand on product.idProduct=carbrand.product_idProduct where carbrand.carbrand like '%" . $term . "%'";
			}
			else if ($data[1] == "oemcode")
			{
				$qstring = "select product.idProduct, product.productCode,  product.productName ,  product.productBrand  , sub_category.name , product.note,oem.oemcode from product join sub_category on product.sub_category_sub_category_id=sub_category.sub_category_id ";
                $where = "join oem on product.idProduct=oem.product_idProduct where oem.oemcode like '%" . $term . "%'";
			}
			else if ($data[1] == "barcode")
			{
				$qstring = "select product.idProduct, product.productCode,  product.productName ,  product.productBrand  , sub_category.name , product.note,barcode.barcode from product join sub_category on product.sub_category_sub_category_id=sub_category.sub_category_id ";
                $where = "join barcode on product.idProduct=barcode.product_idProduct where barcode.barcode like '%" . $term . "%'";
			}
        }
        $qstring .= $where;
//        echo $qstring;
        $mydb = new Dbconnect();
        $result = $mydb->query($qstring);
        if ($result) {
            while ($data = $result->fetch_array()) {
                ($data[0]!=null)?$product[] = $data[0]:$product[] = "";
                ($data[1]!=null)?$product[] = $data[1]:$product[] = "";
				($data[2]!=null)?$product[] = $data[2]:$product[] = "";
				($data[3]!=null)?$product[] = $data[3]:$product[] = "";
				($data[4]!=null)?$product[] = $data[4]:$product[] = "";
				($data[5]!=null)?$product[] = $data[5]:$product[] = "";
				($data[6]!=null)?$product[] = $data[6]:$product[] = "";
            }
        }
        return $product;
    }

    public static function autoComplete($data) {
        $term = $data[0];
        $type = $data[1];
        $mydb = new Dbconnect();
        if (($type == 'productCode') || ($type == 'productName')) {
            $qstring = "SELECT * FROM product where " . $type . " like '" . $term . "%'";
        } elseif ($type == 'name') {
            $qstring = "SELECT * FROM sub_category where " . $type . " like '" . $term . "%'";
        } elseif ($type == 'carbrand') {
            $qstring = "SELECT * FROM carbrand where " . $type . " like '" . $term . "%'";
        } elseif ($type == 'oemcode') {
            $qstring = "SELECT * FROM oem where " . $type . " like '" . $term . "%'";
        }
        $result = $mydb->query($qstring);
        while ($row = $result->fetch_array()) {
            $rows[] = $row[$type];
            return $rows;
        }
    }
    
    public static function safetyStock(){
        $mydb = new Dbconnect();
        $qstring = "SELECT * FROM product where qTy <= safetyStock";
        $result = $mydb->query($qstring);
        $rowindex = 0;
        while ($row = $result->fetch_array()) {
            $safetyStock[$rowindex]['productCode'] = $row['productCode'];
            $safetyStock[$rowindex]['productName'] = $row['productName'];
            $safetyStock[$rowindex]['qTy'] = $row['qTy'];
            $rowindex++;
        }
        return $safetyStock;
    }
}
