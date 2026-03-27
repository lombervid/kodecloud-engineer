<?php
// kubectl cp index.php <pod-name>:/app -c <container-name>
$dbname = getenv('MYSQL_DATABASE');
$dbuser = getenv('MYSQL_USER');
$dbpass = getenv('MYSQL_PASSWORD');
$dbhost = getenv('MYSQL_HOST');

$connect = mysqli_connect($dbhost, $dbuser, $dbpass) or die("Unable to Connect to '$dbhost'");

$test_query = "SHOW TABLES FROM $dbname";
$result = mysqli_query($connect,$test_query);

if ($result->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
