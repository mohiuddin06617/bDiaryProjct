<?php
/**
 * Created by PhpStorm.
 * User: mohiuddin
 * Date: 9/26/2017
 * Time: 1:14 AM
 */
include_once "sessionStartCheck.php";
require_once "DbFile/oodbconfig.php";
class userSideNavBar extends oodbconfig {
    private $oodbconfig;
    private $userName;
    function __construct()
    {
        $this->oodbconfig=new oodbconfig();
        $this->userNameFetch();
    }

    /**
     * @param mixed $userName
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }


    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->userName;
    }

    function userNameFetch(){
    $email=$_SESSION['email'];
    $conn=$this->oodbconfig->get_connection();
    $userNameQuery=$conn->prepare("SELECT firstname,lastname from userinfo where email=? LIMIT 1");
    $userNameQuery->bind_param('s',$email);
    $userNameQuery->execute();
    $userNameResult=$userNameQuery->get_result();
        if ($userNameResult->num_rows == 1) {
            while ($row = $userNameResult->fetch_assoc()) {
                $name=ucwords($row['firstname']." ".$row['lastname']);
                $this->setUserName($name);
            }
        }
        else{
            return "Error Occured : ".mysqli_error($conn);
        }

    }
}
?>
<div class="sidebar">
    <div class="widget">
        <div class="widget-body">
            <div class="userinfo">
                <div class="avatar">
                    <img src=""
                         class="img-responsive img-circle">
                </div>
                <div class="info">
                    <span class="username">
                        <?php
                        $userSideNavBar=new userSideNavBar();
                        echo $userSideNavBar->getUserName();
                        ?></span>
                    <span class="useremail"><?=$_SESSION['email'];?></span>
                </div>
            </div>
        </div>
    </div>
    <div class="widget stay-on-collapse" id="widget-sidebar">
        <nav role="navigation" class="widget-body">
            <ul class="acc-menu">
                <li class="nav-separator">
                    <?php

                        if (!empty($_SESSION['managerID']) && isset($_SESSION['managerID']) && is_numeric($_SESSION['managerID'])) {

                            ?>
                            <span>
                                        <select class="form-control input-lg text-center"
                                                onchange="switchManagerUserProfile(this.value)">
                                            <option value="manager" class="manager" id="manager">Manager</option>
                                            <option value="user" class="user" id="user" selected>User</option>
                                        </select>
                                        </span>
                            <span class="text-center">DASHBOARD</span>
                            <?php
                        } else {
                            ?>
                            <span>User Dashboard</span>
                            <?php
                        }

                    ?>
                </li>
                <li>
                    <a href="userHome.php" id="dashboard">
                        <i class="ti ti-home"></i>
                        <span>Home</span>
                        <span class="badge badge-teal">2</span>
                    </a>
                </li>
                <li>
                    <a href="userMeal.php" id="userMealConfirmation">
                        <i class="ti ti-bell"></i>
                        <span>Meal Details</span>
                    </a>
                </li>
                <li>
                    <a href="userShoppingCost.php" id="userDailyShoppingCost">
                        <i class="ti ti-view-list-alt"></i>
                        <span>Shopping Cost</span>
                    </a>
                </li>

                <li>
                    <a href="userFoodMenu.php" id="userFoodMenu">
                        <i class="fa fa-cutlery" aria-hidden="true"></i>
                        <span>Food Menu</span>
                    </a>

                </li>
                <li>
                    <a href="userFinancialInfo.php" id="userFinancialInfo">
                        <i class="fa fa-line-chart" aria-hidden="true"></i>
                        <span>Financial Information</span>
                    </a>

                </li>
                <li>
                    <a href="userShoppingDate.php" id="userShoppingDate">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        <span>Shopping Date</span>
                    </a>

                </li>
                <li>
                    <a href="userGroup.php" id="userGroupInfo">
                        <i class="fa fa-info" aria-hidden="true"></i>
                        <span> Group Info</span>
                    </a>
                </li>
                <li><a href="userProfile.php" id="userProfile">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <span> Profile</span>
                    </a>
                </li>

                <!--<li class="nav-separator"><span>Extras</span></li>
                <li><a href="app-inbox.html"><i class="ti ti-email"></i>
                        <span>Inbox</span>
                        <span class="badge badge-danger">3</span></a></li>
                <li><a href="extras-calendar.html"><i
                            class="ti ti-calendar"></i>
                        <span>Calendar</span>
                        <span class="badge badge-orange">1</span></a>
                </li>-->
            </ul>
        </nav>
    </div>

    <!--<div class="widget" id="widget-progress">
        <div class="widget-heading">
            Progress
        </div>
        <div class="widget-body">

            <div class="mini-progressbar">
                <div class="clearfix mb-sm">
                    <div class="pull-left">Bandwidth</div>
                    <div class="pull-right">50%</div>
                </div>

                <div class="progress">
                    <div class="progress-bar progress-bar-lime" style="width: 50%"></div>
                </div>
            </div>
            <div class="mini-progressbar">
                <div class="clearfix mb-sm">
                    <div class="pull-left">Storage</div>
                    <div class="pull-right">25%</div>
                </div>

                <div class="progress">
                    <div class="progress-bar progress-bar-info" style="width: 25%"></div>
                </div>
            </div>

        </div>
    </div>-->
</div>
