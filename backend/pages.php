<?php include('inc/header.php'); ?>

<!-- page title -->
<div class="p-3 border-bottom">
  <h3> <strong>Pages</strong> </h3>
  <p>Listings all pages. Click <strong>View</strong> to view whole post. Showing latest 30 entries per page.</p>
</div>

<!-- content & forms -->
<div class="p-2">

  <a class="btn btn-primary" href="pages-single.php?add=1"> <i class="fas fa-plus"></i> Add new PAGE</a>

  <!-- data -->
  <table class="table table-striped table-bordered mt-4">
    <thead>
      <tr>
        <th style="width:5%"># ID</th>
        <th style="width:15%">Image</th>
        <th style="width:45%">Title</th>
        <th style="width:17%">Created</th>
        <th style="width:18%">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      //pagination part 1
      $items_per_page = 30;
      if (isset($_GET["pagex"])) {
        $pagex = $_GET["pagex"];
      } else {
        $pagex = 1;
      }
      $start_from = ($pagex - 1) * $items_per_page;

      // query
      $select = "SELECT * FROM pages ORDER BY pid DESC LIMIT $items_per_page OFFSET $start_from";
      $quer = mysqli_query($conn, $select);
      while($fetch = mysqli_fetch_array($quer)){ ?>
        <tr>
          <td> <?php echo $fetch['pid']; ?> </td>
          <td> <img src="../uploads/pages/<?php echo $fetch['page_image']; ?>" alt="" width="200">  </td>
          <td>
            <h5><?php echo $fetch['page_title']; ?> </h5>
            <p class="text-muted"><?php echo strip_tags( substr($fetch['page_content'], 0, 100) ). "..."; ?></p>
          </td>
          <td>
            <small class="text-muted"><?php echo date('d M, Y', strtotime($fetch['dated'])); ?></small>
          </td>
          <td class="quad-btns">
            <!-- <a class="btn btn-primary btn-sm" href="pages-single.php?view=<?php //echo $fetch['pid']; ?>">View</a> -->
            <a class="btn btn-primary btn-sm" href="pages-single.php?edit=<?php echo $fetch['pid']; ?>">Edit</a>
            <a class="btn btn-danger btn-sm" href="pages-single.php?del=<?php echo $fetch['pid']; ?>">Delete</a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>

  <!-- pagination 2 -->
  <?php echo "<p><strong> Page: ".$pagex. "</strong> </p>"; ?>
  <nav aria-label="Page navigation example">
    <ul class="pagination">
      <?php
        //pagination part 2
        $sql = "SELECT COUNT(pid) AS countx FROM pages ";
        $stmt          = mysqli_query($conn, $sql);
        $lastid_data   = mysqli_fetch_array($stmt);
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

<!-- include header -->
<?php include('inc/footer.php'); ?>