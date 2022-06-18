document.getElementById('specificDateBazarDetailsDiv').style.display='none';
$(document).ready(function ($) {

    $('.my-form .add-box').click(function () {
        var n = $('.text-box').length + 1;
        /*   var m = $('.text-box').length + 1;
           var p = $('.text-box').length + 1;*/
        if (5 < n) {
            alert('Stop it!');
            return false;
        }
        var box_html = $(
            '<div class="text-box">' +
                '<div class="row"> ' +
                    '<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">' +
                        '<div class="form-group">' +
                            '<label for="item' + n + '">Item <span class="box-number">' + n + '</span> Name :</label> ' +
                            '<input type="text" class="form-control input-lg input-without-label item_name" name="items[]" id="item' + n + ' : " placeholder="Enter Item Name Here"/>' +
                        '</div>' +
                    '</div>' +
                    '<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">' +
                        '<div class="form-group">' +
                            '<label for="quantity'+ n +'">Quantity <span class="box-number control-label">'+ n +'</span></label>'+
                            '<input type="text" class="form-control input-lg input-without-label quantity" name="quantities[]" value="" id="quantity'+ n +' : " placeholder="(Quality)Enter Quantity Here"/>' +
                        '</div>' +
                    '</div>'+
                    '<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">' +
                        '<div class="form-group"> ' +
                            '<label for="price'+ n +'">Price <span class="box-number">' + n + '</span></label>' +
                            '<input type="number" class="form-control input-without-label input-lg item_price" min="1" name="prices[]" value="" id="price' + n + '" placeholder="Enter Price here"/>' +
                        '</div>' +
                    '</div>' +
                    '<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">' +
                        '<div class="form-group">' +
                            '<label class="control-label"> </label>' +
                            '<button type="button" id="remove-box" class="remove-box btn btn-deeporange btn-getting btn-lg btn-block">Remove</button><hr>' +
                        '</div>' +
                    '</div>' +
                '</div>' +
            '</div>');
        // box_html.hide();
        $('.my-form div.text-box:last').after(box_html);
        box_html.fadeIn('slow');
        return false;
    });
    $('.my-form').on('click', '.remove-box', function (e) {
        e.preventDefault();
        $(this).closest('.text-box').css('background-color', '#FF6C6C');
        $(this).closest('.text-box').fadeOut("slow", function () {
            $(this).closest('.text-box').remove();
            $('.box-number').each(function (index) {
                $(this).text(index + 2);
            });
        });
        return false;
    });
});

$(document).ready(function () {
    var datepickerforuserdailycost=$("#datepickerforuserdailycost");
    datepickerforuserdailycost.datepicker({dateFormat: 'dd/mm/yy', showAnim:'slide',showButtonPanel: true});
    $('#bazarDateList').datepicker({ dateFormat: 'dd/mm/yy', showAnim:'slide'});

    datepickerforuserdailycost.on('blur',function () {
        if (datepickerforuserdailycost.val()){
            $("#dateError").html("Date Can not be empty");
        }
    });
    $('#send_to_manager').on('click',function () {
        var closestTextBox=$(this).closest('.text-box');

        sendingData();
    });
    $('#specificBazarDateDataWithCost').on('click',function () {
        bazarDateList = $('#bazarDateList').val();
        if (bazarDateList){
            specificDateBazarData(bazarDateList);
        }
        else {
            $("#bazarDateListResult").html("<h3 class='text-danger text-center'> Please Select a Date First </h3>");
        }
    });

    $(".showSpecificBazarDetails").on('click',function () {
        var specificDate=this.id;
        //var td = this.specificShpopperName;
        //var shopperName=$(this).parents("tr").find(".specificShpopperName").html()

        $("#selectedSpecificDate").html(specificDate);
        $("#allBazarList").slideUp('slow',function(){
            $(this).fadeOut('slow');
        });
        $("#specificDateBazarDetailsDiv").slideDown('slow',function(){
            $(this).fadeIn('slow');
        });
        fetchSpecificDateData(specificDate);
    });
    $("#closeSpecificDateBazarDetailsDiv").on("click",function () {
        closingDiv();
    });
    $("#backToBazarList").on("click",function () {
        closingDiv();
    });

    $(".editSpecificBazarDetails").on('click',function () {
        swal("Editing");
    });
    function closingDiv() {
        //$('#newBillCreation')[0].reset();
        $("#specificDateBazarDetailsDiv").slideUp('slow',function () {
            $(this).fadeOut('slow');
        });
        $("#allBazarList").slideDown('slow',function () {
            $(this).fadeIn("slow");
        });
    }


    function sendingData() {
        $.ajax({
            method: "POST",
            url: "userShoppingCostEntry.php",
            data: $('#add_shopping_list').serialize(),
            success: function (data) {
                $('#shopping_reply').html(data).fadeIn().fadeOut(5000);
                $('#add_shopping_list')[0].reset();
            }

        });
    }
    function specificDateBazarData(bazarDateList) {
        $.ajax({
            method: "POST",
            url: "userSpecificDateBazarData.php",
            data: {bazarDateList: bazarDateList},
            success: function (data) {
                $('#bazarDateListResult').html(data).fadeIn();
            }

        });

    }

    function fetchSpecificDateData(specificDate) {
        $.ajax({
            url: "userShoppingCostFetch.php",
            type: "POST",
            dataType:'json',
            data:'showSpecificDateBazarDetails='+specificDate,
            success: function(data){
                /*console.log(data);*/
                var fullTable='';
                fullTable+= '<table class="table table-bordered">' +
                    '<thead>' +
                    '<tr class="warning">' +
                    '<th><strong>Item Name</strong></th>' +
                    '<th><strong>Item Price (BDT)</strong></th>' +
                    '<th><strong>Quantity</strong></th>\n' +
                    '<th><strong>Action</strong></th>\n' +
                    '</tr>' +
                    '</thead>\n' +
                    '<tbody>';
                if (!jQuery.isEmptyObject(data)) {

                    var bazarData='';
                    var item_price='';
                    var quantity='';
                    for (var i=0;i<data.length;i++){
                        bazarData+='<tr id="'+data[i].dailyCostTableId+'">' +
                                        '<td>' +
                                            '<span class="editSpan item_name">'+data[i].item_name+'</span>' +
                                            '<input class="editInput item_name form-control black-text-color" type="text" name="item_name" value="'+data[i].item_name+'" style="display: none;border: 2px solid #4bb4ff;border-radius: 4px;box-sizing: border-box;">' +
                                        '</td>' +
                                        '<td>' +
                                            '<span class="editSpan item_price">'+data[i].item_price+'</span>' +
                                            '<input type="text" class="editInput item_price form-control black-text-color" name="item_price" value="'+data[i].item_price+'" style="display: none;border: 2px solid #4bb4ff;border-radius: 4px;box-sizing: border-box;">' +
                                        '</td>' +
                                        '<td>' +
                                            '<span class="editSpan quantity">'+data[i].quantity+'</span>' +
                                            '<input type="text" class="editInput quantity form-control black-text-color" name="quantity" value="'+data[i].quantity+'" style="display: none;border: 2px solid #4bb4ff;border-radius: 4px;box-sizing: border-box;">' +
                                        '</td>' +
                                        '<td>' +
                                            '<a type="buttton" class="btn btn-primary btn-getting btn-lg white-text-color editBtn">' +
                                                '<i class="fa fa-edit"></i> Edit</a>' +
                                            '<a type="buttton" class="btn btn-link btn-danger btn-lg btn-getting white-text-color deleteBtn">' +
                                                '<i class="fa fa-trash"></i> Delete</a>' +
                                            '<a type="buttton" class="btn btn-link btn-warning btn-lg btn-getting updateBtn" style="display: none;">' +
                                                '<i class="fa fa-refresh"></i> Update</a>' +
                                            '<a type="buttton" class="btn btn-link btn-danger btn-lg btn-getting cancelBtn" style="display: none;">' +
                                                '<i class="fa fa-times"></i> Cancel</a>' +
                                        '</td>' +
                                    '</tr>';
                    }
                    fullTable+=bazarData;
                    fullTable+='</tbody></table>';
                    $('#specificDateBazarResult').html(fullTable).fadeIn('slow');
                }
                else {
                    $('#specificDateBazarResult').html("<h3 class='text-center text-danger'>No Data Available</h3>");
                }
            },
            error: function (request, status, error) {
                alert(request.responseText);
            }
        });
    }

    var specificDateBazarDetailsDiv=$(".row");

    specificDateBazarDetailsDiv.on("click", '.deleteBtn', function(event) {

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
                    url: 'managerShoppingCostEntry.php',
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

    specificDateBazarDetailsDiv.on('click','.updateBtn', function () {
        var trObj = $(this).closest("tr");
        var ID = $(this).closest("tr").attr('id');
        /* var item_name = $(this).closest(".col-lg-4").find("input.selected_time").val();*/
        var inputData = $(this).closest("tr").find(".editInput").serialize();
        var item_name=trObj.find(".editInput.item_name").val();
        var item_price=trObj.find(".editInput.item_price").val();
        var quantity=trObj.find(".editInput.quantity").val();
        $.ajax({
            type:'POST',
            url:'managerShoppingCostEntry.php',
            //dataType: "json",
            data:'action=updateShoppingData&sel_id='+ID+'&'+inputData,
            success:function(response){
                if(response === '200'){
                    trObj.find(".editSpan.item_name").html(item_name);
                    trObj.find(".editSpan.item_price").html(item_price);
                    trObj.find(".editSpan.quantity").html(quantity);
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
    specificDateBazarDetailsDiv.on('click','.editBtn',function () {

        $(this).closest("tr").find(".editSpan").hide();
        $(this).closest("tr").find(".editInput").show();
        $(this).closest("tr").find(".editBtn").hide();
        $(this).closest("tr").find(".deleteBtn").hide();
        $(this).closest("tr").find(".updateBtn").show();
        $(this).closest("tr").find(".cancelBtn").show();
    });

    specificDateBazarDetailsDiv.on('click', '.cancelBtn', function () {
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
                    url: 'userShoppingCostEntry.php',
                    data: 'action=deleteAllSameDateData&+specificSameDateAll=' + specificDate,
                    success: function (response) {
                        if (response == '200') {
                            $("#" + specificDate).fadeOut(300, function(){ $(this).remove();});
                        } else {
                            swal(response);
                        }
                    },
                    error: function (response, status) {
                        swal(response.responseText + " " + status);
                    }
                });
                //$(this).closest('tr').fadeOut(300, function(){ $(this).remove();});
                 swal(specificDate);
            }
        });
    });



});

