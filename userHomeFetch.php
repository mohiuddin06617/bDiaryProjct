<?php
/**
 * Created by PhpStorm.
 * User: mohiuddin
 * Date: 2/11/2018
 * Time: 3:12 AM
 */
include_once "sessionStartCheck.php";
include_once "DbFile/oodbconfig.php";
class userHomeFetch extends oodbconfig{
    private $oodbconfig;
    private $groupId;
    private $userId;
    function __construct()
    {
        $this->oodbconfig=new oodbconfig();
        $this->groupId=isset($_SESSION['groupID'])?$_SESSION['groupID']:null;
        $this->userId=isset($_SESSION['userID'])?$_SESSION['userID']:null;
    }
    public function todayFoodMenu(){
        $conn=$this->oodbconfig->get_connection();
        $sql="select inserted_time,item_name from foodmenu WHERE group_id='$this->groupId' and inserted_date=CURRENT_DATE ORDER BY inserted_time";
        $result=$conn->query($sql);
        if ($conn->affected_rows>0){
            while ($row=$result->fetch_assoc()){
                echo "<tr><td>".$row['inserted_time']."</td><td>".$row['item_name']."</td></tr>";
            }
        }
        else{
            echo "<tr><td class='text-center' colspan='2'><h4><b>No Food Menu Selected</b></h4></td></tr>";
        }
    }
}