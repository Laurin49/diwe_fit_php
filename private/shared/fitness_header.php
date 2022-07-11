<?php
  if(!isset($page_title)) { $page_title = 'Fitness Bereich'; }
?>

<!doctype html>

<html lang="en">

<head>
    <title>GBI - <?php echo h($page_title); ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" media="all" href="<?php echo url_for('/stylesheets/app.css'); ?>" />
</head>

<body>
    <header>
        <h1>DIWE Fitness Area</h1>
    </header>

    <navigation>
        <ul>
            <li><a href="<?php echo url_for('/fitness/index.php'); ?>">Menu</a></li>
        </ul>
    </navigation>