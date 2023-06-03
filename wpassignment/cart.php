<?php
    session_start();
    require 'connection.php';
    if(!isset($_SESSION['email'])){
        header('location: login.php');
    }
    $user_id=$_SESSION['id'];
    $user_products_query="select it.id,it.name,it.price from users_items ut inner join items it on it.id=ut.item_id where ut.user_id='$user_id'";
    $user_products_result=mysqli_query($conn,$user_products_query) or die(mysqli_error($conn));
    $no_of_user_products= mysqli_num_rows($user_products_result);
    $sum=0;
    if($no_of_user_products==0){
        //INNER JOIN ON ITEMS AND USERS TO MAKE USERS ITEMS
        //THIS INNER JOIN AND QUERY SELECTS EVERYTHING WHERE A USER HAS ADDED SOMETHING TO CART
        //IT CHECKS TO SEE WHAT THE USER HAS ADDED TO CART BY THE LOGGED-IN SESSION['ID']
        //THIS IS CHECKED BY THE CHECK_IF_ADDED FUNCTION -- SEE FURTHER DETAILS IN CHECK_IF_ADDED.PHP
    ?>
        <script>
        window.alert("No items in the cart!!");
        </script>
    <?php
        //IF THERE ARE NO ITEMS IN CART, ALERT MESSAGE
    }else {
        while ($row=mysqli_fetch_array($user_products_result)) {
            setlocale(LC_MONETARY, 'en_GB');
            utf8_encode(money_format('%n', 1000));
            money_format("£%i",$row['price']);
            $sum=$sum+$row['price'];
            //OTHERWISE, WHILE THE ROW = THE USERS PRODUCT RESULTS
            //STORE THE ITEMS WITH THE PRICE, AND IF THERE ARE MORE THAN 1 ITEM
            //SUM == SUM + ITEM PRICE TO GET TOTAL DISPLAYED
        }
    }
?>
<!DOCTYPE html>
<html>
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
    </head>
    <body>
        <div>
            <?php
               require 'header.php';
            ?>
            <br>
            <div class="container">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>Item Number</th><th>Item Name</th><th>Price</th><th></th>
                        </tr>
                       <?php
                        $user_products_result=mysqli_query($conn,$user_products_query) or die(mysqli_error($conn));
                        $no_of_user_products=mysqli_num_rows($user_products_result);
                        $counter=1;
                       while($row=mysqli_fetch_array($user_products_result)){
                        //COUNTER COUNTS HOW MANY ITEMS ARE IN THE CART AND EACH TIME A ITEM IS ADDED
                           //COUNTER IS ADDED BY ONE THIS IS FOUND IN THE ITEM NUMBER COLUMN
                         ?>
                        <tr>
                            <th><?php echo $counter ?></th><th><?php echo $row['name']?></th><th>
                                <?php echo setlocale(LC_MONETARY, 'en_GB');
                                utf8_encode(money_format('%n', 1000));
                                echo money_format("£%i",$row['price']);?></th>
                            <th><a href='cart_remove.php?id=<?php echo $row['id'] ?>'>Remove</a></th>
                        </tr>
                       <?php $counter=$counter+1;}?>
                        <tr>
                            <th></th><th>Total</th><th><?php echo setlocale(LC_MONETARY, 'en_GB');
                                utf8_encode(money_format('%n', 1000));
                                echo money_format("£%i",$sum)?></th><th><a href="success.php?id=<?php echo $user_id?>" class="btn btn-primary">Confirm Order</a>
                                <a href="products.php" class="btn btn-danger float-end">Back</a></th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <br><br><br><br><br><br><br><br><br><br>
            <footer class="footer">
               <div class="container">
                <center>
               </center>
               </div>
           </footer>
        </div>
    </body>
</html>
