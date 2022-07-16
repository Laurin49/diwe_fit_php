<?php

require_once('../../../private/initialize.php');

require_login();

if(is_post_request()) {

  $workout = [];
  $workout['name'] = $_POST['name'] ?? '';
  $workout['datum'] = $_POST['datum'] ?? '';

  $result = insert_workout($workout);
  if($result === true) {
    $new_id = mysqli_insert_id($db);
    $_SESSION['message'] = 'The workout was created successfully.';
    redirect_to(url_for('/fitness/workouts/show.php?id=' . $new_id)); 
  } else {
      $errors = $result;
  }

} else {

  $workout = [];
  $workout['name'] = '';
  $workout['datum'] = '';

}

?>

<?php $page_title = 'Create Workout'; ?>
<?php include(SHARED_PATH . '/fitness_header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('/fitness/workouts/list.php'); ?>">&laquo; Back to List</a>

    <div class="page new">
        <h1>Create Workout</h1>

        <?php echo display_errors($errors); ?>

        <form action="<?php echo url_for('/fitness/workouts/new.php'); ?>" method="post">
            <dl>
                <dt>Workout</dt>
            </dl>
            <dl>
                <dt>Workout Name</dt>
                <dd><input type="text" name="name" value="<?php echo h($workout['name']); ?>" /></dd>
            </dl>
            <dl>
                <dt>Workout Datum</dt>
                <dd><input type="text" name="datum" value="<?php echo h($workout['datum']); ?>" /></dd>
            </dl>
            <div id="operations">
                <input type="submit" value="Create Workout" />
            </div>
        </form>

    </div>

</div>

<?php include(SHARED_PATH . '/fitness_footer.php'); ?>