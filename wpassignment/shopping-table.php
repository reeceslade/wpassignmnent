<?php

session_start();
require 'connection.php';
include 'message.php';
include 'admin.php';
?>

<!Doctype html>
<html lang="en">
<head>
    <style>
        .item-details{
            text-align: center;
        }
        img{
            height:170px;
            width:170px;
        }
    </style>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/3844/3844724.png"/>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/3844/3844724.png"/>
</head>
<body>
<?php if($admin){?>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="item-details">Item Details
                        <a href="products.php" class="btn btn-primary float-start">Home</a>
                        <a href="shopping-create.php" class="btn btn-link float-end">Add Items</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Item Name</th>
                            <th>Item Description</th>
                            <th>Item Price</th>
                            <th>Item Image</th>
                            <th>EAN</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $query="SELECT id, `name`, price, img, `desc`, ean FROM items";
                        $query_run=mysqli_query($conn, $query);

                        if(mysqli_num_rows($query_run) > 0){
                            foreach($query_run as $item)
                            {
                                ?>
                                <tr>
                                    <td><?=$item['id'];?></td>
                                    <td><?=$item['name'];?></td>
                                    <td><?=$item['desc'];?></td>
                                    <td><?=setlocale(LC_MONETARY, 'en_GB');
                                        utf8_encode(money_format('%n', 1000));
                                        echo money_format("£%i", $item['price']);
                                        ?></td>
                                    <td><img src="<?=$item['img'];?>" alt="item-image"</td>
                                    <td><?=$item['ean'];?></td>
                                    <td><a href="shopping-view.php?id=<?=$item['id'];?>" class="btn btn-info btn-sm">View</a>
                                        <a href="shopping-edit.php?id=<?=$item['id'];?>" class="btn btn-success btn-sm">Edit</a>
                                        <form action="shopping-code.php" method="POST" class="d-inline">
                                            <button type="submit" name="delete_product" value="<?=$item['id'];?>" class="btn btn-danger btn-sm">Delete</button>
                                        </form></td>
                                    </td>
                                </tr>
                                <?php
                            }

                        }else{
                            echo "<h5> No Record Found </h5>";
                        }?>
                      <?php }else{
                        echo '<h1>Only admin users can access this page</h1>';
                      }
                      //for each repeated as demonstrated in other files
                      //if the user is equal to an admin user these details will be displayed
                      //otherwise we are told that we do not have permission to this page
                        mysqli_close($conn);
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
