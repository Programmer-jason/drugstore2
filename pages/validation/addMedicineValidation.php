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

    $fileName = $_FILES["upload"]["name"];
    $fileTmpname = $_FILES["upload"]["tmp_name"];
    $fileSize = $_FILES["upload"]["size"];
    $fileType = $_FILES["upload"]["type"];
    $targetDir = "../../uploads/";
    $targetFile = $targetDir . basename($fileName);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $typeFile = array("jpg", "png", "jpeg", "gif");
    
    $sql = "SELECT * FROM product WHERE productName = '$productName'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $productExpired = $row['productExpired'];
    $productQuantity = $row['productQty'];
    $productImgs = $row['productImg'];

    if (!mysqli_num_rows($result) > 0) {

        if (!empty($fileName)) {

            if (in_array($imageFileType, $typeFile)) {

                if (file_exists($targetFile)) {
                    header("location: ../admin_pages/addMedicine.php?message=File Exist");
                    exit;
                } 
                else {
                    if ($fileSize > 2000000) {
                        header("location: ../admin_pages/addMedicine.php?message=File To Big");
                        exit;
                    } 
                    else {
                        if (move_uploaded_file($fileTmpname, $targetFile)) {
                            header("location: ../admin_pages/addMedicine.php?message=The file has been uploaded.");
                        } 
                        else {
                            header("location: ../admin_pages/addMedicine.php?message=Error File Upload.");
                            exit;
                        }
                    }
                }

            }
            else {
                header("location: ../admin_pages/addMedicine.php?message=Only jpg, jpeg, png.");
                exit;
            }
        } 
        else {
            header("location: ../admin_pages/addMedicine.php?message=You Didnt Upload.");
            exit;
        }
    
        $insertProd = "INSERT INTO product (productName, productExpired, productQty, productType, productImg, productPrice,stockType, notificationType, shelve) 
                       VALUES('$productName', null, $productQty, '$productType', '$fileName', $productPrice, 'o', '$notificationType', '$location'),
                             ('$productName', '$productExpiration', $productQty, '$productType', '$fileName', $productPrice, '$stockType', '$notificationType', '$location')";
                        mysqli_query($conn, $insertProd);
                        mysqli_close($conn);

    } 
    else {
        $getNameAndExpire = "SELECT * FROM product WHERE productName = '$productName' AND productExpired = '$productExpiration'";
        $results = mysqli_query($conn, $getNameAndExpire);
        $QuantityRow = mysqli_fetch_assoc($results);
        $allQuantitys = $QuantityRow['productQty'];
        $overallQuantys = (int)$allQuantitys + (int)$productQty;
        
        $getAllQuantity = "SELECT * FROM product WHERE productName = '$productName' AND stockType = 'o'";
        $results2 = mysqli_query($conn, $getAllQuantity);
        $AllQuantityRow = mysqli_fetch_assoc($results2);
        $allQuantity = $AllQuantityRow['productQty'];
        $overallQuanty = (int)$allQuantity + (int)$productQty;
        $overallQuanty2 = (int)$allQuantity - (int)$productQty;
        

        if(mysqli_num_rows($results) > 0) {
            $updateProduct = "UPDATE product SET productQty=$overallQuantys WHERE productName = '$productName' AND productExpired = '$productExpiration'";
            mysqli_query($conn, $updateProduct);

            $updateProduct2 = "UPDATE product SET productQty=$overallQuanty WHERE productName = '$productName' AND stockType = 'o'";
            mysqli_query($conn, $updateProduct2);
            header("location: ../admin_pages/newStock.php");
        }
        else {
            $sqlInsert = "INSERT INTO product (productName, productExpired, productQty, productType, productImg, productPrice, stockType, notificationType, shelve) 
                        VALUES ('$productName', '$productExpiration', $productQty, '$productType', '$productImgs', $productPrice, '$stockType', '$notificationType', '$location')";
                        mysqli_query($conn, $sqlInsert);
            
            $updateProduct2 = "UPDATE product SET productQty=$overallQuanty WHERE productName = '$productName' AND stockType = 'o'";
            mysqli_query($conn, $updateProduct2);
            mysqli_close($conn);
            header("location: ../admin_pages/newStock.php");
        }
    }
    
}
