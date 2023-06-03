<?php
require 'connection.php';
include 'admin.php';
?>
<!Doctype html>
<html lang="en">
<head>
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/3844/3844724.png"/>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Product View</title>
    <style>
        img{
            height:170px;
            width:170px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>User View Details
                        <a href="products.php" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">
                    <?php
                    if(isset($_GET['id'])){
                    $item_id=$conn->real_escape_string($_GET['id']);
                    $query="SELECT id, `name`, price, img, `desc`, ean FROM items WHERE ID=$item_id";
                    $query_run=mysqli_query($conn, $query);

                    if(mysqli_num_rows($query_run) > 0){
                    $item=mysqli_fetch_array($query_run);
                    ?>
                        <div class="mb-3">
                            <label>Product Name</label>
                            <p class="form-control">
                                <?=$item['name'];?>
                            </p>
                        </div>
                        <div class="mb-3">
                            <label>price</label>
                            <p class="form-control">
                                <?="£".$item['price'];?>
                            </p>
                        </div>
                        <div class="mb-3">
                            <label>Item Image</label>
                            <p class="form-control">
                               <img src="<?=$item['img'];?>">
                            </p>
                        </div>
                        <div class="mb-3">
                            <label>Item Description</label>
                            <p class="form-control">
                                <?=$item['desc'];?>
                            </p>
                        </div>

                      <?php  }else{
                          echo "<h5> No Record Found </h5>";
                      }
                      }
                    //selecting everything from items table and display them to view
                      //if this fails display no record found
                    mysqli_close($conn); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>