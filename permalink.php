<?php
include_once("backend/inc/connection.php");

//get the url
$requestURI = explode('/', $_SERVER['REQUEST_URI']);
$scriptName = explode('/', $_SERVER['SCRIPT_NAME']); //real this script
// print_r($requestURI);

//remove subdirectories
for ($i = 0; $i < sizeof($scriptName); $i++) {
  if ($requestURI[$i] == $scriptName[$i]) {
    unset($requestURI[$i]);
  }
}
$link_parts  = array_values($requestURI); // break array
$link_parts  = array_filter($link_parts); // remove empty values
$link_actual = $link_parts[array_key_last($link_parts)]; // last part

// check permalink type
$link_type = "";
if( count($link_parts) > 1 ) {
  $link_type = $link_parts[array_key_last($link_parts)-1]; // last part minus one
}

// print_r($link_parts);
// echo $link_type;
// echo $link_actual;

// if blog
if ( $link_type == 'blog' ) {

    // get essentials
    if( !empty($link_actual) ){
      $link = $link_actual;
      //Simple select query
      $blog_sql = "SELECT * FROM blog WHERE `blog_permalink` = '$link' LIMIT 1 ";
      $blog_query = mysqli_query($conn, $blog_sql);
      $post = mysqli_fetch_assoc($blog_query);

      if( !empty($post) ){
        // echo $post['blog_date'];
        $title       = $post['blog_title'];
        $description = $post['blog_description'];
        $keywords    = $post['blog_keywords'];
        $image       = $site_url ."/uploads/blog/". $post['blog_image'];
      } else {
        // echo "post not found";
        $title       = "Post not Found";
        $description = "post not found";
        $keywords    = "post not found";
        $image       = "";
      }
    }

    // header
    include('header.php');
    ?>

    <div class="titlemon pt-4 pb-2 permalink-page">
      <div class="container text-center pt-4">
        <h1 class="text-dark"><strong> <?php echo @$title; ?> </strong></h1>
        <div><a href="<?php echo $site_url; ?>/blog.php"> <small> <i class="fa fa-arrow-left"></i> BACK TO BLOG</small></a> </div>
        <span class="line"></span>
      </div>
    </div>

    <section class="page-section py-5">
      <div class="container">
        <div class="cardxx card-bodyxx text-centerxx">

          <div class="row">
            <div class="col-md-10 mx-auto mb-4 blog-single">

              <?php
              if( !empty($link_actual) ){
                $link = $link_actual;
                //Simple select query
                $blog_sql = "SELECT * FROM blog WHERE `blog_permalink` = '$link' LIMIT 1 ";
                $blog_query = mysqli_query($conn, $blog_sql);
                $post = mysqli_fetch_assoc($blog_query);

                if( !empty($post) ){ ?>

                  <!-- <div class="heading-section text-center my-5">
                    <h2 class=""><?php echo $post['blog_title']; ?></h2>
                    <h6 class="text-muted mt-4"><?php echo $post['blog_date']; ?></h6>
                  </div> -->
                  <?php if(!empty($post['blog_image'])){ ?>
                    <div class="limited pb-5 blog-image">
                      <img class="card-img cover-img" src="<?php echo $site_url; ?>/uploads/blog/<?php echo $post['blog_image']; ?>" alt="">
                    </div>
                  <?php } ?>

                  <div class="card card-body">
                    <div class="blog-content p-4 text-left">
                      <?php echo $post['blog_content']; ?>
                    </div>
                  </div>

                <?php } else { ?>

                  <div class="card card-body">
                    <div class="blog-content p-4 text-left">
                      <h2 class="">Nope, Nothing found!</h2>
                      <div class="lead">No post found on given address, please check your url or search above.</div>
                    </div>
                  </div>

                <?php } ?>

              <?php } else { ?>

                <div class="card card-body">
                  <div class="blog-content p-4 text-left">
                    <h2 class="">Nope, Nothing found!</h2>
                    <div class="lead">No post found on given address, please check your url or search above.</div>
                  </div>
                </div>

              <?php } ?>

            </div>
          </div>

        </div>
      </div>
    </section>
    <?php


// if pages
} elseif ( $link_type == 'custom reserved' ) {


// for pages
} else {

    // set essentials
    if( !empty($link_actual) ){
      $link = $link_actual;
      $page_template = '';
      //Simple select query
      $page_sql = "SELECT * FROM pages WHERE `page_permalink` = '$link' LIMIT 1 ";
      $page_query = mysqli_query($conn, $page_sql);
      $post = mysqli_fetch_assoc($page_query);

      if( !empty($post) ){
        // echo $post['page_media'];
        $title       = $post['page_title'];
        $description = $post['page_description'];
        $keywords    = $post['page_keywords'];
        $page_template = $post['page_template'];
        $image       = $site_url ."/uploads/pages/". $post['page_image'];
      } else {
        // echo "post not found";
        $title       = "Page not Found";
        $description = "Page not found";
        $keywords    = "Page not found";
        $image       = "";
      }
    }

    // header
    include('header.php');
    ?>

    <!-- page content template -->
    <?php
      // echo $page_template;
      if( !empty($page_template) ){
        // if page template set
        include('templates/'.$page_template);
      } else {
        // else load default
        include('templates/page-content.php');
      }
    ?>

    <?php

}
?>

<!-- footer -->
<?php include('footer.php'); ?>
