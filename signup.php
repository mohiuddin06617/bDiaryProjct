<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <noscript>
        <meta http-equiv="refresh" content="0;url=nojsSignup.php">
    </noscript>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/css/signin.css">
    <!--<link rel="stylesheet" href="Resource/form_buttonDesign.css">
-->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <title></title>
    <style>


        option {
            font-style: oblique;

        }

        label {
            font-size: 130%;
        }
    </style>
</head>
<body>
<div class="container">
    <h3 class="show_result"></h3>
    <h2 class="text-center form-signin-heading">Please Sign Up</h2>
    <form id="signUpForm" name="singUpForm" onsubmit="return submitFunction()" class="form-horizontal">
        <div class="form-group">
            <label for="name" class="control-label col-sm-2"> Name:</label>
            <div class="col-sm-4">
                <input type="text" id="firstName" name="firstName" maxlength="30" size="10"
                       placeholder="First"
                       onblur="firstName_validation()" class="form-control"/>
            </div>
            <div class="col-sm-4">
                <input type="text" id="lastName" name="lastName" maxlength="30" size="10" placeholder="Last"
                       onblur="lastName_validation()" class="form-control">
            </div>
            <div class="col-sm-2">
                <p class="text-danger" id="firstNameError"></p>
                <p class="text-danger" id="lastNameError"></p>
            </div>
        </div>
        <!--<div class="form-group">
            <div id="name">
                <input type="text" id="firstName" name="firstName" maxlength="30" size="10"
                       placeholder="First"
                       onblur="firstName_validation()" class="form-control"/>
                <input type="text" id="lastName" name="lastName" maxlength="30" size="10" placeholder="Last"
                       onblur="lastName_validation()" class="form-control">

            </div>
        </div>-->
        <div class="form-group">
            <label for="email" class="control-label col-sm-2">Email:</label>
            <div class="col-sm-7">
                <input type="text" id="email" name="email" onblur="email_validation()" class="form-control">
            </div>
            <div class="col-sm-3">
                <span id="emailError" class="text-danger"></span>
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="control-label col-sm-2">Create a Password:</label>
            <div class="col-sm-7">
                <input type="text" id="password" name="password" onblur="password_validation()"
                       class="form-control">
            </div>
            <div class="col-sm-3">
                <h5 class="text-danger" id="passwordError"></h5>
            </div>
        </div>
        <div class="form-group">
            <label for="confirmPassword" class="control-label col-sm-2">Confirm Password:</label>

            <div class="col-sm-7">
                <input type="password" id="confirmPassword" name="confirmPassword" onblur="confirm_password()"
                       class="form-control">
            </div>
            <div class="col-sm-3">
                <span class="text-danger" id="confirmPasswordError"></span>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-2 col-sm-2 control-label"><b>Phone Number :</b></div>
            <div class="col-lg-2 col-sm-2">
                <select id="phoneNumberExtension" name="phoneNumberExtension" class="form-control">
                    <option data-countryCode="BD" value="880">Bangladesh (+880)</option>
                    <!-- <optgroup label="Other countries">-->
                    <option data-countryCode="DZ" value="213">Algeria (+213)</option>
                    <option data-countryCode="AG" value="1268">Antigua &amp; Barbuda (+1268)</option>
                    <option data-countryCode="AD" value="376">Andorra (+376)</option>
                    <option data-countryCode="AO" value="244">Angola (+244)</option>
                </select>
            </div>
            <div class="col-lg-5 col-sm-5">
                <input type="text" id="phoneNumber" name="phoneNumber" onblur="phone_number()"
                       class="form-control">
            </div>
            <div class="col-lg-3 col-sm-3">
                <span id="phoneNumberError"></span>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="button btn btn-success btn-lg pull-left" id="submitButton" name="submit"
                       class="btn btn-sm btn-lg"
                       value="Submit">
            </div>
        </div>
    </form>

</div>
<br><br>
<center><a href="index.html" class="btn btn-link">Back to Home</a>
    <p>Alreday a Member? <a href="signin.php" class="btn btn-link btn-lg">Sign In</a></p></center>
<script src="formValidation.js"></script>


</body>
</html>