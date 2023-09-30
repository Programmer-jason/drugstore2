<?php include __DIR__.'\admin_header_php.php'; ?>
<?php
	//PAGINATION
	$record_number_perpage = 9;
	$offset = ($page_no - 1) * $record_number_perpage;

	$number_of_newstock = "SELECT COUNT(*) FROM product WHERE stockType = 'd'";
	$newstock_result = mysqli_query($conn, $number_of_newstock);
	$total_rows = mysqli_fetch_array($newstock_result)[0];
	$total_page = ceil($total_rows / $record_number_perpage);

	$sql = "SELECT * FROM product WHERE stockType = 'd' LIMIT $offset, $record_number_perpage";
	$result = mysqli_query($conn, $sql);
?>

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
   <link rel="stylesheet" href="../../style/damagedStock.css" />
</head>

<?php include __DIR__.'\admin_header_html.php'; ?>
	<div class="head-title">Inventory / Damaged Stock</div>
<?php include __DIR__.'\admin_header_html2.php'; ?>

	<div class="inventory-content">
		<div class="table-container">

			<section class="payment-details-head">
				<div class="search-container">
					<input type="search" onchange="paymentSearch()" name="search" id="search-payment" placeholder="item name">
					<span class="submit" onclick="paymentSearch()">search</span>
				</div>

				<div class="stock-links">
					<a href="./newStock.php">New Stock</a>
					<a href="./oldStock.php">Old Stock</a>
					<a href="./damagedStock.php">Damaged Stock</a>
					<a href="./expiredStock.php">Expired Stock</a>
				</div>
			</section>


			<table>
				<tr>
					<th>Item Name</th>
					<th>Price</th>
					<th>Stock</th>
					<th>Expired Date</th>
					<?php if ($row6['role'] == 'admin') { ?>
						<th>Action</th>
					<?php } ?>

				</tr>
				<?php if (mysqli_num_rows($result) > 0) : ?>
					<?php while ($rows = mysqli_fetch_assoc($result)) : ?>
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

							<?php if ($row6['role'] == 'admin') { ?>
								<td>

									<a href="./delete_medicine.php?deleteId=<?php echo $rows['productId']; ?>" class="btn-danger">Delete</a>
								</td>
							<?php } ?>

						</tr>
					<?php endwhile; ?>
				<?php endif; ?>
			</table>
		</div>

		<section>
			<div class="pagination">
				<a href="<?php echo ($page_no <= 1) ? '#' : './damagedStock.php?page_no=' . ($page_no - 1) ?>" class="next-prev">Prev</a>
				<?php
				for ($i = 1; $i <= $total_page; $i++) {
					echo ($i == $page_no) ? "<a href='./damagedStock.php?page_no=$i' class='next-prev'>$i</a>" :
						"<a href='./damagedStock.php?page_no=$i' class='total-page'>$i</a>";
				}
				?>
				<a href="<?php echo ($page_no >= $total_page) ?  '#' : './damagedStock.php?page_no=' . ($page_no + 1) ?>" class="next-prev">Next</a>
			</div>
		</section>

	</div>

<?php include __DIR__.'\admin_footer.php'; 
