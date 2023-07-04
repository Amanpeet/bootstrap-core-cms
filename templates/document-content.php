<?php
if ( !empty($post['page_image']) ) {
  $cover_img = $site_url."/uploads/pages/".$post['page_image'];
  ?>
  <div class="titlemon py-5 titlemon-bg" style="background-image: url('<?php echo $cover_img; ?>'); background-size: cover; background-position: center;">
    <div class="container text-center py-5">
      <h1 class="text-dark py-5"></h1>
      <!-- <span class="line"></span> -->
    </div>
  </div>
  <?php
}
?>

<div class="titlemon pt-4 pb-2">
  <div class="container text-center pt-4">
    <h1 class="text-dark"><strong> <?php echo @$title; ?> </strong></h1>
    <div class="back-btn"><a href="<?php echo $site_url; ?>/"> <small><strong> <i class="fa fa-arrow-left"></i> BACK TO HOME </strong></small></a> </div>
    <span class="line"></span>
  </div>
</div>

<section class="page-section py-5">
  <div class="container">
    <div class="d-block">

      <?php
      if( !empty($link_actual) ){
        $link = $link_actual;
        //Simple select query
        $page_sql = "SELECT * FROM pages WHERE `page_permalink` = '$link' LIMIT 1 ";
        $page_query = mysqli_query($conn, $page_sql);
        $post = mysqli_fetch_assoc($page_query);

        if( !empty($post) ){ ?>

          <!-- <div class="heading-section text-center my-5">
            <h2 class=""><?php echo $post['page_title']; ?></h2>
            <h6 class="text-muted mt-4"><?php echo $post['page_media']; ?></h6>
          </div> -->
          <?php if(!empty($post['page_image'])){ ?>
            <div class="limited pb-5 page-image d-none">
              <img class="card-img cover-img" src="<?php echo $site_url; ?>/uploads/pages/<?php echo $post['page_image']; ?>" alt="">
            </div>
          <?php } ?>

          <div class="card card-body">
            <div class="row">
              <div class="col-lg">
                <div class="page-content p-4 text-left">
                  <?php echo $post['page_content']; ?>
                </div>
              </div>
              <?php if(!empty($post['page_sideimg'])){ ?>
                <div class="col-lg-3">
                  <div class="side-image p-4">
                    <img class="w-100" src="<?php echo $site_url; ?>/uploads/pages/<?php echo $post['page_sideimg']; ?>" alt="">
                  </div>
                </div>
              <?php } ?>
            </div>

          </div>

        <?php } else { ?>

          <div class="card card-body">
            <div class="page-content p-4 text-left">
              <h2 class="">Nope, Nothing found!</h2>
              <div class="lead">No page found on given address, please check your url or search above.</div>
            </div>
          </div>

        <?php } ?>

      <?php } else { ?>

        <div class="card card-body">
          <div class="page-content p-4 text-left">
            <h2 class="">None, Nothing found!</h2>
            <div class="lead">No page found on given address, please check your url or search above.</div>
          </div>
        </div>

      <?php } ?>


    </div>
  </div>
</section>

<section class="page-section pt-0 pb-5">
  <div class="container">
    <div class="row g-4">
      <?php
        if( !empty($post) ){
          //Simple select query
          $media_tag = $link_actual;
          $media_ids = $post['page_media'];
          $media_ids_sql = !empty($media_ids) ? "OR gid IN ($media_ids)" : '' ;
          $gal_sql = "SELECT * FROM gallery WHERE gal_tags LIKE '%$media_tag%' ".$media_ids_sql." ORDER BY gid DESC";
          $gal_query = mysqli_query($conn, $gal_sql);
          if ($gal_query){
            while($gal_row = mysqli_fetch_array($gal_query)) {
              $post_img = (!empty($gal_row['gal_image'])) ? $gal_row['gal_image'] : 'default.jpg';
              ?>
              <div class="col-md-4 col-lg-3">
                <a class="gallery-itemx" href="<?php echo $site_url."/uploads/gallery/". $post_img ?>" data-fancybox="gallery">
                  <img class="img-thumbnail cover-imgx" src="<?php echo $site_url."/uploads/gallery/". $post_img ?>" alt="<?php echo $gal_row['gal_tags']; ?>">
                </a>
                <small class="d-block text-center"><strong><?php echo $gal_row['gal_caption']; ?></strong></small>
              </div>
            <?php
            }
          } else {
            echo "No Media Found!";
          }
        }
      ?>
    </div>
  </div>
</section>

