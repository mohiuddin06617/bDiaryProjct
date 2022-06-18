<?php
include_once "sessionStartCheck.php";
?>
<!DOCTYPE html>
<html lang="en">
<?php

if (isset($_SESSION['managerID']) && !empty($_SESSION['managerID']) && $_SESSION['userStatus'] == 1 && isset($_SESSION['email'])) {
if (isset($_GET['userProfileView']))
{
include_once "profileFetch.php";
$userViewId = $_GET['userProfileView'];

$profile = new profileFetch($userViewId);
//$profile->setDesiredUserId($userViewId);

?>
<head>
    <meta charset="utf-8">
    <title>Manager Group Information</title>
    <?php
    include_once "managerHeader.php";
    ?>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="assets/css/socialMediaButtonDesign.css">
    <!--<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">-->


    <style>


    </style>

</head>
<body class="animated-content">

<header id="topnav" class="navbar navbar-default navbar-fixed-top" role="banner">

    <?php
    include_once "managerLogoSearch.php";
    ?>
    <ul class="nav navbar-nav toolbar pull-right">

        <li class="toolbar-icon-bg visible-xs-block" id="trigger-toolbar-search">
            <a href="#"><span class="icon-bg"><i class="ti ti-search"></i></span></a>
        </li>

        <li class="toolbar-icon-bg hidden-xs">
            <a href="#"><span class="icon-bg"><i class="ti ti-world"></i></span></i></a>
        </li>

        <li class="toolbar-icon-bg hidden-xs">
            <a href="#"><span class="icon-bg"><i class="ti ti-view-grid"></i></span></i></a>
        </li>

        <li class="toolbar-icon-bg hidden-xs" id="trigger-fullscreen">
            <a href="#" class="toggle-fullscreen"><span class="icon-bg"><i class="ti ti-fullscreen"></i></span></i>
            </a>
        </li>

        <?php
        include_once "managerMessage.php";
        include_once "managerNotification.php";
        include_once "managerOptionTopNav.php";
        ?>
    </ul>

</header>

<div id="wrapper">
    <div id="layout-static">
        <div class="static-sidebar-wrapper sidebar-default">
            <div class="static-sidebar">
                <?php
                include_once "managerSideNavBar.php";
                ?>
            </div>
        </div>

        <div class="static-content-wrapper">
            <div class="static-content">
                <div class="page-content">
                    <ol class="bre">
                    </ol>
                    <div class="panel panel-default black-text-color">
                        <div class="panel-heading">
                            <h2>About</h2>
                            <h3 class="hidden" id="addResult"></h3>
                        </div>
                        <div class="panel-body">
                            <div class="about-area">
                                <h2 class="black-text-color"><b><?=$profile->getFullName()?></b></h2>
                                <img src="Resource/LuffyImage2.png" class="img-responsive pull-right" width="200px" height="100px">
                                <p><?php

                                    if (!empty($profile->getShortDescription())) {
                                        echo $profile->getShortDescription();

                                    } else {
                                        echo "No Short Description To Show !";
                                    }
                                    ?></p>
                                <?php
                                if($profile->getUserGroupStatus()==null) {

                                    ?>
                                    <button class="btn btn-purple btn-lg" id="managerGroupAddButton" value="<?=$userViewId?>">Add To My Group</button>
                                    <div class="extra"></div>
                                    <?php
                                }
                                ?>

                            </div>
                            <div class="about-area">
                                <h4>Basic Information</h4>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <th>Email</th>
                                            <td><a href="#"><?php
                                                    if (!empty($profile->getEmail())) {
                                                        echo $profile->getEmail();
                                                    } else {
                                                        echo "No Data Entered Yet!";
                                                    }
                                                    ?><?php

                                                    ?></a></td>

                                        </tr>

                                        <tr>
                                            <th>Group Name</th>
                                            <td>
                                                <?php
                                                if (!empty($profile->getGroupName())) {
                                                    echo $profile->getGroupName();

                                                } else {
                                                    echo "Not a member of any group!";
                                                }
                                                ?>
                                            </td>

                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td><?php
                                                if (!empty($profile->getUserGroupStatus()) && ($profile->getUserGroupStatus())) {
                                                    echo "Already a Member Of a Group";

                                                } else {
                                                    echo "No Data Entered Yet!";
                                                }
                                                ?>
                                            </td>

                                        </tr>
                                        <tr>
                                            <th>Social</th>
                                            <td>
                                                <ul class="list-inline m-n">
                                                    <li><a href="#"><i
                                                                    class="ti ti-pinterest"></i></a>
                                                    </li>
                                                    <li><a href="#"><i
                                                                    class="ti ti-twitter"></i></a>
                                                    </li>
                                                    <li><a href="#"><i class="ti ti-google"></i></a>
                                                    </li>
                                                    <li><a href="#"><i
                                                                    class="ti ti-linkedin"></i></a>
                                                    </li>
                                                    <li><a href="#"><i
                                                                    class="ti ti-dribbble"></i></a>
                                                    </li>
                                                    <li><a href="#"><i
                                                                    class="ti ti-facebook"></i></a>
                                                    </li>
                                                </ul>
                                            </td>

                                        </tr>
                                        <tr>
                                            <th>Gender</th>
                                            <td>
                                                <?php
                                                if (!empty($profile->getGender())) {
                                                    echo $profile->getGender();

                                                } else {
                                                    echo "No Data Entered Yet!";
                                                }
                                                ?>
                                            </td>

                                        </tr>
                                        <tr><th></th><td><a href="groupDetailsManager.php" class="btn btn-info white-text-color">Back To Group</a></td></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!--<div class="about-area">
                                <h4>Personal Information</h4>
                                <div class="table-responsive">
                                    <table class="table about-table">
                                        <tbody>
                                        <tr>
                                            <th>Full Name</th>
                                            <td>
                                                <?php
/*                                                if (!empty($profile->getFullName())) {
                                                    echo $profile->getFullName();

                                                } else {
                                                    echo "No Data Entered Yet!";
                                                }
                                                */?>
                                            </td>

                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once "managerSwitchCode.html";
include_once "managerJSPlaugin.html";
?>
<script src="assets/js/statusManagement.js"></script>
<script src="profile.js"></script>


<?php
}
else {
    header("Location:groupDetailsManager.php");
}
}
else {
    header("Location:logout.php");
}

?>
</body>
</html>
