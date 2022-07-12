<?php require_once('../../../private/initialize.php'); ?>

<?php

  $exercise_set = find_all_exercises();

?>

<?php $page_title = 'Exercises'; ?>
<?php include(SHARED_PATH . '/fitness_header.php'); ?>

<div id="content">
    <div class="exercises listing">
        <h1>Exercises</h1>

        <div class="actions">
            <a class="action" href="<?php echo url_for('/fitness/exercises/new.php'); ?>">Create New Exercise</a>
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