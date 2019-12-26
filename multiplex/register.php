<?php

    require_once("includes/classes/FormSanitizer.php");
    require_once("includes/config.php");
    require_once("includes/classes/Account.php");
    require_once("includes/classes/Constants.php");

    $account = new Account($con);

    if(isset($_POST["submitButton"])){
        $firstname=FormSanitizer::sanitizeFromString($_POST["firstName"]);
        $lastname=FormSanitizer::sanitizeFromString($_POST["lastName"]);
        $username=FormSanitizer::sanitizeFromUsername($_POST["username"]);
        $email=FormSanitizer::sanitizeFromEmail($_POST["email"]);
        $email2=FormSanitizer::sanitizeFromEmail($_POST["email1"]);
        $password=FormSanitizer::sanitizeFromPassword($_POST["password"]);
        $password2=FormSanitizer::sanitizeFromPassword($_POST["password1"]);


        $success = $account->register($firstname,$lastname,$username,$email,$email2,$password,$password2);
        if($success){
            $_SESSION["userLoggedIn"] = $username;
            header("Location: index.php");
        }else{

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
                    <?php echo $account->getError(Constants::$firstNameCharacters); ?>
                    <input type="text" name="firstName" placeholder="First name" value="<?php getInputValues("firstName")?>" required>
                    
                    <?php echo $account->getError(Constants::$lastNameCharacters); ?>
                    <input type="text" name="lastName" placeholder="Last name" value="<?php getInputValues("lastName")?>" required>

                    <?php echo $account->getError(Constants::$usernameCharacters); ?>
                    <?php echo $account->getError(Constants::$usernameTaken); ?>
                    <input type="text" name="username" placeholder="username" value="<?php getInputValues("username")?>" required>

                    <input type="email" name="email" placeholder="Email" value="<?php getInputValues("email")?>" required>

                    <?php echo $account->getError(Constants::$emailsDoNotMatch)?>
                    <input type="email" name="email1" placeholder="confirm email" value="<?php getInputValues("email1")?>" required>

                    <input type="password" name="password" placeholder="password" value="<?php getInputValues("password")?>" required>

                    <?php echo $account->getError(Constants::$passwordsDoNotMatch)?>
                    <?php echo $account->getError(Constants::$passwordCharacters)?>
                    <input type="password" name="password1" placeholder="confirm password" value="<?php getInputValues("password1")?>" required>

                    <input type="submit" name="submitButton" value="SUBMIT">

                </form>

                <a href="login.php" class="signInMessage">Already member? Sign In</a>

            </div>
        </div>
    </body>
</html>