
<!DOCTYPE html>
<head>
    <style>
        /* .bdiaryIcon{
             float: left;
             margin-left: -8px;
             margin-top: 2px;
             padding-right: 1px;
             position: absolute;
         }*/
    </style>
    <?php
    session_start();
    if(!empty($_SESSION['email'])){
    $email=$_SESSION['email'];
    include "DbFile/dbconfig.php";
    $row=mysqli_fetch_array(mysqli_query($conn,"SELECT * from userinfo where email='$email'"),MYSQLI_ASSOC);
    echo "<title>".$row['firstName']." 's Home</title>";
    ?>
    <meta name="description" content="Write some words to describe your html page">
    <meta name="viewport" content="width=device-width, initial-scale=1" charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="Resource/pageLayout.css">
    <link rel="stylesheet" type="text/css" href="Resource/form_buttonDesign.css">
    <link rel="stylesheet" type="text/css" href="Resource/userHomeLayout.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-latest.js"></script>

    <script src="js/userHomeJS.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body>
<div id="container">
    <header>
        <div class="inline">
            <a href="userHome.php" class="bdiaryIcon"><img src="Resource/projectIcon.png" alt="logo" id="imageLogo"></a>
        </div>
        <div class="inline">
            <input type="text" id="searchAllUser" name="searchAllUser" style="border-color:#f4511e;" placeholder="Enter Your Search">
            <img src="Resource/searchIcon.png" onclick="searchClicked()" alt="Search" id="searchIcon">
        </div>

        <div class="inline" id="messageIcon"><img src="Resource/messageIcon.png"></div>
        <div class="inline" id="notificationIcon"><img src="Resource/" alt="Notification"></div>
        <div class="inline" id="logout"><a href="logout.php">Logout</a> </div>
    </header>
</div>
<nav>
    <ul>
        <li><a href="userMeal.php" target="iframe_user_all">Confirm Your Meal?</a>
        <li><a href="userShoppingCost.php" target="iframe_user_all">Enter Today's Shopping Cost</a></li>
        <li><a href="userFoodMenu.php" target="iframe_user_all">Today's Food Menu</a></li>
        <li><a href="showShoppingDateToUser.php" target="iframe_user_all">Show Shopping Date</a></li>
        <li><a href="whatsnew.php" target="iframe_user_all">Group Details</a></li>
        <li><a href="profileForUser.php" target="iframe_user_all"><?php
                include "DbFile/dbconfig.php";
                $row=mysqli_fetch_array(mysqli_query($conn,"SELECT id,firstname,lastname from userinfo where email='$email'"));echo $row['firstname']." ".$row['lastname'];
                ?>
            </a>
        </li>
    </ul>
</nav>

<article>
    <p><iframe height="400px" width="70%" src="userStatus.php" name="iframe_user_all"></iframe></p>

</article>

<!--
<footer>Copyright &copy; Dreamer's Space Ltd.<?php
/*    var_dump($_COOKIE);
    */?>
</footer>-->


</div>
<?php
}
else
{
    header("Location:logout.php");
}
?>
</body>
<script>

    /*function loadShoppingData() {

     $.ajax({
     url: 'showShoppingDateToUser.php',
     success:function(response){
     $("#showShoppingPerson2").html(response);
     },
     complete: function() {

     }

     });
     }*/
</script>
</html>



