<?php
include_once "sessionStartCheck.php";
?>
<!DOCTYPE html>
<html lang="en">
<?php
if(isset($_SESSION['userID'])&& isset($_SESSION['email']) && $_SESSION['userStatus']==0)
{
    include_once "userFinancialInfoFetch.php";
    $userFinancialInfoFetch=new userFinancialInfoFetch();
    for ($i = 0; $i < count($userFinancialInfoFetch->getAllMemberList()); $i++) {
        $id = $userFinancialInfoFetch->getAllMemberList()[$i]['id'];
        $amount = $userFinancialInfoFetch->perUserMealCost($id) + $userFinancialInfoFetch->getGroupFinancialDataInfo();
        $userFinancialInfoFetch->setMonthGroupTotalCost($amount);
        $mealCost=$userFinancialInfoFetch->perUserMealCost($id);
        $userFinancialInfoFetch->setTotalMealCost($mealCost);
    }
    ?>
<head>
    <meta charset="utf-8">
    <title>User Financial Information</title>
    <?php
    include_once "userHeader.php";
    ?>
    <head>
    <link rel="stylesheet" type="text/css" href="assets/css/inputDesign.css">
    <link rel="stylesheet" type="text/css" href="assets/css/customTableDesign.css">
    <link rel="stylesheet" type="text/css" href="assets/css/tileExtendedDesign.css">
    <!-- External Table and Input Design -->

        <style>

        .totalAmount{
            box-shadow: 10px 10px 15px 0 rgba(1,10,17,0.34);
        }
        .totalAmount:hover{
            box-shadow: 10px 10px 15px 0 #0d0d0f;
            transition: .4s;
        }
        .impact-font{
            background-color: #009ac1 !important;
            font-family: Impact, Charcoal, sans-serif;

            font-size: 25px;
        }
        .total-cost-table{
            box-shadow: -1px 1px 33px 5px rgba(0,0,0,.3);
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
                if (isset($_SESSION['groupID'])){
                ?>
                <div class="page-content">
                    <ol class="breadcrumb">

                        <li class="active"><a href="userHome.php">Home</a></li>
                        <li class="active"><a href="userFinancialInfo.php">User Financial Details</a></li>

                    </ol>

                    <div class="container-fluid">
                        <div class="panel panel-primary" data-widget='{"draggable": "false"}'>
                            <div class="row">
                                <div class="panel-heading">
                                    <div class="panel-ctrls"
                                         data-actions-container=""
                                         data-action-collapse='{"target": ".panel-body"}'>
                                    </div>
                                    <h1 class="text-center white-text-color">This Month's  All Financial Information</h1>
                                </div>
                                <div class="panel-body">
                                    <div class="row text-center">
                                        <div class="col-lg-3 col-md-3 col-sm-0 col-xs-0"></div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 white-text-color">
                                            <div class="panel panel-info totalAmount" data-widget='{"draggable": "false"}'>
                                                <div class="panel-heading">
                                                    <h3 class="text-center white-text-color">Your Total Payable Amount</h3>
                                                </div>
                                                <div class="panel-body">
                                                    <p class="black-text-color text-center" style="font-family: Impact;font-size: 23px;"><?php
                                                        echo round($userFinancialInfoFetch->perUserMealCost($userFinancialInfoFetch->getUserId())+$userFinancialInfoFetch->getGroupFinancialDataInfo(),2);
                                                      ?> TK</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-0 col-xs-0"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-0"></div>
                                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                            <table class="table table-striped table-fill total-cost-table">
                                                <thead>
                                                <tr>
                                                    <th colspan="4" class="text-center" style="background: #00e676 !important; font-size: 30px !important;"><span style="font-size: 20px !important;  font-family: 'Arial Black';">Total Cost List (Bill Created BY Manager)</span></th>
                                                </tr>
                                                <tr class="info">
                                                    <th>Bill Name</th>
                                                    <th>Group Total (BDT)</th>
                                                    <th>Your Total (BDT)</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                echo $userFinancialInfoFetch->groupBillList();
                                                ?>
                                                <tr>
                                                    <td>Meal Cost</td>
                                                    <td><?=$userFinancialInfoFetch->getTotalMealCost();?></td>
                                                    <td><?=$userFinancialInfoFetch->perUserMealCost($userFinancialInfoFetch->getUserId())?> TK</td>
                                                    <!--<td><button class="btn btn-link"><i class="fa fa-edit"></i> Edit</button></td>-->
                                                </tr>
                                                </tbody>
                                                <tfoot>
                                                <tr class="info text-center">
                                                    <td><b>Total</b></td>
                                                    <td><b><?php
                                                    echo $userFinancialInfoFetch->getMonthGroupTotalCost()." (TK)";
                                                        ?></b></td>
                                                    <td class="text-center"><b><?php
                                                            echo round($userFinancialInfoFetch->perUserMealCost($userFinancialInfoFetch->getUserId())+
                                                                    $userFinancialInfoFetch->getGroupFinancialDataInfo(),2)." (TK)"
                                                        ?></b>
                                                    </td>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-0"></div>
                                    </div>
                                    &nbsp;
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>
                                        <div class="col-lg-10 col-md-1 col-sm-0 col-xs-0">
                                            <div class="panel panel-info totalAmount" data-widget='{"draggable": "false"}'>
                                                <div class="panel-heading">
                                                    <h3 class="text-center white-text-color">This Month's Group Members Payable Amount</h3>
                                                </div>
                                                <div class="panel-body">
                                                    <?php
                                                    for ($i = 0; $i < count($userFinancialInfoFetch->getAllMemberList()); $i++)
                                                    {
                                                        $id = $userFinancialInfoFetch->getAllMemberList()[$i]['id'];
                                                        $fullName = $userFinancialInfoFetch->getAllMemberList()[$i]['fullName'];
                                                        $amount = $userFinancialInfoFetch->perUserMealCost($id) + $userFinancialInfoFetch->getGroupFinancialDataInfo();
                                                        //echo $fullName." : ". ($g->perUserMealCost($id)+$g->getGroupFinancialDataInfo())."<br>";
                                                        echo "<div class=\"col-lg-4 col-md-4 col-sm-6 col-xs-6\">
                                                                <div class=\"info-tile info-tile-alt tile-info\">
                                                                    <div class=\"tile-icon\"><i class=\"ti ti-money\"></i></div>
                                                                    <div class=\"tile-heading\"><span>".$fullName."</span></div>
                                                                    <div class=\"tile-body\"><span>".$amount."</span></div>
                                                                    <div class=\"tile-footer\"><span class=\"text-danger\">-7.6%</span></div>
                                                                </div>
                                                              </div>";
                                                     }

                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-info totalAmount" data-widget='{"draggable": "false"}'>
                            <div class="panel-heading">
                                <div class="panel-ctrls"
                                     data-actions-container=""
                                     data-action-collapse='{"target": ".panel-body"}'>
                                </div>
                                <h1 class="text-center white-text-color">Your These Years Cost Chart</h1>
                            </div>
                            <div class="panel-body">
                                <div id="chartdiv" style="width: 100%; height: 400px; background-color: #FFFFFF;" ></div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }
                else{
                    echo "<h1 class='text-center'><i class='fa fa-lock fa-5x'></i><br><b>You must have to be a group member</b><br><br><a href='userGroup.php'>Click Here <b>Join</b> or <b>Create</b> a Group</a></h1>";
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
<script type="text/javascript" src="assets/plugins/amcharts/amcharts.js"></script>
<script type="text/javascript" src="assets/plugins/amcharts/serial.js"></script>
<script type="text/javascript" src="assets/plugins/amcharts/plugins/dataloader/dataloader.min.js"></script>
<script type="text/javascript" src="userFinancialInfo.js"></script>
<!-- amCharts javascript sources -->


<!-- amCharts javascript code -->
<!--<script type="text/javascript">
    AmCharts.makeChart("chartdiv",
        {
            "type": "serial",
            "categoryField": "month",
            "startDuration": 1,
            "fontSize": 13,
            "categoryAxis": {
                "gridPosition": "start"
            },
            "trendLines": [],
            "graphs": [
                {
                    "colorField": "color",
                    "fillAlphas": 1,
                    "id": "AmGraph-1",
                    "lineColorField": "color",
                    "title": "graph 1",
                    "type": "column",
                    "valueField": "monthCost"
                }
            ],
            "guides": [],
            "valueAxes": [
                {
                    "id": "ValueAxis-1",
                    "title": "BDT (TK)"
                }
            ],
            "allLabels": [],
            "balloon": {},
            "titles": [
                {
                    "id": "Title-1",
                    "size": 15,
                    "text": "Your These Years Total Cost"
                }
            ],
            "dataProvider": [
                {
                    "month": "Jan",
                    "monthCost": "5203",
                    "color": "#42b3f4"
                },
                {
                    "month": "Feb",
                    "monthCost": "6512",
                    "color": "#41f4e2"
                },
                {
                    "month": "Mar",
                    "monthCost": "4521",
                    "color": "#dbdb8e"
                },
                {
                    "month": "Apr",
                    "monthCost": "4211",
                    "color": "#e5e522"
                },
                {
                    "month": "May",
                    "monthCost": "3601",
                    "color": "#e53f22"
                },
                {
                    "month": "Jun",
                    "monthCost": "9850",
                    "color": "#2269e5"
                },
                {
                    "month": "July",
                    "monthCost": "4562",
                    "color": "#e52286"
                },
                {
                    "month": "Aug",
                    "monthCost": "12500",
                    "color": "#d0c398"
                },
                {
                    "month": "Sep",
                    "monthCost": "12564",
                    "color": "#160505"
                },
                {
                    "month": "Oct",
                    "monthCost": "9851",
                    "color": "#63d3f2"
                },
                {
                    "month": "Nov",
                    "monthCost": "7452",
                    "color": "#edb6b6"
                },
                {
                    "month": "Dec",
                    "monthCost": "5623",
                    "color": "#f7df8a"
                }
            ]
        }
    );
</script>
-->
</body>
<?php
}
else{
    header("location:logout.php");
}
?>
</html>


<?php
/**
 * Created by PhpStorm.
 * User: p9
 * Date: 05-Jan-17
 * Time: 7:28 AM
 */

?>