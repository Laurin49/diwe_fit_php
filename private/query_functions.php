<?php

  // Workouts

  function find_all_workouts() {
    global $db;

    $sql = "SELECT * FROM workouts ";
    $sql .= "ORDER BY id ASC";
    //echo $sql;
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  ?>