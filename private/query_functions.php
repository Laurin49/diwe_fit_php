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

  function find_workout_by_id($id) {
    global $db;

    $sql = "SELECT * FROM workouts ";
    $sql .= "WHERE id='" . $id . "'";
    
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);

    $workout = mysqli_fetch_assoc($result);
    mysqli_free_result($result);

    return $workout;
  }


  function insert_workout($workout) {
    global $db;

    $sql = "INSERT INTO workouts ";
    $sql .= "(name) ";
    $sql .= "VALUES (";
    $sql .= "'" . $workout['name'] . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    // For INSERT statements, $result is true/false
    if($result) {
      return true;
    } else {
      // INSERT failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function update_workout($workout) {
    global $db;

    $sql = "UPDATE workouts SET ";
    $sql .= "name='" . $workout['name'] . "' ";
    $sql .= "WHERE id='" . $workout['id'] . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
    // For UPDATE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // UPDATE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }

  }


  function delete_workout($id) {
    global $db;

    $sql = "DELETE FROM workouts ";
    $sql .= "WHERE id='" . $id . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    // For DELETE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // DELETE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }
  ?>