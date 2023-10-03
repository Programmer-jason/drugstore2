<?php
   session_start();
   include '../connect.php';

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

   //SEARCH PAYMENT
   if ($_GET['searching'] != '') {
      $searchOnchange = $_GET['searching'];
      $sql_payment_search = "SELECT * FROM `paymentDetails` WHERE `refId` LIKE '%$searchOnchange%' LIMIT $offset, $record_number_perpage";
      $result_payment_search = mysqli_query($conn, $sql_payment_search);
   } else {
      // $searchOnchange = $_GET['searching'];
      $sql_payment_search = "SELECT * FROM `paymentDetails` LIMIT $offset, $record_number_perpage";
      $result_payment_search = mysqli_query($conn, $sql_payment_search);
   }
?>
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

				<?php if (mysqli_num_rows($result_payment_search) > 0) { ?>
					<?php while ($rows = mysqli_fetch_assoc($result_payment_search)) { ?>
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
								<?php echo $rows["dateRecieved"]; ?>
							</td>

							<td>
								<a href="../view_item.php?refId=<?php echo $rows["refId"]; ?>">view item</a>
							</td>
						</tr>
					<?php } ?>
				<?php } ?>
			</table>