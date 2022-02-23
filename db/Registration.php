<?php

class Registration
{
  // Create variable for database
  private $db_conn = null;
  // Create array for errors
  private $errors = array();
  // // Database variables
  // private $DB_HOST = "sql102.byethost22.com";
  // private $DB_NAME = "b22_31064837";
  // private $DB_PWD = "AnaaremereverziBanna2025";
  // private $DB_TABLE = "b22_31064837_root";

  function __construct()
  {
    if (isset($_POST["submit"])) {
      $this->signInUser();
    }
  }

  private function signInUser() {
    if (empty($_POST["user_name"])) {
      $this->errors = "Username field is empty";
    } elseif (empty($_POST["user_email"])) {
      $this->errors = "Email field is empty";
    } elseif (empty($_POST["user_password"])) {
      $this->errors = "Password field is empty";
    } elseif (empty($_POST["user_conf_password"])) {
      $this->errors = "Confirm Password field is empty";
    } elseif (!empty($_POST["user_name"]) || !empty($_POST["user_email"]) || !empty($_POST["user_password"]) || !empty($_POST["user_conf_password"])) {
      // $this->db_conn = new mysqli("sql102.byethost22.com", "b22_31064837", "AnaaremereverziBanna2025", "b22_31064837_root");
      $this->db_conn = new mysqli("localhost", "root", "", "login");

      $user_name = $this->db_conn->real_escape_string($_POST["user_name"]);
      $user_email = $this->db_conn->real_escape_string($_POST["user_email"]);

      $user_hash_password = password_hash($_POST["user_password"], PASSWORD_DEFAULT);

      $stmt = $this->db_conn->prepare("SELECT * FROM users WHERE user_name=? OR user_email=?");
      $stmt->bind_param("ss", $user_name, $user_email);
      $stmt->execute();
      $result = $stmt->get_result();
      $num_rows = $result->num_rows;

      if ($num_rows === 1) {
        $this->errors = "This user already exists.";
      } else {
        $stmt = $this->db_conn->prepare("INSERT INTO users (user_name, user_hash_password, user_email) VALUES (?, ?, ?);");
        $stmt->bind_param("sss", $user_name, $user_hash_password, $user_email);
        $resul_sign_up = $stmt->execute();

        if ($resul_sign_up === true) {
          // $this->generateNewDatabase();
          header("Location: ../index.php?works");
        } else {
          $this->errors = "Sign up failed. Try again.";
        }
      }
    }
  }

  // private function generateNewDatabase() {
  //   $user_name = $this->db_conn->real_escape_string($_POST["user_name"]);
  //   $datab_name = strtolower($user_name . "_activity");
  //   $stmt = "CREATE TABLE ? ( `activity_id` INT NOT NULL AUTO_INCREMENT , `start_time` TIME NOT NULL , `finish_time` TIME NOT NULL , `work_time` TIME NOT NULL , PRIMARY KEY (`activity_id`)) ENGINE = InnoDB;"
  //   $stmt = bind_param("s", $datab_name);
  //   $stmt->execute();
  // }
}
