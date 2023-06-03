<?php
require 'connection.php';
session_start();
require 'check_if_added.php';
include 'admin.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Store</title>
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/3844/3844724.png"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- latest compiled and minified CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
    <!-- jquery library -->
    <script type="text/javascript" src="bootstrap/js/jquery-3.2.1.min.js"></script>
    <!-- Latest compiled and minified javascript -->
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <!-- External CSS -->
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <style>

        .img{
            height:170px;
            width:170px;
        }
        .grid-container {
            display: grid;
            grid-template-columns: auto auto;
        }
        .grid-item{
            border: 1px solid black;
            text-align: center;
        }
    </style>
</head>
<body>
<div>
    <?php
    require 'header.php';
    ?>

    <div class="container">
        <div class="jumbotron">
            <h1>Welcome to our Store!</h1>
            <p>We have the best instruments and music sheets for you. No need to hunt around, we have all in one place.</p>
        </div>
    </div>
<br><br><br>
    <div class="container">
        <center>
        </center>
    </div>
<div class="grid-container">
    <?php
    $query="SELECT id, `name`, price, img, `desc`, ean FROM items";
    $query_run=mysqli_query($conn, $query);
//select everything from items
    if(mysqli_num_rows($query_run) > 0){
        foreach($query_run as $item)
        {
            //if the query returns a row bigger than 0 query is successful
            //loop through everything in the items table and display the following results on the page?>
            <div class="grid-item">
                 <p>Name:<?=$item['name'];?></p>
                 <p>Price:<?=setlocale(LC_MONETARY, 'en_GB');
                    utf8_encode(money_format('%n', 1000));
                    echo money_format("£%i",$item['price']);?></p>
                 <p><img class="img" src="<?=$item['img'];?>"></p>
                 <p>Description:<?=$item['desc'];?></p>
                <?php if(!isset($_SESSION['email'])){?>
                     <p><a href="login.php" role="button" class="btn btn-primary btn-block">Buy Now</a></p>
                    <a href="shopping-view.php?id=<?=$item['id']; ?>" class="btn btn-info btn-sm">View</a>
                    <?php //if the user isnt logged in they wont be able to buy anything
                    //they will be redirected to log in so they can then purchase an item
                }else{
                    if(check_if_added_to_cart($item['id'])){
                        echo '<a href="#" class=btn btn-block btn-success disabled>Added to cart</a>';
                    }else{
                        ?>
                        <a href="cart_add.php?id=<?=$item['id'];?>" class="btn btn-block btn-primary" name="add" value="add" class="btn btn-block btr-primary">Add to cart</a>
                        <a href="shopping-view.php?id=<?=$item['id']; ?>" class="btn btn-info btn-sm">View</a>
                        <?php
                    }
                }
                //uses check if added function to see whether ot not the user has added this item to cart by id
                // if they have then it will be disabled and they will not be able to add it again
                //otherwise display buy now so a user can add this to cart

                if($admin){ //if the user is an admin user, they have extra functionality
                    //as they can view edit delete and add products?>
                <a href="shopping-create.php?id=<?=$item['id']; ?>" class="btn btn-dark">Add</a>
                <a href="shopping-edit.php?id=<?=$item['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                <form action="shopping-code.php" method="POST" class="d-inline">
                    <button type="submit" name="delete_product" value="<?=$item['id'];?>" class="btn btn-danger btn-sm">Delete</button>
                </form>
                <?php } ?>
            </div>

            <?php
        }
    }else {
        echo "<h5> No Record Found </h5>";
        //if query fails it will return this message
    }
    mysqli_close($conn);
    ?>
</div>
</body>
</html>
