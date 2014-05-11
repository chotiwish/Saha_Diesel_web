$(function() {
    // addcategory
    $("#main_category").autocomplete({
        source: 'search.php'
    });
    // editcategory
    $("#textSearchCat").autocomplete({
        source: 'search.php'
    });
    // editproduct
    $("#textSearchPro").keydown(function() {
        $("#textSearchPro").autocomplete({
            source: 'search.php?type=' + $("#searchType").val()
        });
    });
  });