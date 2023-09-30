


<ul>
            <li><a href="../profile.php"><?php echo $_SESSION['firstname']; ?><img src='../../profile/<?php echo $userProfile ?>' alt='User Profile' class='user-profile' /></a></li>
            <li>
               <div class="notif">
                  <img src="../../assets/notif.svg" alt="home" width="20px" id="notifShow" onclick="loadDoc()">
                  <?php echo (mysqli_num_rows($resultNotifys) > 0) ? '<div class="notifCount">' . mysqli_num_rows($resultNotifys) . '</div>' : ''; ?>

                  <div class="notifContent">
                     <div class="notifTittle">Notification</div>

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