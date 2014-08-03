var barcodeList =[];

$(function() {

    //press enter to next input
    $('input[type=text]').keydown(function(e) {
        //get the next index of text input element
        var next_idx = $('input[type=text]').index(this) + 1;

        //get number of text input element in a html document
        var tot_idx = $('body').find('input[type=text]').length;

        //enter button in ASCII code
        if (e.keyCode == 13) {
            if (this.id == "inputCarBrand") {
                $("#addCarBrand").click();
            }
            else if (this.id == "inputOemCode") {
                $("#addOemCode").click();
            }
            else if (this.id == "inputBarCode") {
                $("#addBarCode").click();
            }
            else if (tot_idx == next_idx)
                //go to the first text element if focused in the last text input element
                $('input[type=text]:eq(0)').focus();
            else
                //go to the next text input element
                $('input[type=text]:eq(' + next_idx + ')').focus();
            return false;
        }

    });

    $("#textSearchCat").focusout(function() {
        var selectValue = $("#textSearchCat").val();
        var data = {"term": selectValue};
        $(".bodysearch").find("tbody").remove().end();
        $.getJSON("fillForm.php", data, function(result) {
            $.getJSON("getsubcategoryname.php", data, function(subId) {
                var i = 1;
                $.each(subId, function(key, value) {
                    $(".bodysearch").append("<tr class = \"mainId\" id=" + result[0] + "><td>" + selectValue + "</td><td id = td" + i + ">" + value + "</td></tr>");
                    i++;
                    $(".search tbody tr").hover(function() {
                        $(this).css('cursor', 'hand');
                    });
                });
            });
        });
    });
	
	$("#printbarcode").click(function(){
									  			  
			var w = window.open('printbarcoderesult.php');
			var startAtPosition = prompt("เริ่มที่ตำแหน่งที่","1");			
			$.ajax({        
       			type: "POST",
       			url: "printbarcoderesult.php",
      			data: {"barcodeArray":JSON.stringify(barcodeList),"startAt":startAtPosition},
       			success: function(data) {
						//alert("กรุณาตรวจสอบก่อนพิมพ์");
						//alert(JSON.stringify(barcodeList));
						$(w.document.body).html(data);
       			}
    }); 
	});
	
	//remaining product page
    $("#searchRemainingProduct").click(function() {
        var textSearch = $("#textSearchPro").val();
        var select = $("#searchType").val();
		if(select == "ยี่ห้อรถ" || select == "oemcode" || select =="barcode")
			$("#extra").text(select);
		else
			$("#extra").text("ตำแหน่งสินค้า");
        var data = {"term": textSearch, "type": select};
        var tablerow = "";
		$(".tableoverflow").show();
        $(".bodysearch").find("tbody").remove().end();
        $.getJSON("searchproductandcode.php", data, function(result) {
            if (result == null) {
                alert("ไม่พบสินค้า");
            }
			// loop item in a row
            $.each(result, function(key, value) {
                if ((key %10 == 0)) {
                    $(".bodysearch").append("<tr id=" + value + ">");
                    tablerow = value;
                }
                else
                    $(".bodysearch tr:last").append("<td>" + value + "</td>");
			   
			    if ((key % 10 == 9)) {
                    $(".bodysearch tr:last").append("<td><button class='addBarcode' name='barcodeBtn'>เพิ่ม</button></td>");
                    tablerow = value;

                }
			   

            });
			// add event of add barcode button in the main table
			$(".addBarcode").on('click',function(){
					var barcode_temp = prompt("กรุณาระบุจำนวนที่ต้องการพิมพ์", "1");			
					if(isInteger(barcode_temp))
					{
					$row = $(this).closest("tr");
					$barcode = $row.find("td:nth-child(1)");
					$productName = $row.find("td:nth-child(2)");
					$sahaDiesel1 = $row.find("td:nth-child(8)");
					$sahaDiesel2 = $row.find("td:nth-child(9)");
					var barCodeObject = new Object()
					
					$.each($barcode, function() {                // Visits every single <td> element
   						barCodeObject.barCode = $barcode.text();		       // Prints out the text within the <td>
					});
					$.each($productName, function() {                // Visits every single <td> element
   						barCodeObject.productName = $productName.text();		       // Prints out the text within the <td>
					});
					$.each($sahaDiesel1, function() {                // Visits every single <td> element
   						barCodeObject.sahaDiesel1 = $sahaDiesel1.text();		       // Prints out the text within the <td>
					});
					$.each($sahaDiesel2, function() {                // Visits every single <td> element
   						barCodeObject.sahaDiesel2 = $sahaDiesel2.text();		       // Prints out the text within the <td>
					});
						barCodeObject.amount = barcode_temp;			// total amount of print items
						barcodeList.push(barCodeObject);
						//alert(barcodeList);
						//add to barcode array 
						addBarcodeTable(barCodeObject);
					}

			});
								
        });
    });


});

function addBarcodeTable(barCodeObject){

		//add to table 
	    //create 
	   $(".barcodeTableBody ").append("<tr id='barcode_" + barCodeObject.barCode + "'>");
	   $(".barcodeTableBody tr:last").append("<td>" + barCodeObject.barCode + "</td>");
	   $(".barcodeTableBody tr:last").append("<td>" + barCodeObject.productName + "</td>");
	   $(".barcodeTableBody tr:last").append("<td>" + barCodeObject.sahaDiesel1 + "</td>");
	   $(".barcodeTableBody tr:last").append("<td>" + barCodeObject.sahaDiesel2 + "</td>");
	   $(".barcodeTableBody tr:last").append("<td>" + barCodeObject.amount + "</td>");
	   $(".barcodeTableBody tr:last").append("<td><button class='removeBarcode' name='barcodeBtn'>ลบ</button></td>");
	   $("#printbarcode").removeAttr('disabled');
	   
	    $(".removeBarcode").on('click',function(){
			//remove barcode when click remove			
			$row = $(this).closest('tr');
			$barcode = $row.find("td:nth-child(1)");
			$productName = $row.find("td:nth-child(2)");
			$sahaDiesel1 = $row.find("td:nth-child(3)");
			$sahaDiesel2 = $row.find("td:nth-child(4)");
			$amount = $row.find("td:nth-child(5)");
			var barCodeObject = new Object()
			
			$.each($barcode, function() {                // Visits every single <td> element
				barCodeObject.barCode = $barcode.text();		       // Prints out the text within the <td>
			});
			$.each($productName, function() {                // Visits every single <td> element
				barCodeObject.productName = $productName.text();		       // Prints out the text within the <td>
			});
			$.each($sahaDiesel1, function() {                // Visits every single <td> element
				barCodeObject.sahaDiesel1 = $sahaDiesel1.text();		       // Prints out the text within the <td>
			});
			$.each($sahaDiesel2, function() {                // Visits every single <td> element
				barCodeObject.sahaDiesel2 = $sahaDiesel2.text();		       // Prints out the text within the <td>
			});	
			$.each($amount, function() {                // Visits every single <td> element
				barCodeObject.amount = $amount.text();		       // total amount of print items
			});
			//remove item from array
			var itemIndex = myIndexOf(barcodeList,barCodeObject);
			//alert(itemIndex+","+barcodeList);
			if(itemIndex != -1) {
				barcodeList.splice(itemIndex, 1);
			}
			//alert(itemIndex+","+JSON.stringify(barCodeObject));
			//remove item from table
			$(this).closest('tr').remove();
			if(barcodeList.length<=0)
			{
				$("#printbarcode").attr('disabled',true);
			}
		});
}
function myIndexOf(arr,o) {    
    for (var i = 0; i < arr.length; i++) {
        if (arr[i].barCode == o.barCode && arr[i].productName == o.productName&&arr[i].sahaDiesel1 == o.sahaDiesel1 && arr[i].sahaDiesel2 == o.sahaDiesel2&& arr[i].amount == o.amount) {
            return i;
        }
    }
    return -1;
}

function isInteger(n) {
        return /^[0-9]+$/.test(n);
    }

//test alert message
function callmeMayBe(){
	alert("Hello");	
};