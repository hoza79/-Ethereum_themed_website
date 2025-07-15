<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require("NewUserDatabase.php");
require("securityCheck.php");

$database = new NewUserDatabase("studentmysql.miun.se", "hoza2100", "dazip2kq", "hoza2100"); 
$database->connect();
$securityCheck = new SecurityCheck($database->getConnection());


if($_SERVER["REQUEST_METHOD"] == "POST"){ 
    if(isset($_POST["sign-in"])){
        $username = htmlspecialchars($_POST["UserName"]); 
        $password = htmlspecialchars($_POST["Password"]); 
        $inputFields = [$username, $password];  
        
        foreach($inputFields as $field){
            if(empty($field)){
                $loginMessage = "Both username and password are required."; 
                break;
            }
        }

        if(empty($loginError)) { 
            if ($securityCheck->usernameExists($username)){
                if($securityCheck->validateLoginInfo($username, $password)){
                  $loginMessage = "Logged in successfully. You can now submit your jobb request"; 
                  echo '<script>
                            setTimeout(function(){
                                window.location.href = "./sendRequest.php";
                            }, 4000); // 3000 milliseconds = 3 seconds
                        </script>';
                } 
                else {
                    $loginMessage = "Incorrect username or password. Please try again.";
                }
            } 
            else {
                $loginMessage = "Username not found. Create a new account and try to login again.";
            } 
            
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/commonCss.css" />
    <link rel="stylesheet" href="../css/sign_in_style.css" />
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
        <!--login form-->
        <form class="login" action="" method="post">
          <input type="text" name="UserName" placeholder="User Name" required>
          <input type="password" name="Password" placeholder="Password" required>
          <button class="sign-in-button" type="submit" name="sign-in">Sign In </button> <br>
          <?php if (isset($loginMessage)) { ?>
              <div class="log-in-message"><?php echo $loginMessage; ?></div>
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