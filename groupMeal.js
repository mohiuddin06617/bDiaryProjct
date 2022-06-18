document.getElementById('specificDateMealDetailsDiv').style.display='none';
$(document).ready(function () {
    function specificDateBazarData(specificDate) {
        $.ajax({
            url: "groupMealFetch.php",
            type: "POST",
            dataType:'json',
            data:'action=specificDateFetch&specificDateMealDetails='+specificDate,
            success: function (data) {
                var fullTable='';
                fullTable+= '<table class="table table-bordered specficDetailsTable">' +
                    '<thead>' +
                    '<tr>' +
                        '<th colspan="4" class="text-center"><strong> Date : '+specificDate+'</strong>' +
                            '<span style="cursor: pointer" id="closeSpecificMealDiv" class="closeSpecificMealDiv"><i class="fa fa-close pull-right"></i></span>' +
                        '</th>' +
                    '</tr>' +
                    '<tr class="warning">' +
                    '<th><strong>Meal Time</strong></th>' +
                    '<th><strong>No Of Meal (BDT)</strong></th>' +
                    '</tr>' +
                    '</thead>\n' +
                    '<tbody>';
                if (!jQuery.isEmptyObject(data)) {
                    var mealData='';
                    for (var i=0;i<data.length;i++){
                        mealData+='<tr id="'+$(this).closest('.editSpan.selected_date').html()+'">' +
                            '<td>' +
                            '<span class="editSpan mealTime">'+data[i].mealtime+'</span>' +
                            '<input class="editInput item_name form-control black-text-color" type="text" name="item_name" value="'+data[i].item_name+'" style="display: none;border: 2px solid #4bb4ff;border-radius: 4px;box-sizing: border-box;">' +
                            '</td>' +
                            '<td>' +
                            '<span class="editSpan no_of_meal">'+data[i].no_of_meal+'</span>' +
                            '<input type="text" class="editInput item_price form-control black-text-color" name="item_price" value="'+data[i].item_price+'" style="display: none;border: 2px solid #4bb4ff;border-radius: 4px;box-sizing: border-box;">' +
                            '</td>' +
                            '</tr>';
                    }
                    fullTable+=mealData;
                    fullTable+='</tbody><tfoot><tr><td colspan="2"><button class="closeSpecificMealDiv btn btn-warning btn-lg">Close</button></td></tr></tfoot></table>';
                    $('#specificMealDateDataResult').html(fullTable).fadeIn('slow');
                }
                else {
                    $('#specificMealDateDataResult').html("<h3 class='text-center text-danger'>No Data Available</h3>");
                }
            },
            error: function (xhr) {
                console.log('An error occurred.'+xhr.parseError);
                alert('An error occurred.'+xhr.parseError);
                console.log(xhr.responseText);
            }
        });
    }

    function switchManagerUserProfile(value) {
        if (value === 'user') {
            window.location.replace('userHome.php');
        }
        else if (value === 'manager') {
            window.location.replace('managerHome.php');
        }
    }

    $('#refreshBazarReportStatus').on('click', function () {
        console.log('Refreshed');
    });

    $('#specificMealDatePicker').datepicker({
        dateFormat: 'dd/mm/yy',
        showAnim: 'slide',
        showButtonPanel: true,
        changeYear: true,
        changeMonth: true,
        yearRange: '1950:2100'

    });
    $("#mealDataFetchButton").on('click', function () {
        var specificData = $('#specificMealDatePicker').val();
        if(specificData.length>0){
            specificDateBazarData(specificData);
        }
        else {
            $("#specificMealDateDataResult").html('<h3 class="text-center text-danger">Please Select a Date</h3>');
        }
    });

    $(".showSpecificMealDetails").on('click',function () {
        var specificDate=this.id;


        //$("#selectedSpecificDate").html(specificDate);
        $("#allMealList").slideUp('slow',function(){
            $(this).fadeOut('slow');
        });
        $("#specificDateMealDetailsDiv").slideDown('slow',function(){
            $(this).fadeIn('slow');
        });
        fetchSpecificDateData(specificDate);
    });

    $("#closeSpecificDateMealDetailsDiv").on("click",function () {
        closingDiv();
    });
    $("#backToAllMealList").on("click",function () {
        closingDiv();
    });
    function fetchSpecificDateData(specificDate) {
        $.ajax({
            url: "groupMealFetch.php",
            type: "POST",
            dataType:'json',
            data:'action=specificDateMealDetails&showSpecificDateMealDetails='+specificDate,
            success: function(data){
                var fullTable='';
                fullTable+= '<table class="table table-bordered specficDetailsTable">' +
                    '<thead>' +
                    '<tr><th colspan="4" class="text-center"><strong>Date : '+$(this).closest('.editInput').val()+'</strong></th></tr>' +
                    '<tr class="warning">' +
                    '<th><strong>Meal Time</strong></th>' +
                    '<th><strong>No Of Meal (BDT)</strong></th>' +
                    '</tr>' +
                    '</thead>\n' +
                    '<tbody>';
                if (!jQuery.isEmptyObject(data)) {

                    var mealData='';
                    for (var i=0;i<data.length;i++){
                        mealData+='<tr id="'+specificDate+'">' +
                                        '<td>' +
                                            '<span class="editSpan mealTime">'+data[i].mealtime+'</span>' +
                                            '<input class="editInput item_name form-control black-text-color" type="text" name="item_name" value="'+data[i].item_name+'" style="display: none;border: 2px solid #4bb4ff;border-radius: 4px;box-sizing: border-box;">' +
                                        '</td>' +
                                        '<td>' +
                                            '<span class="editSpan no_of_meal">'+data[i].no_of_meal+'</span>' +
                                            '<input type="text" class="editInput item_price form-control black-text-color" name="item_price" value="'+data[i].item_price+'" style="display: none;border: 2px solid #4bb4ff;border-radius: 4px;box-sizing: border-box;">' +
                                        '</td>' +
                                    '</tr>';
                    }
                    fullTable+=mealData;
                    fullTable+='</tbody></table>';
                    $('#specificDateMealResult').html(fullTable).fadeIn('slow');
                }
                else {
                    $('#specificDateMealResult').html("<h3 class='text-center text-danger'>No Data Available</h3>");
                }
            },
            error: function (request, status, error) {
                alert(request.responseText);
            }
        });


    }
    function closingDiv() {
        //$('#newBillCreation')[0].reset();
        $("#specificDateMealDetailsDiv").slideUp('slow',function () {
            $(this).fadeOut('slow');
        });
        $("#allMealList").slideDown('slow',function () {
            $(this).fadeIn("slow");
        });
    }

    $('#specificMealDateDataResult').on("click", '.closeSpecificMealDiv', function(event) {
        $("#specificMealDateDataResult").fadeOut('slow');
    });
    var specificDateMealDetailsDiv=$("#specificDateMealDetailsDiv");

    specificDateMealDetailsDiv.on("click", '.deleteBtn', function(event) {

        var trObj = $(this).closest("tr");
        var deleteId = $(this).closest("tr").attr('id');
        swal({
            title: "Are you sure?",
            text: "Your Shopping Data will be deleted",
            icon: "warning",
            buttons: [true, 'Yes'],
            dangerMode: true,
        }).then((willDelete) => {
            if(willDelete) {
                $.ajax({
                    type: 'POST',
                    url: 'managerShoppingCostEntryry.php',
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
            }
        });
    });

    specificDateMealDetailsDiv.on('click','.updateBtn', function () {
        var trObj = $(this).closest("tr");
        var ID = $(this).closest("tr").attr('id');
        /* var item_name = $(this).closest(".col-lg-4").find("input.selected_time").val();*/
        var inputData = $(this).closest("tr").find(".editInput").serialize();
        var item_name=trObj.find(".editInput.item_name").val();
        var item_price=trObj.find(".editInput.item_price").val();
        var quantity=trObj.find(".editInput.quantity").val();

        //swal(" Working Id :"+ID+" item_name : "+item_name+"; item_price : "+item_price+" quantity :" +quantity);
        $.ajax({
            type:'POST',
            url:'managerShoppingCostEntry.phphp',
            //dataType: "json",
            data:'action=updateShoppingData&sel_id='+ID+'&'+inputData,
            success:function(response){
                //swal(response);
                if(response === '200'){
                    trObj.find(".editSpan.item_name").html(item_name);
                    trObj.find(".editSpan.item_price").html(item_price);
                    trObj.find(".editSpan.quantity").html(quantity);
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
    specificDateMealDetailsDiv.on('click','.editBtn',function () {
        //swal("Edit Button Working!");

        $(this).closest("tr").find(".editSpan").hide();

        //show edit input
        $(this).closest("tr").find(".editInput").show();

        $(this).closest("tr").find(".editBtn").hide();
        $(this).closest("tr").find(".deleteBtn").hide();
        $(this).closest("tr").find(".updateBtn").show();
        $(this).closest("tr").find(".cancelBtn").show();
    });
    /*$(".editBtn").on('click',function () {

    });*/
    specificDateMealDetailsDiv.on('click', '.cancelBtn', function () {
        $(this).closest("tr").find(".editInput").hide();
        $(this).closest("tr").find(".editSpan").show();
        $(this).closest("tr").find(".editBtn").show();
        $(this).closest("tr").find(".deleteBtn").show();
        $(this).closest("tr").find(".updateBtn").hide();
        $(this).closest("tr").find(".cancelBtn").hide();
    });

    $('.deleteSpecificBazarDetails').on('click',function () {
        var specificDate=this.id;
        var deleteId = $(this).closest("tr").attr('id');
        swal({
            title: "Are you sure?",
            text: "All Shopping Data of "+specificDate+" will be deleted",
            icon: "warning",
            buttons: [true, 'Yes'],
            dangerMode: true,
        }).then((willDelete) => {
            if(willDelete) {
                $.ajax({
                    type: 'POST',
                    url: 'managerShoppingCostEntryry.php',
                    data: 'action=deleteAllSameDateData&specificSameDateAll=' + specificDate,
                    success: function (response) {
                        if (response == '200') {
                            $("#" + specificDate).fadeOut(300, function(){ $(this).remove();});
                            //$(this).closest('tr').fadeOut(300, function(){ $(this).remove();});
                        } else {
                            swal(response);
                            //trObj.find("#"+deleteId).remove();
                        }
                    },
                    error: function (response, status) {
                        swal(response.responseText + " " + status);
                    }
                });
                //$(this).closest('tr').fadeOut(300, function(){ $(this).remove();});
                //swal(specificDate +" "+ deleteId);
            }
        });
    });
});
