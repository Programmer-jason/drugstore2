<?php include __DIR__.'\admin_header_php.php'; ?>
<?php
    if(isset($_GET['message'])){
        $getMessage = $_GET['message'];
        echo "<script>alert('$getMessage')</script>";
    }

    $sql = "SELECT * FROM product";
    $result = mysqli_query($conn, $sql);

    if (isset($_POST['submit'])) {
        $error = $_GET['message'];
    }
?>

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Add Sales</title>
   <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   <link rel="shortcut icon" href="../images/sample logo.png" type="image/x-icon" />
   <link rel="stylesheet" href="../../style/navbar.css" />
   <link rel="stylesheet" href="../../style/sidenav.css">
   <link rel="stylesheet" href="../../style/addMedicine.css" />
</head>

<?php include __DIR__.'\admin_header_html.php'; ?>
    <div class="head-title">Add Item</div>
<?php include __DIR__.'\admin_header_html2.php'; ?>

    <div class="add-product-content">
        <form action="../validation/addMedicineValidation.php" method="post" enctype="multipart/form-data" class="form">
            <div class="upload-product">
                <img src="../../product_image/vitamins.jpg" class="image" />
                <input type="file" name="upload" id="file" class="file-upload">
            </div>

            <div class="inputGroups">
                <div class="one">
                    <div>Product Name</div>
                    <input type="text" name="productName" id="productName" placeholder="name" required>

                    <div>Item Type</div>
                    <select name="productType" id="productType">
                        <option value="m">Medicine</option>
                        <option value="p">Product</option>
                    </select>

                    <div>Expiration</div>
                    <input type="date" name="productExpiration" id="productExpiration" required>
                </div>

                <div class="two">
                    <div>Price</div>
                    <input type="number" name="productPrice" id="productPrice" value="0.00" required>

                    <div>Location</div>
                    <input type="text" name="location" id="location" required>

                    <div>Quantity</div>
                    <input type="number" name="productQty" id="productQty" value="1" required>

                    <input name="stockType" id="stockType" value="n" hidden>
                </div>

                <input type="submit" value="Add" name="submit" id="add" class="btn-success">
        </form>
    </div>

<?php include __DIR__.'\admin_footer.php'; 
