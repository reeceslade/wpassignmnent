<?php
session_start();
?>

<!Doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/3844/3844724.png"/>
    <title>Items Create</title>
</head>
<body>

<div class="container mt-5">

    <?php include('message.php'); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Item Add
                        <a href="shopping-table.php" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
            </div>
            <div class="card-body">
                <form action="shopping-code.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label>Item Name</label>
                        <input type="text" name="name" required="" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Item Price</label>
                        <input type="number" step="0.01" name="price" required="" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Item image</label>
                        <input type="file" name="img" required="" class="form-control">
                    </div> <div class="mb-3">
                        <label>Item Description</label>
                        <input type="text" name="desc" required="" class="form-control">
                        <br>
                    <div class="mb-3">
                        <button type="submit" name="save_product" class="btn btn-primary">Save Item</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>