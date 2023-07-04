<?php
include_once("backend/inc/connection.php");

// get essentials
$link_actual = "";
$page_template = '';
if( isset($_REQUEST['link']) && !empty($_REQUEST['link']) ){
  $link = $_REQUEST['link'];
  $link_actual = $_REQUEST['link'];
  //Simple select query
  $page_sql = "SELECT * FROM pages WHERE `page_permalink` = '$link' LIMIT 1 ";
  $page_query = mysqli_query($conn, $page_sql);
  $post = mysqli_fetch_assoc($page_query);

  if( !empty($post) ){
    // echo $post['page_media'];
    $title       = $post['page_title'];
    $description = $post['page_description'];
    $keywords    = $post['page_keywords'];
    $image       = $site_url ."/uploads/pages/". $post['page_image'];
    $page_template = $post['page_template'];
  } else {
    // echo "post not found";
    $title       = "Page not Found";
    $description = "Page not found";
    $keywords    = "Page not found";
    $image       = "";
    echo "Valid Page not Found. ";
    exit;
  }
} else {
  echo "Valid link not Found. ";
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
