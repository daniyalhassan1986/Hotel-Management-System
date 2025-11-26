<?php 

require('../../inc/connect.php');
require('../essentials.php');

// GETTING ALL THE REVIEWS AND RATINGS
if(isset($_POST['m_data'])){
    
    $sql = "SELECT reviews.id, reviews.rating, reviews.review, reviews.date_time, 
    user_cred.name AS user_name, user_cred.email AS user_email, 
    rooms.name AS room_name, reviews.id AS ratings_id, 
    user_cred.status, user_cred.is_verified
    FROM reviews 
    INNER JOIN user_cred ON reviews.user_id = user_cred.id 
    INNER JOIN rooms ON reviews.room_id = rooms.id 
    ORDER BY reviews.id DESC";

    $users = mysqli_query($conn, $sql);

    // ✅ Check for Errors
    if (!$users) {
    die("SQL Error: " . mysqli_error($conn));  
    }

    $i = 1;
    while ($user = mysqli_fetch_assoc($users)) {
        $name       = $user['user_name'];   
        $email      = $user['user_email'];  
        $room_name  = $user['room_name'];   
        $rating     = $user['rating'];       
        $review     = $user['review'];       
        $date_time  = date('Y-m-d', strtotime($user['date_time']));    


        echo  '<tr class="align-middle">
        <th scope="row">'.$i++.'</th>
        <td>'.$name.'</td>
        <td>'.$email.'</td>
        <td>'.$room_name.'</td>
        <td><div class="text-warning">'.$rating.'<i class="bi bi-star-fill"></i></div></td>
        <td>'.$review.'</td>
        <td>'.$date_time.'</td>
        <td>
        <button type="button" onclick="remove_rating('.$user['ratings_id'].')" class="btn btn-danger shadow-none rounded-pill"><i class="bi bi-trash"></i></button>
        </td>
        </tr>'; 
    }
}

// DELETING THE REVIEWS
if(isset($_POST['del'])){
    $sql        = "DELETE FROM `reviews` WHERE `id` = $_POST[del]";
    $delete     = mysqli_query($conn, $sql);
}

