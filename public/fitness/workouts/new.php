<?php

require_once('../../../private/initialize.php');

if(is_post_request()) {

  $workout = [];
  $workout['name'] = $_POST['name'] ?? '';

  $result = insert_workout($workout);
  if($result === true) {
    $new_id = mysqli_insert_id($db);
    redirect_to(url_for('/fitness/workouts/show.php?id=' . $new_id)); 
  } else {
      $errors = $result;
  }
  

} else {

  $workout = [];
  $workout['name'] = '';

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
            <div id="operations">
                <input type="submit" value="Create Workout" />
            </div>
        </form>

    </div>

</div>

<?php include(SHARED_PATH . '/fitness_footer.php'); ?>