<?php
require('../../inc/connect.php');
require('../essentials.php');


if(isset($_POST['seen_all'])){
    $sql = "UPDATE `user_queries` SET `seen`='1'";
    $seen_all_result = mysqli_query($conn, $sql);
}

if(isset($_POST['del_all'])){
    $sql = "DELETE FROM `user_queries`";
    $del_all_result = mysqli_query($conn, $sql);
}

if(isset($_POST['del'])){
    $id = $_POST['del'];
    $sql = "DELETE FROM `user_queries` WHERE `id`='$id'";
    $del_result = mysqli_query($conn, $sql);
}

if(isset($_POST['seen'])){
    $id = $_POST['seen'];
    $sql = "UPDATE `user_queries` SET `seen`='1' WHERE `id`='$id'";
    $seen_result = mysqli_query($conn, $sql);
}


