document.getElementById("newMemberAddDiv").style.display = 'none';
$(document).ready(function () {
    $("#addMoreMemberToGroup").click(function () {
        $("#memberProfileList").slideUp();
        $("#newMemberAddDiv").slideDown();
    });
    $("#closeNewMemberAddDiv").click(function () {
        closingOp();
    });
    $("#cancelNewMemberAdd").click(function () {
        closingOp();
    });

    function closingOp() {
        $("#memberProfileList").slideDown();
        $("#newMemberAddDiv").slideUp();
    }

    function searchUser(searchTerm) {
        $.ajax({
            type: "POST",
            url: 'groupDetailsManagerFetch.php',
            data: {'searchTerm': searchTerm},
            success: function (data) {
                var result=$('div#searchQueryResult');
                var d = $.parseJSON(data);
                result.empty();
                if (d.length > 0) {
                    for (i = 0; i < d.length; i++) {
                        result.append('<a class="list-group-item" href="profile.php?userProfileView=' + d[i].id + '">'+'<h4 class="list-group-item-heading">' + d[i].firstName + ' ' + d[i].lastName + '</h4><p class="list-group-item-text">'+d[i].email+'</p></a>');
                    }
                }
                else {
                    result.html('<a class="list-group-item"><h4 class="list-group-item-heading">Does Not Match Any Email</h4></a>');
                }
            },
            error: function (result, xhr, status) {
                /*console.log(xhr);*/
            }
        });
    }
    var searchQuery=$("#searchQuery");
    searchQuery.on('input', function () {
        var searchTerm = $("#searchQuery").val();
        if (searchTerm !== "") {
            searchUser(searchTerm);
        }
        else if (searchTerm === "") {
            $('div#searchQueryResult').empty();
        }
    });
    searchQuery.keyup(function () {
        var searchTerm = $("#searchQuery").val();
        if (searchTerm!==""){
            searchUser(searchTerm);
        }
        else if (searchTerm === "") {
            $('div#searchQueryResult').empty();
        }
    });

    var removeMemberButton=$(".removeMemberButton");

    removeMemberButton.on('click',function(){
        var preferredPerson=$(this).closest("a").attr('id');
        //swal(preferredPerson);

        removeMember(preferredPerson);
    });
    function removeMember(id) {
        swal({
            title: "Are you sure?",
            text: "This member will be removed from the group",
            icon: "error",
            buttons: [true, 'Yes'],
            dangerMode: true,
        }).then((willDelete) => {
            if(willDelete) {
                $.ajax({
                    url: "groupDetailsManagerEntry.php",
                    type: "POST",
                    data: 'action=removeUser&userId=' + id,
                    success: function (data) {
                        /*$(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().remove();
                        //$(this).closest("#memberCard"+id).remove();
                        $('#newMemberAddResult').html(data);*/
                            if (data=='200'){
                                $("#memberCard"+id).fadeOut(300, function(){ $(this).remove();});
                            }
                            else {
                                swal(data);
                            }
                        },
                    error: function (request, status, error) {
                        alert(request.responseText);
                        }
                    });
                }
            });
        }



    $("#editFormSaveButton").on('click', function () {
        $.ajax({
            type: 'POST',
            url: "groupDetailsManagerEntry.php",
            data: $("#groupDetailsEditForm").serializeArray(),
            success:function (data) {
               /* console.log(data);*/
                alert(data);
                location.reload();
            },
            error: function (xhr)
            {
                alert("An error occured: " + xhr.status + " " + xhr.statusText);
            }

        });
        //alert("Working SuccessFully");
    });

    $('.makeManagerButton').on('click',function () {
        //var selectedPersonId=this.id;
        var selectedPersonId = $(this).closest("a").attr('id');
        swal({
            title: "Are you sure?",
            text: "You will no longer be the manager of this group! ",
            icon: "warning",
            buttons: [true, 'Yes'],
            dangerMode: true,
        }).then((willDelete) => {
            if(willDelete) {
                $.ajax({
                    type: 'POST',
                    url: 'groupDetailsManagerEntry.php',
                    data: 'action=changeManager&selectedPersonId=' + selectedPersonId,
                    success: function (response) {
                        if (response == '200') {
                            swal({
                                title: "Manager Changeed Successully",
                                text: "Please Login Again After Logout ",
                                icon: "warning",
                            }).then((willDelete) => {
                                if(willDelete) {
                                }
                            });
                            setTimeout("window.location.replace('logout.php');",3000);
                            //$(this).closest('tr').fadeOut(300, function(){ $(this).remove();});
                        } else {
                            swal("Else : "+response);
                            //trObj.find("#"+deleteId).remove();
                        }
                    },
                    error: function (response, status) {
                        swal(response.responseText + " Status " + status);
                    }
                });
                //$(this).closest('tr').fadeOut(300, function(){ $(this).remove();});
                //swal(selectedPersonId);
            }
        });
    });

});