<?php session_start();
    include './connect.php';
    if(!isset($_SESSION['reference_id'])){
        header("location: ./medicine.php");
    }
?>

<?php include  __DIR__.'\header.php';?>
    <nav style='box-shadow: none;'>
        <div class="brand">
            <img src="../images/sample logo.png" alt="no image" />
            <a href="../index.php">Medicure Drug</a>
        </div>
    </nav>

    <div class="container">
        <section class="payment-success">
            <?php echo ($_SESSION['payment_status'] == 'paid') ? '
            <div class="payment-sucess">Payment Successful</div>' : '<div class="payment-failed">Payment Failed</div>'?>
            <div class="reference"><?php echo $_SESSION['reference_id']; ?></div>
            <div class="name"><?php echo $_SESSION['customer_name']; ?></div>
            <a href="./medicine.php">Go Back</a>
        </section>
    </div>

<?php include __DIR__.'\footer.php';?>

<?php session_destroy(); ?>
