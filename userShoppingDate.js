$(document).ready(function () {

});

function changedMonthSelection(monthVal) {
    $.ajax({
        url:'userShoppingDateFetch.php',
        method:'POST',
        data:{'selectedMonthVal':monthVal}
    }).done(function(data){
        $('#selectedMonthResult').html(data);
    });
}