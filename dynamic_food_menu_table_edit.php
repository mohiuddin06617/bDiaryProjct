<?php
/**
 * Created by PhpStorm.
 * User: Mohiuddin
 * Date: 8/12/2017
 * Time: 2:45 PM
 */
$page=isset($_POST['command'])?$_POST['command'] : '';

if ($page=='view') {
    $result=$mysqli->query("SELECT * from foodMenu");
    while ($row=$result->fetch_assoc()) {
        ?>
        <tr>
            <td><?=$row['foodMenuId']; ?></td>
            <td><?=$row['manager_id']; ?></td>
            <td><?=$row['inserted_date']; ?></td>
            <td><?=$row['inserted_time']; ?></td>
            <td><?=$row['item_name']; ?></td>
        </tr>
        <?php
    }

}
else{

    // Basic example of PHP script to handle with jQuery-Tabledit plug-in.
    // Note that is just an example. Should take precautions such as filtering the input data.

    header('Content-Type: application/json');

    $input = filter_input_array(INPUT_POST);

    if ($input['action'] == 'edit') {
        $mysqli->query("UPDATE foodMenu SET  manager_id='".$input['manager_id']."',inserted_date='" . $input['inserted_date'] . "', inserted_time='" . $input['inserted_time'] . "',item_name='".$input['item_name']."' 
	    	WHERE foodMenuId='" . $input['foodMenuId'] . "'");
    }
    else if ($input['action'] == 'delete') {
        $mysqli->query("UPDATE userinfo SET deleted=1 WHERE id='" . $input['id'] . "'");
    }
    else if ($input['action'] == 'restore') {
        $mysqli->query("UPDATE userinfo SET deleted=0 WHERE id='" . $input['id'] . "'");
    }

    mysqli_close($mysqli);

    echo json_encode($input);
}
?>