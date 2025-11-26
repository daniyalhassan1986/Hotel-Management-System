<?php require('essentials.php'); ?>
<?php
session_start();
session_destroy();
redirect('index.php');
?>