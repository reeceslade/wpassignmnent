<?php
require 'connection.php';
?>

<!Doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>User Edit</title>
</head>
<body>

<div class="container mt-5">

    <?php include('message.php'); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Item Edit
                        <a href="shopping-table.php" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">

                    <?php
                    if(isset($_GET['id'])){
                        $item_id=$conn->real_escape_string($_GET['id']);
                        $query="SELECT id, `name`, price, img, `desc`, ean FROM items WHERE id='$item_id'";
                        $query_run=mysqli_query($conn, $query);
//for each loop fetches all items in query and displays them onto page where admin can change whatever attribute they want
                        // one exception is that they cannot change ID as this is a primary key
                        if(mysqli_num_rows($query_run) > 0){
                            $item=mysqli_fetch_array($query_run);?>
                            <form action="shopping-code.php" enctype="multipart/form-data" method="POST">
                                <input type="hidden" name="id" value="<?=$item['id'];?> ">
                                <div class="mb-3">
                                    <label>Item Name</label>
                                    <input type="text" name="name" value="<?=$item['name'];?>" required="" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Item Price</label>
                                    <input type="number" step="0.01" name="price" value="<?=$item['price'];?>" required="" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Item Image</label>
                                    <input type="file" name="img" value="<?=$item['img'];?>" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Item Description</label>
                                    <input type="text" name="desc" value="<?=$item['desc'];?>" required="" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <button type="submit" name="update_product" class="btn btn-primary">
                                        Update Item
                                    </button>
                                </div>
                            </form>
                            <?php
                        }else{
                            echo "<h4>No Such Id Found</h4>";
                        }
                    }

                    mysqli_close($conn);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>