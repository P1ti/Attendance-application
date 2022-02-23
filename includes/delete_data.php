<?php

  require_once('../db/Dashboard.php');

  $deleteData = new Dashboard();

  $activity_id = $_GET['activity_id'];

  $deleteData->deleteData($activity_id);
