<?php


$fans = array(
		array(1,30),
		array(2,40),
		array(3,50),
		array(4,40),
		array(5,50),
		array(6,60)
	);

$followers = array(
		array(1,20),
		array(2,27),
		array(3,22),
		array(4,90),
		array(5,50),
		array(6,35)
	);
$user3=array(
		array(1,50),
		array(2,47),
		array(3,32),
		array(4,62),
		array(5,70),
		array(6,75)
	);


$data = array('fans' =>$fans ,'followers'=>$followers ,'user3'=>$user3);
echo json_encode($data);


?>