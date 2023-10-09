<?php
include '../connect.php';

if (isset($_POST["submit"])) {
    $fromYear = htmlspecialchars($_POST['from']);
    $toYear = htmlspecialchars($_POST['to']);
    $targetSales = htmlspecialchars($_POST['targetSales']);

        $stmt = $conn->prepare("INSERT INTO `sales` (mula, hanggang, targetSales) VALUES (?,?,?)");
        $stmt->bind_param("ssi", $fromYear, $toYear, $targetSales);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        header("location: ../admin_pages/sales.php?message=Added Successfully");
    }
