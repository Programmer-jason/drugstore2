<?php include  __DIR__ . '\header.php'; ?>
<?php

//======== view_item.php ========//

$payment_ref = $_GET['refId'];
$select_checkout = "SELECT * FROM checkout_item WHERE ref_id ='$payment_ref'";
$checkout_result = mysqli_query($conn, $select_checkout);

//==============================//

?>
<div class="container">

    <section class="header">
        <div class="title">Item Buy</div>
    </section>

    <section class="content">

        <?php if (mysqli_num_rows($checkout_result) > 0) : ?>
            <?php while ($rows = mysqli_fetch_assoc($checkout_result)) : ?>
                <?php
                $item_id = $rows['item_id'];

                $select_product = "SELECT * FROM product WHERE productId = $item_id";
                $product_result = mysqli_query($conn, $select_product);
                $product_row = mysqli_fetch_assoc($product_result);
                $product_name = $product_row['productName'];
                $product_img = $product_row['productImg'];
                ?>

                <div class="item-buy-content">
                    <div class="product-name"><?php echo $product_name; ?></div>
                    <img src="../product_image/<?php echo $product_img; ?>" class="product-img" title="product-image" />
                </div>
            <?php endwhile; ?>
        <?php endif; ?>

        <?php if (!isset($_SESSION['user'])) { ?>
            <a href="./payment_successful.php">Go Back</a>
        <?php } ?>

    </section>
</div>

<?php include __DIR__ . '\footer.php'; ?>