<?php
session_start();
include '../connect.php';

// GET SIGNUP
$sql = "SELECT * FROM `signUp`;";
$result = mysqli_query($conn, $sql);

$userProf = $_SESSION['user'];
$sql6 = "SELECT * FROM signup WHERE email = '$userProf'";
$result6 = mysqli_query($conn, $sql6);
$userProfile = mysqli_num_rows($result6);
$row6 = mysqli_fetch_assoc($result6);

if (isset($_SESSION["user"])) {
	$user = $_SESSION['user'];

	$sql4 = "SELECT * FROM signUp WHERE email = '$user'";
	$result4 = mysqli_query($conn, $sql4);
	$row4 = mysqli_fetch_assoc($result4);

	$userProfile = $row4['userProfile'];
}
//NOTIFICATION

$sqlNotifys = "SELECT * FROM product WHERE notificationType = 'nr'";
$resultNotifys = mysqli_query($conn, $sqlNotifys);

//PAGINATION

if (isset($_GET['page_no'])) {
	$page_no = $_GET['page_no'];
} else {
	$page_no = 1;
}

$record_number_perpage = 10;
$offset = ($page_no - 1) * $record_number_perpage;

$number_of_paymentDetails = "SELECT COUNT(*) FROM paymentdetails";
$paymentDetailsResult = mysqli_query($conn, $number_of_paymentDetails);
$total_rows = mysqli_fetch_array($paymentDetailsResult)[0];
$total_page = ceil($total_rows / $record_number_perpage);

$getPaymentDetails = "SELECT * FROM paymentdetails LIMIT $offset, $record_number_perpage";
$getPaymentDetailsResult = mysqli_query($conn, $getPaymentDetails);


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Profile</title>
	<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
	<link rel="shortcut icon" href="../images/sample logo.png" type="image/x-icon" />
	<link rel="stylesheet" href="../../style/navbar.css" />
	<link rel="stylesheet" href="../../style/paymentDetails.css" />
	<link rel="stylesheet" href="../../style/sidenav.css">
</head>

<body>

	<div class="admin-box">
		<div class="brand">
			<img src="../../images/sample logo.png" alt="no image" />
			<a href="#">Medicure Drug</a>
		</div>

		<div class="profile-pic">
			<img src="<?php echo '../../profile/' . $row6['userProfile']; ?>" alt='<?php echo "profile"; ?>' class="user-image">
			<div>
				<?php echo $_SESSION['firstname'] . ' ' . $_SESSION['lastname']; ?>
			</div>
		</div>

		<a href="../profile.php" class="box dashboard">
			<div><img src="../../assets/dashboard.svg" alt="dashboard" width="25px"></div>
			<div> Dashboard</div>
		</a>

		<a href="./inventory.php" class="box stock">
			<div><img src="../../assets/inventory.svg" alt="dashboard" width="25px"></div>
			<div>Inventory</div>
		</a>

		<?php if ($row6['role'] == 'admin') { ?>
			<a href="../admin_pages/sales.php" class="box sales">
				<div><img src="../../assets/sales.svg" alt="dashboard" width="25px"></div>
				<div>Sales</div>
			</a>

			<a href="../admin_pages/manageAccount.php" class="box manage-account">
				<div><img src="../../assets/manageUsers.svg" alt="dashboard" width="25px"></div>
				<div>Users</div>
			</a>
		<?php } ?>

		<a href="./paymentDetails.php" class="box reserved">
			<div><i class="fa-solid fa-money-check-dollar" style="color: #ffffff;"></i></div>
			<div>Payment</div>
		</a>

		<a href="./addMedicine.php" class="box add-medicine">
			<div><img src="../../assets/addProduct.svg" alt="dashboard" width="25px"></div>
			<div>Add Product</div>
		</a>

		<a href="../editProfile.php" class="box edit-profile">
			<div><img src="../../assets/editProfile.svg" alt="dashboard" width="25px"></div>
			<div>Edit Profile</div>
		</a>

		<a href="../logout.php" class="box logout">
			<div><img src="../../assets/logout.svg" alt="dashboard" width="25px"></div>
			<div>Logout</div>
		</a>



	</div>

	<div class="content-container">
		<nav>
			<div class="head-title">Payment</div>

			<ul>
				<li><a href="../profile.php"><?php echo $_SESSION['firstname']; ?><img src='../../profile/<?php echo $userProfile ?>' alt='User Profile' class='user-profile' /></a></li>
				<li>
					<div class="notif">
						<img src="../../assets/notif.svg" alt="home" width="20px" id="notifShow" onclick="loadDoc()">

						<?php
						echo (mysqli_num_rows($resultNotifys) > 0) ? '<div class="notifCount">' . mysqli_num_rows($resultNotifys) . '</div>' : '';
						?>

						<div class="notifContent">
							<div class="notifTittle">Notification</div>

							<?php
							$sql8 = "SELECT * FROM product WHERE notificationType = 'nr' ORDER BY productId DESC";
							$result8 = mysqli_query($conn, $sql8);
							while ($rw = mysqli_fetch_assoc($result8)) {
							?>

								<?php
								echo ($rw['notificationType'] == "nr") ? "<div class='notif-inbox-nr'>" : "<div class='notif-inbox'>";
								?>

								<div class="notif-message">The Item <?php echo $rw['productName']; ?> is Expired</div>
								<div class="notif-message"><?php echo date('s') . ' ' . 'seconds ago' ?></div>
						</div>
					<?php } ?>
					</div>
				</li>
			</ul>
		</nav>


		<div class="manage-account-content">
			<div class="table-container">
				<section class="payment-details-head">
					<div class="search-container">
						<input type="search" onchange="paymentSearch()" name="search" id="search-payment" placeholder="transaction number">
						<span class="submit" onclick="paymentSearch()">search</span>
					</div>
				</section>

				<table>
					<tr>
						<th>Transaction Number</th>
						<th>Payment Method</th>
						<th>Name</th>
						<th>Amount</th>
						<th>Status</th>
						<th>Item Recieve</th>
						<th>Date Recieved</th>
						<th>View Item</th>
					</tr>

					<?php if (mysqli_num_rows($getPaymentDetailsResult) > 0) { ?>
						<?php while ($rows = mysqli_fetch_assoc($getPaymentDetailsResult)) { ?>
							<tr>
								<td>
									<?php echo $rows["refId"]; ?>
								</td>

								<td>
									<?php echo $rows["paymentType"]; ?>
								</td>

								<td>
									<?php echo $rows["name"]; ?>
								</td>

								<td>
									<?php echo '₱ ' . $rows["price"]; ?>
								</td>

								<td>
									<?php
									switch ($rows["paymentStatus"]) {
										case 'paid':
											echo ($rows["paymentAction"] == 'recieve') ? '<div class="payment-success">Successful</div>' : '<div class="payment-success">' . $rows["paymentStatus"] . '</div>';
											break;

										case 'failed':
											echo '<div class="payment-failed">' . $rows["paymentStatus"] . '</div>';
											break;

										default:
											echo '<div class="payment-pending">' . $rows["paymentStatus"] . '</div>';
									}
									?>
								</td>

								<td class='payment-action-container'>
									<?php
									$payment_action = $rows["paymentAction"];
									$payment_id = $rows["paymentId"];
									switch ($rows["paymentAction"]) {
										case 'recieve':
											echo "<div class='recieve'>Recieve</div>";
											break;

										case 'not_recieve':
											echo ($rows["paymentStatus"] == 'failed') ? '' : "<div class='not-recieve' ondblclick='recieve($payment_id)'>Recieve</div>";
											break;

										default:
											echo ($rows["paymentStatus"] == 'pending') ? '' : '<div class="payment-pending>Pending</div>';
									}
									?>
								</td>

								<td>
									<?php echo $rows["dateRecieved"]; ?>
								</td>

								<td>
									<a href="../view_item.php?refId=<?php echo $rows["refId"]; ?>">view item</a>
								</td>
							</tr>
						<?php } ?>
					<?php } ?>
				</table>
			</div>

			<section>
				<div class="pagination">
					<a href="<?php echo ($page_no <= 1) ? '#' : './paymentDetails.php?page_no=' . ($page_no - 1) ?>" class="next-prev">Prev</a>
					<?php
					for ($i = 1; $i <= $total_page; $i++) {
						echo ($i == $page_no) ? "<a href='./paymentDetails.php?page_no=$i' class='next-prev'>$i</a>" :
							"<a href='./paymentDetails.php?page_no=$i' class='total-page'>$i</a>";
					}
					?>
					<a href="<?php echo ($page_no >= $total_page) ?  '#' : './paymentDetails.php?page_no=' . ($page_no + 1) ?>" class="next-prev">Next</a>
				</div>
			</section>
		</div>

		<script src=" https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<script src="../../js/jsAnimation.js"></script>
		<script>
			function paymentSearch() {
				let search = document.getElementById("search-payment").value

				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.querySelector('.table-container').innerHTML = this.responseText
					}
				};
				xhttp.open("GET", "./paymentDetailsSearch.php?searching=" + search, true);
				xhttp.send();
			}

			function loadDoc() {
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {}
				};
				xhttp.open("GET", "./notify.php", true);
				xhttp.send();

				document.querySelector(".notifCount").style.display = "none"
			}

			function recieve(payment_id) {
				window.location = "../validation/item_recieve.php?payment_id=" + payment_id;
			}
		</script>

</body>

</html>