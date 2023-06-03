<?php
$username = "s5306951";
$password = "nUYxjcoFL7jjyFrUVu4tmzkPoCroP37F";
$host = "db.bucomputing.uk";
$port = 6612;
$database = $username;

// Create connection
$conn=new MySQLi();
$conn->ssl_set(NULL, NULL, NULL, '/public_html/sys_tests', NULL);

// Connect the MySQL connection
$conn->real_connect($host, $username, $password, $database, $port, NULL, MYSQLI_CLIENT_SSL_DONT_VERIFY_SERVER_CERT);

// Check connection
if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}else{
    echo "";
}
//SQL CONNECTION WHICH IS INCLUDED WHEN WE NEED TO EXECUTE SQL QUERIES in php