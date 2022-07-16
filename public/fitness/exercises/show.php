<?php 
    require_once('../../../private/initialize.php'); 

    require_login();
    
    $id = $_GET['id'] ?? '1'; // PHP > 7.0

    $exercise = find_exercise_by_id($id);
    $workout = find_workout_by_id($exercise['workout_id']);
?>

<?php $page_title = 'Show Exercise'; ?>
<?php include(SHARED_PATH . '/fitness_header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('/fitness/workouts/show.php?id=' . h(u($workout['id']))); ?>">
        &laquo; Back to Workouts
    </a>

    <div class="exercise show">

        <h1>Exercise: <?php echo h($exercise['name']); ?></h1>

        <div class="attributes">
            <dl>
                <dt>Workout</dt>
                <dd><?php echo h($workout['name']); ?></dd>
            </dl>
            <dl>
                <dt>Name</dt>
                <dd><?php echo h($exercise['name']); ?></dd>
            </dl>
            <dl>
                <dt>Content</dt>
                <dd><?php echo h($exercise['content']); ?></dd>
            </dl>
        </div>


    </div>

</div>

<?php include(SHARED_PATH . '/fitness_footer.php'); ?>