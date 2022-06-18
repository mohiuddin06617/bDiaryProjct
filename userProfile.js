/*
$(document).ready(function () {
    $('.listOfAction > a').click(function() {
        $('.listOfAction').removeClass();
        $(this).addClass('active');
        console.log(this);
    });
});*/
$(document).ready(function () {

    var newPasswordBool=false;
    var confPasswordBool=false;
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
        if($('#userGender').is(":checked")){
            $.ajax({
                type: 'POST',
                url: "userProfileEntry.php",
                data: $("#profileUserEditForm").serializeArray(),
                success: function (data) {
                    console.log(data);
                    swal(data);
                },
                error: function (xhr) {
                    alert("An error occured: " + xhr.status + " " + xhr.statusText);
                }

            });
        }
        else{
            swal("Please Select Your Gender");
        }
    });

    $("#passwordChange").on('click',function () {
        $(".profileEdit").fadeOut(500);
        $("#passwordChangeDiv").fadeIn(500);
    });
    $("#cancelPasswordChangeButton").on('click',function () {
        $(".profileEdit").fadeIn(500);
        $("#passwordChangeDiv").fadeOut(500);
    });
    $("#userNewPassword").on('blur',function () {
        var password = document.getElementById('userNewPassword');
        var passwordValue = document.getElementById('userNewPassword').value;
        document.getElementById('userNewPassword').type="password";
        var passwordPattern = /^[a-zA-Z0-9@-_]+$/; //7 to 15 characters which contain at least one numeric digit and a special character
        if (passwordValue) {
            if (passwordValue.length >= 7 && passwordValue.length <= 15) {
                if (password.value.match(passwordPattern)) {
                    document.getElementById('userNewPasswordError').innerHTML = "";
                    newPasswordBool=true;
                }
            }
            else {
                document.getElementById('userNewPasswordError').style.color="#FF0000";
                //document.getElementById('emailError').style.fontSize="30px";
                document.getElementById('userNewPasswordError').innerHTML = "Password Must be 7 to 15 Character with one numberic digit and @-_ symbol";
            }
        }
        else {
            document.getElementById('userNewPasswordError').style.color="#FF0000";
            document.getElementById('userNewPasswordError').innerHTML = "Field Can't be empty!";
        }
    });
    $("#userConfirmPassword").on('blur',function(){
        var password = document.getElementById('userNewPassword').value;
        var confirmPassword = document.getElementById("userConfirmPassword").value;
        if (confirmPassword !== "") {
            if (password === confirmPassword) {
                document.getElementById("userConfirmPasswordError").innerHTML = "Password match";
                confPasswordBool = true;
            }
            else {
                document.getElementById("userConfirmPasswordError").innerHTML = "Password does not match";
            }
        }
        else {
            document.getElementById('userConfirmPasswordError').style.color = "#FF0000";
            document.getElementById("userConfirmPasswordError").innerHTML = "Confirm password can't be empty";
        }
    });

    $("#changePasswordButton").on('click', function () {
        if (newPasswordBool && confPasswordBool) {
            var currentPassword = $("#userCurrentPassword").val();
            var newPassword = $("#userNewPassword").val();
            var confPassword = $("#userConfirmPassword").val();
            passswordChange(currentPassword,newPassword);
        }
        else {
            swal("Please Check Entered Password Again")
        }


    });

    function passswordChange() {
        $.ajax({
            type: 'POST',
            url: "userProfileEntry.php",
            data: $("#passwordChangeForm").serializeArray(),
            beforeSend:function () {
                $("#changePasswordButton").html("Password Changing...");
            },
            success:function (data) {
                $("#changePasswordButton").html("Change Password");
                $("#passwordChangeResult").html(data).fadeIn().fadeOut(7500);
                swal(data);
            },
            error: function (xhr)
            {
                alert("An error occured: " + xhr.status + " " + xhr.statusText);
            }

        });
    }

});