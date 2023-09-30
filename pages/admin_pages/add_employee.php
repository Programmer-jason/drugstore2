
<?php include __DIR__.'\admin_header_php.php'; ?> 
<?php 
   if (isset($_GET['message'])) {
      $getMessage = $_GET['message'];
      echo "<script>alert('$getMessage')</script>";
   }

   $sql = "SELECT * FROM `signUp` WHERE `role` = 'customer';";
   $result = mysqli_query($conn, $sql);
   // $row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Add Employee</title>
   <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   <link rel="shortcut icon" href="../images/sample logo.png" type="image/x-icon" />
   <link rel="stylesheet" href="../../style/navbar.css" />
   <link rel="stylesheet" href="../../style/sidenav.css">
   <link rel="stylesheet" href="../../style/manageAccount.css" />
</head>

<?php include __DIR__.'\admin_header_html.php'; ?>
   <div class="head-title">Users/Add Employee</div>
<?php include __DIR__.'\admin_header_html2.php'; ?>

   <div class="manage-account-content">

      <div class="table-container">
         <form action="../validation/addEmployee.php" method="post" class="add-employee-form">
            <h1 class="titleHead">ADD EMPLOYEE</h1>

            <div class="form-row">
               <div class="form-group col-md-6">
                  <label for="firstName">Firstname</label>
                  <input type="text" name="firstName" id="firstName" placeholder="Firstname" class="form-control" required>
               </div>
               <div class="form-group col-md-6">
                  <label for="lastName">Lastname</label>
                  <input type="text" name="lastName" id="lastName" placeholder="Lastname" class="form-control" required>
               </div>
            </div>

            <div class="form-row">

               <div class="form-group col-md-14">
                  <label for="email">Email</label>
                  <input type="email" name="email" id="email" placeholder="Email" class="form-control" required>
               </div>
               <!-- <div class="form-group col-md-6">
            <label for="confirmpassword">Confirm Password</label>
            <input type="password" name="confirmpassword" id="confirmpassword" placeholder="Confirm Password" class="form-control" required>
            </div> -->
               <div class="form-group col-md-6">
                  <label for="password">Password</label>
                  <input type="password" name="password" id="password" placeholder="Password" class="form-control" required>
               </div>
            </div>

            <div class="form-row">
               <div class="form-group col-md-6">
                  <label for="age">Age</label>
                  <input type="number" name="age" id="age" placeholder="Age" class="form-control" min="0 " max="150">
               </div>
               <div class="form-group col-md-6">
                  <label for="contact">Contact</label>
                  <input type="text" name="contact" id="contact" placeholder="Contact" class="form-control" maxlength="11" required>
               </div>
            </div>


            <div class="form-row">
               <div class="form-group col-md-6">
                  <label for="address">Address</label>
                  <input type="text" name="address" id="address" placeholder="address" class="form-control" required>
               </div>
               <div class="form-group col-md-6">
                  <label for="brgy">Brgy/Zone</label>
                  <input type="text" name="brgy" id="brgy" placeholder="brgy" class="form-control" required>
               </div>
            </div>

            <div class="gender">
               <label for="female">Female</label>
               <input type="radio" name="gender" id="female" value="f" required>
               <label for="male">Male</label>
               <input type="radio" name="gender" id="male" value="m" required>
               <label for="others">Others</label>
               <input type="radio" name="gender" id="others" value="o" required>
            </div>

            <input type="text" name="role" value="employee" hidden>
            <input type="submit" name="submit" value="Add" class="submit">
         </form>
      </div>
      <a href="./add_employee.php" class="add-employee btn-success">Add Employee</a>

   </div>

<?php include __DIR__.'\admin_footer.php'; 
