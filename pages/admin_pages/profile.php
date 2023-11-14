<?php include './admin_header_php.php'; ?> 
<?php 
    //get all product type medicine
    $sql = "SELECT DISTINCT productName FROM product WHERE productType = 'm' ";
    $result = mysqli_query($conn, $sql);
    $medicineType = mysqli_num_rows($result);

    //get all product type product
    $sql2 = "SELECT DISTINCT productName FROM product WHERE productType = 'p' ";
    $result2 = mysqli_query($conn, $sql2);
    $productType = mysqli_num_rows($result2);

    //get expired
    $sql3 = "SELECT DISTINCT productName FROM product WHERE stockType = 'e'";
    $result3 = mysqli_query($conn, $sql3);
    $totalExpired = mysqli_num_rows($result3);

    //get total sales
    // $getTotalSales = "SELECT SUM(price) AS total FROM paymentDetails";
    // $totalSalesResult = mysqli_query($conn, $getTotalSales);
    // $totalSalesRow = mysqli_fetch_assoc($totalSalesResult);
    // $totalSales = $totalSalesRow['total'];
    $getTotalSales = "SELECT * FROM sales ORDER BY salesId Desc";
    $totalSalesResult = mysqli_query($conn, $getTotalSales);
    $totalSalesRow = mysqli_fetch_assoc($totalSalesResult);
    $startingDate = $totalSalesRow['startingDate'];
    $readableStartDate = date('M d Y', strtotime($startingDate));
    $endDate = $totalSalesRow['endDate'];
    $readableEndDate = date('Y', strtotime($endDate));
    $saleTotal = $totalSalesRow['totalSales'];
    $targetSales = $totalSalesRow['targetSales'];

    //GET TOTAL MALE
    $sql5 = "SELECT * FROM signup WHERE gender = 'm'";
    $result5 = mysqli_query($conn, $sql5);
    $totalMale = mysqli_num_rows($result5);

    $sql9 = "SELECT * FROM product WHERE stockType = 'o' AND productQty > 0 ORDER BY productId DESC LIMIT 11";
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

<?php include './admin_header_html.php'; ?>
    <div class="head-title">Dashboard</div>
<?php include './admin_header_html2.php'; ?>

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
                        <?php echo '₱' . ' ' . number_format($saleTotal); ?>
                    </h2>

                    <div>Total Sales</div>
                </div>

            </div>

        </div>

        <div class="down-side">
            <div id="chart_div" style="width: 100%; height: 500px;"></div>

            <!-- <div class="new-stocklist">
                <div class="new-item">New Added Item</div>
                <table>
                    <tr>
                        <th>Item Image</th>
                        <th>Item Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Location</th>
                        
                    </tr>
                    <?php if (mysqli_num_rows($result9) > 0) : ?>
                        <?php while ($rows = mysqli_fetch_assoc($result9)) : ?>
                            <tr>
                                <td>
                                    <img src="../../uploads/<?php echo $rows['productImg'];?>" alt="" width="30px">
                                </td>
                                <td>
                                    <?php echo $rows['productName']; ?>
                                </td>

                                <td>
                                    <?php echo '₱' . number_format($rows['productPrice']); ?>
                                </td>

                                <td>
                                    <?php echo $rows['productQty']; ?>
                                </td>

                                <td>
                                    <?php echo $rows['shelve']; ?>
                                </td>

                             
                            </tr>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </table>
            </div> -->

        </div>
    </div>
    
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" defer>
        
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);
      
            function drawChart() {
              var data = google.visualization.arrayToDataTable([
                <?php
                    echo "
                      ['Year', 'Sales', 'Target'],
                      [ '2019', 1252000,     2112000],
                      [ '2020', 922232,     1389433],
                      [ '2021', 832035,     1203423],
                      [ '2022', 982034,     1210243],
                      ['$readableEndDate', $saleTotal, $targetSales],
                    "
                ?>
              ]);
      
              var options = {
                title: 'Sales',
                hAxis: {title: 'Year',  titleTextStyle: {color: '#333'}},
                backgroundColor: '#f8f8f8',
                vAxis: {minValue: 0},
                colors: ['green','lightblue']
              };
      
              var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
              chart.draw(data, options);
            }
        
    </script>
<?php include './admin_footer.php'; ?>
