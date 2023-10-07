<?php
session_start();
include '../connect.php';

$sql = "UPDATE `product` SET `notificationType` = 'r' WHERE stockType = 'e'";
mysqli_query($conn, $sql);
