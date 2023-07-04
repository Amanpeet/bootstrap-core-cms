<?php include('inc/header.php'); ?>

<?php
/* IF DELETE ITEM */
if(isset($_REQUEST['del'])) {
  $id = $_REQUEST['del'];
  ?>
    <div class="p-2 border-bottom">
      <h3> <strong>Delete Item</strong> </h3>
      <p>Confirm deletion of Specific Item.</p>
    </div>
    <div class="form-box p-2">
      <form id="id_card_form" name="id_card_form" action="" method="post">
        <?php
          $select = "SELECT * FROM pages WHERE pid = '$id'";
          $que = mysqli_query($conn, $select);
          $fet = mysqli_fetch_array($que);
        ?>
        <h5>Do you really want to delete page <strong><?php echo $fet['pid']; ?> (Title: <?php echo $fet['page_title']; ?>) </strong>from database? </h5>
        <h6 class="text-danger"> Note: This action cannot be undone. </h6>
        <div class="text-left my-4">
          <input type="submit" class="btn btn-danger" name="deletemon" value="Delete">
          <a class="btn btn-dark" href="pages.php">Cancel</a>
        </div>
      </form>
    </div>

    <div id="response" class="h4">
      <?php
      if(isset($_POST['deletemon'])){
        $delete = "DELETE FROM pages WHERE pid = '$id' ";
        $quer = mysqli_query($conn, $delete);
        if($quer){
          echo "<strong>SUCCESS: Page Deleted. Redirecting back...";
          echo '<script>window.location="pages.php";</script>';
        } else{
          echo "<strong>ERROR: Page not deleted. Please try again later.</strong>";
        }
      }
      ?>
    </div>
    <?php

/* IF UPDATE ITEM */
} else if(isset($_REQUEST['edit'])) {
  $id = $_REQUEST['edit'];
  ?>
    <div class="p-2 border-bottom">
      <h3> <strong> Home Page  </strong> </h3>
      <p>Update Page, Replace Image, Edit Title and Content and hit <strong>UPDATE</strong> button.</p>
    </div>

    <!-- Operation updatemon -->
    <div id="response" class="h5">

      <!-- response for updatemon -->
      <div class="pt-2 pl-2 h4">
        <?php if( isset($_REQUEST['updated']) ) { ?>
          <strong class='text-success'>SUCCESS: Page Updated Successfully.</strong>
        <?php } ?>
      </div>

      <?php
      if(isset($_POST['updatemon'])) {

        //required
        $page_title       = mysqli_real_escape_string($conn, $_POST['page_title']);
        $page_content     = mysqli_real_escape_string($conn, $_POST['page_content']);
        $page_data_one    = mysqli_real_escape_string($conn, $_POST['page_data_one']);
        $page_data_two    = mysqli_real_escape_string($conn, $_POST['page_data_two']);
        $page_data_three  = mysqli_real_escape_string($conn, $_POST['page_data_three']);
        $page_data_four   = mysqli_real_escape_string($conn, $_POST['page_data_four']);
        $page_media       = mysqli_real_escape_string($conn, $_POST['page_media']);
        $page_description = mysqli_real_escape_string($conn, $_POST['page_description']);
        $page_keywords    = mysqli_real_escape_string($conn, $_POST['page_keywords']);

        //process permalink
        // $page_permalink = empty($page_permalink) ? $page_title : $page_permalink;
        // $permalink_temp = str_replace(' ', '-', $page_permalink);
        // $permalink_temp = preg_replace('/[^A-Za-z0-9\-]/', '', $permalink_temp);
        // $permalink_temp = preg_replace('/-+/', '-', $permalink_temp);
        // $page_permalink = strtolower($permalink_temp);

        $accepted_img = array("jpeg", "jpg", "png", "JPEG", "JPG", "PNG");
        $uniqd = round(microtime(true));

        //grab existing files
        $select = "SELECT * FROM templates WHERE pid = '$id'";
        $que = mysqli_query($conn, $select);
        $fet = mysqli_fetch_array($que);
        $page_image = $fet['page_image'];
        $page_sideimg = $fet['page_sideimg'];

        //file1
        // $page_image = '';
        $fileserr1 = false;
        if( empty($_FILES['page_image']) ){
          // $page_image = '';
          $fileserr1 = false;
        } elseif( ($_FILES['page_image']['size'] == 0) ){
          // $page_image = '';
          $fileserr1 = false;
        } else if( $_FILES['page_image']['size'] > (1*1024*1024) ) { //1MB
          $fileserr1 = true;
        } else {
          $temp = explode(".", $_FILES["page_image"]["name"]);
          $ext  = end($temp);
          if( in_array($ext, $accepted_img ) == false ){
            $fileserr1 = true;
          } else {
            $newfilename_new = 'page_' . $uniqd . '.' . end($temp);
            $newfilename = (!empty($page_image)) ? $page_image : $newfilename_new; //make new name if not found
            $imagetmp    = trim($_FILES['page_image']['tmp_name']);
            $path        = "../uploads/pages/".$newfilename;
            move_uploaded_file($imagetmp, $path);
            $page_image = $newfilename;
            $fileserr1 = false;
          }
        }

        // $page_sideimg = '';
        $fileserr2 = false;
        if( empty($_FILES['page_sideimg']) ){
          // $page_sideimg = '';
          $fileserr1 = false;
        } elseif( ($_FILES['page_sideimg']['size'] == 0) ){
          // $page_sideimg = '';
          $fileserr1 = false;
        } else if( $_FILES['page_sideimg']['size'] > (1*1024*1024) ) { //1MB
          $fileserr1 = true;
        } else {
          $temp = explode(".", $_FILES["page_sideimg"]["name"]);
          $ext  = end($temp);
          if( in_array($ext, $accepted_img ) == false ){
            $fileserr1 = true;
          } else {
            $newfilename_new = 'page_' . $uniqd . '.' . end($temp);
            $newfilename = (!empty($page_sideimg)) ? $page_sideimg : $newfilename_new; //make new name if not found
            $imagetmp    = trim($_FILES['page_sideimg']['tmp_name']);
            $path        = "../uploads/pages/".$newfilename;
            move_uploaded_file($imagetmp, $path);
            $page_sideimg = $newfilename;
            $fileserr1 = false;
          }
        }

        if( empty($page_title) || $fileserr1 ){
          echo "<strong class='text-danger'>ERROR: Required fields or Image is Empty or Invalid. Please try again.</strong>";
          // exit;
        } else {

          // update products to db
          $update = "UPDATE templates SET `page_title` = '$page_title', `page_content` = '$page_content', `page_data_one` = '$page_data_one', `page_data_two` = '$page_data_two', `page_data_three` = '$page_data_three', `page_data_four` = '$page_data_four', `page_image` = '$page_image', `page_sideimg` = '$page_sideimg', `page_media` = '$page_media', `page_description` = '$page_description', `page_keywords` = '$page_keywords' WHERE pid = '$id' ";
          $quer = mysqli_query($conn, $update);
          if($quer){
            echo "<strong class='text-success'>SUCCESS: Page Updated Successfully.</strong>";
            echo '<script>window.location="templates.php?edit='.$id.'&updated=1";</script>';
            // echo '<script>window.location="#response";</script>';
          } else {
            echo "<strong>ERROR: Page not Updated. Please try again later.</strong>";
          }

        }
      }
      ?>
    </div>

    <!-- update form -->
    <div class="form-box p-2">
      <form id="id_card_form" name="id_card_form" action="" method="post" enctype="multipart/form-data">
        <?php
          $select = "SELECT * FROM templates WHERE pid = '$id'";
          $que = mysqli_query($conn, $select);
          $fet = mysqli_fetch_array($que);
          $datef = date('d M, Y', strtotime($fet['dated']));
        ?>
        <div class="py-3">
          <small> Created on <?php echo $datef; ?> </small>
          <small> <a href="<?php echo $site_url; ?>/<?php echo $fet['page_permalink']; ?>" target="_blank"> View Page </a>  </small>
        </div>
        <table class="table table-bordered">
          <tbody>
            <tr>
              <td style="width: 200px;"> # ID</td>
              <td>
                <input type="text" class="form-control" name="pid" value="<?php echo $fet['pid']; ?>" disabled required>
              </td>
            </tr>
            <tr>
              <td> Page Title </td>
              <td>
                <input type="text" class="form-control" name="page_title" value="<?php echo $fet['page_title']; ?>" maxlength="200" readonly required>
              </td>
            </tr>
            <tr>
              <td> Page Content </td>
              <td>
                <textarea id="trum-editor" name="page_content" required><?php echo $fet['page_content']; ?></textarea>
                <!-- <textarea class="form-control" name="page_content" style="height:320px; font-size: 14px;" required><?php echo $fet['']; ?></textarea>
                <small>* HTML supported </small> -->
              </td>
            </tr>

            <tr>
              <td> Page Data one </td>
              <td>
                <textarea class="form-control" name="page_data_one" style="height:100px; font-size: 14px;" required><?php echo $fet['page_data_one']; ?></textarea>
              </td>
            </tr>
            <tr>
              <td> Page Data two </td>
              <td>
                <textarea class="form-control" name="page_data_two" style="height:100px; font-size: 14px;" required><?php echo $fet['page_data_two']; ?></textarea>
              </td>
            </tr>
            <tr>
              <td> Page Data three </td>
              <td>
                <textarea class="form-control" name="page_data_three" style="height:100px; font-size: 14px;" required><?php echo $fet['page_data_three']; ?></textarea>
              </td>
            </tr>
            <tr>
              <td> Page Data four </td>
              <td>
                <textarea class="form-control" name="page_data_four" style="height:100px; font-size: 14px;" required><?php echo $fet['page_data_four']; ?></textarea>
              </td>
            </tr>

            <tr>
              <td> Page Cover Image </td>
              <td>
                <input type="file" class="form-control form-control-sm" name="page_image" accept="image/*">
                <small class="text-muted">Uploading new file will replace current file, Max 1MB.</small> <br>
                <?php echo (!empty($fet['page_image'])) ? ' <a href="../uploads/pages/'.$fet["page_image"].'" target="_blank"> <img class="img-thumbnail" src="../uploads/pages/'.$fet["page_image"].'" alt="" width="160"> </a> ' : ''; ?>
              </td>
            </tr>
            <tr>
              <td> Page Side Image </td>
              <td>
                <input type="file" class="form-control form-control-sm" name="page_sideimg" accept="image/*">
                <small class="text-muted">Uploading new file will replace current file, Max 1MB.</small> <br>
                <?php echo (!empty($fet['page_sideimg'])) ? ' <a href="../uploads/pages/'.$fet["page_sideimg"].'" target="_blank"> <img class="img-thumbnail" src="../uploads/pages/'.$fet["page_sideimg"].'" alt="" width="160"> </a> ' : ''; ?>
              </td>
            </tr>
            <tr>
              <td> Post Media </td>
              <td>
                <input type="text" class="form-control" name="page_media" value="<?php echo $fet['page_media']; ?>">
                <small class="text-muted">Input IDs of Gallery files (comma separated).</small> <br>
              </td>
            </tr>

            <tr>
              <td> Meta Description </td>
              <td>
                <input type="text" class="form-control" name="page_description" value="<?php echo $fet['page_description']; ?>" maxlength="200">
              </td>
            </tr>
            <tr>
              <td> Meta Keywords </td>
              <td>
                <input type="text" class="form-control" name="page_keywords" value="<?php echo $fet['page_keywords']; ?>" maxlength="300">
              </td>
            </tr>
          </tbody>
        </table>

        <div class="my-4">
          <input type="submit" class="btn btn-primary" name="updatemon" value="UPDATE">
          <a href="pages.php" class="btn btn-dark">Back</a> <br><br>
        </div>

      </form>
    </div>
  <?php

/* ELSE SHOW ITEM */
} else if(isset($_REQUEST['view'])) {
  $id = $_REQUEST['view'];
  //not needed

/* ELSE ADD ITEM */
} else if(isset($_REQUEST['add'])) {
  $id = $_REQUEST['add'];
  //not needed

/* ELSE SHOW ERROR */
} else {
  ?>
  <div class="p-3 border-bottom">
    <h3> <strong>Page not found</strong> </h3>
    <p>No Page found via given id. Please go back and try again.</p>
  </div>
  <?php

} //if else end
?>

<!-- include header -->
<?php include('inc/footer.php'); ?>