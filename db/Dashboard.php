<?php

class Dashboard
{
    private $db_conn = null;
    private $rows = array();

  function __construct()
  {
    $this->db_conn = new mysqli("localhost", "root", "", "login");
  }

  function getData() {
    $stmt = $this->db_conn->prepare("SELECT * FROM `piti_activity`;");
    $stmt->execute();
    $res = $stmt->get_result();
    $num_rows = $res->num_rows;

    if ($num_rows >= 1) {


      for ($i=1; $i < $num_rows; $i++) {
          while ($rows = $res->fetch_array()) {
            echo "<tr>" .
                  "<td>" . $rows["activity_id"] . "</td>" .
                  "<td>" . $rows["start_time"] . "</td>" .
                  "<td>" . $rows["finish_time"] . "</td>" .
                  "<td>" . $rows["work_time"] . "</td>" .
                  "<td><a href='./includes/delete_data.php?activity_id=" . $rows["activity_id"] . "'>Delete</a></td>"
                . "</tr>";
          }
      }
    }
  }

  function insertData() {
    $s_time = $this->db_conn->real_escape_string($_POST["start_time"]);;
    $f_time = $this->db_conn->real_escape_string($_POST["finish_time"]);
    $w_time = $this->db_conn->real_escape_string($_POST["work_time"]);


    $stmt = $this->db_conn->prepare("INSERT INTO `piti_activity` (start_time, finish_time, work_time) VALUES (?, ?, ?);");
    $stmt->bind_param("sss", $s_time, $f_time, $w_time);
    $res = $stmt->execute();

    if ($res === true) {
      header("location: ../home.php?new_entry_created");
    } else {
      header("location: ../home.php?failed");
    }
  }

  function deleteData($activity_id) {
    $id = $activity_id;

    $stmt = $this->db_conn->prepare("DELETE FROM `piti_activity` WHERE activity_id=?;");
    $stmt->bind_param("i", $id);
    $res = $stmt->execute();

    if ($res === true) {
      header("location: ../home.php?entry_deleted");
    } else {
      header("location: ../home.php?failed");
    }
  }
}
