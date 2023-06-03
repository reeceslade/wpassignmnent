<?php
session_start();
require 'connection.php';
if(!isset($_SESSION['email'])){
    header('location:index.php');
}

$old_password=$_POST['oldPassword']; //get old password
$new_password=$_POST['newPassword']; //get new password

$reType=$_POST['retype']; // GETS RETYPED PASSWORD

$number=preg_match('@[0-9]@', $new_password);
$uppercase=preg_match('@[A-Z]@', $new_password);
$lowercase=preg_match('@[a-z]@', $new_password);
$specialChars=preg_match('@[^\w]@', $new_password);
//IF PASSWORD DOESNT MEET REQUIREMENT DISPLAY ERROR

if($new_password != $reType){
    header('location:https://s5306951.bucomputing.uk/wpassignment/settings.php?error=password-match');
    exit();
    //password not equal to new one display error
}
if(strlen($new_password) < 8 || !$number || !$uppercase || !$lowercase || !$specialChars) {
    header('location:https://s5306951.bucomputing.uk/wpassignment/settings.php?error=password-validation');
    exit();
//IF PASSWORD DOESNT MEET REQUIREMENT DISPLAY ERROR
}
if($old_password == $new_password){
    header('location:https://s5306951.bucomputing.uk/wpassignment/settings.php?error=password-dupe');
    exit();
}
//if old password is equal to new password display error

$hashed_password=password_hash($old_password, PASSWORD_DEFAULT); // hash old password
$hashed_password2=password_hash($new_password, PASSWORD_DEFAULT); //hash new password
$email=$_SESSION['email'];
//echo $email;
$password_from_database_query="select password from users where email='$email'"; //get users email
$password_from_database_result=mysqli_query($conn,$password_from_database_query) or die(mysqli_error($conn));
$row=mysqli_fetch_array($password_from_database_result);

if(password_verify($old_password, $row['password'])){ //if old password hash matches the one in database
$update_password_query="update users set password='$hashed_password2' where email='$email'";
$update_password_result=mysqli_query($conn,$update_password_query) or die(mysqli_error($conn));
echo "Your password has been updated.";
//update the old password in database with new one + new hash
?>
    <?php
}else{
    ?>
    <script>
        window.alert("Wrong password!!");
    </script>
    <?php
    //if old password doesnt match the current password in database display alert error
}

mysqli_close($conn);
?>