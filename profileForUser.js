/*
$(document).ready(function () {
    $('.listOfAction > a').click(function() {
        $('.listOfAction').removeClass();
        $(this).addClass('active');
        console.log(this);
    });
});*/
$(document).ready(function () {

    $('#userBirthDate').datepicker({
        dateFormat: 'yy-mm-dd',
        showAnim: 'slide',
        showButtonPanel: true,
        changeYear: true,
        changeMonth: true,
        autoSize: true,
        yearRange: "1900:2012"
    });

    function ajaxProfileDataSave() {

    }

    $("#editFormSaveButton").on('click', function () {
        $.ajax({
            type: 'POST',
            url: "profileForUserEntry.php",
            data: $("#profileUserEditForm").serializeArray(),
            success:function (data) {
                console.log(data);
                alert(data);
            },
            error: function (xhr)
            {
                alert("An error occured: " + xhr.status + " " + xhr.statusText);
            }

        });
    });

    $("#passwordChange").on('click',function () {
        $(".profileEdit").fadeOut(500);
        $("#passwordChangeDiv").fadeIn(500);
    });
    $("#cancelPasswordChangeButton").on('click',function () {
        $(".profileEdit").fadeIn(500);
        $("#passwordChangeDiv").fadeOut(500);
    });
    $("#changePasswordButton").on('click',function () {
       var currentPassword=$("#userCurrentPassword").val();
       var newPassword=$("#userNewPassword").val();
       var confPassword=$("#userConfirmPassword").val();
       if(newPassword===confPassword){
           alert("Matched!");
       }
       else {
           document.getElementById('userConfirmPasswordError').style.color="#FF0000";
           $("#userConfirmPasswordError").html("Password Does not match");
       }

    });
    function passwordValidation(passwordValue) {
        var passwordbool=false;
        var passwordPattern = /^[a-zA-Z0-9@-_]+$/; //7 to 15 characters which contain at least one numeric digit and a special character
        if (passwordValue) {
            if (passwordValue.length >= 7 && passwordValue.length <= 15) {
                if (passwordValue.match(passwordPattern)) {

                    document.getElementById('userNewPasswordError').innerHTML = "";
                    passwordbool=true;
                }
            }
            else {
                //document.getElementById('emailError').style.fontSize="30px";
                document.getElementById('userNewPasswordError').style.color="#FF0000";
                document.getElementById('userNewPasswordError').innerHTML = "Password Must be 7 to 15 Character with one numberic digit or @-_ symbol";
                //disable the login button
            }
        }
        else {
            document.getElementById('userNewPasswordError').style.color="#FF0000";
            document.getElementById('userNewPasswordError').innerHTML = "Field Can't be empty!";
        }
    }
    $("#userNewPassword").on('blur',function () {
        passwordValidation($("#userNewPassword").val());
    });

    function passswordChange() {
        $.ajax({
            type: 'POST',
            url: "profileForUserEntry.php",
            data: $("#passwordChangeForm").serializeArray(),
            success:function (data) {
                console.log(data);
                alert(data);
            },
            error: function (xhr)
            {
                alert("An error occured: " + xhr.status + " " + xhr.statusText);
            }

        });
    }

});