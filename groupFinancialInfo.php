<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-theme.css">
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<?php
/**
 * Created by PhpStorm.
 * User: Biplob
 * Date: 12/21/2017
 * Time: 5:51 PM
 */
include_once "DbFile/dbconfig.php";
include_once "sessionStartCheck.php";
$group_id = "";
$sql = "SELECT group_id FROM groupDetails WHERE manager_id='" . $_SESSION['managerID'] . "'";
$res = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($res)) {
    $group_id = $row['group_id'];
}
$managerId = $_SESSION['managerID'];
?>
<div class="row">
    <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group">
            <label class="control-label col-sm-2" for="billName">BIll Name:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="billName" id="billName" placeholder="Enter BIll Name:">
            </div>
            <div class="col-sm-4">

            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="billAmount">BIll Amount:</label>
            <div class="col-sm-6">
                <input type="number" class="form-control" name="billAmount" id="billAmount"
                       placeholder="Enter BIll Amount:">
            </div>
            <div class="col-sm-4">

            </div>
        </div>
        <div class="form-group">
            <label for="selectedMonth" class="control-label col-sm-2">Select Month:</label>
            <div class="col-sm-6">
                <select class="form-control" id="selectedMonth" name="selectedMonth">
                    <option value="1">Jan</option>
                    <option value="2">Feb</option>
                    <option value="3">Mar</option>
                    <option value="4">Apr</option>
                    <option value="5">May</option>
                    <option value="6">Jun</option>
                    <option value="7">Jul</option>
                    <option value="8">Aug</option>
                    <option value="9">Sep</option>
                    <option value="10">Oct</option>
                    <option value="11">Nov</option>
                    <option value="12">Dec</option>
                </select>
            </div>
            <div class="col-sm-4">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default" name="createBill">Submit</button>
            </div>
        </div>
    </form>
</div>

    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading text-center"><h4>Bill Details</h4></div>
        <div class="panel-body">
        <table class="table table-bordered">
            <thead>
            <tr id="deleteReply"></tr>
            <tr>
                <th>Bill Name</th>
                <th>Bill Amount</th>
                <th>Month/Year</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $sql = "SELECT * FROM groupFinancialData WHERE managerId='$managerId' and groupId='$group_id' and enteredMonth=MONTH(CURRENT_DATE)";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                // output data of each row
                while($row = mysqli_fetch_assoc($result)) {
                    if ($row['isDeleted'] == 1) {
                        echo "<tr><td>" . $row["billName"] . "</td><td>" . $row["billAmount"] . "</td><td>" . $row["enteredMonth"] . "</td>";
                        echo "<td><button class='btn btn-danger buttonDelete' id='" . $row['groupFinancialDataId'] . "'>Delete</button></td></tr>";
                    }
                }
            } else {
                echo "0 results";
            }
            ?>
            </tbody>
        </div>
    </div>

<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['createBill'])) {
        $billName = $_POST['billName'];
        $billAmount = $_POST['billAmount'];
        $selectedMonth = $_POST['selectedMonth'];
        $selectedYear = date('Y');
        $sql = "INSERT INTO groupFinancialData (billName, billAmount, managerId,groupId,enteredMonth,enteredYear)
        VALUES ('$billName','$billAmount','$managerId','$group_id', '$selectedMonth', '$selectedYear')";
        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}
?>

<script>
    $(document).ready(function(){


        $(".buttonDelete").on('click',function(){
            var id=this.id;
            deleteRecord(id);
        });

        function deleteRecord(groupFinancialDataId) {
            if(confirm("Are you sure you want to delete this row?")) {
                $.ajax({
                    url: "deleteFinancialData.php",
                    type: "POST",
                    data:'groupFinancialDataId='+groupFinancialDataId,
                    success: function(data){
                        $(this).remove();
                        $('#deleteReply').html(data);
                        location.reload();

                    },
                    error: function (request, status, error) {
                        alert(request.responseText);
                    }
                });
            }
        }
    });

</script>
