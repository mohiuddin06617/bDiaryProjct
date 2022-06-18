$(document).ready(function(){
   $("#groupJoinDiv").hide();
   $("#groupCreationDiv").hide();
   $("#groupCreationSelectButton").on('click',function () {
       groupCreationShownHandle();
   });
   $("#groupJoinSelectButton").on('click',function () {
      joinGroupShownHandle();
   });
   $("#closeGroupCreationDivButton").on('click',function () {
       if($("#groupCreationNameEntry").val()==="") {
           $("#groupCreationResult").html("");
       }
       $("#groupCreationDiv").hide();
       $('#groupButtonClick').fadeIn("slow");
   });
    $("#closeGroupJoinDivButton").on('click',function () {
        if ($("#groupNameSearch").val()==="") {
            $("#groupSearchResult").html("");
        }
        $("#groupJoinDiv").hide();
        $('#groupButtonClick').fadeIn("slow");
    });
    $("#groupJoinLinkButton").on('click',function () {
       /* joinGroupShownHandle();*/
        $("#groupJoinDiv").hide();
        $("#groupCreationDiv").hide();
        $('#groupButtonClick').fadeIn("slow ");

    });
    $("#groupCreationLinkButton").on('click',function () {
        //groupCreationShownHandle();
        /*$("#groupJoinDiv").replacedWith($("#groupCreationDiv").fadeIn("slow"));*/
        $("#groupCreationDiv").hide();
        $("#groupJoinDiv").hide();
        $('#groupButtonClick').fadeIn("slow");

    });

    function groupCreationShownHandle(){
        $("#groupButtonClick").hide();
        $("#groupCreationDiv").css({"padding-top":"-20%"}).fadeIn("slow");
    }
    function joinGroupShownHandle(){
        $("#groupButtonClick").hide();
        $("#groupJoinDiv").css({"padding-top":"-20%"}).fadeIn("slow");
    }
});

$(document).ready(function () {
    $("#groupCreationButton").on('submit',function () {
        var enteredName=$("#groupCreationNameEntry").val();
        if(enteredName!=="") {
            userGroupCreate(enteredName);
        }
        else{
            $("#groupCreationResult").html("<h3 class='text-danger'>Please Enter a Group Name</h3>");
        }
    });
    $("#groupNameSearch").keyup(function () {
       var groupNameSearch=$("#groupNameSearch").val();
       if(groupNameSearch!=="")
       {
           userGroupJoin(groupNameSearch);
       }
       else if (groupNameSearch==="")
       {
           $("#groupSearchResult").html("<!--<h3 class='text-center'>Enter a Search Query!</h3>-->");
       }
    });
    $("#groupNameSearchButton").on('click',function () {
        var groupNameSearch=$("#groupNameSearch").val();
        if(groupNameSearch!=="")
        {
            userGroupJoin(groupNameSearch);
        }
        else if (groupNameSearch==="")
        {
            $("#groupSearchResult").html("<!--<h3 class='text-center'>Enter a Search Query!</h3>-->");
        }
    });

     function userGroupCreate(enteredGroupName) {
         $.ajax({
             type: 'POST',
             url: 'groupNameSelectionAddPeople.php',
             data: {enteredGroupName:enteredGroupName},
             success: function (data) {
                 $("#groupCreationResult").html(data).fadeIn('slow');
             }
         });
     }
     function userGroupJoin(searchedGroupName){
         $.ajax({
             type: 'POST',
             url: 'groupNameSelectionAddPeople.php',
             data: {searchedGroupName:searchedGroupName},
             success: function (data) {
                 $("#groupSearchResult").html(data).fadeIn('slow');
             }
         });
     }
});
$(document).ready(function () {
    $("#group_creation_form").on('submit',function (events) {
        events.preventDefault();
        if($.trim($("#newGroupMemberAdd").val()).length===0) {
            console.log("Must Have to select a group member to create group");
            return false;
        }
        else if($.trim($("#groupCreationNameEntry").val()).length===0){
            console.log("Please select a group name");
            return false;
        }
        else {
            var form_data=$(this).serialize();
            /*$("#groupCreationButton").attr("disabled","disabled");*/
            $.ajax({
                url:"groupCreationShownHandle.php",
                method:"POST",
                data:form_data,
                beforeSend:function () {
                    $("#groupCreationButton").val("Creating YOur Group...");
                },
                success:function (data) {
                    if (data!==''){
                        $("#groupCreationNameEntry").val('');
                    }
                }
            });
        }
    });
});

$(document).ready(function () {
    var wrapper = $(".text-box");
    var group_creation_button = $(".groupCreationButton"); //Add button ID

    var availableAttributes = [
        "Mohiuddin Ahmed",
        "Talha Khan",
        "Pronay Mazumdar",
        "Sovan Biswas Tuku",
        "Tarikul Islam",
        "account_address_street2",
        "account_address_zip",
        "account_email",
        "account_login",
        "account_name",
        "account_number",
        "account_telephone"
    ];

    $('.my_form .add-box').click(function () {
        var n = $('.text_box').length + 1;
       /* if (6 < n) {
            alert('Stop it!');
            return false;
        }*/
        var newmemebradd_textBox = $('<p class="text_box">' +
            '<label class="label-input-lg black-text-color" for="newGroupMemberAdd' + n + '"">Add New Member Below : </label>'+
            '<input type="text" class="form-control input-lg slide-up" name="newGroupMemberAdd[]" value="" id="newGroupMemberAdd' + n + '" placeholder="Search With Name or Email" required/>&nbsp;' +
            '<a href="#" class="remove-box btn btn-primary btn-lg">Remove</a></p>' +
            '<div id="suggestionBox'+n+'" class="suggestionBox"></div> ');
        newmemebradd_textBox.hide();
        $('.my_form p.text_box:last').after(newmemebradd_textBox);
        newmemebradd_textBox.fadeIn('slow');

        $(wrapper).find('input[type=text]:last').autocomplete({
            source: availableAttributes
        });
        return false;
    });
    $('.my_form').on('click', '.remove-box', function () {
        $(this).parent().css('background-color', '#FF6C6C');
        $(this).parent().fadeOut("slow", function () {
            $(this).remove();
            /*$('.item_number').each(function (index) {
                $(this).text(index + 1);
            });*/
        });
        return false;
    });

    $("input[name^='newGroupMemberAdd']").autocomplete({
        source: availableAttributes,
        onSelect: function (suggestion) {
            $(this).val(suggestion.data);
        }/*,
        select:function (event, ui) {
            $("#suggestionBox:last").html(availableAttributes);
            console.log("Working");
        }*/
    });
});