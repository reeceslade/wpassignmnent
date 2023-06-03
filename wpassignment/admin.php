<?php
if(!empty($_SESSION['email'])) {
    $query = "SELECT admin FROM users WHERE users.email = '".$_SESSION['email']."'";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    if (!empty($result) && mysqli_fetch_assoc($result)['admin'] == 1) {
        $admin = true;
    }else{
        $admin = false;
    }
}
//if user is logged in and user is an admin user return true
//otherwise user isnt an admin and doesnt have certain permissions
?>