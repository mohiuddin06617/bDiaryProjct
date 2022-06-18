document.getElementById('specificDateBazarDetailsDiv').style.display='none';
$(document).ready(function () {
    function specificDateBazarData(specificDate) {
        $.ajax({
            method: "POST",
            url: "managerShoppingCostFetch.php",
            dataType: 'json',
            data: {specificDate: specificDate},
            success: function (data) {
                var fullTable='';
                fullTable+= '<table class="table table-bordered detailsTable">' +
                    '<thead>' +
                    '<tr class="warning">' +
                    '<th><strong>Item Name</strong></th>' +
                    '<th><strong>Item Price (BDT)</strong></th>' +
                    '<th><strong>Quantity</strong></th>\n' +
                    '<th><strong>Action</strong></th>\n' +
                    '</tr>\n' +
                    '</thead>\n' +
                    '<tbody>';
                if (!jQuery.isEmptyObject(data)) {

                    var bazarData='';
                    var item_price='';
                    var quantity='';
                    /*console.log(data);*/
                    for (var i=0;i<data.length;i++){
                        bazarData+='<tr>' +
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
                                            '<a type="buttton" class="btn btn-primary btn-getting white-text-color editBtn">' +
                                                '<i class="fa fa-edit"></i> Edit</a>' +
                                            '<a type="buttton" class="btn btn-link btn-danger btn-getting white-text-color deleteBtn">' +
                                                '<i class="fa fa-trash"></i> Delete</a>' +
                                            '<a type="buttton" class="btn btn-link btn-warning btn-getting updateBtn" style="display: none;">' +
                                                '<i class="fa fa-refresh"></i> Update</a>' +
                                            '<a type="buttton" class="btn btn-link btn-danger btn-getting cancelBtn" style="display: none;">' +
                                                '<i class="fa fa-times"></i> Cancel</a>' +
                                        '</td>' +
                                    '</tr>';
                    }
                    fullTable+=bazarData;
                    fullTable+='</tbody></table>';
                    $('#specificBazarDateData').html(fullTable).fadeIn('slow');
                }
                else {
                    $('#specificBazarDateData').html("<h3 class='text-center text-danger'>No Data Available</h3>");
                }
            },
            error: function (xhr) {
                console.log('An error occurred.'+xhr.parseError);
                alert('An error occurred.'+xhr.parseError);
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

    $('#specificBazarDatePicker').datepicker({
        dateFormat: 'dd/mm/yy',
        showAnim: 'slide',
        showButtonPanel: true,
        changeYear: true,
        changeMonth: true,
        yearRange: '1950:2100'

    });
    $("#bazarDataFetchButton").on('click', function () {
        var specificData = $('#specificBazarDatePicker').val();
        specificDateBazarData(specificData);
    });

    $(".showSpecificBazarDetails").on('click',function () {
        var specificDate=this.id;
        //var td = this.specificShpopperName;
        var shopperName=$(this).parents("tr").find(".specificShpopperName").html()

        $("#selectedSpecificDate").html(specificDate);
        $("#allBazarList").slideUp('slow',function(){
            $(this).fadeOut('slow');
        });
        $("#specificDateBazarDetailsDiv").slideDown('slow',function(){
            $(this).fadeIn('slow');
        });
        fetchSpecificDateData(specificDate,shopperName);
    });

    $("#closeSpecificDateBazarDetailsDiv").on("click",function () {
        closingDiv();
    });
    $("#backToBazarList").on("click",function () {
        closingDiv();
    });
    function fetchSpecificDateData(specificDate,shopperName) {
        $.ajax({
            url: "managerShoppingCostFetch.php",
            type: "POST",
            dataType:'json',
            data:'showSpecificDateBazarDetails='+specificDate,
            success: function(data){
                var fullTable='';
                fullTable+= '<table class="table table-bordered specficDetailsTable">' +
                    '<thead>' +
                    '<tr><th colspan="4" class="text-center"><strong>Shopper : '+shopperName+'</strong></th></tr>' +
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
    function closingDiv() {
        //$('#newBillCreation')[0].reset();
        $("#specificDateBazarDetailsDiv").slideUp('slow',function () {
            $(this).fadeOut('slow');
        });
        $("#allBazarList").slideDown('slow',function () {
            $(this).fadeIn("slow");
        });
    }

    $('body').on("click", '.detailsTable', function(event) {

    });
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

        //swal(" Working Id :"+ID+" item_name : "+item_name+"; item_price : "+item_price+" quantity :" +quantity);
        $.ajax({
            type:'POST',
            url:'managerShoppingCostEntry.php',
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
    specificDateBazarDetailsDiv.on('click','.editBtn',function () {
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
                    url: 'managerShoppingCostEntry.php',
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
