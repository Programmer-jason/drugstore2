<?php include './admin_header_php.php'; ?> 

<?php
   //PAGINATION
   $record_number_perpage = 8;
   $offset = ($page_no - 1) * $record_number_perpage;

   $number_of_newstock = "SELECT COUNT(*) FROM signUp WHERE role = 'employee'";
   $newstock_result = mysqli_query($conn, $number_of_newstock);
   $total_rows = mysqli_fetch_array($newstock_result)[0];
   $total_page = ceil($total_rows / $record_number_perpage);

   $employee = "SELECT * FROM signUp WHERE role = 'employee' LIMIT $offset, $record_number_perpage";
   $result = mysqli_query($conn, $employee);
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
   <link rel="stylesheet" href="../../style/sidenav.css">
   <link rel="stylesheet" href="../../style/manageAccount.css" />
</head>

<?php include './admin_header_html.php'; ?>
   <div class="head-title">Users/Customer</div>
<?php include './admin_header_html2.php'; ?>
         
   <div class="manage-account-content">
      <div class="table-container">
         <section class="payment-details-head">
            <div class="search-container">
               <input type="search" onchange="paymentSearch()" name="search" id="search-payment" placeholder="search">
               <span class="submit" onclick="paymentSearch()">search</span>
            </div>
         </section>

         <table>
            <tr>
               <th>Profile</th>
               <th>Fullname</th>
               <th>Email</th>
               <th>Gender</th>
               <th>Age</th>
               <!-- <th>Type</th> -->
               <th>Contact</th>
               <th>Action</th>
            </tr>
            <?php if (mysqli_num_rows($result) > 0) : ?>
               <?php while ($rows = mysqli_fetch_assoc($result)) : ?>
                  <tr>
                     <td>
                        <img src="../../profile/<?php echo $rows['userProfile'];?>" alt="" width="30px" height="27px">
                     </td>

                     <td>
                        <?php echo $rows["firstName"] . " " . $rows["lastName"]; ?>
                     </td>

                     <td>
                        <?php echo $rows["email"]; ?>
                     </td>

                     <td>
                        <?php echo $rows["gender"]; ?>
                     </td>

                     <td>
                        <?php echo $rows["age"]; ?>
                     </td>

                     <!-- <td>
                        <?php echo $rows["role"]; ?>
                     </td> -->

                     <td>
                        <?php echo '0' . $rows["contact"]; ?>
                     </td>

                     <td>
                        <!-- <a href="./update.php?id=<?php echo $rows['userId']; ?>" class="btn btn-primary btn-sm">Update</a> -->
                        <a href="./delete_user.php?deleteId=<?php echo $rows['userId']; ?>" class="btn btn-danger btn-sm">Delete</a>
                     </td>
                  </tr>
               <?php endwhile; ?>
            <?php endif; ?>
         </table>
      </div>
      <section>
         <div class="pagination">
            <a href="<?php echo ($page_no <= 1) ? '#' : './manageAccount.php?page_no=' . ($page_no - 1) ?>" class="next-prev">Prev</a>
            <?php
            for ($i = 1; $i <= $total_page; $i++) {
               echo ($i == $page_no) ? "<a href='./manageAccount.php?page_no=$i' class='next-prev'>$i</a>" :
                  "<a href='./manageAccount.php?page_no=$i' class='total-page'>$i</a>";
            }
            ?>
            <a href="<?php echo ($page_no >= $total_page) ?  '#' : './manageAccount.php?page_no=' . ($page_no + 1) ?>" class="next-prev">Next</a>
         </div>
      </section>

      <a href="./add_employee.php" class="add-employee btn-success">Add Employee</a>
   </div>

<?php include './admin_footer.php'; ?> 
