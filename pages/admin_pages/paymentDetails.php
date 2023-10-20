<?php include __DIR__.'\admin_header_php.php' ?>
<?php
	// GET SIGNUP
	$sql = "SELECT * FROM signUp";
	$result = mysqli_query($conn, $sql);

	//PAGINATION
	$record_number_perpage = 10;
	$offset = ($page_no - 1) * $record_number_perpage;

	$number_of_paymentDetails = "SELECT COUNT(*) FROM paymentdetails";
	$paymentDetailsResult = mysqli_query($conn, $number_of_paymentDetails);
	$total_rows = mysqli_fetch_array($paymentDetailsResult)[0];
	$total_page = ceil($total_rows / $record_number_perpage);

	$getPaymentDetails = "SELECT * FROM paymentdetails WHERE paymentType!='overthecounter' LIMIT $offset, $record_number_perpage";
	$getPaymentDetailsResult = mysqli_query($conn, $getPaymentDetails);

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Payment Details</title>
	<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
	<link rel="shortcut icon" href="../images/sample logo.png" type="image/x-icon" />
	<link rel="stylesheet" href="../../style/navbar.css" />
	<link rel="stylesheet" href="../../style/sidenav.css">
	<link rel="stylesheet" href="../../style/paymentDetails.css" />
</head>

<?php include __DIR__.'\admin_header_html.php'; ?>
	<div class="head-title">Payment</div>
<?php include __DIR__.'\admin_header_html2.php'; ?>

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
								<?php echo '₱ ' . number_format($rows["price"]); ?>
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
										echo "<div class='recieve'>Pick Up</div>";
										break;

									case 'not_recieve':
										echo ($rows["paymentStatus"] == 'failed') ? '' : "<div class='not-recieve' ondblclick='recieve($payment_id)'>Pick Up</div>";
										break;

									default:
										echo ($rows["paymentStatus"] == 'pending') ? '' : '<div class="payment-pending>Pending</div>';
								}
								?>
							</td>

							<td>
								<?php echo date('M d Y', strtotime($rows["dateRecieved"])); ?>
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
		
		function recieve(payment_id) {
			window.location = "../validation/item_recieve.php?payment_id=" + payment_id;
		}
	</script>

<?php include __DIR__.'\admin_footer.php'; 
