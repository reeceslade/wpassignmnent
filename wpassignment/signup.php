<?php
require 'connection.php';
include 'message.php';
session_start();
if(isset($_SESSION['email'])){
    header('location: products.php');
}
if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm-password'];

    if(!preg_match("/^([a-zA-Z' ]+)$/",$name)){
        header('location:https://s5306951.bucomputing.uk/wpassignment/signup.php?error=name-validation');
        exit();
    } //if name isnt valid display error
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header('location:https://s5306951.bucomputing.uk/wpassignment/signup.php?error=email-validation');
            exit();
        }//if email isnt valid display error

        $pattern = "/^(\+44\s?7\d{3}|\(?07\d{3}\)?)\s?\d{3}\s?\d{3}$/";
        $match = preg_match($pattern, $phone);
        if($match == false) {
            header('location:https://s5306951.bucomputing.uk/wpassignment/signup.php?error=phone-validation');
            exit();
        }elseif (strlen($phone < 11)) {
            header('location:https://s5306951.bucomputing.uk/wpassignment/signup.php?error=phone-validation');
            exit();
        }
    //if phone number isnt valid display error
        $number = preg_match('@[0-9]@', $password);
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);
        //IF PASSWORD DOESNT MEET REQUIREMENT DISPLAY ERROR
        if($password != $confirmPassword) {
            header('location:https://s5306951.bucomputing.uk/wpassignment/signup.php?error=password-match');
            exit();
        }
        if(strlen($password) < 8 || !$number || !$uppercase || !$lowercase || !$specialChars) {
            header('location:https://s5306951.bucomputing.uk/wpassignment/signup.php?error=password-validation');
            exit();
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "SELECT id, `name`, email, password, phone, `admin` FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);
        //hash users password and check whether ot not the user already exists
        if($count == 1) {
            header('location:https://s5306951.bucomputing.uk/wpassignment/signup.php?error=email-dupe');
            exit();
        }else{
            $sql1 = "INSERT INTO users(name, email, phone, password) VALUES ('$name', '$email', '$phone', '$hashed_password')";
            header("location:products.php");
            if(mysqli_query($conn, $sql1)) {
                $_SESSION['email'] = $email;
                $_SESSION['id'] = mysqli_insert_id($conn);
            }else{
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            //if user doesnt exists, insert all values into database
            $conn->close();
        }
}
?>

<!DOCTYPE html>
<head>
    <style>
        .errors{
            color: red;
        }
    </style>
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/3844/3844724.png"/>
    <title>Sign up</title>
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
    <br><br>
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-xs-offset-4">
                <h1><b>SIGN UP</b></h1>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"
            </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="name" placeholder="Name" required=""><?php if(isset($_GET['error']) && $_GET['error']=='name-validation'){
                        echo "<span class='errors'>*Not a valid name</span><br>";
                    }?>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="Email" required=""><?php if(isset($_GET['error']) && $_GET['error']=='email-validation'){
                        echo "<span class='errors'>*Not a email address</span><br>";
                    }?>
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" name="phone" placeholder="Phone" required=""><?php if(isset($_GET['error']) && $_GET['error']=='phone-validation'){
                        echo "<span class='errors'>*Not a valid phone number</span><br></input>";
                    }?>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password" required=""><?php if(isset($_GET['error']) && $_GET['error']=='password-validation'){
                        echo "<span class='errors'>*Password must contain one uppercase and lowercase letter, one number and one symbol</span><br>";
                    }?>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="confirm-password" placeholder="Confirm Password" required=""><?php if(isset($_GET['error']) && $_GET['error']=='password-match'){
                        echo "<span class='errors'>*Passwords do not match</span><br>";
                    }?>
                </div>
                <div class="form-group">
                    <center><input type="submit" name="submit" class="btn btn-primary" value="submit"></center>
                    <?php if(isset($_GET['error']) && $_GET['error']=='email-dupe'){
                        echo "<span class='errors'>*User already exists, cannot put duplicate username/email into database</span><br>";
                    }?>
                </div>
                </form>
            </div>
        </div>
    </div>
    <br><br><br><br><br><br>
    <footer class="footer">
        <div class="container">
            <center>
            </center>
        </div>
    </footer>
</div>
</body>
