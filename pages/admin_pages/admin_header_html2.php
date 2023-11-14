

	<ul>
		<li><a href="./profile.php"><?php echo $_SESSION['firstname']; ?><img src='../../profile/<?php echo $userProfile ?>' alt='Profile' class='user-profile' /></a></li>
		<li>
			<div class="notif">
				<img src="../../assets/notif.svg" alt="home" width="20px" id="notifShow" onclick="loadDoc()">
				<?php echo (mysqli_num_rows($resultNotifys) > 0) ? '<div class="notifCount">' . mysqli_num_rows($resultNotifys) . '</div>' : ''; ?>

				<div class="notifContent">
					<div class="notifTittle">Notification</div>
					<?php
					$sql8 = "SELECT * FROM product WHERE stockType = 'e'";
					$result8 = mysqli_query($conn, $sql8);
					while ($rw = mysqli_fetch_assoc($result8)) { 
					?>
					<div class='<?php echo ($rw['notificationType'] == "nr") ? 'notif-inbox-nr' : 'notif-inbox'?>' >
						<div class="name-productpic">
							<div class="notif-message">The Item <?php echo $rw['productName']; ?> is Expired at <?php echo $rw['shelve']; ?> Quantity Deducted <?php echo $rw['productQty']?></div>
							<img src="../../uploads/<?php echo $rw['productImg'];?>" class="notif-productpic"/>
						</div>

						<!-- <div class="notif-date"><?php echo date('s') . ' ' . 'seconds ago' ?></div> -->
					</div>
					<?php } ?>
				</div>

			</div>
		</li>
	</ul>
</nav>

<?php 
   $updatedDate = date('Y-m-d');
   $getExpired = "SELECT * FROM product WHERE productExpired = '$updatedDate'";
   $expiredResult = mysqli_query($conn, $getExpired);

   if (mysqli_num_rows($expiredResult) > 0){
      while ($rows = mysqli_fetch_assoc($expiredResult)){
         $productId = $rows['productId'];
         $productName = $rows['productName'];
         $productQty = $rows['productQty'];

         $sqls = "UPDATE product SET stockType = 'e', productExpired = 'exp', notificationType = 'nr' WHERE productId = $productId";
         mysqli_query($conn, $sqls);

         $selectProduct = "SELECT * FROM product WHERE productName = '$productName' AND stockType = 'o'";
         $selectProductResult = mysqli_query($conn, $selectProduct);
         $selectProductRow = mysqli_fetch_assoc($selectProductResult);
         $productQtyRow = $selectProductRow['productQty'];
      
         $updateProductRows = "UPDATE product SET productQty = ($productQtyRow - $productQty) WHERE productName = '$productName' AND stockType = 'o'";
         mysqli_query($conn, $updateProductRows);
      }

   } 
?>