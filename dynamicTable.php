<?php
/**
 * Created by PhpStorm.
 * User: rian
 * Date: 6/12/2017
 * Time: 10:54 PM
 */


include 'DbFile/db.php';

class dynamicTable extends dbPractice
{
    private $month_name;
    public function __construct()
    {
        $this->month_name=date('F');
    }
    function set_month_name($month_name){
        $this->month_name=$month_name;
    }

    protected function get_shopping_date()
    {

        $conn = new mysqli($this->servername,$this->username, $this->password, $this->dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $shoppingDateGettingQuery = sprintf("SELECT selected_date,manager_id,selected_person_id 
from shoppingpersonselection WHERE manager_id=%f AND YEAR(selected_date)=YEAR(NOW()) AND MONTHNAME(selected_date)='".$this->month_name."'",mysqli_real_escape_string($conn,$_SESSION['managerID']));

        $shoppingDateResult=$conn->query($shoppingDateGettingQuery);
        if ($shoppingDateResult->num_rows>0)
        {
            echo "<table class='table table-bordered'><thead style='background: rgba(255,62,251,0.19);'><tr><td>Date</td><td>Selected Person</td><td>Manager ID</td></tr></thead>";
            while ($row=$shoppingDateResult->fetch_assoc()){
                echo "<tbody><tr><td>".$row['selected_date'] ."</td><td>".$row['selected_person_id']."</td><td>".$row['manager_id']."</td></tr></tbody>";
            }
        echo "</table>";
        }
        else
        {
            echo "0 Results";
        }

    }
     function get_shopping_date_by_id($selected_id)
    {

        $conn = new mysqli($this->servername,$this->username, $this->password, $this->dbname);
        if ($conn->connect_error)
        {
            die("Connection failed: " . $conn->connect_error);
        }
        $sel_id=$selected_id;

        $selected_person_id=array();
        $selected_date=array();
        $shoppingDateGettingQuery = sprintf("SELECT selected_date,manager_id,selected_person_id 
from shoppingpersonselection WHERE manager_id=%f and selected_person_id='".$sel_id."' AND YEAR(selected_date)=YEAR(NOW()) AND MONTHNAME(selected_date)='".$this->month_name."' ORDER BY selected_date",mysqli_real_escape_string($conn,$_SESSION['managerID']));

        $shoppingDateResult=$conn->query($shoppingDateGettingQuery);
        if ($shoppingDateResult->num_rows>0)
        {
            echo "<table class='table table-bordered'><thead style='background: rgba(91,240,238,0.59)'><tr><th>Selected Date</th><th>Action</th></tr></thead>";
            while ($row=$shoppingDateResult->fetch_assoc())
            {
                echo "<tbody><tr><td class='selected_date' id='changeSelectedShoppingDate' data-pk='1'>".$row['selected_date']."</td><td><button class='btn btn-primary btn-block btn-getting' id='editShoppingDate'>
                                                                        <i class='fa fa-edit fa-lg'
                                                                           aria-hidden='true'></i> Edit
                                                                    </button></td></tr></tbody>";


               /* array_push($selected_person_id,$row['selected_person_id']);
                array_push($selected_date,$row['selected_date']);*/
            }
            echo "</table>";

            /*$selected_date_data = array('selected_date' =>$selected_date ,'selected_person_id'=>$selected_person_id);
            json_encode($selected_date_data);*/

        }
        else
        {
            echo "0 Results";
        }
    }


    function return_get_shopping_date(){
        return $this->get_shopping_date();
    }

}
/*$dynamicTable=new dynamicTable();
$dynamicTable->set_month_name('june');

$dynamicTable->return_get_shopping_date();
$dynamicTable->get_shopping_date_by_id(8);*/


?>