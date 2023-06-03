<?php
    require 'connection.php';
    session_start();

if(isset($_SESSION['email'])){
    header('location: products.php');
}
//if user is logged in redirect to products.php

if(isset($_POST['submit'])) {
    if ((!empty($_POST["email"])) && (!empty($_POST["password"]))) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
//if user hits submit get the email and password they entered via post request
        //hash the password they input for security

        $sql="SELECT id, `name`, email, password, phone, `admin` FROM users WHERE email='$email'";
        $result=mysqli_query($conn, $sql);
        $row=mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count=mysqli_num_rows($result);
//select everything from users where post email is the same as the email column in database

        if ($email!=$row['email']) {
            header('location:https://s5306951.bucomputing.uk/wpassignment/login.php?error=email-match');
        }
        //if email is not equal to the row we have in the database display message
        if($result->num_rows > 0) { //if the row count > 0, the user exists
            if(password_verify($password, $row['password'])){ //if password matches database row hash
                echo 'login success';
                $_SESSION['email'] = $email;
                $_SESSION['id'] = $row['id'];  //user id
                header('location: products.php');
            }else{
                header('location:https://s5306951.bucomputing.uk/wpassignment/login.php?error=incorrect-password');
                //if the password doesnt match the one in database display message
            }

        }
    }
}

mysqli_close($conn);
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
        <title>Login</title>
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
            <br><br><br>
           <div class="container">
                <div class="row">
                    <div class="col-xs-6 col-xs-offset-3">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3>LOGIN</h3>
                            </div>
                            <div class="panel-body">
                                <p>Login to make a purchase.</p>
                                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email" placeholder="Email" required=""><?php if(isset($_GET['error']) && $_GET['error']=='email-match') {
                                            echo "<span class='errors'>*Incorrect Email</span><br>";
                                        }?>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="password" placeholder="Password" required=""><?php if(isset($_GET['error']) && $_GET['error']=='incorrect-password') {
                                            echo "<span class='errors'>*Incorrect password</span><br>";
                                        }?>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="submit" value="Login" class="btn btn-primary">
                                    </div>
                                </form>
                            </div>
                            <div class="panel-footer">Don't have an account yet? <a href="signup.php">Register</a></div>
                        </div>
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
