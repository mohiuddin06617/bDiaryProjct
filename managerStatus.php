
   <!--      <div id="lastTwoDaysMenu" class="row">
                <div id="showTotalCost" class="col-md-4"></div>
                <div id="showTodayFoodConforMation" class="col-md-4"></div>
                <div id="lastTwoDaysMenuResult" class="col-md-4"><img src="Resource/ajax-loader.gif" id="loading"/> </div>
               <div id="showSelectedShoppingPersonDate"></div>
        </div>
    </center>
    <script type="text/javascript">
            $(document).ready(function () {

                function getLastDaysMenu() {

                    $.ajax({
                        type: "GET",
                        url: "getLastTwoDaysUserFoodMenu.php",
                        success: function (data) {
                            $("#loading").remove();
                            $("#lastTwoDaysMenuResult").html(data);
                                getTodaysFoodConformation();

                        }
                    });
                    function getTodaysFoodConformation() {

                        $.ajax({
                            type:"POST",
                            url: "getTodaysListOfFoodConformation.php",
                            success: function (response) {

                                $("#showTodayFoodConforMation").html(response);
                                    getTotalCost(); 
                            }
                        });
                    }
                    function getTotalCost() {
                        $.ajax({
                            type:"POST",
                            url: "getTotalCost.php",
                            data:'id='+2,
                            success: function (response) {

                                $("#showTotalCost").html(response);

                            }
                        });
                    }
                    
                }
               

            });

    </script> -->
   <div class="col-xs-12 col-md-12">
   <h1>Hello Manager</h1>
   </div>