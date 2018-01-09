<!DOCTYPE html>
<html>
<head>

</head>
<body>
<?php
session_start();
if(!empty($_SESSION['email'])) {
    require "DbFile/dbconfig.php";
    /**
     * Created by PhpStorm.
     * User: rian
     * Date: 1/4/2017
     * Time: 1:18 AM
     */

    $manager_id = $_SESSION['managerID'];

    $selectedPersonId = $_POST['selectedPersonID'];
    $selectedDateString = $_POST['selectedDate'];

    $selectedDate = strtotime($selectedDateString);

    $newFormattedDate = date('Y-m-d',$selectedDate);
        $selected_date=array();
    if (empty($selectedDateString)) {
        echo "<b>Please select a date</b>";
    } else {
        $sqlDateDuplicateCheck="SELECT selected_date from shoppingpersonselection WHERE manager_id='$manager_id' AND selected_date='$newFormattedDate'";
        $result=mysqli_query($conn,$sqlDateDuplicateCheck);
        while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
//echo $row['selected_date']."<br>";
        array_push($selected_date,$row['selected_date']);
        }

        print_r($selected_date);
        if ( mysqli_num_rows ( $result ) > 0 ){
            echo "This date shopping person already been enterted by you";
        }
        else{
            $entry = "INSERT INTO shoppingPersonSelection(manager_id,selected_person_id,selected_date)
                VALUES ('$manager_id','$selectedPersonId','$newFormattedDate')";
            $executeQuery = mysqli_query($conn, $entry);
            echo "<h3>Selected User Will be Notified About Shopping!</h3>";
        }
    }
}
else{
    header("Location:logout.php");
}
?>
</body>
</html>
