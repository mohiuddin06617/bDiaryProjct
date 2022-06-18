<?php
   /* $url = "";
    $url != 'http://localhost/practice/bDiary/userStatus.php';




    if ($_SERVER['HTTP_REFERER'] == $url){
        die("Direct Access Not Permitted");
    }*/

/*$protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') ===
FALSE ? 'http' : 'https';            // Get protocol HTTP/HTTPS
$host     = $_SERVER['HTTP_HOST'];   // Get  www.domain.com
$script   = $_SERVER['SCRIPT_NAME']; // Get folder/file.php
$params   = $_SERVER['QUERY_STRING'];// Get Parameters occupation=odesk&name=ashik

$currentUrl = $protocol . '://' . $host . $script . $params; // Adding all

if($currentUrl==='http://localhost/practice/bDiary/userStatus.php'){
    die("Direct Access Not Permitted");
}
*/

?>
    <!DOCTYPE html>
    <html>
    <head>
        <title></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
    </head>
    <body>
    <div id="showUserTotalCost"></div>
    <?php
    session_start();

    /**
     * Created by PhpStorm.
     * User: REX
     * Date: 1/14/2017
     * Time: 2:06 PM
     */
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
    </body>
    </html>