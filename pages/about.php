<?php session_start();
include './connect.php';

if (isset($_SESSION["user"])) {
    $user = $_SESSION['user'];
    $firstName = $_SESSION['firstname'];
    $lastName = $_SESSION['lastname'];
    $sql = "SELECT * FROM signUp WHERE email = '$user'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $userProfile = $row['userProfile'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>About</title>
    <link rel="shortcut icon" href="../Images/sample logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../style/common.css" />
    <link rel="stylesheet" href="../style/about.css" />
    <link rel="stylesheet" href="../style/navbar.css" />
    <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@400&display=swap" rel="stylesheet">


    <head>

    <body>
        <section class="main-page">
            <nav>
                <div class="brand">
                    <img src="../Images/sample logo.png" alt="no image" />
                    <a href="../index.php">Medicure Drug</a>
                </div>

                <ul>
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="./medicine.php">Product</a></li>
                    <li><a href="./about.php">About</a></li>
                    <li><a href="./contact.php">Contact</a></li>
                    <li> 
                    <?php if(isset($_SESSION["user"])){
                        switch($_SESSION["role"]){
                        case "admin" :
                            echo "<a href ='./pages/admin_pages/profile.php'>$firstName <img src='../profile/$userProfile' alt='User Profile' class='user-profile'/></a>";
                            break;
                        case "customer" :
                            echo "<a href ='./customer_pages/profile.php'>$firstName <img src='../profile/$userProfile' alt='User Profile' class='user-profile'/></a>";
                            break;
                        }
                    }else{
                        echo "<a href ='./signIn.php'>Sign In </a>";

                    }
                    ?>
                </li>
                </ul>
            </nav>

            <section class="about">
                <h1>About</h1>
                <div class="about-sub">
                    <img src="../images/medicine.svg" alt="" />
                    <div class="sub-sub-about">
                        <h2>What we do</h2>
                        <p>
                            Lorem ipsum dolor sit amet. Aut aspernatur reiciendis ad debitis
                            velit eos nostrum quas in reiciendis optio. Et voluptatem
                            deserunt est minima earum qui recusandae enim eum laboriosam
                            repudiandae aut quisquam voluptatum. Ab consequatur sunt et
                            incidunt modi et quas necessitatibus est impedit officia sed
                            temporibus quia nam velit aliquid sed quae rerum.
                        </p>
                        <a href="./medicine.php" class="gradient-btn">See our product</a>
                    </div>
                </div>
                <div class="about-sub">
                    <div class="sub-sub-about">
                        <h2>Quality Service</h2>
                        <p>
                            Lorem ipsum dolor sit amet. Aut aspernatur reiciendis ad debitis
                            velit eos nostrum quas in reiciendis optio. Et voluptatem
                            deserunt est minima earum qui recusandae enim eum laboriosam
                            repudiandae aut quisquam voluptatum. Ab consequatur sunt et
                            incidunt modi et quas necessitatibus est impedit officia sed
                            temporibus quia nam velit aliquid sed quae rerum.
                        </p>
                        <a href="./contact.php" class="gradient-btn">Contact Us!</a>
                    </div>
                    <img src="../images/Doctors.svg" alt="" />
                </div>
            </section>
            <script src="./js/navbar.js"></script>
    </body>
</head>
</head>

</html>