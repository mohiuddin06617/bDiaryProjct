<!DOCTYPE html>
<html>
<head>
    <?php
    session_start();
    if (!empty($_SESSION['email'])){
    $email = $_SESSION['email'];
    include "DbFile/dbconfig.php";
    $row = mysqli_fetch_array(mysqli_query($conn, "SELECT * from userinfo where email='$email'"), MYSQLI_ASSOC);
    echo "<title>" . $row['firstName'] . "s Profile</title>";

    ?>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/css/dashboard.css">
    <link rel="stylesheet" type="text/css" href="Resource/pageLayout.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</head>
<body>
<?php
if (isset($_SESSION['email'])){
$email = $_SESSION['email'];
?>
<div class="container">

    <!-- <header>
         <div class="inline">
             <a href="managerHome.php"><img src="Resource/projectIcon.png" class="nav pull-left" alt="logo" id="imageLogo"></a>
         </div>
         <div class="nav navbar-fixed-top">
             <input type="text" id="searchAllUser" name="searchAllUser" style="border-color:#f4511e;" placeholder="Enter Your Search" onfocus="search()">
             <img src="Resource/searchIcon.png" onclick="searchClicked()" alt="Search" id="searchIcon">
             <div id="result"></div>
         </div>
         <div class="nav navbar-static-top inline btn btn-toolbar pull-right" id="logout"><a href="logout.php">Logout</a> </div>
         </div>
     </header>-->
    <?php
    include_once "managerHeader.php";
    ?>

    <?php
    include_once "managerSidebar.php";
    ?>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <iframe height="500px" width="100%" src="" name="iframe_all">
            <div id="iframe_id"></div>
        </iframe>
    </div>
    <?php
    }
    else {
        header("Location:logout.php");
    }
    ?>
    <script>
        $(document).ready(function () {
            function search() {
                var searchQuery = $("#searchAllUser").val();
                if (searchQuery !== "") {
                    //$("#result").html("<img alt="Searching" src='Resource/ajax-loader.gif'/>");
                    $.ajax({
                        type: "POST",
                        url: "searchBarCode.php",
                        data: "searchQuery=" + searchQuery,
                        success: function (data) {
                            $("#result").html(data);

                        },
                        window.setInterval(search, 3000);
                })
                    ;
                }
                //document.getElementById("result").innerHTML="Search has coming handy";
                console.log("Search have come in handy");
            }

            $("#searchIcon").click(function () {
                search();
            });
            $("#searchAllUser").keyup(function () {
                search();
            });
        });
    </script>

    <?php
    }
    else {
        header("Location:logout.php");
    }

    ?>
</body>
</html>
