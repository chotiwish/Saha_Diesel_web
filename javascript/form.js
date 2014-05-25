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

    //enter number
    $('#buyPrice').bind('keypress', function(e) {
        return (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) ? false : true;
    });

    $('#sellPrice').bind('keypress', function(e) {
        return (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) ? false : true;
    });


    //enter date
    $("#receivedDate").datepicker({dateFormat: 'dd/mm/yy'});
    $("#receivedDate").keydown(function() {
        return false;
    });
    
    $("#delete").click(function() {
        var answer = confirm("ยืนยันการลบ")
        if (answer)
            return true;
        else
            return false;
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

    $("form").submit(function(event) {

        var pathname = window.location.pathname;
        //detect if from editcategory
        if ((pathname == "/saha_diesel/editcategory.php") || (pathname == "/saha_diesel/addcategory.php") || (pathname == "/Saha_Diesel/editcategory.php") || (pathname == "/Saha_Diesel/addcategory.php")) {
            if ($("#main_category").val() == "") {
                alert("กรุณาระบุหมวดหมู่หลัก");
                return false;
            }
            else if ($("#sub_category").val() == "") {
                alert("กรุณาระบุหมวดหมู่ย่อย");
                return false;
            }
            else if ($("#prefix_product_id").val() == "") {
                alert("prefix_product_id");
                return false;
            }
            else if ($("#uom").val() == "") {
                alert("กรุณาระบุหน่วยสินค้า");
                return false;
            }
            else if ($("#category_image").val() != "") {
                var extall = "jpg,jpeg,gif,png";
                var file = $("#category_image").val();
                var type = file.split('.').pop().toLowerCase();
                if (parseInt(extall.indexOf(type)) < 0)
                {
                    alert('รูปภาพนามสกุล ' + extall + " เท่านั้น");
                    return false;
                }
            }
        }
        else {

            if ($("#productBrand").val() == "") {
                alert("กรุณาระบุชื่อยี่ห้อ");
                return false;
            }
            else if ($("#supplier").val() == "") {
                alert("กรุณาระบุชื่อบริษัทผู้ขาย");
                return false;
            }
            else if ($("#productName").val() == "") {
                alert("กรุณาระบุชื่อสินค้า");
                return false;
            }
            else if ($("#productCode").val() == "") {
                alert("กรุณาระบุรหัสสินค้า");
                return false;
            }
            else if ($("#size").val() == "") {
                alert("กรุณาระบุขนาด");
                return false;
            }
            else if ($("#receivedDate").val() == "") {
                alert("กรุณาระบุวันที่รับสินค้า");
                return false;
            }
            else if ($("#buyPrice").val() == "") {
                alert("กรุณาระบุราคาทุน");
                return false;
            }
            else if ($("#sellPrice").val() == "") {
                alert("กรุณาระบุราคาขายหน้าร้าน");
                return false;
            }
        }
    });
	
	//in edit productPage
    $("#searchProduct").click(function() {
        var textSearch = $("#textSearchPro").val();
        var select = $("#searchType").val();
		
		if(select == "ยี่ห้อรถ" || select == "oemcode" || select =="barcode")
			$("#extra").text(select);
		else
			$("#extra").text("ตำแหน่งสินค้า");
        var data = {"term": textSearch, "type": select};
        var tablerow = "";
        $(".bodysearch").find("tbody").remove().end();
        $.getJSON("searchproduct.php", data, function(result) {
            if (result == null) {
                alert("ไม่พบสินค้า");
            }
            $.each(result, function(key, value) {
                if ((key % 7 == 0)) {
                    $(".bodysearch").append("<tr id=" + value + ">");
                    tablerow = value;
                }
                else
                    $(".bodysearch tr:last").append("<td>" + value + "</td>");
			   
					
                $(".search tbody tr").hover(function() {
                    $(this).css('cursor', 'hand');
                });
            });
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
        $(".bodysearch").find("tbody").remove().end();
        $.getJSON("searchproduct.php", data, function(result) {
            if (result == null) {
                alert("ไม่พบสินค้า");
            }
            $.each(result, function(key, value) {
                if ((key % 8 == 0)) {
                    $(".bodysearch").append("<tr id=" + value + ">");
                    tablerow = value;
                }
                else
                    $(".bodysearch tr:last").append("<td>" + value + "</td>");
			   
					
                $(".search tbody tr").hover(function() {
                    $(this).css('cursor', 'hand');
                });
            });
        });
    });
    //edit category
    $("#selectCategory").change(function() {
        var selectValue = $("#selectCategory").val();
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

    $("#copyCategory").change(function() {
        var selectValue = $("#copyCategory").val();
        var data = {"term": selectValue};
        $.getJSON("fillForm.php", data, function(result) {
            $("#main_category").val(result[1]);
        });
    });

    //get select subCategory (add product)
    var prefixcode = "";
    $("#mainCategory").change(function() {
        $('#subCategory').find('option').remove().end();
        $("#divOption").find("#option").remove().end();
        var selectValue = $("#mainCategory").val();
        var data = {"term": selectValue};
        $.getJSON("fillForm.php", data, function(result) {
            $.getJSON("getsubcategoryname.php", data, function(subId) {
                $.each(subId, function(key, value) {
//        alert( key + ": " + value);
                    $("#subCategory").append("<option class=" + result[0] + ">" + value + "</option>");
                    if (key == 0) {
                        $("#divOption").find("#option").remove().end();
                        var mainCategoryId = $("#subCategory").children(":selected").attr("class");
                        var subName = $("#subCategory").val();
                        var data = {"mainCategoryId": mainCategoryId, "subName": subName};
                        $.getJSON("getDetailCategory.php", data, function(result)
                        {
                            $("#divOption").append("<div id=\"option\">");
                            for ($x = 9, i = 1; $x <= 13; $x++, i++) {
                                if (result[$x] != "") {
                                    $("#option").append(result[$x] + "\n\
            <input type=\"text\" name=\"option" + i + "\" id=\"option" + i + "\"><br/>");
                                }
                            }
                            prefixcode = result[7];
                            $("#productCode").val(prefixcode);

                        });
                    }
                });
            });

        });
    });

    $("#productCode").bind('change keydown keyup', function(e) {
        if (this.value.substring(0, prefixcode.length) != prefixcode) {
            $(this).val(prefixcode);
        }
        //backspace and deleted
        if (e.which == 8 || e.which == 46) {
            if (this.value.substring(0, prefixcode.length) != prefixcode) {
                return false;
//                $(this).val(prefixcode);
            }
        }
    });

    $('#subCategory').change(function() {
        $("#divOption").find("#option").remove().end();
        var mainId = $("#subCategory").children(":selected").attr("class");
        var subCategory = $("#subCategory").val();
        var data = {"mainCategoryId": mainId, "subName": subCategory};
        $.getJSON("getDetailCategory.php", data, function(result)
        {
            $("#divOption").append("<div id=\"option\">");
            for ($x = 9, i = 1; $x <= 13; $x++, i++) {
                if (result[$x] != "") {
                    $("#option").append(result[$x] + "\n\
            <input type=\"text\" name=\"option" + i + " id=\"option" + i + "><br/>");
                }
            }
            prefixcode = result[7];
            $("#productCode").val(prefixcode);
        });
    });
//check List
    $("#copy").click(function() {
        if ($("#copy").is(":checked")) {
            $("#copyCategory").removeAttr("disabled");
        }
        else {
            $("#copyCategory").attr("disabled", "disabled");
        }
    });
    //search product fn
    $("input[type='radio']").click(function() {
        $("input[name='category']").attr("disabled", "disabled");
        $("#selectCategory").prop('disabled', 'disabled');
        $('input[type=radio]:checked').next().removeAttr("disabled");
    });

    // table search category
    $(document).on("click", ".bodysearch tbody tr", function(e) {
        var pathname = window.location.pathname;
        //detect if from editcategory
        if ((pathname == "/saha_diesel/editcategory.php") || (pathname == "/Saha_Diesel/editcategory.php")) {
            var mainCategoryId = this.id;
            var rowIndex = this.rowIndex + 1;
            var tdId = "td" + rowIndex;
            var subname = $(this).find("#" + tdId).html();
            var data = {"mainCategoryId": mainCategoryId, "subName": subname};
            $.getJSON("getDetailCategory.php", data, function(result)
            {
                //mainCategory
                var selectMainCategory = $(document).find("#main_category");
                $(selectMainCategory).val(result[1]);
                $("#prefix_product_id").val(result[7]);
                //subCategory
                $("#sub_category").val(result[5]);
                $("#uom").val(result[6]);
                //categoryOption
//                "echo \"<img width=150 src='uploads/'"+result[2]+";\""
                $("#img").find("img").remove();
                if (result[2] != "") {
                    $("#img").append("<img width=150 src='uploads/" + result[2] + "'>");
                }
                $("#option1").val(result[9]);
                $("#option2").val(result[10]);
                $("#option3").val(result[11]);
                $("#option4").val(result[12]);
                $("#option5").val(result[13]);
				
				$("#export_sub_id").val(result[3]);
            });
        }
        else { //edit product

            var productCode = this.id;
            var data = {"term": productCode};
            $.getJSON("getDetailProduct.php", data, function(result) {

                $("#Hino").removeAttr("checked");
                $("#Isuzu").removeAttr("checked");
                $("#Nissan").removeAttr("checked");
                $("#Mitsubishi").removeAttr("checked");
                $("#Toyota").removeAttr("checked");
                $("#หางพ่วง").removeAttr("checked");
                $("#Other").removeAttr("checked");

                var selectMainCategory = $(document).find("#mainCategory");
                var selectSubCategory = $(document).find("#subCategory");
                $(selectMainCategory).val(result[32]);
                $(selectSubCategory).val(result[29]);
                prefixcode = result[30];
                $("#productBrand").val(result[2]);
                $("#supplier").val(result[3]);
                $("#productName").val(result[4]);
                $("#productCode").val(result[5]);
                $("#qTy").val(result[6]);
                $("#size").val(result[7]);
                $("#poNo").val(result[8]);
                $("#receivedDate").val(result[9]);
				$("#itemLocation").val(result[10]);
                $("#safetyStock").val(result[11]);
                $("#buyPrice").val(result[12]);
                $("#sellPrice").val(result[13]);
                $("#price1").val(result[14]);
                $("#price2").val(result[15]);
                $("#price3").val(result[16]);
                $("#sahaDieselBarcodeBuy").val(result[22]);
                $("#sahaDieselBarcodeSell").val(result[23]);
                $("#note").val(result[24]);
                $("#divOption").find("#option").remove().end();
                $("#divOption").append("<div id=\"option\">");
                $("#img").find("img").remove();
                if (result[25] != null) {
                    $("#img").append("<img width=150 src='uploads/" + result[25] + "'>");
                }
                for ($x = 35, i = 1; $x <= 38; $x++, i++) {
                    if (result[$x] != "") {
                        $("#option").append(result[$x] + "<input type=\"text\" name=\"option" + i + "\" id=\"option" + i + "\"><br/>");
//                        var optionid = "option"+i;
                        $("#option" + i).val([result[i + 16]]);
                    }
                }
                //barcode
                $("#barCode").find("option").remove().end();
                for ($x = 39; $x < result.length; $x++) {
                    if (result[$x] == "oemcode")
                        break;
                    $("#barCode").append("<option>" + result[$x] + "</option>");
                }
                //oemcode
                $("#oemCode").find("option").remove().end();
                for ($x++; $x < result.length; $x++) {
                    if (result[$x] == "carbrand")
                        break;
                    $("#oemCode").append("<option>" + result[$x] + "</option>");
                }
                //carbrand
                $("#carBrand").find("option").remove().end();
                for ($x++; $x < result.length; $x++) {
                    if (result[$x] == "carbrand")
                        break;
                    $("#carBrand").append("<option>" + result[$x] + "</option>");
                }
                $('#subCategory').find('option').remove().end();
                var selectValue = $("#mainCategory").val();
                var data = {"term": selectValue};
                $.getJSON("fillForm.php", data, function(result) {
                    $.getJSON("getsubcategoryname.php", data, function(subId) {
                        $.each(subId, function(key, value) {
                            $("#subCategory").append("<option class=" + result[0] + ">" + value + "</option>");
                        });
                    });
                });
            });
        }
    });

    $("#addBarCode").click(function() {
        var barcode = $("#inputBarCode").val();

        $("#barCode").find("option").each(function() {
            if ($(this).val() == barcode) {
                barcode = "";
                $("#inputBarCode").val("");
            }
        });
        if (barcode == "")
            return false;

        $("#barCode").append("<option>" + barcode + "</option>");
        $("#inputBarCode").val("");
        $("#inputBarCode").focus();
        return false;
    });

    $("#addOemCode").click(function() {
        var oemcode = $("#inputOemCode").val();

        $("#oemCode").find("option").each(function() {
            if ($(this).val() == oemcode) {
                oemcode = "";
                $("#inputOemCode").val("");
            }
        });
        if (oemcode == "")
            return false;

        $("#oemCode").append("<option>" + oemcode + "</option>");
        $("#inputOemCode").val("");
        $("#inputOemCode").focus();
        return false;
    });

    $("#addCarBrand").click(function() {
        var carbrand = $("#inputCarBrand").val();

        $("#selectCarBrand").find("option").each(function() {
            if ($(this).val() == carbrand) {
                carbrand = "";
                $("#inputCarBrand").val("");
            }
        });
        
        $("#carBrand").find("option").each(function() {
            if ($(this).val() == carbrand) {
                carbrand = "";
                $("#inputCarBrand").val("");
            }
        });
        
        if (carbrand == "")
            return false;

        $("#selectCarBrand").append("<option>" + carbrand + "</option>");
        $("#inputCarBrand").val("");
        $("#inputCarBrand").focus();
        return false;
    });

    $("#useSelectCarBrand").click(function() {
        var selectCarbrand = $('#selectCarBrand option:selected').val();

        $("#carBrand").find("option").each(function() {
            if ($(this).val() == selectCarbrand) {
                selectCarbrand = "";
            }
        });
        if (selectCarbrand == "")
            return false;
        if(selectCarbrand!=null){
        $("#carBrand").append("<option>" + selectCarbrand + "</option>");
        $('#selectCarBrand option:selected').remove();
    }
        return false;
    });

    $("#delOemCode").click(function() {
        $('#oemCode option:selected').remove();
        return false;
    });

    $("#delBarCode").click(function() {
        $('#barCode option:selected').remove();
        return false;
    });

    $("#delCarBrand").click(function() {
        $('#selectCarBrand option:selected').remove();
        return false;
    });

    $("#unusedSelectCarBrand").click(function() {
        var selectCarbrand = $('#carBrand option:selected').val();
        if(selectCarbrand!=null){
        $("#selectCarBrand").append("<option>" + selectCarbrand + "</option>");
        $('#carBrand option:selected').remove();
    }
        return false;
    });

    $("#updateproduct").click(function() {
        $("#oemCode").find("option").attr("selected", "selected");
        $("#barCode").find("option").attr("selected", "selected");
        $("#carBrand").find("option").attr("selected", "selected");
    });
	
	$("#export_excel").click(function() {
				//ajax post form
				//alert($("#export_sub_id").val());
				var sub_id  = $("#export_sub_id").val();
				//show pop up with url
				if(sub_id!=0)
					window.open('./export-excel.php?sub_id='+sub_id);
				else
					alert('Can not export this sub category');
	});
});