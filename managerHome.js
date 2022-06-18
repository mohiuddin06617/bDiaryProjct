$(document).ready(function () {
    $('#todaysBazarListStatusTile').on('click', function () {
        window.location.href = "managerShoppingCost.php";
    });
    $('#currentMonthTotalCostTile').on('click', function () {
        window.location.href = "groupFinancialInfo.php";
    });
    $('#todayShopperNameTile').on('click', function () {
        window.location.href = "shopperSelection.php";
    });
});


jQuery(document).ready(function () {
    getMemberMonthlyData();

    function getMemberMonthlyData() {
        $.ajax({
            method: "POST",
            url: "groupFinancialInfoFetch.php",
            data:{memberMonthData:'memberDataFetch'},
            dataType: "json",
            success: function (data) {
                if (!jQuery.isEmptyObject(data)) {
                    var table_data = '';
                    $(function () {
                        $.each(data, function (name, amount) {
                            table_data += '<tr><td>' + name + '</td><td>' + amount + ' TK</td></tr>';
                        });
                        if (table_data) {
                            $("#memberPayableAmount").html(table_data);
                        }
                        else {
                            $("#memberPayableAmount").html("<tr><td colspan='2'><h3>No Data Available</h3></td></tr>");
                        }
                    });
                }
            },
            error: function () {

            }

        });
    }
});