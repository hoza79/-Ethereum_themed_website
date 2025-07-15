<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require("NewUserDatabase.php");
require("securityCheck.php");
$database = new NewUserDatabase("studentmysql.miun.se", "hoza2100", "dazip2kq", "hoza2100"); 
$database->connect();
$securityCheck = new SecurityCheck($database->getConnection());


if($_SERVER["REQUEST_METHOD"] == "POST"){ 
    if(isset($_POST["create-account"])){
        $firstname = htmlspecialchars($_POST["FirstName"]); 
        $lastname = htmlspecialchars($_POST["LastName"]);
        $age = htmlspecialchars($_POST["Age"]); 
        $username = htmlspecialchars($_POST["Username"]); 
        $password = htmlspecialchars($_POST["Password"]); 
        $inputFields = [$firstname, $lastname, $age, $username, $password];  
        $emptyField = false;  

        foreach($inputFields as $field ){
          if(empty($field)){
            $emptyField = true; 
            break; 
          }
        }
        if($emptyField){
          $create_account_message = "Both username and password are required.";
          exit();
        }
        else if($securityCheck->usernameExists($username)){
          $create_account_message = "Username already exists. Choose a different username.";
        }
        else{
          $database->insertNewUser($firstname, $lastname, $age, $username, $password);
          $create_account_message = "Your account has been created successfully
                         You can now submit your jobb request."; 

          echo 
              '<script>
                setTimeout(function(){
                    window.location.href = "./sendRequest.php";
                }, 4000); // 3000 milliseconds = 3 seconds
              </script>';

        }
        
    }
} 
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel="stylesheet" href="../css/commonCss.css" />
    <link rel="stylesheet" href="../css/contact.css" />



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
         <!--Create account form-->
         

         <form class="create-account" action="createAccount.php" method="post">
          <input type="text" name="FirstName" placeholder="Firstname" required>
          <input type="text" name="LastName" placeholder="Lastname" required>
          <input type="text" name="Age" placeholder="Age" required>
          <input type="text" name="Username" placeholder="Username" required>
          <input type="password" name="Password" placeholder="Password" required>
          <button class="create-account-button" type="submit" name="create-account">create account</button> <br>
         <?php if (isset($create_account_message)) { ?>
              <div class="create_account_message"><?php echo $create_account_message; ?></div>
          <?php } ?> 
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