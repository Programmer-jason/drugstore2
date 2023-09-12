<?php session_start();
include './connect.php';

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

//get total male

$sql5 = "SELECT * FROM signup WHERE gender = 'm'";
$result5 = mysqli_query($conn, $sql5);
$totalMale = mysqli_num_rows($result5);

//get user profile

$userProf = $_SESSION['user'];

$sql6 = "SELECT * FROM signup WHERE email = '$userProf'";
$result6 = mysqli_query($conn, $sql6);
$userProfile = mysqli_num_rows($result6);
$row6 = mysqli_fetch_assoc($result6);

if (isset($_SESSION["user"])) {
    $user = $_SESSION['user'];

    $sql7 = "SELECT * FROM signUp WHERE email = '$user'";
    $result7 = mysqli_query($conn, $sql7);
    $row7 = mysqli_fetch_assoc($result7);

    $userProfile = $row7['userProfile'];
}

//NOTIFICATION

$sqlNotifys = "SELECT * FROM product WHERE notificationType = 'nr'";
$resultNotifys = mysqli_query($conn, $sqlNotifys);

$sql9 = "SELECT * FROM product WHERE stockType = 'n' ORDER BY productId DESC LIMIT 13";
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
    <link rel="shortcut icon" href="../images/sample logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="../style/navbar.css" />
    <link rel="stylesheet" href="../style/sidenav.css" />
    <link rel="stylesheet" href="../style/profile.css" />
    <script src="../js/jsChart.js"></script>
</head>

<body>

    <div class="admin-box">
        <div class="brand">
            <img src="../images/sample logo.png" alt="no image" />
            <a href="#">Medicure Drug</a>
        </div>

        <div class="profile-pic">
         <img src="<?php echo '../profile/' . $row6['userProfile']; ?>" alt='<?php echo "profile"; ?>' class="user-image">
         <div>
            <?php echo $_SESSION['firstname'] . ' ' . $_SESSION['lastname']; ?>
         </div>
      </div>

        <a href="./profile.php" class="box dashboard">
            <div><img src="../assets/dashboard.svg" alt="dashboard" width="25px"></div>
            <div> Dashboard</div>
        </a>

        <a href="./admin_pages/inventory.php" class="box stock">
            <div><img src="../assets/inventory.svg" alt="dashboard" width="25px"></div>
            <div>Inventory</div>
        </a>

        <?php if($row6['role'] == 'admin') {?>
            <a href="./admin_pages/sales.php" class="box sales">
                <div><img src="../assets/sales.svg" alt="dashboard" width="25px"></div>
                <div>Sales</div>
            </a>
            
            <a href="./admin_pages/manageAccount.php" class="box manage-account">
                <div><img src="../assets/manageUsers.svg" alt="dashboard" width="25px"></div>
                <div>Users</div>
            </a>
            
        <?php } ?>

        <a href="./admin_pages/paymentDetails.php" class="box reserved">
            <div><i class="fa-solid fa-money-check-dollar" style="color: #ffffff;"></i></div>
            <div>Payment</div>
        </a>

        <a href="./admin_pages/addMedicine.php" class="box add-medicine">
            <div style="color: red;"><img src="../assets/addProduct.svg" alt="dashboard" width="25px" style="color: red;"></div>
            <div>Add Product</div>
        </a>

        <a href="./editProfile.php" class="box edit-profile">
            <div><img src="../assets/editProfile.svg" alt="dashboard" width="25px"></div>
            <div>Edit Profile</div>
        </a>
        

        <a href="./logout.php" class="box logout">
            <div><img src="../assets/logout.svg" alt="dashboard" width="25px"></div>
            <div>Logout</div>
        </a>
    </div>


    <div class="content-container">
        <nav>
            <div class="head-title">Dashboard</div>

            <ul>
                <li><a href="./profile.php"><?php echo $_SESSION['firstname']; ?><img src='../profile/<?php echo $userProfile; ?>' alt='User Profile' class='user-profile' /> </a></li>
                <li>
                    <div class="notif">
                        <img src="../assets/notif.svg" alt="home" width="20px" id="notifShow" onclick="loadDoc()">
                        <?php echo (mysqli_num_rows($resultNotifys) > 0) ? '<div class="notifCount">' . mysqli_num_rows($resultNotifys) . '</div>' : ''; ?>

                        <div class="notifContent">
                            <div class="notifTittle">Notifications</div>

                            <?php
                            $sql8 = "SELECT * FROM product WHERE notificationType = 'nr' ORDER BY productId DESC";
                            $result8 = mysqli_query($conn, $sql8);
                            while ($rw = mysqli_fetch_assoc($result8)) { ?>
                                <?php echo ($rw['notificationType'] == "nr") ? "<div class='notif-inbox-nr'>" : "<div class='notif-inbox'>"; ?>

                                <div class="notif-message">The Item <?php echo $rw['productName']; ?> is Expired</div>
                                <div class="notif-message"><?php echo date('s') . ' ' . 'seconds ago' ?></div>
                        </div>
                    <?php } ?>

                    </div>
    </div>
    </li>
    </ul>
    </nav>

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
                        <th>Item Name</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Expired Date</th>
                    </tr>
                    <?php if (mysqli_num_rows($result9) > 0) : ?>
                        <?php while ($rows = mysqli_fetch_assoc($result9)) : ?>
                            <tr>
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
                                    <?php echo $rows['productExpired']; ?>
                                </td>
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


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../js/jsAnimation.js"></script>
    <script>
        function loadDoc() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {

                }
            };
            xhttp.open("GET", "./admin_pages/notify.php", true);
            xhttp.send();

            document.querySelector(".notifCount").style.display = "none"
        }
    </script>





</body>

</html>