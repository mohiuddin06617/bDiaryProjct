/**
 * Created by p9 on 04-Jun-17.
 */

var cancelButton=document.getElementById('cancelButton');
var closeButton=document.getElementById("closeButton");

    function modalCreation() {
    var modal = document.getElementById('myModal');
    var cancelButton=document.getElementById('cancelButton');
    var closeButton=document.getElementById("closeButton");

        modal.style.display="block";

    }
    function modalDestruction() {
        var modal = document.getElementById('myModal');
        var cancelButton=document.getElementById('cancelButton');
        var closeButton=document.getElementById("closeButton");

        modal.style.display="none";
    }
    
    function bazarDateCostDetails() {

       $('#bazarDate').text(function () {
           var date=$('#dateOfBazar').val();
           return date;

       });
       var date2=$('#dateOfBazar').val();
       document.getElementById('bazarDate').innerHTML="Hello World!@";
    }

$(document).ready(function () {
    $('#addMoreMemberToGroup').on('click',function () {
        modalCreation();
    });
    $('#cancelButton').on('click',function () {
        modalDestruction();
    });
    $('#closeButton').on('click',function () {
        modalDestruction();
    });

    $('#dateOfBazar').on('click',function () {
        bazarDateCostDetails();
    });
});