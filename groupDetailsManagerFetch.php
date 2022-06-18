<?php
/**
 * Created by PhpStorm.
 * User: mohiuddin
 * Date: 10/24/2017
 * Time: 2:35 PM
 */

require_once "DbFile/oodbconfig.php";
include_once "sessionStartCheck.php";

/*session_start();*/

class groupDetailsManagerFetch extends oodbconfig
{
    private $group_id;
    private $oodbconfig;
    private $house_address;
    private $total_member;
    private $maid_name;
    private $maid_phone;
    private $maid_address;
    private $group_description;
    private $group_name;
    private $all_group = array();

    function __construct()
    {
        $this->oodbconfig = new oodbconfig();

    }

    /**
     * @return mixed
     */
    public function getHouseAddress()
    {
        return $this->house_address;
    }

    /**
     * @return mixed
     */
    public function getMaidName()
    {
        return $this->maid_name;
    }

    /**
     * @return mixed
     */
    public function getMaidPhone()
    {
        return $this->maid_phone;
    }

    /**
     * @return mixed
     */
    public function getMaidAddress()
    {
        return $this->maid_address;
    }

    /**
     * @return mixed
     */
    public function getTotalMember()
    {
        return $this->total_member;
    }

    /**
     * @return mixed
     */
    public function getGroupDescription()
    {
        return $this->group_description;
    }

    /**
     * @return mixed
     */
    public function getGroupName()
    {
        return $this->group_name;
    }

    public function fetchMemberList()
    {
        $conn = $this->oodbconfig->get_connection();
        $this->setGroupId();
        $group_id = $this->getGroupId();
        $memberFetchQuery = "SELECT id,firstName,lastName,email,phoneNumber from userinfo WHERE userinfo.group_id='$group_id'";
        $memberFetchResult = $conn->query($memberFetchQuery);

        while ($row = $memberFetchResult->fetch_assoc()) {
            $id = $row['id'];
            echo "<div class='col-lg-4 col-md-4 col-sm-12 col-xs-12' id='memberCard$id'>
                    <div class='card'>
                    <img src='Resource/LuffyImage2.png' alt='Avatar' style=\"width:100%\">
                        <h3><span><a>" . ucwords($row['firstName'] . " " . $row['lastName']) . "</a></span></h3>
                                <p class=\"card-title\">" . $row['email'] . "</p>
                                <p><b>Mobile : </b>" . $row['phoneNumber'] . "</p>
                                <div>
                                    <button class=\"btn btn-getting btn-lg\">Message
                                    </button>
                                    <ul class=\"demo-btns pull-right\">
                                        <li>
                                            <div class=\"btn-group\">
                                                <button type=\"button\"
                                                        class=\"btn btn-primary-alt dropdown-toggle\"
                                                        data-toggle=\"dropdown\">
                                                    <i class=\"fa fa-cog\"></i><span
                                                            class=\"caret\"></span>
                                                </button>
                                                <ul class=\"dropdown-menu\"
                                                    role=\"menu\">
                                                    <li><a style='cursor: pointer' class='makeManagerButton' id='" . $id . "'><i
                                                                    class='fa fa-unlock'></i>
                                                            Make Manager</a></li>
                                                    <li class=\"divider\"></li>
                                                    <li>
                                                        <a style='cursor: pointer' class='removeMemberButton' id='$id'><i
                                                                    class=\"fa fa-times\"></i>
                                                            Remove From Group</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>";

        }

    }

    /**
     * @param mixed $group_id
     */
    private function setGroupId()
    {
        $this->group_id = isset($_SESSION['groupID'])?$_SESSION['groupID']:null;
    }

    /**
     * @return mixed
     */
    public function getGroupId()
    {
        return $this->group_id;
    }

    public function getGroupDetails()
    {
        $conn = $this->oodbconfig->get_connection();
        $this->setGroupId();
        $group_id = $this->getGroupId();
        $groupDetailsFetchQuery = "SELECT g.total_member,g.group_name,g.total_member,go.house_address,go.maid_name,go.maid_phone,go.maid_address,go.group_description from groupDetails g,groupOtherDetails go WHERE g.group_id=go.group_id and g.group_id='$group_id'";
        $groupDetailsFetchResult = $conn->query($groupDetailsFetchQuery);
        try {
            while ($row = $groupDetailsFetchResult->fetch_assoc()) {
                /*                echo "Group Name: ".$row['group_name']." <br>Total Member : ".$row['total_member']." <br> House Address : ".$row['house_address']."<br> Maid Name : ".$row['maid_name']."<br>Maid Phone : ".$row['maid_phone']."<br> Group Descreiption : ".$row['group_description']."<br>";*/
                $this->group_description = $row['group_description'];
                $this->group_name = $row['group_name'];
                $this->total_member = $row['total_member'];
                $this->house_address = $row['house_address'];
                $this->maid_name = $row['maid_name'];
                $this->maid_phone = $row['maid_phone'];
                $this->maid_address = $row['maid_address'];
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }

    }

    public function searchForMember($searchTerm)
    {
        $conn = $this->oodbconfig->get_connection();
        $this->setGroupId();
        $group_id = $this->getGroupId();
        $query = "select id,firstName,lastName,email from userinfo where email LIKE '%" . $searchTerm . "%'";
        $result = $conn->query($query);

        while ($row = $result->fetch_assoc()) {
            array_push($this->all_group, $row);
        }
        return json_encode($this->all_group);


    }
}

if (isset($_POST['searchTerm'])) {
    $searchTerm = $_POST['searchTerm'];
    $groupUserList = new groupDetailsManagerFetch();
    echo $groupUserList->searchForMember($searchTerm);
}
/*$groupDetailsManagerFetch=new groupDetailsManagerFetch();
$groupDetailsManagerFetch->getGroupDetails();
echo $groupDetailsManagerFetch->fetchMemberList();
echo $groupDetailsManagerFetch->getGroupName();*/

?>