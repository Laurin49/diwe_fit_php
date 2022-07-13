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
    $sql .= "WHERE id='" . db_escape($db, $id) . "'";
    
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);

    $workout = mysqli_fetch_assoc($result);
    mysqli_free_result($result);

    return $workout;
  }


  function insert_workout($workout) {
    global $db;
    
    $errors = validate_workout($workout);
    if (!empty($errors)) {
      return $errors;
    }

    $sql = "INSERT INTO workouts ";
    $sql .= "(name) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $workout['name']) . "'";
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
        
    $errors = validate_workout($workout);
    if (!empty($errors)) {
      return $errors;
    }

    $sql = "UPDATE workouts SET ";
    $sql .= "name='" . db_escape($db, $workout['name']) . "' ";
    $sql .= "WHERE id='" . db_escape($db, $workout['id']) . "' ";
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
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
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

  function validate_workout($workout) {
    $errors = [];
    if (is_blank($workout['name'])) {
      $errors[] = "Name cannot be blank. ";
    } elseif(!has_length($workout['name'], ['min' => 2, 'max' => 255])) {
      $errors[] = "Name must be between 2 and 255 characters.";
    }
    return $errors;
  }

    // Exercises

    function find_all_exercises() {
      global $db;
  
      $sql = "SELECT * FROM exercises ";
      $sql .= "ORDER BY workout_id ASC";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      return $result;
    }


  function find_exercise_by_id($id) {
    global $db;

    $sql = "SELECT * FROM exercises ";
    $sql .= "WHERE id='" . db_escape($db, $id). "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $exercise = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $exercise; // returns an assoc. array
  }

  function insert_exercise($exercise) {
    global $db;
        
    $errors = validate_exercise($exercise);
    if (!empty($errors)) {
      return $errors;
    }

    $sql = "INSERT INTO exercises ";
    $sql .= "(workout_id, name, content) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $exercise['workout_id']) . "',";
    $sql .= "'" . db_escape($db, $exercise['name']) . "',";
    $sql .= "'" . db_escape($db, $exercise['content']) . "'";
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

  function update_exercise($exercise) {
    global $db;
            
    $errors = validate_exercise($exercise);
    if (!empty($errors)) {
      return $errors;
    }

    $sql = "UPDATE exercises SET ";
    $sql .= "workout_id='" . db_escape($db, $exercise['workout_id']) . "', ";
    $sql .= "name='" . db_escape($db, $exercise['name']) . "', ";
    $sql .= "content='" . db_escape($db, $exercise['content']) . "' ";
    $sql .= "WHERE id='" . db_escape($db, $exercise['id']) . "' ";
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

  function delete_exercise($id) {
    global $db;

    $sql = "DELETE FROM exercises ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
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

  function validate_exercise($exercise) {
    $errors = [];
    // workout
    if(is_blank($exercise['workout_id'])) {
      $errors[] = "Workout cannot be blank.";
    }
    // name
    if (is_blank($exercise['name'])) {
      $errors[] = "Name cannot be blank. ";
    } elseif(!has_length($exercise['name'], ['min' => 2, 'max' => 255])) {
      $errors[] = "Name must be between 2 and 255 characters.";
    }
    // content
    if(is_blank($exercise['content'])) {
      $errors[] = "Content cannot be blank.";
    }
    return $errors;
  }

  ?>