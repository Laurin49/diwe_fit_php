<?php require_once('../../private/initialize.php'); ?>

<?php $page_title = 'Fitness Menu'; ?>
<?php include(SHARED_PATH . '/fitness_header.php'); ?>

<div id="content">
    <div id="main-menu">
        <h2>Main Menu</h2>
        <ul>
            <li><a href="<?php echo url_for('/fitness/workouts/list.php'); ?>">Workouts</a></li>
            <li><a href="<?php echo url_for('/fitness/exercises/list.php'); ?>">Exercises</a></li>
        </ul>
    </div>

</div>

<?php include(SHARED_PATH . '/fitness_footer.php'); ?>