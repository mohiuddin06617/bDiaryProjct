$(function () {
    $('a').on('click', function () {
        $(this).find('active').removeClass('active');
        $(this).addClass('active');
    });
});
$(document).ready(function () {
    $("#leaveGroup").on('click', function () {
        swal({
            title: "Are you sure?",
            text: "Your Entered No Of Meal Will be removed",
            icon: "warning",
            buttons: [true,'Yes'],
            dangerMode: true,
        }).then((willDelete) =>  {
            leaveGroup();
            }
        });
    });


    function leaveGroup() {

        $.ajax({
            url: "userGroupEntry.php",
            type: "POST",
            data: 'leave=' + 'leave',
            success: function (data) {
                //$(this).remove();
                //$('#deleteReply').html(data);
                alert(data);
                location.reload();
            },
            error: function (request, status, error) {
                alert(request.responseText);
            }
        });
    }

});