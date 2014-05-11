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
            Upload file : <input type="file" name="file" id="file">  <input type="submit" value="Upload"><br/>
            <input type="button" onClick="window.location.href = 'addproduct.php';return;" value = "เพิ่มสินค้าด้วยตนเอง"><br/>
            <input type="button" onClick="window.location.href = 'index.php';return;" value="กลับสู่หน้าแรก">
            </form>
            
            <form action="removefromexcel.php" target="_blank" method="post" enctype="multipart/form-data">
             <input type="submit" value="Remove Previous Items"><br/>
            </form>
            </body>
            </html>
