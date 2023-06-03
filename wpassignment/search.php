<html>
    <!DOCTYPE html>
    <head>
        <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/3844/3844724.png"/>
        <title>Store</title>
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
            .grid-container {
                display: grid;
                grid-template-columns: auto auto;
            }
            .grid-item{
                border: 1px solid black;
                text-align: center;
            }
            .img{
                height:170px;
                width:170px;
            }
        </style>
    </head>
    <?php
    require 'header.php';
    ?>
<body>
</html>

<div class="grid-container">
<?php
include 'connection.php';
include 'message.php';
include 'admin.php';
include 'check_if_added.php';

if(empty($_POST['search'])) {
    echo 'Please type what you would like to search for';
    //if user searches without any input display message
}else{
    $user_search = $_POST['search'];
    $sql = "SELECT id, `name`, price, img, `desc`, ean FROM items WHERE `desc` LIKE '%$user_search%'";
    //user search variable is set, if the description of the item is like the users' post search request
    //run for each loop which gets all matching items from query
    $query_run = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $item) { ?>
<div class = "grid-item">
                <p>Name:<?=$item['name']; ?></p>
                <p>Price:<?=setlocale(LC_MONETARY, 'en_GB');
                    utf8_encode(money_format('%n', 1000));
                    echo money_format("£%i",$item['price']);?></p>
                <p><img class="img" src="<?= $item['img'];?>"></p>
                <p>Description:<?= $item['desc'];?></p>
                <?php if(!isset($_SESSION['email'])){?>
                    <p><a href="login.php" role="button" class="btn btn-primary btn-block">Buy Now</a></p>

                    <?php
                }else{
                    if(check_if_added_to_cart($item['id'])){
                        echo '<a href="#" class=btn btn-block btn-success disabled>Added to cart</a>';
                    }else{
                        ?>
                        <a href="cart_add.php?id=<?=$item['id'];?>" class="btn btn-block btn-primary" name="add" value="add" class="btn btn-block btr-primary">Add to cart</a>
                        <?php
                    }
                }
                if($admin){?>
                <a href="shopping-view.php?id=<?=$item['id']; ?>" class="btn btn-info btn-sm">View</a>
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
    }
}

mysqli_close($conn);
?>
</div>
</body>
</html?>