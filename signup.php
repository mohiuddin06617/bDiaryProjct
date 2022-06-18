<?php
include_once "sessionStartCheck.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <noscript>
        <meta http-equiv="refresh" content="0;url=nojsSignup.php">
    </noscript>
    <link rel="stylesheet" href="Resource/form_buttonDesign.css">

    <meta name="viewport" content="width=device-width, initial-scale=1" charset="UTF-8">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <title>Sign Up | bDiary</title>
    <style>
        @media screen and (max-width: 870px) {
            .extraLeftDiv {
                display: none;
            }
        }

        .extraLeftDiv {
            background: url("Resource/LuffyImage.png") no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            height: 300%;
            overflow: hidden;
        }

    </style>
</head>
<body>
<?php
include_once "signUpProcess.php";
$firstNameError = $lastNameError = $emailError = $passwordError = $confirmPasswordError = $phoneNumberError = $passwordRule1 = $passwordRule2 = $passwordRule3 = "";
$firstNameBool = $lastNameBool = $emailBool = $passwordBool = $confirmPasswordBool = $phoneNumberBool = false;
$signup = new signup();
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-4 col-xs-0 extraLeftDiv">
            <h1>Working Some Stuff Will be added In here</h1>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
            <h3 class="col-sm-offset-3">Enter Information Below To Make Life Easier</h3>
            <?php

            /*$firstNameError = $lastNameError = $emailError = $passwordError = $confirmPasswordError = $phoneNumberError = $passwordRule1 = $passwordRule2 = $passwordRule3 = "";
            $firstNameBool = $lastNameBool = $emailBool = $passwordBool = $confirmPasswordBool = $phoneNumberBool = false;*/


            if(isset($_SESSION['registration_success'])){

                unset($_SESSION['registration_success']);
            }
            if ($_SERVER['REQUEST_METHOD'] === "POST") {

                $firstname = $_POST['firstName'];
                $lastname = $_POST['lastName'];
                $email = $_POST['email'];
                $confirmpassword = $_POST['confirmPassword'];
                $password = $_POST['password'];
                $phonenumber = $_POST['phoneNumber'];
                /*    $signup = new signup($firstname, $lastname, $email, $password, $confirmpassword, $phonenumber);*/
                $firstNameBool =$signup->nameValidationCheck($firstname,$lastname);
                $lastNameBool = $signup->nameValidationCheck($firstname,$lastname);
                $emailBool = $signup->emailValidationCheck($email);
                $passwordBool = $signup->passwordValidationCheck($password);
                $confirmPasswordBool = $signup->confirmPasswordCheck($password,$confirmpassword);
                $phoneNumberBool = $signup->phoneNumberCheck($phonenumber);


                if ($firstNameBool === true && $lastNameBool == true && $emailBool == true && $passwordBool == true &&
                    $confirmPasswordBool == true)
                {
                    if($signup->createUser($firstname,$lastname,$email,$confirmpassword,$phonenumber)){

                        $_SESSION['registration_success'] = "<div class='well well-lg'><h5 class='text-success text-center'>User Created Successfully.</h5><h3>An Activation Email has been sent to your email. Please click on the button to activate your account</h3></div>";
                        header('location:signin.php');
                        //header("Location:emailVerification.php?activate=sahcbsdhvbdhvbascsaicsibvsdasdasd");
                    }
                    else{
                        echo $signup->getUserCreationError();
                    }
                }
                else
                {
                    if (!$firstNameBool) {
                        echo "<h5 class='text-danger text-center'>Please Check First Name</h5>";
                    }
                    if (!$lastNameBool) {
                        echo "<h5 class='text-danger text-center'>Please Check Last Name</h5>";
                    }
                    if (!$emailBool) {
                        echo "<h5 class='text-danger text-center'>" . $signup->getEmailError() . "</h5>";
                    }
                    if (!$passwordBool) {
                        echo "<h5 class='text-center'>";
                        foreach ($signup->getPasswordError() as $passError) {
                            echo $passError ;
                        }
                        echo "</h5>";
                    }
                    if (!$confirmPasswordBool) {
                        echo "<h5 class='text-danger text-center'>" . $signup->getConfirmPasswordError() . "</h5>";
                    }
                    if (!$phoneNumberBool) {
                        echo "<h5 class='text-danger text-center'>" . $signup->getPhoneNumberError() . "</h5>";
                    }
                }
            }
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
                  accept-charset="utf-8" class="form" role="form" id="signUpForm">
                <div class="row">
                    <div class="col-xs-6 col-md-6">
                        <input type="text" name="firstName" id="firstName" onblur="firstName_validation()"
                               class="form-control input-lg" placeholder="Enter First Name" required/>
                        <p id="firstNameError"><?= $signup->getFirstNameError(); ?></p>
                    </div>
                    <div class="col-xs-6 col-md-6">
                        <input type="text" name="lastName" id="lastName" onblur="lastName_validation()"
                               class="form-control input-lg" placeholder="Enter Last Name" required/>
                        <p id="lastNameError"><?= $signup->getLastNameError() ?></p>
                    </div>

                </div>
                <!--  <div class="row">-->
                <input type="text" name="email" id="email" onblur="email_validation()"
                       class="form-control input-lg email" placeholder="Enter Your Email Here" required/>
                <p id="emailError"><?= $emailError ?></p>
                <!--</div>-->

                <input type="password" name="password" id="password" onblur="password_validation()"
                       class="form-control input-lg" placeholder="Enter Password Here" required/>
                <p id="passwordError"><?= $passwordError ?></p>
                <input type="password" name="confirmPassword" id="confirmPassword" value=""
                       class="form-control input-lg" onblur="confirm_password()" placeholder="Confirm Password Here" required/>
                <p id="confirmPasswordError"><?= $confirmPasswordError ?></p>
                <div class="row">
                    <div class="col-xs-3 col-md-3">
                        <select name="phoneNumberExtension" class="form-control input-lg">
                            <option value="880">+880</option>
                            <option value="99">99</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                    </div>
                    <div class="col-xs-9 col-md-9">
                        <input type="text" name="phoneNumber" id="phoneNumber" value=""
                               class="form-control input-lg" onblur="phone_number()"
                               placeholder="Enter Your Phone Number" required/>
                        <p id="phoneNumberError"><?= $confirmPasswordError ?></p>
                    </div>
                </div>


                <!--<h4><label>Date Of Birth</label></h4>
                  <div class="row">
                      <div class="col-xs-4 col-md-4">
                          <select name="day" class = "form-control input-lg">
                              <option value="0">Day</option>
                              <option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option>
                              <option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option>
                              <option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option>
                              <option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option>
                              <option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="21">21</option>
                              <option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option>
                              <option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option>
                              <option value="30">30</option><option value="31">31</option>
                          </select>
                      </div>

                      <div class="col-xs-4 col-md-4">
                          <select name="month" class = "form-control input-lg">
                              <option value="0">Month</option>
                              <option value="1">Jan</option><option value="2">Feb</option><option value="3">Mar</option>
                              <option value="4">Apr</option><option value="5">May</option><option value="6">Jun</option>
                              <option value="7">Jul</option><option value="8">Aug</option><option value="9">Sept</option>
                              <option value="10">Oct</option><option value="11">Nov</option><option value="12">Dec</option>
                          </select>
                      </div>
                      <div class="col-xs-4 col-md-4">
                          <select name="year" class = "form-control input-lg">
                              <option value="0">Year</option>
                              <option value="2017">2017</option>

                              <option value="2013">2013</option><option value="2014">2014</option><option value="2015">2015</option><option value="2016">2016</option>
                              <option value="2009">2009</option><option value="2010">2010</option><option value="2011">2011</option><option value="2012">2012</option>
                              <option value="2005">2005</option><option value="2006">2006</option><option value="2007">2007</option><option value="2008">2008</option>
                              <option value="2001">2001</option><option value="2002">2002</option><option value="2003">2003</option><option value="2004">2004</option>
                              <option value="1997">1997</option><option value="1998">1998</option><option value="1999">1999</option><option value="2000">2000</option>
                              <option value="1993">1993</option><option value="1994">1994</option><option value="1995">1995</option><option value="1996">1996</option>
                              <option value="1989">1989</option><option value="1990">1990</option><option value="1991">1991</option><option value="1992">1992</option>
                              <option value="1985">1985</option><option value="1986">1986</option><option value="1987">1987</option><option value="1988">1988</option>
                              <option value="1981">1981</option><option value="1982">1982</option><option value="1983">1983</option><option value="1984">1984</option>
                              <option value="1977">1977</option><option value="1978">1978</option><option value="1979">1979</option><option value="1980">1980</option>
                              <option value="1973">1973</option><option value="1974">1974</option><option value="1975">1975</option><option value="1976">1976</option>
                              <option value="1971">1971</option><option value="1972">1972</option><option value="1970">1970</option><option value="1969">1969</option>


                          </select>
                      </div>
                  </div>

                  <label>Gender : </label>
                  <label class="radio-inline">
                      <input type="radio" name="gender" value="M" id=male />Male
                  </label>
                  <label class="radio-inline">
                      <input type="radio" name="gender" value="F" id=female />Female
                  </label>-->


                <br/>
                <span class="help-block">By clicking Create my account, you agree to our Terms and that you have read our Data Use Policy, including our Cookie Use.</span>
                <button class="btn btn-lg btn-primary btn-block signup-btn button" id="submitButton" name="submit"
                        type="submit">Create my account
                </button>
            </form>
            <h1></h1>
            <div class="row">
                <p class="text-center bg-info">Already a member?<a href="signin.php" type="button"
                                                                   class="btn btn-lg btn btn-link signin-btn">Sign
                        in</a></p>
            </div>
            <div class="show_result"></div>
        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script type="text/javascript" src="//code.jquery.com/jquery-latest.js"></script>
<script src="formValidation.js"></script>
</body>
</html>