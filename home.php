<?php
  date_default_timezone_set("Europe/Bucharest");
  require_once('./db/Dashboard.php');

  session_start();

  // Check if the user is logged in, if not then redirect him to login page
  if(!isset($_SESSION["isLoggedIn"]) || $_SESSION["isLoggedIn"] !== 1){
      header("location: index.php");
      exit;
  }

  $table = new Dashboard();

  $time = time();
  $start_time = date("H:i:s", $time);
  $finish_time = date("H:i:s", strtotime('+4 hours', $time));
  $work_time = 4;
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Panou de control</title>
    <link rel="stylesheet" href="./css/dashboard.css">
  </head>
  <body>
    <div class="nav">
      <div class="wrapper">
        <h2>Logo</h2>
        <ul>
          <li><button type="button" class="addEntryBtn">Add entry</button></li>
          <li><a href="./includes/loggout_inc.php">Loggout</a></li>
        </ul>
      </div>
    </div>


    <div class="modal">
      <form class="form" action="./includes/insert_data_inc.php" method="post">
        <button type="button" style="float: right;" name="button">X</button>
        <h1 class="form__title">Insert entry</h1>
        <div class="form__input__group">
          <input type="text" class="form__input" name="start_time" value="<?php echo $start_time; ?>" readonly>
        </div>
        <div class="form__input__group">
          <input type="text" class="form__input" name="finish_time" value="<?php echo $finish_time; ?>" readonly>
        </div>
        <div class="form__input__group">
          <input type="text" class="form__input" name="work_time" value="<?php echo $work_time; ?>" readonly>
        </div>

        <button type="submit" class="form__button" name="submit">Insert entry</button>
      </form>
    </div>


    <div class="table">
      <div class="wrapper">
        <table>
          <thead>
            <tr>
              <th>Number id.</th>
              <th>Start time</th>
              <th>Finish time</th>
              <th>Work time</th>
              <th>Delete</th>
            </tr>
          </thead>

          <tbody>
            <?php $table->getData(); ?>
          </tbody>
        </table>
      </div>
    </div>

    <script src="./js/app.js" charset="utf-8"></script>
  </body>
</html>
