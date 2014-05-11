<?php

include_once("Dbconnect.php");
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
class Category {

    public static function insertCategory($data) {

        if (!empty($data['main_category']))$main_category = $data['main_category'];
        else $main_category = "";
        if (!empty($data['sub_category']))$sub_category = $data['sub_category'];
        else $sub_category = "";
        if (!empty($data['category_image']))
            $category_image = $data['category_image'];
        if (!empty($data['prefix_product_id']))$prefix_product_id = $data['prefix_product_id'];
        else $prefix_product_id ="";
        if (!empty($data['uom']))$uom = $data['uom'];
        else $uom ="";
        if (!empty($data['option1']))$option1 = $data['option1'];
        else $option1 ="";
        if (!empty($data['option2']))$option2 = $data['option2'];
        else $option2 ="";
        if (!empty($data['option3']))$option3 = $data['option3'];
        else $option3 ="";
        if (!empty($data['option4']))$option4 = $data['option4'];
        else $option4 ="";
        if (!empty($data['option5']))$option5 = $data['option5'];
        else $option5 ="";
        //main category
        $chkmain = "select * from main_category where name = '" . $main_category . "'";
        $mydb = new Dbconnect();
        $chk = $mydb->query($chkmain);
        if ($chk) {
            while ($chkId = $chk->fetch_array()) {
                $mainId = $chkId['category_id'];
            }
            if (!empty($mainId)) {
                $categoryId = $mainId;
            } else {
                $sql1 = "insert into main_category(name) values ('$main_category')";
                $objQuery1 = $mydb->query($sql1);
                if ($objQuery1) {
//                    $last_id = mysql_query("SELECT LAST_INSERT_ID()");
//                    $result = mysql_fetch_assoc($last_id);
//                    $categoryId = $result['LAST_INSERT_ID()'];
                    $categoryId = $mydb->lastInsertID();
                }
            }
        }
        //sub category
        $chksub = "select * from sub_category where main_category_category_id = '" . $categoryId . "' and name = '" . $sub_category . "' ";
        $chk = $mydb->query($chksub);
        while ($chkId = $chk->fetch_array()) {
            $subId = "Duplicate Category ID";
        }
        if (!empty($subId)) {
            $feedback = 'หมวดหมู่ซ้ำ';
            return $feedback;
        } else {
            $sql2 = "insert into sub_category(main_category_category_id, name, uom, start_code) values ('$categoryId', '$sub_category', '$uom', '$prefix_product_id')";
            $objQuery2 = $mydb->query($sql2);
            if ($objQuery2) {
//                $last_id = mysql_query("SELECT LAST_INSERT_ID()");
//                $result = mysql_fetch_assoc($last_id);
//                $subCategoryId = $result['LAST_INSERT_ID()'];
                $subCategoryId = $mydb->lastInsertID();
                $sql3 = "insert into category_options(sub_category_sub_category_id, option_1, option_2, option_3, option_4, option_5) values ('$subCategoryId', '$option1', '$option2', '$option3', '$option4', '$option5')";
                $objQuery3 = $mydb->query($sql3);
            }
            $imageupload = $_FILES['category_image']['tmp_name'];
            $imageupload_name = $_FILES['category_image']['name'];
            if ($imageupload) {
                $arraypic = explode(".", $imageupload_name); //แบ่งชื่อไฟล์กับนามสกุลออกจากกัน
//                $lastname = strtolower($arraypic);
                $filename = "category" . $categoryId; //ชื่อไฟล์
                $filetype = $arraypic[1]; //นามสกุลไฟล์
//นำนามสกุลไฟล์มาเช็ค
                if ($filetype == "jpg" || $filetype == "jpeg" || $filetype == "png" || $filetype == "gif") { //เพิ่มการอนุญาติให้ไฟล์นามสกุลอื่นๆ เพิ่มตรงนี้
                    $newimage = $filename . "." . $filetype; //รวมชื่อไฟล์กับนามสกุลเข้าด้วยกัน
                    $sqlImg = "UPDATE main_category set image='$newimage' where category_id =$categoryId";
                    $updateImg = $mydb->query($sqlImg);
                    copy($imageupload, "uploads/" . $newimage); //โฟลเดอร์สำหรับเก็บรูป/ไฟล์รูป
                }
            }
            $feedback = 'success';
            return $feedback;
        }
    }

    public static function editCategory($data) {
        $mydb = new Dbconnect();
        if(!empty($data['main_category']))$main_category = $data['main_category'];
        else $main_category ="";
        if(!empty($data['sub_category']))$sub_category = $data['sub_category'];
        else $sub_category ="";
        if (!empty($data['category_image']))
            $category_image = $data['category_image'];
        if(!empty($data['prefix_product_id']))$prefix_product_id = $data['prefix_product_id'];
        else $prefix_product_id ="";
        if(!empty($data['uom']))$uom = $data['uom'];
        else $uom ="";
        if(!empty($data['option1']))$option1 = $data['option1'];
        else $option1 ="";
        if(!empty($data['option2']))$option2 = $data['option2'];
        else $option2 ="";
        if(!empty($data['option3']))$option3 = $data['option3'];
        else $option3 ="";
        if(!empty($data['option4']))$option4 = $data['option4'];
        else $option4 ="";
        if(!empty($data['option5']))$option5 = $data['option5'];
        else $option5 ="";
        if(!empty($data['subId']))$subId = $data['subId'];
        else $subId ="";
        $sqlchk = "select * from sub_category join main_category on main_category.name = '" . $main_category . "' where sub_category.name = '" . $sub_category . "' ";
        $chk = $mydb->query($sqlchk);
        if ($chk) {
            while ($chksub = $chk->fetch_array()) {
                $sub[] = $chksub[0];
                $sub[] = $chksub[1];
                if ($subId == $sub[0])
                    $chkdup = "false";
                else
                    $chkdup = "true";
            }
        }
        if (empty($chkdup) || $chkdup == "false") {
            $sql = "UPDATE sub_category join main_category on main_category.name = '" . $main_category . "' join category_options on category_options.sub_category_sub_category_id = sub_category.sub_category_id set sub_category.main_category_category_id = main_category.category_id, sub_category.name ='$sub_category', sub_category.uom = '$uom', sub_category.start_code = '$prefix_product_id', category_options.option_1 ='$option1', category_options.option_2 ='$option2', category_options.option_3 ='$option3', category_options.option_4 ='$option4', category_options.option_5 ='$option5' where sub_category.sub_category_id='$subId'";
            $objQuery = $mydb->query($sql);
            if ($objQuery) {
                $imageupload = $_FILES['category_image']['tmp_name'];
                $imageupload_name = $_FILES['category_image']['name'];
                if ($imageupload) {
                    $arraypic = explode(".", $imageupload_name); //แบ่งชื่อไฟล์กับนามสกุลออกจากกัน
//                $lastname = strtolower($arraypic);
                    $filename = "category" . $sub[1]; //ชื่อไฟล์
                    $filetype = $arraypic[1]; //นามสกุลไฟล์
//นำนามสกุลไฟล์มาเช็ค
                    if ($filetype == "jpg" || $filetype == "jpeg" || $filetype == "png" || $filetype == "gif") { //เพิ่มการอนุญาติให้ไฟล์นามสกุลอื่นๆ เพิ่มตรงนี้
                        $newimage = $filename . "." . $filetype; //รวมชื่อไฟล์กับนามสกุลเข้าด้วยกัน
                        $sqlImg = "UPDATE main_category set image='$newimage' where category_id =$sub[1]";
                        $updateImg = $mydb->query($sqlImg);
                        copy($imageupload, "uploads/" . $newimage); //โฟลเดอร์สำหรับเก็บรูป/ไฟล์รูป
                    }
                }
                $feedback = "แก้ไขหมวดหมู่เสร็จสิ้น";
                return $feedback;
            } else {
                echo mysql_error();
                return $feedback;
            }
        } else {
            $feedback = "ชื่อหมวดหมู่ซ้ำ";
            return $feedback;
        }
    }

    public static function deleteSubCategory($data) {
        $subId = $data['subId'];
        $main_category = $data['main_category'];
        $chkProduct = "select idProduct from product where sub_category_sub_category_id = '" . $subId . "'";
        $mydb = new Dbconnect();
        $productQuery = $mydb->query($chkProduct);
        $feedback = "";
        if ($productQuery) {
            while ($product = $productQuery->fetch_array()) {
                $feedback = "กรุณาลบรายการสินค้า";
            }
            if ($feedback == "") {
                $delOption = "DELETE FROM category_options WHERE sub_category_sub_category_id='" . $subId . "'";
                $optionQuery = $mydb->query($delOption);
                if ($optionQuery) {
                    $delSubCategory = "DELETE FROM sub_category WHERE sub_category_id='" . $subId . "'";
                    $subCategoryQuery = $mydb->query($delSubCategory);
                    if ($subCategoryQuery) {
                        $chkSubCategory = "select main_category.category_id from main_category join sub_category on main_category.category_id=sub_category.main_category_category_id where main_category.category_id = '" . $main_category . "'";
                        $chkSubCategoryQuery = $mydb->query($chkSubCategory);
                        if ($chkSubCategoryQuery) {
                            while ($main = $chkSubCategoryQuery->fetch_array()) {
                                $feedback = "ลบหมวดหมู่เสร็จสิ้น";
                            }
                            if ($feedback == "") {
                                $imgMainCategory = "select image from main_category where name='" . $main_category . "'";
                                $imgquery = $mydb->query($imgMainCategory);
                                while($img = $imgquery->fetch_array()){
                                    $image = $img[0];
                                }
                                $delMainCategory = "DELETE FROM main_category WHERE name='" . $main_category . "'";
                                $mainCategoryQuery = $mydb->query($delMainCategory);
                                if($image!="")unlink("uploads/".$image);
                                $feedback = "ลบหมวดหมู่เสร็จสิ้น";
                            }
                            return $feedback;
                        }
                    }
                }
            } 
            else {
                return $feedback;
            }
        }
    }

    public static function getAllCategory() {
        $qstring = "SELECT * FROM sub_category";
        $mydb = new Dbconnect();
        $result = $mydb->query($qstring);
        while ($cell = $result->fetch_array()) {
            echo $cell['main_category_category_id'];
            echo $cell['name'];
        }
        return $cells;
    }

    public static function getCategoryName() {
        $qstring = "SELECT * FROM main_category";
        $mydb = new Dbconnect();
        $result = $mydb->query($qstring);
        while ($row = $result->fetch_array()) {
            $rows[] = $row['name'];
        }
        return $rows;
    }

    public static function autoCompleteName($term) {
        $qstring = "SELECT * FROM main_category where name like '" . $term . "%'";
        $mydb = new Dbconnect();
        $result = $mydb->query($qstring);
        while ($row = $result->fetch_array()) {
            $rows[] = $row['name'];
        }
        return $rows;
    }

    public static function getCategory($name) {
        $qstring = "SELECT * FROM main_category where name = '" . $name . "'";
        $mydb = new Dbconnect();
        $result = $mydb->query($qstring);
        while ($data = $result->fetch_array()) {

            $category[] = $data['category_id'];
            $category[] = $data['name'];
            $category[] = $data['image'];
//            $category[] = $data['start_code'];
        }
        return $category;
    }

    public static function getSubCategory($subName) {
        $qstring = "SELECT * FROM sub_category where name = '" . $subName . "'";
        $mydb = new Dbconnect();
        $result = $mydb->query($qstring);
        while ($subrow = $result->fetch_array()) {
            $subrows[] = $subrow['sub_category_id'];
        }
        return $subrows;
    }
    public static function getSubCategoryBySubCategoryId($subCategoryId) {
        $qstring = "SELECT * FROM sub_category where sub_category_id = '" . $subCategoryId . "'";
        $mydb = new Dbconnect();
        $result = $mydb->query($qstring);
//		$subCategoryItem[] = array();
 //       while ($subrow = $result->fetch_array()) {
 //            array_push($subCategoryItem,$subrow['sub_category_id'];
///			 array_push($subCategoryItem,$subrow['main_category_category_id'];
//			 array_push($subCategoryItem,$subrow['name'];
//			 array_push($subCategoryItem,$subrow['uom'];
//			 array_push($subCategoryItem,$subrow['sub_category_id'];
																															
//        }
        return $result->fetch_array();
    }
    public static function getSubCategoryName($mainName) {
        $qstring = "SELECT * FROM main_category where name = '" . $mainName . "'";
        $mydb = new Dbconnect();
        $result = $mydb->query($qstring);
        $subrows = array();
        $rows = array();
        while ($row = $result->fetch_array()) {
            $rows[] = $row['category_id'];
        }
        $qstring2 = "SELECT * FROM sub_category where main_category_category_id = '" . $rows[0] . "'";
        $result2 = $mydb->query($qstring2);
        while ($subrow = $result2->fetch_array()) {
            $subrows[] = $subrow['name'];
        }
        return $subrows;
    }
	
    public static function getSubCategoryOptionBySubCategoryId($subCategoryId) {
        $qstring = "SELECT * FROM category_options where sub_category_sub_category_id = '" . $subCategoryId . "'";
        $mydb = new Dbconnect();
        $result = $mydb->query($qstring);
        $item = array();
        $rows = array();
        while ($items = $result->fetch_array()) {
            array_push($item, $items['option_1']);
			array_push($item, $items['option_2']);
			array_push($item, $items['option_3']);
			array_push($item, $items['option_4']);
			array_push($item, $items['option_5']);
        }
        return $item;
    }
    public static function getDetailCategory($data) {
        $mainId = $data[0];
        $subname = $data[1];
        $qstring = "SELECT * FROM main_category join sub_category on sub_category.main_category_category_id=main_category.category_id join category_options on category_options.sub_category_sub_category_id = sub_category. sub_category_id where main_category.category_id = '" . $mainId . "' AND sub_category.name = '" . $subname . "'";
        $mydb = new Dbconnect();
        $result = $mydb->query($qstring);
        if ($result) {
            while ($data = $result->fetch_array()) {
                for ($x = 0; $x < count($data) / 2; $x++) {
                    $category[] = $data[$x];
                }
            }
        }
        return $category;
    }

}

?>