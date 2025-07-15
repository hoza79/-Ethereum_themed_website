<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require("NewUserDatabase.php");
$database = new NewUserDatabase("studentmysql.miun.se", "hoza2100", "dazip2kq", "hoza2100"); 
$database->connect();

if($_SERVER["REQUEST_METHOD"] == "POST"){ 
  if(isset($_POST["Send"])){
    $name = htmlspecialchars($_POST["Name"]); 
    $email = htmlspecialchars($_POST["Email"]);
    $subject = htmlspecialchars($_POST["Subject"]); 
    $inputFields = [$name, $email, $subject]; 
    $allFieldsFilled = true; 
    foreach($inputFields as $field){
        if(empty($field)){
            $loginMessage = "Please fill in all fields."; 
            $allFieldsFilled = false;
            break;
        }
    }
    if($allFieldsFilled){
      $database->insertContactForm($name, $email, $subject); 
      $send_request_message = "Thank you for contacting us.";
    }
   
  }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="../css/commonCss.css" />
    <link rel="stylesheet" href="../css/sendRequest.css" />
    <link rel="stylesheet" href="../css/contact.css" />


    

</head>
<body>


    <nav>
      <ul class="nav-elements">
        <li class="logo">
          <img src="../images/vitalik-logo.jpg" alt="ethereum" />
          <span class="Ethereum">Ethereum</span>
        </li>
        <li><a href="./Dashboard.php" class="btn nav-link">Home</a></li>
        <li><a href="./Dashboard.php" class="btn nav-link">About</a></li>
         <li><a href="./Dashboard.php" class="btn nav-link">Tokenomics</a></li>
         <li><a href="./sendRequest.php" class="btn nav-link">Work with us</a></li>
      </ul>
    </nav>


    <section class="custom-box">
        <!--Contact form-->
        <div class="contact-container">
          <h1>Submit your jobb request here</h1>
          <form class="contact" action="sendRequest.php" method="post"> 
              <input class="Name" type="text" name="Name" placeholder="Name" required>
              <input class="Email" type="text" name="Email" placeholder="Email" required>
              <textarea class="Subject" name="Subject" placeholder="About you" required></textarea>
              <button class="send-button" type="submit" name="Send">Send</button> <br>
              <?php if (isset($send_request_message)) { ?>
                <div class="send_request_message"><?php echo $send_request_message; ?></div>
              <?php } 
              ?> 
          </form>
        </div>
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