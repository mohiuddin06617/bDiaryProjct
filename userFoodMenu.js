$('#getSpecificDateFoodMenu').on('click', function () {
    getSpecificDateMenu();
});

function showMealList(val) {
    var mealShowTime = val;
    $("#showMealListData").html("");
    $.ajax({
        type: 'POST',
        url: 'userFoodMenuFetch.php',
        data: "mealShowTime=" + mealShowTime,
        success: function (data) {
            $("#showMealListData").fadeOut(0).html(data).fadeIn(300);

        }
    });
}
function getSpecificDateMenu() {
    var specifiedDate = $("#datepickerForUserSelectedFoodMenu").val();
    $.ajax({
        type: 'POST',
        url: 'userFoodMenuFetch.php',
        data: "specifiedDate=" + specifiedDate,
        success: function (data) {
            $("#showSpecifiedDateFoodMenu").html(data).fadeIn('slow');

        }
    });
}

$('#datepickerForUserSelectedFoodMenu').datepicker
({
    dateFormat: 'dd/mm/yy', showAnim: 'slide', showButtonPanel: true
});