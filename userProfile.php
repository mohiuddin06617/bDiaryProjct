<?php
include_once "sessionStartCheck.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <?php
    if ((isset($_SESSION['userID']) && isset($_SESSION['email']) && $_SESSION['userStatus']) == 0) {
    include_once "userProfileFetch.php";
    $profileForFetch = new userProfileFetch();
    $email = $_SESSION['email'];
    echo "<title>" . $profileForFetch->getFullName() . "'s Profile</title>";

    ?>
    <?php
    include_once "userHeader.php";
    ?>

    <!-- The following CSS are included as plugins and can be removed if unused-->

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
                <div class="page-content">
                    <ol class="breadcrumb">

                        <li><a href="index.html">Home</a></li>
                        <li class="active"><a href="userProfile.php">Profile</a></li>

                    </ol>
                    <div class="container-fluid">

                        <div data-widget-group="group1">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="panel panel-profile">
                                        <div class="panel-body">
                                            <img src="Resource/cd-avatar.png" class="img-circle">
                                            <div class="name"><?php echo $profileForFetch->getFullName(); ?></div>
                                            <div class="info"><?= $email ?></div>
                                            <ul class="list-inline text-center">
                                                <li>
                                                    <a href="#" class="profile-facebook-icon">
                                                        <i class="ti ti-facebook"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" class="profile-twitter-icon">
                                                        <i class="ti ti-twitter"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" class="profile-dribbble-icon">
                                                        <i class="ti ti-dribbble"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div><!-- panel -->
                                    <div class="list-group list-group-alternate mb-n nav nav-tabs black-text-color">
                                        <a href="#tab-about" role="tab" data-toggle="tab"
                                           class="list-group-item active black-text"><i class="ti ti-user"></i> About
                                            <!--<span class="badge badge-primary">80%</span>--></a>
                                        <a href="#tab-edit" role="tab" data-toggle="tab" class="list-group-item"><i
                                                    class="fa fa-pencil"></i> Edit</a>
                                        <!-- <a href="#tab-timeline" role="tab" data-toggle="tab" class="list-group-item"><i
                                                     class="ti ti-time"></i> Timeline</a>
                                         <a href="#tab-projects" role="tab" data-toggle="tab" class="list-group-item"><i
                                                     class="ti ti-view-list-alt"></i> Projects</a>
                                         <a href="#tab-photos" role="tab" data-toggle="tab" class="list-group-item"><i
                                                     class="ti ti-view-grid"></i> Photos</a>-->

                                    </div>
                                </div><!-- col-sm-3 -->
                                <div class="col-sm-9">
                                    <div class="tab-content">
                                        <!--<div class="tab-pane" id="tab-projects">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h2>Projects</h2>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table m-n">
                                                            <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Project Title</th>
                                                                <th>Description</th>
                                                                <th>Progress</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <th scope="row">1.</th>
                                                                <td><strong>Avenxo</strong></td>
                                                                <td>Lorem ipsum dolor sit amet, consectetuer adipiscing
                                                                    elit
                                                                </td>
                                                                <td class="vam">
                                                                    <div class="progress m-n">
                                                                        <div class="progress-bar progress-bar-success"
                                                                             style="width: 20%"></div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">2.</th>
                                                                <td><strong>Phoenix</strong></td>
                                                                <td>Lorem ipsum dolor sit amet, consectetuer adipiscing
                                                                    elit
                                                                </td>
                                                                <td class="vam">
                                                                    <div class="progress m-n">
                                                                        <div class="progress-bar progress-bar-success"
                                                                             style="width: 50%"></div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">3.</th>
                                                                <td><strong>Arvin</strong></td>
                                                                <td>Lorem ipsum dolor sit amet, consectetuer adipiscing
                                                                    elit
                                                                </td>
                                                                <td class="vam">
                                                                    <div class="progress m-n">
                                                                        <div class="progress-bar progress-bar-success"
                                                                             style="width: 10%"></div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">4.</th>
                                                                <td><strong>Flip3</strong></td>
                                                                <td>Lorem ipsum dolor sit amet, consectetuer adipiscing
                                                                    elit
                                                                </td>
                                                                <td class="vam">
                                                                    <div class="progress m-n">
                                                                        <div class="progress-bar progress-bar-success"
                                                                             style="width: 75%"></div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">5.</th>
                                                                <td><strong>Appboom</strong></td>
                                                                <td>Lorem ipsum dolor sit amet, consectetuer adipiscing
                                                                    elit
                                                                </td>
                                                                <td class="vam">
                                                                    <div class="progress m-n">
                                                                        <div class="progress-bar progress-bar-success"
                                                                             style="width: 25%"></div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">6.</th>
                                                                <td><strong>Xavant</strong></td>
                                                                <td>Lorem ipsum dolor sit amet, consectetuer adipiscing
                                                                    elit
                                                                </td>
                                                                <td class="vam">
                                                                    <div class="progress m-n">
                                                                        <div class="progress-bar progress-bar-success"
                                                                             style="width: 15%"></div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>--> <!-- #tab-projects -->

                                        <div class="tab-pane active" id="tab-about">
                                            <div class="panel panel-default black-text-color">
                                                <div class="panel-heading">
                                                    <h2>About</h2>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="about-area">
                                                        <h3>Bio <a class="btn btn-link" href="#tab-edit"
                                                                   role="tab" data-toggle="tab">Edit</a></h3>
                                                        <p><?php
                                                            if (!empty($profileForFetch->getShortDescription())) {
                                                                echo $profileForFetch->getShortDescription();

                                                            } else {
                                                                echo "No Data Entered Yet!";
                                                            }
                                                            ?></p>
                                                        <p>

                                                        </p>

                                                    </div>
                                                    <div class="about-area">
                                                        <h4>Basic Information</h4>
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <tbody>
                                                                <tr>
                                                                    <th>Email</th>
                                                                    <td><a href="#"><?php
                                                                            echo $email;
                                                                            ?></a></td>
                                                                    <td>
                                                                        <a class="btn btn-link" href="#tab-edit"
                                                                           role="tab" data-toggle="tab">Edit</a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Phone</th>
                                                                    <td>+880<?php
                                                                        if (!empty($profileForFetch->getPhoneNumber())) {
                                                                            echo $profileForFetch->getPhoneNumber();
                                                                        } else {
                                                                            echo "No Data Entered Yet!";
                                                                        }
                                                                        ?></td>
                                                                    <td>
                                                                        <a class="btn btn-link" href="#tab-edit"
                                                                           role="tab" data-toggle="tab">Edit</a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Group Name</th>
                                                                    <td>
                                                                        <?php
                                                                        if (!empty($profileForFetch->getGroupName())) {
                                                                            echo $profileForFetch->getGroupName();

                                                                        } else {
                                                                            echo "<strong>You are not a member of a group!</strong>";
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Status</th>
                                                                    <td><?php
                                                                        if (!empty($profileForFetch->getUserGroupStatus())) {
                                                                            echo $profileForFetch->getUserGroupStatus();

                                                                        } else {
                                                                            echo "<strong>You are not a member of a group!</strong>";
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td>
                                                                        <a class="btn btn-link"
                                                                           href="userGroup.php">Edit</a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>You are Member Since</th>
                                                                    <td><?php
                                                                        if (!empty($profileForFetch->getAccountCreationDate())) {
                                                                            echo $profileForFetch->getAccountCreationDate();

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
                                                                    <td>
                                                                        <a class="btn btn-link" href="#tab-edit"
                                                                           role="tab" data-toggle="tab">Edit</a>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="about-area">
                                                        <h4>Personal Information</h4>
                                                        <div class="table-responsive">
                                                            <table class="table about-table">
                                                                <tbody>
                                                                <tr>
                                                                    <th>Full Name</th>
                                                                    <td>
                                                                        <?php
                                                                        if (!empty($profileForFetch->getFullName())) {
                                                                            echo $profileForFetch->getFullName();

                                                                        } else {
                                                                            echo "No Data Entered Yet!";
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td>
                                                                        <a class="btn btn-link" href="#tab-edit"
                                                                           role="tab" data-toggle="tab">Edit</a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Birth Date</th>
                                                                    <td>
                                                                        <?php
                                                                        if (!empty($profileForFetch->getBirthDate())) {
                                                                            echo $profileForFetch->getBirthDate();

                                                                        } else {
                                                                            echo "No Data Entered Yet!";
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td>
                                                                        <a class="btn btn-link" href="#tab-edit"
                                                                           role="tab" data-toggle="tab">Edit</a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Gender</th>
                                                                    <td>
                                                                        <?php
                                                                        if (!empty($profileForFetch->getGender())) {
                                                                            echo $profileForFetch->getGender();

                                                                        } else {
                                                                            echo "No Data Entered Yet!";
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td>
                                                                        <a class="btn btn-link" href="#tab-edit"
                                                                           role="tab" data-toggle="tab">Edit</a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Permanent Address</th>
                                                                    <td>
                                                                        <?php
                                                                        if (!empty($profileForFetch->getPermanentAddress())) {
                                                                            echo $profileForFetch->getPermanentAddress();

                                                                        } else {
                                                                            echo "No Data Entered Yet!";
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td>
                                                                        <a class="btn btn-link" href="#tab-edit"
                                                                           role="tab" data-toggle="tab">Edit</a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Current Address</th>
                                                                    <td>
                                                                        <?php
                                                                        if (!empty($profileForFetch->getCurrentAddress())) {
                                                                            echo $profileForFetch->getCurrentAddress();

                                                                        } else {
                                                                            echo "No Data Entered Yet!";
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td>
                                                                        <a class="btn btn-link" href="#tab-edit"
                                                                           role="tab" data-toggle="tab">Edit</a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Secondary Email</th>
                                                                    <td>
                                                                        <?php
                                                                        if (!empty($profileForFetch->getSecondaryEmail())) {
                                                                            echo $profileForFetch->getSecondaryEmail();

                                                                        } else {
                                                                            echo "No Data Entered Yet!";
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td>
                                                                        <a class="btn btn-link" href="#tab-edit"
                                                                           role="tab" data-toggle="tab">Edit</a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Emergency Phone Number</th>
                                                                    <td>
                                                                        <?php
                                                                        if (!empty($profileForFetch->getEmergencyNumber())) {
                                                                            echo $profileForFetch->getEmergencyNumber();
                                                                        } else {
                                                                            echo "No Data Entered Yet!";
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td>
                                                                        <a class="btn btn-link" href="#tab-edit"
                                                                           role="tab" data-toggle="tab">Edit</a>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!--<div class="tab-pane" id="tab-timeline">
                                            <div class="panel">
                                                <div class="panel-heading">
                                                    <h2>Timeline</h2>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <ul class="timeline">
                                                                <li class="timeline-primary">
                                                                    <div class="timeline-icon"><i
                                                                                class="ti ti-pencil"></i></div>
                                                                    <div class="timeline-body">
                                                                        <div class="timeline-header">
                                                                            <span class="author">Posted by <a href="#">David Tennant</a></span>
                                                                            <span class="date">Monday, November 21, 2013</span>
                                                                        </div>
                                                                        <div class="timeline-content">
                                                                            <h4>Consectetur Adipisicing Elit</h4>
                                                                            <p>Lorem ipsum dolor sit amet, consectetur
                                                                                adipisicing elit. Officia, officiis,
                                                                                molestiae, deserunt asperiores
                                                                                architecto ut vel repudiandae dolore
                                                                                inventore nesciunt necessitatibus
                                                                                doloribus ratione facere consectetur
                                                                                suscipit!</p>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="timeline-info">
                                                                    <div class="timeline-icon"><i
                                                                                class="ti ti-heart"></i></div>
                                                                    <div class="timeline-body">
                                                                        <div class="timeline-header">
                                                                            <span class="author">Posted by <a href="#">David Tennant</a></span>
                                                                            <span class="date">Monday, November 21, 2013</span>
                                                                        </div>
                                                                        <div class="timeline-content">
                                                                            <h4>Consectetur Adipisicing Elit</h4>
                                                                            <p>Lorem ipsum dolor sit amet, consectetur
                                                                                adipisicing elit. Officia, officiis,
                                                                                molestiae, deserunt asperiores
                                                                                architecto ut vel repudiandae dolore
                                                                                inventore nesciunt necessitatibus
                                                                                doloribus ratione facere consectetur
                                                                                suscipit!</p>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="timeline-warning">
                                                                    <div class="timeline-icon"><i
                                                                                class="ti ti-camera"></i></div>
                                                                    <div class="timeline-body">
                                                                        <div class="timeline-header">
                                                                            <span class="author">Posted by <a href="#">David Tennant</a></span>
                                                                            <span class="date">Monday, November 21, 2013</span>
                                                                        </div>
                                                                        <div class="timeline-content">
                                                                            <h4>Consectetur Adipisicing Elit</h4>
                                                                            <ul class="list-inline">
                                                                                <li><img src="" alt=""
                                                                                         class="pull-left img-thumbnail img-responsive clearfix"
                                                                                         width="200"></li>
                                                                                <li><img src="" alt=""
                                                                                         class="pull-left img-thumbnail img-responsive clearfix"
                                                                                         width="200"></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="timeline-danger">
                                                                    <div class="timeline-icon"><i
                                                                                class="ti ti-home"></i></div>
                                                                    <div class="timeline-body">
                                                                        <div class="timeline-header">
                                                                            <span class="author">Posted by <a href="#">David Tennant</a></span>
                                                                            <span class="date">Monday, November 21, 2013</span>
                                                                        </div>
                                                                        <div class="timeline-content">
                                                                            <h4>Consectetur Adipisicing Elit</h4>
                                                                            <p>Lorem ipsum dolor sit amet, consectetur
                                                                                adipisicing elit. Officia, officiis,
                                                                                molestiae, deserunt asperiores
                                                                                architecto ut vel repudiandae dolore
                                                                                inventore nesciunt necessitatibus
                                                                                doloribus ratione facere consectetur
                                                                                suscipit!</p>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>-->

                                        <!--<div class="tab-pane" id="tab-photos">
                                            <div class="panel">
                                                <div class="panel-heading">
                                                    <h2>Photos</h2>
                                                </div>
                                                <div class="panel-body profile-photos">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <img src="" alt=""
                                                                 class="img-thumbnail img-responsive mb-xl">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <img src="" alt=""
                                                                 class="img-thumbnail img-responsive mb-xl">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <img src="" alt=""
                                                                 class="img-thumbnail img-responsive mb-xl">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <img src="" alt=""
                                                                 class="img-thumbnail img-responsive mb-xl">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <img src="Resource/cd-avatar.png" alt=""
                                                                 class="img-thumbnail img-responsive mb-xl">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <img src="Resource/LuffyImage.png" alt=""
                                                                 class="img-thumbnail img-responsive mb-xl">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <img src="Resource/LuffyImage2.png" alt=""
                                                                 class="img-thumbnail img-responsive mb-xl">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <img src="" alt=""
                                                                 class="img-thumbnail img-responsive mb-xl">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>-->

                                        <div class="tab-pane" id="tab-edit">
                                            <div class="panel panel-primary black-text-color">
                                                <div class="panel-heading">
                                                    <h2>Edit</h2>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div id="passwordChangeDiv" style="display: none;">
                                                            <h1 class="text-center">Change Your Password</h1>
                                                            <h3 class="text-center" id="passwordChangeResult"></h3>
                                                            <form class="form-horizontal tabular-form" method="post"
                                                                  id="passwordChangeForm">
                                                                <div class="form-group">
                                                                    <input type="hidden" id="passwordChangeCsrfToken" name="passwordChangeCsrfToken"
                                                                           value="<?=hash('sha256',$_SESSION['email'])?>">
                                                                    <label for="userEmail"
                                                                           class="col-sm-2 control-label">Current
                                                                        Password:
                                                                    </label>
                                                                    <div class="col-sm-7 tabular-border">
                                                                        <input type="password" class="form-control"
                                                                               name="userCurrentPassword"
                                                                               id="userCurrentPassword"
                                                                               placeholder="Enter Current Password Here"
                                                                               required>
                                                                    </div>
                                                                    <div class="col-sm-3"
                                                                         id="userCurrentPasswordError"></div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="userNewPassword"
                                                                           class="col-sm-2 control-label">New Password
                                                                        : </label>
                                                                    <div class="col-sm-7 tabular-border">
                                                                        <input type="password" class="form-control"
                                                                               name="userNewPassword"
                                                                               id="userNewPassword"
                                                                               placeholder="Enter New Password Here"
                                                                               required>
                                                                    </div>
                                                                    <div class="col-sm-3"
                                                                         id="userNewPasswordError"></div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="userConfirmPassword"
                                                                           class="col-sm-2 control-label">Confirm
                                                                        Password :
                                                                    </label>
                                                                    <div class="col-sm-7 tabular-border">
                                                                        <input type="password" class="form-control"
                                                                               name="userConfirmPassword"
                                                                               id="userConfirmPassword"
                                                                               placeholder="Enter New Password Again Here"
                                                                               required>
                                                                    </div>
                                                                    <div class="col-sm-3"
                                                                         id="userConfirmPasswordError"></div>
                                                                </div>

                                                                <div class="col-sm-8 col-sm-offset-2">
                                                                    <button type="button"
                                                                            class="btn-primary changePasswordButton btn btn-lg"
                                                                            id="changePasswordButton">Change Password
                                                                    </button>
                                                                    <button type="button"
                                                                            class="btn-linkedin cancelPasswordChangeButton btn btn-lg"
                                                                            name="cancelPasswordChangeButton"
                                                                            id="cancelPasswordChangeButton">Cancel
                                                                    </button>
                                                                    <!--<button class="btn-default btn btn-lg" id="editFormResetButton">Reset</button>-->
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="col-md-12 profileEdit">
                                                            <form class="form-horizontal tabular-form"
                                                                  id="profileUserEditForm" name="profileUserEditForm"
                                                                  method="post">
                                                                <input type="hidden" name="csrfToken"
                                                                       value="<?= sha1($_SESSION['email']); ?>"/>
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <label for="form-name"
                                                                                   class="col-sm-3 col-md-offset-1 control-label">First
                                                                                Name</label>
                                                                            <div class="col-sm-8 tabular-border">
                                                                                <input type="text" class="form-control"
                                                                                       name="userFirstName"
                                                                                       id="userFirstName"
                                                                                       placeholder="Enter First Name"
                                                                                       value="<?= $profileForFetch->getFirstName(); ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6 col-lg-1-offset">
                                                                        <div class="form-group">
                                                                            <label for="form-name"
                                                                                   class="col-sm-3 control-label">Last
                                                                                Name</label>
                                                                            <div class="col-sm-8 tabular-border">
                                                                                <input type="text" class="form-control"
                                                                                       name="userLastName"
                                                                                       id="userLastName"
                                                                                       placeholder="Enter Last Name"
                                                                                       value="<?= $profileForFetch->getLastName(); ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="form-email"
                                                                           class="col-sm-2 control-label">Email
                                                                        : </label>
                                                                    <div class="col-sm-7 tabular-border">
                                                                        <input type="email" class="form-control"
                                                                               name="userEmail"
                                                                               id="userEmail"
                                                                               placeholder="example@email.com"
                                                                               value="<?= $email; ?>">
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <span id="userEmailError"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="radio" class="col-sm-2 control-label">Gender</label>
                                                                    <div class="col-sm-7 tabular-border">
                                                                        <?php
                                                                        if (!empty($profileForFetch->getGender())) {
                                                                            if ($profileForFetch->getGender() == 'male') {
                                                                                $maleChecked = 'checked';
                                                                                $feMaleChecked = '';

                                                                            } elseif ($profileForFetch->getGender() == 'female') {
                                                                                $maleChecked = '';
                                                                                $feMaleChecked = 'checked';
                                                                            }
                                                                        } else {
                                                                            $checkValue = '';
                                                                            $maleChecked = '';
                                                                            $feMaleChecked = '';
                                                                        }
                                                                        ?>
                                                                        <div class="radio block icheck">
                                                                            <label>
                                                                                <input type="radio" id="userGender" name="userGender"
                                                                                       class=""
                                                                                       value="male" <?= $maleChecked ?>>Male
                                                                            </label>
                                                                        </div>
                                                                        <div class="radio block icheck">
                                                                            <label>
                                                                                <input type="radio" id="userGender" name="userGender"
                                                                                       value="female"
                                                                                    <?= $feMaleChecked ?>>Female
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <span id="userGenderError"></span>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="form-password"
                                                                           class="col-sm-2 control-label"><strong>Password </strong>
                                                                    </label>
                                                                    <div class="col-sm-8 tabular-border">
                                                                        <button class="btn btn-lg btn-info btn-block"
                                                                           id="passwordChange" type="button">Change
                                                                            Password</button>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="form-password"
                                                                           class="col-sm-2 control-label">Phone
                                                                        Number</label>
                                                                    <div class="col-sm-7 tabular-border">
                                                                        <input type="text" class="form-control"
                                                                               id="userPhoneNumber"
                                                                               name="userPhoneNumber"
                                                                               placeholder="Enter Your Phone Number Here"
                                                                               value="<?= $profileForFetch->getPhoneNumber(); ?>">
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <span id="userPhoneNumberError"></span>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="form-password"
                                                                           class="col-sm-2 control-label">Birth
                                                                        Date</label>
                                                                    <div class="col-sm-7 tabular-border">
                                                                        <input type="text" class="form-control"
                                                                               id="userBirthDate" name="userBirthDate"
                                                                               placeholder="Click To Select Birth Date"
                                                                               value="<?= $profileForFetch->getBirthDate(); ?>">
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <span id="userBirthDateError"></span>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="userPermanentAddress"
                                                                           class="col-sm-2 control-label">Permanent
                                                                        Address</label>
                                                                    <div class="col-sm-7 tabular-border">
                                                                        <input type="text" class="form-control"
                                                                               id="userPermanentAddress"
                                                                               name="userPermanentAddress"
                                                                               placeholder="Enter You Permanent Address"
                                                                               value="<?= $profileForFetch->getPermanentAddress(); ?>">
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <span id="userPermanentAddressError"></span>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="form-password"
                                                                           class="col-sm-2 control-label">Current
                                                                        Address</label>
                                                                    <div class="col-sm-7 tabular-border">
                                                                        <input type="text" class="form-control"
                                                                               id="userCurrentAddress"
                                                                               name="userCurrentAddress"
                                                                               placeholder="Enter You Current Address"
                                                                               value="<?= $profileForFetch->getCurrentAddress(); ?>">
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <span id="userCurrentAddressError"></span>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="form-password"
                                                                           class="col-sm-2 control-label">Secondary
                                                                        Email</label>
                                                                    <div class="col-sm-7 tabular-border">
                                                                        <input type="text" class="form-control"
                                                                               id="userSecondaryEmail"
                                                                               name="userSecondaryEmail"
                                                                               placeholder="Enter Your Secondary Email Here"
                                                                               value="<?= $profileForFetch->getSecondaryEmail() ?>">
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <span id="userSecondaryEmailError"></span>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="userCountry"
                                                                           class="col-sm-2 control-label">Country</label>
                                                                    <div class="col-sm-7 tabular-border">
                                                                        <select name="userCountry" id="userCountry"
                                                                                class="form-control">
                                                                            <option value="Afghanistan">Afghanistan
                                                                            </option>
                                                                            <option value="Åland_Islands">Åland
                                                                                Islands
                                                                            </option>
                                                                            <option value="Albania">Albania</option>
                                                                            <option value="Algeria">Algeria</option>
                                                                            <option value="American_Samoa">American
                                                                                Samoa
                                                                            </option>
                                                                            <option value="Andorra">Andorra</option>
                                                                            <option value="Angola">Angola</option>
                                                                            <option value="Anguilla">Anguilla</option>
                                                                            <option value="Antarctica">Antarctica
                                                                            </option>
                                                                            <option value="Antigua_And_Barbuda">Antigua
                                                                                and Barbuda
                                                                            </option>
                                                                            <option value="Argentina">Argentina</option>
                                                                            <option value="Armenia">Armenia</option>
                                                                            <option value="Aruba">Aruba</option>
                                                                            <option value="Australia">Australia</option>
                                                                            <option value="Austria">Austria</option>
                                                                            <option value="Azerbaijan">Azerbaijan
                                                                            </option>
                                                                            <option value="Bahamas">Bahamas</option>
                                                                            <option value="Bahrain">Bahrain</option>
                                                                            <option value="Bangladesh">Bangladesh
                                                                            </option>
                                                                            <option value="Barbados">Barbados</option>
                                                                            <option value="Belarus">Belarus</option>
                                                                            <option value="Belgium">Belgium</option>
                                                                            <option value="Belize">Belize</option>
                                                                            <option value="Benin">Benin</option>
                                                                            <option value="Bermuda">Bermuda</option>
                                                                            <option value="Bhutan">Bhutan</option>
                                                                            <option value="Bolivia">Bolivia</option>
                                                                            <option value="Bosnia_And_Herzegovina">
                                                                                Bosnia and Herzegovina
                                                                            </option>
                                                                            <option value="Botswana">Botswana</option>
                                                                            <option value="Bouvet_Island">Bouvet
                                                                                Island
                                                                            </option>
                                                                            <option value="Brazil">Brazil</option>
                                                                            <option value="British_Indian_Ocean_Territory">
                                                                                British Indian Ocean Territory
                                                                            </option>
                                                                            <option value="Brunei_Darussalam">Brunei
                                                                                Darussalam
                                                                            </option>
                                                                            <option value="Bulgaria">Bulgaria</option>
                                                                            <option value="Burkina_Faso">Burkina Faso
                                                                            </option>
                                                                            <option value="Burundi">Burundi</option>
                                                                            <option value="Cambodia">Cambodia</option>
                                                                            <option value="Cameroon">Cameroon</option>
                                                                            <option value="Canada">Canada</option>
                                                                            <option value="Cape_Verde">Cape Verde
                                                                            </option>
                                                                            <option value="Cayman_Islands">Cayman
                                                                                Islands
                                                                            </option>
                                                                            <option value="Central_African_Republic">
                                                                                Central African Republic
                                                                            </option>
                                                                            <option value="Chad">Chad</option>
                                                                            <option value="Chile">Chile</option>
                                                                            <option value="China">China</option>
                                                                            <option value="Christmas_Island">Christmas
                                                                                Island
                                                                            </option>
                                                                            <option value="Cocos_(Keeling)_Islands">
                                                                                Cocos (Keeling) Islands
                                                                            </option>
                                                                            <option value="Colombia">Colombia</option>
                                                                            <option value="Comoros">Comoros</option>
                                                                            <option value="Congo">Congo</option>
                                                                            <option value="Congo,_The_Democratic_Republic_Of_The">
                                                                                Congo, The Democratic Republic of The
                                                                            </option>
                                                                            <option value="Cook_Islands">Cook Islands
                                                                            </option>
                                                                            <option value="Costa_Rica">Costa Rica
                                                                            </option>
                                                                            <option value="Cote_D'ivoire">Cote
                                                                                D'ivoire
                                                                            </option>
                                                                            <option value="Croatia">Croatia</option>
                                                                            <option value="Cuba">Cuba</option>
                                                                            <option value="Cyprus">Cyprus</option>
                                                                            <option value="Czech_Republic">Czech
                                                                                Republic
                                                                            </option>
                                                                            <option value="Denmark">Denmark</option>
                                                                            <option value="Djibouti">Djibouti</option>
                                                                            <option value="Dominica">Dominica</option>
                                                                            <option value="Dominican_Republic">Dominican
                                                                                Republic
                                                                            </option>
                                                                            <option value="Ecuador">Ecuador</option>
                                                                            <option value="Egypt">Egypt</option>
                                                                            <option value="El_Salvador">El Salvador
                                                                            </option>
                                                                            <option value="Equatorial_Guinea">Equatorial
                                                                                Guinea
                                                                            </option>
                                                                            <option value="Eritrea">Eritrea</option>
                                                                            <option value="Estonia">Estonia</option>
                                                                            <option value="Ethiopia">Ethiopia</option>
                                                                            <option value="Falkland_Islands_(Malvinas)">
                                                                                Falkland Islands (Malvinas)
                                                                            </option>
                                                                            <option value="Faroe_Islands">Faroe
                                                                                Islands
                                                                            </option>
                                                                            <option value="Fiji">Fiji</option>
                                                                            <option value="Finland">Finland</option>
                                                                            <option value="France">France</option>
                                                                            <option value="French_Guiana">French
                                                                                Guiana
                                                                            </option>
                                                                            <option value="French_Polynesia">French
                                                                                Polynesia
                                                                            </option>
                                                                            <option value="French_Southern_Territories">
                                                                                French Southern Territories
                                                                            </option>
                                                                            <option value="Gabon">Gabon</option>
                                                                            <option value="Gambia">Gambia</option>
                                                                            <option value="Georgia">Georgia</option>
                                                                            <option value="Germany">Germany</option>
                                                                            <option value="Ghana">Ghana</option>
                                                                            <option value="Gibraltar">Gibraltar</option>
                                                                            <option value="Greece">Greece</option>
                                                                            <option value="Greenland">Greenland</option>
                                                                            <option value="Grenada">Grenada</option>
                                                                            <option value="Guadeloupe">Guadeloupe
                                                                            </option>
                                                                            <option value="Guam">Guam</option>
                                                                            <option value="Guatemala">Guatemala</option>
                                                                            <option value="Guernsey">Guernsey</option>
                                                                            <option value="Guinea">Guinea</option>
                                                                            <option value="Guinea-bissau">
                                                                                Guinea-bissau
                                                                            </option>
                                                                            <option value="Guyana">Guyana</option>
                                                                            <option value="Haiti">Haiti</option>
                                                                            <option value="Heard_Island_And_Mcdonald_Islands">
                                                                                Heard Island and Mcdonald Islands
                                                                            </option>
                                                                            <option value="Holy_See_(Vatican_City_State)">
                                                                                Holy See (Vatican City State)
                                                                            </option>
                                                                            <option value="Honduras">Honduras</option>
                                                                            <option value="Hong_Kong">Hong Kong</option>
                                                                            <option value="Hungary">Hungary</option>
                                                                            <option value="Iceland">Iceland</option>
                                                                            <option value="India">India</option>
                                                                            <option value="Indonesia">Indonesia</option>
                                                                            <option value="Iran,_Islamic_Republic_Of">
                                                                                Iran, Islamic Republic of
                                                                            </option>
                                                                            <option value="Iraq">Iraq</option>
                                                                            <option value="Ireland">Ireland</option>
                                                                            <option value="Isle_Of_Man">Isle of Man
                                                                            </option>
                                                                            <option value="Israel">Israel</option>
                                                                            <option value="Italy">Italy</option>
                                                                            <option value="Jamaica">Jamaica</option>
                                                                            <option value="Japan">Japan</option>
                                                                            <option value="Jersey">Jersey</option>
                                                                            <option value="Jordan">Jordan</option>
                                                                            <option value="Kazakhstan">Kazakhstan
                                                                            </option>
                                                                            <option value="Kenya">Kenya</option>
                                                                            <option value="Kiribati">Kiribati</option>
                                                                            <option value="Korea,_Democratic_People's_Republic_Of">
                                                                                Korea, Democratic People's Republic of
                                                                            </option>
                                                                            <option value="Korea,_Republic_Of">Korea,
                                                                                Republic of
                                                                            </option>
                                                                            <option value="Kuwait">Kuwait</option>
                                                                            <option value="Kyrgyzstan">Kyrgyzstan
                                                                            </option>
                                                                            <option value="Lao_People's_Democratic_Republic">
                                                                                Lao People's Democratic Republic
                                                                            </option>
                                                                            <option value="Latvia">Latvia</option>
                                                                            <option value="Lebanon">Lebanon</option>
                                                                            <option value="Lesotho">Lesotho</option>
                                                                            <option value="Liberia">Liberia</option>
                                                                            <option value="Libyan_Arab_Jamahiriya">
                                                                                Libyan Arab Jamahiriya
                                                                            </option>
                                                                            <option value="Liechtenstein">
                                                                                Liechtenstein
                                                                            </option>
                                                                            <option value="Lithuania">Lithuania</option>
                                                                            <option value="Luxembourg">Luxembourg
                                                                            </option>
                                                                            <option value="Macao">Macao</option>
                                                                            <option value="Macedonia,_The_Former_Yugoslav_Republic_Of">
                                                                                Macedonia, The Former Yugoslav Republic
                                                                                of
                                                                            </option>
                                                                            <option value="Madagascar">Madagascar
                                                                            </option>
                                                                            <option value="Malawi">Malawi</option>
                                                                            <option value="Malaysia">Malaysia</option>
                                                                            <option value="Maldives">Maldives</option>
                                                                            <option value="Mali">Mali</option>
                                                                            <option value="Malta">Malta</option>
                                                                            <option value="Marshall_Islands">Marshall
                                                                                Islands
                                                                            </option>
                                                                            <option value="Martinique">Martinique
                                                                            </option>
                                                                            <option value="Mauritania">Mauritania
                                                                            </option>
                                                                            <option value="Mauritius">Mauritius</option>
                                                                            <option value="Mayotte">Mayotte</option>
                                                                            <option value="Mexico">Mexico</option>
                                                                            <option value="Micronesia,_Federated_States_Of">
                                                                                Micronesia, Federated States of
                                                                            </option>
                                                                            <option value="Moldova,_Republic_Of">
                                                                                Moldova, Republic of
                                                                            </option>
                                                                            <option value="Monaco">Monaco</option>
                                                                            <option value="Mongolia">Mongolia</option>
                                                                            <option value="Montenegro">Montenegro
                                                                            </option>
                                                                            <option value="Montserrat">Montserrat
                                                                            </option>
                                                                            <option value="Morocco">Morocco</option>
                                                                            <option value="Mozambique">Mozambique
                                                                            </option>
                                                                            <option value="Myanmar">Myanmar</option>
                                                                            <option value="Namibia">Namibia</option>
                                                                            <option value="Nauru">Nauru</option>
                                                                            <option value="Nepal">Nepal</option>
                                                                            <option value="Netherlands">Netherlands
                                                                            </option>
                                                                            <option value="Netherlands_Antilles">
                                                                                Netherlands Antilles
                                                                            </option>
                                                                            <option value="New_Caledonia">New
                                                                                Caledonia
                                                                            </option>
                                                                            <option value="New_Zealand">New Zealand
                                                                            </option>
                                                                            <option value="Nicaragua">Nicaragua</option>
                                                                            <option value="Niger">Niger</option>
                                                                            <option value="Nigeria">Nigeria</option>
                                                                            <option value="Niue">Niue</option>
                                                                            <option value="Norfolk_Island">Norfolk
                                                                                Island
                                                                            </option>
                                                                            <option value="Northern_Mariana_Islands">
                                                                                Northern Mariana Islands
                                                                            </option>
                                                                            <option value="Norway">Norway</option>
                                                                            <option value="Oman">Oman</option>
                                                                            <option value="Pakistan">Pakistan</option>
                                                                            <option value="Palau">Palau</option>
                                                                            <option value="Palestinian_Territory,_Occupied">
                                                                                Palestinian Territory, Occupied
                                                                            </option>
                                                                            <option value="Panama">Panama</option>
                                                                            <option value="Papua_New_Guinea">Papua New
                                                                                Guinea
                                                                            </option>
                                                                            <option value="Paraguay">Paraguay</option>
                                                                            <option value="Peru">Peru</option>
                                                                            <option value="Philippines">Philippines
                                                                            </option>
                                                                            <option value="Pitcairn">Pitcairn</option>
                                                                            <option value="Poland">Poland</option>
                                                                            <option value="Portugal">Portugal</option>
                                                                            <option value="Puerto_Rico">Puerto Rico
                                                                            </option>
                                                                            <option value="Qatar">Qatar</option>
                                                                            <option value="Reunion">Reunion</option>
                                                                            <option value="Romania">Romania</option>
                                                                            <option value="Russian_Federation">Russian
                                                                                Federation
                                                                            </option>
                                                                            <option value="Rwanda">Rwanda</option>
                                                                            <option value="Saint_Helena">Saint Helena
                                                                            </option>
                                                                            <option value="Saint_Kitts_And_Nevis">Saint
                                                                                Kitts and Nevis
                                                                            </option>
                                                                            <option value="Saint_Lucia">Saint Lucia
                                                                            </option>
                                                                            <option value="Saint_Pierre_And_Miquelon">
                                                                                Saint Pierre and Miquelon
                                                                            </option>
                                                                            <option value="Saint_Vincent_And_The_Grenadines">
                                                                                Saint Vincent and The Grenadines
                                                                            </option>
                                                                            <option value="Samoa">Samoa</option>
                                                                            <option value="San_Marino">San Marino
                                                                            </option>
                                                                            <option value="Sao_Tome_And_Principe">Sao
                                                                                Tome and Principe
                                                                            </option>
                                                                            <option value="Saudi_Arabia">Saudi Arabia
                                                                            </option>
                                                                            <option value="Senegal">Senegal</option>
                                                                            <option value="Serbia">Serbia</option>
                                                                            <option value="Seychelles">Seychelles
                                                                            </option>
                                                                            <option value="Sierra_Leone">Sierra Leone
                                                                            </option>
                                                                            <option value="Singapore">Singapore</option>
                                                                            <option value="Slovakia">Slovakia</option>
                                                                            <option value="Slovenia">Slovenia</option>
                                                                            <option value="Solomon_Islands">Solomon
                                                                                Islands
                                                                            </option>
                                                                            <option value="Somalia">Somalia</option>
                                                                            <option value="South_Africa">South Africa
                                                                            </option>
                                                                            <option value="South_Georgia_And_The_South_Sandwich_Islands">
                                                                                South Georgia and The South Sandwich
                                                                                Islands
                                                                            </option>
                                                                            <option value="Spain">Spain</option>
                                                                            <option value="Sri_Lanka">Sri Lanka</option>
                                                                            <option value="Sudan">Sudan</option>
                                                                            <option value="Suriname">Suriname</option>
                                                                            <option value="Svalbard_And_Jan_Mayen">
                                                                                Svalbard and Jan Mayen
                                                                            </option>
                                                                            <option value="Swaziland">Swaziland</option>
                                                                            <option value="Sweden">Sweden</option>
                                                                            <option value="Switzerland">Switzerland
                                                                            </option>
                                                                            <option value="Syrian_Arab_Republic">Syrian
                                                                                Arab Republic
                                                                            </option>
                                                                            <option value="Taiwan,_Province_Of_China">
                                                                                Taiwan, Province of China
                                                                            </option>
                                                                            <option value="Tajikistan">Tajikistan
                                                                            </option>
                                                                            <option value="Tanzania,_United_Republic_Of">
                                                                                Tanzania, United Republic of
                                                                            </option>
                                                                            <option value="Thailand">Thailand</option>
                                                                            <option value="Timor-leste">Timor-leste
                                                                            </option>
                                                                            <option value="Togo">Togo</option>
                                                                            <option value="Tokelau">Tokelau</option>
                                                                            <option value="Tonga">Tonga</option>
                                                                            <option value="Trinidad_And_Tobago">Trinidad
                                                                                and Tobago
                                                                            </option>
                                                                            <option value="Tunisia">Tunisia</option>
                                                                            <option value="Turkey">Turkey</option>
                                                                            <option value="Turkmenistan">Turkmenistan
                                                                            </option>
                                                                            <option value="Turks_And_Caicos_Islands">
                                                                                Turks and Caicos Islands
                                                                            </option>
                                                                            <option value="Tuvalu">Tuvalu</option>
                                                                            <option value="Uganda">Uganda</option>
                                                                            <option value="Ukraine">Ukraine</option>
                                                                            <option value="United_Arab_Emirates">United
                                                                                Arab Emirates
                                                                            </option>
                                                                            <option value="United_Kingdom">United
                                                                                Kingdom
                                                                            </option>

                                                                            <option value="United_States"
                                                                                    selected="selected">United States
                                                                            </option>
                                                                            <option value="United_States_Minor_Outlying_Islands">
                                                                                United States Minor Outlying Islands
                                                                            </option>
                                                                            <option value="Uruguay">Uruguay</option>
                                                                            <option value="Uzbekistan">Uzbekistan
                                                                            </option>
                                                                            <option value="Vanuatu">Vanuatu</option>
                                                                            <option value="Venezuela">Venezuela</option>
                                                                            <option value="Viet_Nam">Viet Nam</option>
                                                                            <option value="Virgin_Islands,_British">
                                                                                Virgin Islands, British
                                                                            </option>
                                                                            <option value="Virgin_Islands,_U.S.">Virgin
                                                                                Islands, U.S.
                                                                            </option>
                                                                            <option value="Wallis_And_Futuna">Wallis and
                                                                                Futuna
                                                                            </option>
                                                                            <option value="Western_Sahara">Western
                                                                                Sahara
                                                                            </option>
                                                                            <option value="Yemen">Yemen</option>
                                                                            <option value="Zambia">Zambia</option>
                                                                            <option value="Zimbabwe">Zimbabwe</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <span id="userCountryError"></span>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label">Emergency
                                                                        Phone
                                                                    </label>
                                                                    <div class="col-sm-7">
                                                                        <input class="form-control" type="text"
                                                                               name="userEmergencyPhone"
                                                                               id="userEmergencyPhone"
                                                                               value="<?= $profileForFetch->getEmergencyNumber(); ?>"/>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <span id="userEmergencyPhoneError"></span>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label">About
                                                                        You</label>
                                                                    <div class="col-sm-7">
                                                                        <textarea class="form-control"
                                                                                  name="userShortDescription"
                                                                                  id="userShortDescription"><?= $profileForFetch->getShortDescription(); ?></textarea>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <span id="userShortDescriptionError"></span>
                                                                    </div>
                                                                </div>
                                                                <!--<div class="row">
                                                                    <div class="col-sm-8 col-sm-offset-2">
                                                                        <button type="submit"
                                                                                class="btn-primary btn btn-lg"
                                                                                id="editFormSaveButton">Save
                                                                        </button>
                                                                        <button type="reset"
                                                                                class="btn-default btn btn-lg"
                                                                                id="editFormResetButton">Reset
                                                                        </button>
                                                                    </div>
                                                                </div>-->
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel-footer">
                                                    <div class="row">
                                                        <div class="col-sm-8 col-sm-offset-2">
                                                            <button type="button"
                                                                    class="btn-primary profileEdit btn btn-lg"
                                                                    name="editFormSaveButton"
                                                                    id="editFormSaveButton">Save
                                                            </button>
                                                            <!--<button class="btn-default btn btn-lg" id="editFormResetButton">Reset</button>-->
                                                        </div>
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

                    </div> <!-- .container-fluid -->
                </div> <!-- #page-content -->
            </div>
            <footer role="contentinfo">
                <div class="clearfix">
                    <ul class="list-unstyled list-inline pull-left">
                        <li><h6 style="margin: 0;">&copy; 2017 Dremers Space Ltd.</h6></li>
                    </ul>
                    <button class="pull-right btn btn-link btn-xs hidden-print" id="back-to-top"><i
                                class="fa fa-arrow-up fa-2x"></i></button>
                </div>
            </footer>

        </div>
    </div>
</div>


<?php
include_once "switcherCode.html";
include_once "commonPlugin.html";
?>
<!-- End loading site level scripts -->

<!-- Load page level scripts-->

<script type="text/javascript" src="assets/plugins/sweetalert/sweetalert.min.js"></script>
<script type="text/javascript" src="userProfile.js"></script>
<?php
}
else {
    header("Location:logout.php");
}
?>

<!-- End loading page level scripts-->

</body>
</html>