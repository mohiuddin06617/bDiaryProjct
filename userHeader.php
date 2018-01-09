<?php
/**
 * Created by PhpStorm.
 * User: Biplob
 * Date: 12/21/2017
 * Time: 5:35 PM
 */
?>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="userHome.php">Bachelor Diary</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="profileForUser.php" target="iframe_all"><?php
                        include_once "DbFile/dbconfig.php";
                        $row=mysqli_fetch_array(mysqli_query($conn,"SELECT id,firstname,lastname from userinfo where email='$email'"));echo "<i class='glyphicon glyphicon-user'></i> Profile"/*ucwords($row['firstname']." ".$row['lastname'])*/;
                        ?>
                    </a>
                </li>
                <li><a class="btn btn-default btn-sm" href="logout.php">Logout</a></li>
            </ul>
            <form class="nav navbar-form navbar-right">
                <input type="text" class="form-control" name="searchAllUser" placeholder="Enter Your Search" onfocus="search()">
            </form>
        </div>
    </div>
</nav>
