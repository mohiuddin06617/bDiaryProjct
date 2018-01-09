<!DOCTYPE html>
    <html>
<head>
<title>Daily Cost Approval</title>
    <link rel="stylesheet" type="text/css" href="Resource/form_buttonDesign.css">
    <script src="assets/jquery.min.js"></script>
</head>
<body>
<?php
session_start();
require "DbFile/dbconfig.php";
$email=$_SESSION['email'];
$queryFromUserInfo="SELECT * FROM userinfo WHERE email='$email'";
$resultFromUser=mysqli_fetch_array(mysqli_query($conn,$queryFromUserInfo),MYSQLI_ASSOC);
$groupId=$resultFromUser['group_id'];

$queryUserGroupStatus="SELECT * from groupdetails WHERE group_id='$groupId'";
$result=mysqli_fetch_array(mysqli_query($conn,$queryUserGroupStatus),MYSQLI_ASSOC);
?>
<center>
    <?php
    if($resultFromUser['group_id']!=0 && $resultFromUser['userGroupStatus']==1){
    ?>

    <div id='groupStatus'>
        <div id="grouppStatus2">
            <h3 id="test">You have been added to Group <b><span class="textGroupInfo"><a
                            href="groupDetails.php"><?= $result['group_name'] ?></a></span></b> By <span
                    class="textGroupInfo">
                <?php
                $mid = $result['manager_id'];
                $mResult = mysqli_fetch_array(mysqli_query($conn, "SELECT firstName,lastName from userinfo WHERE id='$mid'"), MYSQLI_ASSOC);
                echo $mResult['firstName'] . " " . $mResult['lastName'];
                ?></span></h3>

            <div id="grouppStatus3">
                <h4>Do you want to stay in the group?</h4>
                <button type="button" id="buttonGroupAnswerYes" class="mediumButton" value="yes">Yes</button>
                <button type="button" id="buttonGroupAnswerNo" class="mediumButton" value="no">No</button>
            </div>
            <div id="mealStatusAnswer"></div>
        </div>
        <div id="ownGroupCreation">
            <h3>Would you  like to create your own group?</h3>
            <div id="groupCreationByUser">
                <button type="button" id="buttonGroupCreationAnswerYes" class="mediumButton" value="yes">Yes</button>
                <button type="button" id="buttonGroupCreationAnswerNo" class="mediumButton" value="no">No</button>
            </div>
        </div>

        </div>
    <div id="ownGroupCreation2">
        <?php
        /*if($resultFromUser['userGroupStatus']==0 && $resultFromUser['userStatus']==0) {
            include "groupCreation.html";
        }*/
        ?>
        <div id="groupCreation3">
        <button id='groupCreationButton' class='button'>Create a Group</button>
        <div id='groupCreation'>
            <div id='groupDetails'>
                <input type='text' id='groupName' placeholder='Enter Your Group Name' class='groupNameEntry'>
                <button id='buttonCreate' class='button'>Create</button>

            </div>
        </div>
        <div id="groupCrationAnswer">
            <span id="groupCrationAnswerSpan"></span>

        </div>
    </div>
    </div>
        <?php
    }
    else
    {
        ?>
        <h2>You are not member of any group</h2>
        <?php
        echo "";
        include "groupCreation.html";
        ?>

        <?php

    }
    ?>
</center>
<script type="text/javascript">
    $(document).ready(function() {

    });
    $(document).ready(function() {
        $("#buttonGroupCreationAnswerYes").click(function(){
            var yes=$("#buttonGroupAnswerYes").val();
            console.log(yes+" 2 Clicked");

            $("#ownGroupCreation2").show();
            $("#ownGroupCreation").fadeOut('slow');
        });
    });

    $("#ownGroupCreation").hide();
    $("#ownGroupCreation2").hide();
    $("#groupCreation").hide();

    $("#buttonGroupAnswerNo").click(function(){
        var no=$("#buttonGroupAnswerNo").val();

        alert(no+" Clicked");
        groupStatusSetNo();
        $("#ownGroupCreation").show();
        $("#grouppStatus3").fadeOut(1000);
    });
    function groupStatusSetNo() {
        var answer=$("#buttonGroupAnswerNo").val();

        $.ajax({
            type: 'POST',
            url: 'userGroupRelatedAnswer.php',
            data:"answer="+answer,
            success: function (data) {
                $("#mealStatusAnswer").html(data);

            }
            //timeout: 3000;
        });


    }

    function groupStatusSetYes() {
        var answer=$("#buttonGroupAnswerYes").val();

        $.ajax({
            type: 'POST',
            url: 'userGroupRelatedAnswer.php',
            data:"answer="+answer,
            success: function (data) {
                $("#mealStatusAnswer").text(data);
            }
            //timeout: 3000;
    });
    }
    $(document).ready(function() {
        $("#groupCreationButton").click(function() {
            $("#groupCreationButton").hide();
            $("#groupCreation").fadeToggle(2000);
            $("#groupCreation").show();
        });
    });

    $(document).ready(function() {
        $("#buttonCreate").click(function () {
            var groupName = $("#groupName").val();
            <?php $_SESSION['managerID']=$resultFromUser['id']; ?>
            $.ajax({
                type: 'POST',
                url: 'groupCreationWithAjaxJQuery.php',
                data: 'groupName=' + groupName,
                success: function (data) {
                    $("#groupCrationAnswerSpan").html(data);
                }
            });
        });
    });

    //setInterval(groupStatusSetNo,1000);
    //setInterval(groupStatusSetYes,1000));
</script>
</body>
    </html>