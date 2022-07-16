<?php 
    require_once('../../../private/initialize.php'); 

    require_login();

    if(!isset($_GET['id'])) {
        redirect_to(url_for('/fitness/exercises/list.php'));
    }
    $id = $_GET['id'];

    if(is_post_request()) {
        $exercise = [];
        $exercise['id'] = $id;
        $exercise['workout_id'] = $_POST['workout_id'] ?? '';
        $exercise['name'] = $_POST['name'] ?? '';
        $exercise['content'] = $_POST['content'] ?? '';

        $result = update_exercise($exercise);
    
        if ($result === true) {
            $_SESSION['message'] = 'The exercise was updated successfully.';
            redirect_to(url_for('/fitness/exercises/show.php?id=' . $id));
        } else {
            $errors = $result;
        }

    } else {
        $exercise = find_exercise_by_id($id);
    }
?>

<?php $page_title = 'Update Exercise'; ?>
<?php include(SHARED_PATH . '/fitness_header.php'); ?>

<div id="content">

    <a class="back-link"
        href="<?php echo url_for('/fitness/workouts/show.php?id=' . h(u($exercise['workout_id']))); ?>">
        &laquo; Back to Workouts
    </a>
    <div class="exercise new">
        <h1>Update Exercise</h1>

        <?php echo display_errors($errors); ?>

        <form action="<?php echo url_for('/fitness/exercises/edit.php?id=' . h(u($id))); ?>" method="post">
            <dl>
                <dt>Workout</dt>
                <dd>
                    <select name="workout_id">
                        <?php
                            $workout_set = find_all_workouts();
                            while($workout = mysqli_fetch_assoc($workout_set)) {
                                echo "<option value=\"" . h($workout['id']) . "\"";
                                if($exercise["workout_id"] == $workout['id']) {
                                    echo " selected";
                                }
                                echo ">" . h($workout['name']) . "</option>";
                            }
                            mysqli_free_result($workout_set);
                        ?>
                    </select>
                </dd>
            </dl>
            <dl>
                <dt>Exercise Name</dt>
                <dd><input type="text" name="name" value="<?php echo h($exercise['name']); ?>" /></dd>
            </dl>
            <dl>
                <dt>Content</dt>
                <dd>
                    <textarea name="content" cols="60" rows="10"><?php echo h($exercise['content']); ?></textarea>
                </dd>
            </dl>
            <div id="operations">
                <input type="submit" value="Update Exercise" />
            </div>
        </form>
    </div>

</div>

<?php include(SHARED_PATH . '/fitness_footer.php'); ?>