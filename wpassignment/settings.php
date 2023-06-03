<?php
session_start();
    require 'connection.php';
    if(!isset($_SESSION['email'])){
        header('location:index.php');
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <style>
            .errors{
                color: red;
            }
        </style>
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
                <div class="row">
                    <div class="col-sm-6 col-xs-offset-4">
                        <h1>Change Password</h1>
                        <form method="post" action="s-script.php">
                            <div class="form-group">
                                <input type="password" class="form-control" name="oldPassword" placeholder="Old Password" required=""><?php if(isset($_GET['error']) && $_GET['error']=='password-dupe'){
                                    echo "<span class='errors'>*Cannot set old password as new one</span><br>";
                                }?>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="newPassword" placeholder="New Password" required=""><?php if(isset($_GET['error']) && $_GET['error']=='password-validation'){
                                    echo "<span class='errors'>*Not a valid new password</span><br>";
                                }?>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="retype" placeholder="Re-type new password" required=""><?php if(isset($_GET['error']) && $_GET['error']=='password-match'){
                                    echo "<span class='errors'>*New passwords do not match</span><br>";
                                }?>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Change">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <br><br><br><br><br>
           <footer class="footer">
               <div class="container">
               <center>
               </center>
               </div>
           </footer>
        </div>
    </body>
</html>
