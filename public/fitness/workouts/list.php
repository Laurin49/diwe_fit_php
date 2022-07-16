<?php 
    require_once('../../../private/initialize.php'); 

    require_login();
    $workout_set = find_all_workouts();

?>

<?php $page_title = 'Workouts'; ?>
<?php include(SHARED_PATH . '/fitness_header.php'); ?>

<div id="content">
    <div class="workouts listing">
        <h1>Workouts</h1>

        <div class="actions">
            <a class="action" href="<?php echo url_for('/fitness/workouts/new.php'); ?>">Create New Workout</a>
        </div>

        <table class="list">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Datum</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>

            <?php while($workout = mysqli_fetch_assoc($workout_set)) { ?>
            <tr>
                <td><?php echo h($workout['id']); ?></td>
                <td><?php echo h($workout['name']); ?></td>
                <td><?php echo h($workout['datum']); ?></td>
                <td><a class="action"
                        href="<?php echo url_for('/fitness/workouts/show.php?id=' . h(u($workout['id']))); ?>">View</a>
                </td>
                <td><a class="action"
                        href="<?php echo url_for('/fitness/workouts/edit.php?id=' . h(u($workout['id']))); ?>">Edit</a>
                </td>
                <td><a class="action"
                        href="<?php echo url_for('/fitness/workouts/delete.php?id=' . h(u($workout['id']))); ?>">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </table>

        <?php
            mysqli_free_result($workout_set);
        ?>
    </div>

</div>

<?php include(SHARED_PATH . '/fitness_footer.php'); ?>