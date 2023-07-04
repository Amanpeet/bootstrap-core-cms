<?php include('header.php'); ?>
<!-- header end -->

<div class="titlemon pt-4 pb-2">
  <div class="container text-center pt-4">
    <h1 class="text-dark"><strong> All Pages </strong></h1>
    <div><a href="<?php echo $site_url; ?>/index.php"> <small><strong> <i class="fa fa-arrow-left"></i> BACK TO HOME </strong></small></a> </div>
    <span class="line"></span>
  </div>
</div>

<section class="site-section py-5">
  <div class="container">
    <div class="cardxx card-bodyxx py-4">

      <div class="row">
        <div class="col-md-10 mx-auto">

          <?php
          //pagination part 1
          $items_per_page = 10;
          if (isset($_GET["pagex"])) {
            $pagex = $_GET["pagex"];
          } else {
            $pagex = 1;
          }
          $start_from = ($pagex - 1) * $items_per_page;

          //Simple select query
          $page_sql = "SELECT * FROM pages ORDER BY pid DESC LIMIT $items_per_page OFFSET $start_from";
          $page_query = mysqli_query($conn, $page_sql);
          if ($page_query){
            while($page_row = mysqli_fetch_array($page_query)) {
              $post_img = (!empty($page_row['page_image'])) ? $page_row['page_image'] : 'default.jpg';

              $post_link = (!empty($page_row['page_permalink'])) ? $page_row['page_permalink'] : '';
              $alt_link = $site_url."/pages-item.php?id=".$page_row['pid'];
              $ugly_link = $site_url."/pages-link.php?link=".$page_row['page_permalink'];
              $perma_link = $site_url."/permalink.php?type=xxx&link=/".$page_row['page_permalink']; //slash important

              $final_link = "";
              if( !empty($post_link) ){
                $final_link = $site_url."/pages/".$post_link;
              } else {
                $final_link = $site_url."/pages-item.php?id=".$page_row['pid'];
              }
              ?>
              <div class="card bg-white mb-4 mb-lg-5">
                <div class="row no-gutters">
                  <div class="col-md-4">
                    <img class="card-img cover-img" src="uploads/pages/<?php echo $post_img; ?>" alt="">
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <h6 class="card-subtitle text-muted mb-2"><small><?php echo $page_row['page_media']; ?></small></h6>
                      <h5 class="card-title"><strong><?php echo $page_row['page_title']; ?></strong></h5>
                      <div class="card-text">
                        <?php echo strip_tags( substr( $page_row['page_content'], 0, 260 ) ) . '...'; ?>
                      </div>
                      <a class="btn btn-primary btn-sm mt-3" href="<?php echo $final_link; ?>">Read More</a>
                      <a class="btn btn-dark btn-sm mt-3" href="<?php echo $alt_link; ?>">Read More</a>
                      <a class="btn btn-warning btn-sm mt-3" href="<?php echo $ugly_link; ?>">Read More</a>
                      <a class="btn btn-info btn-sm mt-3" href="<?php echo $perma_link; ?>">Read More</a>
                    </div>
                  </div>
                </div>
              </div>
            <?php
            }
          } else {
            echo "No Posts Found!";
          }
          ?>

          <!-- pagination 2 -->
          <?php echo "<p class='mt-5 text-center'><strong> Page: ".$pagex. "</strong> </p>"; ?>
          <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center w-100">
              <?php
                //pagination part 2
                $sql = "SELECT COUNT(pid) AS countx FROM pages";
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

        </div>
      </div>

    </div>
  </div>
</section>

<!-- footer -->
<?php include('footer.php'); ?>
