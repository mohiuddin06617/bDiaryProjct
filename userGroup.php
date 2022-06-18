<?php
include_once "sessionStartCheck.php";

?>
<!DOCTYPE html>
<html lang="en">

<?php
if (isset($_SESSION['userID']) && $_SESSION['userStatus'] == 0 && isset($_SESSION['email'])) {
    ?>
    <head>
        <meta charset="utf-8">
        <title>User Group Details</title>
        <style>
            .list-group-item:hover {
                background-color: #f5f5f5;
            }
        </style>
        <?php
        include_once "userHeader.php";
        include_once "userGroupFetch.php";
        $groupDetailsFetch = new userGroupFetch();
        ?>


        <link rel="stylesheet" type="text/css" href="assets/css/inputDesign.css">

        <!-- Some Problem With DatePicker in customTableDesign-->
        <link rel="stylesheet" type="text/css" href="assets/css/customTableDesign.css">
        <link rel="stylesheet" type="text/css" href="assets/css/profileCardDesign.css">
        <link rel="stylesheet" type="text/css" href="assets/css/buttonDesign.css">
        <link rel="stylesheet" type="text/css" href="assets/css/socialMediaButtonDesign.css">
        <link rel="stylesheet" type="text/css" href="assets/fonts/font-awesome/css/font-awesome.min.css">


        <!-- External checkbox,modal and Input Design -->

        <style>
            @media screen and (min-width: 760px) {
                #groupMenuTabNav {
                    margin-top: 15%;
                }
            }

            #groupMenuTabNav {
                color: black;
            }

            table, tr, thead, th, td {
                border: 1px solid wheat;
            }

            .black-color {
                color: black;
            }
        </style>
    </head>

    <body class="animated-content">

    <header id="topnav" class="navbar navbar-default navbar-fixed-top" role="banner">
        <?php
        include_once "userLogoSearch.php";
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
            include_once "userMessage.php";
            ?>
            <?php
            include_once "userNotification.php";
            ?>
            <?php
            include_once "userOptionTopNav.php";
            ?>
        </ul>

    </header>
    <div id="wrapper">
        <div id="layout-static">
            <div class="static-sidebar-wrapper sidebar-default">
                <div class="static-sidebar">
                    <?php
                    include_once "userSideNavBar.php";
                    ?>
                </div>
            </div>


            <div class="static-content-wrapper">
                <div class="static-content">
                    <?php
                    if (isset($_SESSION['groupID'])) {
                        ?>
                        <div class="page-content">
                            <ol class="breadcrumb">

                                <li class="active"><a href="userHome.php">Home</a></li>
                                <li class="active"><a href="userGroup.php"> User Group Details</a></li>

                            </ol>

                            <div class="container-fluid">
                                <div class="row">

                                    <div class="col-lg-3 col-md-3 col-sm-3" id="groupMenuTabNav">
                                        <!-- panel -->
                                        <div class="list-group list-group-alternate mb-n nav nav-tabs">
                                            <div class="panel panel-profile">
                                                <div class="panel-body">
                                                    <a href="userGroup.php" style="font-size: 25px;"
                                                       class="text-primary">
                                                        <?= $groupDetailsFetch->getGroupName(); ?></a>
                                                </div>
                                            </div>
                                            <hr>
                                            <a href="#tab-details" role="tab" data-toggle="tab"
                                               class="list-group-item active">
                                                <i class="fa fa-info-circle"></i>Group Details <!--<span
                                                        class="badge badge-primary">80%</span>--></a>
                                            <a href="#tab-member" role="tab" data-toggle="tab" class="list-group-item">
                                                <i class="fa fa-users"></i> Members</a>
                                        </div>

                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab-details">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h1 class="text-center black-color"><span
                                                                    style="font-family: Impact;"><?= $groupDetailsFetch->getGroupName(); ?></span>
                                                        </h1>
                                                    </div>
                                                    <div class="panel-body">
                                                        <div class="about-area">
                                                            <div class="dropdown pull-right">
                                                                <button class="btn btn-danger dropdown-toggle"
                                                                        type="button" data-toggle="dropdown"><i
                                                                            class="fa fa-cog"></i> Settings
                                                                    <span class="caret"></span></button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a href="#"><i
                                                                                    class="fa fa-exclamation-triangle"></i>
                                                                            Change Manager</a></li>
                                                                    <li class="divider"></li>
                                                                    <li><a class="btn btn-link" id="leaveGroup"><i
                                                                                    class="fa fa-flag-checkered"></i>
                                                                            Leave Group</a></li>
                                                                </ul>
                                                            </div>
                                                            <h3><span class="black-color">Description </span>
                                                            </h3>
                                                            <p><?= $groupDetailsFetch->getGroupDescription(); ?></p>

                                                        </div>
                                                        <div class="about-area">
                                                            <h4>Basic Information</h4>
                                                            <div class="table table-bordered black-color">
                                                                <table class="table">
                                                                    <tbody>
                                                                    <tr>
                                                                        <th>House Address</th>
                                                                        <td> <?= $groupDetailsFetch->getHouseAddress(); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Total Member</th>
                                                                        <td><?= $groupDetailsFetch->getTotalMember(); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Maid Name</th>
                                                                        <td><?= $groupDetailsFetch->getMaidName(); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Maid Phone</th>
                                                                        <td><?= $groupDetailsFetch->getMaidPhone(); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Maid Address</th>
                                                                        <td><?= $groupDetailsFetch->getMaidAddress(); ?></td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane" id="tab-member">
                                                <div class="panel panel-primary"
                                                     data-widget='{"draggable": "false"}'>
                                                    <div class="row">
                                                        <div class="panel-heading">
                                                            <div class="panel-ctrls"
                                                                 data-actions-container=""
                                                                 data-action-collapse='{"target": ".panel-body"}'>
                                                            </div>
                                                            <h3 class="text-center"
                                                                style="color: white; font-size: 25px;">
                                                                <i class="fa fa-user-secret fa-lg"></i> Manager </h3>
                                                        </div>
                                                    </div>
                                                    <div class="panel-body">
                                                        <div class="row">
                                                            <div class="col-lg-2 col-md-2 col-sm-1 col-xs-0"></div>
                                                            <div class="col-lg-8 col-md-8 col-sm-10 col-xs-12">
                                                                <div class="card">
                                                                    <img src="Resource/LuffyImage2.png" class="card-img"
                                                                         style="width:100%">
                                                                    <div class="card-container">
                                                                        <h3 class="text-primary"><a
                                                                                    href="userProfile.php"><?= $groupDetailsFetch->getManagerName(); ?></a>
                                                                        </h3>
                                                                        <p class="card-title"><?= $groupDetailsFetch->getManagerEmail(); ?></p>
                                                                        <p><?= $groupDetailsFetch->getManagerPhoneNumber(); ?></p>

                                                                        <div>
                                                                            <a href="https://www.facebook.com"
                                                                               target="_parent">
                                                                                <i class="fa fa-facebook socialButton"></i></a>
                                                                            <a href="#"><i
                                                                                        class="fa fa-twitter socialButton"></i></a>
                                                                            <a href="#"><i
                                                                                        class="fa fa-linkedin socialButton"></i></a>
                                                                            <a href="#"><i
                                                                                        class="fa fa-google-plus socialButton"></i></a>
                                                                        </div>
                                                                        <p>
                                                                            <button class="btn btn-getting btn-lg">
                                                                                Message
                                                                            </button>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2 col-md-2 col-sm-1 col-xs-0"></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="panel panel-primary" data-widget='{"draggable": "false"}'>
                                                    <div class="panel-heading">
                                                        <div class="panel-ctrls" data-actions-container=""
                                                             data-action-collapse='{"target": ".panel-body"}'></div>
                                                        <h3 class="text-center" style="color: papayawhip;"><i
                                                                    class="fa fa-group"></i> Group Members List</h3>
                                                    </div>
                                                    <div class="panel-body">
                                                        <div class="row">
                                                            <?php
                                                            foreach ($groupDetailsFetch->getMemberList() as $item) {
                                                                $memberFullName = ucwords($item['firstName'] . " " . $item['lastName'] . " ");
                                                                $memberEmail = $item['email'];
                                                                $memberPhoneNumber = $item['phoneNumber'];
                                                                ?>
                                                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                                    <div class="card">
                                                                        <img src="Resource/LuffyImage2.png"
                                                                             class="card-img"
                                                                             style="width:100%">
                                                                        <div class="card-container">
                                                                            <h3 class="text-primary"><a
                                                                                        href="userProfile.php"><?= $memberFullName; ?></a>
                                                                            </h3>
                                                                            <p class="card-title"><?= $memberEmail ?></p>
                                                                            <p><?= $memberPhoneNumber ?></p>
                                                                            <div style="margin: 10px 0;">
                                                                                <a href="#"><i
                                                                                            class="fa fa-dribbble fa-lg socialButton"></i></a>
                                                                                <a href="#"><i
                                                                                            class="fa fa-twitter fa-lg socialButton"></i></a>
                                                                                <a href="#"><i
                                                                                            class="fa fa-linkedin fa-lg socialButton"></i></a>
                                                                                <a href="#"><i
                                                                                            class="fa fa-facebook fa-lg socialButton"></i></a>
                                                                            </div>
                                                                            <p>
                                                                                <button class="btn btn-getting btn-lg">
                                                                                    Message
                                                                                </button>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- .tab-content -->
                                    </div>
                                    <!-- col-sm-8 -->
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    elseif (isset($_SESSION['userID']) && isset($_SESSION['email'])) {
                    require_once "groupCreation.php";
                    ?>
                        <script src="assets/js/jquery-3.2.1.min.js"></script>
                        <script src='groupCreation.js'></script>

                        <?php
                        echo "</head>";
                    }
                    ?>
                    <?php
                    include_once "switcherCode.html";
                    ?>
                </div>
            </div>
        </div>
    </div>


    <?php
    include_once "commonPlugin.html";
    ?>
    <script type="text/javascript" src="assets/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="userGroup.js"></script>

    </body>
    <?php
} else {
    header("location:logout.php");
}
?>

</html>


<?php
/**
 * Created by PhpStorm.
 * User: rian
 * Date: 1/15/2017
 * Time: 4:44 PM
 */

/*  include "DbFile/dbconfig.php";

          $getGroupIdQ="SELECT group_id from userinfo WHERE email='".$_SESSION['email']."'";
          $getGroupId=mysqli_fetch_array(mysqli_query($conn,$getGroupIdQ));
          $gId=$getGroupId['group_id'];

  $getGroupNameQ="SELECT group_name from groupDetails WHERE group_id='$gId'";
  $groupName=mysqli_fetch_array(mysqli_query($conn,$getGroupNameQ));
  echo "<center><h3>Group Name: </h3>".$groupName['group_name']."<br>";

  $groupMateQ="SELECT userStatus,firstName,lastName from userinfo WHERE group_id='$gId'";
  $result=mysqli_query($conn,$groupMateQ);
  echo "<h3>Group Member:</h3>";
  while($row=mysqli_fetch_assoc($result)) {
      if ($row['userStatus'] == 1) {
          echo "<b>Manager: </b>" . $row['firstName'] . " " . $row['lastName'] . "<br>";
      } else if ($row['userStatus'] == 0) {
          echo "<b>Member : </b>".$row['firstName'] . " " . $row['lastName'] . "<br>";
      }
  }
  echo "<br><br><br><br><a href='userHome.php'><button>Back To Home</button></a>";
  echo "</center>";*/


?>
