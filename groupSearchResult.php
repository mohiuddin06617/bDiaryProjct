<?php
/**
 * Created by PhpStorm.
 * User: mohiuddin
 * Date: 10/17/2017
 * Time: 2:47 AM
 */
include_once "sessionStartCheck.php";
require_once "DbFile/oodbconfig.php";

class groupSearchResult extends oodbconfig {
    private $searchedQuery;
    private $groupNameResult=array();
    private $groupIdResult=array();
    private $managerIdResult=array();
    private $oodbconfig;
    public function __construct()
    {
        $this->oodbconfig=new oodbconfig();
    }
    public function set_searched_query($searchedQuery){
        $this->searchedQuery=$searchedQuery;
    }
    public function get_searched_query(){
        return $this->searchedQuery;
    }
    public function getGroupNameResult()
    {
        return $this->groupNameResult;
    }
    public function search_group_name(){
        $conn=$this->oodbconfig->get_connection();
        $searchedQuery=$this->get_searched_query();
        $searchedQuery=$conn->real_escape_string($searchedQuery);
        $groupNameSearchQuery="select *from groupdetails where group_name LIKE '%$searchedQuery%'";
        $searchedResult=$conn->query($groupNameSearchQuery) or die($conn->error);
        $row_count=$searchedResult->num_rows;
        if ($row_count>0){
            echo "<br>";

            while ($row=$searchedResult->fetch_assoc()){
                $id=$row['group_id'];
                $groupName=$row['group_name'];
                echo "<div class='row'>";
               echo "<div class='col-lg-2 col-md-2 col-sm-3 col-xs-3 pull-left'><img src='' width='50%' height='50%' id='groupSImage' alt='Group Image'/> </div>
                     <div class='col-lg-7 col-md-7 col-sm-7 col-xs-3'><span class='text-primary'><a href='groupViewUser.php?search=$groupName' style='font-size: 200%'>$groupName</a></span>
                     <br>
                     <span><span class='black-text-color'>Manager : </span><a href='#'>".$this->get_manager_name($row['manager_id'])."</a></span><p>Location Information</p></div>
                     <div class='col-lg-3 col-md-3 col-sm-2 col-xs-2'><button class='btn btn-lg btn-primary pull-right'><i class='fa fa-group'></i>Join</button></div> 
                     ";
                echo "</div><br>";
                /*echo "<a href='#' id='$id'>Group Name : ".$row['group_name']."</a><br>";*/
               /* echo "<a href='groupViewUser.php?search=$groupName'><div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">
			<div class=\"info-tile tile-info\">
				<div class=\"tile-icon\"><i class=\"fa fa-group\"></i></div>
				<div class=\"tile-heading\"><h3>".$row['group_name']."</h3></div>
				<button class=\"btn btn-lg btn-primary btn-getting btn-responsive pull-right\" type='button' style='cursor: hand' id='groupJoinButton'><i class='fa fa-user-plus'></i> Join</button>
				<div class=\"tile-body\"><span>Manager : ".$this->get_manager_name($row['manager_id'])."</span></div>
				<div class=\"tile-footer pull-right\"><span class=\"text-danger\">Location Details</span></div>
			</div>
		</div></a>";
               */
                array_push($this->groupNameResult,$row['group_name']);
                array_push($this->groupIdResult,$row['group_id']);
                array_push($this->managerIdResult,$row['manager_id']);
            }

        }
        else{
            echo "<h3 class='text-center'>No Group Found By Name :  ".$this->get_searched_query()." !Search Again Please</h3>";
        }

    }
    public function get_manager_name($supplied_id){
        $conn=$this->oodbconfig->get_connection();
        $managerNameQuery="select firstname,lastname from userinfo where id='$supplied_id'";
        $managerNameResult=$conn->query($managerNameQuery);
        $managerNameResult=$managerNameResult->fetch_assoc();
        return ucwords($managerNameResult['firstname']." ".$managerNameResult['lastname']);
    }
}
$groupSearchResult=new groupSearchResult();


if ($_SERVER['REQUEST_METHOD']=='GET') {

    if (isset($_GET['groupNameSearch']) && $_GET['groupNameSearch'] != "") {
        $searchedQuery = $_GET['groupNameSearch'];
        $groupSearchResult->set_searched_query($searchedQuery);
        /*$groupSearchResult->search_group_name();*/
    } elseif ($_GET['groupNameSearch'] == "") {
        echo "<h3>Please Enter A Name</h3>";
    }
}
/*if ($_SERVER['REQUEST_METHOD']=='GET'){
    if (isset($_GET['searchInMainSearchPage']) && $_GET['searchInMainSearchPage'])
}*/
?>

<!DOCTYPE html>
<html lang="en">
<?php

if((isset($_SESSION['userID']) && isset($_SESSION['email'])) /*|| (isset($_SESSION['userID']) && $_SESSION['userStatus']===1)*/) {
    ?>
    <title>User Group Details</title>
    <?php
    include "userHeader.php";
    ?>

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
                    require_once "userSideNavBar.php";
                    ?>
                </div>
            </div>

            <div class="static-content-wrapper">
                <div class="static-content">
                   <!-- --><?php
/*                    if (isset($_SESSION['groupID'])){
                        */?>
                        <div class="page-content">
                            <ol class="breadcrumb">

                                <li class=""><a href="userHome.php">Home</a></li>
                                <li class="active"><a href="userGroup.php">Group Details</a></li>
                                <li class="active"><a href="groupSearchResult.php">Group Search Result</a></li>

                            </ol>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="siteContent">
                                            <div class="row">
                                                <h3 class="text-center black-text-color">Search Result :</h3>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-0">
                                                </div>
                                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                                    <form method="GET" action="<?php echo $_SERVER['PHP_SELF']?>">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control input-lg" placeholder="Search for..." id="groupNameSearch" name="groupNameSearch" value="<?php echo $groupSearchResult->get_searched_query()?>">
                                                            <span class="input-group-btn">
                                                                <button class="btn btn-primary-alt btn-lg" type="submit">Go!</button>
                                                            </span>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-0">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <?php
                                                    $groupSearchResult->search_group_name();
                                                    ?>
                                                </div>
                                            </div>

                                            <br>
                                        </div>

                                        <!-- ------------------------- Content Area Finish ------------------------------------->

                                        <?php
                                        /*include_once "userFooter.php";*/
                                        ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
/*                    }
                    else{
                        echo "<h1 class='text-center'><i class='fa fa-lock fa-5x'></i><br><b>You must have to be a group member</b><br><br><a href='groupDetailsUser.php'>Click Here <b>Join</b> or <b>Create</b> a Group</a></h1>";
                    }
                    */?>
                    <!-- Switcher -->
                    <?php
                    include_once "switcherCode.html";
                    ?>
                    <?php
                    include_once "commonPlugin.html";
                    ?>
                </div>
            </div>
        </div>
    </div>

    </body>
    <?php
}
else
{
    header('Location:logout.php');
}
?>

</html>
