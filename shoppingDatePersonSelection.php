<!DOCTYPE html>
<html>
<head>
    <title>Manager's Home</title>
    <meta charset="utf-8">

    <title>jQuery UI Datepicker - Default functionality</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<style>
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
    #selectName{
        width: 40%;
        padding: 16px 20px;
        border: none;
        border-radius: 4px;
        background-color: gainsboro;
        font-size: 95%;
    }
    .dateSlector{
        width: 60%;
        font-size: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        box-sizing: border-box;
    }
    .dateSlector:focus{
        border: 3px solid #555;
    }
</style>
</head>
<body>
<center>
    <form method="post" role="form" id="shoppingPersonSelection" name="shoppingPersonSelection">
        <label for="selectName">Select Person</label>

        <?php
        session_start();
        include "DbFile/dbconfig.php";
        $email=$_SESSION['email'];
        //echo "Manager id:".$_SESSION['managerID'];
       $result=mysqli_fetch_array(mysqli_query($conn,"SELECT group_id from groupdetails WHERE manager_id='".$_SESSION['managerID']."'"),MYSQLI_ASSOC);
        //$result['group_id'];
        $gettingNameQuery="SELECT id,firstName,lastName from userinfo WHERE group_id='".$result['group_id']."'";
        $result2=mysqli_query($conn,$gettingNameQuery);

        /*echo "<select name=\"selectName\" id=\"selectName\">";
        while($nameResult=mysqli_fetch_assoc($result2)){
            echo "<option value=".$nameResult["firstName"].">".$nameResult['firstName']." ".$nameResult['lastName']."</option>

        </select> ";
        }*/

        if(mysqli_num_rows($result2)){
            $select= '<select name="selectName" id="selectedPersonId" name="selectName" >';
            while($rs=mysqli_fetch_array($result2)){
                $select.='<option value="'.$rs['id'].'">'.$rs['firstName']." ".$rs['lastName'].'</option>';
            }
        }
        $select.='</select>';
        echo $select;
        ?>

    <br>

    <label for="datepicker">Select Date: </label>
        <input type="text" id="datepicker" class="dateSlector" name="datepicker"><br>
    <input type="submit" class="button" name="submit" id="savePersonForShopping" value="submit">
    </form>
    <div id="ajaxrequest"></div>
</center>

<script>
    $(document).ready(function() {
        $( "#datepicker" ).datepicker();
    } );



    $(document).ready(function() {
        $("#savePersonForShopping").click(function (e) {
            e.preventDefault();
            saveSelectingPerson();
        });

        function saveSelectingPerson() {
                var selectedDate = $("#datepicker").val();
                var selectedPersonID = $("#selectedPersonId").val();

                $.ajax({
                    type: 'POST',
                    url: 'shoppingDatePersonDynamicEntry.php',
                    data: {'selectedPersonID': selectedPersonID, 'selectedDate': selectedDate},
                    success: function (response) {
                        $("#ajaxrequest").html(response);
                    },
                    error: function (xhr) {
                        alert("An error occured: " + xhr.status + " " + xhr.statusText);
                    }
                });
            }
        });

</script>
</body>
</html>