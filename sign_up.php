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
      <form class="sign__in" action="./includes/sign_up_inc.php" method="post">
        <h1 class="form__title">Sign Up</h1>
        <div class="form__input__group">
          <input type="text" name="user_name" class="form__input" placeholder="Username">
        </div>
        <div class="form__input__group">
          <input type="text" name="user_email" class="form__input" placeholder="E-mail">
        </div>
        <div class="form__input__group">
          <input type="password" name="user_password" class="form__input" placeholder="Password">
        </div>
        <div class="form__input__group">
          <input type="password" name="user_conf_password" class="form__input" placeholder="Confirm password">
        </div>

        <button type="submit" class="form__button" name="submit">Sign Up</button>

        <p class="form__text">
          <a href="index.php" class="form__link">Already have an account? Sign In</a>
        </p>
      </form>
    </div>

  </body>
</html>
