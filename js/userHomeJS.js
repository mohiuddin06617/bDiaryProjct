/**
 * Created by rian on 12/26/2016.
 */

function mealStatusYes(){

        var answer=document.getElementById('answerYes').value;

        document.getElementById('answerNo').disabled=true;
        document.getElementById('mealStatusSet').style.display='none';
        document.getElementById('todaysDateTime').style.display='none';
        document.getElementById('mealStatus').innerHTML=answer;
    //$(document).ready(function() {

        $.ajax({
            type: 'POST',
            url: 'DbFile/mealStatusInsert.php',
            data:"answer="+answer,
            success:function(response){
                $("#mealStatus").html(response);
            }

    });
    return false;
    //});
}
function mealStatusNo() {
    var answer=document.getElementById('answerNo').value;

    document.getElementById('answerYes').disabled=true;
    document.getElementById('mealStatusSet').style.display='none';
    document.getElementById('todaysDateTime').style.display='none';

    document.getElementById('mealStatus').innerHTML=answer;

    $.ajax({
        type: 'POST',
        url: 'DbFile/mealStatusInsert.php',
        data:"answer="+answer,
        success:function(response){
            $("#mealStatus").html(response);
        }

    });
}
$(document).ready(function() {
$("#moreThanOneMeal").hide();
});
$(document).ready(function() {
    $("#buttonShowMoreOneMealDiv").click(function () {
        $("#moreThanOneMeal").fadeIn();
        $("#showMoreOneMealDiv").hide();
        //$("#buttonShowMoreOneMealDiv").fadeOut('slow');
    });
});
function moreThanOneMealFunction() {
    alert("Clicked");
    $("#mealStatusSet").fadeOut("slow");
    $("#mealStatus").fadeIn();
}
$(document).ready(function() {
    $("#closeMoreThanOneMealDiv").click(function () {
        $("#showMoreOneMealDiv").fadeIn();
        $("#moreThanOneMeal").hide();
    });
});
