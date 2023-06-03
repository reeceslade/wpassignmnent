<?php include
require 'connection.php';
    session_start();
    $item_id=$_GET['id'];
    $user_id=$_SESSION['id'];
    $add_to_cart_query="insert into users_items(user_id,item_id,status) values ('$user_id','$item_id','Added to cart')";
    $add_to_cart_result=mysqli_query($conn,$add_to_cart_query) or die(mysqli_error($conn));
    header('location: products.php');
//THIS CODE INSERTS THE VALUE ADDED INTO THE USERS ITEMS TABLE AND LOGS THAT THEY HAVE ADDED A SPECIFIC ITEM TO CART
//and also records the status of the users added item, whether they've added an item successfully to cart
?>