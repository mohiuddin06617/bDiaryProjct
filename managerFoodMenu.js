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
        if(specifiedDate.length>0){
            $("#specificDateFoodMenu").fadeIn("slow");
            specificDateFoodMenu(specifiedDate);
        }
        else {
            $('#specificDateFoodMenu').html("<h3 class='text-center text-danger'>Please Select A Date</h3>");
            /*$('#specificDateLunchMenu').html("<h3 class='text-center text-danger'>Please Select A Date</h3>");
            $('#specificDateDinnerMenu').html("<h3 class='text-center text-danger'>Please Select A Date</h3>");*/
        }

    });
    var foodMenuShowPanel=$('.row');
    foodMenuShowPanel.on('click','.editBtn', function () {
        $(this).closest("tr").find(".editSpan").hide();
        $(this).closest("tr").find(".editInput").show();
        $(this).closest("tr").find(".editBtn").hide();
        $(this).closest("tr").find(".deleteBtn").hide();
        $(this).closest("tr").find(".updateBtn").show();
        $(this).closest("tr").find(".cancelBtn").show();

        /* $(this).closest("tr").find(".editInput").focus();*/
        $($(this).closest("tr").find(".editInput.selected_date")).datepicker({
            dateFormat: 'dd/mm/yy',
            showAnim: 'slide',
            showButtonPanel: true,
            changeYear: true,
            changeMonth: true
        });

    });
    foodMenuShowPanel.on('click',".cancelBtn",function () {
        $(this).closest("tr").find(".editInput").hide();
        $(this).closest("tr").find(".editSpan").show();
        $(this).closest("tr").find(".editBtn").show();
        $(this).closest("tr").find(".deleteBtn").show();
        $(this).closest("tr").find(".updateBtn").hide();
        $(this).closest("tr").find(".cancelBtn").hide();
    });

    foodMenuShowPanel.on('click',".deleteBtn", function () {

        var trObj = $(this).closest("tr");
        var deleteId = $(this).closest("tr").attr('id');
        swal({
            title: "Are you sure?",
            text: "Food Menu Will be removed",
            icon: "warning",
            buttons: [true, 'Yes'],
            dangerMode: true,
        }).then((willDelete) => {
            if(willDelete) {
                $.ajax({
                    type: 'POST',
                    url: 'managerFoodMenuEntry.php',
                    data: 'action=deleteData&deleteId=' + deleteId,
                    success: function (response) {
                        if (response == '200') {
                            $("#" + deleteId).fadeOut(300, function(){ $(this).remove();});
                        } else {
                            swal(response);
                            //trObj.find("#"+deleteId).remove();
                        }
                    },
                    error: function (response, status) {
                        swal(response.responseText + " " + status);
                    }
                });
                $("#" + deleteId).fadeOut(300, function(){ $(this).remove();});
            }
        });
    });
    /*$('.updateBtn').on('click', function(e) {
        var el = $(e.currentTarget).closest(".row").find(".selected_time").val();
        alert(el);
    });*/
    foodMenuShowPanel.on('click',".updateBtn", function () {
        var trObj = $(this).closest("tr");
        var ID = $(this).closest("tr").attr('id');
        //var selected_time = $(this).closest(".col-lg-4").find("input.selected_time").val();
        var inputData = $(this).closest("tr").find(".editInput").serialize();
        var selectedDate=trObj.find(".editInput.selected_date").val();
        var item_name=trObj.find(".editInput.item_name").val();
        //var oldSelectedDate=trObj.find(".editSpan.selected_date").html();

        //swal(" Working Id :"+ID+" item_name : "+item_name+"; No Of Meal : "+selectedDate+"Input Data"+inputData);
        $.ajax({
            type:'POST',
            url:'managerFoodMenuEntry.php',
            //dataType: "json",
            data:'action=updateData&sel_id='+ID+'&'+inputData+'&sel_date='+selectedDate+'&item_name='+item_name,
            success:function(response){
                //swal(response);
                if(response === '200'){
                    trObj.find(".editSpan.selected_date").html(selectedDate);
                    trObj.find(".editSpan.item_name").html(item_name);
                    trObj.find(".editInput").hide();
                    trObj.find(".updateBtn").hide();
                    trObj.find(".cancelBtn").hide();
                    trObj.find(".editSpan").show();
                    trObj.find(".deleteBtn").show();
                    trObj.find(".editBtn").show();

                }else{
                    swal(response);
                }
            },
            error:function (response,status) {
                swal(response.responseText+" "+status);
                //console.log(response)
            }
        });
    });
});

function saveDailyFoodMenuSelection() {
    $.ajax({
        method: "POST",
        url: "managerFoodMenuEntry.php",
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
        url: "managerFoodMenuFetch.php",
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
                            breakfast_table_data += '<tr id="'+item.foodMenuId+'">';
                            breakfast_table_data += '<td>' +
                                                        '<span class="editSpan item_name"><b>' + item.item_name + '</b></span>' +
                                                        '<input class="editInput item_name form-control black-text-color" type="text" name="item_name" ' +
                                                            'value="'+item.item_name+'" style="display: none; border: 2px solid #4bb4ff;border-radius: 4px;box-sizing: border-box;">' +
                                                    '</td>';
                            breakfast_table_data += '<td>' +
                                                        '<span class="editSpan selected_date"><b>'+item.inserted_date+'</b></span>' +
                                                        '<input class="editInput selected_date form-control black-text-color" type="text" name="selected_date"' +
                                                            'value="'+item.inserted_date+'" style="display: none; border: 2px solid #4bb4ff;border-radius: 4px;box-sizing: border-box;">' +
                                                    '</td>';
                            breakfast_table_data += '<td>' +
                                                        '<a type="buttton" class="btn btn-primary btn-getting white-text-color editBtn">' +
                                                        '<i class="fa fa-edit"></i> Change</a>' +
                                                        '<a type="buttton" class="btn btn-link btn-danger btn-getting white-text-color deleteBtn">' +
                                                        '<i class="fa fa-trash"></i> Delete</a>' +
                                                        '<a type="buttton" class="btn btn-link btn-warning btn-getting updateBtn" style="display: none;">' +
                                                        '<i class="fa fa-refresh"></i> Update</a>' +
                                                        '<a type="buttton" class="btn btn-link btn-danger btn-getting cancelBtn" style="display: none;">' +
                                                        '<i class="fa fa-times"></i> Cancel</a>' +
                                                    '</td>';
                            breakfast_table_data += '</tr>';
                        }
                        else if (item.inserted_time === 'Lunch') {
                            lunch_table_data += '<tr id="'+item.foodMenuId+'">';
                            lunch_table_data += '<td>' +
                                '<span class="editSpan item_name"><b>' + item.item_name + '</b></span>' +
                                '<input class="editInput item_name form-control black-text-color" type="text" name="item_name" ' +
                                'value="'+item.item_name+'" style="display: none; border: 2px solid #4bb4ff;border-radius: 4px;box-sizing: border-box;">' +
                                '</td>';
                            lunch_table_data += '<td>' +
                                '<span class="editSpan selected_date"><b>'+item.inserted_date+'</b></span>' +
                                '<input class="editInput selected_date form-control black-text-color" type="text" name="selected_date"' +
                                'value="'+item.inserted_date+'" style="display: none; border: 2px solid #4bb4ff;border-radius: 4px;box-sizing: border-box;">' +
                                '</td>';
                            lunch_table_data += '<td>' +
                                '<a type="buttton" class="btn btn-primary btn-getting white-text-color editBtn">' +
                                '<i class="fa fa-edit"></i> Change</a>' +
                                '<a type="buttton" class="btn btn-link btn-danger btn-getting white-text-color deleteBtn">' +
                                '<i class="fa fa-trash"></i> Delete</a>' +
                                '<a type="buttton" class="btn btn-link btn-warning btn-getting updateBtn" style="display: none;">' +
                                '<i class="fa fa-refresh"></i> Update</a>' +
                                '<a type="buttton" class="btn btn-link btn-danger btn-getting cancelBtn" style="display: none;">' +
                                '<i class="fa fa-times"></i> Cancel</a>' +
                                '</td>';
                            lunch_table_data += '</tr>';

                        }
                        else if (item.inserted_time === 'Dinner') {
                            dinner_table_data += '<tr id="'+item.foodMenuId+'">';
                            dinner_table_data += '<td>' +
                                '<span class="editSpan item_name"><b>' + item.item_name + '</b></span>' +
                                '<input class="editInput item_name form-control black-text-color" type="text" name="item_name" ' +
                                'value="'+item.item_name+'" style="display: none; border: 2px solid #4bb4ff;border-radius: 4px;box-sizing: border-box;">' +
                                '</td>';
                            dinner_table_data += '<td>' +
                                '<span class="editSpan selected_date"><b>'+item.inserted_date+'</b></span>' +
                                '<input class="editInput selected_date form-control black-text-color" type="text" name="selected_date"' +
                                'value="'+item.inserted_date+'" style="display: none; border: 2px solid #4bb4ff;border-radius: 4px;box-sizing: border-box;">' +
                                '</td>';
                            dinner_table_data += '<td>' +
                                '<a type="buttton" class="btn btn-primary btn-getting white-text-color editBtn">' +
                                '<i class="fa fa-edit"></i> Change</a>' +
                                '<a type="buttton" class="btn btn-link btn-danger btn-getting white-text-color deleteBtn">' +
                                '<i class="fa fa-trash"></i> Delete</a>' +
                                '<a type="buttton" class="btn btn-link btn-warning btn-getting updateBtn" style="display: none;">' +
                                '<i class="fa fa-refresh"></i> Update</a>' +
                                '<a type="buttton" class="btn btn-link btn-danger btn-getting cancelBtn" style="display: none;">' +
                                '<i class="fa fa-times"></i> Cancel</a>' +
                                '</td>';
                            /*dinner_table_data += '<tr>';
                            dinner_table_data += '<td><b>' + item.item_name + '</b></td>';
                            dinner_table_data += '<td><b>'+item.inserted_date+'</b></td>';
                            dinner_table_data += '<td><button class="btn btn-success btn-block"><i class="fa fa-edit"></i> EDIT</button></td>';
                            dinner_table_data += '</tr>';*/
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
        url: "managerFoodMenuFetch.php",
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
                            breakfast_table_data += '<tr id="'+item.foodMenuId+'">';
                            breakfast_table_data += '<td>' +
                                '<span class="editSpan item_name"><b>' + item.item_name + '</b></span>' +
                                '<input class="editInput item_name form-control black-text-color" type="text" name="item_name" ' +
                                'value="'+item.item_name+'" style="display: none; border: 2px solid #4bb4ff;border-radius: 4px;box-sizing: border-box;">' +
                                '</td>';
                            breakfast_table_data += '<td>' +
                                '<span class="editSpan selected_date"><b>'+item.inserted_date+'</b></span>' +
                                '<input class="editInput selected_date form-control black-text-color" type="text" name="selected_date"' +
                                'value="'+item.inserted_date+'" style="display: none; border: 2px solid #4bb4ff;border-radius: 4px;box-sizing: border-box;">' +
                                '</td>';
                            breakfast_table_data += '<td>' +
                                '<a type="buttton" class="btn btn-primary btn-getting white-text-color editBtn">' +
                                '<i class="fa fa-edit"></i> Change</a>' +
                                '<a type="buttton" class="btn btn-link btn-danger btn-getting white-text-color deleteBtn">' +
                                '<i class="fa fa-trash"></i> Delete</a>' +
                                '<a type="buttton" class="btn btn-link btn-warning btn-getting updateBtn" style="display: none;">' +
                                '<i class="fa fa-refresh"></i> Update</a>' +
                                '<a type="buttton" class="btn btn-link btn-danger btn-getting cancelBtn" style="display: none;">' +
                                '<i class="fa fa-times"></i> Cancel</a>' +
                                '</td>';
                            breakfast_table_data += '</tr>';
                        }
                        else if (item.inserted_time === 'Lunch') {
                            lunch_table_data += '<tr id="'+item.foodMenuId+'">';
                            lunch_table_data += '<td>' +
                                '<span class="editSpan item_name"><b>' + item.item_name + '</b></span>' +
                                '<input class="editInput item_name form-control black-text-color" type="text" name="item_name" ' +
                                'value="'+item.item_name+'" style="display: none; border: 2px solid #4bb4ff;border-radius: 4px;box-sizing: border-box;">' +
                                '</td>';
                            lunch_table_data += '<td>' +
                                '<span class="editSpan selected_date"><b>'+item.inserted_date+'</b></span>' +
                                '<input class="editInput selected_date form-control black-text-color" type="text" name="selected_date"' +
                                'value="'+item.inserted_date+'" style="display: none; border: 2px solid #4bb4ff;border-radius: 4px;box-sizing: border-box;">' +
                                '</td>';
                            lunch_table_data += '<td>' +
                                '<a type="buttton" class="btn btn-primary btn-getting white-text-color editBtn">' +
                                '<i class="fa fa-edit"></i> Change</a>' +
                                '<a type="buttton" class="btn btn-link btn-danger btn-getting white-text-color deleteBtn">' +
                                '<i class="fa fa-trash"></i> Delete</a>' +
                                '<a type="buttton" class="btn btn-link btn-warning btn-getting updateBtn" style="display: none;">' +
                                '<i class="fa fa-refresh"></i> Update</a>' +
                                '<a type="buttton" class="btn btn-link btn-danger btn-getting cancelBtn" style="display: none;">' +
                                '<i class="fa fa-times"></i> Cancel</a>' +
                                '</td>';
                        }
                        else if (item.inserted_time === 'Dinner') {
                            dinner_table_data += '<tr id="'+item.foodMenuId+'">';
                            dinner_table_data += '<td>' +
                                '<span class="editSpan item_name"><b>' + item.item_name + '</b></span>' +
                                '<input class="editInput item_name form-control black-text-color" type="text" name="item_name" ' +
                                'value="'+item.item_name+'" style="display: none; border: 2px solid #4bb4ff;border-radius: 4px;box-sizing: border-box;">' +
                                '</td>';
                            dinner_table_data += '<td>' +
                                '<span class="editSpan selected_date"><b>'+item.inserted_date+'</b></span>' +
                                '<input class="editInput selected_date form-control black-text-color" type="text" name="selected_date"' +
                                'value="'+item.inserted_date+'" style="display: none; border: 2px solid #4bb4ff;border-radius: 4px;box-sizing: border-box;">' +
                                '</td>';
                            dinner_table_data += '<td>' +
                                '<a type="buttton" class="btn btn-primary btn-getting white-text-color editBtn">' +
                                '<i class="fa fa-edit"></i> Change</a>' +
                                '<a type="buttton" class="btn btn-link btn-danger btn-getting white-text-color deleteBtn">' +
                                '<i class="fa fa-trash"></i> Delete</a>' +
                                '<a type="buttton" class="btn btn-link btn-warning btn-getting updateBtn" style="display: none;">' +
                                '<i class="fa fa-refresh"></i> Update</a>' +
                                '<a type="buttton" class="btn btn-link btn-danger btn-getting cancelBtn" style="display: none;">' +
                                '<i class="fa fa-times"></i> Cancel</a>' +
                                '</td>';
                            /*dinner_table_data += '<tr>';
                            dinner_table_data += '<td><b>' + item.item_name + '</b></td>';
                            dinner_table_data += '<td><button class="btn btn-primary btn-block btn-getting"><i class="fa fa-edit"></i> EDIT</button></td>';
                            dinner_table_data += '</tr>';*/
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
            console.log(jdata);
            console.log('An error occurred.');
        }
    });
}