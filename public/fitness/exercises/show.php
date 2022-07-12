<?php require_once('../../../private/initialize.php'); ?>

<?php
$id = $_GET['id'] ?? '1'; // PHP > 7.0

$exercise = find_exercise_by_id($id);

?>

<?php $page_title = 'Show Exercise'; ?>
<?php include(SHARED_PATH . '/fitness_header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('/fitness/exercises/list.php'); ?>">&laquo; Back to List</a>

    <div class="exercise show">

        <h1>Exercise: <?php echo h($exercise['name']); ?></h1>

        <div class="attributes">
            <?php $workout = find_workout_by_id($exercise['workout_id']); ?>
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