<?php
include_once("backend/inc/connection.php");

// get essentials
$link_actual = "";
if( isset($_REQUEST['cat']) && !empty($_REQUEST['cat']) ){
  $cat = $_REQUEST['cat'];
  $link_actual = $_REQUEST['cat'];
  //Simple select query
  $doc_sql = "SELECT * FROM documents WHERE `doc_category` = '$cat' LIMIT 1 ";
  $doc_query = mysqli_query($conn, $doc_sql);
  $post = mysqli_fetch_assoc($doc_query);

  $title = str_replace('-', ' ', $cat);

  // if( !empty($post) ){
  //   // echo $post['doc_media'];
  //   $title = str_replace('-', ' ', $cat);
  //   // $description = $post['doc_description'];
  //   // $keywords    = $post['doc_keywords'];
  //   // $image       = $site_url ."/uploads/pages/". $post['doc_image'];
  // } else {
  //   // echo "post not found";
  //   $title = "Data not Found";
  //   // $description = "Page not found";
  //   // $keywords    = "Page not found";
  //   // $image       = "";
  //   // echo "Category is Invalid or Empty. ";
  //   // exit;
  // }

} else {
  echo "Parameters not Found. ";
  // exit;
}

// header
include('header.php');
?>

<section class="page-section bg-dark">
  <div class="container py-5">
    <div class="row g-4 py-3">
      <div class="col-lg-3 text-center text-lg-start">
        <h1 class="text-white text-capitalize"><strong> References </strong></h1>
        <h5 class="text-white text-uppercase"><strong> <?php echo $title; ?> </strong></h5>
      </div>
      <div class="col-lg">
        <div class="row g-4">

          <div class="col-md-6 col-lg-3">
            <div class="card card-body ref-card <?php echo ($cat=="certificates")?"active":''; ?>">
              <a href="<?php echo $site_url; ?>/references.php?cat=certificates" class="d-block">
                <div class="card-icon">
                  <i class="fa fa-credit-card fa-3x"></i>
                </div>
                <div class="card-title mt-3">
                  <h6 class="mb-0">Certificates</h6>
                </div>
              </a>
            </div>
          </div>

          <div class="col-md-6 col-lg-3">
            <div class="card card-body ref-card <?php echo ($cat=="technical-information")?"active":''; ?>">
              <a href="<?php echo $site_url; ?>/references.php?cat=technical-information" class="d-block">
                <div class="card-icon">
                  <i class="fa fa-file-circle-exclamation fa-3x"></i>
                </div>
                <div class="card-title mt-3">
                  <h6 class="mb-0">Technical Information</h6>
                </div>
              </a>
            </div>
          </div>

          <div class="col-md-6 col-lg-3">
            <div class="card card-body ref-card <?php echo ($cat=="success-stories")?"active":''; ?>">
              <a href="<?php echo $site_url; ?>/references.php?cat=success-stories" class="d-block">
                <div class="card-icon">
                  <i class="fa fa-hands-holding-circle fa-3x"></i>
                </div>
                <div class="card-title mt-3">
                  <h6 class="mb-0">Success Stories</h6>
                </div>
              </a>
            </div>
          </div>

          <div class="col-md-6 col-lg-3">
            <div class="card card-body ref-card <?php echo ($cat=="in-the-news")?"active":''; ?>">
              <a href="<?php echo $site_url; ?>/references.php?cat=in-the-news" class="d-block">
                <div class="card-icon">
                  <i class="fa fa-newspaper fa-3x"></i>
                </div>
                <div class="card-title mt-3">
                  <h6 class="mb-0">In the News</h6>
                </div>
              </a>
            </div>
          </div>

          <!-- <div class="col-md-6 col-lg-3">
            <div class="card card-body ref-card <?php echo ($cat=="knowledge-corner")?"active":''; ?>">
              <a href="<?php echo $site_url; ?>/references.php?cat=knowledge-corner" class="d-block">
                <div class="card-icon">
                  <i class="fa fa-book-open fa-3x"></i>
                </div>
                <div class="card-title mt-3">
                  <h6 class="mb-0">Knowledge Corner</h6>
                </div>
              </a>
            </div>
          </div> -->

        </div>
      </div>
    </div>
  </div>
</section>


<div class="titlemon pt-4 pb-2">
  <div class="container text-center pt-4">
    <h2 class="text-dark text-capitalize"><strong> <?php echo $title; ?> </strong></h2>
    <!-- <div><a href="<?php echo $site_url; ?>/"> <small><strong> <i class="fa fa-arrow-left"></i> BACK TO HOME </strong></small></a> </div> -->
    <!-- <span class="line"></span> -->
  </div>
</div>

<section class="page-section py-5">
  <div class="container">
    <div class="d-block">
      <div class="row">

        <?php
        if( !empty($link_actual) ){
          $link = $link_actual;

          if( $link == 'success-stories' ){

              //Simple select query
              $gal_sql = "SELECT * FROM `gallery` WHERE `gal_tags` = 'success-stories' ORDER BY `gid` DESC ";
              $gal_query = mysqli_query($conn, $gal_sql);
              if ($gal_query){
                while($gal_row = mysqli_fetch_array($gal_query)) {
                  $post_img = (!empty($gal_row['gal_image'])) ? $gal_row['gal_image'] : 'default.jpg';
                  ?>
                  <div class="col-md-4 col-lg-3 p-3">
                    <a class="gallery-item mb-2" href="<?php echo $site_url."/uploads/gallery/". $post_img ?>" data-fancybox="gallery">
                      <img class="img-thumbnail cover-img" src="<?php echo $site_url."/uploads/gallery/". $post_img ?>" alt="<?php echo $gal_row['gal_tags']; ?>">
                    </a>
                    <strong><?php echo $gal_row['gal_caption']; ?></strong>
                  </div>
                <?php
                }
              } else {
                echo "No Media Found!";
              }

          } elseif( $link == 'in-the-news' ) {

            //Simple select query
            $doc_sql = "SELECT * FROM documents WHERE `doc_category` = '$link' ORDER BY `did` DESC ";
            $doc_query = mysqli_query($conn, $doc_sql);

            if( mysqli_num_rows($doc_query) > 0 ){
              while($doc_row = mysqli_fetch_array($doc_query)) {
                $final_link = '';
                $doc_file = 'uploads/documents/'.$doc_row['doc_file'];
                $doc_link = $doc_row['doc_link'];
                $final_link = ( !empty($doc_link) ) ? $doc_link : $doc_file ;
                $final_class = ( !empty($doc_link) ) ? 'text-primary' : 'text-dark' ;
                $final_icon = ( !empty($doc_link) ) ? 'fa-link' : 'fa-file-pdf' ;
                $final_size = ( !empty($doc_link) ) ? 'col-lg-12' : 'col-lg-6' ;
                ?>
                  <div class="col-lg-10xx <?php echo $final_size; ?> mx-autoxx pb-2">
                    <div class="card card-body py-2">
                      <a class="d-inline-block <?php echo $final_class; ?>" href="<?php echo $final_link; ?>" target="_blank">
                        <strong> <i class="fa <?php echo $final_icon; ?> me-2"></i> <?php echo $doc_row['doc_caption']; ?> </strong>
                      </a>
                    </div>
                  </div>
                <?php
              }
            } else {
              echo "Category Data not Found. ";
            }

          } else {

            //Simple select query
            $doc_sql = "SELECT * FROM documents WHERE `doc_category` = '$link' ";
            $doc_query = mysqli_query($conn, $doc_sql);

            if( mysqli_num_rows($doc_query) > 0 ){
              while($doc_row = mysqli_fetch_array($doc_query)) {
                // print_r($doc_row);
                ?>
                  <div class="col-md-6 col-lg-6 pb-2">
                    <div class="card card-body py-2">
                      <a class="d-inline-block" href="uploads/documents/<?php echo $doc_row['doc_file']; ?>" target="_blank">
                        <strong> <i class="fa fa-file-pdf me-2"></i> <?php echo $doc_row['doc_caption']; ?> </strong>
                      </a>
                    </div>
                  </div>
                <?php
              }
            } else {
              echo "Category Data not Found. ";
            }

          }

        } else {
          ?>
            <div class="card card-body">
              <div class="page-content p-4 text-left">
                <h2 class="">None, Nothing found!</h2>
                <div class="lead">No page found on given address, please check your url or search above.</div>
              </div>
            </div>
          <?php
        }
        ?>


      </div>
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
          $doc_sql = "SELECT * FROM documents WHERE doc_tags LIKE '%$media_tag%' ORDER BY did DESC";
          $doc_query = mysqli_query($conn, $doc_sql);
          if ($doc_query){
            while($doc_row = mysqli_fetch_array($doc_query)) {
              $post_img = (!empty($doc_row['doc_image'])) ? $doc_row['doc_image'] : 'default.jpg';
              ?>
              <div class="col-md-4 col-lg-3">
                <a class="documents-itemx" href="<?php echo $site_url."/uploads/documents/". $post_img ?>" data-fancybox="gallery">
                  <img class="img-thumbnail cover-imgx" src="<?php echo $site_url."/uploads/documents/". $post_img ?>" alt="<?php echo $doc_row['doc_tags']; ?>">
                </a>
                <small class="d-block text-center"><strong><?php echo $doc_row['doc_caption']; ?></strong></small>
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




<!-- footer -->
<?php include('footer.php'); ?>
