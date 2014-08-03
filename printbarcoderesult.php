

<link rel="stylesheet" type="text/css" href="css/barcode-style.css" >
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css" >

<html>
    <head>
        <meta charset="UTF-8">
        <title>ตรวจสอบจำนวนสินค้า</title>
    </head>
    <body>
   <?php
   		//$array=json_decode($_POST['barcodeArray']);
   		$barcodeList =  $_REQUEST["barcodeArray"];
		$startPosition = $_REQUEST["startAt"];
		$obj = json_decode($barcodeList);
//check position 
if($startPosition>1)
{
		for($j=1;$j<$startPosition;$j++)
		{
				//create blank item
				echo '<div class="blankbarcodeItem" >';

   				echo '</div>';
		}
		
}
		foreach ($obj as $barcodeItem)
		{

			for($i=0;$i<$barcodeItem->amount;$i++)
			{
		    	echo '<div class="barcodeItem" >';
				echo '<div class="barcodeContents">';
   				echo '<div class="topbar"><span class="centerbar">'.$barcodeItem->productName.'</span></div>';
   				echo '<img alt="barCode" src="./barcode/barcode.php?codetype=Code39&size=40&text='.$barcodeItem->barCode.'" />';
   				echo '<div class="bottombar"><span class="leftinfo">'.$barcodeItem->sahaDiesel1.'</span><span class="rightinfo">'.$barcodeItem->sahaDiesel2.'</span><div class="centerinfo">'.$barcodeItem->barCode.'</div></div>';
   				echo '</div></div>';
			}
		}

   ?>

</body>

</html>