$(document).ready(function () {
    $.get('memberShoppingDateList.php',function (data) {
        $('#showSelectionAnswer').html(data);
    });
    var array = ["21-06-2017","25-06-2017","16/06/2017"];

    $('#selectedDateForShopper').datepicker({
        beforeShowDay: function(date){
            var string = jQuery.datepicker.formatDate('dd-mm-yy', date);
            return [ array.indexOf(string) == -1 ]
        },showAnim: 'slide', showButtonPanel: true
    });

    $("#saveShopperBtn").on('click',function () {
        saveShopper();
    });
    $('#editShoppingDate').on('click',function () {
        var value= $('.selected-date').text();
        editShoppingDate();
    });
});
function saveShopper() {
    var selectedDateForShopper=$('#selectedDateForShopper').val();
    var selectedShopper=$('#selectedShopper').val();
    $.ajax({
        type:'POST',
        url: 'shoppingDatePersonDynamicEntry.php',
        data: {'selectedShopper': selectedShopper, 'selectedDateForShopper': selectedDateForShopper},
        success: function (data) {
            $("#showSelectionAnswer").html(data);
            $("#showSelectionAnswer").fadeIn().fadeOut(3300);
        },
        error: function (xhr)
        {
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
        }
    });
}

function switchManagerUserProfile(value) {
    if (this.value == 'user') {
        window.location.replace('userHome.php');
    }
    else if (this.value == 'manager') {
        window.location.replace('managerHome.php');
    }
}
function changedMonthSelection(val) {
    console.log('Changed To: '+val);
}
function editShoppingDate(){
    console.log('Clicked');
}