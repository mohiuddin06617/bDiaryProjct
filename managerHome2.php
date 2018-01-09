<!DOCTYPE html>
<html>
<head>
    <title>Manager's Home</title>
    <link rel="stylesheet" type="text/css" href="Resource/pageLayout.css">
    <script type="text/javascript" src="//code.jquery.com/jquery-latest.js"></script>
    <style>
        /* Code has been moved to dailyFoodMenuSelection.php*/

        input[type=text] {
            width: 80%;
            padding: 12px 20px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 2px solid black;
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
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }    text-decoration: none;
            display: inline-block;

    </style>
</head>
<body>
<div class="pageLeftMenu"><h2>Daily Cost Approval</h2>
</div>
<div class="pageContent">
    <div id="foodMenu">
        <center><h1>Please Enter Today's Food Menu</h1></center>
        <div class="my_form">
            <form role="form" name="foodMenuInputForm" method="post">

                <p class="text_box">
                    <label for="item1">ITEM <span class="item_number">1</span></label>
                    <input type="text" name="itemList[]" value="" id="item1" />
                    <!--<span id="itemListError0"></span>-->
                <center>
                    <tr>
                        <td><input type="submit" class="button" name="save"></td>
                    <td><a class="add-box" href="#">Add More</a></td>
                </p>
                    </tr>
                </center>
            </form>
        </div>
    </div>
</div>
<div class="pageRightMenu">
    <?php
    include 'shoppingDatePersonSelection.php';
    ?>

</div>
<div class="pageFooter"><p>footer</p><h1>FOOTER </h1><p>Visit : www.Blended-Menu.com</p>
</div>
</div>
</body>
<script>
    jQuery(document).ready(function ($) {
        $('.my_form .add-box').click(function () {
            var n = $('.text_box').length + 1;
            if (5 < n) {
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
</html>

<?php
//practice database connection
/*if(!empty($_POST["save"])) {
    $conn = mysqli_connect("localhost","root","","foodmenu");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $itemCount = count($_POST["itemList"]);
    $itemValues=0;
    $query = "INSERT INTO item (item_name) VALUES ";
    $queryValue = "";
    for($i=0;$i<$itemCount;$i++) {
        if(!empty($_POST["itemList"][$i])){
            $itemValues++;
            if($queryValue!="") {
                $queryValue .= ",";
            }
            $queryValue .= "('" . $_POST["itemList"][$i] . "')";
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
}*/
?>