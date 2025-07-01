<?php
require('admin/essentials.php');
require('inc/connect.php');


session_start();
session_destroy();

redirect('index.php');
