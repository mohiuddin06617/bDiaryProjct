<?php
include_once "sessionStartCheck.php";
?>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-theme.css">
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<?php

include_once "DbFile/dbconfig.php";
$sql = "SELECT isDeleted,entry_time_date,user_id,quantity,SUM(item_price) AS item_p
                                  from userdailycost WHERE manager_id='" . $_SESSION['managerID'] . "' and MONTH(str_to_date(entry_time_date,'%m/%d/%Y'))=MONTH(CURDATE()) GROUP BY entry_time_date";
/*$sql="SELECT group_id,item_name,item_price,quantity from userdailycost WHERE manager_id='".$_SESSION['managerID']."'";*/
$result = mysqli_query($conn, $sql);
$n = 1;
echo "<table class=\"table table-bordered\">
    <thead>
      <tr>
      <th colspan='4'><h1 class='text-center'>Current Month Bazar Details</h1></th>
</tr>
      <tr>
        <th>Item</th>
        <th>Price</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      
    ";
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

        if ($row['isDeleted']==1) {
            echo "<tr><td>" . $row['entry_time_date'] . " </td>";

            echo "<td>" . $row['item_p'] . "</td>";
            echo "<td><button class='btn btn-danger buttonDelete' id='" . $row['entry_time_date'] . "'>Delete</button></td></tr>";
            $n++;
        }
    }
    echo "</tbody>
  </table>";
} else {
    echo "<h3 class='text-warning'>No Data Available </h3>";
}
?>
<script>
    $(document).ready(function(){


        $(".buttonDelete").on('click',function(){
            var id=this.id;
            deleteRecord(id);
        });

        function deleteRecord(id) {
            if(confirm("Are you sure you want to delete this row?")) {
                $.ajax({
                    url: "deleteBazarDetails.php",
                    type: "POST",
                    data:'id='+id,
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
