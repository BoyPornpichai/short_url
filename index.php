
<!DOCTYPE html>
<html lang="en">
<head>

    <meta http-equiv=Content-Type content="text/html; charset=utf-8">
    <title>Generate Short Url</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <style>
        body, html {
            height: 100%;
            width: 100%;
        }
        .bg {
            background-image: url("images/bg.jpg");
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>


</head>
<body class="bg">
<?php 
//connect DB MYSQL
$servername = 'localhost';
$username = 'root';
$password = ''; // on localhost by default there is no password
$dbname = 'boy';
$base_url='https://1def-49-230-5-196.ngrok.io/Jigsaw/'; // domain host



if (isset($_GET['url']) && $_GET['url']!="")
{ 
$url=urldecode($_GET['url']);

    if (filter_var($url, FILTER_VALIDATE_URL)) 
    {
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
} 
$slug=GetShortUrl($url);
$conn->close();

//echo $base_url.$slug;
//echo $slug;
?>
<div class="container" id="panel">
        <br><br><br>
        <div class="row">
            <div class="col-md-6 offset-md-3" style="background-color: white; padding: 20px; box-shadow: 10px 10px 5px #888;">
                <div class="panel-heading">
                    <h1>Paste Your Url Here   <a href='history.php' target='_blank'> <img src="images/log.png" title="History Short url" width="50" height="50"></a></h1>
                </div>
                <hr>
                <form>
                    <input type="url" autocomplete="off" class="form-control" name="url" style="border-radius: 0px; " placeholder="Url...." required>
                    <input type="hidden" id="slug" name="slug" value="<?php echo $slug;?>">
                    <br>
                    <input type="submit" class="btn btn-md btn-danger btn-block" >

                    <br>
                    </form>
                    <?php 
                echo "Input Link : <a href='$url' target='_blank'>$url</a>";
                echo "<br><br>";
                 echo 'Here is the short  link : ';
                 
                 echo "<a href='$url' target='_blank' id='p1'>$base_url$slug</a>";
                 $QR_URL=$base_url.$slug;
                  ?>

                 <button onclick="copyToClipboard('#p1')">Copy</button>
                <br><br>
                <center>
                    <h4>QR Code Short Url</h4>
                <img src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=<?php echo $QR_URL;?>/&choe=UTF-8" title="<?php echo $QR_URL;?>" />
            </center>
                
            </div>
        </div>
    </div>



  

 <?php

    } 
    else 
    {
    die("$url is not a valid URL");
    }

}
else
{
?>
<center>

<div class="container" id="panel">
        <br><br><br>
        <div class="row">
            <div class="col-md-6 offset-md-3" style="background-color: white; padding: 20px; box-shadow: 10px 10px 5px #888;">
                <div class="panel-heading">
                    <h1>Paste Your Url Here   <a href='history.php' target='_blank'> <img src="images/log.png" title="History Short url" width="50" height="50"></a></h1>
                </div>
                <hr>
                <form>
                    <input type="url" autocomplete="off" class="form-control" name="url" style="border-radius: 0px; " placeholder="Url...." required>
                    <input type="hidden" id="slug" name="slug" value="<?php echo $slug;?>">
                    <br>
                    <input type="submit" class="btn btn-md btn-danger btn-block" >
                </form>
            </div>
        </div>
    </div>




<?php
}



function GetShortUrl($url){
 global $conn;
 $query = "SELECT * FROM url_shorten WHERE url = '".$url."' "; 
 $result = $conn->query($query);
 if ($result->num_rows > 0) {
$row = $result->fetch_assoc();
$hits=$row['hits']+1;
$sql = "update url_shorten set hits='".$hits."' where id='".$row['id']."' ";
$conn->query($sql);
 return $row['short_code'];
} else {
$short_code = generateUniqueID();
$sql = "INSERT INTO url_shorten (url, short_code, hits)
VALUES ('".$url."', '".$short_code."', '1')";
if ($conn->query($sql) === TRUE) {
return $short_code;
} else { 
die("Unknown Error Occured");
}
}
}



function generateUniqueID(){
 global $conn; 
 $token = substr(md5(uniqid(rand(), true)),0,4); // creates a 6 digit unique short id. You can maximize it but remember to change .htacess value as well

 $query = "SELECT * FROM url_shorten WHERE short_code = '".$token."' ";
 $result = $conn->query($query); 
 if ($result->num_rows > 0) {
 generateUniqueID();
 } else {
 return $token;
 }
}



?>

   <script>
function copyToClipboard(element) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).text()).select();
  document.execCommand("copy");
  $temp.remove();
}

</script> 
</body>
</html>