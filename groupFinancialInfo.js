$(document).ready(function () {
    $("#datepickerforuserdailycost").datepicker({
        dateFormat: 'dd/mm/yy',
        showAnim: 'slide',
        showButtonPanel: true
    });
    $('#datepickerManagerFoodMenu').datepicker({
        dateFormat: 'dd/mm/yy',
        showAnim: 'slide',
        showButtonPanel: true
    });
});

function switchManagerUserProfile(value) {
    if (value === 'user') {
        window.location.replace('userHome.php');
    }
    else if (value === 'manager') {
        window.location.replace('managerHome.php');
    }
}
/*
document.getElementById('newBillCreationDiv').style.visibility = "hidden";
*/
$(document).ready(function () {
    $("#newBillCreationDiv").hide();
    $("#addNewGroupBill").on("click", function () {
        $("#currentMonthBillingSummary").slideUp('slow',function(){
            $(this).fadeOut('slow');
        });
        $("#newBillCreationDiv").slideDown('slow',function(){
            $(this).fadeIn('slow');
        });
    });
    $("#cancelNewBillCreation").on("click",function () {
        closingDiv();
    });
    $("#closeNewBillCretionDiv").on('click',function () {
        closingDiv();
    });
    function closingDiv() {
        $('#newBillCreation')[0].reset();
        $("#newBillCreationDiv").slideUp('slow',function () {
            $(this).fadeOut('slow');
        });
        $("#currentMonthBillingSummary").slideDown('slow',function () {
          $(this).fadeIn("slow");
        });
    }
    function checkBillName() {
        var billName=$("#billName").val();
        if(billName.length===0){
            $("#billNameError").html("Bill Name Can Not Be Empty");
            return false;
        }
        else {
            return true;
        }
    }
    $("#newBillCreationResult").hide();
    function checkBillAmount() {
        var billAmount=$("#billAmount").val();

    }
    $("#newBillAddButton").on('click',function () {
        var nameCheckResult;
        var billCheckResult;
        $("#billName").blur(function () {
            checkBillName();
        });
       saveNewBill();
    });
    function saveNewBill() {
        var billName=$("#billName").val();
        var billAmount=$("#billAmount").val();
        var billCurrencyType=$("#billCurrencyType").val();
        var billingMonth=$("#billingMonth").val();
        $.ajax({
            type:'POST',
            url: 'groupFinancialInfoEntry.php',
            data: {'billName': billName, 'billAmount': billAmount,'billCurrencyType':billCurrencyType,'billingMonth':billingMonth,'creationData':'creationData'},
            success: function (data) {
                /*$("#newBillCreationResult").html(data);*/
                $("#newBillCreationResult").show().html(data).fadeIn("slow").fadeOut(6000);
            },
            error: function (xhr)
            {
                alert("An error occured: " + xhr.status + " " + xhr.statusText);
            }
        });
    }


    $(".editBtn").on('click', function () {
        $(this).closest(".partialAmount").find(".editSpan").hide();

        //show edit input
        $(this).closest(".partialAmount").find(".editInput").show();
        $(this).closest(".partialAmount").find(".editBtn").hide();
        $(this).closest(".partialAmount").find(".deleteBtn").hide();
        $(this).closest(".partialAmount").find(".updateBtn").show();
        $(this).closest(".partialAmount").find(".cancelBtn").show();
    });
    $(".cancelBtn").on('click', function () {

        $(this).closest(".partialAmount").find(".editInput").hide();
        $(this).closest(".partialAmount").find(".editSpan").show();
        $(this).closest(".partialAmount").find(".editBtn").show();
        $(this).closest(".partialAmount").find(".deleteBtn").show();
        $(this).closest(".partialAmount").find(".updateBtn").hide();
        $(this).closest(".partialAmount").find(".cancelBtn").hide();
    });
    $(".deleteBtn").on('click', function () {

        var trObj = $(this).closest(".partialAmount");
        var deleteId = $(this).closest(".partialAmount").attr('id');
        swal({
            title: "Are you sure?",
            text: "Your Data Will Be Deleted",
            icon: "warning",
            buttons: [true,'Yes'],
            dangerMode: true,
        }).then((willDelete) => {
            if(willDelete) {
                $.ajax({
                    type:'POST',
                    url:'groupFinancialInfoEntry.php',
                    data:'groupFinDeleteId='+deleteId,
                    success:function(response){
                        if(response === '200'){
                            $("#"+deleteId).remove();
                            /*trObj.find(".editInput").hide();
                            trObj.find(".updateBtn").hide();
                            trObj.find(".cancelBtn").hide();
                            trObj.find(".editSpan").show();
                            trObj.find(".deleteBtn").show();
                            trObj.find(".editBtn").show();*/
                        }else{
                            swal(response);
                        }
                    },
                    error:function (response,status) {
                        swal(response.responseText+" "+status);
                    }
                });
            }
        });

    });
    $(".updateBtn").on('click', function () {
        var trObj = $(this).closest(".partialAmount");
        var ID = $(this).closest(".partialAmount").attr('id');
        var inputData = $(this).closest(".partialAmount").find(".editInput").serialize();
        var currentBillName=trObj.find(".editInput.billName").val();
        var currentBillAmount=trObj.find(".editInput.billAmount").val();
        //swal(currentBillName+" "+currentBillAmount);
        $.ajax({
            type:'POST',
            url:'groupFinancialInfoEntry.php',
            //dataType: "json",
            data:'action=updateGroupFinInfo&groupFinId='+ID+'&'+inputData,
            success:function(response){
                //swal(response);
                if(response === '200'){
                    //console.log(response);
                    //console.log(response);
                    trObj.find(".editSpan.billName").html(currentBillName);
                    trObj.find(".editSpan.billAmount").html(currentBillAmount);
                    /*
                    trObj.find(".editSpan.lname").text(response.data.last_name);
                    */
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