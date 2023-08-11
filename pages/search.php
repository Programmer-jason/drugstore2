<?php session_start();
include './connect.php';

$search_term = $_POST['search'];

$sql = "SELECT * FROM product WHERE productName LIKE '%$search_term%' AND stockType BETWEEN 'n' AND 'o' ORDER BY productId desc";
$result = mysqli_query($conn, $sql);


if (isset($_SESSION["user"])) {
   $user = $_SESSION['user'];
   $firstName = $_SESSION['firstname'];
   $lastName = $_SESSION['lastname'];
   $sql2 = "SELECT * FROM signUp WHERE email = '$user'";
   $result2 = mysqli_query($conn, $sql2);
   $row2 = mysqli_fetch_assoc($result2);

   $userProfile = $row2['userProfile'];
}


$user = (isset($_SESSION["user"])) ? $_SESSION['user'] : '';
$getUser = "SELECT * FROM signUp WHERE email = '$user'";
$getUserResult = mysqli_query($conn, $getUser);
$fetchUser = mysqli_fetch_assoc($getUserResult);

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Search</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="stylesheet" href="../style/medicine.css">
   <link rel="stylesheet" href="../style/navbar.css">
  <link rel="stylesheet" href="../style/button.css" />

</head>

<body>
  <div class="medicine-container">
   <nav>
      <div class="brand">
         <img src="../images/sample logo.png" alt="no image" />
         <a href="../index.php">Medicure Drug</a>
      </div>

      <i class="fa fa-bars" aria-hidden="true"></i>
      <ul>
         <li><a href="../index.php">Home</a></li>
         <li><a href="./medicine.php">Product</a></li>
         <li><a href="./about.php">About</a></li>
         <li><a href="./contact.php">Contact</a></li>
         <li> 
          <?php if(isset($_SESSION["user"])){
                    switch($_SESSION["role"]){
                    case "admin" :
                        echo "<a href ='./pages/admin_pages/profile.php'>$firstName<img src='../profile/$userProfile' alt='User Profile' class='user-profile'/></a>";
                        break;
                    case "customer" :
                        echo "<a href ='./customer_pages/profile.php'>$firstName<img src='../profile/$userProfile' alt='User Profile' class='user-profile'/></a>";
                        break;
                    }   
                }else{
                    echo "<a href ='./signIn.php'>Sign In </a>";
                }
          ?>
        </li>

      </ul>
   </nav>

   
   <div class="mp-list">
    <form action="./search.php" method="post">
        <input type="search" name="search" id="search">
        <input type="submit" value="Search" id="submit">
    </form>

    <?php
      $sqls = "SELECT * FROM product WHERE stockType BETWEEN 'n' AND 'o' ORDER BY productId desc";
      $results = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
        while ($rows = mysqli_fetch_assoc($result)) {
          $prodId2 = $rows['productId'];

      ?>
        <div class="mp-card">
            <img src="<?php echo '../uploads/' . $rows['productImg']; ?>" alt='image' class="img-list">

            <div class="details">
                <div class="product-name">
                <?php echo $rows['productName'] ?>
                </div>
                
                <div>
                <?php echo '₱'.' '.$rows['productPrice'] ?>
                </div>

                <!-- <div>
                <?php echo $rows['productQty'] == 0 ? 'Not Available' : 'Available' ?>
                </div> -->

                <div>
                <?php echo 'Stock'.' '.$rows['productQty'] ?>
                </div>
            </div>

            <div class="cart-btn">
                <a href="./validation/add_to_favorite.php?favId=<?php echo $rows['productId'];?>" class='favorite-btn'>
                    <i id ='heart'
                    class='fa-solid fa-heart'
                    style='color:<?php 
                                        
                                    if(isset($_SESSION["user"])){
                                            $userId =  $fetchUser['userId'];
                                            $getFavorite = "SELECT * FROM user_favorite WHERE product_id = $prodId2 AND user_id = $userId";
                                            $favoriteResult = mysqli_query($conn, $getFavorite);
                                            $fetchFavorite = mysqli_fetch_assoc($favoriteResult);
                                            echo (mysqli_num_rows($favoriteResult) > 0) ? "red" : "#313131";

                                        }
                                        else{}
                                    
                                ?>'
                    >
                    </i>
                </a>

                <div class="buy-btn" onclick="checkout(<?php echo $rows['productId']; ?>)">Buy</div>
            </div>

        </div>
        <?php } ?>
      <?php } ?>

      <div class="checkout">
      </div>

    <!-- <?php if (mysqli_num_rows($result) == 0) {
    echo "<h2>Not Found</h2>";
    } ?> -->


   </div>
  </div>

 
  <?php if(isset($_SESSION["user"])){ ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../js/jsAnimation.js"></script>
    <script>
      function checkout(getProductId) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(getProductId) {
              if (this.readyState == 4 && this.status == 200) {
                document.querySelector(".checkout").innerHTML = this.responseText;
              }
          };
          xhttp.open("GET", `./validation/buyValidation.php?buyId=${getProductId}`, true);
          xhttp.send();
      }
    </script>

   <?php  } else{
                header("location: ./signIn.php?message=You need to signin");
              } ?>
              
</body>
</html>