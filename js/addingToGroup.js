/**
 * Created by p9 on 27-Dec-16.
 */

    function addToGroup() {
        $.ajax({
            type: "POST",
            url: "addingToGroup.php",
            success: function (response) {
                $("#groupAddingResult").html(response);

            }
        });
}

