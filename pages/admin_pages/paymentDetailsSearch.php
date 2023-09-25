<?php
session_start();
include '../connect.php';

//SEARCH PAYMENT
if($_GET['searching'] != ''){
$searchOnchange = $_GET['searching'];
$sql_payment_search = "SELECT * FROM `paymentDetails` WHERE `refId` LIKE '%$searchOnchange%'";
$result_payment_search = mysqli_query($conn, $sql_payment_search);
} else {
   // $searchOnchange = $_GET['searching'];
   $sql_payment_search = "SELECT * FROM `paymentDetails`";
   $result_payment_search = mysqli_query($conn, $sql_payment_search);
}

?>

<table>
   <tr>
      <th>Reference Number</th>
      <th>Payment Method</th>
      <th>Name</th>
      <th>Amount</th>
      <!-- <th>Status</th> -->
      <th>Item Recieve</th>
      <th>Date Recieved</th>
   </tr>
      <?php if (mysqli_num_rows($result_payment_search) > 0) : ?>
         <?php while ($rows = mysqli_fetch_assoc($result_payment_search)) : ?>

      <tr>
         <td>
            <?php echo $rows["refId"]?>
         </td>

         <td>
            <?php echo $rows["paymentType"]?>
         </td>

         <td>
            <?php echo $rows["name"]?>
         </td>

         <td>
            <?php echo '₱ '.$rows["price"]; ?>
         </td>

         <!-- <td>
            <?php 
               switch($rows["paymentStatus"]){
                  case 'paid':
                     echo '<div class="payment-success">'.$rows["paymentStatus"].'</div>';
                     break;

                  case 'failed':
                     echo '<div class="payment-failed">'.$rows["paymentStatus"].'</div>';
                     break;

                  default:
                     echo '<div class="payment-pending">'.$rows["paymentStatus"].'</div>';
                  }
                  ?>
         </td> -->

         <td class='payment-action-container'>
            <?php 
               $payment_action = $rows["paymentAction"];
               $payment_id = $rows["paymentId"];
               switch($rows["paymentAction"]){
                  case 'recieve':
                     echo "<div class='recieve' onclick='recieve($payment_id)'>Recieve</div>";
                     break;
                     
                  case 'not_recieve':
                     echo "<div class='not-recieve' onclick='recieve($payment_id)'>Recieve</div>";
                     break;
                        
                  default:
                     echo '<div class="payment-pending">Pending</div>';
               }
            ?>
         </td>

         <td>
            <?php echo $rows["dateRecieved"]; ?>
         </td>

      </tr>
         <?php endwhile; ?>
      <?php endif; ?>
</table>