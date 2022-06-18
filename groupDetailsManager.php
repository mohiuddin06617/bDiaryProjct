<?php
include_once "sessionStartCheck.php";
?>
<!DOCTYPE html>
<html lang="en">
<?php

if (isset($_SESSION['managerID']) && !empty($_SESSION['managerID']) && $_SESSION['userStatus'] == 1 && isset($_SESSION['email'])) {
    include_once "groupDetailsManagerFetch.php";
    $groupDetailsManagerFetch = new groupDetailsManagerFetch();
    $groupDetailsManagerFetch->getGroupDetails();

    ?>
    <head>
        <meta charset="utf-8">
        <title>Manager Group Information<?php
            /*        print_r($_SESSION);
                        */
            ?></title>
        <?php
        include_once "managerHeader.php";
        ?>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="assets/css/buttonDesign.css">
        <link rel="stylesheet" type="text/css" href="assets/css/profileCardDesign.css">
        <link rel="stylesheet" type="text/css" href="assets/css/socialMediaButtonDesign.css">

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
                        <ol class="breadcrumb">
                            <li class="active"><a href="managerHome.php">Manager Home</a></li>
                            <li class="active"><a href="groupDetailsManager.php">Manager Group Deatails</a></li>
                        </ol>
                        <div class="container-fluid">

                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-3" id="groupMenuTabNav">
                                    <!-- panel -->
                                    <div class="list-group list-group-alternate mb-n nav nav-tabs">
                                        <div class="panel panel-profile">
                                            <div class="panel-body">
                                                <a href="<?=$_SERVER['PHP_SELF']?>" style="font-size: 25px;"
                                                   class="text-primary"><?php
                                                    echo $groupDetailsManagerFetch->getGroupName();
                                                    ?></a>
                                            </div>
                                        </div>
                                        <hr>
                                        <a href="#tab-details" role="tab" data-toggle="tab" class="list-group-item">
                                            <i class="ti ti-user"></i>Group Details </a>
                                        <a href="#tab-member" role="tab" data-toggle="tab" class="list-group-item">
                                            <i class="ti ti-time"></i> Member</a>
                                        <a href="#tab-edit" role="tab" data-toggle="tab" class="list-group-item">
                                            <i class="fa fa-pencil"></i> Edit</a>
                                        <a href="#tab-activity" role="tab" data-toggle="tab" class="list-group-item">
                                            <i class="fa fa-tasks"></i> Activity</a>

                                    </div>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-9">
                                    <div class="tab-content">
                                        <div class="tab-pane" id="tab-edit">
                                            <div class="panel panel-primary black-text-color">
                                                <div class="panel-heading">
                                                    <h2>Edit</h2>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <form class="form-horizontal tabular-form"
                                                                  id="groupDetailsEditForm" name="groupDetailsEditForm"
                                                                  method="post">
                                                                <input type="hidden" name="csrfToken"
                                                                       value="<?= sha1($_SESSION['email']); ?>"/>
                                                                <div class="form-group">
                                                                    <label for="form-email"
                                                                           class="col-sm-2 control-label">Group Name
                                                                        : </label>
                                                                    <div class="col-sm-8 tabular-border">
                                                                        <input type="text" class="form-control"
                                                                               name="groupName"
                                                                               id="groupName"
                                                                               placeholder="example@email.com"
                                                                               value="<?= $groupDetailsManagerFetch->getGroupName() ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label">Description
                                                                    </label>
                                                                    <div class="col-sm-8">
                                                                        <textarea class="form-control"
                                                                                  name="groupDescription"
                                                                                  id="groupDescription"><?= $groupDetailsManagerFetch->getGroupDescription() ?></textarea>
                                                                    </div>
                                                                </div>


                                                                <div class="form-group">
                                                                    <label for="groupHouseAddress"
                                                                           class="col-sm-2 control-label">House Address
                                                                    </label>
                                                                    <div class="col-sm-8 tabular-border">
                                                                        <input type="text" class="form-control"
                                                                               id="groupHouseAddress"
                                                                               name="groupHouseAddress"
                                                                               placeholder="Enter House Address Here"
                                                                               value="<?=$groupDetailsManagerFetch->getHouseAddress()?>">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="groupMaidName"
                                                                           class="col-sm-2 control-label">Maid Name
                                                                    </label>
                                                                    <div class="col-sm-8 tabular-border">
                                                                        <input type="text" class="form-control"
                                                                               id="groupMaidName"
                                                                               name="groupMaidName"
                                                                               placeholder="Enter Maid Name Here"
                                                                               value="<?=$groupDetailsManagerFetch->getMaidName()?>">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="groupMaidPhone"
                                                                           class="col-sm-2 control-label">Maid Phone
                                                                    </label>
                                                                    <div class="col-sm-8 tabular-border">
                                                                        <input type="text" class="form-control"
                                                                               id="groupMaidPhone"
                                                                               name="groupMaidPhone"
                                                                               placeholder="Enter Maid Phone Here"
                                                                               value="<?=$groupDetailsManagerFetch->getMaidPhone()?>">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="groupMaidAddress"
                                                                           class="col-sm-2 control-label">Maid Address
                                                                    </label>
                                                                    <div class="col-sm-8 tabular-border">
                                                                        <input type="text" class="form-control"
                                                                               id="groupMaidAddress"
                                                                               name="groupMaidAddress"
                                                                               placeholder="Enter Maid Address Here"
                                                                               value="<?=$groupDetailsManagerFetch->getMaidAddress()?>">
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
                                                            <button type="button" class="btn-primary btn btn-lg"
                                                                    name="editFormSaveButton"
                                                                    id="editFormSaveButton">Save
                                                            </button>
                                                            <!--<button class="btn-default btn btn-lg" id="editFormResetButton">Reset</button>-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane active" id="tab-details">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h1 class="text-center black-color"><span
                                                                style="font-family: Impact;"><?= $groupDetailsManagerFetch->getGroupName() ?></span>
                                                        <a class="btn btn-link btn-sm" href="#tab-edit" role="tab" data-toggle="tab"><i class="fa fa-edit"></i>
                                                            Edit
                                                        </a>
                                                    </h1>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="about-area">
                                                        <h3><span class="black-color">Description </span>
                                                            <a class="btn btn-link btn-sm" href="#tab-edit" role="tab" data-toggle="tab"><span
                                                                        class="fa fa-edit"></span> Edit
                                                            </a>
                                                        </h3>
                                                        <p class="black-text-color"
                                                           style="font-weight: bolder"><?= $groupDetailsManagerFetch->getGroupDescription() ?></p>
                                                        <!--<p>Asperiores in eveniet sapiente error fuga tenetur ex ea
                                                            dignissimos voluptas ab molestiae eos totam quo dolorem
                                                            maxime illo neque quia itaque.</p>
-->
                                                    </div>
                                                    <div class="about-area">
                                                        <h4>Basic Information</h4>
                                                        <div class="table table-bordered black-color">
                                                            <table class="table">
                                                                <tbody>
                                                                <tr>
                                                                    <th>House Address</th>
                                                                    <td><?= $groupDetailsManagerFetch->getHouseAddress() ?></td>
                                                                    <td>
                                                                        <a class="btn btn-link" href="#tab-edit" role="tab" data-toggle="tab"><i
                                                                                    class="fa fa-edit"></i> Edit
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Total Member</th>
                                                                    <td colspan="2"><?= $groupDetailsManagerFetch->getTotalMember() ?></td>

                                                                </tr>
                                                                <tr>
                                                                    <th>Maid Name</th>
                                                                    <td><?= $groupDetailsManagerFetch->getMaidName() ?></td>
                                                                    <td>
                                                                        <a class="btn btn-link" href="#tab-edit" role="tab" data-toggle="tab"><i
                                                                                    class="fa fa-edit"></i> Edit
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Maid Phone</th>
                                                                    <td><?= $groupDetailsManagerFetch->getMaidPhone() ?></td>
                                                                    <td>
                                                                        <a class="btn btn-link" href="#tab-edit" role="tab" data-toggle="tab"><i
                                                                                    class="fa fa-edit"></i> Edit
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Maid Address</th>
                                                                    <td><?= $groupDetailsManagerFetch->getMaidAddress() ?></td>
                                                                    <td>
                                                                        <a class="btn btn-link" href="#tab-edit" role="tab" data-toggle="tab"><i
                                                                                    class="fa fa-edit"></i> Edit
                                                                        </a>
                                                                    </td>
                                                                </tr>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="tab-member">
                                            <div class="panel panel-primary" data-widget='{"draggable": "false"}'
                                                 id="memberProfileList">
                                                <div class="panel-heading">
                                                    <div class="panel-ctrls" data-actions-container=""
                                                         data-action-collapse='{"target": ".panel-body"}'></div>
                                                    <h3 class="text-center" style="color: papayawhip;"><i
                                                                class="fa fa-group"></i> Group Members List</h3>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="dropdown pull-right">
                                                                <button class="btn btn-primary-alt dropdown-toggle"
                                                                        type="button" data-toggle="dropdown"><i
                                                                            class="fa fa-cog"></i> Settings
                                                                    <span class="caret"></span></button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a href="#"><i class="fa fa-lock"></i>
                                                                            Privacy</a></li>
                                                                    <li class="divider"></li>
                                                                    <li><a href="#"><i class="fa fa-flag-checkered"></i>
                                                                            Delete Group</a></li>
                                                                    <li class="divider"></li>
                                                                    <li><a href="#">About Us</a></li>
                                                                </ul>
                                                            </div>
                                                            <button class="btn-primary-alt btn pull-right"
                                                                    id="addMoreMemberToGroup"><i class="fa fa-plus"></i>
                                                                Add Member
                                                            </button>
                                                        </div>
                                                    </div>
                                                    &nbsp;
                                                    <div class="row">
                                                        <?php
                                                        $groupDetailsManagerFetch->fetchMemberList();
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" id="newMemberAddDiv">
                                                <div class="text-center" id="newMemberAddResult"></div>
                                                <div class="col-xs-12">
                                                    <div class="panel panel-primary"
                                                         data-widget='{"draggable": "false"}'>
                                                        <div class="panel-heading">
                                                            <h3 class="text-center" style="color: white;"><i
                                                                        class="fa fa-plus"></i> New
                                                                Member Add <span style="cursor: pointer;"
                                                                                 id="closeNewMemberAddDiv"><i
                                                                            class="fa fa-close pull-right"></i></span>
                                                            </h3>
                                                        </div>
                                                        <div class="panel-body">
                                                            <div class="horizontal-form">
                                                                <form class="form-horizontal" name="newMemberAdd"
                                                                      id="newMemberAdd">
                                                                    <div class="form-group">
                                                                        <label for="serachQuery"
                                                                               class="col-sm-2 control-label black-text-color">Enter
                                                                            Email
                                                                        </label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text"
                                                                                   class="form-control black-text-color"
                                                                                   id="searchQuery"
                                                                                   placeholder="Enter Group Member Email Here">
                                                                            <div class="list-group searchQueryResult"
                                                                                 id="searchQueryResult"></div>
                                                                        </div>
                                                                        <div class="col-sm-2">
                                                                            <p class="help-block"
                                                                               id="searchQueryError"></p>
                                                                        </div>
                                                                    </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                        <div class="panel-footer">
                                                            <div class="row">
                                                                <div class="col-sm-8 col-sm-offset-2">
                                                                    <button class="btn-primary btn"
                                                                            id="newMemberAddButton">Search For Member
                                                                    </button>
                                                                    <button class="btn-default btn"
                                                                            id="cancelNewMemberAdd">Cancel
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="tab-activity">
                                            <div class="row">
                                                <div class="col-md-12 col-lg-12 col-md-12">
                                                    <div class="panel panel-gray" data-widget='{"draggable": "false"}'>
                                                        <div class="panel-heading">
                                                            <h2>Recent Activities</h2>
                                                            <div class="panel-ctrls button-icon-bg"
                                                                 data-actions-container=""
                                                                 data-action-collapse='{"target": ".panel-body"}'
                                                                 data-action-colorpicker=''
                                                                 data-action-refresh-demo='{"type": "circular"}'
                                                            >
                                                            </div>
                                                        </div>
                                                        <div class="panel-body">
                                                            <ul class="mini-timeline">
                                                                <li class="mini-timeline-lime">
                                                                    <div class="timeline-icon"></div>
                                                                    <div class="timeline-body">
                                                                        <div class="timeline-content">
                                                                            <a href="#/" class="name">Vincent Keller</a>
                                                                            added new task <a href="#/">Admin Dashboard
                                                                                UI</a>
                                                                            <span class="time">4 mins ago</span>
                                                                        </div>
                                                                    </div>
                                                                </li>

                                                                <li class="mini-timeline-deeporange">
                                                                    <div class="timeline-icon"></div>
                                                                    <div class="timeline-body">
                                                                        <div class="timeline-content">
                                                                            <a href="#/" class="name">Shawna Owen</a>
                                                                            added <a href="#/" class="name">Alonzo
                                                                                Keller</a> and <a href="#/"
                                                                                                  class="name">Mario
                                                                                Bailey</a> to project <a href="#/">Wordpress
                                                                                eCommerce Template</a>
                                                                            <span class="time">6 mins ago</span>
                                                                        </div>
                                                                    </div>
                                                                </li>

                                                                <li class="mini-timeline-info">
                                                                    <div class="timeline-icon"></div>
                                                                    <div class="timeline-body">
                                                                        <div class="timeline-content">
                                                                            <a href="#/" class="name">Christian
                                                                                Delgado</a> commented on thread <a
                                                                                    href="#/">Frontend Template PSD</a>
                                                                            <span class="time">12 mins ago</span>
                                                                        </div>
                                                                    </div>
                                                                </li>

                                                                <li class="mini-timeline-indigo">
                                                                    <div class="timeline-icon"></div>
                                                                    <div class="timeline-body">
                                                                        <div class="timeline-content">
                                                                            <a href="#/" class="name">Jonathan Smith</a>
                                                                            added <a href="#/" class="name">Frend
                                                                                Pratt</a> and <a href="#/" class="name">Robin
                                                                                Horton</a> to project <a href="#/">Material
                                                                                Design Admin Template</a>
                                                                            <span class="time">6 hours ago</span>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="mini-timeline-default">
                                                                    <div class="timeline-body ml-n">
                                                                        <div class="timeline-content">
                                                                            <button type="button"
                                                                                    data-loading-text="Loading..."
                                                                                    class="loading-example-btn btn btn-sm btn-default">
                                                                                See more
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="panel-body scroll-pane" style="height: 320px;">
                                                            <div class="scroll-content">
                                                                <ul class="mini-timeline">
                                                                    <li class="mini-timeline-lime">
                                                                        <div class="timeline-icon"></div>
                                                                        <div class="timeline-body">
                                                                            <div class="timeline-content">
                                                                                <a href="#/" class="name">Vincent
                                                                                    Keller</a> added new task <a
                                                                                        href="#/">Admin Dashboard UI</a>
                                                                                <span class="time">4 mins ago</span>
                                                                            </div>
                                                                        </div>
                                                                    </li>

                                                                    <li class="mini-timeline-deeporange">
                                                                        <div class="timeline-icon"></div>
                                                                        <div class="timeline-body">
                                                                            <div class="timeline-content">
                                                                                <a href="#/" class="name">Shawna
                                                                                    Owen</a> added <a href="#/"
                                                                                                      class="name">Alonzo
                                                                                    Keller</a> and <a href="#/"
                                                                                                      class="name">Mario
                                                                                    Bailey</a> to project <a href="#/">Wordpress
                                                                                    eCommerce Template</a>
                                                                                <span class="time">6 mins ago</span>
                                                                            </div>
                                                                        </div>
                                                                    </li>

                                                                    <li class="mini-timeline-info">
                                                                        <div class="timeline-icon"></div>
                                                                        <div class="timeline-body">
                                                                            <div class="timeline-content">
                                                                                <a href="#/" class="name">Christian
                                                                                    Delgado</a> commented on thread <a
                                                                                        href="#/">Frontend Template
                                                                                    PSD</a>
                                                                                <span class="time">12 mins ago</span>
                                                                            </div>
                                                                        </div>
                                                                    </li>

                                                                    <li class="mini-timeline-indigo">
                                                                        <div class="timeline-icon"></div>
                                                                        <div class="timeline-body">
                                                                            <div class="timeline-content">
                                                                                <a href="#/" class="name">Jonathan
                                                                                    Smith</a> added <a href="#/"
                                                                                                       class="name">Frend
                                                                                    Pratt</a> and <a href="#/"
                                                                                                     class="name">Robin
                                                                                    Horton</a> to project <a href="#/">Material
                                                                                    Design Admin Template</a>
                                                                                <span class="time">6 hours ago</span>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="mini-timeline-lime">
                                                                        <div class="timeline-icon"></div>
                                                                        <div class="timeline-body">
                                                                            <div class="timeline-content">
                                                                                <a href="#/" class="name">Vincent
                                                                                    Keller</a> added new task <a
                                                                                        href="#/">Admin Dashboard UI</a>
                                                                                <span class="time">4 mins ago</span>
                                                                            </div>
                                                                        </div>
                                                                    </li>

                                                                    <li class="mini-timeline-deeporange">
                                                                        <div class="timeline-icon"></div>
                                                                        <div class="timeline-body">
                                                                            <div class="timeline-content">
                                                                                <a href="#/" class="name">Shawna
                                                                                    Owen</a> added <a href="#/"
                                                                                                      class="name">Alonzo
                                                                                    Keller</a> and <a href="#/"
                                                                                                      class="name">Mario
                                                                                    Bailey</a> to project <a href="#/">Wordpress
                                                                                    eCommerce Template</a>
                                                                                <span class="time">6 mins ago</span>
                                                                            </div>
                                                                        </div>
                                                                    </li>

                                                                    <li class="mini-timeline-info">
                                                                        <div class="timeline-icon"></div>
                                                                        <div class="timeline-body">
                                                                            <div class="timeline-content">
                                                                                <a href="#/" class="name">Christian
                                                                                    Delgado</a> commented on thread <a
                                                                                        href="#/">Frontend Template
                                                                                    PSD</a>
                                                                                <span class="time">12 mins ago</span>
                                                                            </div>
                                                                        </div>
                                                                    </li>

                                                                    <li class="mini-timeline-indigo">
                                                                        <div class="timeline-icon"></div>
                                                                        <div class="timeline-body">
                                                                            <div class="timeline-content">
                                                                                <a href="#/" class="name">Jonathan
                                                                                    Smith</a> added <a href="#/"
                                                                                                       class="name">Frend
                                                                                    Pratt</a> and <a href="#/"
                                                                                                     class="name">Robin
                                                                                    Horton</a> to project <a href="#/">Material
                                                                                    Design Admin Template</a>
                                                                                <span class="time">6 hours ago</span>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="mini-timeline-default">
                                                                        <div class="timeline-body ml-n">
                                                                            <div class="timeline-content">
                                                                                <button type="button"
                                                                                        data-loading-text="Loading..."
                                                                                        class="loading-example-btn btn btn-sm btn-default">
                                                                                    See more
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
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


                            <!--<div class="row">

                                <div id="myModal" class="modal" role="dialog" aria-hidden="true">


                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <span class="close" id="closeButton">&times;</span>
                                            <h2 id="addMoreMemberToGroupHeader">Search Find and Add</h2>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                        <span id="slide_up">
                                                            <input class="slide-up" id="searchAllUser" type="search"
                                                                   placeholder="Enter Email Here"
                                                                   style="color: black;"/>
                                                            <label for="noOfMeal">Search</label>
                                                        </span>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="row">
                                                <div class="col-sm-6 col-sm-offset-3">
                                                    <div class="btn-toolbar">
                                                        <div class="search-result col-lg-12 col-md-12"
                                                             id="searchResult"></div>
                                                        <button type="button"
                                                                class="btn btn-default btn-responsive btn-lg"
                                                                style="color: black" id="cancelButton">Cancel
                                                        </button>
                                                        <button type="button"
                                                                class="btn btn-primary btn-responsive btn-lg">Save
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>-->


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

    <!-- Initialize scripts for this page-->
    <script src="assets/js/searchBarCode.js"></script>
    <script src="assets/js/statusManagement.js"></script>
    <script src="assets/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="groupDetailsManager.js"></script>


    <!-- End loading page level scripts-->


    </body>
    <?php
} else {
    header("Location:logout.php");
}
?>
</html>


<!--<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                            <div class="card">
                                                                <img src="Resource/LuffyImage2.png" class="card-img"
                                                                     style="width:100%">
                                                                <div class="card-container">
                                                                    <h3>
                                                                    <span class="text-primary">
                                                                        <a href="profileForUser.php">User Name 1</a>
                                                                    </span>
                                                                    </h3>
                                                                    <p class="card-title">CEO & Founder, Example</p>
                                                                    <p>Harvard University</p>
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
                                                                    <div>
                                                                        <button class="btn btn-getting btn-lg">Message
                                                                        </button>
                                                                        <ul class="demo-btns pull-right">
                                                                            <li>
                                                                                <div class="btn-group">
                                                                                    <button type="button"
                                                                                            class="btn btn-primary-alt dropdown-toggle"
                                                                                            data-toggle="dropdown">
                                                                                        <i class="fa fa-cog"></i><span
                                                                                                class="caret"></span>
                                                                                    </button>
                                                                                    <ul class="dropdown-menu"
                                                                                        role="menu">
                                                                                        <li><a href="#"><i
                                                                                                        class="fa fa-unlock"></i>
                                                                                                Make Manager</a></li>
                                                                                        <li class="divider"></li>
                                                                                        <li><a href="#"><i
                                                                                                        class="fa fa-times"></i>
                                                                                                Remove From Group</a>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                            <div class="card">
                                                                <img src="Resource/LuffyImage2.png" class="card-img"
                                                                     style="width:100%">
                                                                <div class="card-container">
                                                                    <h3 class="text-primary"><a
                                                                                href="profileForUser.php">User Name
                                                                            2</a></h3>
                                                                    <p class="card-title">CEO & Founder, Example</p>
                                                                    <p>Harvard University</p>
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
                                                                    <div>
                                                                        <button class="btn btn-getting btn-lg">Message
                                                                        </button>
                                                                        <ul class="demo-btns pull-right">
                                                                            <li>
                                                                                <div class="btn-group">
                                                                                    <button type="button"
                                                                                            class="btn btn-primary-alt dropdown-toggle"
                                                                                            data-toggle="dropdown">
                                                                                        <i class="fa fa-cog"></i><span
                                                                                                class="caret"></span>
                                                                                    </button>
                                                                                    <ul class="dropdown-menu"
                                                                                        role="menu">
                                                                                        <li><a href="#"><i
                                                                                                        class="fa fa-unlock"></i>
                                                                                                Make Manager</a></li>
                                                                                        <li class="divider"></li>
                                                                                        <li><a href="#"><i
                                                                                                        class="fa fa-times"></i>
                                                                                                Remove From Group</a>
                                                                                        </li>

                                                                                    </ul>
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                            <div class="card">
                                                                <img src="Resource/LuffyImage2.png" class="card-img"
                                                                     style="width:100%">
                                                                <div class="card-container">
                                                                    <h3 class="text-primary"><a
                                                                                href="profileForUser.php">User Name
                                                                            3</a></h3>
                                                                    <p class="card-title">CEO & Founder, Example</p>
                                                                    <p>Harvard University</p>
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
                                                                    <div>
                                                                        <button class="btn btn-getting btn-lg">Message
                                                                        </button>
                                                                        <ul class="demo-btns pull-right">
                                                                            <li>
                                                                                <div class="btn-group">
                                                                                    <button type="button"
                                                                                            class="btn btn-primary-alt dropdown-toggle"
                                                                                            data-toggle="dropdown">
                                                                                        <i class="fa fa-cog"></i><span
                                                                                                class="caret"></span>
                                                                                    </button>
                                                                                    <ul class="dropdown-menu"
                                                                                        role="menu">
                                                                                        <li><a href="#"><i
                                                                                                        class="fa fa-unlock"></i>
                                                                                                Make Manager</a></li>
                                                                                        <li class="divider"></li>
                                                                                        <li><a href="#"><i
                                                                                                        class="fa fa-times"></i>
                                                                                                Remove From Group</a>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>-->