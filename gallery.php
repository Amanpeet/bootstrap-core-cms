<?php include('header.php'); //header ?>

<div class="titlemon pt-4 pb-3">
  <div class="container text-center pt-4">
    <h1 class="text-dark"><strong> Gallery </strong></h1>
    <div class="back-btn"><a href="index.php"> <small> <strong><i class="fa fa-arrow-left"></i> BACK TO HOME </strong></small></a> </div>
    <span class="line"></span>
  </div>
</div>

<section class="page-section py-5">
  <div class="container">
    <div class="cardxx card-bodyxx text-center p-4xx">

      <div class="row g-4">
        <?php
          //pagination part 1
          $items_per_page = 20;
          if (isset($_GET["pagex"])) {
            $pagex = $_GET["pagex"];
          } else {
            $pagex = 1;
          }
          $start_from = ($pagex - 1) * $items_per_page;

          //Simple select query
          $gal_mod = " WHERE `gal_featured` = '1' OR `gal_tags` LIKE '%gallery%' OR `gal_tags` LIKE '%project%' ";

          $gal_sql = "SELECT * FROM gallery ".$gal_mod." ORDER BY gid DESC LIMIT $items_per_page OFFSET $start_from";
          $gal_query = mysqli_query($conn, $gal_sql);
          if ($gal_query){
            while($gal_row = mysqli_fetch_array($gal_query)) {
              $post_img = (!empty($gal_row['gal_image'])) ? $gal_row['gal_image'] : 'default.jpg';
              $post_link = (!empty($gal_row['gal_image'])) ? 'gallery-item.php?img='.$gal_row['gid'] : '';
              ?>
              <div class="col-md-4 col-lg-3">
                <a class="gallery-item" href="<?php echo $site_url."/uploads/gallery/". $post_img ?>" data-fancybox="gallery">
                  <img class="img-thumbnail cover-img" src="<?php echo $site_url."/uploads/gallery/". $post_img ?>" alt="<?php echo $gal_row['gal_tags']; ?>">
                </a>
                <strong> <a href="<?php echo $site_url.$post_link; ?>"> <?php echo $gal_row['gal_caption']; ?> </a> </strong>
              </div>
            <?php
            }
          } else {
            echo "No Media Found!";
          }
        ?>
      </div>

      <!-- pagination 2 -->
      <?php echo "<p class='mt-5 text-center'><strong> Page: ".$pagex. "</strong> </p>"; ?>
      <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center w-100">
          <?php
            //pagination part 2
            $sql = "SELECT COUNT(gid) AS countx FROM gallery";
            $stmt          = mysqli_query($conn, $sql);
            $lastid_data   = @mysqli_fetch_array($stmt);
            $total_records = $lastid_data['countx'] ;
            $total_pages   = ceil($total_records / $items_per_page);
            //for first page
            $new_data = array("pagex" => "1");
            $full_data = array_merge($_GET, $new_data);
            $url = http_build_query($full_data);
            echo '<li class="page-item"><a class="page-link" href="?'.$url.'">First</a></li>';
            //for each page
            if( $total_pages > 10 ){
              $i = $pagex;
              $min_pages = $i + 10 ;
              if( $min_pages >= $total_pages ){
                $i = $total_pages - 10;
                $min_pages = $i + 10 ;
              }
              for ( $i; $i <= $min_pages; $i++) {
                $new_data = array( "pagex" => $i );
                $full_data = array_merge($_GET, $new_data);
                $url = http_build_query($full_data);
                if( $pagex == $i ){
                  echo '<li class="page-item active"><a class="page-link" href="?'.$url.'">'.$i.'</a></li>';
                } else {
                  echo '<li class="page-item"><a class="page-link" href="?'.$url.'">'.$i.'</a></li>';
                }
              }
              //dots to next page
              if( ! ($min_pages >= $total_pages-10) ){
                $new_data = array( "pagex" => $min_pages+1 );
                $full_data = array_merge($_GET, $new_data);
                $url = http_build_query($full_data);
                echo "<a href=?$url> ... </a> ";
              }
            } else {
              for ( $i=1; $i <= $total_pages; $i++) {
                $new_data = array( "pagex" => $i );
                $full_data = array_merge($_GET, $new_data);
                $url = http_build_query($full_data);
                if( $pagex == $i ){
                  echo '<li class="page-item active"><a class="page-link" href="?'.$url.'">'.$i.'</a></li>';
                } else {
                  echo '<li class="page-item"><a class="page-link" href="?'.$url.'">'.$i.'</a></li>';
                }
              }
            }
            //last page
            $new_data = array("pagex" => $total_pages);
            $full_data = array_merge($_GET, $new_data);
            $url = http_build_query($full_data);
            echo '<li class="page-item"><a class="page-link" href="?'.$url.'">Last</a></li>';
          ?>
        </ul>
      </nav>



      <div class="row g-4 d-none">
        <!-- /* DISPLAY ALL IMAGES FROM A FOLDER */ -->
        <?php
          //get current directory
          $working_dir = getcwd();
          //get image directory
          $img_dir = $working_dir . "/uploads/gallery/";
          //change current directory to image directory
          chdir($img_dir);
          //using glob() function get images
          $files = glob("*.{jpg,jpeg,png,JPG,JPEG,PNG}", GLOB_BRACE );
          //again change the directory to working directory
          chdir($working_dir);
          //iterate over image files
          /*
          foreach ($files as $file) {
            ?>
              <div class="col-lg-4">
                <a class="gallery-item" href="<?php echo $site_url."/uploads/gallery/". $file ?>" data-fancybox="gallery">
                  <img class="img-thumbnail cover-img" src="<?php echo $site_url."/uploads/gallery/". $file ?>" alt="">
                </a>
              </div>
            <?php
          }
          */
        ?>
      </div>

    </div>
  </div>
</section>

<!-- footer -->
<?php include('footer.php'); ?>