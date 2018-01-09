<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
<?php
/**
 * Created by PhpStorm.
 * User: Biplob
 * Date: 12/21/2017
 * Time: 5:51 PM
 */
include_once "DbFile/dbconfig.php";
include_once "sessionStartCheck.php";
$query = "select *from userinfo where id='" . $_SESSION['userID'] . "'";
$result = mysqli_query($conn, $query);
$group_id = "";
while ($row = mysqli_fetch_assoc($result)) {
    $group_id = $row['group_id'];
}
$sql = "SELECT * FROM groupFinancialData WHERE groupId='$group_id' and enteredMonth=MONTH(CURRENT_DATE)";
$cost = mysqli_query($conn, $sql);
$total = 0;
if (mysqli_num_rows($cost) > 0) {
    echo "<h1 class='text-center text-info'>Current Month Financial Info</h1>";
    echo "<table class=\"table table-bordered\">
    <thead>
      <tr>
        <th>Bill Name</th>
        <th>Bill Amount</th>
        <th>Month/Year</th>
      </tr>
    </thead><tbody>";
    while ($row = mysqli_fetch_assoc($cost)) {
        if ($row['isDeleted'] == 1) {
            echo "<tr>
        <td>" . $row['billName'] . "</td>
        <td>" . $row['billAmount'] . "</td>
        <td>" . $row['enteredMonth'] . "/" . $row['enteredYear'] . "</td>
      </tr>";
            $total = $total + $row['billAmount'];
        }
    }
    echo "</tbody>
<tfoot>
    <tr>
      <td><b>Sum</b></td>
      <td colspan='2' class='text-center'><b>".$total."</b></td>
    </tr>
  </tfoot>
</table>";
}
?>