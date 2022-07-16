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
    $sql .= "(name, datum) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $workout['name']) . "',";
    $sql .= "'" . db_escape($db, $workout['datum']) . "'";
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
    $sql .= "name='" . db_escape($db, $workout['name']) . "', ";
    $sql .= "datum='" . db_escape($db, $workout['datum']) . "' ";
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
    if (is_blank($workout['datum'])) {
      $errors[] = "Datum cannot be blank. ";
    } elseif(!has_length($workout['datum'], ['min' => 2, 'max' => 12])) {
      $errors[] = "Datum must be between 2 and 12 characters.";
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

  function find_exercises_by_workout_id($workout_id, $options=[]) {
    global $db;

    $visible = $options['visible'] ?? false;

    $sql = "SELECT * FROM exercises ";
    $sql .= "WHERE workout_id='" . db_escape($db, $workout_id) . "' ";
    if($visible) {
      $sql .= "AND visible = true ";
    }
    $sql .= "ORDER BY id ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
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

    // Admins

  // Find all admins, ordered last_name, first_name
  function find_all_admins() {
    global $db;

    $sql = "SELECT * FROM admins ";
    $sql .= "ORDER BY last_name ASC, first_name ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_admin_by_id($id) {
    global $db;

    $sql = "SELECT * FROM admins ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $admin = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $admin; // returns an assoc. array
  }

  function find_admin_by_username($username) {
    global $db;

    $sql = "SELECT * FROM admins ";
    $sql .= "WHERE username='" . db_escape($db, $username) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $admin = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $admin; // returns an assoc. array
  }

  function validate_admin($admin, $options=[]) {

    $password_required = $options['password_required'] ?? true;

    if(is_blank($admin['first_name'])) {
      $errors[] = "First name cannot be blank.";
    } elseif (!has_length($admin['first_name'], array('min' => 2, 'max' => 255))) {
      $errors[] = "First name must be between 2 and 255 characters.";
    }

    if(is_blank($admin['last_name'])) {
      $errors[] = "Last name cannot be blank.";
    } elseif (!has_length($admin['last_name'], array('min' => 2, 'max' => 255))) {
      $errors[] = "Last name must be between 2 and 255 characters.";
    }

    if(is_blank($admin['email'])) {
      $errors[] = "Email cannot be blank.";
    } elseif (!has_length($admin['email'], array('max' => 255))) {
      $errors[] = "Last name must be less than 255 characters.";
    } elseif (!has_valid_email_format($admin['email'])) {
      $errors[] = "Email must be a valid format.";
    }

    if(is_blank($admin['username'])) {
      $errors[] = "Username cannot be blank.";
    } elseif (!has_length($admin['username'], array('min' => 8, 'max' => 255))) {
      $errors[] = "Username must be between 8 and 255 characters.";
    } elseif (!has_unique_username($admin['username'], $admin['id'] ?? 0)) {
      $errors[] = "Username not allowed. Try another.";
    }

    if($password_required) {
      if(is_blank($admin['password'])) {
        $errors[] = "Password cannot be blank.";
      } elseif (!has_length($admin['password'], array('min' => 8))) {
        $errors[] = "Password must contain 8 or more characters";
      } elseif (!preg_match('/[A-Z]/', $admin['password'])) {
        $errors[] = "Password must contain at least 1 uppercase letter";
      } elseif (!preg_match('/[a-z]/', $admin['password'])) {
        $errors[] = "Password must contain at least 1 lowercase letter";
      } elseif (!preg_match('/[0-9]/', $admin['password'])) {
        $errors[] = "Password must contain at least 1 number";
      } elseif (!preg_match('/[^A-Za-z0-9\s]/', $admin['password'])) {
        $errors[] = "Password must contain at least 1 symbol";
      }

      if(is_blank($admin['confirm_password'])) {
        $errors[] = "Confirm password cannot be blank.";
      } elseif ($admin['password'] !== $admin['confirm_password']) {
        $errors[] = "Password and confirm password must match.";
      }
    }
    
    return $errors;
  }

  function insert_admin($admin) {
    global $db;

    $errors = validate_admin($admin);
    if (!empty($errors)) {
      return $errors;
    }

    $hashed_password = password_hash($admin['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO admins ";
    $sql .= "(first_name, last_name, email, username, hashed_password) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $admin['first_name']) . "',";
    $sql .= "'" . db_escape($db, $admin['last_name']) . "',";
    $sql .= "'" . db_escape($db, $admin['email']) . "',";
    $sql .= "'" . db_escape($db, $admin['username']) . "',";
    $sql .= "'" . db_escape($db, $hashed_password) . "'";
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

  function update_admin($admin) {
    global $db;

    $password_sent = !is_blank($admin['password']);

    $errors = validate_admin($admin, ['password_required' => $password_sent]);
    if (!empty($errors)) {
      return $errors;
    }

    $hashed_password = password_hash($admin['password'], PASSWORD_BCRYPT);

    $sql = "UPDATE admins SET ";
    $sql .= "first_name='" . db_escape($db, $admin['first_name']) . "', ";
    $sql .= "last_name='" . db_escape($db, $admin['last_name']) . "', ";
    $sql .= "email='" . db_escape($db, $admin['email']) . "', ";
    if($password_sent) {
      $sql .= "hashed_password='" . db_escape($db, $hashed_password) . "', ";
    }
    $sql .= "username='" . db_escape($db, $admin['username']) . "' ";
    $sql .= "WHERE id='" . db_escape($db, $admin['id']) . "' ";
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

  function delete_admin($admin) {
    global $db;

    $sql = "DELETE FROM admins ";
    $sql .= "WHERE id='" . db_escape($db, $admin['id']) . "' ";
    $sql .= "LIMIT 1;";
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