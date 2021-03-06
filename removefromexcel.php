<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Removing Items ....</title>
</head>
<body>
Removing ....<br/>

<?php
        require_once 'Classes/PHPExcel/IOFactory.php';
		require_once 'Classes/Product.php';
		$tempFileName = "temp_excel.xlsx";
		$uploadDirectory= "uploads/";
		$allowedExts = array("xlsx","xls");
		$subCategoryID = '';
		$subCategoryName = '';
		$mainCategoryID = '';
		$mainCategoryName = '';
		$dataArray =  array();

	
	
	//read excel file and loop through object 
	 $objPHPExcel = PHPExcel_IOFactory::load($uploadDirectory.$tempFileName);
	
	// read file 
	 foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
                $worksheetTitle = $worksheet->getTitle();
                $highestRow = $worksheet->getHighestRow(); // e.g. 10
                $highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
                $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
                $nrColumns = ord($highestColumn) - 64;
 //               echo "<br>The worksheet " . $worksheetTitle . " has ";
 //               echo $nrColumns . ' columns (A-' . $highestColumn . ') ';
  //              echo ' and ' . $highestRow . ' row.';
  //              echo '<br> <table border="1"><tr>';
                for ($row = 1; $row <= $highestRow; ++$row) {
  //                  echo '<tr>';
					//init object every new row
					$dataObject = '';
					
                    for ($col = 0; $col < $highestColumnIndex; ++$col) {
                        $cell = $worksheet->getCellByColumnAndRow($col, $row);
                        $val = $cell->getValue();
                        //echo '<td>' . $val . '</td>';
						
						//add data to object array 
						
						if($row==1 && $col ==3)
						{
							$subCategoryName = $val;		//set sub categoryName;
							
						}
						if($row==1 && $col ==1)
						{
							$subCategoryID = $val;		//set sub categoryID;
						}
						if($row==1 && $col ==5)
						{
							$mainCategoryID = $val;		//set main categoryID;
						}
						if($row==1 && $col ==7)
						{
							$mainCategoryName = $val;		//set main categoryID;
						}
						//start add object
						if($row>=3)
						{
						
							switch($col)
							{
								case 0 :
								$dataObject['productCode']= $val;			//productID
								break;
								case 1:
								$dataObject['productName']= $val;		//productName
								break;
								case 2:
								$dataObject['oemCode']= explode(",", $val);		//TODO : OEM explode
								break;
								case 3:
								$dataObject['carBrand']=  explode(",", $val);		//TODO : carBrand explode
								break;
								case 4:
								$dataObject['productBrand']= $val;			
								break;
								case 5:
								$dataObject['supplier']= $val;		
								break;
								case 6:
								$dataObject['buyPrice']= $val;		
								//generate barcode sahadiesel buy from this value; 
								$dataObject['sahaDieselBarcodeBuy'] = calculateBarCodeSahaDieselBuy($val);
								break;
								case 7:
								$dataObject['sellPrice']= $val;			
								//generate barcode sahadiesel sell from this value; 
								$dataObject['sahaDieselBarcodeSell'] = calculateBarCodeSahaDieselSell($val);
								break;
								case 8:
								$dataObject['price1']= $val;			
								break;
								case 9:
								$dataObject['price2']= $val;			
								break;
								case 10:
								$dataObject['price3']= $val;		
								break;
								case 11:
								$dataObject['size']= $val;			
								break;
								case 12:
								$dataObject['receivedDate']= $val;				//format dd/mm/yyyy( e.g. 01/12/2014)
								break;
								case 13:
								$dataObject['barCode'] = explode(",", $val);			//TODO : barCode explode
								break;
								case 14:
								$dataObject['poNo'] = $val;		
								break;
								case 15:
								$dataObject['safetyStock']= $val;			
								break;
								case 16:
								$dataObject['itemLocation']= $val;	
								break;
								case 17:
								$dataObject['qTy']= $val;	
								break;
								case 18:
								$dataObject['note']= $val;	
								break;
								case 19:
								$dataObject['option1']= $val;	
								break;
								case 20:
								$dataObject['option2']= $val;	
								break;
								case 21:
								$dataObject['option3']= $val;	
								break;
								case 22:
								$dataObject['option4']= $val;	
								break;
								case 23:
								$dataObject['option5']= $val;	
								break;
								default:'';
							}
							
							
						}
						
                    }
					// echo '<td>' . $subCategoryName . '</td>';
                  //  echo '</tr>';
					if($row>=3)
					{
					//add default data 
					$dataObject['subCategory'] =  $subCategoryName;
					$dataObject['mainCategory'] =  $mainCategoryID;

					// push to array when finish add item
					array_push($dataArray,$dataObject);
					}
                }
  //              echo '</table>';
				//print_r($dataArray);
				insertToProduct($dataArray);
            }
	 //create data object and pass to Product::Insert 
	 
	 function insertToProduct($objectArray)
	 {
		 foreach($objectArray as $obj)
		 {
			 //delete item from product excel
			echo Product::deleteProductFromProductCode($obj)."<br/>";			

		 }
	 }
	 
/*	 function addDefaultFields($obj)
	  {
			$obj['subCategory'] =  $subCategoryName;
			return $obj;
	  }
*/	 
	 function calculateBarCodeSahaDieselBuy($price)
	 {
		$strBuyPrice = $price;
        $buyCode = "";

        for ( $i = 0; $i < strlen($strBuyPrice); $i++)
        {
            switch ($strBuyPrice[$i])
            {
                case "1":
                    $buyCode = $buyCode . "O";
                    break;
                case "2":
                    $buyCode = $buyCode . "C";
                    break;
                case "3":
                    $buyCode = $buyCode . "H";
                    break;
                case "4":
                    $buyCode = $buyCode . "I";
                    break;
                case "5":
                    $buyCode = $buyCode . "A";
                    break;
                case "6":
                    $buyCode = $buyCode . "N";
                    break;
                case "7":
                    $buyCode = $buyCode . "G";
                    break;
                case "8":
                    $buyCode = $buyCode ."M";
                    break;
                case "9":
                    $buyCode = $buyCode ."R";
                    break;
                case "0":
                    $buyCode = $buyCode . "E";
                    break;

                default:
                    break;
            }
        }
		
		return $buyCode;
	 }
	 function calculateBarCodeSahaDieselSell($price)
	 {
		  $strSellPrice = $price;
          $sellCode = "";

        for ( $i = 0; $i < strlen($strSellPrice); $i++)
        {
            switch ($strSellPrice[$i])
            {
            case "1":
                $sellCode = $sellCode."ก";
                break;
            case "2":
                $sellCode = $sellCode."ว";
                break;
            case "3":
                $sellCode = $sellCode."ง";
                break;
            case "4":
                $sellCode = $sellCode."ท";
                break;
            case "5":
                $sellCode = $sellCode."พ";
                break;
            case "6":
                $sellCode = $sellCode."น";
                break;
            case "7":
                $sellCode = $sellCode."จ";
                break;
            case "8":
                $sellCode = $sellCode."ด";
                break;
            case "9":
                $sellCode = $sellCode."บ";
                break;
            case "0":
                $sellCode = $sellCode."ย";
                break;
                
                default:
                    break;
            }
        }
		return $sellCode;
	 }
?>
</body>
</html>