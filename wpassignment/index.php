<?php
require 'connection.php';
session_start();
require 'check_if_added.php';
include 'admin.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/3844/3844724.png" />
        <title>Home</title>
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
           <div id="bannerImage">
               <div class="container">
                   <center>
                   <div id="bannerContent">
                       <h1>Welcome to the music store!</h1>
                       <p>Flat 40% OFF on all premium brands.</p>
                       <a href="products.php" class="btn btn-danger">Shop Now</a>
                   </div>
                   </center>
               </div>
           </div>
           <div class="container">
               <div class="row">
                   <div class="col-xs-4">
                       <div  class="thumbnail">
                           <a href="products.php">
                                <img src="https://orchestraensemble.com/wp-content/uploads/2022/02/how_to_find_the_best_french_horn-965x650.png" alt="instruments">
                           </a>
                           <center>
                                <div class="caption">
                                        <p id="autoResize">Instruments</p>
                                        <p>Choose among the best available instruments.</p>
                                </div>
                           </center>
                       </div>
                   </div>
                   <div class="col-xs-4">
                       <div class="thumbnail">
                           <a href="products.php">
                               <img src="https://www.skoove.com/blog/wp-content/uploads/2021/07/How-to-Read-Piano-Sheet-Music-1024x684.jpeg" alt="music-sheets">
                           </a>
                           <center>
                                <div class="caption">
                                    <p id="autoResize">Music Sheets</p>
                                    <p>Original music sheets from the best musicians.</p>
                                </div>
                           </center>
                       </div>
                   </div>
                   <div class="col-xs-4">
                       <div class="thumbnail">
                           <a href="products.php">
                               <img src="https://www.djsresearch.co.uk/uploads/images/sustainable%20clothing%20-%20small.jpg" alt="merch">
                           </a>
                           <center>
                               <div class="caption">
                                   <p id="autoResize">Merchandise</p>
                                   <p>View all of our exquisite collection of clothing.</p>
                               </div>
                           </center>
                       </div>
                   </div>
               </div>
           </div>
            <br><br> <br><br><br><br>
           <footer class="footer">
               <div class="container">
               <center>
               </center>
               </div>
           </footer>
        </div>
    </body>
</html>