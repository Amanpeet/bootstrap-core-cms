<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'amanz');
define('DB_PASSWORD', 'password0');
define('DB_DATABASE', 'core_php_cms');

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE)
or die("Connection error: " . mysqli_connect_error());

//set site url
$domain = "http://localhost/core_php_cms/";
// $domain = "http://localhost/core_php_cms/";
define( 'SITE_URL', $domain );
$site_url = $domain;


// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

echo "Connected successfully";

echo "<br><br>";

echo $site_url;

echo "<br><br>";

// Get all tables from the database
$tables = array();
$result = mysqli_query($conn, "SHOW TABLES");
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_row($result)) {
    $tables[] = $row[0];
  }
}

// Output the list of tables
if (!empty($tables)) {
  echo "Tables in the database: " . implode(", ", $tables);
} else {
  echo "No tables found in the database.";
}



// Close the connection
mysqli_close($conn);




// // Check if the target directory exists
// if (!is_dir($targetDir)) {
//   echo "Target directory does not exist.";
//   exit;
// }
// // Check if the target directory is writable
// if (!is_writable($targetDir)) {
//   echo "Target directory is not writable.";
//   exit;
// }
// // check if moves or not
// if (move_uploaded_file($imagetmp, $path)) {
//   echo "File was uploaded successfully.";
// } else {
//   echo "Sorry, there was an error uploading the file.";
// }