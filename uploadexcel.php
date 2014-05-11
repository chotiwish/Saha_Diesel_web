<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Upload Excel ....</title>
</head>
<body>
Uploading ....<br/>

<?php

		$tempFileName = "temp_excel.xlsx";
		$uploadDirectory= "uploads/";
		$allowedExts = array("xlsx");
		$temp = explode(".", $_FILES["file"]["name"]);
		$extension = end($temp);
            require_once 'Classes/PHPExcel/IOFactory.php';
            $objPHPExcel = PHPExcel_IOFactory::load("uploads/MyExcel.xlsx");

            require_once 'Classes/PHPExcel/IOFactory.php';
            $objPHPExcel = PHPExcel_IOFactory::load("uploads/MyExcel.xlsx");
	
			//get Excel file
	if ($_FILES["file"]["error"] > 0) {
		  echo "Error: " . $_FILES["file"]["error"] . "<br>";
	 } else if(in_array($extension, $allowedExts))
	{
	  echo "Upload: " . $_FILES["file"]["name"] . "<br>";
	  echo "Type: " . $_FILES["file"]["type"] . "<br>";
	  echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
	  echo "Stored in: " . $_FILES["file"]["tmp_name"]."<br/>";
	//delete old file	if exist
	 if (file_exists($uploadDirectory . $tempFileName)) {
		 unlink($uploadDirectory.$tempFileName);
      	 echo "Deleted temp file : ".$uploadDirectory.$tempFileName."<br/>";
     } 
		 //save file
         move_uploaded_file($_FILES["file"]["tmp_name"],$uploadDirectory . $tempFileName);
         echo "Successfully upload file to: " . $uploadDirectory. $tempFileName;
	}else{
		  echo " Invalid excel file format.Please upload again.";	
	}
	
?>
</body>
</html>