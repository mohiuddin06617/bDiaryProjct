<?php
/**
 * Created by PhpStorm.
 * User: Biplob
 * Date: 12/21/2017
 * Time: 2:54 PM
 */
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar navbar-nav">
                <li><a href="groupDetails.php" target="iframe_all">Group Info</a>
                <li><a href="dailyFoodMenuSelection.php" target="iframe_all">Select Today's Food </a></li>
                <li><a href="shoppingDatePersonSelection.php" target="iframe_all">Select Shopper</a></li>
                <li><a href="dailyCostApproval.php" target="iframe_all">Bazar Cost Details</a></li>
                <!--<li><a href="profileForUser.php" target="iframe_all"><?php
/*                        include "DbFile/dbconfig.php";
                        $row=mysqli_fetch_array(mysqli_query($conn,"SELECT id,firstname,lastname from userinfo where email='$email'"));echo $row['firstname']." ".$row['lastname'];
                        */?>
                    </a>
                </li>-->
                <li><a href="groupFinancialInfo.php" target="iframe_all">Group Financial Info</a></li>

            </ul>
        </div>
    </div>
</div>
