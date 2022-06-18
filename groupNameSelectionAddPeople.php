<?php
/**
 * Created by PhpStorm.
 * User: mohiuddin
 * Date: 10/8/2017
 * Time: 3:51 PM
 */
include_once "DbFile/oodbconfig.php";
require_once "DbFile/oodbconfig.php";

class groupNameSelectionAddPeople extends oodbconfig
{
    private $selectedGroupName;
    private $oodbconfig;
    private $group_id = array();

    public function __construct()
    {
        $this->oodbconfig = new oodbconfig();
    }

    /**
     * @param mixed $selectedGroupName
     */
    public function setSelectedGroupName($selectedGroupName)
    {
        $this->selectedGroupName = $selectedGroupName;
    }

    /**
     * @return mixed
     */
    public function getSelectedGroupName()
    {
        return $this->selectedGroupName;
    }

    /**
     * @return array
     */
    public function getGroupId()
    {
        return $this->group_id;
    }

    public function check_selected_name_availability()
    {
        $conn = $this->oodbconfig->get_connection();
        $group_name = $conn->real_escape_string($this->getSelectedGroupName());
        $answer = "";
        $nameAvailabiltyQuery = "Select group_name from groupDetails where group_name='$group_name' LIMIT 1";
        $nameAvailabiltyResult = $conn->query($nameAvailabiltyQuery) or die($conn->error_list);
        if ($nameAvailabiltyResult->num_rows > 0) {
            while ($row = $nameAvailabiltyResult->fetch_assoc()) {
                $answer = $row['group_name'];
                $answer .= " Group Name Already Exists";
            }
        } else {
            $answer = "<h3 class='text-center'>Congratulation group created</h3>";
        }


        return $answer;
    }

    public function group_name_search($searchedQuery)
    {
        $conn = $this->oodbconfig->get_connection();
        $answerArray = array();
        $searchedQuery = $conn->real_escape_string($searchedQuery);
        $findingGroupQuery = "select *from groupdetails where group_name LIKE '%$searchedQuery%'";
        $findingGroupResult = $conn->query($findingGroupQuery) or die($conn->error);;
        $countReturn = $findingGroupResult->num_rows;
        while ($row = $findingGroupResult->fetch_assoc()) {
            array_push($answerArray, $row['group_name']);
            array_push($this->group_id, $row['group_id']);
        }
        return $answerArray;
    }
}

$groupNameSelectionAddpeople = new groupNameSelectionAddPeople();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['enteredGroupName'])) {
        $enteredGroupName = strtoupper($_POST['enteredGroupName']);
        $groupNameSelectionAddpeople->setSelectedGroupName(($enteredGroupName));
        echo $groupNameSelectionAddpeople->check_selected_name_availability();
    } elseif (isset($_POST['searchedGroupName'])) {
        $searchedGroupName = strtoupper($_POST['searchedGroupName']);
        if ($searchedGroupName != "") {
            $found_name = array();
            $count = count($groupNameSelectionAddpeople->group_name_search($searchedGroupName));
            if ($count > 0) {
                for ($i = 0; $i < $count; $i++) {
                    $getted_name = $groupNameSelectionAddpeople->group_name_search($searchedGroupName)[$i];
                    $getted_id = $groupNameSelectionAddpeople->getGroupId()[$i];
                    /* array_push($found_name, $groupNameSelectionAddpeople->group_name_search($searchedGroupName));*/
                    echo "<a class='list-group-item bg-warning' href='groupViewUser.php?search=$getted_name' id='" . $getted_name . "'>
                            <h4 class='list-group-item-heading'><b>" . $getted_name ./*" ".$groupNameSelectionAddpeople->getGroupId()[$i] . */
                        "</b></h4></a>";
                }
            } else {
                echo "<a class='list-group-item'><h4 class='list-group-item-heading'><b>No result Found</b></h4></a>";
            }
        } elseif ($searchedGroupName == "") {
            echo "<span class='black-text-color bg-warning search-result-box'>Must have to enter a name</span>";
        }

    }
} else {
    echo "<h1 class='black-text-color text-danger'>Access Forbidden</h1>";
}


?>