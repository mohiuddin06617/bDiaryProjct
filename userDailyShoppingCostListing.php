<!DOCTYPE html>
<html>
<head>
    <?php
    session_start();
    if(isset($_SESSION['email'])){
    ?>

    <title>Enter Today's Cost</title>
    <link rel="stylesheet" type="text/css" href="Resource/pageLayout.css">
    <link rel="stylesheet" type="text/css" href="Resource/form_buttonDesign.css">
    <script src="assets/js/jquery.min.js"></script>


    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="js/userHomeJS.js"></script>
    <style>
        .add-box {
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

        #datepickerforuserdailycost {
            font-size: 100%;
            width: 40%;
        }
    </style>
</head>
<body>


<div class="field_wrapper">
    <center>
        <div>

            <!--<form name="userDailyShoppingCost" method="post">
                <table>
                <tr>
                    <td>
                        <label for="itemName" name="">Item</label>
                        <input type="text" id="itemName" name="field_name[]" value="" class="itemName"/>
                    </td>
                    <td>
                        <br>
                        <label for="price" name="">Price</label>
                        <input type="text" id="price" name="priceList[]" value="" class="itemName"/>
                    </td>
                </tr>
                <br>
                <tr>
                    <td><div class="submitShoppingItem">
                            <button type="submit" class="button" name="sendForApproval">Send For Approval</button>
                        </div></td>
                    <td><a href="javascript:void(0);" class="itemList" title="Add field"><button type="submit" name="addmore" class="button">Add More</button></a></td>
                </tr>
                </table>
                </form>
                -->
            <div class="my-form">
                <form role="form" method="post">
                    <div id="datePicking">
                        <p>Select Date:<input type="text" id="datepickerforuserdailycost" name="dateforuserdailycost"
                                              class="itemName2" onblur="dateValidation()"></p>
                        <div id="dateError"></div>
                    </div>
                    <p class="text-box">
                        <label for="item1">Item<span class="box-number">1</span></label>
                        <input type="text" name="items[]" value="" id="item1" class="itemName2"/>
                        <label for="quantity1">Quantity Item<span class="box-number">1</span></label>
                        <input type="text" name="quantities[]" value="" id="quantity1" class="itemName2"/>
                        <br>&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                        <label for="price1">Price <span class="box-number">1</span></label>
                        <input type="text" name="prices[]" value="" id="price1" class="itemName2"/>
                    <p><input type="submit" value="Send for Approval" name="sendForApproval" class="button"/></p>
                    <a class="add-box" href="#">Add More</a>
                    </p>
                </form>
            </div>
        </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $('.my-form .add-box').click(function () {
            var n = $('.text-box').length + 1;
            if (5 < n) {
                alert('Stop it!');
                return false;
            }
            var box_html = $('<p class="text-box"><label for="item' + n + '">Item <span class="box-number">' + n +
                '</span></label> <input type="text" name="items[]" value="" id="item' + n + '" class="itemName2" />' +
                '<label for="quantity'+ n +'">Quantity Item<span class="box-number">'+ n +'</span></label>'+
                '<input type="text" name="quantities[]" value="" id="quantity'+ n +'" class="itemName2"><br>&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;'+
                '<label for="price'+ n +'">Price <span class="box-number">' + n + '</span></label>' +
                '<input type="text" name="prices[]" value="" id="price' + n + '" class="itemName2"/>' +
                '<a href="#" class="remove-box">Remove</a></p>');
            box_html.hide();
            $('.my-form p.text-box:last').after(box_html);
            box_html.fadeIn('slow');
            return false;
        });
        $('.my-form').on('click', '.remove-box', function () {
            $(this).parent().css('background-color', '#FF6C6C');
            $(this).parent().fadeOut("slow", function () {
                $(this).remove();
                $('.box-number').each(function (index) {
                    $(this).text(index + 2);
                });
            });
            return false;
        });
    });
    $(document).ready(function () {
        $("#datepickerforuserdailycost").datepicker();
    });

    $(document).ready(function () {
        var maxField = 6;
        var addButton = $('.itemList');
        var wrapper = $('.field_wrapper');
        var fieldHTML = '<center><div><tr><td><label for="itemName" name="">Item</label><input type="text" name="field_name[]" value="" class="itemName"></td>' +
            '<td><br><label for="price" name="">Price</label><input type="text" id="price" name="priceList[]" value="" class="itemName"/></td></tr>' + '' +
            '<a href="javascript:void(0);" class="remove_button" title="Remove field"><br>' +
            '<button type="submit" name="addmore" class="button">Remove</button></a></div></center>';
        var x = 1;
        $(addButton).click(function () {
            if (x <= maxField) {
                x++;
                $(wrapper).append(fieldHTML);

            }
            else {
                alert("Please Contact with Adminstrator To add more!");
            }
            console.log(x);
        });

        $(wrapper).on('click', '.remove_button', function (e) {
            e.preventDefault();

            $(this).parent('div').remove();
            x--;

        });
    });


</script>
<?php
require "DbFile/dbconfig.php";
echo $_SESSION['email'];
//echo count($_POST['field_name']);

if (!empty($_POST['sendForApproval'])) {
    echo "No of Item:" . count($_POST['items']) . "<br>";
    //echo count($_POST['prices'])."<br>";
    $itemCount = count($_POST['items']);
    $itemNameList = array();
    $itemPriceList = array();
    $dateForUserDailyCost = $_POST['dateforuserdailycost'];
    echo $dateForUserDailyCost;
    /*$allItemName = array();
    $allItemValue = array();
    for ($i = 0; $i < $itemCount; $i++) {
        array_push($allItemName, $_POST['items'][$i]);
    }
    for ($i = 0; $i < $itemCount; $i++) {
        array_push($allItemValue, $_POST['prices'][$i]);
    }
    foreach ($allItemName as $name) {
        echo "$name <br>";
    }
    foreach ($allItemValue as $value) {
        echo "$value <br>";
    }
    */

    $gettingUserIdQuery = "SELECT id,group_id from userinfo WHERE email='" . $_SESSION['email'] . "'";
    $resultGettingUserId = mysqli_fetch_array(mysqli_query($conn, $gettingUserIdQuery), MYSQLI_ASSOC);
    $gettingMangerGroupQuery = "SELECT manager_id,group_id from groupdetails WHERE group_id='" . $resultGettingUserId['group_id'] . "'";
    $resultManagerGroupId = mysqli_fetch_array(mysqli_query($conn, $gettingMangerGroupQuery), MYSQLI_ASSOC);
    echo "User Id : " . $resultGettingUserId['id'] . " Group Id : " . $resultGettingUserId['group_id'] . "<br>";
    echo "Manager Id : " . $resultManagerGroupId['manager_id'] . "Group Id : " . $resultGettingUserId['group_id'] . "<br>";
    $userID = $resultGettingUserId['id'];
    $managerID = $resultManagerGroupId['manager_id'];
    $group_id = $resultGettingUserId['group_id'];
    $quantity;

    $query = "INSERT INTO userdailycost (user_id,group_id,manager_id,entry_time_date,item_name,item_price,quantity) VALUES ";
    $queryValue = "";
    $itemValues = 0;
    for ($i = 0; $i < $itemCount; $i++) {
        if (!empty($_POST["items"][$i])) {
            $itemValues++;
            if ($queryValue != "") {
                $queryValue .= ",";
            }
            $queryValue .= "('$userID','$group_id','$managerID','$dateForUserDailyCost','" . $_POST["items"][$i] . "','" . $_POST["prices"][$i] . "','" . $_POST["quantities"][$i] . "')";
        }
    }

    $sql = $query . $queryValue;
    if ($itemValues != 0) {
        $result = mysqli_query($conn, $sql);
        if (!empty($result)) $message = "Added Successfully.";
        else {
            echo "Unsucessful" . mysqli_error();
        }
    }

}

}
else
{
    header("Location:signin.php");
}
?>

</body>
</html>