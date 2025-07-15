<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST["yes"])) {
      header("Location: ./login.php");
      exit(); 
  } elseif (isset($_POST["no"])) {
      header("Location: ./createAccount.php");
      exit(); 
  }
}







?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/commonCss.css" />
    <link rel="stylesheet" href="../css/contact.css" />
    <title>Contact</title>


</head>
<body>

    <nav>
      <ul class="nav-elements">
        <li class="logo">
          <img src="../images/vitalik-logo.jpg" alt="ethereum" />
          <span class="Giga-Chad">Ethereum</span>
        </li>
        <li><a href="../index.php" class="btn nav-link">Home</a></li>
        <li><a href="../index.php" class="btn nav-link">About</a></li>
         <li><a href="../index.php" class="btn nav-link">Tokenomics</a></li>
         <li><a href="contact.php" class="btn nav-link">Work with us</a></li>
      </ul>
    </nav>
  


    

    <section class="custom-box">
        <form class="yes-no" action="" method="post">
            <h2>Do you have an account?</h2>
            <button class="yes" name="yes">Yes</button>
            <button class="no" name="no">No</button>
        </form>
    </section>


    <footer>
      <div class="footer-container">
        <div class="social-text">Our Social</div>
        <div class="social-icons">
          <a href="https://www.reddit.com/r/ethereum/" target="_blank"><img src="../images/reddit.png" alt="Reddit"></a>
          <a href="https://twitter.com/ethereum" target="_blank"><img src="../images/twitter.avif" alt="Twitter"></a>
        </div>
      </div>
    </footer>

 

</body>

</html>




<?php

?>