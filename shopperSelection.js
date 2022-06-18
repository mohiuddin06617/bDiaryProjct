$(document).ready(function () {
    /*$.get('memberShoppingDateList.php',function (data) {
        $('#showSelectionAnswer').html(data);
    });*/
    var array = ["21-06-2017", "25-06-2017", "16/06/2017"];

    /* $('#selectedDateForShopper').datepicker({
         beforeShowDay: function(date){
             var string = jQuery.datepicker.formatDate('dd-mm-yy', date);
             return [ array.indexOf(string) == -1 ]
         },showAnim: 'slide', showButtonPanel: true
     });*/
    $("#selectedDateForShopper").datepicker({
        dateFormat: 'dd/mm/yy',
        showAnim: 'slide',
        showButtonPanel: true,
        changeYear: true,
        changeMonth: true
    });


    $("#saveShopperBtn").on('click', function () {
        saveShopper();
    });
    $('#editShoppingDate').on('click', function () {
        var value = $('.selected-date').text();
        editShoppingDate();
    });
    $('.editBtn').on('click', function () {
        //hide edit span
        $(this).closest("tr").find(".editSpan").hide();

        //show edit input
        $(this).closest("tr").find(".editInput").show();

        $(this).closest("tr").find(".editBtn").hide();
        $(this).closest("tr").find(".deleteBtn").hide();
        $(this).closest("tr").find(".updateBtn").show();
        $(this).closest("tr").find(".cancelBtn").show();

        /* $(this).closest("tr").find(".editInput").focus();*/
        $($(this).closest("tr").find(".editInput")).datepicker({
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
        var deleteId = $(this).closest("tr").find(".editInput.selected_date").attr('id');
        swal({
            title: "Are you sure?",
            text: "Your date selection will be removed",
            icon: "warning",
            buttons: [true, 'Yes'],
            dangerMode: true,
        }).then((willDelete) => {
            if(willDelete) {
                //swal(deleteId);
                $.ajax({
                    type: 'POST',
                    url: 'shopperSelectionEntry.php',
                    data: 'deleteId=' + deleteId,
                    success: function (response) {
                        if (response === '200') {
                            $("#trId" + deleteId).fadeOut(300, function(){ $(this).remove();});
                        } else {
                            //swal(response);
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

    $(".updateBtn").on('click', function () {
        var trObj = $(this).closest("tr");
        var ID = $(this).closest("tr").find(".editInput.selected_date").attr('id');
        var inputData = $(this).closest("tr").find(".editInput").serialize();
        var selectedDate=trObj.find(".editInput.selected_date").val();
        //swal(selectedDate+" Working");
        $.ajax({
            type:'POST',
            url:'shopperSelectionEntry.php',
            //dataType: "json",
            data:'action=updateDate&sel_id='+ID+'&'+inputData,
            success:function(response){
                //swal(response);
                if(response === '200'){
                    //console.log(response);
                    //console.log(response);
                    trObj.find(".editSpan.selected_date").html(selectedDate);
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

function saveShopper() {
    var selectedDateForShopper = $('#selectedDateForShopper').val();
    var selectedShopper = $('#selectedShopper').val();
    $.ajax({
        type: 'POST',
        url: 'shopperSelectionEntry.php',
        data: {'selectedShopper': selectedShopper, 'selectedDateForShopper': selectedDateForShopper},
        success: function (data) {
            $("#showSelectionAnswer").html(data);
            $("#showSelectionAnswer").fadeIn().fadeOut(3300);
        },
        error: function (xhr) {
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
    console.log('Changed To: ' + val);
}

function editShoppingDate() {
    console.log('Clicked');
}