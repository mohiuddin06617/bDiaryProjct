<html xmlns="http://www.w3.org/1999/html">
<head>
    <title></title>
<link rel="stylesheet" type="text/css" href="Resource/form_buttonDesign.css">
    <script type="text/javascript" src="//code.jquery.com/jquery-latest.js"></script>

</head>
<body>


<?php
/**
 * Created by PhpStorm.
 * User: rian
 * Date: 12/21/2016
 * Time: 1:16 PM
 */
session_start();
    class group
    {
        var $id2;
        var $value;

        function member()
        {
        }

        function profile($id/*,$email,$firstName,$lastName,$phoneNumber,$groupStatus,$userStatus*/)
        {
        }

        function getProfileData($id)

        {
            $this->id2 = $id;
            require("DbFile/dbconfig.php");
            $getData = "SELECT * from userinfo WHERE id='$id'";
            $result = mysqli_query($conn, $getData);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            echo "<table border='2' align='center' cellpadding='30' style='color: black; border-color: black;'><tr><td>Name:</td><td>"
                . $row['firstName'] . " " . $row['lastName'] . "</td></tr><tr><td>Email:</td><td>" . $row['email'] . "</td></tr><tr><td>Phone Number:</td><td>"
                . $row['phoneNumber'] . "</td></tr><tr><td>Account is Active Since</td><td>" . $row['accountCreationDate'] . "</td></tr>";

?>
    <tr>
        <td><b>Role</b></td>
        <td>

            <?php
            if($row['userStatus']==1){
                echo "Manager";
            }
            else if($row['userStatus']==0){
                echo "User";
            }
            ?>
            </td>
            </tr>
            <tr>
                <td colspan='2' align='center'><button type='button' id="buttonAddToGroup" value='yes' onclick="addToGroup()" class='button'>Add To Group</button>
                <div id="groupAddingResult"></div>

            </td>
            </tr>
            </table>
                <?php

            }
    }
            ?>


<?php

    $g = new group();
    $g->getProfileData($_SESSION['gettingID']);

?>
<script src="js/addingToGroup.js"></script>
</body>
</html>
