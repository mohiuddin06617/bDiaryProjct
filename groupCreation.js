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
    $("#groupCreationButton").on('click',function (events) {
        events.preventDefault();
        var groupCreationNameEntry=$("#groupCreationNameEntry").val();
        if($.trim(groupCreationNameEntry).length===0) {
            $("#groupCreationNameResult").html("<h3 class='text-center text-danger'>Please Select a group Name</h3>");
            return false;
        }
        else {
            $.ajax({
                url: "groupCreationEntry.php",
                method: "POST",
                data: {'groupCreationNameEntry': groupCreationNameEntry},
                beforeSend: function () {
                    $("#groupCreationNameResult").html("");
                    $("#groupCreationButton").val("Creating YOur Group...");
                },
                success: function (data) {
                    if (data == '200') {
                        $("#groupCreationButton").attr("disabled", "disabled").val("Created");
                        $("#groupCreationNameResult").html('<h3>Group Created! Please Login After Logout</h3>');
                        window.setTimeout(function () {
                            location.href = "logout.php";
                        }, 4000);
                    }
                    else {
                        $("#groupCreationButton").val("Enter");
                        $("#groupCreationNameResult").html('<h3>'+data+'</h3>');
                    }
                }
            });
        }
    });
});

