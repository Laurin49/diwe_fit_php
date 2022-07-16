<?php 
    require_once('../../../private/initialize.php'); 

    require_login();

    redirect_to(url_for('/fitness/index.php'));

?>