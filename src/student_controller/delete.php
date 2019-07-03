<?php
include_once('../database/connection.php');

$id = $_GET['id'];
$sql = "UPDATE student set is_active = 0 where id = $id";

$db_con -> exec($sql);
header('Location: ../../student/list.php');

?>
