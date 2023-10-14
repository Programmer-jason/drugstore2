<?php
include '../connect.php';

if (isset($_POST["submit"])) {
    $startingDate = htmlspecialchars($_POST['from']);
    $endDate = htmlspecialchars($_POST['to']);
    $targetSales = htmlspecialchars($_POST['targetSales']);

        $addSales = "INSERT INTO `sales` (startingDate, endDate, targetSales,salesStatus) VALUES ('$startingDate','$endDate','$targetSales','nf')";
        mysqli_query($conn, $addSales);
        mysqli_close($conn);
        header("location: ../admin_pages/sales.php?message=Added Successfully");
    }
