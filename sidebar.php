<!-- the sidebar -->

<div class="sidebar-widget single-slidebar">
  <h4>From Blog</h4>
  <div class="blog-list">
    <?php
    //Simple select query
    $items_per_page = 3;
    $blog_sql = "SELECT * FROM blog ORDER BY bid DESC LIMIT $items_per_page ";
    $blog_query = mysqli_query($conn, $blog_sql);
    while($post = mysqli_fetch_array($blog_query)) { ?>
      <div class="card blog-card bg-dark mb-4" style="background-image: url(uploads/<?php echo $post['blog_image']; ?>);">
        <a class="d-block" href="blog-single.php?post=<?php echo $post['bid']; ?>">
          <div class="card-body">
            <h5 class="card-title text-white"><strong><?php echo $post['blog_title']; ?></strong></h5>
            <div class="card-text text-white">
              <?php echo strip_tags( substr( $post['blog_content'], 0, 50 ) ) . '...'; ?>
            </div>
          </div>
        </a>
      </div>
    <?php } ?>

  </div>
</div>
