<?php

require_once('../../../private/initialize.php');

require_login();

if(!isset($_GET['id'])) {
  redirect_to(url_for('/fitness/workouts/list.php'));
}
$id = $_GET['id'];

if(is_post_request()) {

    $workout = [];
    $workout['id'] = $id;
    $workout['name'] = $_POST['name'] ?? '';
    $workout['datum'] = $_POST['datum'] ?? '';
  
    $result = update_workout($workout);
    if($result === true) {
        $_SESSION['message'] = 'The workout was updated successfully.';
        redirect_to(url_for('/fitness/workouts/show.php?id=' . $id));   
    } else {
        $errors = $result;
    }
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

        <?php echo display_errors($errors); ?>

        <form action="<?php echo url_for('/fitness/workouts/edit.php?id=' . h(u($id))); ?>" method="post">
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
                <input type="submit" value="Update Workout" />
            </div>
        </form>

    </div>

</div>

<?php include(SHARED_PATH . '/fitness_footer.php'); ?>