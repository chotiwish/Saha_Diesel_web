<?php
/**
 * PHPExcel
 *
 * Copyright (C) 2006 - 2014 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2014 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    1.8.0, 2014-03-02
 */

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/Classes/PHPExcel.php';
include("Classes/Category.php");

//get request parameter sub category name

$subCategoryId = $_REQUEST["sub_id"];

$subCategoryOptions = Category::getSubCategoryOptionBySubCategoryId($subCategoryId);
$subCategoryValue = Category::getSubCategoryBySubCategoryId($subCategoryId);

$subCategoryName =$subCategoryValue['name'] ;
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Saha Diesel")
							 ->setLastModifiedBy("Saha Diesel")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");

$objPHPExcel->getDefaultStyle()
    ->getNumberFormat()
    ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
	
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Subcategory ID')
            ->setCellValue('B1', $subCategoryId)
            ->setCellValue('C1', 'Subcategory Name')
            ->setCellValue('D1', $subCategoryValue['name'] )
            ->setCellValue('E1', 'Category ID')
            ->setCellValue('F1', $subCategoryValue['main_category_category_id'])
            ->setCellValue('G1', ' รหัสเริ่มต้น')
            ->setCellValue('H1', $subCategoryValue['start_code'])
            ->setCellValue('I1', 'หน่วย')
            ->setCellValue('J1', $subCategoryValue['uom']);
			
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A2', ' รหัสสินค้า')
            ->setCellValue('B2', 'ชื่อสินค้า')
			->setCellValue('C2', 'OEM Code(,)')
			 ->setCellValue('D2', 'ยี่ห้อรถ(,)')
            ->setCellValue('E2', 'ชื่อยี่ห้อ')
            ->setCellValue('F2', 'ชื่อบริษัทผู้ขาย')
            ->setCellValue('G2', ' ราคาทุนต่อหน่วย')
            ->setCellValue('H2', 'ราคาขายหน้าร้าน')
            ->setCellValue('I2', ' ราคาขายพิเศษ 1')
            ->setCellValue('J2', 'ราคาขายพิเศษ 2')
            ->setCellValue('K2', ' ราคาขายพิเศษ 3')
            ->setCellValue('L2', 'ขนาด')
            ->setCellValue('M2', 'วันที่รับสินค้า')
            ->setCellValue('N2', ' Barcode สินค้า(,)')
            ->setCellValue('O2', ' Barcode สหดีเซล')
            ->setCellValue('P2', 'เลขที่ใบสั่งซื้อ')
            ->setCellValue('Q2', 'เตือนเมื่อจำนวนสินค้าต่ำกว่า')
            ->setCellValue('R2', 'ตำแหน่งสินค้า ')
            ->setCellValue('S2', 'จำนวน')
            ->setCellValue('T2', ' note');
			
			if(count($subCategoryOptions)>0)
			{
				if($subCategoryOptions>=1)
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('U2', $subCategoryOptions[0]);
				if($subCategoryOptions>=2)
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('V2',  $subCategoryOptions[1]);
				if($subCategoryOptions>=3)
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('W2', $subCategoryOptions[2]);
            	if($subCategoryOptions>=4)
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('X2',  $subCategoryOptions[3]);
            	if($subCategoryOptions>=5)
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Y2',  $subCategoryOptions[4]);
			}
			
			
// Miscellaneous glyphs, UTF-8
//$objPHPExcel->setActiveSheetIndex(0)
 //           ->setCellValue('A4', 'Miscellaneous glyphs')
 //           ->setCellValue('A5', 'éàèùâêîôûëïüÿäöüç');

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle($subCategoryName );


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="01simple.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
