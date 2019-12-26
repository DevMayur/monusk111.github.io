<?php

require_once("includes/classes/FormSanitizer.php");
require_once("includes/config.php");
require_once("includes/classes/Account.php");
require_once("includes/classes/Constants.php");

$account = new Account($con);

    if(isset($_POST["submitButton"])){
       
        $username=FormSanitizer::sanitizeFromUsername($_POST["username"]);
        $password=FormSanitizer::sanitizeFromPassword($_POST["password"]);

        $success = $account->login($username,$password);

        if($success){
            $_SESSION["userLoggedIn"] = $username;
            header("Location: index.php");
        }

    }

    function getInputValues($name){
        if(isset($_POST[$name])){
            echo $_POST[$name];
        }
    }

?>


<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="assets/style/style.css"/>
        <title>WELCOME TO MULTIPLEX</title>
    </head>
    <body>
        <div class="signInContainer">

            <div class="column">

                <div class = "header">
                    <img src="assets/images/multiplex.png" title="Logo" alt="site logo"/>
                    <h3>SIGN UP</h3>
                    <span>TO CONTINUE</span>
                </div>

                <form method="POST">
                    <?php echo $account->getError(Constants::$loginFailed); ?>
                    <input type="text" name="username" placeholder="username" value="<?php getInputValues("username")?>" required>

                    <input type="password" name="password" placeholder="password" required>

                    <input type="submit" name="submitButton" value="SUBMIT">

                </form>

                <a href="register.php" class="signInMessage">Not a member? Sign Up</a>

            </div>
        </div>
    </body>
</html>