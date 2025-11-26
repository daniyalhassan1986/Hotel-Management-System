
<?php
require('../../inc/connect.php');
require('../essentials.php');

// FOR VERIFY 
if(isset($_POST['verify'])){
    

    $sql1    = "UPDATE `user_cred` SET `is_verified`='$_POST[status]' WHERE `id`='$_POST[id]'";
    $verify  = mysqli_query($conn, $sql1);

    if($verify){
        echo alert('Updated', 'success');
    }
    
}

// FOR ACTIVE 
if(isset($_POST['active'])){
    

    $sql1    = "UPDATE `user_cred` SET `status`='$_POST[status]' WHERE `id`='$_POST[id]'";
    $verify  = mysqli_query($conn, $sql1);

    if($verify){
        echo alert('Updated', 'success');
    }
    
}

// FOR DELETING
if(isset($_POST['del'])){ 
    $sql1    = "DELETE FROM `user_cred` WHERE `id`='$_POST[del]'";
    $delete  = mysqli_query($conn, $sql1);

    if($delete){
        echo alert('Deleted Successfully', 'success');
    }else{
        echo alert('Booking in Progress', 'danger');
    }
    
}

// FOR SEARCHING
if(isset($_POST['username']) && $_POST['username'] != ''){
    
    $sql    = "SELECT * FROM `user_cred` WHERE `name` LIKE '%$_POST[username]%'";
    $users  = mysqli_query($conn, $sql);


    $i=1; 
    while($user = mysqli_fetch_assoc($users)){

        $name           = $user['name'];
        $email          = $user['email'];
        $image          = $user['image'];
        $address        = $user['address'];
        $contact        = $user['contact'];
        $dob            = $user['dob'];
        $date_time      = $user['date_time'];

        
        if($user['status']!=1){
            $status = '<button type="button" class="btn btn-warning rounded-pill" onclick="set_active('.$user['id'].','.$user['status'].')">Inactive</button>';
        }
        else{
            $status = '<button type="button" class="btn btn-success rounded-pill" onclick="set_active('.$user['id'].','.$user['status'].')">Active</button>';
        }
        
        if($user['is_verified']!=1){
            $is_verified = '<button type="button" class="btn btn-danger rounded-pill" onclick="set_verified('.$user['id'].','.$user['is_verified'].')">Unverified</button>';
        }
        else{
            $is_verified = '<button type="button" class="btn btn-success rounded-pill" onclick="set_verified('.$user['id'].','.$user['is_verified'].')">Verified</button>';
        }
        

        echo  '<tr class="align-middle">
                <th scope="row">'.$i++.'</th>
                <td width="15%">'.$name.'</td>
                <td><img src="'.USER_IMG_PATH.$image.'" alt="'.$image.'" width="120px"></td>
                <td width="10%">
                    <span class="badge text-bg-dark rounded-pill">contact:'.$contact.'</span>
                    <br>
                    <span class="badge text-bg-dark rounded-pill">dob:'.$dob.'</span>
                </td>
                <td>'.$address.'</td>
                <td width="10%">'.$dob.'</td>
                <td width="10%">'.$is_verified.'</td>
                <td>'.$status.'</td>
                <td width="10%">'.$date_time.'</td>
                <td>
                    <button type="button" onclick="remove_user('.$user['id'].')" class="btn btn-danger shadow-none rounded-pill"><i class="bi bi-trash"></i></button>
                </td>
            </tr>'; 
        } 
}
