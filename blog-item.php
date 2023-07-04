<?php
include_once("backend/inc/connection.php");

// get essentials
if( isset($_REQUEST['id']) && !empty($_REQUEST['id']) ){
  $bid = $_REQUEST['id'];
  //Simple select query
  $blog_sql = "SELECT * FROM blog WHERE `bid` = '$bid' ";
  $blog_query = mysqli_query($conn, $blog_sql);
  $post = mysqli_fetch_assoc($blog_query);

  if( !empty($post) ){
    // echo $post['blog_date'];
    $title =  $post['blog_title'];
    $description = $post['blog_description'];
    $keywords = $post['blog_keywords'];
  } else {
    // echo "post not found";
    $title =  "Post not Found";
    $description = "post not found";;
    $keywords = "post not found";
  }
}

// header
include('header.php');
?>

<div class="titlemon pt-4 pb-2">
  <div class="container text-center pt-4">
    <h1 class="text-dark"><strong> <?php echo $title; ?> </strong></h1>
    <div class="back-btn"><a href="<?php echo $site_url; ?>/blog.php"> <small> <i class="fa fa-arrow-left"></i> BACK TO BLOG</small></a> </div>
    <span class="line"></span>
  </div>
</div>

<section class="page-section py-5">
  <div class="container">
    <div class="cardxx card-bodyxx text-centerxx">

      <div class="row">
        <div class="col-md-10 mx-auto mb-4 blog-single">

          <?php
          if( isset($_REQUEST['id']) && !empty($_REQUEST['id']) ){
            $bid = $_REQUEST['id'];
            //Simple select query
            $blog_sql = "SELECT * FROM `blog` WHERE `bid` = '$bid' ";
            $blog_query = mysqli_query($conn, $blog_sql);
            $post = mysqli_fetch_assoc($blog_query);
            // $site_url = "https://www.example.com/";

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

<!-- footer -->
<?php include('footer.php'); ?>
