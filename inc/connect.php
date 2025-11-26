<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "hbs";

$conn     = mysqli_connect($hostname, $username, $password, $database);

if(!$conn){
    die("QUERY FAILED ERROR CONNECTING" . mysqli_connect_error());
}

// function select($sql, $values, $dataType){
//     $conn = $GLOBALS['conn'];
//     if($stmt = mysqli_prepare($conn, $sql)){
//         mysqli_stmt_bind_param($stmt, $dataType, ...$values);
//         if(mysqli_stmt_execute($stmt)){
//             $result = mysqli_stmt_get_result($stmt);
//             mysqli_stmt_close($stmt);
//             return $result;
//         }
//         else{
//             mysqli_stmt_close($stmt);
//             die("Query not executed - SELECT");
//         }
//     }
//     else {
//         die("Query not prepared - SELECT");
//     }
// }
?>