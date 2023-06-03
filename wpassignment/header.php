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
    <style>
    p{
    color: #9d9d9d;;
    }
    .searchBtn{
    max-height: 27px;
    max-width: 30px;
    }
    </style>
</head>
<body>
<nav class="navbar navbar-inverse navabar-fixed-top">
               <div class="container">
                   <div class="navbar-header">
                       <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                       </button>
                       <a href="index.php" class="navbar-brand">Home</a>
                   </div>
                   <div class="collapse navbar-collapse" id="myNavbar">
                       <ul class="nav navbar-nav navbar-right">
                           <?php include 'admin.php';
                           session_start();
                           if(isset($_SESSION['email'])){
                           ?>
                                   <?php if (mysqli_connect_error()) { // If connection error
                                   echo("Failed to connect to the database");
                               } else { // Database connected correctly - Only show page contents if we have a database connection to use
                                   echo "<p>"
                                       . "Welcome " . $_SESSION["email"]
                                       . " ( ". $_SESSION["id"]." "
                                       . $_SESSION["name"].")"
                                       . "</p>";
                               }
                               // IF THE USER IS LOGGED IN ECHO THE USERS EMAIL AND ID IN THE HEADER?>
                           <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
                           <li><a href="settings.php"><span class="glyphicon glyphicon-cog"></span> Settings</a></li>
                           <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                               <?php if($admin) {
                                   //IF THE LOGGED IN USER IS == ADMIN USER THEY WILL GET AN ADDITIONAL ADMIN VIEW BUTTON
                                 echo  '<li><a href="shopping-table.php"><span class="glyphicon glyphicon-eye-open"></span>Admin View</a></li>';
                               }?>
                           <?php
                           }else{
                               //OTHERWISE IF A USER ISNT LOGGED IN DISPLAY THESE ICONS INSTEAD
                            ?>
                            <li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                           <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>

                           <?php
                           }
                           ?>

                       </ul>
                   </div>
               </div>
</nav>
<form class="search" action="search.php" method="post">
    <input type="text" placeholder="Search.." name="search" required="">
    <button class="searchBtn" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
        </svg></button>

</form>
</body>
</html>