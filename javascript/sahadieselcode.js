$(function() {

    


    $("input[name='buyPrice']").focusout(function() {
        var strBuyPrice = $("input[name='buyPrice']").val();
        var buyCode = "";
        var sellCode = "";

        for (var i = 0; i < strBuyPrice.length; i++)
        {
            switch (strBuyPrice.charAt(i))
            {
                case "1":
                    buyCode = buyCode + "O";
                    break;
                case "2":
                    buyCode = buyCode + "C";
                    break;
                case "3":
                    buyCode = buyCode + "H";
                    break;
                case "4":
                    buyCode = buyCode + "I";
                    break;
                case "5":
                    buyCode = buyCode + "A";
                    break;
                case "6":
                    buyCode = buyCode + "N";
                    break;
                case "7":
                    buyCode = buyCode + "G";
                    break;
                case "8":
                    buyCode = buyCode + "M";
                    break;
                case "9":
                    buyCode = buyCode + "R";
                    break;
                case "0":
                    buyCode = buyCode + "E";
                    break;

                default:
                    break;
            }
        }
        // alert(buyCode+","+sellCode);

        $("input[name='sahaDieselBarcodeBuy']").val(buyCode);

    });

    $("input[name='sellPrice']").focusout(function() {
        var strSellPrice = $("input[name='sellPrice']").val();
        var sellCode = "";

        for (var i = 0; i < strSellPrice.length; i++)
        {
            switch (strSellPrice.charAt(i))
            {
            case "1":
                sellCode = sellCode+"ก";
                break;
            case "2":
                sellCode = sellCode+"ว";
                break;
            case "3":
                sellCode = sellCode+"ง";
                break;
            case "4":
                sellCode = sellCode+"ท";
                break;
            case "5":
                sellCode = sellCode+"พ";
                break;
            case "6":
                sellCode = sellCode+"น";
                break;
            case "7":
                sellCode = sellCode+"จ";
                break;
            case "8":
                sellCode = sellCode+"ด";
                break;
            case "9":
                sellCode = sellCode+"บ";
                break;
            case "0":
                sellCode = sellCode+"ย";
                break;
                
                default:
                    break;
            }
        }
        // alert(buyCode+","+sellCode);
        $("input[name='sahaDieselBarcodeSell']").val(sellCode);

    });
});