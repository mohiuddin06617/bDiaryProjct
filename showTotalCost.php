<!DOCTYPE html>
<html>
<head>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    <title></title>
</head>
<body>
<center>
    <table>
        <div id="showCost">

    <tr>
        <td>
                <div id="showCostWithDetails">
                    <select name="selectMonth" id="selectMonth" onchange="showCostList(this.value)">
                        <option value="">Select Month</option>
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                </div>
        </td>
        <td>
            <?php
    session_start();
include "DbFile/dbconfig.php";
$email=$_SESSION['email'];
//echo "Manager id:".$_SESSION['managerID'];
$result=mysqli_fetch_array(mysqli_query($conn,"SELECT group_id from groupdetails WHERE manager_id='".$_SESSION['managerID']."'"),MYSQLI_ASSOC);
//$result['group_id'];
$gettingNameQuery="SELECT id,firstName,lastName from userinfo WHERE group_id='".$result['group_id']."'";
$result2=mysqli_query($conn,$gettingNameQuery);



if(mysqli_num_rows($result2)){
    $select= '<select name="selectName" id="selectedPersonForCost">';
    $select.='<option value="">Show Total</option>';
    while($rs=mysqli_fetch_array($result2)){
        $select.='<option value="'.$rs['id'].'">'.$rs['firstName']." ".$rs['lastName'].'</option>';
    }
}
$select.='</select>';
echo $select;?>
        </td>
    </tr>

<tr>
    <td>
        <div id="showSelectedMonthCost">

            </div>
    </td>
</tr>
        </div>
    </table>
</center>
<script type="text/javascript">
//    $(document).ready(function () {
var selectedMonth = $("#selectMonth").val();
        function showCostList(val) {
            var selectedMonth = $("#selectMonth").val();
            //console.log(selectMonth);
            //$("#showMealListData").html("");

            $.ajax({
                type: 'POST',
                url: 'getUserSelectedMonthCost.php',
                data: "selectedMonth=" + selectedMonth,
                success: function (data) {
                    $("#showSelectedMonthCost").html(data);
                }
            });
        }
//    });
        $("#selectedPersonForCost").change(function () {
            var selectedPersonForCost= $("#selectedPersonForCost").val();
            var selectedMonth = $("#selectMonth").val();
            if(selectedPersonForCost!=="") {
                $.ajax({
                    type: 'POST',
                    url: 'getSelectedPersonMonthCost.php',
                    data: {'selectedMonth': selectedMonth, 'selectedPersonForCost': selectedPersonForCost},
                    success: function (data) {
                        $("#showSelectedMonthCost").html(data);
                    }
                });


            }
            else if(selectedPersonForCost==""){
                /*showCostList(selectedMonth);*/

               var selectedMonth = $("#selectMonth").val();


                $.ajax({
                    type: 'POST',
                    url: 'getUserSelectedMonthCost.php',
                    data: "selectedMonth=" + selectedMonth,
                    success: function (data) {
                        $("#showSelectedMonthCost").html(data);
                    }
                });
            }
    });
        function getUserSelectedMonthCost() {

        }

/*
    setInterval(showCostList, 3000);
*/

</script>
</body>
</html>

<?php
/**
 * Created by PhpStorm.
 * User: p9
 * Date: 20-Jan-17
 * Time: 4:33 AM
 */

?>