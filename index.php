<?php
  session_start();

  // Check if the user is already logged in, if yes then redirect him to welcome page
  if(isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"] === true){
      header("location: index.php");
      exit;
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acasa</title>
    <link rel="stylesheet" href="./css/master.css">
  </head>
  <body>

    <div class="container">
      <form class="sign__in" action="./includes/sign_in_inc.php" method="post">
        <h1 class="form__title">Sign In</h1>
        <div class="form__input__group">
          <input type="text" class="form__input" name="user_email" placeholder="E-mail">
        </div>
        <div class="form__input__group">
          <input type="password" class="form__input" name="user_password" placeholder="Password">
        </div>

        <button type="submit" class="form__button" name="submit">Sign In</button>

        <p class="form__text">
          <a href="#" class="form__link">Forgot your password?</a>
        </p>

        <p class="form__text">
          <a href="sign_up.php" class="form__link">Don't have an account? Create account</a>
        </p>
      </form>
    </div>

  </body>
</html>
