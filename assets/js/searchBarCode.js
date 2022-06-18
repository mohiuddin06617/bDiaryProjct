/**
 * Created by rian on 6/4/2017.
 */
$(document).ready(function () {

    function search() {
        var searchQuery = $("#searchAllUser").val();
        if (searchQuery != "") {

            $.ajax({
                type: "POST",
                url: "searchBarCode.php",
                data: "searchQuery=" + searchQuery,
                success: function (data) {
                    $("#searchResult").html(data);
                }
            });
        }
        else if(searchQuery==""){
            $("#searchResult").html(null);
        }
    }
    $("#searchIcon").on('click',function () {
        search();
    });
    $("#searchAllUser").keyup(function () {
        search();
    });
    $("#searchAllUser").focus(function (){
        search();
    });
});

