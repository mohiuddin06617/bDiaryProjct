document.getElementById('groupResultButtonShow').style.display = 'none';
$(document).ready(function () {
    $("#groupJoinButtonConfirmation").on('click', function () {
        if (confirm("Sure you want to join the Group?")) {
            joinGroup();
        }
    });

    function joinGroup() {

        $.ajax({
            type: 'POST',
            url: 'groupViewUserEntry.php',
            data: {groupJoinData: 'success'},
            success: function (data) {
                //$("#groupJoinButtonConfirmation").prop( "disabled", true );
                $("#groupJoinButtonConfirmation").hide();
                $("#groupResultButtonShow").fadeIn('slow');
                $("#groupJoinSuccessResult").html(data +" Please sign in after signing out");
                setTimeout(function () {
                    window.location='logout.php'
                },3000);
                //this.disabled = true;
            }
        });
    }
});