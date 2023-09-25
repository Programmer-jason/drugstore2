<?php
include '../connect.php';

if (isset($_POST["submit"])) {
    $productName = htmlspecialchars($_POST['productName']);
    $productExpiration = htmlspecialchars($_POST['productExpiration']);
    $productQty = htmlspecialchars($_POST['productQty']);
    $productPrice = htmlspecialchars($_POST['productPrice']);
    $productType = htmlspecialchars($_POST['productType']);
    $stockType = htmlspecialchars($_POST['stockType']);
    $notificationType = ($stockType == 'e') ? 'nr' : '';

    $fileName = $_FILES["upload"]["name"];
    $fileTmpname = $_FILES["upload"]["tmp_name"];
    $fileSize = $_FILES["upload"]["size"];
    $fileType = $_FILES["upload"]["type"];
    $targetDir = "../../uploads/";

    $targetFile = $targetDir . basename($fileName);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $typeFile = array("jpg", "png", "jpeg", "gif");

    $sql = "SELECT `productName` FROM `product` WHERE `productName` = '$productName' ";
    $result = mysqli_query($conn, $sql);

    if (!mysqli_num_rows($result) > 0) {

        if (!empty($fileName)) {
            if (in_array($imageFileType, $typeFile)) {
                if (file_exists($targetFile)) {
                    header("location: ../admin_pages/addMedicine.php?message=File Exist");
                } else {
                    if ($fileSize > 1000000) {
                        header("location: ../admin_pages/addMedicine.php?message=File To Big");
                    } else {
                        if (move_uploaded_file($fileTmpname, $targetFile)) {
                            header("location: ../admin_pages/addMedicine.php?message=The file has been uploaded.");
                        } else {
                            header("location: ../admin_pages/addMedicine.php?message=Error File Upload.");
                        }
                    }
                }
            } else {
                header("location: ../admin_pages/addMedicine.php?message=Only jpg, jpeg, png.");
            }
        } else {
            header("location: ../admin_pages/addMedicine.php?message=You Didnt Upload.");
        }

        $stmt = $conn->prepare("INSERT INTO `product` (productName, productExpired, productQty, productType, productImg, productPrice,stockType, notificationType) VALUES (?,?,?,?,?,?,?,?)");
        $stmt->bind_param("ssississ", $productName, $productExpiration, $productQty, $productType, $fileName, $productPrice, $stockType, $notificationType);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    } else {
        header("location: ../admin_pages/addMedicine.php?message=Name Exist Find Another");
    }

}
