<?php
include '../connect.php';

if (isset($_POST["submit"])) {
    $fromYear = htmlspecialchars($_POST['from']);
    $toYear = htmlspecialchars($_POST['to']);
    $addSales = htmlspecialchars($_POST['addSales']);

        $stmt = $conn->prepare("INSERT INTO `sales` (mula, hanggang, totalSales) VALUES (?,?,?)");
        $stmt->bind_param("ssi", $fromYear, $toYear, $addSales);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        header("location: ../admin_pages/sales.php?message=Added Successfully");
    }
