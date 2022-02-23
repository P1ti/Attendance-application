<?php

class SignIn
{

  // Create database conn
  private $db_conn = null;
  // private $DB_HOST = "sql102.byethost22.com";
  // private $DB_NAME = "b22_31064837";
  // private $DB_PWD = "AnaaremereverziBanna2025";
  // private $DB_TABLE = "b22_31064837_root";

  function __construct()
  {
    session_start();

    if (isset($_POST["submit"])) {
      $this->signInUser();
    }
  }

  private function signInUser()
  {
      if (empty($_POST["user_email"])) {
        $this->errors = "Email field is empty";
      } elseif (empty($_POST["user_password"])) {
        $this->errors = "Password field is empty";
      } elseif (!empty($_POST["user_email"]) || !empty($_POST["user_password"])) {
        // $this->db_conn = new mysqli("sql102.byethost22.com", "b22_31064837", "AnaaremereverziBanna2025", "b22_31064837_root");
        $this->db_conn = new mysqli("localhost", "second_root", "1234", "login");

        // Store user input in variables
        $user_email = $this->db_conn->real_escape_string($_POST["user_email"]);
        $user_password = $this->db_conn->real_escape_string($_POST["user_password"]);

        $stmt = $this->db_conn->prepare("SELECT * FROM users WHERE user_email=?;");
        $stmt->bind_param("s", $user_email);
        $stmt->execute();
        $result = $stmt->get_result();
        $num_rows = $result->num_rows;

        // check if user exists
        if ($num_rows === 1) {
          $result_row = $result->fetch_object();


          if (password_verify($user_password, $result_row->user_hash_password)) {
            // store database infos in session variables
            $_SESSION["username"] = $result_row->user_name;
            $_SESSION["email"] = $result_row->user_email;
            $_SESSION["user_activity_table"] = strtolower($result_row->user_name."_activity");
            $_SESSION["isLoggedIn"] = 1;
            header("Location: ../home.php?Signned in with succes");
          } else {
            $this->errors = "Wrong password. Try again later";
            header("Location: ../index.php?Wrong password. Try again later");
          }
        }
      }
  }
}
