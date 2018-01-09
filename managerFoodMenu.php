<!DOCTYPE html>
<html>
<head>
    <title>User Food Menu</title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/userHomeJS.js"></script>


    <script type="text/javascript" src="//code.jquery.com/jquery-latest.js"></script>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body>
<div class="pageRightMenu">
    <div class="foodMenu">
        <tr>
           <center><td><b><h3>See Today's Menu</h3></td>
            <select name="time" id="mealtime" onchange="showMealList(this.value)">
                <option value="">Select One Please</option>
                <option value="Breakfast">Breakfast</option>
                <option value="Lunch">Lunch</option>
                <option value="Dinner">Dinner</option>
            </select>
           </center>
        </tr>
        <div id="showMealListData"></div>
    </div>
</div>
<script type="text/javascript">
    function showMealList(val){
        var mealltime=$("#mealtime").val();
        //$("#showMealListData").html("");
        $.ajax({
            type:'POST',
            url:'getUserFoodMenu.php',
            data:"mealtime="+mealltime,
            success:function(data){
                $("#showMealListData").html(data);
            }
        });
    }
    setInterval(showMealList,1000);
</script>
</body>
</html>
