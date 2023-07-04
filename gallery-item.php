<?php
include_once("backend/inc/connection.php");

// get essentials
if( isset($_REQUEST['img']) && !empty($_REQUEST['img']) ){
  $gid = $_REQUEST['img'];
  //Simple select query
  $gal_sql = "SELECT * FROM gallery WHERE `gid` = '$gid' ";
  $gal_query = mysqli_query($conn, $gal_sql);
  $post = mysqli_fetch_assoc($gal_query);

  if( !empty($post) ){
    $title =  $post['gal_caption'];
    $description = $post['gal_content'];
    $keywords = $post['gal_content'];
  } else {
    $title =  "Post not Found";
    $description = "post not found";
    $keywords = "post not found";
  }
}

// header
include('header.php');
?>

<div class="titlemon pt-4 pb-2">
  <div class="container text-center pt-4">
    <h3 class="text-dark"><strong> <?php echo $title; ?> </strong></h3>
    <div class="back-btn"><a href="gallery.php"> <small> <i class="fa fa-arrow-left"></i> BACK TO GALLERY </small></a> </div>
    <!-- <span class="line"></span> -->
  </div>
</div>

<section class="page-section py-5">
  <div class="container">
    <div class="cardxx card-bodyxx text-center">

      <div class="row">
        <div class="col-md-10 mx-auto mb-4 blog-single">

          <?php
          if( isset($_REQUEST['img']) && !empty($_REQUEST['img']) ){
            $gid = $_REQUEST['img'];
            //Simple select query
            $gal_sql = "SELECT * FROM `gallery` WHERE `gid` = '$gid' ";
            $gal_query = mysqli_query($conn, $gal_sql);
            $post = mysqli_fetch_assoc($gal_query);
            // $site_url = "https://www.example.com/";

            if( !empty($post) ){ ?>

              <!-- <div class="heading-section text-center my-5">
                <h2 class=""><?php echo $post['gal_tags']; ?></h2>
                <h6 class="text-muted mt-4"><?php echo $post['gal_content']; ?></h6>
              </div> -->
              <?php if(!empty($post['gal_image'])){ ?>
                <div class="limited pb-5 blog-image">
                  <img class="img-thumbnail cover-img" src="<?php echo $site_url; ?>/uploads/gallery/<?php echo $post['gal_image']; ?>" alt="">
                </div>
              <?php } ?>

              <div class="cardxxx card-bodyxxx">
                <div class="blog-content p-4 text-left">
                  <?php echo $post['gal_content']; ?>
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
