<!DOCTYPE html>
<html>
<head>
    <title>Meal Conformation</title>
    <link rel="stylesheet" type="text/css" href="Resource/form_buttonDesign.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/userHomeJS.js"></script>
</head>
<body>
<div id="todaysDateTime">
    <?php date_default_timezone_set("Asia/Dhaka");
    $dat=date("H");
    $dateString=date("D M j Y");
    echo "<center>Today is: <b>".$dateString."</b></center>";
    ?>
</div>
<div id="mealStatusSet">
    <center>
    <tr>
        <td>
            <h1 id="simpleHeader">Are you going to eat <?php require"timeSelector.php"; ?>?</h1>
        </td>
    </tr>
    <tr>
        <td><button type="button" value="yes" class="button" id="answerYes" onclick="mealStatusYes()">Yes</button>
            <button type="button" value="no" class="button" id="answerNo" onclick="mealStatusNo()">No</button> </td>
    </tr>
        <div id="showMoreOneMealDiv">
            <button type="button" id="buttonShowMoreOneMealDiv" class="button">Click Here To Add More Than One Meal?</button>
        </div>
        <div id="moreThanOneMeal">
    <tr>
        <td><img id="closeMoreThanOneMealDiv" src="Resource/close_icon.png" /></td>
    </tr>
            <tr>
        <td><h2>How Many Meal for <?php $timeS=new timeSel();
           echo $timeS->timeSelecting();?>?</h2></td>
    </tr>
    <tr>
        <td><input type="number" name="numberOfMeal" id="numberOfMeal" class="itemName"><br></td>
    </tr>
    <tr>
        <button type="button" id="buttonMoreThanOneMeal" class="button" onclick="moreThanOneMealFunction()">Enter</button>
    </tr>
        </div>

    </center>
</div>
<div id="mealStatus"></div>


</body>
</html>
