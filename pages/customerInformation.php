<?php include  __DIR__.'\header.php';?>

<div class="container">
    <section>
        <nav>
            <div class="brand">
                <img src="../images/sample logo.png" alt="no image" />
                <a href="../index.php">Medicure Drug</a>
            </div>
        </nav>
    </section>

    <section class="customer-info">
        <div class="title-head">Customer Information</div>

        <form action="../paymongoApi/createSession.php" method="post">
            <div class="row">
                <div class="for">Name</div>
                <input type="text" name="fullname" placeholder="Fullname" class="input" required>
            </div>

            <div class="row">
                <div class="for">Email</div>
                <input type="email" name="email" placeholder="Email" class="input" required>
            </div>
            <!-- <div>Contact Number</div>
            <input type="text" name="contact" maxlength="11" placeholder="Optional"> -->
            <input type="submit" value="Proceed" name="submit" class="btn-submit">
        </form>
    </section>

<?php include __DIR__.'\footer.php';?>