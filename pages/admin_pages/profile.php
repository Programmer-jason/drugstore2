<?php include __DIR__.'\admin_header_php.php' ?>
<?php 
    //get all product type medicine
    $sql = "SELECT * FROM product WHERE productType = 'm' ";
    $result = mysqli_query($conn, $sql);
    $medicineType = mysqli_num_rows($result);

    //get all product type product
    $sql2 = "SELECT * FROM product WHERE productType = 'p' ";
    $result2 = mysqli_query($conn, $sql2);
    $productType = mysqli_num_rows($result2);

    // get expired
    $sql3 = "SELECT * FROM `product` WHERE stockType = 'e'";
    $result3 = mysqli_query($conn, $sql3);
    $totalExpired = mysqli_num_rows($result3);

    //get total sales
    $sql4 = "SELECT * FROM product";
    $result4 = mysqli_query($conn, $sql4);
    $totalSales = 0;

    if (mysqli_num_rows($result4) > 0) {
        while ($rows = mysqli_fetch_assoc($result4)) {
            $totalSales += $rows['productPrice'];
        }
    }

    //GET TOTAL MALE
    $sql5 = "SELECT * FROM signup WHERE gender = 'm'";
    $result5 = mysqli_query($conn, $sql5);
    $totalMale = mysqli_num_rows($result5);

    $sql9 = "SELECT * FROM product WHERE stockType = 'o' ORDER BY productId DESC LIMIT 11";
    $result9 = mysqli_query($conn, $sql9);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="shortcut icon" href="../../images/sample logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="../../style/navbar.css" />
    <link rel="stylesheet" href="../../style/sidenav.css" />
    <link rel="stylesheet" href="../../style/profile.css" />
</head>

<?php include __DIR__.'\admin_header_html.php'; ?>
    <div class="head-title">Dashboard</div>
<?php include __DIR__.'\admin_header_html2.php'; ?>

    <div class="user-container">
        <div class="dashboard-content">
            <div class="box total-medicine">
                <div><i class="fa-solid fa-capsules fa-2xl" style="color: #007430;"></i></div>

                <div>
                    <h2>
                        <?php echo $medicineType; ?>
                    </h2>
                    <div>Total Medicines</div>
                </div>
            </div>

            <div class="box total-product">
                <div><i class="fa-solid fa-box-open fa-2xl" style="color: #007430;"></i></div>
                <div>
                    <h2>
                        <?php echo $productType; ?>
                    </h2>

                    <div>Total Product</div>
                </div>
            </div>

            <div class="box total-expired">
                <div><i class="fa-solid fa-bolt fa-2xl" style="color: #007430;"></i></div>

                <div>
                    <h2>
                        <?php echo $totalExpired; ?>
                    </h2>

                    <div>Expired</div>
                </div>
            </div>

            <div class=" box total-sales">
                <div><i class="fa-solid fa-chart-line fa-2xl" style="color: #007430;"></i></div>

                <div>
                    <h2>
                        <?php echo '₱' . ' ' . $totalSales; ?>
                    </h2>

                    <div>Total Sales</div>
                </div>
            </div>
        </div>

        <div class="down-side">
            <div class="new-stocklist">
                <div class="new-item">New Added Item</div>
                <table>
                    <tr>
                        <th>Item Image</th>
                        <th>Item Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Shelve</th>
                        <!-- <th>Expired Date</th> -->
                    </tr>
                    <?php if (mysqli_num_rows($result9) > 0) : ?>
                        <?php while ($rows = mysqli_fetch_assoc($result9)) : ?>
                            <tr>
                                <td>
                                    <img src="../../uploads/<?php echo $rows['productImg'];?>" alt="" width="50px">
                                </td>
                                <td>
                                    <?php echo $rows['productName']; ?>
                                </td>

                                <td>
                                    <?php echo '₱' . $rows['productPrice']; ?>
                                </td>

                                <td>
                                    <?php echo $rows['productQty']; ?>
                                </td>

                                <td>
                                    <?php echo $rows['shelve']; ?>
                                </td>

                                <!-- <td>
                                    <?php echo $rows['productExpired']; ?>
                                </td> -->
                            </tr>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </table>
            </div>

            <div class="total-user-graph">
                <div id="myChart" class="box total-users"></div>
                <div id="userGenderChart" class="box user-gender"></div>
            </div>
        </div>
    </div>

    <script src="../../js/jsChart.js"></script>
<?php include __DIR__.'\admin_footer.php'; 
