document.getElementById('mealStatusResult').style.display = 'none';
$(document).ready(function () {
    //dynamically selected checkbox value fetching
    $('.selectedMealTime').on('click', function () {
        /*
                    alert($(this).attr('id'));
        */
        if (this.checked) {
            if ($(this).attr('id') === 'Breakfast') {
                var breakfast = $(this).val();
                console.log(breakfast);
                setTodayMealStatus(breakfast);
            }
            else if ($(this).attr('id') === 'Lunch') {
                var lunch = $(this).val();
                console.log(lunch);
                setTodayMealStatus(lunch);
            }
            else if ($(this).attr('id') === 'Dinner') {
                var dinner = $(this).val();
                console.log(dinner);
                setTodayMealStatus(dinner);

            }
        }
        if (!$(this).is(":checked")) {
            if ($(this).attr('id') === 'Breakfast') {
                var removeBreakfast = $(this).val();
                var noOfMeal = $("#breakfastNumberOfMealResult").text();
                if (noOfMeal > 1) {

                    JSalert(removeBreakfast, noOfMeal);

                }//removeTodayMealStatus(removeBreakfast);
                else{
                    //swal(removeBreakfast,typeof(noOfMeal));
                    JSalert(removeBreakfast, noOfMeal);
                }
            }
            if ($(this).attr('id') === 'Lunch') {
                var removeLunch = $(this).val();
                var noOfMeal = $("#lunchNumberOfMealResult").text();
                //removeTodayMealStatus(removeLunch);
                // console.log($(this).val()+" Unchecked");
                if (noOfMeal > 1) {
                    JSalert(removeLunch, noOfMeal);
                }//removeTodayMealStatus(removeBreakfast);
                else if(noOfMeal==1){
                    JSalert(removeLunch, noOfMeal);
                }
                //alert($(this).val()+" "+noOfMeal+" Unchecked");
            }
            if ($(this).attr('id') === 'Dinner') {
                var removeDinner = $(this).val();
                var noOfMeal = $("#dinnerNumberOfMealResult").text();
                if (noOfMeal > 1) {
                    JSalert(removeDinner, noOfMeal);

                }//removeTodayMealStatus(removeBreakfast);
                else if(noOfMeal==1){
                    JSalert(removeDinner, noOfMeal);
                }
            }
        }

        function JSalert(sel_time, noOfMeal) {
            swal({
                title: "Are you sure?",
                text: "Your Entered No Of Meal Will be removed",
                icon: "warning",
                buttons: [true,'Yes'],
                dangerMode: true,
            }).then((willDelete) => {
                if(willDelete) {
                    removeTodayMealStatus(sel_time, noOfMeal);
                    swal("Poof! Your imaginary file has been deleted!", {
                        icon: "success",
                    });
                }
                else {
                    //swal("Your imaginary file is safe!");
                    $("#"+sel_time).prop('checked', true);
                    }
        });
        }

    });
    $("#saveMoreThanOneButton").on('click', function () {
        var selected_time = $("#selected_header_time").text();
        var noOfMeal = $("#noOfMeal").val();
        if (selected_time === "Breakfast") {
            var Breakfast = $("#Breakfast");
            if (Breakfast.is(":checked")) {
                swal({
                    title: "Already Selected!",
                    text: "Uncheck Breakfast Meal Status First to enter again",
                    icon: "warning"
                });
            }
            else if (!Breakfast.is(":checked")) {
                setTodayMoreThanOneMealStatus(selected_time, noOfMeal);
            }
        }
        if (selected_time === "Lunch") {
            var Lunch = $("#Lunch");
            if (Lunch.is(":checked")) {
                swal({
                    title: "Already Selected!",
                    text: "Uncheck Lunch Meal Status First to enter again",
                    icon: "warning"
                });
            }
            else if (!Lunch.is(":checked")) {
                setTodayMoreThanOneMealStatus(selected_time, noOfMeal);
            }
        }
        if (selected_time === "Dinner") {
            var Dinner = $("#Dinner");
            if (Dinner.is(":checked")) {
                swal({
                    title: "Already Selected!",
                    text: "Dinner Meal Status Is Already Selected",
                    icon: "warning"
                });
            }
            else if (!Dinner.is(":checked")) {
                setTodayMoreThanOneMealStatus(selected_time, noOfMeal);
            }
        }

        //setTodayMoreThanOneMealStatus(selected_time,noOfMeal);
    });

    $("#datepickerForUserMealConfirmation").datepicker
    ({
        dateFormat: 'dd/mm/yy', showAnim: 'slide', showButtonPanel: true
    });
    $('#saveSpecifiicSelectedMealConfirmation').on('click', function () {
        specificDateUserMealConfirmation();
    });

    function specificDateUserMealConfirmation() {
        $.ajax({
            type: 'POST',
            url: 'userMealEntry.php',
            data: $('#specificDateMealConfirmation').serialize(),
            success: function (data) {
                swal(data);
                $("#specificDateMealConfirmationResult").html(data).fadeIn('slow');

            }
        });
    }

    function setTodayMealStatus(selected_time) {
        $.ajax({
            type: 'POST',
            url: 'userMealEntry.php',
            data: {'selected_time': selected_time},
            success: function (data) {
                $("#mealStatusResult").html(data).fadeIn('slow').fadeOut(4000);
            }
        });
    }

    function setTodayMoreThanOneMealStatus(selected_time, noOfMeal) {
        $.ajax({
            type: 'POST',
            url: 'userMealEntry.php',
            data: {'selected_time': selected_time, 'noOfMeal': noOfMeal},
            success: function (data) {
                $("#mealStatusResult").html(data).fadeIn('slow').fadeOut(4000);
                $("#myModal").hide();
                if (selected_time === 'Breakfast') {
                    $("#Breakfast").prop('checked', true);
                    $("#breakfastNumberOfMealResult").text(noOfMeal);
                }
                else if (selected_time === 'Lunch') {
                    $("#Lunch").prop('checked', true);
                    $("#lunchNumberOfMealResult").text(noOfMeal);
                }
                else if (selected_time === 'Dinner') {
                    $("#Dinner").prop('checked', true);
                    $("#dinnerNumberOfMealResult").text(noOfMeal);
                }
            }
        });
    }

    function removeTodayMealStatus(selected_removal_time) {
        $.ajax({
            type: 'POST',
            url: 'userMealEntry.php',
            data: {'selected_removal_time': selected_removal_time},
            success: function (data) {
                $("#mealStatusResult").html(data).fadeIn('slow').fadeOut(4000);
                //removingAllCheckboxResult(selected_removal_time);
                /*if (data==='Successfully Removed'){

                }*/
            },
            error:function (xhr,request,status) {
                swal("Something went wrong"+xhr+" "+request+" "+status);
            }
        });
        //alert(selected_removal_time);
    }
    function removingAllCheckboxResult(selected_removal_time) {
        if (selected_removal_time === 'Breakfast') {
            $("#breakfastNumberOfMealResult").text('0');
        }
        else if (selected_removal_time === 'Lunch') {
            $("#lunchNumberOfMealResult").text('0');
        }
        else if (selected_removal_time === 'Dinner') {

            $("#dinnerNumberOfMealResult").text('0');
        }
    }

    $('.editBtn').on('click', function () {
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
    $(".cancelBtn").on('click', function () {
        $(this).closest("tr").find(".editInput").hide();
        $(this).closest("tr").find(".editSpan").show();
        $(this).closest("tr").find(".editBtn").show();
        $(this).closest("tr").find(".deleteBtn").show();
        $(this).closest("tr").find(".updateBtn").hide();
        $(this).closest("tr").find(".cancelBtn").hide();
    });

    $(".deleteBtn").on('click', function () {

        var trObj = $(this).closest("tr");
        var deleteId = $(this).closest("tr").attr('id');
        swal({
            title: "Are you sure?",
            text: "Your date selection will be removed",
            icon: "warning",
            buttons: [true, 'Yes'],
            dangerMode: true,
        }).then((willDelete) => {
            if(willDelete) {
                $.ajax({
                    type: 'POST',
                    url: 'userMealEntry.php',
                    data: 'deleteId=' + deleteId,
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
            }
        });
    });
    /*$('.updateBtn').on('click', function(e) {
        var el = $(e.currentTarget).closest(".row").find(".selected_time").val();
        alert(el);
    });*/
    $(".updateBtn").on('click', function () {
        var trObj = $(this).closest("tr");
        var ID = $(this).closest("tr").attr('id');
        var selected_time = $(this).closest(".col-lg-4").find("input.selected_time").val();
        var inputData = $(this).closest("tr").find(".editInput").serialize();
        var selectedDate=trObj.find(".editInput.selected_date").val();
        var noOfMeal=trObj.find(".editInput.total_meal").val();
        var spanNoMeal=trObj.find(".editSpan.total_meal").html();

        //swal(selectedDate+" Working Id :"+ID+" Time : "+selected_time+"; No Of Meal : "+noOfMeal);
        $.ajax({
            type:'POST',
            url:'userMealEntry.php',
            //dataType: "json",
            data:'action=updateDate&sel_id='+ID+'&'+inputData+'&sel_time='+selected_time+'&spanNoMeal='+spanNoMeal,
            success:function(response){
                //swal(response);
                if(response === '200'){
                    trObj.find(".editSpan.selected_date").html(selectedDate);
                    trObj.find(".editSpan.total_meal").html(noOfMeal);
                    //console.log(response);
                    //console.log(response);
                    //trObj.find(".editSpan.billAmount").html(currentBillAmount);

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