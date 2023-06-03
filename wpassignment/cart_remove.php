<?php
    require 'connection.php';
    session_start();
    $item_id=$_GET['id'];
    $user_id=$_SESSION['id'];
    $delete_query="delete from users_items where user_id='$user_id' and item_id='$item_id'";
    $delete_query_result=mysqli_query($conn,$delete_query) or die(mysqli_error($conn));
    if($delete_query_result) {
        header('location: cart.php');
        exit();
    }else{
        echo 'Something went wrong.. Please refresh the page';
    }
//when a user clicks remove item it will delete the item from their cart by checking the users id and item id
//i did not record this in the status column as we only want to know when a user has confirmed or added to cart
?>