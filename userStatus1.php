
    <div id="showUserTotalCost"></div>
    <?php
    session_start();

    $current_user_id = $_SESSION['userID'];
    $current_user_email = $_SESSION['email'];


    require_once("DbFile/dbconfig.php");
    $sql = "SELECT userGroupStatus FROM userinfo WHERE email='" . $current_user_email . "'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['userGroupStatus'] == 0)
                    {

                ?>
                <h1>You are not member of any group. <br>Please Enter into a group or Create a Group</h1>
                <?php
                    }
                }
            }
    else
    {
        echo "0 results";
    }

    mysqli_close($conn);

    ?>
    <span id='user_id'><?php echo $_SESSION['userID']; ?></span>;
    <script>
        $("#user_id").hide();
        $(document).ready(function () {

            function getUserCost()
            {
                var id = $("#user_id").text();
                $.ajax(
                    {
                    type: 'POST',
                    url: 'getTotalCost.php',
                    data: 'id=' + id,
                    success: function (response)
                        {
                        $("#showUserTotalCost").html(response);
                        }
                    }
                );
            }

            setInterval(getUserCost,2000);
        });
    </script>
