<html>
<head>
    <title>Select Food Menu</title>
    <script type="text/javascript" src="//code.jquery.com/jquery-latest.js"></script>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <style>
        input[type=text] {
            width: 80%;
            padding: 12px 20px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 2px solid black;
            font-size: 100%;
        }
        .button{
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }
        .add-box{
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }
        #timePicking{
            align-content: center;
            text-align: center;
        }
        #timePickingforfoodmenu{
            font-size: 100%;
            width: 80%;
            }
        option{
            font-size: 100%;
        }
    </style>
</head>
<body>
<div id="foodMenu">
<?php
session_start();
if(isset($_SESSION['email'])){
?>

    <div class="my_form">
        <form name="foodMenuInputForm" method="post">
            <div id="dateAndTimePicking">
                <center>
                    <div id="timePicking">
                        <select id="timePickingforfoodmenu" name="timePickingforfoodmenu">
                            <option value="notSelected">Please Select Your Preferred Time</option>
                            <option value="Breakfast">Breakfast</option>
                            <option value="Lunch">Lunch</option>
                            <option value="Dinner">Dinner</option>
                        </select>
                        <span id="timePickingError"></span>
                    </div>
                </center>
                <div id="datePicking">
                    <p>Select Date:<input type="text" id="datepickerforfoodmenu" name="datepickerforfoodmenu"></p>
                </div>

            </div>

            <center><h1>Please Enter Your Preferred Menu</h1></center>
            <p class="text_box">
                <label for="item1">ITEM <span class="item_number">1</span></label>
                <input type="text" name="itemList[]" value="" id="item1"/>
                <!--<span id="itemListError0"></span>-->
            <center>
                <tr>
                    <td><input type="submit" class="button" name="save" id="saveInFoodmenu"></td>
                    <td><a class="add-box" href="#">Add More</a></td>
                </tr>
            </p>

            </center>
        </form>
    </div>
</div>
<script>
    jQuery(document).ready(function ($) {
        $('.my_form .add-box').click(function () {
            var n = $('.text_box').length + 1;
            if (6 < n) {
                alert('Stop it!');
                return false;
            }
            var item_textBox = $('<p class="text_box">' +
                '<label for="item' + n + '">ITEM <span class="item_number">' + n + '</span></label>' +
                ' <input type="text" name="itemList[]" value="" id="item' + n + '" />' +
                ' <a href="#" class="remove-box">Remove</a></p>');
            item_textBox.hide();
            $('.my_form p.text_box:last').after(item_textBox);
            item_textBox.fadeIn('slow');
            return false;
        });
        $('.my_form').on('click', '.remove-box', function () {
            $(this).parent().css('background-color', '#FF6C6C');
            $(this).parent().fadeOut("slow", function () {
                $(this).remove();
                $('.item_number').each(function (index) {
                    $(this).text(index + 1);
                });
            });
            return false;
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#datepickerforfoodmenu").datepicker();
    });
</script>
<script type="text/javascript">

        function dateAndTimeChecker() {
        var timeSelection = $("#timePickingforfoodmenu").val();
        var dateSelection = $("#datepickerforfoodmenu").val();

        if (timeSelection == 'notSelected') {
           //document.getElementByid("timePickingError").innerHTML='Please Select Time';
            $("#timePickingError").html("Please Select Time");
        }
        else {

        }
    }
    $("#saveInFoodmenu").click(function () {
      dateAndTimeChecker();
    });

</script>
</body>
</html>
<?php

if (!empty($_POST["save"])) {
    include "DbFile/dbconfig.php";
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $managerID=$_SESSION['managerID'];
    $itemCount = count($_POST["itemList"]);
    $dateforfoodmenu = $_POST['datepickerforfoodmenu'];
    $timePickingforfoodmenu = $_POST['timePickingforfoodmenu'];

    //Getting last column name AND No of total column
    $sql2 = "SELECT
	COLUMN_NAME,
	ORDINAL_POSITION
	FROM information_schema.COLUMNS 
	WHERE TABLE_SCHEMA = 'bDiary'
	AND TABLE_NAME ='foodmenu'
	ORDER BY ORDINAL_POSITION DESC 
	LIMIT 1";                                                       //GETTING the last column name
    $result2 = mysqli_fetch_array(mysqli_query($conn, $sql2));

    //Group Details Id fething
    $groupIdFetching="SELECT group_id from groupdetails where manager_id='$managerID'";
    $gid=mysqli_fetch_array(mysqli_query($conn,$groupIdFetching),MYSQLI_ASSOC);

    $lastColumnLength = strlen($result2[0]);
    $lastColumnNameValue = $result2[0];
    $group_id=$gid['group_id'];

    echo "Last Table Column Name: ".$lastColumnNameValue . '<br>';
    echo "No. of Column : ". $result2[1] . '<br>';

    echo $dateforfoodmenu . '<br>';
    echo "You Set ".$timePickingforfoodmenu." Menu <br>";
   echo "Into Group Number ".$group_id;
    $allValue=array();
    for($i=0;$i<$itemCount;$i++){
       array_push( $allValue,$_POST['itemList'][$i]);
    }
    foreach($allValue as $value2){
        echo "$value2 <br>";
    }

    //Dynamically value of row input

    $query = "INSERT INTO foodmenu (manager_id,group_id,inserted_date,inserted_time,item_name) VALUES ";
    $queryValue = "";
    $itemValues=0;
    for($i=0;$i<$itemCount;$i++) {
        if(!empty($_POST["itemList"][$i])){
            $itemValues++;
            if($queryValue!="") {
                $queryValue .= ",";
            }
            $queryValue .= "('$managerID','$group_id','$dateforfoodmenu','$timePickingforfoodmenu','" . $_POST["itemList"][$i] . "')";
        }
    }
    $sql = $query.$queryValue;
    if($itemValues!=0) {
        $result = mysqli_query($conn,$sql);
        if(!empty($result)) $message = "Added Successfully.";
        else{
            echo "Unsucessful".mysqli_error();
        }
    }

}
}
else{
    header("Location:logout.php");
}


?>