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
          $select = "SELECT * FROM documents WHERE did = '$id'";
          $que = mysqli_query($conn, $select);
          $fet = mysqli_fetch_array($que);
        ?>
        <h5>Do you really want to delete post <strong><?php echo $fet['did']; ?> (Title: <?php echo $fet['doc_caption']; ?>) </strong>from database? </h5>
        <h6 class="text-danger"> Note: This action cannot be undone. </h6>
        <div class="text-left my-4">
          <input type="submit" class="btn btn-danger" name="deletemon" value="Delete">
          <a class="btn btn-dark" href="documents.php">Cancel</a>
        </div>
      </form>
    </div>

    <div id="response" class="h4">
      <?php
      if(isset($_POST['deletemon'])){
        $delete = "DELETE FROM documents WHERE did = '$id' ";
        $quer = mysqli_query($conn, $delete);
        if($quer){
          echo "<strong>SUCCESS: Document Deleted. Redirecting back...";
          echo '<script>window.location="documents.php";</script>';
        } else{
          echo "<strong>ERROR: Document not deleted. Please try again later.</strong>";
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
      <h3> <strong>Update Document </strong> </h3>
      <p>Update Document, Edit Caption and Tags and hit <strong>UPDATE</strong> button.</p>
      <a class="btn btn-primary btn-sm" href="documents-single.php?add=1"> <i class="fas fa-plus"></i> Add New Document</a>
    </div>

    <!-- Operation updatemon -->
    <div id="response" class="h5">

      <!-- response for updatemon -->
      <div class="pt-2 pl-2 h4">
        <?php if( isset($_REQUEST['updated']) ) { ?>
          <strong class='text-success'>SUCCESS: Document Updated Successfully.</strong>
        <?php } ?>
        <?php if( isset($_REQUEST['added']) ) { ?>
          <strong class='text-success'>SUCCESS: Document Added Successfully.</strong>
        <?php } ?>
      </div>

      <?php
      if(isset($_POST['updatemon'])) {

        //required
        $doc_caption  = mysqli_real_escape_string($conn, $_POST['doc_caption']);
        $doc_tags     = mysqli_real_escape_string($conn, $_POST['doc_tags']);
        $doc_category = @mysqli_real_escape_string($conn, $_POST['doc_category']);
        $doc_link     = @mysqli_real_escape_string($conn, $_POST['doc_link']);

        // image
        // $accepted_img = array("jpeg", "jpg", "png", "JPEG", "JPG", "PNG");
        $accepted_img = array("pdf", "doc", "docx", "ppt", "pptx", "xlsx", "xls");
        $uniqd = round(microtime(true));

        //grab existing files
        $select = "SELECT * FROM documents WHERE did = '$id'";
        $que = mysqli_query($conn, $select);
        $fet = mysqli_fetch_array($que);
        echo $doc_file = $fet['doc_file'];

        //file1
        // $doc_file = '';
        // $old_file_name = '';
        $fileserr1 = false;
        if( empty($_FILES['doc_file']) ){
          // $doc_file = '';
          $fileserr1 = false;
        } elseif( ($_FILES['doc_file']['size'] == 0) ){
          // $doc_file = '';
          $fileserr1 = false;
        } else if( $_FILES['doc_file']['size'] > (16*1024*1024) ) { // 16 MB
          $fileserr1 = true;
        } else {
          $temp = explode(".", $_FILES["doc_file"]["name"]);
          $ext  = end($temp);

          $old_file_parts      = array_slice($temp, 0, -1);
          $old_file_name       = implode(" ", $old_file_parts);
          $old_file_name_clean = strtolower( str_replace(' ', '_', $old_file_name) );
          $old_file_name_clean = preg_replace('/[^a-zA-Z0-9_-]/', '', $old_file_name_clean);

          if( in_array($ext, $accepted_img ) == false ){
            $fileserr1 = true;
          } else {
            $newfilename_new = 'doc_' . $uniqd . '.' . end($temp);
            $newfilename_new = $old_file_name_clean . '.' . $ext;
            $newfilename = (!empty($doc_file)) ? $doc_file : $newfilename_new; //make new name if not found
            $imagetmp    = trim($_FILES['doc_file']['tmp_name']);
            $path        = "../uploads/documents/".$newfilename;
            move_uploaded_file($imagetmp, $path);
            $doc_file = $newfilename;
            $fileserr1 = false;
          }
        }

        // if no caption
        $doc_caption = empty($doc_caption ) ? $old_file_name : $doc_caption;

        if( empty($doc_caption) || $fileserr1 ){
          echo "<strong class='text-danger'>ERROR: Required fields or Image is Empty or Invalid. Please try again.</strong>";
          // exit;
        } else {

          // update products to db
          $update = "UPDATE documents SET doc_file='$doc_file', doc_caption='$doc_caption', doc_tags='$doc_tags', doc_category='$doc_category', doc_link='$doc_link' WHERE did = '$id' ";
          $quer = mysqli_query($conn, $update);
          if($quer){
            echo "<strong class='text-success'>SUCCESS: Document Updated Successfully.</strong>";
            echo '<script>window.location="documents-single.php?edit='.$id.'&updated=1";</script>';
            // echo '<script>window.location="#response";</script>';
          } else {
            echo "<strong>ERROR: Document not Updated. Please try again later.</strong>";
          }

        }
      }
      ?>
    </div>

    <!-- update form -->
    <div class="form-box p-2">
      <form id="id_card_form" name="id_card_form" action="" method="post" enctype="multipart/form-data">
        <?php
          $select = "SELECT * FROM documents WHERE did = '$id'";
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
                <input type="text" class="form-control" name="did" value="<?php echo $fet['did']; ?>" disabled required>
              </td>
            </tr>
            <tr>
              <td> Document Image </td>
              <td>
                <?php echo (!empty($fet['doc_file'])) ? ' <a href="../uploads/documents/'.$fet["doc_file"].'" target="_blank"> <strong>View Current File</strong> </a> ' : ''; ?> <small class="ps-4"><?php echo '../uploads/documents/'.$fet['doc_file']; ?></small>
                <input type="file" class="form-control mt-2" name="doc_file" accept="application/pdf, .pdf, .xlsx, .xls, .doc, .docx, .ppt, .pptx">
                <small class="text-muted">Uploading new file will replace current file, Max 16 MB.</small> <br>
              </td>
            </tr>
            <tr>
              <td> Document Link </td>
              <td>
                <input type="text" class="form-control" name="doc_link" value="<?php echo $fet['doc_link']; ?>" maxlength="400" required>
              </td>
            </tr>
            <tr>
              <td> Document Caption </td>
              <td>
                <input type="text" class="form-control" name="doc_caption" value="<?php echo $fet['doc_caption']; ?>" maxlength="300" required>
              </td>
            </tr>

            <tr>
              <td> Document Tags </td>
              <td>
                <input type="text" class="form-control" name="doc_tags" value="<?php echo $fet['doc_tags']; ?>" maxlength="200">
              </td>
            </tr>
            <tr>
              <td> Document Category </td>
              <td>
                <!-- Currently Selected: <?php echo$fet['doc_category'] ; ?> -->
                <select class="form-select" name="doc_category" style="max-width: 300px;" required>
                  <option value="">Select</option>
                  <option <?php echo ($fet['doc_category']=="certificates")?"selected":''; ?> value="certificates">Certificates</option>
                  <option <?php echo ($fet['doc_category']=="technical-information")?"selected":''; ?> value="technical-information">Technical Information</option>
                  <option <?php echo ($fet['doc_category']=="success-stories")?"selected":''; ?> value="success-stories">Success Stories</option>
                  <!-- <option <?php echo ($fet['doc_category']=="knowledge-corner")?"selected":''; ?> value="knowledge-corner">Knowledge Corner</option> -->
                  <option <?php echo ($fet['doc_category']=="in-the-news")?"selected":''; ?> value="in-the-news">In the News</option>
                  <option <?php echo ($fet['doc_category']=="other")?"selected":''; ?> value="other">Other</option>
                  <option <?php echo ($fet['doc_category']=="hidden")?"selected":''; ?> value="hidden">Hidden</option>
                </select>
                <small class="text-muted"> * Document will be displayed on selected Category Page. </small>
              </td>
            </tr>
          </tbody>
        </table>

        <div class="my-4">
          <input type="submit" class="btn btn-primary" name="updatemon" value="UPDATE">
          <a href="documents.php" class="btn btn-dark">Back</a> <br><br>
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
      <h3> <strong>ADD Document</strong> </h3>
      <p>Add new Document item, Enter Caption and Tags and hit <strong>UPDATE</strong> button.</p>
    </div>

    <!-- Operation updatemon -->
    <div id="response" class="h5">

      <!-- response for updatemon -->
      <div class="pt-2 pl-2 h4">
        <?php if( isset($_REQUEST['added']) ) { ?>
          <strong class='text-success'>SUCCESS: Document Added Successfully.</strong>
        <?php } ?>
      </div>

      <?php
      if(isset($_POST['addnew'])) {

        //required
        $doc_caption  = mysqli_real_escape_string($conn, $_POST['doc_caption']);
        $doc_tags     = mysqli_real_escape_string($conn, $_POST['doc_tags']);
        $doc_category = mysqli_real_escape_string($conn, $_POST['doc_category']);
        $doc_link     = mysqli_real_escape_string($conn, $_POST['doc_link']);

        // image
        // $accepted_img = array("jpeg", "jpg", "png", "JPEG", "JPG", "PNG");
        $accepted_img = array("pdf", "doc", "docx", "ppt", "pptx", "xlsx", "xls");
        $uniqd = round(microtime(true));

        //file1
        $doc_file = '';
        $old_file_name = '';
        $fileserr1 = false;
        if( empty($_FILES['doc_file']) ){
          $doc_file = '';
          $fileserr1 = false;
        } elseif( ($_FILES['doc_file']['size'] == 0) ){
          $doc_file = '';
          $fileserr1 = false;
        } else if( $_FILES['doc_file']['size'] > (16*1024*1024) ) { // 16 MB
          $fileserr1 = true;
        } else {
          $temp = explode(".", $_FILES["doc_file"]["name"]);
          $ext  = end($temp);

          $old_file_parts      = array_slice($temp, 0, -1);
          $old_file_name       = implode(" ", $old_file_parts);
          $old_file_name_clean = strtolower( str_replace(' ', '_', $old_file_name) );
          $old_file_name_clean = preg_replace('/[^a-zA-Z0-9_-]/', '', $old_file_name_clean);

          if( in_array($ext, $accepted_img ) == false ){
            $fileserr1 = true;
          } else {
            $newfilename = 'doc_'. $uniqd . '.' . end($temp);
            $newfilename = $old_file_name_clean . '.' . $ext; //keeping same name
            $imagetmp    = trim($_FILES['doc_file']['tmp_name']);
            $path        = "../uploads/documents/".$newfilename;
            move_uploaded_file($imagetmp, $path);
            $doc_file = $newfilename;
            $fileserr1 = false;
          }
        }

        // if no caption
        $doc_caption = empty($doc_caption) ? $old_file_name : $doc_caption;

        if( empty($doc_caption) || $fileserr1 == true ){
          echo "<strong class='text-danger'>ERROR: Required file is invalid or exceeds in size. Please try again.</strong>";
          // exit;
        } else {

          // update products to db
          $update = "INSERT INTO `documents` (`doc_file`, `doc_caption`, `doc_tags`, `doc_category`, `doc_link`) VALUES ('$doc_file', '$doc_caption','$doc_tags', '$doc_category', '$doc_link') ";
          $quer = mysqli_query($conn, $update);
          $last_id = mysqli_insert_id ( $conn );
          if($quer){
            echo "<strong class='text-success'>SUCCESS: Document added successfully.</strong>";
            echo '<script>window.location="documents-single.php?edit='.$last_id.'&added=1";</script>';
            // echo '<script>window.location="#response";</script>';
          } else {
            echo "<strong>ERROR: Document not added. Please try again later.</strong>";
          }

        }
      }
      ?>
    </div>

    <!-- update form -->
    <div class="form-box p-2">
      <form id="id_card_form" name="id_card_form" action="" method="post" enctype="multipart/form-data">
        <?php
          $select = "SELECT * FROM documents WHERE did = '$id'";
          $que = mysqli_query($conn, $select);
          $fet = mysqli_fetch_array($que);
        ?>
        <table class="table table-bordered">
          <tbody>
            <tr>
              <td style="width:200px"> <strong>Document File</strong> </td>
              <td>
                <input type="file" class="form-control" name="doc_file" accept="application/pdf, .pdf, .xlsx, .xls, .doc, .docx, .ppt, .pptx">
                <small class="text-muted">Documents Only, Max size allowed 16 MB </small>
              </td>
            </tr>
            <tr>
              <td> Document Link </td>
              <td>
                <input type="text" class="form-control" name="doc_link">
              </td>
            </tr>
            <tr>
              <td> Document Caption </td>
              <td>
                <input type="text" class="form-control" name="doc_caption">
              </td>
            </tr>
            <tr>
              <td> Document Tags </td>
              <td>
                <input type="text" class="form-control" name="doc_tags">
              </td>
            </tr>
            <tr>
              <td> <strong>Document Category</strong> </td>
              <td>
                <select class="form-select" name="doc_category" style="max-width: 300px;" required>
                  <option value="" selected>Select</option>
                  <option value="certificates">Certificates</option>
                  <option value="technical-information">Technical Information</option>
                  <option value="success-stories">Success Stories</option>
                  <!-- <option value="knowledge-corner">Knowledge Corner</option> -->
                  <option value="in-the-news">In the News</option>
                  <option value="other">Other</option>
                  <option value="hidden">Hidden</option>
                </select>
                <small class="text-muted"> * Document will be displayed on selected Category Page. </small>
              </td>
            </tr>
          </tbody>
        </table>

        <div class="my-4">
          <input type="submit" class="btn btn-primary" name="addnew" value="SAVE DOCUMENT">
          <a href="documents.php" class="btn btn-dark">Back</a> <br><br>
        </div>

      </form>
    </div>
  <?php

/* ELSE SHOW ERROR */
} else {
  ?>
  <div class="p-3 border-bottom">
    <h3> <strong>Document not found</strong> </h3>
    <p>No Document found via given id. Please go back and try again.</p>
  </div>
  <?php

} //if else end
?>

<!-- include header -->
<?php include('inc/footer.php'); ?>