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
          $select = "SELECT * FROM gallery WHERE gid = '$id'";
          $que = mysqli_query($conn, $select);
          $fet = mysqli_fetch_array($que);
        ?>
        <h5>Do you really want to delete post <strong><?php echo $fet['gid']; ?> (Title: <?php echo $fet['gal_caption']; ?>) </strong>from database? </h5>
        <h6 class="text-danger"> Note: This action cannot be undone. </h6>
        <div class="text-left my-4">
          <input type="submit" class="btn btn-danger" name="deletemon" value="Delete">
          <a class="btn btn-dark" href="gallery.php">Cancel</a>
        </div>
      </form>
    </div>

    <div id="response" class="h4">
      <?php
      if(isset($_POST['deletemon'])){
        $delete = "DELETE FROM gallery WHERE gid = '$id' ";
        $quer = mysqli_query($conn, $delete);
        if($quer){
          echo "<strong>SUCCESS: Media Deleted. Redirecting back...";
          echo '<script>window.location="gallery.php";</script>';
        } else{
          echo "<strong>ERROR: Media not deleted. Please try again later.</strong>";
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
      <h3> <strong>Update Gallery Media </strong> </h3>
      <p>Update Media, Replace Image, Edit Caption and Tags and hit <strong>UPDATE</strong> button.</p>
      <a class="btn btn-primary btn-sm" href="gallery-single.php?add=1"> <i class="fas fa-plus"></i> Add Media</a>
    </div>

    <!-- Operation updatemon -->
    <div id="response" class="h5">

      <!-- response for updatemon -->
      <div class="pt-2 pl-2 h4">
        <?php if( isset($_REQUEST['updated']) ) { ?>
          <strong class='text-success'>SUCCESS: Media Updated Successfully.</strong>
        <?php } ?>
        <?php if( isset($_REQUEST['added']) ) { ?>
          <strong class='text-success'>SUCCESS: Media Added Successfully.</strong>
        <?php } ?>
      </div>

      <?php
      if(isset($_POST['updatemon'])) {

        //required
        $gal_caption  = mysqli_real_escape_string($conn, $_POST['gal_caption']);
        $gal_tags     = mysqli_real_escape_string($conn, $_POST['gal_tags']);
        $gal_featured = @mysqli_real_escape_string($conn, $_POST['gal_featured']);

        // image
        $accepted_img = array("jpeg", "jpg", "png", "JPEG", "JPG", "PNG");
        $uniqd = round(microtime(true));

        //grab existing files
        $select = "SELECT * FROM gallery WHERE gid = '$id'";
        $que = mysqli_query($conn, $select);
        $fet = mysqli_fetch_array($que);
        $gal_image = $fet['gal_image'];

        //file1
        // $gal_image = '';
        // $old_file_name = '';
        $fileserr1 = false;
        if( empty($_FILES['gal_image']) ){
          // $gal_image = '';
          $fileserr1 = false;
        } elseif( ($_FILES['gal_image']['size'] == 0) ){
          // $gal_image = '';
          $fileserr1 = false;
        } else if( $_FILES['gal_image']['size'] > (1*1024*1024) ) { //1MB
          $fileserr1 = true;
        } else {
          $temp = explode(".", $_FILES["gal_image"]["name"]);
          $ext  = end($temp);

          $old_file_parts      = array_slice($temp, 0, -1);
          $old_file_name       = implode(" ", $old_file_parts);
          $old_file_name_clean = strtolower( str_replace(' ', '_', $old_file_name) );
          $old_file_name_clean = preg_replace('/[^A-Za-z0-9\-]/', '', $old_file_name_clean);

          if( in_array($ext, $accepted_img ) == false ){
            $fileserr1 = true;
          } else {
            $newfilename_new = 'gal_' . $uniqd . '.' . end($temp);
            $newfilename_new = $old_file_name_clean . '.' . $ext;
            $newfilename = (!empty($gal_image)) ? $gal_image : $newfilename_new; //make new name if not found
            $imagetmp    = trim($_FILES['gal_image']['tmp_name']);
            $path        = "../uploads/gallery/".$newfilename;
            move_uploaded_file($imagetmp, $path);
            $gal_image = $newfilename;
            $fileserr1 = false;

            $targetDir = "../uploads/gallery/";

            // // Check if the target directory exists
            // if (!is_dir($targetDir)) {
            //   echo "Target directory does not exist.";
            //   exit;
            // }
            // // Check if the target directory is writable
            // if (!is_writable($targetDir)) {
            //   echo "Target directory is not writable.";
            //   exit;
            // }
            // // check if moves or not
            // if (move_uploaded_file($imagetmp, $path)) {
            //   echo "File was uploaded successfully.";
            // } else {
            //   echo "Sorry, there was an error uploading the file.";
            // }

          }
        }

        // if no caption
        $gal_caption = empty($gal_caption ) ? $old_file_name : $gal_caption;

        if( empty($gal_caption) || $fileserr1 ){
          echo "<strong class='text-danger'>ERROR: Required fields or Image is Empty or Invalid. Please try again.</strong>";
          // exit;
        } else {

          // update products to db
          $update = "UPDATE gallery SET gal_image='$gal_image', gal_caption='$gal_caption', gal_tags='$gal_tags', gal_featured='$gal_featured' WHERE gid = '$id' ";
          $quer = mysqli_query($conn, $update);
          if($quer){
            echo "<strong class='text-success'>SUCCESS: Media Updated Successfully.</strong>";
            echo '<script>window.location="gallery-single.php?edit='.$id.'&updated=1";</script>';
            // echo '<script>window.location="#response";</script>';
          } else {
            echo "<strong>ERROR: Media not Updated. Please try again later.</strong>";
          }

        }
      }
      ?>
    </div>

    <!-- update form -->
    <div class="form-box p-2">
      <form id="id_card_form" name="id_card_form" action="" method="post" enctype="multipart/form-data">
        <?php
          $select = "SELECT * FROM gallery WHERE gid = '$id'";
          $que = mysqli_query($conn, $select);
          $fet = mysqli_fetch_array($que);
          $datef = date('d M, Y', strtotime($fet['dated']));
        ?>
        <div class="py-3">
          <small> Created on <?php echo $datef; ?> </small>
        </div>
        <table class="table table-bordered">
          <tbody>
            <tr>
              <td style="width: 200px;"> # ID</td>
              <td>
                <input type="text" class="form-control" name="gid" value="<?php echo $fet['gid']; ?>" disabled required>
              </td>
            </tr>
            <tr>
              <td> Media Image </td>
              <td>
                <input type="file" class="form-control" name="gal_image" accept="image/*">
                <small class="text-muted">Uploading new file will replace current file, Max 1MB.</small> <br>
                <?php echo (!empty($fet['gal_image'])) ? ' <a href="../uploads/gallery/'.$fet["gal_image"].'" target="_blank"> <img class="img-thumbnail" src="../uploads/gallery/'.$fet["gal_image"].'" alt="" width="250"> </a> ' : ''; ?>
              </td>
            </tr>
            <tr>
              <td> Media Caption </td>
              <td>
                <input type="text" class="form-control" name="gal_caption" value="<?php echo $fet['gal_caption']; ?>" maxlength="300" required>
              </td>
            </tr>

            <tr>
              <td> Media Tags </td>
              <td>
                <input type="text" class="form-control" name="gal_tags" value="<?php echo $fet['gal_tags']; ?>" maxlength="200">
              </td>
            </tr>
            <tr>
              <td> Media Featured </td>
              <td>
                <input type="checkbox" class="form-check-input featured-check" name="gal_featured" value="1" <?php if( $fet['gal_featured']== 1 ){ echo "checked"; } ?>>
                <small class="text-muted ps-4"> * Featured images will be displayed in Gallery.</small>
              </td>
            </tr>
          </tbody>
        </table>

        <div class="my-4">
          <input type="submit" class="btn btn-primary" name="updatemon" value="UPDATE">
          <a href="gallery.php" class="btn btn-dark">Back</a> <br><br>
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
  ?>
    <div class="p-2 border-bottom">
      <h3> <strong>ADD Media</strong> </h3>
      <p>Add new Media item, Enter Caption and Tags and hit <strong>UPDATE</strong> button.</p>
    </div>

    <!-- Operation updatemon -->
    <div id="response" class="h5">

      <!-- response for updatemon -->
      <div class="pt-2 pl-2 h4">
        <?php if( isset($_REQUEST['added']) ) { ?>
          <strong class='text-success'>SUCCESS: Post Added Successfully.</strong>
        <?php } ?>
      </div>

      <?php
      if(isset($_POST['addnew'])) {

        //required
        $gal_caption  = mysqli_real_escape_string($conn, $_POST['gal_caption']);
        $gal_tags     = mysqli_real_escape_string($conn, $_POST['gal_tags']);
        $gal_featured = @mysqli_real_escape_string($conn, $_POST['gal_featured']);

        // image
        $accepted_img = array("jpeg", "jpg", "png", "JPEG", "JPG", "PNG");
        $uniqd = round(microtime(true));

        //file1
        $gal_image = '';
        $old_file_name = '';
        $fileserr1 = false;
        if( empty($_FILES['gal_image']) ){
          $gal_image = '';
          $fileserr1 = false;
        } elseif( ($_FILES['gal_image']['size'] == 0) ){
          $gal_image = '';
          $fileserr1 = false;
        } else if( $_FILES['gal_image']['size'] > (1*1024*1024) ) { //1MB
          $fileserr1 = true;
        } else {
          $temp = explode(".", $_FILES["gal_image"]["name"]);
          $ext  = end($temp);

          $old_file_parts      = array_slice($temp, 0, -1);
          $old_file_name       = implode(" ", $old_file_parts);
          $old_file_name_clean = strtolower( str_replace(' ', '_', $old_file_name) );
          $old_file_name_clean = preg_replace('/[^A-Za-z0-9\-]/', '', $old_file_name_clean);

          if( in_array($ext, $accepted_img ) == false ){
            $fileserr1 = true;
          } else {
            $newfilename = 'gal_'. $uniqd . '.' . end($temp);
            //$newfilename = $old_file_name_clean . '.' . $ext; //keeping same name
            $imagetmp    = trim($_FILES['gal_image']['tmp_name']);
            $path        = "../uploads/gallery/".$newfilename;
            move_uploaded_file($imagetmp, $path);
            $gal_image = $newfilename;
            $fileserr1 = false;
          }
        }

        // if no caption
        $gal_caption = empty($gal_caption) ? $old_file_name : $gal_caption;

        if( empty($gal_caption) || $fileserr1 ){
          echo "<strong class='text-danger'>ERROR: Required fields or Image is Empty or Invalid. Please try again.</strong>";
          // exit;
        } else {

          // update products to db
          $update = "INSERT INTO gallery ( gal_image, gal_caption, gal_tags, gal_featured) VALUES ('$gal_image', '$gal_caption','$gal_tags', '$gal_featured') ";
          $quer = mysqli_query($conn, $update);
          $last_id = mysqli_insert_id ( $conn );
          if($quer){
            echo "<strong class='text-success'>SUCCESS: Media added successfully.</strong>";
            echo '<script>window.location="gallery-single.php?edit='.$last_id.'&added=1";</script>';
            // echo '<script>window.location="#response";</script>';
          } else {
            echo "<strong>ERROR: Media not added. Please try again later.</strong>";
          }

        }
      }
      ?>
    </div>

    <!-- update form -->
    <div class="form-box p-2">
      <form id="id_card_form" name="id_card_form" action="" method="post" enctype="multipart/form-data">
        <?php
          $select = "SELECT * FROM gallery WHERE gid = '$id'";
          $que = mysqli_query($conn, $select);
          $fet = mysqli_fetch_array($que);
        ?>
        <table class="table table-bordered">
          <tbody>
            <tr>
              <td> Post Image </td>
              <td>
                <input type="file" class="form-control" name="gal_image" accept="image/*">
                <small class="text-muted">Max size allowed 1MB </small>
              </td>
            </tr>
            <tr>
              <td style="width:200px"> Media Caption </td>
              <td>
                <input type="text" class="form-control" name="gal_caption">
              </td>
            </tr>
            <tr>
              <td> Media Tags </td>
              <td>
                <input type="text" class="form-control" name="gal_tags">
              </td>
            </tr>
            <tr>
              <td> Media Featured </td>
              <td>
                <input type="checkbox" class="form-check-input featured-check" name="gal_featured" value="1">
                <small class="text-muted ps-4"> * Featured images will be displayed in Gallery</small>
              </td>
            </tr>
          </tbody>
        </table>

        <div class="my-4">
          <input type="submit" class="btn btn-primary" name="addnew" value="SAVE MEDIA">
          <a href="gallery.php" class="btn btn-dark">Back</a> <br><br>
        </div>

      </form>
    </div>
  <?php

/* ELSE SHOW ERROR */
} else {
  ?>
  <div class="p-3 border-bottom">
    <h3> <strong>Media not found</strong> </h3>
    <p>No Media found via given id. Please go back and try again.</p>
  </div>
  <?php

} //if else end
?>

<!-- include header -->
<?php include('inc/footer.php'); ?>