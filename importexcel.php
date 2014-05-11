<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form action="uploadexcel.php" target="_blank" method="post" enctype="multipart/form-data">
            เพิ่มสินค้าจาก Excel <br/>
            Upload file : <input type="file" name="file" id="file">  <input type="submit" value="Upload">
            <button onClick="window.location = 'addproduct.php'">เพิ่มสินค้าด้วยตนเอง</button>
            <br>
            <table>
                <thead>
                <th>test</th>
                <th>test2</th>
                </thead>
                <tr>
                    <td>row</td>
                </tr>
            </table>
            <?php
            require_once 'Classes/PHPExcel/IOFactory.php';
            $objPHPExcel = PHPExcel_IOFactory::load("uploads/MyExcel.xlsx");

            require_once 'Classes/PHPExcel/IOFactory.php';
            $objPHPExcel = PHPExcel_IOFactory::load("uploads/MyExcel.xlsx");
            foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
                $worksheetTitle = $worksheet->getTitle();
                $highestRow = $worksheet->getHighestRow(); // e.g. 10
                $highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
                $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
                $nrColumns = ord($highestColumn) - 64;
                echo "<br>The worksheet " . $worksheetTitle . " has ";
                echo $nrColumns . ' columns (A-' . $highestColumn . ') ';
                echo ' and ' . $highestRow . ' row.';
                echo '<br>Data: <table border="1"><tr>';
                for ($row = 1; $row <= $highestRow; ++$row) {
                    echo '<tr>';
                    for ($col = 0; $col < $highestColumnIndex; ++$col) {
                        $cell = $worksheet->getCellByColumnAndRow($col, $row);
                        $val = $cell->getValue();
                        echo '<td>' . $val . '</td>';
                    }
                    echo '</tr>';
                }
                echo '</table>';
            }
            ?>


            <br/><input type="button" onClick="window.location.href = 'index.php'" value="กลับสู่หน้าแรก">
            </body>
            </html>
