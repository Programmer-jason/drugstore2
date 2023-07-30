<?php
session_start();
include '../connect.php';

$sql = "UPDATE `product` SET `notificationType` = 'r'";
mysqli_query($conn, $sql);
