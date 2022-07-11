<?php

require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to(url_for('/fitness/workouts/list.php'));
}
$id = $_GET['id'];

if(is_post_request()) {

    $workout = [];
    $workout['id'] = $id;
    $workout['name'] = $_POST['name'] ?? '';
  
    $result = update_workout($workout);
    redirect_to(url_for('/fitness/workouts/show.php?id=' . $id));
  
  } else {
 
    $workout = find_workout_by_id($id);
 
  }
  
?>

<?php $page_title = 'Update Workout'; ?>
<?php include(SHARED_PATH . '/fitness_header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('/fitness/workouts/list.php'); ?>">&laquo; Back to List</a>

    <div class="workout edit">
        <h1>Edit Workout</h1>

        <form action="<?php echo url_for('/fitness/workouts/edit.php?id=' . h(u($id))); ?>" method="post">
            <dl>
                <dt>Workout</dt>
            </dl>
            <dl>
                <dt>Workout Name</dt>
                <dd><input type="text" name="name" value="<?php echo h($workout['name']); ?>" /></dd>
            </dl>
            <div id="operations">
                <input type="submit" value="Update Workout" />
            </div>
        </form>

    </div>

</div>

<?php include(SHARED_PATH . '/fitness_footer.php'); ?>