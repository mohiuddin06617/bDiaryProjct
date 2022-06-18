$(document).ready(function () {
    $("#datepickerforManagerSelectedDateMenu").datepicker({
        dateFormat: 'dd/mm/yy',
        showAnim: 'slide',
        showButtonPanel: true,
        changeYear: true,
        changeMonth: true
    });
    $('#datepickerManagerFoodMenu').datepicker({
        dateFormat: 'dd/mm/yy',
        showAnim: 'slide',
        showButtonPanel: true,
        changeYear: true,
        changeMonth: true
    });
});
$.ui.dialog.prototype._allowInteraction = function (e) {
    return !!$(e.target).closest('#datepickerManagerFoodMenu').length;
};
jQuery(document).ready(function ($) {
    $('.my_form .add-box').click(function () {
        var n = $('.text_box').length + 1;
        if (6 < n) {
            alert('Stop it!');
            return false;
        }
        var item_textBox = $('<p class="text_box">' +
            '<label class="label-input-lg" for="item' + n + '"">ITEM <span class="item_number">' + n + '</span> : </label>' +
            '<input type="text" class="form-control input-lg slide-up" name="itemList[]" value="" id="item' + n + '" placeholder="Enter Other Food Menu Item Here" />' +
            '<a href="#" class="remove-box btn btn-primary btn-lg">Remove</a></p>');
        item_textBox.hide();
        $('.my_form p.text_box:last').after(item_textBox);
        item_textBox.fadeIn('slow');
        return false;
    });
    $('.my_form').on('click', '.remove-box', function () {
        $(this).parent().css('background-color', '#5C5DFF');
        $(this).parent().fadeOut("slow", function () {
            $(this).remove();
            $('.item_number').each(function (index) {
                $(this).text(index + 1);
            });
        });
        return false;
    });
});

$(document).ready(function () {
    $("#specificDateFoodMenu").hide();
    $('#saveFoodmenu').on('click', function () {
        saveDailyFoodMenuSelection();
    });
    $('#selectedDayToSawFoodMenu').on('change', function () {
        var selectedDayToSawFoodMenu = $('#selectedDayToSawFoodMenu').val();
        console.log("Changed : " + selectedDayToSawFoodMenu);
        getAllSelectedDayFoodMenu(selectedDayToSawFoodMenu);
    });
    $('#specificDateFoodMenuButton').on('click', function () {
        var specifiedDate = $('#datepickerforManagerSelectedDateMenu').val();
        $("#specificDateFoodMenu").fadeIn("slow");
        specificDateFoodMenu(specifiedDate);
    });
});

function saveDailyFoodMenuSelection() {
    $.ajax({
        method: "POST",
        url: "dailyFoodMenuSelectionEntry.php",
        data: $('#saveFoodMenuItemDate').serialize(),
        success: function (data) {
            $('#saveFoodMenuItemDate')[0].reset();
            $('#foodMenuSavingResult').html(data).fadeIn('slow').fadeOut(5000);

        },
        error: function (data) {
            console.log('An error occurred.');
            console.log(data);
        }
    });
}

function getAllSelectedDayFoodMenu(selectedDayToSawFoodMenu) {
    //$("#breakfastUserFoodMenu tbody").html("");
    $.ajax({
        method: "POST",
        url: "dailyFoodMenuSelectionFetch.php",
        dataType: "json",
        data: {selectedNoOfDayToSawFoodMenu: selectedDayToSawFoodMenu},
        success: function (jdata) {
            if (!jQuery.isEmptyObject(jdata)) {
                var breakfast_table_data = '';
                var lunch_table_data = '';
                var dinner_table_data = '';
                $(function () {
                    $.each(jdata, function (i, item) {
                        if (item.inserted_time === 'Breakfast') {

                            breakfast_table_data += '<tr>';
                            breakfast_table_data += '<td><b>' + item.item_name + '</b></td>';
                            breakfast_table_data += '<td><b>'+item.inserted_date+'</b></td>';
                            breakfast_table_data += '<td><button class="btn btn-success btn-block"><i class="fa fa-edit"></i> EDIT</button></td>';
                            breakfast_table_data += '</tr>';
                        }
                        else if (item.inserted_time === 'Lunch') {
                            lunch_table_data += '<tr>';
                            lunch_table_data += '<td><b>' + item.item_name + '</b></td>';
                            lunch_table_data += '<td><b>'+item.inserted_date+'</b></td>';
                            lunch_table_data += '<td><button class="btn btn-success btn-block"><i class="fa fa-edit"></i> EDIT</button></td>';
                            lunch_table_data += '</tr>';
                        }
                        else if (item.inserted_time === 'Dinner') {
                            dinner_table_data += '<tr>';
                            dinner_table_data += '<td><b>' + item.item_name + '</b></td>';
                            dinner_table_data += '<td><b>'+item.inserted_date+'</b></td>';
                            dinner_table_data += '<td><button class="btn btn-success btn-block"><i class="fa fa-edit"></i> EDIT</button></td>';
                            dinner_table_data += '</tr>';
                        }
                    });
                    $('#breakfastUserFoodMenu').html(breakfast_table_data);
                    $('#lunchUserFoodMenu').html(lunch_table_data);
                    $('#dinnerUserFoodMenu').html(dinner_table_data);
                });
            }
            else {
                $('#breakfastUserFoodMenu').html("<h3 class='text-center'>No Data Available</h3>");
                $('#lunchUserFoodMenu').html("<h3 class='text-center'>No Data Available</h3>");
                $('#dinnerUserFoodMenu').html("<h3 class='text-center'>No Data Available</h3>");

            }

        },
        error: function (req, status, error) {
            console.log(req + "\n" + status + "\n" + error);
        }
    });
}

function specificDateFoodMenu(specificDateFoodMenu) {

    $.ajax({
        method: "POST",
        url: "dailyFoodMenuSelectionFetch.php",
        dataType: 'json',
        data: {specificDateFoodMenu: specificDateFoodMenu},
        success: function (jdata) {
            //console.log(data);
            //var jdata = JSON.parse(data);
            if (!jQuery.isEmptyObject(jdata)) {

                var breakfast_table_data = '';
                var lunch_table_data = '';
                var dinner_table_data = '';

                $(function () {
                    $.each(jdata, function (i, item) {
                        if (item.inserted_time === 'Breakfast') {
                            breakfast_table_data += '<tr>';
                            breakfast_table_data += '<td><b>' + item.item_name + '</b></td>';
                            breakfast_table_data +='<td><button class="btn btn-primary btn-block btn-getting"><i class="fa fa-edit"></i> EDIT</button></td>';
                            breakfast_table_data += '</tr>';
                        }
                        else if (item.inserted_time === 'Lunch') {
                            lunch_table_data += '<tr>';
                            lunch_table_data += '<td><b>' + item.item_name + '</b></td>';
                            lunch_table_data += '<td><button class="btn btn-primary btn-block btn-getting"><i class="fa fa-edit"></i> EDIT</button></td>';
                            lunch_table_data += '</tr>';
                        }
                        else if (item.inserted_time === 'Dinner') {
                            dinner_table_data += '<tr>';
                            dinner_table_data += '<td><b>' + item.item_name + '</b></td>';
                            dinner_table_data += '<td><button class="btn btn-primary btn-block btn-getting"><i class="fa fa-edit"></i> EDIT</button></td>';
                            dinner_table_data += '</tr>';
                        }
                    });
                    $('#specificDateBreakfastMenu').html(breakfast_table_data).fadeIn('slow');
                    $('#specificDateLunchMenu').html(lunch_table_data).fadeIn('slow');
                    $('#specificDateDinnerMenu').html(dinner_table_data).fadeIn('slow');


                });
            }
            else {
                $('#specificDateBreakfastMenu').html("<h3 class='text-center text-danger'>No Data Available</h3>");
                $('#specificDateLunchMenu').html("<h3 class='text-center text-danger'>No Data Available</h3>");
                $('#specificDateDinnerMenu').html("<h3 class='text-center text-danger'>No Data Available</h3>");

            }
        },
        error: function (jdata) {
            console.log('An error occurred.');
            //console.log(data);
        }
    });
}