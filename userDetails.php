<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
<?php
/**
 * Created by PhpStorm.
 * User: Biplob
 * Date: 12/23/2017
 * Time: 6:36 PM
 */

if (isset($_GET['userShowId'])){
    include_once "DbFile/dbconfig.php";
    include_once "sessionStartCheck.php";
    $userShowId=$_GET['userShowId'];
    $query="select * from userinfo where id='".$userShowId."'";
    $result=mysqli_query($conn,$query);
    $groupStat="";
    if (mysqli_num_rows($result)) {
        echo "<table class=\"table table-bordered\">
    <thead>
    <tr>
    <th id='addReply'></th>
</tr>
      <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
      </tr>
    </thead>";
        while ($row = mysqli_fetch_assoc($result)) {

            $groupStat=$row['group_id'];
            echo "<tr><td>".$row['firstName'] . "</td><td> " . $row['lastName'] . "</td><td> " . $row['email']."</td></tr>";
        }
        echo "</tbody>
  </table>";
        if ($groupStat==0) {
            ?>
            <form  name="addToGroupForm">
                <input type="hidden" id="userShowId" value="<?=$userShowId?>">
                <button type="button" name="addToGroup" class='btn btn-primary addToGroup' id="<?=$userShowId?>"> Add To Group</button>
            </form>

            <?php
        }
        else{
            echo "<h3 class='text-danger'>Already a member of a group! Please Ask Him to Leave the current group</h3>";
        }
    }
}
?>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function(){


        $(".addToGroup").on('click',function(){
            var id=this.id;
            updateRecord(id);
        });

        function updateRecord(addToGroupId) {
            if(confirm("Are you sure you want to Add Him in the group?")) {
                $.ajax({
                    url: "addingToGroup.php",
                    type: "POST",
                    data:'addToGroupId='+addToGroupId,
                    success: function(data){
                        $(this).remove();
                        $('#addReply').html(data);
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
