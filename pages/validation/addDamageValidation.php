<?php
include '../connect.php';

if (isset($_POST["submit"])) {

    $productName = htmlspecialchars($_POST['productName']);
    $productQty = htmlspecialchars($_POST['productQty']);
    $stockType = htmlspecialchars($_POST['stockType']);
    $productExpiration = htmlspecialchars($_POST['productExpiration']);
    $productPrice = htmlspecialchars($_POST['productPrice']);
    $productType = htmlspecialchars($_POST['productType']);
    $location = htmlspecialchars($_POST['location']);
    $notificationType = ($stockType == 'e') ? 'nr' : '';

    $sql = "SELECT * FROM product WHERE productName = '$productName' AND productExpired = '$productExpiration'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $productExpired = $row['productExpired'];
    $productQuantity = $row['productQty'];
    $productImgs = $row['productImg'];

    $getAllQuantity = "SELECT * FROM product WHERE productName = '$productName' AND stockType = 'o'";
    $results2 = mysqli_query($conn, $getAllQuantity);
    $AllQuantityRow = mysqli_fetch_assoc($results2);
    $allQuantity = $AllQuantityRow['productQty'];
    $overallQuanty = (int)$allQuantity + (int)$productQty;
    $overallQuanty2 = (int)$allQuantity - (int)$productQty;
       
    $sqlInsert = "INSERT INTO product (productName, productExpired, productQty, productType, productImg, productPrice, stockType, notificationType, shelve) 
    VALUES ('$productName', '$productExpired', $productQty, '$productType', '$productImgs', $productPrice, 'd', '$notificationType', '$location')";
    mysqli_query($conn, $sqlInsert);

    $updateProduct2 = "UPDATE product SET productQty=$overallQuanty2 WHERE productName = '$productName' AND stockType = 'o'";
    mysqli_query($conn, $updateProduct2);
    mysqli_close($conn);
    header("location: ../admin_pages/newStock.php");
}
