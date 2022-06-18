<?php
/**
 * Created by PhpStorm.
 * User: mohiuddin
 * Date: 9/26/2017
 * Time: 12:56 AM
 */
require_once "DbFile/oodbconfig.php";
class managerSideNavBar extends oodbconfig {
    private $oodbconfig;
    private $managerName;
    function __construct()
    {
        $this->oodbconfig=new oodbconfig();
        $this->managerNameFetch();
    }

    /**
     * @param mixed $userName
     */
    public function setManagerName($managerName)
    {
        $this->managerName = $managerName;
    }


    /**
     * @return mixed
     */
    public function getManagerName()
    {
        return $this->managerName;
    }

    function managerNameFetch(){
        $email=$_SESSION['email'];
        $conn=$this->oodbconfig->get_connection();
        $userNameQuery=$conn->prepare("SELECT firstname,lastname from userinfo where email=? LIMIT 1");
        $userNameQuery->bind_param('s',$email);
        $userNameQuery->execute();
        $userNameResult=$userNameQuery->get_result();
        if ($userNameResult->num_rows == 1) {
            while ($row = $userNameResult->fetch_assoc()) {
                $name=ucwords($row['firstname']." ".$row['lastname']);
                $this->getManagerName($name);
                return $name;
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
                    <img src="" class="img-responsive img-circle" alt="cicle image">
                </div>
                <div class="info">

                    <span class="username"><?php $managerName=new managerSideNavBar();echo $managerName->managerNameFetch(); ?></span>
                    <span class="useremail"><b><?php echo $_SESSION['email'];?></b></span>
                </div>
            </div>
        </div>
    </div>
    <div class="widget stay-on-collapse" id="widget-sidebar">
        <nav role="navigation" class="widget-body">
            <ul class="acc-menu">
                <li class="nav-separator">
                    <span>
                       <select class="form-control input-lg text-center" onchange="switchManagerUserProfile(this.value)">
                            <option value="manager" class="manager" id="manager">Manager</option>
                            <option value="user" class="user" id="user">User</option>
                       </select>
                    </span>
                </li>

                <li><a href="managerHome.php" id="managerStatus">
                        <i class="ti ti-home"></i>
                        <span>Manager Home</span>
                        <span class="badge badge-teal">2</span>
                    </a>
                </li>
                <li>
                    <a href="managerFoodMenu.php" id="dailyFoodMenuSelection">
                        <i class="material-icons">restaurant_menu</i>
                        <span>Food Menu</span>
                    </a>
                </li>
                <li>
                    <a href="groupFinancialInfo.php" id="groupFinancialInfo">
                        <i class="fa fa-line-chart" aria-hidden="true"></i>
                        <span>Financial Information</span>
                    </a>

                </li>
                <li>
                    <a href="managerShoppingCost.php" id="dailyCostApproval">
                        <i class="ti ti-money"></i>
                        <span>Shopping Cost</span>
                    </a>
                </li>
                <li>
                    <a href="shopperSelection.php" id="shoppingDatePersonSelection">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        <span>Shopper Selection</span>
                    </a>

                </li>
                <li>
                    <a href="groupMeal.php" id="groupMeal">
                        <i class="fa fa-cutlery" aria-hidden="true"></i>
                        <span>Group Meal Details</span>
                    </a>
                </li>
                <li>
                    <a href="groupDetailsManager.php" id="groupDetailsManager">
                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                        <span>Group Details</span>
                    </a>

                </li>

                <!-- <li><a href="profileForUser.php" id="profileForManager">
                         <i class="fa fa-user" aria-hidden="true"></i>
                         <span> Profile</span>
                     </a>
                 </li>-->
                <li class="nav-separator"><span>Extras</span></li>
                <li>
                    <a href="groupSettings.php" class="alert-link">
                        <i class="ti ti-settings"></i>
                        <span>Group Settings</span>
                        <!--<span class="badge badge-danger">3</span>-->
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <!--<div class="widget" id="widget-progress">
        <div class="widget-heading">
            Settings
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
