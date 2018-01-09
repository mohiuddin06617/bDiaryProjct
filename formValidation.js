/**
 * Created by rian on 12/9/2016.
 */
var firstnamebool=lastnamebool=emailbool=passwordbool=confirmpaswordbool=phonenumberbool=false;
function firstName_validation() {



    var firstName = document.getElementById('firstName').value;

    if (firstName) //will evaluate to true if value is not: null,undefined,NaN,empty string (""),0,false
    {
        var splitName;
        splitName=firstName.split(" ");
        if(splitName.length>=1){
            if(/^[a-zA-Z]+$/.test(firstName)){
                if (firstName.charAt(0).match(/[A-Za-z]/)!=null) {
                    //var emailValidation=document.nameRegistration.email;
                    //emailValidation.focus();
                    console.log("First Name is ok");
                    document.getElementById('firstNameError').style.display='none';
                    firstnamebool=true;
                }
                else
                {
                    alert("Must be a word");
                }
            }
            else
            {
                document.getElementById('firstNameError').innerHTML = "Name can contain a-z or A-Z or dot(.)";
            }
        }
        else
        {
            document.getElementById('firstNameError').innerHTML = "Name must be 1 word long";
        }
    }
    else {

        document.getElementById('firstNameError').innerHTML="First Name can't be empty!";
    }
}
function lastName_validation() {
    var lastName = document.getElementById('lastName').value;
    splitName = lastName.split(" ");
    if(lastName) {
        if (splitName.length >= 1) {
            if (/^[a-zA-Z]+$/.test(lastName)) {
                if (lastName.charAt(0).match(/[A-Za-z]/) != null) {
                    //var emailValidation=document.nameRegistration.email;
                    //emailValidation.focus();
                    console.log("Last Name is ok");
                    document.getElementById('lastNameError').style.display='none';
                    lastnamebool=true;
                }
                else {
                    alert("Must be a word");
                }
            }
            else {
                document.getElementById('lastNameError').innerHTML = "Name can contain a-z or A-Z or dot(.)";
            }
        }
        else {
            document.getElementById('lastNameError').innerHTML = "Name must be 1 word long";
        }

    }
else
    {

        document.getElementById('lastNameError').innerHTML = "Last Name can't be empty!";
    }
}
function email_validation() {
    var emailValue = document.getElementsByName('email')[0].value;
    //var emailValue = document.signup.email.value;
    var emailPattern = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    if (emailValue) {
        if (emailValue.match(emailPattern)) {
            document.getElementById('emailError').innerHTML="";
            emailbool=true;
        }
        else {
            document.getElementById('emailError').innerHTML = "Email Pattern not supported";
        }
    }
    else {
        document.getElementById('emailError').innerHTML = "Email Can not be empty";
    }
}
function password_validation() {
    var password = document.getElementById('password');
    var passwordValue = document.getElementById('password').value;
	document.getElementById('password').type="password";
    var paswordPattern = /^[a-zA-Z0-9@-_]+$/; //7 to 15 characters which contain at least one numeric digit and a special character
    if (passwordValue) {
        if (passwordValue.length >= 7 && passwordValue.length <= 15) {
            if (password.value.match(paswordPattern)) {
                
                document.getElementById('passwordError').innerHTML = "";
                passwordbool=true;
            }
        }
        else {
            document.getElementById('passwordError').innerHTML = "Password Must be 7 to 15 Character with one numeric digit and @-_ symbol";
        }
    }
    else {
        document.getElementById('passwordError').innerHTML = "Can not be empty!";
    }


}
function phone_number() {
    var phNumber = document.getElementById('phoneNumber').value;
    phval = /^[0-9]+$/;
    if (phNumber.match(phval) && phNumber.length==10) {
         document.getElementById('phoneNumberError').innerHTML ="";
        phonenumberbool = true;

    }
    else {
        document.getElementById('phoneNumberError').innerHTML = "Number can be only 10-digit number";
    }
}
function confirm_password(){
    var password=document.getElementById('password').value;
    var confirmPassword=document.getElementById("confirmPassword").value;
    if(confirmPassword!==""){
    if(password===confirmPassword){
        console.log("password match");

    }
    else {
        document.getElementById("confirmPasswordError").innerHTML="Password does not match";
    }
}
    else {
          document.getElementById("confirmPasswordError").innerHTML="Can not be empty!";
    }
}


function rememberPassword(){
	if(document.getElementById('rememberPassword').checked){
		console.log("Checked");
	}
	else{
		console.log("Not checked");
	}
}

function submitFunction2() {

    if (firstnamebool==true && lastnamebool==true ){
        if(emailbool==true){
            if (passwordbool==true){
                if(phonenumberbool==true){
                        submitFunction();
                }
                else {
                    alert("Phone Number not set");
                }
            }
            else {
                alert("Password Not set");
            }
        }
        else {
            alert("Email Not set");
        }
    }
    else {
        alert("Name Not set");
    }
}
function submitFunction() {
    $.ajax({
        type:'POST',
        url:'insertSignUp.php',
        data:$('#signUpForm').serialize(),
        success:function(response){

            $('.show_result').html(response);
            window.location.replace("signin.php");
        }
    });
    return false;
}




