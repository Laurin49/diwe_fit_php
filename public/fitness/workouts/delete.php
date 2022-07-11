<?php

require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to(url_for('/fitness/workouts/list.php'));
}
$id = $_GET['id'];

if(is_post_request()) {

  $result = delete_workout($id);
  redirect_to(url_for('/fitness/workouts/list.php'));

} else {
  $workout = find_workout_by_id($id);
}

?>


<?php $page_title = 'Delete Workout'; ?>
<?php include(SHARED_PATH . '/fitness_header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('/fitness/workouts/list.php'); ?>">&laquo; Back to List</a>

    <div class="workout delete">
        <h1>Delete Workout</h1>
        <p>Are you sure you want to delete this workout?</p>
        <p class="item"><?php echo h($workout['name']); ?></p>

        <form action="<?php echo url_for('/fitness/workouts/delete.php?id=' . h(u($workout['id']))); ?>" method="post">
            <div id="operations">
                <input type="submit" name="commit" value="Delete Workout" />
            </div>
        </form>
    </div>

</div>

<?php include(SHARED_PATH . '/fitness_footer.php'); ?>