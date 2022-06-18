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
            document.getElementById('emailError').style.color="#FF0000";
            //document.getElementById('emailError').style.fontSize="30px";
            document.getElementById('emailError').innerHTML = "Email Pattern not supported";
            //disable the button in here
        }
    }
    else {
        document.getElementById('emailError').style.color="#FF0000";
        document.getElementById('emailError').innerHTML = "Email Can not be empty";
    }
}