<?php
session_start();
require 'connection.php';
include 'message.php';
$error='';

if(isset($_POST['delete_product'])) {
    $item_id=mysqli_real_escape_string($conn, $_POST['delete_product']);
    $query="DELETE FROM items WHERE id='$item_id' ";
    $query_run=mysqli_query($conn, $query);
//if we click delete product it will delete this item from database via query
    if($query_run) {
        $_SESSION['message']="Item Deleted Successfully";
        header("Location: shopping-table.php");
        exit(0);
        //if the query is successful display message
    } else {

        $_SESSION['message']="Item Not Deleted";
        header("Location: shopping-table.php");
        exit(0);
        //other-wise display this message
    }
}
if(isset($_POST['update_product'])){
    $item_id = $conn->real_escape_string($_POST['id']);
    $name = $conn->real_escape_string($_POST['name']);
    $price = $conn->real_escape_string($_POST['price']);
    $desc = $conn->real_escape_string($_POST['desc']);
    $ean = $conn->real_escape_string($_POST['ean']);
    $genEan = rand(1,1000000);

    if(!preg_match("/^([a-zA-Z' ]+)$/",$name)){
        header('location:https://s5306951.bucomputing.uk/wpassignment/shopping-table.php?error=name-validation');
        $_SESSION['message']="Item name cannot have a number";
        header("Location: shopping-table.php");
        exit();
        //validation for admin, if the admin accidentally puts in symbols or numbers it will display error
        //this isnt compulsory as some items may have numbers but i wanted to include it to demonstrate potential admin errors
    }
    if($price > 10000){
        header('location:https://s5306951.bucomputing.uk/wpassignment/shopping-table.php?error=price-validation');
        $_SESSION['message'] = "Price is too big";
        header("Location: shopping-table.php");
        //no item in my database is worth £10,000 so if it is bigger than this value, display error
        exit();
    }
    $sql="SELECT id, `name`, price, img, `desc`, ean FROM items WHERE id='$item_id'";

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if($row['ean']==$genEan){
        $_SESSION['message']="Ean already exists, cannot put duplicate ean value into database";
        header("Location: shopping-table.php");
        exit();
        //ean is generated randomly to save user having to input it manually
        //if somehow the random generation occurs twice (not that likely) it will display this message
    }
    if(!empty($_FILES["img"]["name"])) {
        // Get file info
        $fileName=basename($_FILES["img"]["name"]);
        $fileType=pathinfo($fileName, PATHINFO_EXTENSION);

        // Allow certain file formats
        $allowTypes=array('jpg', 'png', 'jpeg', 'gif');
        if (in_array($fileType, $allowTypes)) {
            $image=$_FILES['img']['tmp_name'];
            $imgContent=file_get_contents($image);

            $img="data:" . mime_content_type($image) . ";base64," . base64_encode($imgContent);
            //encode the image
            // Insert image content into database
            $query="UPDATE items SET `name`='$name', `desc`='$desc',price='$price',ean='$genEan',img='$img' WHERE id='$item_id'";
        }else{
            $error="wrong file type";
            header("Location: shopping-table.php");
            //if file doesnt match requirements display errors otherwise
        }
    }else{
        $query="UPDATE items SET `name`='$name',price='$price',`desc`='$desc',ean='$genEan' WHERE id='$item_id'";
    } //insert new image into database
    $query_run=mysqli_query($conn, $query);
    $newID=mysqli_insert_id($conn);
    if($query_run){
        $_SESSION['message']="Item edited Successfully";
        header("Location: shopping-table.php");

    }else{
        $_SESSION['message']="Item not edited" . " ". $error;
        header("Location: shopping-table.php");
    }
}
//if query is successful or not, display these messages
if(isset($_POST['save_product'])){
    //adding image works
    $item_id = $conn->real_escape_string($_POST['id']);
    $name = $conn->real_escape_string($_POST['name']);
    $price = $conn->real_escape_string($_POST['price']);
    $img = $conn->real_escape_string($_POST['img']);
    $desc = $conn->real_escape_string($_POST['desc']);
    $ean = $conn->real_escape_string($_POST['ean']);
    $genEan = rand(1, 1000000);

    if(!preg_match("/^([a-zA-Z' ]+)$/", $name)){
        header('location:https://s5306951.bucomputing.uk/wpassignment/shopping-table.php?error=name-validation');
        $_SESSION['message']="Item name cannot have a number";
        header("Location: shopping-table.php");
        exit();
    }
    if($price > 10000){
        header('location:https://s5306951.bucomputing.uk/wpassignment/shopping-table.php?error=price-validation');
        $_SESSION['message'] = "Price is too big";
        header("Location: shopping-table.php");
        exit();
    }

    $sql="SELECT id, `name`, price, img, `desc`, ean FROM items WHERE id='$item_id'";
    //this needs to be changed because everytime we want to edit we have to change name
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

      if($row['ean']==$genEan){
        $_SESSION['message']="Ean already exists, cannot put duplicate ean value into database";
      header("Location: shopping-table.php");
    exit();
     }


    if(!empty($_FILES["img"]["name"])){
        // Get file info
        $fileName = basename($_FILES["img"]["name"]);
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

        // Allow certain file formats
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if(in_array($fileType, $allowTypes)){
            $image = $_FILES['img']['tmp_name'];
            $imgContent = file_get_contents($image);

            $img="data:" . mime_content_type($image) . ";base64," . base64_encode($imgContent);
            $newID=mysqli_insert_id($conn);
            // Insert image content into database
            $insert=$conn->query("UPDATE items SET img ='$img' WHERE id='$newID'");

            if($insert){
                //$status = 'success';
                echo "File uploaded successfully.";
            }else{
                $_SESSION['message'] = "File upload failed, please try again.";
                exit();
            }
        }else{
            $_SESSION['message'] = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
            header("Location: shopping-table.php");
            exit();
        }
        if($count == 1){
            $_SESSION['message'] = "Item already exists, cannot put duplicate username/email into database";
            header("Location: shopping-table.php");
            exit();
        }else{
            $query = "INSERT INTO items (`name`,`price`, img, `desc`, ean) VALUES ('$name','$price','$img', '$desc', '$genEan')";
            $query_run = mysqli_query($conn, $query);
        }
        if($query_run){
            $_SESSION['message']="Product Created Successfully";
            header("Location: shopping-table.php");
            exit();
        }else{
            $_SESSION['message']="Product Not Created";
            header("Location: shopping-table.php");
            exit();
        }
    }
}
//similar code to update except instead of editing pre-existing items it adds a new item into database if it meets all requirements above
mysqli_close($conn);
?>