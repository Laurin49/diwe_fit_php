<?php 
    require_once('../../../private/initialize.php'); 

    require_login();

    $id = $_GET['id'] ?? '1'; // PHP > 7.0

    $workout = find_workout_by_id($id);
    $exercise_set = find_exercises_by_workout_id($id);
?>

<?php $page_title = 'Show Workout'; ?>
<?php include(SHARED_PATH . '/fitness_header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('/fitness/workouts/list.php'); ?>">&laquo; Back to List</a>

    <div class="page show">

        <h1>Workout: <?php echo h($workout['name']); ?></h1>
        <h2>Datum: <?php echo h($workout['datum']); ?></h2>

    </div>

    <hr />

    <div class="exercises listing">
        <h2>Exercises</h2>

        <div class="actions">
            <a class="action"
                href="<?php echo url_for('/fitness/exercises/new.php?workout_id=' . h(u($workout['id']))); ?>">
                Create New Exercise
            </a>
        </div>

        <table class="list">
            <tr>
                <th>ID</th>
                <th>Workout</th>
                <th>Name</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>

            <?php while($exercise = mysqli_fetch_assoc($exercise_set)) { ?>
            <?php $workout = find_workout_by_id($exercise['workout_id']); ?>
            <tr>
                <td><?php echo h($exercise['id']); ?></td>
                <td><?php echo h($workout['name']); ?></td>
                <td><?php echo h($exercise['name']); ?></td>
                <td><a class="action"
                        href="<?php echo url_for('/fitness/exercises/show.php?id=' . h(u($exercise['id']))); ?>">View</a>
                </td>
                <td><a class="action"
                        href="<?php echo url_for('/fitness/exercises/edit.php?id=' . h(u($exercise['id']))); ?>">Edit</a>
                </td>
                <td><a class="action"
                        href="<?php echo url_for('/fitness/exercises/delete.php?id=' . h(u($exercise['id']))); ?>">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </table>

        <?php mysqli_free_result($exercise_set); ?>

    </div>

</div>


<?php include(SHARED_PATH . '/fitness_footer.php'); ?>