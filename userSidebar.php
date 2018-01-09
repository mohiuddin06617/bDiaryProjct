<?php
/**
 * Created by PhpStorm.
 * User: Biplob
 * Date: 12/21/2017
 * Time: 5:35 PM
 */
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar navbar-nav">
                <li><a href="userGroupDetails.php" target="iframe_all">My Group Info</a>
                <li><a href="userFoodMenu.php" target="iframe_all">Today's Food Menu</a></li>
                <li><a href="userDailyShoppingCostListing.php" target="iframe_all">Bazar Cost Details</a></li>
                <li><a href="showShoppingDate.php" target="iframe_all">Show Shopping Date</a></li>
                <!--<li><a href="profileForUser.php" target="iframe_all"><?php
                /*                        include "DbFile/dbconfig.php";
                                        $row=mysqli_fetch_array(mysqli_query($conn,"SELECT id,firstname,lastname from userinfo where email='$email'"));echo $row['firstname']." ".$row['lastname'];
                                        */?>
                    </a>
                </li>-->
                <li><a href="userFinancialInfo.php" target="iframe_all">My Financial Info</a></li>

            </ul>
        </div>
    </div>
</div>
