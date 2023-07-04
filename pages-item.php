<?php
include_once("backend/inc/connection.php");

// get essentials
$link_actual = '';
$page_template = '';
if( isset($_REQUEST['id']) && !empty($_REQUEST['id']) ){
  $pid = $_REQUEST['id'];
  //Simple select query
  $page_sql = "SELECT * FROM pages WHERE `pid` = '$pid' ";
  $page_query = mysqli_query($conn, $page_sql);
  $post = mysqli_fetch_assoc($page_query);

  if( !empty($post) ){
    // echo $post['page_media'];
    $title       = $post['page_title'];
    $description = $post['page_description'];
    $keywords    = $post['page_keywords'];
    $link_actual = $post['page_permalink'];
    $page_template = $post['page_template'];
  } else {
    // echo "post not found";
    $title       = "Page not Found";
    $description = "Page not found";
    $keywords    = "Page not found";
    echo "Valid data not Found. ";
    exit;
  }
} else {
  echo "Valid ID not Found. ";
  exit;
}

// header
include('header.php');
?>


<!-- page content template -->
<?php
if( !empty($page_template) ){
  // if page template set
  include('templates/'.$page_template);
} else {
  // else load default
  include('templates/page-content.php');
}
?>


<!-- footer -->
<?php include('footer.php'); ?>
