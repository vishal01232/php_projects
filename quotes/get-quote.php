<?php
require_once 'db.php';
//$tag=$_POST['tag'];
$tag = 'love';

$mysqli = new mysqli($host, $user, $pass, $db) or die(mysqli_error($mysqli));
$sql = "SELECT * FROM $table WHERE tag='$tag' ORDER BY RAND() LIMIT 1";
$result = $mysqli->query($sql);
$data = $result->fetch_assoc();
//print_r($data);
echo json_encode($data);
