<!DOCTYPE html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("div").on("click", "p", function(){
                $(this).slideDown();
            });
            $("#addMore").click(function(){
                var n="";
                $('<p class="text-box"><label for="item' + n + '">Item <span class="box-number">' + n +
                    '</span></label> <input type="text" name="items[]" value="" id="item' + n + '" class="itemName" /> ' +
                    '<label for="price1">Price <span class="box-number">'+ n +'</span></label>' +
                    '<input type="text" name="prices[]" value="" id="price'+ n +'" class="itemName"/>'+
                    '<a href="#" class="remove-box">Remove</a></p>').insertAfter(".text-box");
            });
        });
    </script>
</head>
<body>
<div>
<form method="post" name="formV">
    <form role="form" method="post">
        <p class="text-box">
            <label for="item1">Item<span class="box-number">1</span></label>
            <input type="text" name="items[]" value="" id="item1" class="itemName"/>
            <label for="price1">Price <span class="box-number">1</span></label>
            <input type="text" name="prices[]" value="" id="price1" class="itemName"/>
            <a class="add-box" id="addMore" href="#" >Add More</a>
        </p>
        <div id="canInsert"></div>
        <p><input type="submit" value="Submit" class="button" /></p>
    </form>
</div>
<!--<div style="background-color:yellow">
    <p>This is a paragraph.</p>
    <p>Click any p element to make it disappear. Including this one.</p>
    <button>Insert a new p element after this button</button>
</div>-->
</form>
<?php
echo count($_POST['items']);
echo count($_POST['prices']);
?>
</body>
</html>
