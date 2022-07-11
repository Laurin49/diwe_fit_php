<?php require_once('../../../private/initialize.php'); ?>

<?php
$id = $_GET['id'] ?? '1'; // PHP > 7.0

$workout = find_workout_by_id($id);

?>

<?php $page_title = 'Show Workout'; ?>
<?php include(SHARED_PATH . '/fitness_header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('/fitness/workouts/list.php'); ?>">&laquo; Back to List</a>

    <div class="page show">

        <h1>Workout: <?php echo h($workout['name']); ?></h1>

    </div>

</div>

<?php include(SHARED_PATH . '/fitness_footer.php'); ?>