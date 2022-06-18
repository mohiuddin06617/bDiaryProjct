<!DOCTYPE html>
<html>
<head>
    <title>Add or Remove text boxes with jQuery</title>
    <script type="text/javascript" src="//code.jquery.com/jquery-latest.js"></script>
    <style type="text/css">

        #main {
            max-width: 800px;
            margin: 0 auto;
        }

    </style>
</head>
<body>
<div id="main">
    <h1>Add or Remove text boxes with jQuery</h1>
    <div class="my-form">
        <form role="form" method="post">
            <p class="text-box">
                <label for="item1">Item<span class="box-number">1</span></label>
                <input type="text" name="items[]" value="" id="item1" />
                <label for="price1">Price <span class="box-number">1</span></label>
                <input type="text" name="prices[]" value="" id="price1" />
                <a class="add-box" href="#">Add More</a>
            </p>
            <p><input type="submit" value="Submit" /></p>
        </form>
    </div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function($){
        $('.my-form .add-box').click(function(){
            var n = $('.text-box').length + 1;
            if( 5 < n ) {
                alert('Stop it!');
                return false;
            }
            var box_html = $('<p class="text-box"><label for="item' + n + '">Item <span class="box-number">' + n +
                '</span></label> <input type="text" name="items[]" value="" id="item' + n + '" /> ' +
                '<label for="price1">Price <span class="box-number">'+ n +'</span></label>' +
                '<input type="text" name="prices[]" value="" id="price'+ n +'" />'+
                '<a href="#" class="remove-box">Remove</a></p>');
            box_html.hide();
            $('.my-form p.text-box:last').after(box_html);
            box_html.fadeIn('slow');
            return false;
        });
        $('.my-form').on('click', '.remove-box', function(){
            $(this).parent().css( 'background-color', '#FF6C6C' );
            $(this).parent().fadeOut("slow", function() {
                $(this).remove();
                $('.box-number').each(function(index){
                    $(this).text( index + 1 );
                });
            });
            return false;
        });
    });
</script>
</body>
</html>
<?php

echo md5('talha123')."<br>";
echo md5('admin123')."<br>";
echo md5('tarikul123')."<br>";
echo md5('tuku123');



?>


<!--<style>

    .container {
        width:100%;
        height: 100%;
    }
   header{
       background-color: #cfcfcf;
       width: 100%;
       height: 20%;
       margin: 0 0 25px 0;
        list-style-position: inside;
       position: relative;
   }

    nav {
        float: left;
        max-width: 25%;
        padding: 1%;
        margin: 0;
        overflow: scroll;

    }

    nav ul {
        list-style-type: circle;

    }

    li {
        color: black;
        margin-top: 12%;

    }

    nav ul a {
        text-decoration: dotted red;
        background-color:  khaki ;

    }

    article {
        margin-left: 1%;
        border-left: 1px solid #132a80;

        overflow: scroll;

    }

    footer {
        position: fixed;
        right: 0%;
        bottom: 0%;
        left: 0%;
        background-color: darkcyan;
        text-align: center;
        padding: 1%;
    }
    .search-wrapper {
        width:30%;
        height:45px;
        background-color:#f0f0f0;

        border:1px solid #e9e9e9;
        position:relative;
    }
    .search-box {
        width:80%;
        height:32px;
        background-color:#fff;
        margin:5px 7px;
        border:1px solid #cfcfcf;
        position:relative;
    }
    .search-box img#searchIcon {
        background: url("Resource/ic_search_black_24dp_1x.png");
    }
    .search-box input {
        border:none;
        margin:0;
        position:absolute;
        font-size:16px;
        padding-left:5px;
        height:32px;
        width:99%;
        padding-right: 0px;
    }

</style>-->
<!--
--------------------Previous Navbar  of ManagerHome-------------------------


    <div class="container-fluid text-center">
      <div class="row content">
            <div class="col-sm-2 sidenav">
     <nav>
        <ul>
            <li><a href="managerStatus.php" target="iframe_all">Home</a></li>
            <li><a href="dailyFoodMenuSelection.php" target="iframe_all">Select Today's Food Menu</a></li>
            <li><a href="showTotalCost.php" target="iframe_all">Group Cost Listing</a></li>
            <li><a href="dailyCostApproval.php" target="iframe_all">Daily Cost Approval</a></li>
            <li><a href="shoppingDatePersonSelection.php" target="iframe_all">Select who is going to shopping</a></li>
            <li><a href="groupDetailsManager.php" target="iframe_all">Group Info</a></li>
            <li><a href="profileForUser.php" target="iframe_all"><?php
/*                include "DbFile/dbconfig.php";
        $row=mysqli_fetch_array(mysqli_query($conn,"SELECT id,firstname,lastname from userinfo where email='$email'"));echo $row['firstname']." ".$row['lastname'];
        */?>
                </a>
        </li>
        </ul>
     </nav>
        </div>
        </div>-->

<!-- <div class="col-sm-10">

 <div><iframe height="300px" width="100%" src="managerStatus.php" name="iframe_all"><div  id="iframe_id"></div></iframe></div>

 </div>
</div>

-->

<!--
----------------------------Prrevious Header Search Bar--------------------------------
 <div class="search-wrapper">
               <form action="" method="post" name="search">
                   <div class="search-box">
                <input type="text" id="searchAllUser" name="searchAllUser" style="border-color:#f4511e;" placeholder="Enter Your Search">
                 <img src="Resource/ic_search_black_24dp_1x.png" alt="Search" id="searchIcon" class="search-icon">

                   </div>
               </form>
               <div id="result"></div>

           </div>-->
