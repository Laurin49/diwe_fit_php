<?php 
    require_once('../../../private/initialize.php');

    require_login();

    if(!isset($_GET['id'])) {
        redirect_to(url_for('/fitness/exercises/list.php'));
    }
    $id = $_GET['id'];
    
    $exercise = find_exercise_by_id($id);

    if(is_post_request()) {
        $result = delete_exercise($id);
        $_SESSION['message'] = 'The exercise was deleted successfully.';
        redirect_to(url_for('/fitness/workouts/show.php?id=' . h(u($exercise['workout_id']))));
    } 
?>

<?php $page_title = 'Delete Exercise'; ?>
<?php include(SHARED_PATH . '/fitness_header.php'); ?>

<div id="content">


    <a class="back-link"
        href="<?php echo url_for('/fitness/workouts/show.php?id=' . h(u($exercise['workout_id']))); ?>">
        &laquo; Back to Workouts
    </a>

    <div class="exercise delete">
        <h1>Delete Exercise</h1>
        <p>Are you sure you want to delete this exercise?</p>
        <p class="item"><?php echo h($exercise['name']); ?></p>

        <form action="<?php echo url_for('/fitness/exercises/delete.php?id=' . h(u($exercise['id']))); ?>"
            method="post">
            <div id="operations">
                <input type="submit" name="commit" value="Delete Exercise" />
            </div>
        </form>
    </div>

</div>

<?php include(SHARED_PATH . '/fitness_footer.php'); ?>