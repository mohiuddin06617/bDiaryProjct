$(document).ready(function () {

});

function changedMonthSelection(monthVal) {

    swal("Hello for :"+monthVal);
    $.ajax({
        url:'showShoppingDateToUserFetch.php',
        method:'POST',
        data:{'selectedMonthVal':monthVal}
    }).done(function(data){
        $('#selectedMonthResult').html(data);
    });
}