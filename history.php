<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>History Shor url</title>
  <link rel="stylesheet" href="style.css">
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
<body>
<!-- partial:index.partial.html -->
<body class="bg">>
<?php
$servername = 'localhost';
$username = 'root';
$password = ''; // on localhost by default there is no password
$dbname = 'boy';
$conn = new mysqli($servername, $username, $password, $dbname);

?>
 <div id="wrapper">
  <center><h1>History Short Url</h1></center>
  
  <table id="keywords" cellspacing="0" cellpadding="0" >
    <thead>
      <tr>
        <th><span>##</span></th>
        <th><span>ORIGINAL URL</span></th>
        <th><span>SHORT URL</span></th>
        <th><span>COUNT</span></th>
      </tr>
    </thead>
    <tbody>
<?php
$query = "SELECT * FROM url_shorten  "; 
 $result = $conn->query($query);
 if ($result->num_rows > 0) {
 $b=0;
 while($row = $result->fetch_assoc()) {
  $b=$b+1;
         $url = $row['url'];
         $short_code = $row['short_code'];
         $hits = $row['hits'];
?>

        <tr>
        <td ><?php echo $b; ?></td>
        <td><?php echo $url; ?></td>
        <td align="center"><?php echo $short_code; ?></td>
        <td align="center"><?php echo $hits; ?></td>
      </tr>

<?php 

  }

}
?>

    </tbody>
  </table>
 </div> 
</body>
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.28.14/js/jquery.tablesorter.min.js'></script><script  src="./script.js"></script>

</body>
</html>
