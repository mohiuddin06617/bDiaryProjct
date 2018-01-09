<?php
$firstNameError=$lastNameError=$emailError=$passwordError=$confirmPasswordError=$phoneNumberError=$passwordRule1=$passwordRule2=$passwordRule3="";
$firstName=$lastName=$email=$password=$confirmPassword=$phoneNumber="";
$firstNameBool=$lastNameBool=$emailBool=$passwordBool=$confirmPasswordBool=$phoneNumberBool=false;
if($_SERVER['REQUEST_METHOD']=="POST") {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $phoneNumber = $_POST['phoneNumber'];
    $phoneNumberExrension=$_POST['phoneNumberExtension'];
    if(!empty($firstName) && !empty($lastName)){
        if(ctype_alpha($firstName[0]) && ctype_alpha($lastName[0])){
            $firstNameBool=$lastNameBool=true;
        }
        else{
            $firstNameError= " *Must start with a character";
        }
    }
    else{

            $firstNameError="* Name can not be empty!";
        }
    if (!empty($email)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailBool=true;
        } else {
            $emailError = " *Email Not properly validated";
        }
    } else {
        $emailError = "*Email can not be empty" . "<br>";
    }

    if(!empty($password)) {
        if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z._-]{7,15}$/', $password)) {
            $passwordError='the password does not meet the requirements!<br>';
            $passwordRule1=" *Must contain 7-15 letters<br>";
            $passwordRule2=" Must use combination of letter and numbers<br>";
            $passwordRule3=" May Contain Dot(.) Dash(-) Underscore(_)<br>";
        } else {
            //echo "Password is secured and password: " . $password."<br>";
            $passwordBool=true;
        }
    }
    else{
        $passwordError="*Password can not be empty";
    }
    if(!empty($confirmPassword)){
        if($confirmPassword == $password){
          $confirmPasswordBool=true;
        }
        else{
            $confirmPasswordError=" *Password does not match";
        }
    }
    else{
        $confirmPasswordError=" *Enter the above same password";
    }
    if(!empty($phoneNumber)) {
        if (strlen($phoneNumber) == 10 && is_numeric($phoneNumber)) {
            $phoneNumberBool=true;
        } else {
            $phoneNumberError = "*Does not met the criteria";
        }
    }
    else{
        $phoneNumberError = "*Can not be empty";
        }

        if($firstNameBool==true && $lastNameBool==true && $emailBool==true && $passwordBool==true && $confirmPasswordBool==true && $phoneNumberBool==true)
        {
            require 'DbFile/dbconfig.php';
            $sql="INSERT INTO userinfo(firstName,lastName,email,password,phoneNumber)
                  VALUES ('$firstName','$lastName','$email','$confirmPassword','$phoneNumber')";
            if (mysqli_query($conn, $sql)){
                echo "New data inserted successfully";
                header("Location:nojsSignin.php");
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            echo $password;
            echo "Confirm Password".$confirmPassword;
            echo $email;
            mysqli_close($conn);
        }

}
?>
<!DOCTYPE html>
<html>

<head>
    <title></title>
    <link rel="stylesheet" href="Resource/form_buttonDesign.css">
</head>
<body>
<form method="post" action="">
    <table border="0" cellspacing="0" cellpadding="5" align="center">
        <tr>
            <td>
                <fieldset>
                    <legend>Sign Up</legend>
                    <table align="center" cellpadding="10">
                        <tr>
                            <td><label for="name">Name:</label></td>
                            <div id="name">
                                <td><input type="text" id="firstName" name="firstName" maxlength="30" size="12" placeholder="First" class="input"/></td>
                                <td><input type="text" id="lastName" name="lastName" maxlength="30" size="10" placeholder="Last" class="input"> </td>
                                <td><?= $firstNameError?></td>
                                <td><?= $lastNameError?></td>
                            </div>
                        </tr>
                        <tr>
                            <td><label for="email">Email:</label></td>
                            <td><input type="text" id="email" name="email" class="input"></td>
                            <td><?= $emailError?></td>
                        </tr>
                        <tr>
                            <td><label for="password">Create a password:</label></td>
                            <td><input type="text" id="password" name="password" class="input"></td>
                            <td><?= $passwordError?></td>
                        </tr>
                        <tr>
                            <td><label for="confirmPassword">Confirm password:</label></td>
                            <td><input type="text" id="confirmPassword" name="confirmPassword" class="input"></td>
                            <td><?= $confirmPasswordError?></td>
                        </tr>

                        <tr>
                        <tr>
                            <td>
                                Phone Number:
                            </td>
                        </tr>

                        <td>
                            <select id="phoneNumberExtension" name="phoneNumberExtension">
                                <option data-countryCode="BD" value="880">Bangladesh (+880)</option>
                                <!-- <optgroup label="Other countries">-->
                                <option data-countryCode="DZ" value="213">Algeria (+213)</option>
                                <option data-countryCode="AG" value="1268">Antigua &amp; Barbuda (+1268)</option>
                                <option data-countryCode="AD" value="376">Andorra (+376)</option>
                                <option data-countryCode="AO" value="244">Angola (+244)</option>
                            </select>
                        </td>
                        <td><input type="text" id="phoneNumber" name="phoneNumber" onblur="phone_number()" class="input"></td>
                        <td><?= $phoneNumberError?></td>
                        </tr>
                    </table>
                </fieldset>
                    <center> <input type="submit" class="button" name="submit"  value="Submit"></center>

</form>
</body>
</html>
