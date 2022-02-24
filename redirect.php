<?php
$servername = 'localhost';
$username = 'root';
$password = ''; // on localhost by default there is no password
$dbname = 'boy';
$conn = new mysqli($servername, $username, $password, $dbname);

$shortCode = $_GET["c"];
echo  $shortCode;
try{
    // Get URL by short code
$query = "SELECT * FROM url_shorten WHERE short_Code = '".$shortCode."' "; 
 $result = $conn->query($query);
 if ($result->num_rows > 0) {
$row = $result->fetch_assoc();
$url=$row['url'];
 
    // Redirect to the original URL
    header("Location: ".$url);
    exit;
 } else{
    header("Location: https://1def-49-230-5-196.ngrok.io/Jigsaw/");
    exit;
 }
}catch(Exception $e){
    // Display error
    echo $e->getMessage();
}
?>