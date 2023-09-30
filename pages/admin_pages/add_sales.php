<?php include __DIR__.'\admin_header_php.php' ?>

<!DOCTYPE html>
<html lang="en">

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
   <link rel="stylesheet" href="../../style/add_sales.css" />
</head>

<?php include __DIR__.'\admin_header_html.php'; ?>
   <div class="head-title">Sales/Add Sales</div>
<?php include __DIR__.'\admin_header_html2.php'; ?>


   <div class="inventory-content">
      <div class="modal">
         <form action="../validation/sales_add.php" method="post">
            <div>From Year</div>
            <input type="text" name="from" id="from" maxlength="4" placeholder="Ex: 1990" required>

            <div>To Year</div>
            <input type="text" name="to" id="to" maxlength="4" placeholder="Ex: 1991" required>

            <div>Total Sales</div>
            <input type="text" name="addSales" id="addSales" required>

            <input type="submit" value="Add" name="submit" id="Add" class="btn-success">
         </form>
      </div>
   </div>

<?php include __DIR__.'\admin_footer.php'; 
