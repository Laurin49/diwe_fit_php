<?php

require_once('../../../private/initialize.php');

require_login();

if(is_post_request()) {

  $exercise = [];
  $exercise['workout_id'] = $_POST['workout_id'] ?? '';
  $exercise['name'] = $_POST['name'] ?? '';
  $exercise['content'] = $_POST['content'] ?? '';

  $result = insert_exercise($exercise);
  if($result === true) {
    $new_id = mysqli_insert_id($db);
    $_SESSION['message'] = 'The exercise was created successfully.';
    redirect_to(url_for('/fitness/exercises/show.php?id=' . $new_id));
  } else {
    $errors = $result;
  }

} else {

  $exercise = [];
  $exercise['workout_id'] = $_GET['workout_id'] ?? '0';
  $exercise['name'] = '';
  $exercise['content'] = '';

}

?>
<?php $page_title = 'Create Exercise'; ?>
<?php include(SHARED_PATH . '/fitness_header.php'); ?>

<div id="content">

    <a class="back-link"
        href="<?php echo url_for('/fitness/workouts/show.php?id=' . h(u($exercise['workout_id']))); ?>">
        &laquo; Back to Workouts
    </a>

    <div class="exercise new">
        <h1>Create Exercise</h1>

        <?php echo display_errors($errors); ?>

        <form action="<?php echo url_for('/fitness/exercises/new.php'); ?>" method="post">
            <dl>
                <dt>Workout</dt>
                <dd>
                    <select name="workout_id">
                        <?php
                            $workout_set = find_all_workouts();
                            while($workout = mysqli_fetch_assoc($workout_set)) {
                                echo "<option value=\"" . h($workout['id']) . "\"";
                                if($exercise["workout_id"] == $workout['id']) {
                                    echo " selected";
                                }
                                echo ">" . h($workout['name']) . "</option>";
                            }
                            mysqli_free_result($workout_set);
                        ?>
                    </select>
                </dd>
            </dl>
            <dl>
                <dt>Exercise Name</dt>
                <dd><input type="text" name="name" value="<?php echo h($exercise['name']); ?>" /></dd>
            </dl>
            <dl>
                <dt>Content</dt>
                <dd>
                    <textarea name="content" cols="60" rows="10"><?php echo h($exercise['content']); ?></textarea>
                </dd>
            </dl>
            <div id="operations">
                <input type="submit" value="Create Exercise" />
            </div>
        </form>

    </div>

</div>

<?php include(SHARED_PATH . '/fitness_footer.php'); ?>