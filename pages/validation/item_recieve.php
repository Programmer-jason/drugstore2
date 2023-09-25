<?php session_start();

include("../connect.php");

$payment_id = $_GET['payment_id'];

$get_payment_action = "SELECT `paymentAction` FROM `paymentDetails` WHERE `paymentId` = $payment_id";
$payment_action_result = mysqli_query($conn, $get_payment_action);
$payment_action_row = mysqli_fetch_assoc($payment_action_result);
$dateNow = date('M-j-Y');

if($payment_action_row['paymentAction'] == 'recieve'){
    $sql_updating_payment = "UPDATE `paymentdetails` SET `paymentAction`='not_recieve' WHERE paymentId = $payment_id";
    mysqli_query($conn, $sql_updating_payment);
    header("location: ../admin_pages/paymentDetails.php");
}

else {
    $sql_updating_payment = "UPDATE `paymentdetails` SET `paymentAction`='recieve',`dateRecieved`='$dateNow' WHERE paymentId = $payment_id";
    mysqli_query($conn, $sql_updating_payment);
    echo "<div class='not-recieve' onclick='recieve($payment_id)'>Recieve</div>";
    header("location: ../admin_pages/paymentDetails.php");

}