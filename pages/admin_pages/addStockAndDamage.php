<?php
include '../connect.php';
    if(isset($_GET['ST'])){
        $getStockType = $_GET['ST'];
    }

    $getId = $_GET['stockId'];
    $queryProduct = "SELECT * FROM product WHERE productId = $getId";
    $productResult = mysqli_query($conn, $queryProduct);
    $product_row = mysqli_fetch_assoc($productResult);
    $product_img = $product_row['productImg'];
    $product_name =  $product_row['productName'];
    $product_expired =  $product_row['productExpired'];
    $product_price =  $product_row['productPrice'];
    $product_type =  $product_row['productType'];
    $product_location =  $product_row['shelve'];
?>

<div><?php echo (isset($_GET['ST'])) ? 'Add Damage' : 'Add Stock' ?></div>
<form action="../validation/<?php echo (isset($_GET['ST'])) ? 'addDamageValidation.php' : 'addMedicineValidation.php'?>" method="post" enctype="multipart/form-data" class="form">
    <div class="upload-product">
        <img src="../../product_image/<?php echo $product_img;?>" class="image" />
    </div>
    
    <div class="inputGroups">
        <div class="one">
            <div>Product Name</div>
            <input type="text" name="productName" id="productName" value="<?php echo $product_name?>" >
        
            <?php echo (!isset($_GET['ST'])) ? '<div>Item Type</div>' : ''?>
            <select name="productType" id="productType" <?php echo (!isset($_GET['ST'])) ? '' : 'hidden' ?>>
                <?php echo ($product_type == 'm') ? '<option value="m">Medicine</option>' : '<option value="p">Product</option>'?>
            </select>

            <?php echo (!isset($_GET['ST'])) ? '<div>Expiration</div>' : ''?>
            <input type="date" name="productExpiration" id="productExpiration" value="<?php echo $product_expired?>" <?php echo (!isset($_GET['ST'])) ? '' : 'hidden' ?>>
        </div>
        
        <div class="two">
            <?php echo (!isset($_GET['ST'])) ? '<div>Price</div>' : ''?>
            <input type="number" name="productPrice" id="productPrice" value="<?php echo $product_price?>" <?php echo (!isset($_GET['ST'])) ? '' : 'hidden' ?>>
            
            <?php echo (!isset($_GET['ST'])) ? '<div>Location</div>' : ''?>
            <input type="text" name="location" id="location" value="<?php echo $product_location?>" <?php echo (!isset($_GET['ST'])) ? '' : 'hidden' ?>>
                
            <div>Quantity</div>
            <input type="number" name="productQty" id="productQty" value="1" required>
            
            <input name="stockType" id="stockType" value="n" hidden>
        </div>
        <input type="submit" value="Add" name="submit" id="add" class="btn-success">
    </div>
</form>



  
