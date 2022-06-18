<?php
include_once "sessionStartCheck.php";
if (!empty($_SESSION['email'])) {
    require "DbFile/dbconfig.php";
    $manager_id = $_SESSION['managerID'];
    $group_id = $_SESSION['groupID'];
    $selectedPersonId = $_POST['selectedShopper'];
    $selectedDateString = $_POST['selectedDateForShopper'];

    $selectedDate = strtotime($selectedDateString);

    $newFormattedDate = date('Y-m-d', $selectedDate);
    $selected_date = array();


    if (empty($selectedDateString)) {
        echo "<h2>Please select a date</h2>";
    } else {
        $sqlDateDuplicateCheck = "SELECT selected_date from shoppingpersonselection WHERE manager_id='$manager_id' AND selected_date='$newFormattedDate'";
        $result = mysqli_query($conn, $sqlDateDuplicateCheck);
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
//echo $row['selected_date']."<br>";
            array_push($selected_date, $row['selected_date']);
        }
        if (mysqli_num_rows($result) > 0) {
            echo "This date shopping person already been entered by you";
        } else {
            $entry = "INSERT INTO shoppingPersonSelection(manager_id,group_id,selected_person_id,selected_date)
                VALUES ('$manager_id','$group_id','$selectedPersonId','$newFormattedDate')";
            $executeQuery = mysqli_query($conn, $entry);
            echo "<h3>Selected User Will be Notified About Shopping!</h3>";
        }
    }

} else {
    header("Location:logout.php");
}
?>
